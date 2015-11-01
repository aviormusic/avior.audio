<?php
    error_reporting(E_ALL);

    require_once(realpath('./lib/functions.php'));
    require_once(realpath('./lib/template.php'));

    header('Content-type: text/html');
    header('X-Powered-By: Techno');

    $config = json_decode(file_get_contents(realpath('./web.config.json')));

    $url = str_replace('?' . $_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']);
    $url = str_replace($config->subdir, '', $url);
    $url = lrtrim($url, '/\\');
    $routes = explode('/', $url);

    $target_language = array_shift($routes);
    $target_page = array_shift($routes);
    $target_subpage = array_shift($routes);

    if($target_language === '' || $target_language === null) {
        $target_language = $config->langAlias->default;
        header('Location: ' . url($target_language) . '/');
        exit();
    }
    $target_language_file = $config->langAlias->$target_language;

    if(count($target_page) <= 0 || $target_page === null) {
        $target_page = $config->defaultIndexPage;
    }

    $native_page_path = $config->root . $target_page . '.' . $config->filetype;
    $static_page_path = $config->root . $target_page . '.html';
    if($native_page_path && (file_exists($native_page_path) || file_exists($static_page_path))) {
        if(file_exists($static_page_path)) {
            $webapp = new Template($static_page_path);
        } else {
            $webapp = new Template($native_page_path);
        }
    } else {
        $error_page_path = $config->root . $config->error . '.' . $config->filetype;
        $webapp = new Template($error_page_path);
    }
    $native_lang_path = $config->langpath . $target_language_file . '.json';
    $translation = json_decode(file_get_contents(realpath($native_lang_path)));
    $translation->ISOLanguage = $target_language;
    $translation->AppCache = url($config->appcache);
    $translation->Languages = $config->langAlias;
    $translation->BuildID = file_get_contents(realpath('./.build'));
    $webapp->renderWithData($translation);
    exit();

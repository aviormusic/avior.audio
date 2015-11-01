<?php

    function url($path) {
        $config = json_decode(file_get_contents('./web.config.json'));
        $url = $config->protocol . '://' . $config->host;
        $port = intval($config->port);
        if($port !== 80 && $port !== null) {
            $url .= ':' . $port;
        }
        return $url . '/' . $config->subdir . '/' . $path;
    }

    function websrc($path) {
        return url('public/' . $path);
    }

    function lrtrim($haystack, $needle) {
        $haystack = rtrim($haystack, $needle);
        $haystack = ltrim($haystack, $needle);
        return $haystack;
    }

    function hyphenate($className) {
        return strtolower(str_replace(' ', '-', preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $className)));
    }

    function toCamelCase($string, $capitalizeFirstCharacter = false) {
        $str = str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
        if (!$capitalizeFirstCharacter) {
            $str[0] = strtolower($str[0]);
        }
        return $str;
    }

    function static_component($component, $data) {
        $component = $component . '.php';
        $stat = dirname(dirname(__FILE__)) . '/modules/static/';
        $path = $stat . $component;
        if(file_exists($path)) {
            require_once($path);
        } else {
            $path = $stat . hyphenate($component);
            if(file_exists($path)) {
                require_once($path);
            } else {
                echo '<!-- Static component ' . $path . ' not found -->';
            }
        }
    }

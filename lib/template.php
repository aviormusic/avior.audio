<?php

    class Template {
        protected $file;
        protected $values = array();

        function __construct($file) {
            $this->file = $file;
        }

        public function set($key, $value) {
            $this->values[$key] = $value;
        }

        private function checkForTemplate() {
            if($this->file == null || !file_exists($this->file)) {
                return "[100] Template file $this->file doesn't exist!";
            } else if(!is_readable($this->file)) {
                return "[101] Template file $this->file is not readable!";
            }
        }

        public function render() {
            $this->checkForTemplate();
            try {
                $template = file_get_contents($this->file);
                foreach($this->values as $key => $value) {
                    if($key != null && $value != null) {
                        $ttr = '[@' . $key . ']';
                        $template = str_replace($ttr, $value, $template);
                    }
                }
                return $template;
            } catch(Exception $except) {
                return "[$except->getCode()] $except->getMessage()";
            }
        }

        public function renderWithData($data) {
            $this->checkForTemplate();
            require_once($this->file);
        }
    }

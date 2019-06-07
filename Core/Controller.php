<?php
    class Controller
    {
        public $request;

        
        public function __construct($request)
        {
            $this->request = $request;
        }

        public function redirect($url)
        {
            return header('Location: '.APPROOT.''.$url);
        }

        private function secure_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        protected function secure_form($form)
        {
            foreach ($form as $key => $value)
            {
                $form[$key] = $this->secure_input($value);
            }
        }

    }
?>
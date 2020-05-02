<?php
    class View
    {
        public static function render($templateFile, array $datas = array())
        {
            // Start the observation of the buffering
            // PS: The buffering here can be view as the content between ob_start and ob_end
            ob_start();
            
            // This function extract each value from the array to a new variable usable by the views
            extract($datas);

            // Loading the corresponding view
            require(ROOT . "Views/" . $templateFile . '.php');
            
            // returning the corresponding view and close the observation
            return ob_get_clean();
        }        
    }

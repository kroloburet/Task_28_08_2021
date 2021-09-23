<?php

namespace Core;

abstract class AbstractController
{
    /**
     * View template
     *
     * @param string $path Path to template from Views directory
     * @param array $data Vars for view
     * @param bool $withComponents View components or not
     */
    public function view(string $path, array $data = [], bool $withComponents = true)
    {
        $header = APP_PATH . 'Views/components/header.php';
        $template = APP_PATH . 'Views/' . $path . '.php';
        $footer = APP_PATH . 'Views/components/footer.php';

        if (file_exists($header) && file_exists($template) && file_exists($footer)) {
            extract($data);
            !$withComponents ? : require_once $header;
            require_once $template;
            !$withComponents ? : require_once $footer;
        } else {
            die("Error! Wrong path to view component.");
        }
    }
}
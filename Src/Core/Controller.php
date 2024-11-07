<?php 

namespace Src\Core;

/**
 * Controller class responsible for views and extract data to views
 */
abstract class Controller
{
    /**
     * To render view and provide data to view
     * @param mixed $template
     * @param mixed $data
     * @return void
     */
    public function view($template,  $data = [])
    {
        extract($data);
        ob_start();
        require "../$template";
        echo ob_get_clean();
    }

}
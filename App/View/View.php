<?php


namespace View;

include_once ".".DIRECTORY_SEPARATOR."Config".DIRECTORY_SEPARATOR."configView.php";

class View
{
    /**
     * method for connecting a display file and passing an array of data
     * @param string $viewPage
     * @param array $data
     */
    public function render(string $viewPage,array $data = [])
    {
        extract($data);
        include_once ROOT_DIRECTORY . DIRECTORY_SEPARATOR . VIEW_DIR . DIRECTORY_SEPARATOR . TEMPLATE_DIR . DIRECTORY_SEPARATOR . $viewPage . '.php';
    }

}
<?php


namespace Controllers;

use View\View;

class Controller
{
    protected $view;

    protected $usersService;

    protected $precedentService;

    /**
     * connection of all necessary services for further inheritance
     */
    public function __construct(){
        $this->view = new View();
//        $this->usersService = new UsersService();
//        $this->precedentService = new PrecedentService();

    }

}
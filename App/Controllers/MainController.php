<?php


namespace Controllers;


class MainController extends Controller
{

    public function index()
    {
        $this->view->render('index');
    }

}
<?php

namespace Interfaces;


interface controllerInterface
{
    /**
     * main method
     */
    public function index();
    /**
     * returns the entity by id for editing
     */
    public function edit();

    /**
     * method for realized creating entity
     * @return mixed
     */
    public function create();

    /**
     * method for realized updating entity
     * @return mixed
     */
    public function update();

    /**
     * method for realized deleting entity
     * @return mixed
     */
    public function delete();
}
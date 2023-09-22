<?php


namespace Controllers;

use DTO\TaskDTO;
use Interfaces\controllerInterface;
use Services\ResponseService;
use Services\TaskService;
use Validators\TaskValidator;

class TaskController extends Controller implements controllerInterface
{

    /**
     * get all tasks
     * @throws \Exception
     */
    public function index()
    {
        $taskService = new TaskService();
        $tasks = $taskService->getAllTask();
        ResponseService::jsonResponse($tasks,200);
    }

    /**
     * get task by id
     * @throws \Exception
     */
    public function edit(){

        $validationResult = TaskValidator::validate([
            'id'=>$_GET['id'],
        ]);

        if($validationResult !== true){
            ResponseService::jsonResponse($validationResult,400);
        }
        $taskService = new TaskService();
        $task = $taskService->getTaskById($_GET['id']);
        ResponseService::jsonResponse($task,200);
    }


    /**
     * create new task
     * @return mixed|void
     * @throws \Exception
     */
    public function create()
    {
        $validationResult = TaskValidator::validate([
            'title'=>$_POST['title'],
            'description'=>$_POST['description'],
        ]);

        if($validationResult !== true){
            ResponseService::jsonResponse($validationResult,400);
        }

        $taskService = new TaskService();
        $task = $taskService->creatTask($_POST['title'],$_POST['description']);
        ResponseService::jsonResponse($task,200);

    }


    /**
     * update task
     * @return mixed|void
     * @throws \Exception
     */
    public function update()
    {
        $validationResult = TaskValidator::validate([
            'id'=> $_POST['id'],
            'title'=>$_POST['title'],
            'description'=>$_POST['description'],
        ]);

        if($validationResult !== true){
            ResponseService::jsonResponse($validationResult,400);
        }

        $newTask = new TaskDTO($_POST['id'],$_POST['title'],$_POST['description']);

        $taskService = new TaskService();
        $task = $taskService->updateTask($newTask);
        ResponseService::jsonResponse($task,200);

    }

    /**
     * delete task
     * @return mixed|void
     */
    public function delete()
    {
        $validationResult = TaskValidator::validate([
            'id'=>$_POST['id'],
        ]);
        if($validationResult !== true){
            ResponseService::jsonResponse($validationResult,400);
        }
        $taskService = new TaskService();
        $task = $taskService->deleteTask($_POST['id']);
        ResponseService::jsonResponse($task,200);
    }
}
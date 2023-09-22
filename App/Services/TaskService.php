<?php


namespace Services;


use Model\TaskModel;
use DTO\TaskDTO;

class TaskService
{
    protected $taskModel;

    /**
     * TaskService constructor.
     * init taskModel
     */
    public function __construct() {
        $this->taskModel = new TaskModel();
    }

    /**
     *  get all the tasks using the task model and return them to the controller
     * @return array
     * @throws \Exception
     */
    public function getAllTask():array
    {
       return $this->taskModel->getAll();
    }

    /**
     * get the task by id  using the task model and return them to the controller
     * @param int $id
     * @return TaskDTO
     * @throws \Exception
     */
    public function  getTaskById(int $id):array
    {
        return $this->taskModel->getById($id);
    }

    /**
     * create new task and save in DB
     * @param string $title
     * @param string $description
     * @return bool
     * @throws \Exception
     */
    public function creatTask(string $title , string $description):bool
    {
        return $this->taskModel->create($title,$description);
    }

    /**
     * update Task in DB
     * @param TaskDTO $task
     * @return bool
     * @throws \Exception
     */
    public function updateTask(TaskDTO $task):bool
    {
        return $this->taskModel->update($task);
    }

    /**
     * delete task by id
     * @param int $id
     * @return bool
     */
    public function deleteTask(int $id):bool
    {
        return $this->taskModel->delete($id);
    }

}
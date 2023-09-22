<?php


namespace Model;


use DTO\TaskDTO;

class TaskModel extends Model
{
    /**
     * get all task
     * @return array
     * @throws \Exception
     */
    public function getAll():array
    {
        $sql = "SELECT * FROM tasks;";
        $result = $this->db->query($sql);
        if($this->db->errno !==0 ){
            throw new \Exception($this->db->errno);
        }
        $tasks = $result->fetch_all(MYSQLI_ASSOC);
        $allTasks = [];

        foreach ($tasks as $task) {
            $allTasks[] = ['id'=>$task['id'], 'title'=> $task['title'], 'description'=>$task['description']];
        }

        return $allTasks;
    }

    /**
     * get task by id
     * @param int $id
     * @return TaskDTO
     * @throws \Exception
     */
    public function getById(int $id):array
    {
        $sql = "SELECT * FROM tasks WHERE id =?";
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            throw new \Exception("Failed to prepare statement: " . $this->db->error);
        }
        $stmt->bind_param('i',$id);

        if (!$stmt->execute()) {
            throw new \Exception("Failed to execute statement: " . $stmt->error);
        }
        $result = $stmt->get_result();

        if ($this->db->errno !== 0) {
            throw new \Exception("Database error: " . $this->db->error);
        }
        $fetchedData =  $result->fetch_array(MYSQLI_ASSOC);

        return $fetchedData;
    }

    /**
     * creat new task
     * @param string $title
     * @param string $description
     * @return bool
     * @throws \Exception
     */
     public function create(string $title , string $description):bool
    {
        $sql = 'INSERT INTO tasks (title, description) VALUES (?, ?) ';
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            throw new \Exception("Failed to prepare statement: " . $this->db->error);
        }
        $stmt->bind_param("ss", $title, $description);

        if (!$stmt->execute()) {
            throw new \Exception("Failed to execute statement: " . $stmt->error);
        }
        return true;
    }

    /**
     * update task
     * @param TaskDTO $task
     * @return bool
     * @throws \Exception
     */
     public function update(TaskDTO $task):bool
    {
        $id = $task->getId();
        $title = $task->getTitle();
        $description = $task->getDescription();

        $sql = "UPDATE tasks SET title = ?, description = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            throw new \Exception("Failed to prepare statement: " . $this->db->error);
        }
        $stmt->bind_param("ssi",$title ,$description , $id);

        if (!$stmt->execute()) {
            throw new \Exception("Failed to execute statement: " . $stmt->error);
        }
        return true;
    }

    public function delete(int $id):bool
    {
        $sql = "DELETE FROM tasks WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            throw new \Exception("Failed to prepare statement: " . $this->db->error);
        }
        $stmt->bind_param("i", $id);

        if (!$stmt->execute()) {
            throw new \Exception("Failed to execute statement: " . $stmt->error);
        }
        return true;
    }

}
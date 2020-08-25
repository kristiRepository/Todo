<?php


class Todo
{

    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }


    public function insert($todo)
    {
        $query = "INSERT INTO task(name,description,priority,deadline,user_id) VALUES(:name,:description,:priority,:deadline,:user_id)";
        $statment = $this->pdo->prepare($query);
        $statment->bindParam(":name", $todo['name'], PDO::PARAM_STR);
        $statment->bindParam(":description", $todo['description'], PDO::PARAM_STR);
        $statment->bindParam(":priority", $todo['priority'], PDO::PARAM_STR);
        $statment->bindParam(":deadline", $todo['deadline'], PDO::PARAM_STR);
        $statment->bindParam(":user_id", $todo['user_id'], PDO::PARAM_STR);
        $statment->execute();
    }

    public function fetchTasks($user_id)
    {
        $query = "SELECT * FROM task WHERE done IS NULL AND user_id=:user_id AND deadline > :deadline ORDER BY deadline ASC";
        $time = time();
        $statment = $this->pdo->prepare($query);
        $statment->bindParam(":user_id", $user_id, PDO::PARAM_STR);
        $statment->bindParam(":deadline", $time, PDO::PARAM_STR);
        $statment->execute();
        $result = $statment->fetchAll();
        return $result;
    }

    public function markAsDone($id)
    {
        $query = "UPDATE task SET done=1 WHERE id=:id";
        $statment = $this->pdo->prepare($query);
        $statment->bindParam(":id", $id, PDO::PARAM_STR);
        $statment->execute();
    }


    public function editTask($todo)
    {
        $query = "UPDATE task SET name=:name,description=:description,priority=:priority,deadline=:deadline WHERE id=:task_id ";
        $statment = $this->pdo->prepare($query);
        $statment->bindParam(":name", $todo['name'], PDO::PARAM_STR);
        $statment->bindParam(":description", $todo['description'], PDO::PARAM_STR);
        $statment->bindParam(":priority", $todo['priority'], PDO::PARAM_STR);
        $statment->bindParam(":deadline", $todo['deadline'], PDO::PARAM_STR);
        $statment->bindParam(":task_id", $todo['task_id'], PDO::PARAM_STR);
        $statment->execute();
    }

    public function deleteTask($id)
    {
        $query = "DELETE FROM task WHERE id=:id";
        $statment = $this->pdo->prepare($query);
        $statment->bindParam(":id", $id, PDO::PARAM_STR);
        $statment->execute();
    }
}

<?php



class TodoController
{

    protected $conn;
    protected $Authquery;
    protected $Todoquery;

    public function __construct()
    {

        $config = require('config.php');
        $this->conn = Connection::create($config);
        $this->Authquery = new Auth($this->conn);
        $this->Todoquery = new Todo($this->conn);
    }

    private function validate($orderOfKey)
    {
        if (isset($_POST)) {
            $x = array_keys($_POST);
            $data = $x[$orderOfKey];
            $$data = $_POST[$data];

            if ($data == "name" || $data == "description") {
                if ($$data == "") {
                    session_start();
                    $_SESSION['error'] = ucfirst($data) . " cannot be empty";
                    header("Location: /main");
                    return true;
                }
            }

            if ($data == "deadline") {
                if (strtotime($$data) < time()) {
                    session_start();
                    $_SESSION['error'] = ucfirst($data) . " cannot be set in the past";
                    header("Location: /main");
                    return true;
                }
            }
        } else {
            session_start();
            $_SESSION['error'] = ucfirst($data) . " is not set";
            header("Location: /main");
            return true;
        }
    }

    public function main()
    {
        $user_id = $_SESSION['id'];
        $tasks = $this->Todoquery->fetchTasks($user_id);
        require('views/tasks/main.php');
    }


    public function add()
    {
        $name = "";
        $description = "";
        $priority = "";
        $deadline = "";
        $user_id = "";


        if ($this->validate(0)) {
            return;
        };
        $name=$_POST['name'];
        if ($this->validate(1)) {
            return;
        };
        $description=$_POST['description'];
        if ($this->validate(2)) {
            return;
        };
        $priority=$_POST['priority'];
        if ($this->validate(3)) {
            return;
        };
        $deadline=$_POST['deadline'];
        if ($this->validate(4)) {
            return;
        };
        $user_id=$_POST['user_id'];



        $todo = array("name" => $name, "description" => $description, "priority" => $priority, "deadline" => $deadline, "user_id" => $user_id);
        $this->Todoquery->insert($todo);
        session_start();
        $_SESSION['success'] = "Todo added successfully";
        header("Location: /main");
    }

    public function done()
    {
        $id = "";

        if (!isset($_POST['id'])) {
            throw new Exception('Task not identified');
        }
        $id = $_POST['id'];
        $this->Todoquery->markAsDone($id);
        $user_id = $_SESSION['id'];
        $tasks = $this->Todoquery->fetchTasks($user_id);
        require('views/tasks/main.php');
    }

    public function edit()
    {

        $name = "";
        $description = "";
        $priority = "";
        $deadline = "";
        $task_id = "";

       
        if ($this->validate(0)) {
            return;
        };
        $name=$_POST['name'];
        if ($this->validate(1)) {
            return;
        };
        $description=$_POST['description'];
        if ($this->validate(2)) {
            return;
        };
        $priority=$_POST['priority'];
        if ($this->validate(3)) {
            return;
        };
        $deadline=$_POST['deadline'];
        if ($this->validate(4)) {
            return;
        };
        $task_id=$_POST['task_id'];

        $todo = array("name" => $name, "description" => $description, "priority" => $priority, "deadline" => $deadline, "task_id" => $task_id);
        $this->Todoquery->editTask($todo);
        session_start();
        $_SESSION['success'] = "Todo edited successfully";
        header("Location: /main");
    }

    public function deletetask()
    {
        $id = "";
        if (isset($_POST['delete_id'])) {
            $id = $_POST['delete_id'];
        } else {
            throw new Exception('Task not identified');
        }


        $this->Todoquery->deleteTask($id);

        session_start();
        $_SESSION['delete'] = "Todo deleted successfully";
        header("Location: /main");
    }
}

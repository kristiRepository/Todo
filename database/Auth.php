<?php



class Auth
{

    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function insert($username, $password)
    {
        $query = "INSERT INTO user(username,password) values(:username,:password)";
        $statment = $this->pdo->prepare($query);
        $statment->bindParam(":username", $username, PDO::PARAM_STR);
        $statment->bindParam(":password", $password, PDO::PARAM_STR);
        $statment->execute();
    }

    public function getByUsername($username)
    {
        $query = "SELECT * FROM user WHERE username=:username";
        $statment = $this->pdo->prepare($query);
        $statment->bindParam(":username", $username, PDO::PARAM_STR);
        $statment->execute();
        $results = $statment->fetchAll();
        return $results;
    }
}

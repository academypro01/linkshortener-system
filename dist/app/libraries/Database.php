<?php
class Database
{
    private $dbHost = DB_HOST;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASS;
    private $dbName = DB_NAME;

    private $statement;
    private $dbHandler;
    private $error;

    public function __construct()
    {
        $conn = 'mysql:host='. $this->dbHost . ';dbname=' . $this->dbName;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION
        );
        try {
            $this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);
            $this->createTables();
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    public function createTables() {
        $users_tbl = "CREATE TABLE `users_tbl` (
            `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `firstname` varchar(255) NOT NULL,
            `lastname` varchar(255) NOT NULL,
            `username` varchar(255) NOT NULL UNIQUE KEY,
            `email` varchar(255) NOT NULL UNIQUE KEY,
            `password` varchar(255) NOT NULL,
            `active` enum('0','1') NOT NULL DEFAULT '0',
            `isAdmin` enum('0','1') NOT NULL DEFAULT '0',
            `token` varchar(255) NOT NULL UNIQUE KEY
          )";
          $links_tbl = "CREATE TABLE `links_tbl` (
            `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `user_id` int(20) NOT NULL,
            `long_link` varchar(255) NOT NULL,
            `short_link` varchar(255) NOT NULL,
            `short_link_id` varchar(255) NOT NULL,
            `views` bigint(20) NOT NULL,
            `register_time` varchar(255) NOT NULL,
            `trash` enum('0','1') NOT NULL,
            CONSTRAINT `link_user` FOREIGN KEY (`user_id`) REFERENCES `users_tbl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
          )";

        try {
            $tblname_users_tbl = 'users_tbl';
            $x = $this->dbHandler->prepare("DESCRIBE $tblname_users_tbl");
            $x->execute();
            $row = $x->fetch();
        } catch (Exception $e) {
            $this->query($users_tbl);
            $this->execute();
            $this->query("INSERT INTO users_tbl (id, firstname, lastname, username, email, password, active, isAdmin, token) VALUES ('0','ghost','ghost','ghost','ghost','ghost','0','0','ghost')");
            $this->execute();
        }
        try {
            $tblname_links_tbl = 'links_tbl';
            $x = $this->dbHandler->prepare("DESCRIBE `$tblname_links_tbl`");
            $x->execute();
            $row = $x->fetch();
        } catch (Exception $e) {
            $this->query($links_tbl);
            $this->execute();
        }


    }

    public function query($sql)
    {
        $this->statement = $this->dbHandler->prepare($sql);
    }

    public function bind($parameter, $value, $type = null)
    {
        switch (is_null($type)) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
            $type = PDO::PARAM_STR;
        }
        $this->statement->bindValue($parameter, $value, $type);
    }

    public function execute()
    {
        return $this->statement->execute();
    }

    public function resultSet()
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function single()
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function rowCount()
    {
        $this->execute();
        return $this->statement->rowCount();
    }
}

<?php

class DbConnection
{
    private $host = 'localhost';
    private $username = 'root';
    private $passwd = '';
    private $dbname = 'dynamic_class_db';
    private $connection;

    protected function connect()
    {
        try {
            $this->connection = new mysqli($this->host, $this->username, $this->passwd, $this->dbname);
            if (!$this->connection) {
                throw new Exception("Connection Failed");
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            return $this->connection;
        }
    }

    protected function query($sql)
    {
        return $this->connect()->query($sql);
    }
    protected function cleanInput($input)
    {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }
}

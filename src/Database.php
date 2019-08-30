<?php

require_once "App.php";


class Database
{
    private $connection = null;

    /**
     * Database constructor.
     * @param null $connection
     */
    public function __construct()
    {
        $this->connect();
        $this->createTables();
    }

    /**
     * create tables
     */
    public function createTables() {
        global $App;
        $file =  "database_schema.sql";
        $query = file_get_contents($file);

        $this->exec($query);
    }

    public function exec($query){
        App::$logger->debug("Database: ".$query);
        $result = $this->getConnection()->exec($query);
        if ($result === false) {
            $err = $this->getConnection()->errorInfo();
            if ($err[0] === '00000' || $err[0] === '01000') {
                return true;
            } else{
               App::$logger->error("Error executing query: {$this->getConnection()->errorInfo()[2]}");
            }
        }
        return $result;
    }

    public function select($query) {
        $stmt = $this->getConnection()->query($query);
        $result = [];

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }

        return $result;
    }
    /**
     * @return mixed
     */
    public function getConnection()
    {
        return ($this->connection != null) ? $this->connection : $this->connect();
    }

    public function connect() {

        if ($this->connection == null) {
            $this->connection = new \PDO("sqlite:database.db");
        }
        return $this->connection;
    }

}
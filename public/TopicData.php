<?php
/**
 * Created by PhpStorm.
 * User: josep
 * Date: 1/05/14
 * Time: 11:19
 */

class TopicData {
    protected $connection;

    public function connect() {
        $this->connection = new PDO("mysql:host=localhost;dbname=suggestotron", "root", "123");
    }

    public function getAllTopics() {
        $query = $this->connection->prepare("SELECT * FROM topics");
        $query->execute();

        return $query;
    }

} 
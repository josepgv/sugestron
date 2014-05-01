<?php
/**
 * Created by PhpStorm.
 * User: josep
 * Date: 1/05/14
 * Time: 11:19
 */

class TopicData {
    protected $connection;

    public function __construct() {
        $this->connect();
    }

    public function connect() {
        $this->connection = new PDO("mysql:host=localhost;dbname=suggestotron", "root", "123");
    }

    public function getAllTopics() {
        $query = $this->connection->prepare("SELECT * FROM topics");
        $query->execute();

        return $query;
    }

    public function getTopic($id) {
        $query = $this->connection->prepare("SELECT * FROM topics WHERE id = :id LIMIT 1");

        $values = [':id' => $id];

        $query->execute($values);

        return $query->fetch(PDO::FETCH_ASSOC);

    }

    public function add($data) {

        $query = $this->connection->prepare(
        "INSERT INTO topics (
          title,
          description
        )
        VALUES
        (
          :title,
          :description
        )"
        );

        $querydata = [
            ':title'        => $data["title"],
            ':description'  => $data["description"]
        ];

        $query->execute($querydata);
    }

    public function update($data) {
        $query = $this->connection->prepare(
            "UPDATE topics
            SET
                title        = :title,
                description  = :description
            WHERE
                id = :id"
        );

        $querydata = [
            ':title'        => $data["title"],
            ':description'  => $data["description"],
            ':id'           => $data["id"]
        ];

        return $query->execute($querydata);
    }

} 
<?php

require("TopicData.php");

$data = new TopicData();
$data->connect();

$topics = $data->getAllTopics();

foreach($topics as $topic) {
    echo "<h3>" . $topic["title"] . " (" . $topic["id"] . ")</h3>";
    echo "<p>";
    echo nl2br($topic["description"]);
    echo "</p>";
    echo "<p><a href='edit.php?id=" . $topic["id"] . "'>Edit</a> | <a href='delete.php?id=" . $topic["id"] . "'>Delete</a></p>";
}
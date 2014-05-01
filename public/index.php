<?php
/**
 * Created by PhpStorm.
 * User: josep
 * Date: 1/05/14
 * Time: 11:22
 */

require("TopicData.php");

$data = new TopicData();
$data->connect();

$topics = $data->getAllTopics();

foreach($topics as $topic) {
    echo "<h3>" . $topic["title"] . " (" . $topic["id"] . ")</h3>";
    echo "<p>";
    echo nl2br($topic["description"]);
    echo "</p>";
}
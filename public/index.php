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
?>

<!doctype html>
<html>
<head>
    <title>Suggestotron</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>

<?php

foreach($topics as $topic) {
    echo "<h3>" . $topic["title"] . " (" . $topic["id"] . ")</h3>";
    echo "<p>";
    echo nl2br($topic["description"]);
    echo "</p>";
    echo "<p><a href='edit.php?id=" . $topic["id"] . "'>Edit</a> | <a href='/delete.php?id=" .$topic['id']. "'>Delete</a></p>";
}
?>

</body>
</html>
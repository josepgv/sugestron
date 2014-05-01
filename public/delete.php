<?php

if(!isset($_GET["id"]) || empty($_GET["id"]) || !is_numeric($_GET["id"])) {
    echo "You must specify a numeric ID";
    exit;
}

$data = new \Suggestotron\TopicData();
$topic = $data->getTopic($_GET["id"]);

if($topic === false) {
    echo "Could not find specified ID";
    exit;
}

if($data->delete($_GET["id"])) {
    header("Location: /sugestron/public");
    exit;
}
else {
    echo "An error occured";
}
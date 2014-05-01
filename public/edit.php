<?php

require("../src/Suggestotron/TopicData.php");
require("../src/Suggestotron/Template.php");

if(isset($_POST["id"]) && !empty($_POST["id"])) {
    $data = new \Suggestotron\TopicData();
    if($data->update($_POST)) {
        header("Location: /sugestron/public");
        exit;
    }
    else {
        echo "An error occurred";
        exit;
    }
}

if(!isset($_GET["id"]) || empty($_GET["id"]) || !is_numeric($_GET["id"])){
    echo "You must specify a numeric ID";
    exit;
}



$data = new \Suggestotron\TopicData();
$topic = $data->getTopic($_GET["id"]);

if($topic === false) {
    echo "Could not find specified ID";
    exit;
}

$template = new \Suggestotron\Template("../views/base.phtml");
$template->render("../views/index/edit.html", array('topic' => $topic));

?>
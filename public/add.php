<?php

if(isset($_POST) && sizeof($_POST) > 0) {
    $data = new \Suggestotron\TopicData();
    $data->add($_POST);

    //header("Location: /sugestron/public");
    //exit;
}

$template = new \Suggestotron\Template("../views/base.phtml");
$template->render("../views/index/add.html");


?>

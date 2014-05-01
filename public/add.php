<?php

require_once '../src/Suggestotron/Config.php';
\Suggestotron\Config::setDirectory('../config');

$config = \Suggestotron\Config::get('autoload');
require_once $config['class_path'] . '/Suggestotron/Autoloader.php'; // I should be able to remove this but apache won't let me!

if(isset($_POST) && sizeof($_POST) > 0) {
    $data = new \Suggestotron\TopicData();
    $data->add($_POST);

    //header("Location: /sugestron/public");
    //exit;
}

$template = new \Suggestotron\Template("../views/base.phtml");
$template->render("../views/index/add.html");


?>

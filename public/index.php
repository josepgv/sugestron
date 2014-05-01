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
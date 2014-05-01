<?php

namespace Suggestotron\Controller;


class Topics extends \Suggestotron\Controller{

    protected $data;


    public function __construct() {
        parent::__construct();
        $this->data = new \Suggestotron\TopicData();
    }

    public function listAction() {
        $topics = $this->data->getAllTopics();
        $this->render("index/list.phtml", ['topics' => $topics]);
    }

    public function addAction() {
        if(isset($_POST) && sizeof($_POST) > 0) {
            $this->data->add($_POST);
            header("Location: /");
            exit;
        }

        $this->render("index/add.html");
    }

    public function editAction($options) {

        if(isset($_POST["id"]) && !empty($_POST["id"])) {
            if($this->data->update($_POST)) {
                header("Location: /");
                exit;
            }
            else {
                echo "An error occurred";
                exit;
            }
        }

        if(!isset($options["id"]) || empty($options["id"])){
            echo "You must specify a numeric ID";
            exit;
        }


        $topic = $this->data->getTopic($options['id']);

        if($topic === false) {
            echo "Could not find specified ID";
            exit;
        }

        $this->render("index/edit.html", array('topic' => $topic));
    }

    public function deleteAction($options) {
        $id = $options['id'];
        if(!isset($id) || empty($id)) {
            echo "You must specify a numeric ID";
            exit;
        }

        $topic = $this->data->getTopic($id);

        if($topic === false) {
            echo "Could not find specified ID";
            exit;
        }

        if($this->data->delete($id)) {
            header("Location: /");
            exit;
        }
        else {
            echo "An error occurred";
        }
    }
} 
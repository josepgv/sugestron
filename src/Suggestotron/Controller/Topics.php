<?php

namespace Suggestotron\Controller;


class Topics {

    protected $data;
    protected $template;
    protected $config;

    public function __construct() {
        $this->config = \Suggestotron\Config::get('site');
        $this->data = new \Suggestotron\TopicData();
        $this->template = new \Suggestotron\Template($this->config['view_path'] . "/base.phtml");
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

    public function editAction() {
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

        if(!isset($_GET["id"]) || empty($_GET["id"]) || !is_numeric($_GET["id"])){
            echo "You must specify a numeric ID";
            exit;
        }


        $topic = $this->data->getTopic($_GET["id"]);

        if($topic === false) {
            echo "Could not find specified ID";
            exit;
        }

        $this->render("index/edit.html", array('topic' => $topic));
    }

    public function deleteAction() {
        $id = $_GET["id"];
        if(!isset($id) || empty($id) || !is_numeric($id)) {
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

    public function render($template, $data = array()) {

        $this->template->render($this->config['view_path'] . "/" . $template, $data);
    }
} 
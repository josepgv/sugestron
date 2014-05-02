<?php

namespace Suggestotron\Controller;


class Votes {
    public function upAction($options) {
        if(!isset($options["id"]) || empty($options["id"])) {
            echo "No topic ID was specified!";
            exit;
        }

        $votes = new \Suggestotron\Model\Votes();
        $votes->upVote($options["id"]);
        header("Location: /");
    }

    public function downAction($options) {
        if(!isset($options["id"]) || empty($options["id"])) {
            echo "No topic ID was specified!";
            exit;
        }

        $votes = new \Suggestotron\Model\Votes();
        $votes->downVote($options["id"]);
        header("Location: /");
    }
} 
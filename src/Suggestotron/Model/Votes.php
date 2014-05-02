<?php

namespace Suggestotron\Model;


class Votes {
    public function upVote($topic_id) {
        $query = \Suggestotron\Db::getInstance()->prepare(
            "UPDATE votes SET count = count + 1 WHERE topic_id = :topic_id"
        );
        $data = [':topic_id' => $topic_id];
        $query->execute($data);
    }

    public function downVote($topic_id) {
        $query = \Suggestotron\Db::getInstance()->prepare(
            "UPDATE votes SET count = count - 1 WHERE topic_id = :topic_id"
        );
        $data = [':topic_id' => $topic_id];
        $query->execute($data);
    }
} 
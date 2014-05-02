<?php

namespace Suggestotron\Controller;


class About extends \Suggestotron\Controller{
    public function indexAction($options) {
        $this->render("/index/about.phtml");
    }
} 
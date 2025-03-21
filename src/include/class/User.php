<?php

class User
{
    private $style="light";
    private $lang="fr";
    private $IP="None";

    public function __construct($style, $lang, $IP) {
        $this->style = $style;
        $this->lang = $lang;
        $this->IP=$IP;
    }

    public function getStyle() : string {
        return $this->style;
    }

    public function getLang() : string {
        return $this->lang;
    }

}

?>
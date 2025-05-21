<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function __construct(){
        $this->openai = new \App\Services\OpenAIServices();
    }

    public function chatCompletions() {

    }
}

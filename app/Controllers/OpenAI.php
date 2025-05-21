<?php

namespace App\Controllers;

class OpenAI extends BaseController
{
    public function __construct(){
        parent::initController(\Config\Services::request(), \Config\Services::response(), \Config\Services::logger());
        $this->openai = new \App\Services\OpenAIServices();
    }

    public function chatCompletions() {
        if (!$this->request->isAjax() || $this->request->getMethod() !== 'post') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('chatCompletions - Page not found');
        }
        $formData = $this->request->getPost();

        $response = $this->openai->chatCompletions($formData['prompt']);
        echo var_dump($response);
        die;
    }
}

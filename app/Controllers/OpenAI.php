<?php

namespace App\Controllers;

class OpenAI extends BaseController
{
    public function __construct(){
        parent::initController(\Config\Services::request(), \Config\Services::response(), \Config\Services::logger());
        $this->routeai = new \App\Services\RouteAIServices();
    }

    public function chatCompletions() {
        if (!$this->request->isAjax() || $this->request->getMethod() !== 'post') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('chatCompletions - Page not found');
        }
        $formData = $this->request->getPost();

        $response = $this->routeai->chatCompletions($formData['prompt']);
        
        return json_encode($response);
    }
}

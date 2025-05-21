<?php 

namespace App\Services;

use App\Services\BaseAIServices;

class OpenAIServices extends BaseAIServices {
    /**
     * Summary of __construct
     * get apiKey value from env and
     * start value of api url
     * save curl client on local variable
     */
    private array $validModels =['gpt-4.1', 'gpt-3.5-turbo'];

    public function __construct(){
        parent::__construct(getenv('openAIURL'), getenv('openAISecretKey'), \Config\Services::curlrequest(),  $this->getHeaders());
    }

    /**
     * {@inheritdoc}
     */
    protected function getHeaders(): array{
        return [
            'Authorization' => "Bearer {$this->apiKey}", 
            'Content-Type' => 'application/json',
        ];
    }

    protected function getPrompt():string{
        return "Identifique o erro relacionado a programação no texto a seguinte e retorne a solução ideal para a correção dele,
                caso não haja, responda de forma humorada relacionado ao texto: ";
    }

    public function isValidModel(string $model): bool
    {
        return in_array($model, $this->validModels);
    }
    protected function buildPayload(string $prompt, string $model = 'gpt-4.1'){  
        return [
                'model' => $model, 
                'message' => [
                    ['role' => 'system', 'content' => $this->getPrompt()],
                    ['role' => 'user', 'content' => $prompt],
            ],
        ];
    }
}
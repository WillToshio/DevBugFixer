<?php 
namespace App\Services;

use App\Services\BaseAIServices;

class RouteAIServices extends BaseAIServices {

    private array $validModels = [
        'mistralai/mistral-7b-instruct:free',
        'openchat/openchat-3.5-0106:free'
    ];

    /**
     * Summary of __construct
     * get apiKey value from env and
     * start value of api url
     * save curl client on local variable
     */
    public function __construct(){
        
        parent::__construct(getenv('routeAIURL'),  getenv('routeAISecretKey'), \Config\Services::curlrequest(),  $this->getHeaders());
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
    public function isValidModel(string $model): bool
    {
        return in_array($model, $this->validModels);
    }

    protected function getPrompt():string{
        return parent::getPrompt();
    }

    protected function buildPayload(string $prompt, string $model): array
    {
        return [
            'model' => $model,
            'messages' => [
                ['role' => 'system', 'content' => $this->getPrompt()],
                ['role' => 'user', 'content' => $prompt],
            ],
        ];
    }
}
<?php 
namespace App\Services;

use App\Services\BaseAIServices;

class RouteAIServices extends BaseAIServices {
    /**
     * Summary of validModels
     * @var array
     */
    private $validModels = [
            'meta-llama/llama-4-maverick:free',
            'meta-llama/llama-4-scout:free',
            'mistralai/mistral-small-3.1-24b-instruct:free',
            'deepseek/deepseek-r1:free',
            'deepseek/deepseek-v3-base:free',
            'deepseek/deepseek-chat-v3-0324:free',
            'deepseek/deepseek-r1-zero:free',
            'qwen/qwen2.5-vl-3b-instruct:free',
            'nous/deephermes-3-mistral-24b-preview:free',
            'nousresearch/deephermes-3-llama-3-8b-preview:free',
            'nvidia/llama-3.1-nemotron-nano-8b-v1:free',
            'google/gemini-2.5-pro-exp-03-25:free',
            'undi95/toppy-m-7b',
            'huggingfaceh4/zephyr-7b-beta',
            'openchat/openchat-3.5-0106:free',
            'mistralai/mistral-7b-instruct:free'
    ];

    /**
     * Summary of __construct
     * get apiKey value from env and
     * start value of api url
     * save curl client on local variable
     */
    public function __construct(){
        
        parent::__construct(getenv('routeAIURL'),  getenv('routeAISecretKey'), \Config\Services::curlrequest());
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

    protected function getSupportedModels(): array
    {
        return [
            'meta-llama/llama-4-maverick:free',
            'meta-llama/llama-4-scout:free',
            'mistralai/mistral-small-3.1-24b-instruct:free',
            'deepseek/deepseek-r1:free',
            'deepseek/deepseek-v3-base:free',
            'deepseek/deepseek-chat-v3-0324:free',
            'deepseek/deepseek-r1-zero:free',
            'qwen/qwen2.5-vl-3b-instruct:free',
            'nous/deephermes-3-mistral-24b-preview:free',
            'nousresearch/deephermes-3-llama-3-8b-preview:free',
            'nvidia/llama-3.1-nemotron-nano-8b-v1:free',
            'google/gemini-2.5-pro-exp-03-25:free',
            'undi95/toppy-m-7b',
            'huggingfaceh4/zephyr-7b-beta',
            'openchat/openchat-3.5-0106:free',
            'mistralai/mistral-7b-instruct:free'
        ];
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
    protected function tratandoResposta($raw){
        $raw = preg_replace('/[[:cntrl:]]/', '', $raw); // remove caracteres de controle
        $raw = trim($raw, "\xEF\xBB\xBF\""); // remove BOM e aspas duplicadas
        
        return json_decode($raw, true);
    }

    public function chatCompletions(string $prompt, string $model = 'mistralai/mistral-7b-instruct:free'): array
    {
        $model = $model ?? $this->model;
        $url = "{$this->api_url}chat/completions";
        if (!$this->isValidModel($model)) { 
            return responseError( "Modelo inválido para este provedor: {$model}", [], ['status'  => 400, 'prompt' => $prompt, 'model' => $model]);
        }
       
        try {
            $response = $this->client->post(
                $url,
                [
                    'headers' => $this->getHeaders(),
                    'json'    => $this->buildPayload($prompt, $model),
                ]
            );

            $statusCode = $response->getStatusCode();
            $body = json_decode($response->getBody(), true);
            
            if ($statusCode >= 200 && $statusCode < 300) {
               
                $response = $this->tratandoResposta($body['choices'][0]['message']['content']);
                
                
                return responseSuccess("resposta gerada com sucesso", [], (array) $response);
            }

            // Verifica se o erro é de limite excedido
            if (isset($body['error']['code']) && $body['error']['code'] === 'insufficient_quota') {
                // Tenta outro modelo gratuito
                foreach ($this->getSupportedModels() as $alternativeModel) {
                    if ($alternativeModel !== $model) {
                        $retry = $this->chatCompletions($prompt, $alternativeModel);
                        if (!$retry['error']) {
                            return $retry;
                        }
                    }
                }
                return responseError("Limite excedido para todos os modelos gratuitos disponíveis.", [], ['status'  => $statusCode, 'prompt' => $prompt]);
            }

           return responseError( $body['error']['message'] ?? 'Erro desconhecido na API', [], ['status'  => $statusCode, 'prompt' => $prompt, 'model' => $model]);


        } catch (\CodeIgniter\HTTP\Exceptions\HTTPException $e) {
             return responseError('Endpoint não encontrado. Verifique a URL da API e o modelo informado.', ['url'    => $url, 'model'  => $model, 'prompt' => $prompt], ['status'  => $e->getCode(), 'prompt' => $prompt, 'model' => $model]);
             return responseError("Erro HTTP: " . $e->getMessage(), [], ['status'  => $e->getCode(), 'prompt' => $prompt, 'model' => $model]);
        } catch (\Exception $e) {
            return responseError( "Erro inesperado: " . $e->getMessage(), [], ['status'  => $e->getCode(), 'prompt' => $prompt, 'model' => $model]);
        }
    }
}
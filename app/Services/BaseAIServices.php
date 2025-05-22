<?php

namespace App\Services;

abstract class BaseAIServices {
    /**
     * Summary of client
     * @var object
     * get a curlrequest class 
     */
    protected $client;
    /**
     * Summary of apiKey
     * @var string 
     * get a apikey value
     */
    protected $apiKey;
    /**
     * Summary of headers
     * @var array
     */
    protected $headers;
    /**
     * Summary of api_url
     * @var string
     * get url value
     */
    protected $api_url;
    /**
     * Summary of provider
     * @var string
     * get ai provider
     */
    protected $provider;
    /**
     * Summary of model
     * @var string
     * get ai model
     */
    protected $model;

    /**
     * Summary of __construct
     * @param string $api_url
     * @param string $api_key
     * @param CURLRequest $client
     */
    public function __construct(string $api_url,string $api_key, $client){
        $this->api_url = $api_url;
        $this->apiKey =  $api_key;
        $this->client =  $client; 
    }

    /**
     * Cria o header para fazer a requisição curl
     * @param null não há necessário de parametros
     * @return array
     */
    abstract protected function getHeaders():array;

    /**
     * Monta o payload de acordo com o modelo e prompt
     * 
     * @param string $prompt
     * @param string $model
     * @return array
     */
    abstract protected function buildPayload(string $prompt, string $model): array;

    protected function getPrompt(): string{
        return 'Você é um assistente técnico. Quando receber uma mensagem de erro, analise a causa, explique o que está errado e forneça um exemplo funcional de código que resolve ou evita esse problema, usando boas práticas de programação.

                - Responda **exclusivamente** em JSON com as seguintes chaves:
                * "descricao" (explicação clara e objetiva do erro)
                * "sugestao" (como corrigir ou evitar o erro)
                * "codigo_exemplo" (exemplo funcional de código, formatado como **uma única string JSON válida**, com **quebras de linha escapadas com `\\n`** e todas as **barras invertidas escapadas como `\\\\`**)

                - O campo "codigo_exemplo" deve conter apenas o código puro (sem marcação Markdown como ```php ou ```javascript e etc, sem usar <?php fora da string).

                - Nunca inclua texto fora do JSON.

                - Use sempre **aspas duplas** para as chaves e valores do JSON.

                - Se identificar que o texto **não contiver um erro técnico**, responda com:
                * "piada": uma mensagem leve e bem-humorada, dentro de um JSON válido.

                - Certifique-se de que a resposta seja um **JSON válido completo**, com todas as chaves exigidas.

                Aqui está o texto para analisar:';
    }

    public function chatCompletions(string $prompt, string $model): array
    {
        if (!$this->isValidModel($model)) {
            return [
                'success' => false,
                'message' => "Modelo inválido para este provedor: {$model}",
            ];
        }

        try {
            $response = $this->client->post(
                "{$this->api_url}/chat/completions",
                [
                    'headers' => $this->getHeaders(),
                    'json'    => $this->buildPayload($prompt, $model),
                ]
            );

            $statusCode = $response->getStatusCode();
            $body = json_decode($response->getBody(), true);

            if ($statusCode >= 200 && $statusCode < 300) {
                return responseSuccess($body['choices'][0]['message']['content'], [], ['status'  => $statusCode, 'prompt' => $prompt, 'model' => $model]);
            }
            return responseError( $body['error']['message'] ?? 'Erro desconhecido na API', [], ['status'  => $statusCode, 'prompt' => $prompt, 'model' => $model]);


        } catch (\CodeIgniter\HTTP\Exceptions\HTTPException $e) {
             return responseError("Erro HTTP: " . $e->getMessage(), [], ['status'  => $e->getCode(), 'prompt' => $prompt, 'model' => $model]);
        } catch (\Exception $e) {
            return responseError( "Erro inesperado: " . $e->getMessage(), [], ['status'  => $e->getCode(), 'prompt' => $prompt, 'model' => $model]);
        }
    }
}
?>
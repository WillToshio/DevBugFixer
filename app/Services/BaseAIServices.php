<?php

namespace App\Services;

abstract class BaseAIServices {
    /**
     * Summary of client
     * @param object
     * get a curlrequest class 
     */
    protected $client;
    /**
     * Summary of apiKey
     * @param string 
     * get a apikey value
     */
    protected $apiKey;
    /**
     * Summary of headers
     * @param array
     */
    protected $headers;
    /**
     * Summary of api_url
     * @param string
     * get url value
     */
    protected $api_url;
    /**
     * Summary of provider
     * @param string
     * get ai provider
     */
    protected $provider;
    /**
     * Summary of model
     * @param string
     * get ai model
     */
    protected $model;

    /**
     * Summary of __construct
     * @param string $api_url
     * @param string $api_key
     * @param CURLRequest $client
     * @param array $header
     */
    public function __construct(string $api_url,string $api_key,CURLRequest $client, array $heades){
        $this->api_url = $api_url;
        $this->apiKey =  $api_key;
        $this->client =  $client; 
        $this->headers = $heades;
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
        return "Você é um assistente especialista em análise e diagnóstico de problemas relacionados à programação e desenvolvimento de software em geral.  
                Seu trabalho é analisar mensagens, logs, códigos, erros ou textos relacionados a qualquer tecnologia, incluindo backend, frontend, DevOps, bancos de dados, APIs, infraestrutura, sistemas operacionais, redes, entre outros.  

                - Se identificar que o texto descreve um erro ou problema técnico, explique claramente qual é o problema, sua causa provável e forneça a melhor solução ou procedimento para corrigir ou evitar esse erro.  
                - Se o texto não contiver um erro ou problema técnico, responda de forma leve e humorada para manter o diálogo descontraído.  
                - Sempre que possível, forneça exemplos práticos, boas práticas ou recomendações para ajudar o usuário a resolver o problema ou entender melhor o contexto.
                - Sempre que possível, forneça a resposta na mesma lingua da pergunta
                Aqui está o texto para analisar: ";
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
                    'headers' => $this->headers,
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
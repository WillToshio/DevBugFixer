<?php 

namespace App\Services;

class OpenAIServices {
    /**
     * Summary of client
     * @object
     * get a curlrequest class 
     */
    protected $client;
    /**
     * Summary of apiKey
     * @string 
     * get a apikey value
     */
    protected $apiKey;
    /**
     * Summary of headers
     * @array
     */
    protected $headers;
    /**
     * Summary of api_url
     * @string
     * get url value
     */
    protected $api_url;

    /**
     * Summary of __construct
     * get apiKey value from env and
     * start value of api url
     * save curl client on local variable
     */
    public function __construct(){
        $this->api_url = getenv('openAIURL');
        $this->apiKey = getenv('openAISecretKey');
        $this->client = \Config\Services::curlrequest(); 
    }

    protected function getHeaders(): array{
        $this->headers = [
            'Authorization' => "Barear {$this->apiKey}", 
            'Content-Type' => 'application/json',
        ];
        return $this->headers;
    }

    public function chatCompletions(string $prompt, string $model = 'gpt-4'){
        $response = $this->client->post("{$this->api_url}chat/completions", [
            'headers' => $this->headers,
            'json'    => [
                'model' => $model, 
                'message' => [
                    ['role' => 'user', 'content' => $prompt],
                ],
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        return $data['choices'][0]['message']['content'] ?? null;
    }
}
<?php

namespace App\Http\Clients;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CustomClient
{
    private $client;

    protected $baseUri;

    protected $version;

    protected $token;

    public function __construct()
    {
        $this->setClientAtt();
    }

    public function getBaseUri()
    {
        return $this->baseUri;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setBaseUri($baseUri)
    {
        $this->baseUri = $baseUri;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * Set all default Client's Attributes
     * 
     * @return void
     */
    public function setClientAtt()
    {
        $this->baseUri = getenv('CLIENT_BASE_URL');
        $this->token = getenv('CLIENT_TOKEN');
        $this->version = 'v1';

        $this->client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->token,
            ],
        ]);
    }

    /**
     * Make a client request to a Custom API
     * 
     * @param string $endpoint The API endpoint to make the request to.
     * @param string $method The HTTP method of the request (e.g., 'GET', 'POST', etc.).
     * 
     * @return array The API response data decoded in JSON format.
     */
    public function makeRequest(string $endpoint, string $method, array $headers = [], array $body = []): array
    {
        $url = "{$this->baseUri}/{$this->version}/{$endpoint}";
		$options = [];
        if (!empty($headers)) {
            $options['headers'] = array_merge($options['headers'], $headers);
        }

		if (!empty($body)) {
			$options['json'] = $body;
		}
        $response = $this->client->request($method, $url, $options);

        return json_decode($response->getBody(), true);
    }
}

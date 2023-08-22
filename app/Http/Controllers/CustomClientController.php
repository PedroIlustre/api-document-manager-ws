<?php

namespace App\Http\Controllers;

use App\Http\Clients\CustomClient;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CustomClientController extends Controller
{
    private $CustomClient;

    const HTTP_METHOD_GET = 'GET';

    const HTTP_METHOD_POST = 'POST';

    const HTTP_METHOD_PUT = 'PUT';
    
    const HTTP_METHOD_DELETE = 'DELETE';

    public function __construct()
    {
        $this->setCustomClient();
    }

    public function setCustomClient()
    {
        $this->CustomClient = new CustomClient();
    }

    public function getAccessToken(Request $request)
    {
        return true;
    }
}

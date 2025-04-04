<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{  
  
    public function getMonitors()
    {
        // $apiKey = 'm780046935-55babfe51d76314eadf9db37';
        // $response = Http::withHeaders([
        //     'Content-Type' => 'application/json'
        // ])->post('https://api.uptimerobot.com/v2/getMonitors', [
        //     'api_key' => $apiKey,
        //     'format' => 'json',
        //     'custom_uptime_ratios' => '30', // Add custom uptime ratios
        //     'logs' => '1', // Add logs if 
        // ]);

        // $data = $response->json();
//dd($data);
      //  return view('backend.api.indexApi', compact('data'));
        return view('backend.api.indexApi');
        
    
        }    
}

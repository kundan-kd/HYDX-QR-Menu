<?php
namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{  
  
    public function getMonitors(){
        $apiKey = 'm780046935-55babfe51d76314eadf9db37';
        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post('https://api.uptimerobot.com/v2/getMonitors', [
            'api_key' => $apiKey,
            'format' => 'json',
             'custom_uptime_ratios' => '7',
        ]);
        $data = $response->json();
        return view('backend.api.indexApi', compact('data'));
        }   
        
    public function getMonitors_duration_30(){
        $apiKey = 'm780046935-55babfe51d76314eadf9db37';
        $response2 = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post('https://api.uptimerobot.com/v2/getMonitors', [
            'api_key' => $apiKey,
            'format' => 'json',
            'custom_uptime_ratios' => '30',
        ]);
        $data2 = $response2->json();
        return response()->json(['success'=>'Data2 Fetched Successfully','data'=>$data2],200);
        }
        
      public function getMonitors_duration_365(){
        $apiKey = 'm780046935-55babfe51d76314eadf9db37';
        $response3 = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post('https://api.uptimerobot.com/v2/getMonitors', [
            'api_key' => $apiKey,
            'format' => 'json',
            'custom_uptime_ratios' => '365',
        ]);
        $data3 = $response3->json();
        return response()->json(['success'=>'Data3 Fetched Successfully','data_365'=>$data3],200);
        }    
        
    public function getMonitors_duration_custom(Request $request){
        $start = $request->start_date;
        $end = $request->end_date;
        $apiKey = 'm780046935-55babfe51d76314eadf9db37';
        $response4 = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post('https://api.uptimerobot.com/v2/getMonitors', [
            'api_key' => $apiKey,
            'format' => 'json',
            'custom_uptime_ranges' => $start.'_'.$end,
            'logs' => 1
        ]);
        $data4 = $response4->json();
        return response()->json(['success'=>'Data4 Fetched Successfully','custom_data'=>$data4],200);
    }    
}

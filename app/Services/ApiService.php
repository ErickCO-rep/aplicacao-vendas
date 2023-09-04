<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiService
{

    
    public function connectApi($data = '', $parameter){
       
        $response = '';
         
        switch ($parameter) {
            case 'sales':           

                $response = Http::get(url:'http://api-vendas/api/sellers/'.$data.'/sales');
                // dd(json_decode($response));

                break;

            case 'seller':
                
                $response = Http::get(url:'http://api-vendas/api/sellers');
                
                break;

            case 'createSellers':

                $response = Http::post('http://api-vendas/api/sellers',$data);

                break;

            case 'createSales':
                
                $response = Http::post('http://api-vendas/api/sales',$data);

                break;

            default:
                // code...
                break;
        }

        return json_decode($response);

    }
}

?>
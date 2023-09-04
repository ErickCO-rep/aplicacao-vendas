<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;

class SellersController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index(Request $request){
        
        $viewName = $request->route()->getName();
        
        $response = $this->apiService->connectApi('','seller');
        $response->seller = []; 
        $response->sales = []; 

        return view($viewName, ['ViewModel' => $response]);
    }

    public function createSeller(Request $request) {

        try {
            $request->validate([
                'name' => 'required',
                'email' => [
                    'required',
                    'email',
                ],
            ]);
        
            $response = $this->apiService->connectApi($request->all(),'createSellers');
                                    
            if(!empty($response->errors)){

                session()->flash('warning', 'Ocorreram erros ao inserir os dados: '. $response->errors->email[0]);

                return redirect()->route('sellerCreate');
                
            }

            session()->flash('success', 'Vendedor inserido com sucesso!');

            return redirect()->route('sellerCreate');

        } catch (\Illuminate\Validation\ValidationException $e) {

            $errors = $e->validator->errors()->toArray();
            
            session()->flash('warning', 'Ocorreram erros ao inserir os dados: '. $errors['seller_id'][0]);

            return redirect()->route('sellerCreate');

        }

    }

    public function getSeller() {
        
        try {

            $response = $this->apiService->connectApi('','seller');
            
            foreach($response->sellers as $sellers){
                $sellers->commission = 'R$ '.number_format($sellers->commission, 2, ',', '.');
            }
            
            session()->flash('success', 'Busca efetuada com sucesso!');
            
            return view('sellerList', ['ViewModel' => $response]);

        } catch (\Illuminate\Validation\ValidationException $e) {

            $errors = $e->validator->errors()->toArray();

            session()->flash('warning', 'Ocorreram erros ao tentar buscar os dados: '. $errors['seller_id'][0]);

            return view('sellerList', ['ViewModel' => '']);

        }

        return view('sellerList', ['ViewModel' => '']);

    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;
use Carbon\Carbon;
use App\Mail\Report;
use Illuminate\Support\Facades\Mail;

class SalesController extends Controller
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

    public function createSale(Request $request) {

        try {
            $request->validate([
                'seller_id' => 'required',
                'value' => [
                    'required'
                ],
            ]);
        
            session()->flash('success', 'Venda inserida com sucesso!');

            $response = $this->apiService->connectApi($request->all(),'createSales');

            return redirect()->route('saleCreate');

        } catch (\Illuminate\Validation\ValidationException $e) {

            $errors = $e->validator->errors()->toArray();
            
            session()->flash('warning', 'Ocorreram erros ao tentar buscar os dados: '. $errors['seller_id'][0]);

            return redirect()->route('saleCreate');

        }

    }

    public function getSale(Request $request) {
        
        try {
            $request->validate([
                'seller_id' => 'required',
            ]);
            
            $listSellers = $this->apiService->connectApi('','seller');
            
            $response = $this->apiService->connectApi($request->seller_id,'sales');
            
            if(!empty($response->error)){

                session()->flash('warning', 'Ocorreram erros ao tentar buscar os dados: '. $response->error);

                return view('saleList', ['ViewModel' => '']);
                
            }

            $response->sellers = $listSellers->sellers;
            
            foreach($response->sales as $sales){
                $dataHora = Carbon::parse($sales->created_at); 
                
                $sales->created_at = $dataHora->format('d/m/Y H:i:s');

                $sales->value = 'R$ '.number_format($sales->value, 2, ',', '.');

                $sales->commission = 'R$ '.number_format($sales->commission, 2, ',', '.');
            }
            
            foreach($listSellers->sellers as $list){
                
                if($list->id == $request->seller_id){

                    $response->seller->commission = $list->commission;

                    $response->seller->commission = 'R$ '.number_format($response->seller->commission, 2, ',', '.');
                }
            }

            session()->flash('success', 'Busca efetuada com sucesso!');
            
            return view('saleList', ['ViewModel' => $response]);

        } catch (\Illuminate\Validation\ValidationException $e) {

            $errors = $e->validator->errors()->toArray();

            session()->flash('warning', 'Ocorreram erros ao tentar buscar os dados: '. $errors['seller_id'][0]);

            return view('saleList', ['ViewModel' => '']);

        }

        return view('saleList', ['ViewModel' => '']);

    }

    public function createReport() {

        $today = Carbon::now('America/Sao_Paulo');

        $formatedToday = $today->format('d/m/Y');

        $response = $this->apiService->connectApi('','seller');

        $sumValue = 0;
        $sumCommission = 0;
        foreach($response->sellers as $sellers){

            $response = $this->apiService->connectApi($sellers->id,'sales');

            if(!empty($response->sales)){
                foreach($response->sales as $sales){
                    
                    $date = Carbon::parse($sales->created_at); 
                    
                    $sales->created_at = $date->format('d/m/Y');

                    if($formatedToday == $sales->created_at){
                        $sumValue += (float)$sales->value; 
                        $sumCommission += (float)$sales->commission; 
                    }
                }           
            }
        }
        $report['date'] = $formatedToday;
        $report['value'] = $sumValue;
        $report['commission'] = $sumCommission;
        
        $mailable = new Report($report);

        $to = [
            'erick.coste@gmail.com',
            'ki_ki_costa@hotmail.com',
            ];

        $report = Mail::to($to)->send($mailable);
        
        return "Relatório enviado com sucesso!";

    }

}

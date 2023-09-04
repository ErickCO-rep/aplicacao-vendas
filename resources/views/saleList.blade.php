@extends('layout.layout')

@section('content')
    <h1 class="mt-4">Listar Vendas</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif

    @if($ViewModel)
        <form method="POST" action="{{ route('getSale') }}" class="mt-4">
            @csrf
            <div class="form-group">
                <label for="seller_id">Vendedor:</label>
                <select class="form-control select" id="seller_id" name="seller_id">
                    <option value="">Selecione um vendedor</option>
                    @foreach($ViewModel->sellers as $seller)
                        <option value="{{$seller->id}}">{{$seller->name}}</option>
                    @endforeach
                    </select>
            </div>
            <button type="submit" class="btn btn-primary">Buscar Vendas</button>
        </form>
        <hr>
        <!-- se tem vendas -->
        @if ($ViewModel->sales)
            @if($ViewModel->seller)
            <!-- <div class="row"> -->
                <span><strong>ID :</strong> {{$ViewModel->seller->id }}</span></br></br>
                <span><strong>Nome :</strong> {{$ViewModel->seller->name }}</span></br></br>
                <span><strong>Email :</strong> {{$ViewModel->seller->email }}</span></br></br>
                <span><strong>Comissão total :</strong> {{$ViewModel->seller->commission }}</span></br></br>
            <!-- </div>  -->
            @endif
            <table class="table table-bordered mt-4" id="datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <!-- <th>Nome</th> -->
                        <th>Valor da Venda</th>
                        <th>Comissão</th>
                        <th>Data da Venda</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ViewModel->sales as $sales)
                        <tr>
                            <td>{{$sales->id}}</td>
                            <td>{{$sales->value}}</td>
                            <td>{{$sales->commission}}</td>
                            <td>{{$sales->created_at}}</td>
                            <!-- <td>{{$sales->id}}</td> -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @else
        <button type="button" onclick="back()" class="btn btn-primary">Tentar novamente</button>
    @endif

    <script>
        function back(){
            window.location.href = "/saleList";
        }
    </script>
@endsection
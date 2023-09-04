@extends('layout.layout')

@section('content')
    <h1 class="mt-4">Criar Venda</h1>
    
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

    <form method="POST" action="{{ route('postSale') }}" class="mt-4">
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

        <div class="form-group">
            <label for="value">Valor da Venda:</label>

            <input type="text" class="form-control"  id="value" name="value" placeholder="Digite apenas números inteiros" oninput="validarNumerosInteiros(this)" required>
        </div>

        <button type="submit" class="btn btn-primary">Lançar Venda</button>
    </form>
@endsection
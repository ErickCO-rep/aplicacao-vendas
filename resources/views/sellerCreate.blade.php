@extends('layout.layout')

@section('content')
    <h1 class="mt-4">Criar Vendedor</h1>

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
    
    <form method="POST" action="{{ route('postSeller') }}" class="mt-4">
        @csrf
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nome do Vendedor" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email do Vendedor" required>
        </div>

        <button type="submit" class="btn btn-primary">Criar</button>
    </form>
@endsection
@extends('layout.layout')

@section('content')
    <h1 class="mt-4">Listagem de Vendedores</h1>
    
    @if(!empty($ViewModel->sellers))
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Comissão</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ViewModel->sellers as $sellers)
                <tr>
                    <td>{{$sellers->id}} </td>
                    <td>{{$sellers->name}} </td>
                    <td>{{$sellers->email}} </td>
                    <td>{{$sellers->commission}} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else

    <div class="row">
        <h2>Nenhum vendedor encontrado.</h2>
    </div>

    @endif
@endsection
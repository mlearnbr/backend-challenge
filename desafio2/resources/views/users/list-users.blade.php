@extends('layout/header')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Usuários</h2>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Nivel de acesso</th>
                        <th scope="col" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-outline-success">Upgrade</button>
                            <button type="button" class="btn btn-outline-danger">Downgrade</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection


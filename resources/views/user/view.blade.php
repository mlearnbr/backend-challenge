@extends('layout.layout')
@section('content')
    <section id="quiz">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                </div>
            </div>
            <div class="row justify-content-center align-items-center mt-5">
                <div class="col-12 col-sm-4">
                    <div class="card">
                        <div class="card-header text-center">
                            <h1 class="primary">Novo usuário</h1>
                        </div>
                        <div class="card-body">
                            <form action="/user/add" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="inputAddress">Nome</label>
                                    <input type="text" class="form-control" id="nome" name="no_usuario" placeholder="Seu nome">
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress2">Email</label>
                                    <input type="text" class="form-control" id="email" name="ds_email" placeholder="Seu e-mail">
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress2">Telefone</label>
                                    <input type="text" class="form-control" id="telefone" name="nu_telefone" placeholder="+5531999999999">
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress2">Senha</label>
                                    <input type="password" class="form-control" id="senha" name="ds_password" placeholder="No mínimo 6 caracteres">
                                </div>
                                <button type="submit" class="btn btn-custom-primary btn-block">Cadastrar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

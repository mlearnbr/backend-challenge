@extends('layout/header')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Cadastrar Usuário</h2>
        </div>
        <div class="card-body">
            <!-- erros de validação -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="/api/createuser">
                <!-- Token crsf -->
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Nome:</label>
                    <input type="text" class="form-control" name="name" required>
                    <div class="error">teste</div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Telefone:</label>
                    <input type="number" class="form-control" name="msisdn" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password">
                    <!-- <small id="emailHelp" class="form-text text-muted">.</small> -->
                </div>
                <div class="form-group">
                    <label>Nível de acesso:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="access_level" value="free" checked>
                        <label class="form-check-label">
                            Free
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="access_level" value="premium">
                        <label class="form-check-label">
                            Premium
                        </label>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
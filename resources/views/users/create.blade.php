@extends("layouts.app")
@section("content")

    <form action="{{ route('user.store') }}" method="post">
        @csrf
        <div class="card">
            <div class="card-header">
                <h5>Cadastro de usuários</h5>
            </div>
            <div class="card-body">
                @include('users.components.form')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    Salvar
                </button>
            </div>
        </div>
    </form>
@endsection

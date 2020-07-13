@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h2>1 - Desafio Lógico</h2>
                    <pre>
function diagonalsDiff( $array = array() ) {
    // Define as variáveis
    $first_diag = $second_diag = 0; 
    // Cria um loop para definir as diagonais
    foreach($array as $index => $sub_array){ 
        $first_diag += $sub_array[$index]; 
        $second_diag += $sub_array[count($array) - $index - 1];
    }
    // Retorna o resultado da diferença entre as diagonais
    return $first_diag - $second_diag; 
}

$array = array(
    array(1,2,3),
    array(4,5,6),
    array(9,8,9)
); 

echo diagonalsDiff($array);
                    </pre>
                    <form method="POST" action="{{ route('home') }}">
                        @csrf
                        <button type="submit" class="btn btn-lg btn-primary">Testar função</button>
                        @if (isset($result))
                        <strong>Resultado: </strong> {{ $result }}
                        @endif
                    </form>
                    <h2 class="mt-5 mb-4">2 - Desafio de Aplicação</h2>
                    <p>
                        <a href="{{ route('users.home') }}" class="btn btn-lg btn-primary">Listagem de usuários cadastrados</a>
                    </p>
                    <p class="text-muted">
                        O código fonte da aplicação está disponível no <a href="https://github.com/perrout/backend-challenge/tree/marcus-perrout" target="_blank">GitHub</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

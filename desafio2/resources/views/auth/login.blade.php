@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="msisdn" class="col-md-4 col-form-label text-md-right">Fone (msisdn)</label>
                            <div class="col-md-6">
                                <input id="msisdn" type="text" maxLength='14' class="form-control @error('msisdn') is-invalid @enderror" name="msisdn" value="{{ old('msisdn') }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">                               
                            </div>
                        </div>                        
                        <div class="form-group row mb-0">
                            <div class="col-md-2 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Entrar
                                </button>
                            </div>                            
                            <div class="col-md-4 ">
                                <a class="btn btn-primary" href="{{ route('register') }}">Cadastre-se</a>                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type='text/javascript'>    
    $("#msisdn").keypress(function(e) {      
        var key = (window.event)?event.keyCode:e.which;            
        if( key == 43 || (key > 47 && key < 58)) {
            return true;    	
        } else {
            return (key == 8 || key == 0)?true:false;
            
        }
    });
    $('#msisdn').keyup(function(){
        let value = this.value;        
        if(value.substr(0, 1) != '+'){
            this.value = '+55'+this.value;
        }
    })    
</script>
@endsection

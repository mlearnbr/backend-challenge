<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the function result.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function diagonalsDiff()
    {
        // Define as variáveis
        $array = array(
            array(1,2,3),
            array(4,5,6),
            array(9,8,9)
        ); 
        $first_diag = $second_diag = 0; 
        // Cria um loop para definir as diagonais
        foreach($array as $index => $sub_array){ 
            $first_diag += $sub_array[$index]; 
            $second_diag += $sub_array[count($array) - $index - 1];
        }
        // Retorna o resultado da diferença entre as diagonais
        $result = $first_diag - $second_diag; 
        return view('home', ['result' => $result]);
    }
}
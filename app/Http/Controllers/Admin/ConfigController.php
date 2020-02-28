<?php

namespace App\http\Controllers\Admin;

use App\http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ConfigController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }
    public function index(Request $request){
        // $users = Auth::user();// pegar o usuario que esta logado
        $user = $request->user();// pegar o usuario usando o request
        $nome = $user->name;

      


        $idade = 90;

        $lista = [
            'farinha',
            'ovo',
            'leite'
        ];

        $data = [
            'nome' => $nome,
            'idade' => $idade,
            'lista'=>$lista,
            'showform' =>Gate::allows('see-form')

        ];
            return view('admin.config',$data);
        // $estado = $request->input('estado','SP');
        // $nome = $request->input('nome','Visitante');
        // $method = $request->method();

        // $dados = $request->only(['nome','idade']);
        // echo "Meu nome é ".$nome." e o metofo é ".$method;

        // $cidade = $request->query('cidade','São Paulo');
        // echo "Cidade ".$cidade;
    }
    public function info(){
        echo "Configurações INFO 3";
    }
    public function permissoes(){
        echo 'Configurações PERMISSOES 3';
    }

}

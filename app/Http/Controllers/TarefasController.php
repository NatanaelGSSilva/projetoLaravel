<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TarefasController extends Controller
{
    public function list(){
        // $list=DB::select('SELECT * FROM tarefas WHERE resolvido = ?',[1]);trazer somente os resolvidos
        $list=DB::select('SELECT * FROM tarefas');
        
        return view('tarefas.list',[
            'list'=>$list
        ]);
    }
    public function add(){

        return view('tarefas.add');
    }
    public function addAction(Request $request){// recebo os dados do formulario
      
            $request->validate([
                'titulo'=>['required','string'] // soqueremos dizer que ele é umcampo obrigatorio é uma string
            ]);
            $titulo = $request->input('titulo');// pegando o valor e salvando na variavel

            DB::insert('INSERT INTO tarefas (titulo) VALUES (:titulo)',[
            'titulo'=>$titulo
            ]);

            return redirect()->route('tarefas.add')->with('warning','Você não preencheu o titulo');
        
    }
    public function edit($id){
        $data = DB::select('SELECT * FROM tarefas WHERE id = :id',[// pegar os dados desse item especifico
            'id'=>$id// receber da rota aqui oid
        ]);

        if(count($data)>0){
        return view('tarefas.edit', [
            'data'=> $data[0]
        ]);
        }else{
            return redirect()->route('tarefas.list');
        }
    }
    public function editAction(Request $request,$id){

        $request->validate([
            'titulo'=>['required','string'] // soqueremos dizer que ele é umcampo obrigatorio é uma string
        ]);

       
            $titulo = $request->input('titulo');

           DB::select('SELECT * FROM tarefas WHERE id = :id',[// pegar os dados desse item especifico
                'id'=>$id// receber da rota aqui oid
            ]);
    
          
            return redirect()->route('tarefas.list');
          
    }
    public function del($id){
        DB::delete('DELETE FROM tarefas WHERE id= :id', [
           'id'=>$id
        ]);
        return redirect()->route('tarefas.list');
    }
    public function done($id){
        // opção 1 : select + update
        // opcao 2 : update matematico

        DB::update('UPDATE tarefas SET resolvido = 1 - resolvido WHERE id = :id', [
            'id'=>$id
        ]);

        return redirect()->route('tarefas.list');
        //retorno
    }
}

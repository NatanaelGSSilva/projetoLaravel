<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Tarefa;

class TarefasController extends Controller
{
    public function list(){
        // $list=DB::select('SELECT * FROM tarefas WHERE resolvido = ?',[1]);trazer somente os resolvidos
        // $list=DB::select('SELECT * FROM tarefas');
        $list = Tarefa::all();
        
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

            // DB::insert('INSERT INTO tarefas (titulo) VALUES (:titulo)',[
            // 'titulo'=>$titulo
            // ]);

            $t = new Tarefa;
            $t->titulo = $titulo;// titulo vai receber a variavel titulo digitada pelo usuario
            $t->save();



            return redirect()->route('tarefas.list');
        
    }
    public function edit($id){
        // $data = DB::select('SELECT * FROM tarefas WHERE id = :id',[// pegar os dados desse item especifico
        //     'id'=>$id// receber da rota aqui oid
        // ]);

        $data = Tarefa::find($id);// sustitui a query abaixo (acha o proprio item)

        // if(count($data)>0){ // nao vai ver se teve mais um item
        if($data){// ele vai ver se teve o item
        return view('tarefas.edit', [
            'data'=> $data
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

        //    DB::select('UPDATE tarefas SET titulo = :titulo WHERE id  = :id',[// fazer a atualização
        //         'id'=>$id,// receber da rota aqui oid
        //         'titulo' =>$titulo
        //     ]);

                // $t = Tarefa::find($id);// achar o item
                // $t->titulo = $titulo;// atualzar
                // $t->save();// salvar

                Tarefa::find($id)->update(['titulo'=>$titulo]); // outra forma de fazer
    
          
            return redirect()->route('tarefas.list');
          
    }
    public function del($id){
        // DB::delete('DELETE FROM tarefas WHERE id= :id', [
        //    'id'=>$id
        // ]);

        Tarefa::find($id)->delete();
        return redirect()->route('tarefas.list');
    }
    public function done($id){
        // opção 1 : select + update
        // opcao 2 : update matematico

        // DB::update('UPDATE tarefas SET resolvido = 1 - resolvido WHERE id = :id', [
        //     'id'=>$id
        // ]);

        $t = Tarefa::find($id);// vai achar o carinha
        if($t){// se ele achou essa tarefa
        $t->resolvido = 1- $t->resolvido;
        $t->save();

        }
        return redirect()->route('tarefas.list');
        //retorno
    }
}

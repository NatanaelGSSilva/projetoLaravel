<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tarefa;

class HomeController extends Controller
{
   public function __invoke(){
       return view('welcome');
    //    $list = Tarefa::all();
    //    $list = Tarefa::where('resolvido',0)->get();
    //    foreach($list as $item){
    //        echo $item->titulo."<br/>";
   }
}

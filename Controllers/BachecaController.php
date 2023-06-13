<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
//use Request;
use Session;
use App\Models\foto;
use App\Models\mipiace;
use App\Models\commenti;
use App\Models\utente;


class BachecaController extends BaseController
{
    public function bacheca_view(){
        if(!Session::has('ID')){
            return redirect('index');
        } 
        return view('bacheca')->with('user', Session::get('user'));
    }

    public function best_foto(){
        if (!Session::has('ID')) {
            exit;
        }
        $foto = foto::withCount('mipiace')
            ->with('utente')
            ->orderByDesc('mipiace_count')
            ->first();

        return response()->json($foto);
    }

    public function foto_all(){
        if (!Session::has('ID')) {
            exit;
        }
        $fotos = foto::with('utente')->get();
        return response()->json($fotos);
    }

    //DA RIVEDERE
    public function foto_liked(){
        if (!Session::has('ID')) {
            exit;
        }
        $likes = mipiace::where('id_utente',Session::get('ID'))->pluck('id_foto')->toArray();
        return response()->json($likes);
    }

    public function num_like(){
        if (!Session::has('ID')) {
            exit;
        }
        $likes = mipiace::select('id_foto')
        ->selectRaw('COUNT(*) as num')
        ->groupBy('id_foto')
        ->get()
        ->toArray();
        return response()->json($likes); 
    }

    public function unlike(Request $request){
        if (!Session::has('ID')) {
            exit;
        }
        if(!$request->has('q')) {
            return response()->json(['message' => 'Non dovresti essere qui'], 400);
        }
        $like= mipiace::where('id_foto', $request->input('q'))->where('id_utente',Session::get('ID'))->delete();
    }

    public function like(Request $request){
        if (!Session::has('ID')) {
            exit;
        }
        if(!$request->has('q')) {
            return response()->json(['message' => 'Non dovresti essere qui'], 400);
        }
        $like= new mipiace;
        $like->id_foto=$request->input('q');
        $like->id_utente=Session::get('ID');
        $like->time=now();
        $like->save();
    }

   

    public function comment(Request $request){
        if (!Session::has('ID')) {
            exit;
        }
        if(!$request->has('q')) {
            return response()->json(['message' => 'Non dovresti essere qui'], 400);
        }
        $comments=commenti::with('utente')
                            ->where('id_foto', $request->input('q'))
                            ->get();
        return response()->json($comments); 
    }    

    public function insert_comment(Request $request){
        if (!Session::has('ID')) {
            exit;
        }
        $commento= new commenti;
        $commento->id_foto = $request->input('fotoID');//contiene l'id della foto, è un campo di input nascosto
        $commento->id_utente= Session::get('ID');
        $commento->time=now();
        $commento->descrizione= $request->input('comment');
        $commento->save();
    }

    

}
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


class HomeController extends BaseController
{
    public function home(){
        $id = Session:: get('ID');
        $user = Session:: get('user');
        return view('home')->with('id', $id)->with('user', $user);
    }

    public function ispirati(){
        $id = Session:: get('ID');
        $user = Session:: get('user');
        return view('cerca')->with('id', $id)->with('user', $user);
    }

    public function search(Request $request){
        $s = $request->input('search');
        if($s!=null){
            $ch=curl_init();
            $url="https://pixabay.com/api/?key=35639613-13f0d441c1f3a6eed2bda39be&q=".urlencode($s);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            $res=curl_exec($ch);
            curl_close($ch);
            return $res;   
        }
    }
    
    public function foto_all_nolog(){
        $photos = foto::select('foto')
                ->limit(6)
                ->get();

        return response()->json($photos);
    }
}


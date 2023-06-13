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


class LogController extends BaseController
{
    public function login_view(){
        return view('login');
    }
    
    public function login(Request $request){
        if(!empty($request->input('user'))&&!empty($request->input('pwd'))){
            $u=$request->input('user');
            $p=$request->input('pwd');
            $user = utente::where('user', $u)->first();
            $error=array();
            if(!$user){
                $error['user']="UTENTE NON TROVATO, RIPROVARE";
                return redirect("login")->withInput()->withErrors($error);
            }
            else{
                if(password_verify($p, $user->pwd)){
                    Session::put('ID', $user->id);
                    Session::put('user', $user->user);
                    return redirect('benvenuto');
                }
                else{
                    $error['pwd']="PASSWORD ERRATA, RIPROVARE";
                    return redirect("login")->withInput()->withErrors($error);
                }
            }
        }else{
            $error['empty']="COMPILARE TUTTI CAMPI";
            return redirect("login")->withInput()->withErrors($error);
        }  
    }

    public function log_view(){
        return view('log');
    }


    public function log(Request $request){
        $error=array();
        if(!empty($request->input('user'))&& !empty($request->input('pwd'))&& !empty($request->input('mail'))){
            $user=utente::where('user', $request->input('user'))->first();
            if($user){
                $error["user"]="username già in uso";
                return redirect("log")->withErrors($error)->withInput();
            }
            $mail=utente::where('mail', $request->input('mail'))->first();
            if($mail){
                $error["mail"]="mail già in uso";
                return redirect("log")->withErrors($error)->withInput();
            }
            Session::put('user', $request->input('user'));
            $utente = new utente;
            $utente->user = $request->input('user');
            $p = password_hash($request->input('pwd'), PASSWORD_BCRYPT); 
            $utente->pwd = $p;
            $utente->salt = ""; //per aumentare sicurezza delle password eventualmente
            $utente->mail = $request->input('mail');
            $utente->save();
            Session::put('ID', $utente->id);
            return response()->json(true);
        }
        return response()->json(false);
    }

    public function check_username(Request $request){
        if (!$request->has('q')) {
            return response()->json(['message' => 'Non dovresti essere qui'], 400);
        }
    
        $username = $request->input('q');
        $user = Utente::where('user', $username)->first();
    
        return response()->json(['exists' => $user ? true : false]);    
    }
    
    public function check_mail(Request $request){
        if (!$request->has('q')) {
            return response()->json(['message' => 'Non dovresti essere qui'], 400);
        }
    
        $mail = $request->input('q');
        $user = Utente::where('mail', $mail)->first();
    
        return response()->json(['exists' => $user ? true : false]);    
    }
    public function logout(){
        session()->flush();
        return redirect('index');
    }
}
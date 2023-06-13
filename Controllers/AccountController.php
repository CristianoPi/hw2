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


class AccountController extends BaseController
{
    //accessibile solo da loggati
    public function benvenuto(){
        if(!Session::has('ID')){
            return redirect('index');
        } 
        $user = Session:: get('user');
        return view('benvenuto')->with('user', $user);
    }

    public function account(){
        if(!Session::has('ID')){
            return redirect('index');
        }
        return view('account'); 
    }

    public function album (){
        if(!Session::has('ID')){
            return redirect('index');
        }
        return view('album');
    }

    //restituisce tutte le foto dell'utente poi verrano elaborate da album.js per farle vedere all'utente
    public function foto(){
        if(!Session::has('ID')){
            exit;
        }
        $foto = Foto::where('utente', session('ID'))->get();
        return $foto->toJson();
    }

    //eliminiamo la foto che l'utente ha deciso da eliminare attraverso il bottoone jsp
    public function delete_foto(Request $request){
        if(!Session::has('ID')){
            return response()->json(['message' => 'Non dovresti essere qui'], 400);
        }
        if(!$request->has('id')) {
            return response()->json(['message' => 'Non dovresti essere qui'], 400);
        }
        $id_utente=Session::get('ID');
        $id_foto=$request->input('id');
        $foto=foto::where('utente', $id_utente)->where('ID', $id_foto)->delete();
    }

    public function upload_view(){
        if(!Session::has('ID')){
            return redirect('index');
        }
        return view('upload')->with('corretto',"");
    }
    public function upload_foto(Request $request){
        if(!Session::has('ID')){
            exit;
        }
        $user=Session::get('user');
        if(!empty($request->input('luogo'))&&!empty($request->input('macchina'))&&!empty($request->input('obiettivo'))&&!empty($request->input('F'))&&!empty($request->input('iso'))&&!empty($request->input('T'))){
                    $allowedExt = array(IMAGETYPE_PNG => 'png', IMAGETYPE_JPEG => 'jpg');
                    
                    $n=''.rand(0,100000);
                    if(file_exists('foto_utenti/'.$user.$n.'.jpg'))
                        $name=$user.rand(0,100000).'.jpg';
                    else
                        $name=$user.$n.'.jpg';
                    $file = $request->file('foto');
                    //$tmp=$_FILES['foto']['tmp_name'];
                    $type =$file->getClientOriginalExtension();// exif_imagetype($file->path());//estensione immagine (caricare solo se è jpg o png)
                    if(in_array($type, $allowedExt))
                        move_uploaded_file($file,'foto_utenti/'.$name);
                    else
                        return view('upload')->with('corretto',"FOTO NON CARICATA CORRETTAMENTE");
                    // ------------------------------------------------------------------
                    $foto= new foto;
                    $foto->foto=$name;
                    $foto->luogo=$request->input('luogo');
                    $foto->Macchina=$request->input('macchina');
                    $foto->Obiettivo=$request->input('obiettivo');
                    $foto->F=$request->input('F');
                    $foto->iso=$request->input('iso');
                    $foto->esposizione=$request->input('T');
                    $foto->descrizione=$request->input('d');
                    $foto->utente=Session::get('ID');
                    $foto->ora=now();
                    $foto->Valore=0;
                    $foto->save();
                    return view('upload')->with('corretto',"FOTO CARICATA CORRETTAMENTE");
                }
    }

    public function change_user_view(){
        if(!Session::has('ID')){
            return redirect('index');
        }
        return view('change_user')->with('user',Session::get('user'));
    }
    public function change_user(Request $request){
        if(!Session::has('ID')){
           exit;
        }
        $id=Session::get('ID');
        if(!empty($request->input('user'))&&!empty($request->input('pwd'))){
            $user = utente::where('user', $request->input('user'))->first();
            $ris=array();
            if(!$user){
                $pwd=utente::where('id', $id)->first();
                if(password_verify($request->input('pwd'),$pwd->pwd )){
                    $newUser = $request->input('user');
                    utente::where('id', $id)->update(['user' => $newUser]);
                    $ris[0]=true;
                }
                else{
                    $ris[0]=false;
                }
            }
            else
                $ris[0]=false;

            return response()->json($ris);
        }
    }


    public function change_password_view(){
        if(!Session::has('ID')){
            return redirect('index');
        }
        return view('change_password')->with('user',Session::get('user'));
    }
    public function change_password(Request $request){
        if(!Session::has('ID')){
           exit;
        }
        $id=Session::get('ID');
        $ris =array();
        if(!empty($request->input('pwd_old'))&&!empty($request->input('pwd'))&&!empty($request->input('pwd_v'))){
            $user = utente::where('id', $id)->first();
            if($user){
                $pwd=utente::where('id', $id)->first();
                if(password_verify($request->input('pwd_old'), $pwd->pwd)){
                    $newPwd =  password_hash( $request->input('pwd'), PASSWORD_BCRYPT);
                    utente::where('id', $id)->update(['pwd' => $newPwd]);
                    $ris[0]=true;//diciamo a js che abbiamo effettuato la modifica
                }
                else
                    $ris[0]=false;
            }
            else
                $ris[0]=false;
        }
        else
            $ris[0]=false;
        return response()->json($ris);
    }
    public function delete_account(){
        if(!Session::has('ID')){
            return redirect('index');
        }
        $id_utente=Session::get('ID');
        $foto=utente::where('id', $id_utente)->delete();
        session()->flush();
        return redirect('index');
    }
    
}
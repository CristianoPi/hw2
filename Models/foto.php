<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class foto extends Model
{
    protected $table = 'foto';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    public function commenti()
    {
        return $this->hasMany("App\Models\commenti", "id_foto");
    }
    public function mipiace()
    {
        return $this->hasMany("App\Models\mipiace", "id_foto");
    }
    public function utente(){
        return $this->belongsTo("App\Models\utente", "utente");
    }
    
    //use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class utente extends Model
{
    protected $table = 'utente';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['user', 'pwd', 'salt', 'mail'];

    public function commenti()
    {
        return $this->hasMany("App\Models\commenti", "id_utente");
    }
    public function mipiace()
    {
        return $this->hasMany("App\Models\mipiace", "id_utente");
    }
    public function foto()
    {
        return $this->hasMany("App\Models\foto", "utente");
    }
    
    
    // use HasFactory;
}

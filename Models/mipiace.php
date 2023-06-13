<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mipiace extends Model
{
    protected $table = 'mipiace';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    public function utente()
    {
        return $this->belongsTo("App\Models\utente", "id_utente" );
    }
    public function foto()
    {
        return $this->belongsTo("App\Models\foto", "id_foto" );
    }
    //use HasFactory;
}

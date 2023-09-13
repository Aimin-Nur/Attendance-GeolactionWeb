<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    public $timestamps = false;
    protected $table = 'absen'; 
    protected $primaryKey = 'id';
    protected $fillable = [
        'NIP', 
        'tgl_absen', 
        'jam_in', 
        'foto_in', 
        'location', 
    ];
}

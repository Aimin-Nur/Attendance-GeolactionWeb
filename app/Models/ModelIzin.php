<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ModelIzin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "perizinan";
    protected $primaryKey = "id";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'NIP',
        'tgl_izin',
        'status',
        'keterangan',
        'status_approved',
        'updated_at'
    ];


}

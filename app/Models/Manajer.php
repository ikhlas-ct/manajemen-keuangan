<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manajer extends Model
{
    use HasFactory;


    protected $table = 'manajer';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_manajer',
        'alamat',
        'no_telepon',
        'id_user',
        
    ];
       public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}

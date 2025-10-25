<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admins';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_admin',
        'alamat',
        'no_telepon',
        'id_user',
    ];
       public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'admin_id', 'id');
    }

    

}

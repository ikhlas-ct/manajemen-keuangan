<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;


    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'type',
        'amount',
        'date',
        'description',
        'receipt_file',
        'admin_id',
        'category_id',

    ];
       public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Categorie::class, 'category_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Isler extends Model
{
    use HasFactory;

    protected $fillable = ['id','user_id', 'musteri_id', 'baslik', 'aciklama', 'not', 'son_tarih'];
    protected $table = 'isler';
}

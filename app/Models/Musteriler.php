<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Musteriler extends Model
{
    use HasFactory;

    protected $fillable = ['id','Unvan', 'YetkiliAdSoyad', 'VergiNumarasi', 'VergiDairesi', 'Telefon', 'EMail', 'Il', 'Ilce', 'Adres'];
    protected $table = 'musteriler';
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Musteriler extends Model
{
    use HasFactory;

    protected $fillable = ['Unvan', 'YetkiliAdSoyad', 'VergiNumarasi', 'VergiDairesi', 'Telefon', 'EMail', 'Il', 'Ilce', 'Adres'];
}

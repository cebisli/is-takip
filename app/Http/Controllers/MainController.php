<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Musteriler;

class MainController extends Controller
{
    function index()
    {
        return view('admin/index');
    }

    function musteriler()
    {
        $musteriler = Musteriler::orderBy('id')->get();
        return view('admin/musteriler', compact('musteriler'));
    }

    function MusteriKaydet(Request $request)
    {
        Musteriler::create([
            "Unvan" => $request->Unvan,
            "YetkiliAdSoyad" => $request->YetkiliAdSoyad,
            "VergiNumarasi" => $request->VergiNumarasi,
            "VergiDairesi" => $request->VergiDairesi,
            "Telefon" => $request->Telefon,
            "EMail" => $request->EMail,
            "Il" => $request->Il,
            "Ilce" => $request->Ilce,
            "Adres" => $request->Adres            
        ]);        

        return response()->json(['success'=>'Müşteri Ekleme Başarılı']);
        // return redirect()->route('musteriler');
    }
}

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
        return view('admin/musteriler');
    }

    function MusteriKaydet(Request $request)
    {
        DB::table('musteriler')->insert([
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

        return response()->json(['success'=>'Laravel ajax example is being processed.']);
        // return redirect()->route('musteriler');
    }
}

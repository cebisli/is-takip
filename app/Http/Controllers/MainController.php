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

    function MusteriBilgileri($id)
    {
        $musteri = Musteriler::whereId($id)->first();
        return response()->json(['success' => true, 'musteri'   => $musteri]);
    }

    function MusteriGuncelle(Request $request, $id)
    {
        $musteri = Musteriler::whereId($id)->first() ?? abort(404, 'Müşteri Bulunamadı');
        $musteri->update($request->all());
        return response()->json(['success'=>"Güncelleme Başarılı"]);
    }
    function MusteriSil($id)
    {
        $musteri = Musteriler::whereId($id)->first() ?? abort(404, 'Müşteri Bulunamadı');
        $musteri->delete();
        return redirect()->route('musteriler');
    }


    function MusteriGetFunction( $type = null, $id = null)
    {        
        if($type!=null && $type == 'delete')
            return $this->MusteriSil($id);
        if($type!=null && $type == 'show')
            return $this->MusteriBilgileri($id);
    }
}

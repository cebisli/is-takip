<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Isler;
use App\Models\Musteriler;
use Illuminate\Support\Str;

class IsTakipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->type != 'admin')        
            $isler = Isler::where('user_id',auth()->user()->id)->with('user','musteri')->get();
        else    
            $isler = Isler::with('user','musteri')->get();
        
        $kullanicilar = User::all();    
        $musteriler = Musteriler::all();
        return view('admin.is_takip_list', compact('isler','kullanicilar','musteriler'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sonuc = Isler::create($request->all());        
        if ($sonuc)
            $mesaj = 'Yapılacak işler arasına eklenmiştir.';
        else
            $mesaj = 'Yapılacak işin eklenmesi sırasında hata ile karşılaşıldı...';    

        return response()->json(['success'=>$mesaj]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  
        $isler = Isler::with('user','musteri')->find($id);
        if ($isler)
            return response()->json(['success' => true, 'obj'   => $isler]);
        else
            return response()->json(['success' => false, 'Kayıt Bulunamadı']);    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $is = Isler::find($id);
        if (! $is)        
            return response()->json(['success'=>'İş bulunamadı']);
            
        $sonuc = $is->update($request->all());
        if ($sonuc)
            $mesaj = 'Güncelleme Başarılı';
        else
            $mesaj = 'Güncelleme başarısız...';    

        return response()->json(['success'=>$mesaj]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

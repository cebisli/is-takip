<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function KullaniciListesi()
    {
        $users = User::orderBy('id')->get();
        return view('admin/kullanicilar', compact('users'));
    }

    function KullaniciGetFunction($type = null, $id = null)
    {
        if ($type!=null && $type == 'delete')
            return $this->KullaniciSil($id);
        elseif ( $type!=null && $type == 'show')
            return $this->KullaniciBilgileri($id);
    }

    function KullaniciBilgileri($id)
    {
        $user = User::whereId($id)->first();
        return response()->json(['success' => true, 'obj' => $user]);
    }

    function KullaniciSil($id)
    {
        $user = User::whereId($id)->first() ?? abort(404, 'Müşteri Bulunamadı');
        $user->delete();
        return redirect()->route('kullanicilar');
    }

    function UserKaydet(Request $request)
    {
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            'password' => Hash::make($request->pass_1),
            "pass_1" => $request->pass_1,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);        

        return response()->json(['success'=>'Kullanıcı Ekleme Başarılı']);
    }
}

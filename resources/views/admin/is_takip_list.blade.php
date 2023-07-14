@extends('admin.ana-yapi')
@section('title')
    İş Takip Sistemi
@endsection

@section('main')
    <div class="page-heading">
        <h3>İş Listesi</h3>
    </div>
    <div class="page-content">
        <section class="row">

            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-success btn-sm m-2 float-end" onclick="YeniMusteri()">Yeni Müşteri
                                    Ekle</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="Isler">
                                <colgroup>
                                    <col width="5%">
                                    <col width="20%">
                                    <col width="20%">
                                    <col width="15%">
                                    <col width="15%">
                                    <col width="10%">
                                    <col width="10%">
                                    <col width="5%">
                                </colgroup>
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Şirket Adı</th>
                                        <th>Şirket Yetkilisi</th>
                                        <th>Vergi Numarası</th>
                                        <th>Vergi Dairesi</th>
                                        <th>İl</th>
                                        <th>İlçe</th>
                                        <td>İşlemler</td>
                                    </tr>
                                </thead>
                                {{-- <tbody>
                                    @foreach ($isler as $is)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$musteri->Unvan}}</td>
                                            <td>{{$musteri->YetkiliAdSoyad}}</td>
                                            <td>{{$musteri->VergiNumarasi}}</td>
                                            <td>{{$musteri->VergiDairesi}}</td>
                                            <td>{{$musteri->Il}}</td>
                                            <td>{{$musteri->Ilce}}</td>
                                            <td> 
                                                <a class="btn btn-sm btn-warning" title="Düzenle" onclick="KayitDuzenle({{$musteri->id}})"><i class="fa fa-pen"></i></a>
                                                <a title="Müşteri Sil" href=" {{route('musteri_function', ['delete', $musteri->id] )}} " class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>    
                                            </td>
                                        </tr>
                                    @endforeach                                
                                </tbody> --}}
                            </table>                            
                        </div>
                    </div>
                </div>
            </section>

        </section>
    </div>

    {{-- <div id="YeniMusteri" title="Yeni Müşteri Kaydı" style="display: none;">
            <div class="controls">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Unvan">Şirket Adı *</label>
                            <input id="Unvan" type="text" name="Unvan" class="form-control"
                                placeholder="Lütfen şirket adını giriniz *" required="required">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="YetkiliAdSoyad">Yetkili *</label>
                            <input id="YetkiliAdSoyad" type="text" name="YetkiliAdSoyad" class="form-control"
                                placeholder="Lütfen şirket yetlisinin adını soyadını giriniz *" required="required">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="VergiNumarasi">Vergi Numarası *</label>
                            <input id="VergiNumarasi" type="text" name="VergiNumarasi" class="form-control"
                                placeholder="Lütfen vergi numarasını giriniz *" required="required">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="VergiDairesi">Vergi Dairesi</label>
                            <input id="VergiDairesi" type="text" name="VergiDairesi" class="form-control"
                                placeholder="Lütfen vergi dairesini giriniz">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Telefon">Telefon *</label>
                            <input id="Telefon" type="text" name="Telefon" class="form-control"
                                placeholder="Lütfen şirket telefonunu giriniz *" required="required">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="EMail">Email</label>
                            <input id="EMail" type="email" name="EMail" class="form-control"
                                placeholder="Lütfen email adresini giriniz">
                        </div>
                    </div>                   
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Il">İL</label>
                            <input id="Il" type="text" name="Il" class="form-control"
                                placeholder="Lütfen ili giriniz">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Ilce">İlçe</label>
                            <input id="Ilce" type="text" name="Ilce" class="form-control"
                                placeholder="Lütfen ilçeyi giriniz">
                        </div>
                    </div>                   
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="Adres">Adres</label>
                            <textarea id="Adres" name="Adres" class="form-control"
                                placeholder="Şirket Adresi" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-success btn-send  pt-2 btn-block modal-success-btn" value="Kaydet" id="MusteriKaydet">
                    </div>
                </div>
            </div>
    </div> --}}
@endsection
@section('js')
    <script>
        var tableId = "Isler";
        var ModalDivId = "YeniKullanici";
        let alanlar = ['name', 'email', 'pass_1'];

        $(function() {
            JsDataTable(tableId);
        });

        // function YeniKullanici() {            
        //     inputSifirla();
        //     ShowBSDialog(ModalDivId, null);    
        // }        

        // $("#Kaydet").click(function() {        
        //     var obj = { };

        //     var doldurulmayanAlanVarMi = '';
        //     for (var i = 0; i<alanlar.length; i++)
        //     {
        //         var inp = $('#'+alanlar[i]);
        //         var val =  inp.val();
        //         if ((val == '' || typeof val == 'undefined') && inp.attr('required'))
        //         {
        //             doldurulmayanAlanVarMi = inp.attr('placeholder');
        //             break;
        //         }
        //         obj[alanlar[i]] = val;
        //     }
        //     if (doldurulmayanAlanVarMi != '')
        //         return ShowWarning(doldurulmayanAlanVarMi);

        //     var musteriId = $('#DetayId').val();
        //     var cb = function(e) {
        //         $(this).prop('disabled',true);              
        //         ShowInfo(e.success, function(){ 
        //             location.reload(); // sayfayı yenile
        //         });
        //     };

        //     if (musteriId > 0)            
        //         AjaxIslem("/admin/users/"+musteriId, obj, cb, 'POST');
        //     else
        //         AjaxIslem("{{  route('user_kaydet') }}", obj, cb, 'POST');

        //     $("#"+ModalDivId).find('#DetayId').remove();            
        // });

        // function KayitDuzenle(Id)
        // {
        //     AjaxIslem("/admin/users/show/"+Id, null, function(e) {                 
        //         if (e.success)
        //         {
        //             for (const property in e.obj) 
        //                 $('#'+property).val(e.obj[property]);                        
                         
        //             $('#'+ModalDivId).attr('title','Müşteri Düzenle');
        //             $("#Kaydet").val('Güncelle');
        //             $('#'+ModalDivId).find('#DetayId').remove();
        //             $('#'+ModalDivId).prepend('<input type="hidden" value="'+Id+'" id="DetayId">');
        //             ShowBSDialog(ModalDivId, null, Modal_Large);
        //         }
        //     });
        // }

        // function inputSifirla()
        // {                 
        //     for (var i = 0; i<alanlar.length; i++)            
        //         $('#'+alanlar[i]).val('');

        //     $('#'+ModalDivId).attr('title','Yeni Kullanıcı');
        //     $("#Kaydet").val('Kaydet');   
        //     $("#"+ModalDivId).find('#MusteriId').remove(); 
        // }
    </script>
@endsection
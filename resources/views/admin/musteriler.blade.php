@extends('admin.ana-yapi')
@section('title')
    İş Takip Sistemi
@endsection

@section('main')
    <div class="page-heading">
        <h3>Müşteriler</h3>
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
                            <table class="table" id="Musteriler">
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
                                <tbody>
                                    @foreach ($musteriler as $musteri)
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
                                </tbody>
                            </table>                            
                        </div>
                    </div>
                </div>
            </section>

        </section>
    </div>

    <div id="YeniMusteri" title="Yeni Müşteri Kaydı" style="display: none;">
            <div class="controls">
                <div class="row">
                    <x-input type="text" label="Şirket Adı" topclass='col-md-6' id='Unvan' placeholder="Lütfen şirket adını giriniz" required validate/>
                    <x-input type="text" label="Yetkili Adı Soyadı" topclass='col-md-6' id='YetkiliAdSoyad' placeholder="Lütfen şirket yetlisinin adını soyadını giriniz" required validate/>
                </div>
                <div class="row">
                    <x-input type="text" label="Vergi Numarasi" topclass='col-md-6' id='VergiNumarasi' placeholder="Lütfen vergi numarasını giriniz" required validate/>
                    <x-input type="text" label="Vergi Dairesi" topclass='col-md-6' id='VergiDairesi' placeholder="Lütfen vergi dairesini giriniz" required validate/>
                </div>
                <div class="row">
                    <x-input type="text" topclass='col-md-6' label="Telefon" id='Telefon' placeholder="Lütfen şirket telefonunu giriniz" required validate/>
                    <x-input type="email" topclass='col-md-6' label="Email" id='EMail' placeholder="Lütfen email adresini giriniz"/>                    
                </div>
                <div class="row">
                    <x-input type="text" topclass='col-md-6' label="İL" id='Il' placeholder="Lütfen ili giriniz"/>
                    <x-input type="text" topclass='col-md-6' label="İlçe" id='Ilce' placeholder="Lütfen ilçeyi giriniz"/>                                     
                </div>
                <div class="row">
                    <x-textarea type="text" label="Adres" topclass='col-md-12' id='Adres'/>                                   
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-success btn-send  pt-2 btn-block modal-success-btn" value="Kaydet" id="MusteriKaydet">
                    </div>
                </div>
            </div>
    </div>
@endsection
@section('js')
    <script>
        $(function() {
            JsDataTable('Musteriler');
        });

        function YeniMusteri() {            
            inputSifirla();
            ShowBSDialog('YeniMusteri', null, Modal_Large);    
        }        

        $("#MusteriKaydet").click(function() {     
            var alanlar = ['Unvan', 'YetkiliAdSoyad', 'VergiNumarasi', 'VergiDairesi','Telefon','EMail','Il','Ilce','Adres'];     
            var obj = { };

            var doldurulmayanAlanVarMi = '';
            for (var i = 0; i<alanlar.length; i++)
            {
                var inp = $('#'+alanlar[i]);
                var val =  inp.val();
                if ((val == '' || typeof val == 'undefined') && inp.attr('required'))
                {
                    doldurulmayanAlanVarMi = inp.attr('placeholder');
                    break;
                }
                obj[alanlar[i]] = val;
            }
            if (doldurulmayanAlanVarMi != '')
                return ShowWarning(doldurulmayanAlanVarMi);

            var musteriId = $('#MusteriId').val();
            var cb = function(e) { 
                $(this).prop('disabled',true);              
                ShowInfo(e.success, function(){ 
                    location.reload(); // sayfayı yenile
                });
            };

            if (musteriId > 0)            
                AjaxIslem("/admin/musteriler/"+musteriId, obj, cb, 'POST');
            else
                AjaxIslem("{{  route('musteri_kaydet') }}", obj, cb, 'POST');

            $("#YeniMusteri").find('#MusteriId').remove();            
        });

        function KayitDuzenle(Id)
        {
            AjaxIslem("/admin/musteriler/show/"+Id, null, function(e) {                 
                if (e.success)
                {
                    for (const property in e.musteri) 
                         $('#'+property).val(e.musteri[property]);                        
                         
                    $('#YeniMusteri').attr('title','Müşteri Düzenle');
                    $("#MusteriKaydet").val('Güncelle');
                    $("#YeniMusteri").find('#MusteriId').remove();
                    $("#YeniMusteri").prepend('<input type="hidden" value="'+Id+'" id="MusteriId">');
                    ShowBSDialog('YeniMusteri', null, Modal_Large);
                }
            });
        }

        function inputSifirla()
        {
            var alanlar = ['Unvan', 'YetkiliAdSoyad', 'VergiNumarasi', 'VergiDairesi','Telefon','EMail','Il','Ilce','Adres'];     
            for (var i = 0; i<alanlar.length; i++)            
                $('#'+alanlar[i]).val('');

            $('#YeniMusteri').attr('title','Yeni Müşteri');
            $("#MusteriKaydet").val('Kaydet');   
            $("#YeniMusteri").find('#MusteriId').remove(); 
        }
    </script>
@endsection

@extends('admin.ana-yapi')
@section('title')
    İş Takip Sistemi
@endsection

@section('main')
    <div class="page-heading">
        <h3>Kullanıcılar</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-success btn-sm m-2 float-end" onclick="YeniMusteri()">Yeni Kullanıcı Ekle</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="Musteriler">                                
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Ad</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            {{-- <td> 
                                                <a class="btn btn-sm btn-warning" title="Düzenle" onclick="KayitDuzenle({{$musteri->id}})"><i class="fa fa-pen"></i></a>
                                                <a title="Müşteri Sil" href=" {{route('musteri_function', ['delete', $musteri->id] )}} " class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>    
                                            </td> --}}
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

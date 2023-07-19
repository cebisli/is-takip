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
                                <button class="btn btn-success btn-sm m-2 float-end" onclick="YeniKayit()">Yeni Kayıt
                                    Ekle</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="Isler">
                                <colgroup>
                                    <col width="5%">
                                    <col width="5%">
                                    <col width="15%">
                                    <col width="15%">
                                    <col width="20%">
                                    <col width="20%">
                                    <col width="15%">
                                    <col width="5%">
                                </colgroup>
                                <thead class="table-light">                                    
                                    <tr>
                                        <th>No</th>
                                        <th>Durum</th>
                                        <th>İş Adı</th>
                                        <th>Sahibi</th>    
                                        <th>Şirket Adı</th>
                                        <th>Şirket Yetkilisi</th>
                                        <th>Son Tarihi</th>
                                        <th>İşlemler</th>
                                    </tr>                                    
                                </thead>
                                <tbody>
                                    @foreach ($isler as $i)      
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if($i->durum == 0) 
                                                    <span style="color:white; padding:5px; background-color:#B22222">  Başlanılmamış </span>
                                                @else  
                                                    <span style="color:white; padding:5px; background-color:#228B22">  Tamamlanmış </span>
                                                @endif
                                            </td>
                                            <td>{{$i->baslik}}</td>
                                            <td>{{$i->user->name}}</td>
                                            <td>{{$i->musteri->Unvan}}</td>
                                            <td>{{$i->musteri->YetkiliAdSoyad}}</td>
                                            <td>{{$i->son_tarih}}</td>
                                            <td>                                                
                                                <a class="btn btn-sm btn-warning" title="Düzenle" onclick="KayitDuzenle({{$i->id}})"><i class="fa fa-pen"></i></a>
                                                {{-- <a title="Müşteri Sil" href=" {{route('musteri_function', ['delete', $musteri->id] )}} " class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a> --}}
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

    <div id="YeniIs" title="Yeni İş Kaydı" style="display: none;">
            <div class="controls">
                <div class="row justify-content-between text-left">                    
                    <x-select type="text" label="Müşteriler" topclass='col-md-12 flex-column d-flex' id='durum' required validate onchange="TalepDurum()">
                        <option value="0" selected='selected'>Başlanılmamış</option>
                        <option value="1">Tamamlanmış</option> 
                    </x-select>
                </div>
                <div class="row justify-content-between text-left">                    
                    <x-select type="text" label="İşin Sahibi" topclass='col-md-6 flex-column d-flex' id='user_id' required validate>
                        <option value="-1">Seçiniz</option>
                        @foreach ($kullanicilar as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach 
                    </x-select>
                    <x-select type="text" label="Müşteriler" topclass='col-md-6 flex-column d-flex' id='musteri_id' required validate>
                        <option value="-1">Seçiniz</option>
                        @foreach ($musteriler as $musteri)
                            <option value="{{$musteri->id}}">{{$musteri->Unvan}}</option>
                        @endforeach 
                    </x-select>    
                </div>
                <div class="row justify-content-between text-left">
                    <x-input type="text" label="Başlık" topclass='col-md-12 flex-column d-flex' id='baslik' placeholder="Yapılacak İşin Başlığı" required validate/>
                </div>
                <div class="row justify-content-between text-left">
                    <x-textarea type="text" label="İşin Açıklaması" topclass='col-md-12 flex-column d-flex' id='aciklama' required validate/>
                </div>
                <div class="row justify-content-between text-left">
                    <x-textarea type="text" label="İş İle İlgili Notlar" topclass='col-md-12 flex-column d-flex' id='not'/>
                </div>
                <div class="row justify-content-between text-left">
                    <x-input type="datetime-local" label="Son Tarih" topclass='col-md-6 flex-column d-flex' id='son_tarih' value="{{ now()->setTimezone('T')->format('Y-m-dTh:m') }}"/>
                </div>                

                <div class="row">
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-success btn-send  pt-2 btn-block modal-success-btn" value="Kaydet" id="Kaydet">
                    </div>
                </div>
            </div>
    </div>
@endsection
@section('js')
    <script>
        var tableId = "Isler";
        var ModalDivId = "YeniIs";
        let alanlar = ['user_id','musteri_id','baslik', 'aciklama', 'not','durum', 'son_tarih'];

        $(function() {
            JsDataTable(tableId);
            TalepDurum();
        });

        function YeniKayit() {            
            inputSifirla();
            ShowBSDialog(ModalDivId, null, Modal_Large);    
        }        

        $("#Kaydet").click(function() {                    
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

            var DetayId = $('#DetayId').val();
            var cb = function(e) {
                $(this).prop('disabled',true);              
                ShowInfo(e.success, function(){ 
                    location.reload(); // sayfayı yenile
                });
            };

            var url = "{{ route('is_takip.store') }}";
            var method = 'POST';
            if (DetayId > 0)            
            {
                url = "{{ route('is_takip.update', ':id') }}";
                url = url.replace(':id', DetayId);
                method = 'PUT';
            }            
            AjaxIslem(url, obj, cb, method);    
            $("#"+ModalDivId).find('#DetayId').remove();            
        });

        function KayitDuzenle(Id)
        {
            var url = "{{ route('is_takip.edit', ':id') }}";
            url = url.replace(':id', Id);

            AjaxIslem(url, null, function(e) {                
                if (e.success)
                {
                    for (const property in e.obj) 
                        $('#'+property).val(e.obj[property]);                        
                         
                    $('#'+ModalDivId).attr('title','Kayıt Düzenle');
                    $("#Kaydet").val('Güncelle');
                    $('#'+ModalDivId).find('#DetayId').remove();
                    $('#'+ModalDivId).prepend('<input type="hidden" value="'+Id+'" id="DetayId">');

                    TalepDurum();

                    // Müşteriyi ve kullanıyıcı değiştirmesine izin vermiyoruz.
                    $('#user_id').attr('disabled','disabled');
                    $('#musteri_id').attr('disabled','disabled');

                    ShowBSDialog(ModalDivId, null, Modal_Large);
                }
            });
        }

        function inputSifirla()
        {                 
            for (var i = 0; i<alanlar.length; i++)
            {
                if (alanlar[i] != 'durum')            
                    $('#'+alanlar[i]).val('');
                else
                    $('#'+alanlar[i]).val('0');
            }

            $('#'+ModalDivId).attr('title','Yeni Kayıt');
            $("#Kaydet").val('Kaydet');   
            $("#"+ModalDivId).find('#MusteriId').remove(); 

            $('#user_id').removeAttr('disabled').val('-1');
            $('#musteri_id').removeAttr('disabled').val('-1');
            TalepDurum();
        }

        function TalepDurum()
        {
            var deger = $('#durum').val();
            if (deger == '0')
                $('#durum').css({'background-color':'#990033', 'color':'white'});            
            else
                $('#durum').css({'background-color':'#6495ED', 'color':'white'});
        }
    </script>
@endsection

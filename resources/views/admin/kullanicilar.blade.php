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
                                <button class="btn btn-success btn-sm m-2 float-end" onclick="YeniKullanici()">Yeni Kullanıcı Ekle</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="Users">                                
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Ad</th>
                                        <th>Email</th>
                                        <th>İşlemler</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td> 
                                                <a class="btn btn-sm btn-warning" title="Düzenle" onclick="KayitDuzenle({{$user->id}})"><i class="fa fa-pen"></i></a>
                                                <a title="Sil" class="btn btn-sm btn-danger" href="/admin/users/delete/{{$user->id}}" ><i class="fa fa-times"></i></a>    
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

    <div id="YeniKullanici" title="Yeni Kullanıcı Kaydı" style="display: none;">
            <div class="controls">
                <div class="form-group">
                    <label for="name">Kullanıcı Adı-Soyadı *</label>
                    <input id="name" type="text" class="form-control"
                        placeholder="Lütfen kullanıcı adını soyadını giriniz *" required="required">
                </div>
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input id="email" type="email" class="form-control"
                        placeholder="Lütfen kullanıcının email adresini giriniz" required="required">
                </div>
                <div class="form-group">
                    <label for="pass_1">Kullanıcı Parolası *</label>
                    <input id="pass_1" type="text" class="form-control"
                        placeholder="Lütfen parola oluşturunuz *" required="required">
                </div>                
                <input type="submit" class="btn btn-success btn-send  pt-2 btn-block modal-success-btn" value="Kaydet" id="Kaydet">                
            </div>
    </div>
@endsection
@section('js')
    <script>
        var tableId = "Users";
        var ModalDivId = "YeniKullanici";
        let alanlar = ['name', 'email', 'pass_1'];

        $(function() {
            JsDataTable(tableId);
        });

        function YeniKullanici() {            
            inputSifirla();
            ShowBSDialog(ModalDivId, null);    
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

            var musteriId = $('#DetayId').val();
            var cb = function(e) {
                $(this).prop('disabled',true);              
                ShowInfo(e.success, function(){ 
                    location.reload(); // sayfayı yenile
                });
            };

            if (musteriId > 0)            
                AjaxIslem("/admin/users/"+musteriId, obj, cb, 'POST');
            else
                AjaxIslem("{{  route('user_kaydet') }}", obj, cb, 'POST');

            $("#"+ModalDivId).find('#DetayId').remove();            
        });

        function KayitDuzenle(Id)
        {
            AjaxIslem("/admin/users/show/"+Id, null, function(e) {                 
                if (e.success)
                {
                    for (const property in e.obj) 
                        $('#'+property).val(e.obj[property]);                        
                         
                    $('#'+ModalDivId).attr('title','Müşteri Düzenle');
                    $("#Kaydet").val('Güncelle');
                    $('#'+ModalDivId).find('#DetayId').remove();
                    $('#'+ModalDivId).prepend('<input type="hidden" value="'+Id+'" id="DetayId">');
                    ShowBSDialog(ModalDivId, null, Modal_Large);
                }
            });
        }

        function inputSifirla()
        {                 
            for (var i = 0; i<alanlar.length; i++)            
                $('#'+alanlar[i]).val('');

            $('#'+ModalDivId).attr('title','Yeni Kullanıcı');
            $("#Kaydet").val('Kaydet');   
            $("#"+ModalDivId).find('#MusteriId').remove(); 
        }
    </script>
@endsection

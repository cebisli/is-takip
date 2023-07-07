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
                        <table class="table table-striped" id="Musteriler">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>City</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Graiden</td>
                                    <td>vehicula.aliquet@semconsequat.co.uk</td>
                                    <td>076 4820 8838</td>
                                    <td>Offenburg</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dale</td>
                                    <td>fringilla.euismod.enim@quam.ca</td>
                                    <td>0500 527693</td>
                                    <td>New Quay</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nathaniel</td>
                                    <td>mi.Duis@diam.edu</td>
                                    <td>(012165) 76278</td>
                                    <td>Grumo Appula</td>
                                    <td>
                                        <span class="badge bg-danger">Inactive</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Graiden</td>
                                    <td>vehicula.aliquet@semconsequat.co.uk</td>
                                    <td>076 4820 8838</td>
                                    <td>Offenburg</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dale</td>
                                    <td>fringilla.euismod.enim@quam.ca</td>
                                    <td>0500 527693</td>
                                    <td>New Quay</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nathaniel</td>
                                    <td>mi.Duis@diam.edu</td>
                                    <td>(012165) 76278</td>
                                    <td>Grumo Appula</td>
                                    <td>
                                        <span class="badge bg-danger">Inactive</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Graiden</td>
                                    <td>vehicula.aliquet@semconsequat.co.uk</td>
                                    <td>076 4820 8838</td>
                                    <td>Offenburg</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dale</td>
                                    <td>fringilla.euismod.enim@quam.ca</td>
                                    <td>0500 527693</td>
                                    <td>New Quay</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nathaniel</td>
                                    <td>mi.Duis@diam.edu</td>
                                    <td>(012165) 76278</td>
                                    <td>Grumo Appula</td>
                                    <td>
                                        <span class="badge bg-danger">Inactive</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Graiden</td>
                                    <td>vehicula.aliquet@semconsequat.co.uk</td>
                                    <td>076 4820 8838</td>
                                    <td>Offenburg</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dale</td>
                                    <td>fringilla.euismod.enim@quam.ca</td>
                                    <td>0500 527693</td>
                                    <td>New Quay</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nathaniel</td>
                                    <td>mi.Duis@diam.edu</td>
                                    <td>(012165) 76278</td>
                                    <td>Grumo Appula</td>
                                    <td>
                                        <span class="badge bg-danger">Inactive</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

        </section>
    </div>

    <div id="YeniMusteri" title="Yeni Müşteri Kaydı" style="display: none;">
        {{-- <form id="YeniMusteriForm" role="form">
            @csrf --}}
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
                            <label for="EMail">Email *</label>
                            <input id="EMail" type="email" name="EMail" class="form-control"
                                placeholder="Please email adresini giriniz *" required="required">
                        </div>
                    </div>                   
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Il">İL *</label>
                            <input id="Il" type="text" name="Il" class="form-control"
                                placeholder="Lütfen şirket telefonunu giriniz *" required="required">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Ilce">İlçe *</label>
                            <input id="Ilce" type="text" name="Ilce" class="form-control"
                                placeholder="Please email adresini giriniz *" required="required">
                        </div>
                    </div>                   
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="Adres">Adres *</label>
                            <textarea id="Adres" name="Adres" class="form-control"
                                placeholder="Şirket Adresi" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-success btn-send  pt-2 btn-block modal-success-btn" value="Kaydet" id="MusteriKaydet">
                    </div>
                </div>
            </div>
        {{-- </form> --}}
    </div>
@endsection
@section('js')
    <script>
        $(function() {
            JsDataTable('Musteriler');
        });

        function YeniMusteri() {
            ShowBSDialog('YeniMusteri', null, Modal_Large);
        }        

        $("#MusteriKaydet").click(function() {          
            var obj = { };
            obj.Unvan = $('#Unvan').val();
            obj.YetkiliAdSoyad = $('#YetkiliAdSoyad').val();
            obj.VergiNumarasi = $('#VergiNumarasi').val();
            obj.VergiDairesi = $('#VergiDairesi').val();
            obj.Telefon = $('#Telefon').val();
            obj.EMail = $('#EMail').val();
            obj.Il = $('#Il').val();
            obj.Ilce = $('#Ilce').val();
            obj.Adres = $('#Adres').val();

            AjaxIslem("{{ route('musteri_kaydet') }}", obj, function(e) {
                ShowInfo(e.success);
            }, 'POST');
        });
    </script>
@endsection

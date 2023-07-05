@extends('admin.ana-yapi')
@section('title')
    İş Takip Sistemi
@endsection

@section('main')
    <div class="page-heading">
        <h3>Ana Sayfa</h3>
    </div>
    <div class="page-content">
        <section class="row">
            
            <div class="col-md-8 mx-auto">
                <div class="alert alert-danger">Ana Sayfa</div>
            </div>

            <button onclick="Tikla()">Tıkla</button>
            
        </section>

        
    </div>

    
    <div id="FirmaIptalEkran" title="Satınalma İptali" style="display:none;">
        <b>Siparişte hiç ürün bulunmamaktadır.</b><br>
        Bu durumda satınalma süreci sonlandırılacak ve talep edilmiş ürünler daha sonra yürütücü tarafından tekrar talep edilebilecektir.<br>
        <input id="SatinalmaIptalMail" type="checkbox"><label for="SatinalmaIptalMail" >Satınalma iptalini firmalara bildir</label>
        <b>İptal Nedeni:</b><br>
        <textarea id="IptalNeden" style="width:100%"></textarea>
    </div>
    
@endsection
@section('js')
    <script>
        function Tikla()
        {
            
            showModal('File Deletion', 'Do you want to delete this file?', "Yes", "No", function(){
                ShowInfo('Tamam');
            });
        }
    </script>
@endsection

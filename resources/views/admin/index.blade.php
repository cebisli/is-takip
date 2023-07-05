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
        <form>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Recipient:</label>
              <input type="text" class="form-control" id="recipient-name">
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Message:</label>
              <textarea class="form-control" id="message-text"></textarea>
            </div>
          </form>
    </div>
    
@endsection
@section('js')
    <script>
        function Tikla()
        {
            
            ShowBSDialog('FirmaIptalEkran', 'Deneme', "Yes", "No", function(){
                var val = $('#recipient-name').val();
                if (val == '')
                {
                    ShowInfo('Tüm alanları doldurunuz');
                    return false;
                }
            }, Modal_XLarge);
        }
    </script>
@endsection

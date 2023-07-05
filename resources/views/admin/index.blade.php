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
@endsection
@section('js')
    <script>
        function Tikla()
        {
            ShowInfo('1231', function() {
                alert(1);
            });
        }
    </script>
@endsection

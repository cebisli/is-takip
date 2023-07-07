$.ajaxSetup({
	headers: {
	  'X-CSSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

var COMMONLANG = {
	DESC : 'Açıklama',
	DELETE : 'Sil',
	SAVE : 'Kaydet',
	ERROR : 'Hata',
	CANCEL : 'Vazgeç',
	CLOSE : 'Kapat',
	OK : 'Tamam',
	DOWNLOAD_PREPARED : 'İndirme hazırlanıyor...',
	DELETE_CONFIRMATION : 'Seçili kaydı silmek istediğinize emin misiniz?',
	DELETE_INPROGRESS : 'Kayıt siliniyor. Lütfen bekleyiniz...',
	NOT_PROPER_CONDITION : '{0} düzgün bir şart değil',
	WORKING_DAYS : 'iş günü',
	HOUR : 'saat',
	MINUTE: 'dakika',
	SAVING : 'Kaydediliyor',
	LOADING: 'Yükleniyor',
	DELETING : 'Siliniyor',
	SENDING: 'Gönderiliyor',
	UPDATING : 'Güncelleniyor',
	PROCESS_IN_PROGRESS : 'İşleminiz devam ediyor, lütfen bekleyiniz.',
	PROCESS_COMPLETED : 'İşleminiz başarıyla tamamlandı',
	INFORMATION : 'Bilgilendirme',
	SUCCESS : 'Başarılı',
	WARNING : 'Uyarı',
	CONFIRMATION : 'Onaylama',
	YES : 'Evet',
	NO : 'Hayır',
	ENTER_VALID_VALUE : "Lütfen geçerli bir değer giriniz.",
	FILE_BEING_GENERATED : 'Dosya oluşturuluyor',
	TABLE_IS_SORTABLE : 'Bu tablodaki veriler sürükle-bırak ile sıralanabilinmektedir',
	FIELD_VALID_DATE : '{0} alanına geçerli bir tarih yazmanız gerekmektedir',
	FIELD_VALID_VALUE : '{0} alanına geçerli bir değer girmeniz gerekmektedir',
	FIELD_MANDATORY : '{0} alanını doldurmak zorunludur',
	INPUT_ERROR : "Hatalı bilgi girişi bulunmaktadır, lütfen düzeltiniz",
	MISSING_INPUTS : 'Doldurulması zorunlu bazı alanlar boş bırakılmıştır',
	WINDOW_CLOSE_CONFIRMATION : 'Sayfadan ayrıldığınızda yapılan değişiklikler kaybedilecektir',
	PLEASE_WAIT : 'Lütfen bekleyiniz'
};

var modalWrap = null;
UseSwal = true;
UseSwalV2 = false;
function ShowInfo (msg, okCallback)
{
	CallSwal({
		title: 'İnfo',
		text: msg,
        type: 'info',
		confirmButtonText: 'Ok'
		}, okCallback);
};

function CallSwal(options, callback)
{
	if (typeof swal != 'function' || ! UseSwal)
		return false;
	if (typeof swal.fire == 'function')
	{
		options.html = options.text;
		delete options.text;
		options.icon = options.type;
		if (options.type == 'input')
		{
			options.input = 'text';
			options.inputValidator = function(value){
				if (value == '')
					return options.inputErrorMessage;
			};
		}
		swal.fire(options).then(callback);
	}
	else if(UseSwalV2)
	{
		options.html = options.text;
		delete options.text;
		swal(options).then(callback);
	}
	else
	{
		options.html = true;
		swal(options, callback);
	}
	return true;
}

const Modal_Small = 1;
const Modal_Large = 2;
const Modal_XLarge = 3;
const Modal_FullScreen = 3;
const Modal_DialogScrollable = 5;


const ShowBSDialog = (divId, callback, tur = 0) => 
{
	if (modalWrap !== null) {
	  modalWrap.remove();
	}
	
	var modalClass = "";
	if (tur == Modal_Small)
		modalClass = "modal-sm";
	else if (tur == Modal_Large)	
		modalClass = "modal-lg";
	else if (tur == Modal_XLarge)	
		modalClass = "modal-xl";
	else if (tur == Modal_FullScreen)	
		modalClass = "modal-fullscreen";
	else if (tur == Modal_DialogScrollable)	
		modalClass = "modal-dialog-scrollable";

	var div = $('#' + divId).show();
	var title = $('#' + divId).attr('title');
	var modalId = divId + '_modal';

	modalWrap = document.createElement('div');
	modalWrap.innerHTML = `
	  <div class="modal fade" tabindex="-1" id="`+modalId+`" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog `+modalClass+`">
		  <div class="modal-content">
			<div class="modal-header bg-light">
			  <h5 class="modal-title">${title}</h5>
			  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">			  
			</div>
			
		  </div>
		</div>
	  </div>
	`;
	
	div.appendTo(modalWrap.querySelector('.modal-body'));
	var modal = new bootstrap.Modal(modalWrap.querySelector('.modal'));
	modal.show();		

	/*
		Modal ın alt kısmına butonları kaymak istenirse aktif edilmeli ve
		fonksiyona yesBtnLabel = 'Yes', noBtnLabel = 'Cancel' parametreleri eklenmesi

		<div class="modal-footer bg-light">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">${noBtnLabel}</button>
			<button type="button" class="btn btn-primary modal-success-btn">${yesBtnLabel}</button>
		</div>

		modalWrap.querySelector('.modal-success-btn').onclick  =  function(e){	
		var sonuc = true;
		if (typeof callback == "function")
			sonuc = callback();		
		if (sonuc)
			modal.hide();
	}; 
	*/
  
  }

function JsDataTable(tableId)
{
	var obj = {
		paging: true,
		autoWidth: false,
		responsive:true,
		processing: true,
		info:false
	};
	var table = $('#'+tableId).dataTable(obj);

	var row = $('#'+tableId+'_wrapper').find('.row').first();
	var div = $(row).find('div').end();
	div.empty();
	var searchInput = `<div id="`+tableId+`_filter"
	 class='dataTables_filter'><input type='search' class='form-control form-control-sm' 
	 style='width:100%;' aria-controls="`+tableId+`"/></div>`;

	div.append(searchInput);
	return table;
}

$(document).on('keyup', "input[type='search']", function(){
	var oTable = $('.dataTable').dataTable();
	oTable.fnFilter($(this).val());
});

function AjaxIslem(url, GetData, CallBackFunction, methot = 'GET')
{	
	GetData._token = $('meta[name="csrf-token"]').attr('content');	
	
	$.ajax({
		type : methot,
		url : url,
		data : GetData,
		success : function (e) {
			if (typeof CallBackFunction == "function")
				CallBackFunction(e);
			else
				console.log(CallBackFunction);	
		}
	});

}
$.ajaxSetup(
{
	headers: {
		'X-CSSRF_TOKEN' : $('meta[name="csrf-token"]').attr('content')
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
		title: 'Bilgilendirme',
		text: msg,
        type: 'info',
		confirmButtonText: 'Ok'
		}, okCallback);
};

function ShowWarning (msg, okCallback)
{
	CallSwal({
		title: 'Uyarı',
		text: msg,
        type: 'warning',
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
		lengthMenu: [[5,10,25,50,100, -1], [5,10,25,50,100, "All"]],		
		info:true,		
		"language": {
            "emptyTable": "Gösterilecek ver yok.",
            "processing": "Veriler yükleniyor",
            "sDecimal": ".",
            "sInfo": "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar",
            "sInfoFiltered": "(_MAX_ kayıt içerisinden bulunan)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "Sayfada _MENU_ kayıt göster",
            "sLoadingRecords": "Yükleniyor...",
            "sSearch": "Ara:",
            "sZeroRecords": "Eşleşen kayıt bulunamadı",
            "oPaginate": {
                "sFirst": "İlk",
                "sLast": "Son",
                "sNext": "Sonraki",
                "sPrevious": "Önceki"
            },
            "oAria": {
                "sSortAscending": ": artan sütun sıralamasını aktifleştir",
                "sSortDescending": ": azalan sütun sıralamasını aktifleştir"
            },
            "select": {
                "rows": {
                    "_": "%d kayıt seçildi",
                    "0": "",
                    "1": "1 kayıt seçildi"
                }
            }			
        },
		dom: 'lBfrtip',
		buttons: [
			'excel', 'csv', 'pdf'
		],
	};
	var table = $('#'+tableId).dataTable(obj);

	var row = $('#'+tableId+'_wrapper').find('.row').first();
	var div = $(row).find('div').first();

	// lenght	
	var tableWrapper = `<div class='text-white table_lenght' 
								style='width:100%; background:#337ab7; 
								border-radius:3px; height:40px; position:relative;'>									
						</div>`;
	$('#'+tableId).parent('div').prepend(tableWrapper);
	$('table.dataTable').attr('style','margin-top:0px !important');
	
	$('.table_lenght').append($('.dataTables_length'));
	$('.dataTables_length').attr('style','color:white; position:absolute; top:20%; right:5px;');
	$('.dataTables_length select').removeClass('form-select form-select-sm');
	
	$('.table_lenght').append($('.dt-buttons'));
	$(".dt-buttons").css({'position':'absolute','top':'12%', 'margin-left':'20px'});
	var dtCss = {
		'color':'white',
		'padding':'0.2em 1.5em 0.2em',
		'height':'10px !important', 
		'margin-right':'0px',
		'background-image':"none",
		'background-color':'#5bc0de',
		'border-radius':'3px',
		'border-color':'#46b8da'
	}
	$(".dt-button").css(dtCss);	

	//search input unu taşıdık
	$('.table_lenght').parent('div').prepend($('.dataTables_filter input'));	
	$('.dataTables_wrapper input').css({'width':'100%', 'margin-bottom':'5px', 'border-radius':'3px'});
	// // search input unu taşıdıktan sonra önceki divi sildik
	 $('.dataTables_filter').remove();

	return table;
}

function AjaxIslem(url, GetData, CallBackFunction, methot = 'GET')
{	
	if (methot == 'POST')
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
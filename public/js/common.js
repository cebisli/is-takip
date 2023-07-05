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

function ShowBSDialog(divId, action, actionName, cancellable, sizeName){
	return ShowDialogBS(divId, 0, 0, action, actionName, cancellable, sizeName);
};

const showModal = (title, description, yesBtnLabel = 'Yes', noBtnLabel = 'Cancel', callback) => {
	if (modalWrap !== null) {
	  modalWrap.remove();
	}
  
	modalWrap = document.createElement('div');
	modalWrap.innerHTML = `
	  <div class="modal fade" tabindex="-1">
		<div class="modal-dialog">
		  <div class="modal-content">
			<div class="modal-header bg-light">
			  <h5 class="modal-title">${title}</h5>
			  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
			  <p>${description}</p>
			</div>
			<div class="modal-footer bg-light">
			  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">${noBtnLabel}</button>
			  <button type="button" class="btn btn-primary modal-success-btn" data-bs-dismiss="modal">${yesBtnLabel}</button>
			</div>
		  </div>
		</div>
	  </div>
	`;
  
	modalWrap.querySelector('.modal-success-btn').onclick = callback;
  
	document.body.append(modalWrap);
  
	var modal = new bootstrap.Modal(modalWrap.querySelector('.modal'));
	modal.show();
  }
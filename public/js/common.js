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

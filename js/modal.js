//
// keycode functions
//
function submitnewalertcode(e) {
	if(window.event)
		var keyCode=window.event.keyCode;
	else
		var keyCode=e.which;
	if(keyCode==13) {
		addalertcode();
	}
}

function submiteditalertcode(e) {
	if(window.event)
		var keyCode=window.event.keyCode;
	else
		var keyCode=e.which;
	if(keyCode==13) {
		editalertcode();
	}
}

function submitnewrule(e) {
	if(window.event)
		var keyCode=window.event.keyCode;
	else
		var keyCode=e.which;
	if(keyCode==13) {
		addrule();
	}
}

//
// autofocus functions
//
$('#modalnewcode').on('shown.bs.modal', function () {
	$('#code').focus();
});

$('#modalnewrule').on('shown.bs.modal', function () {
	$('#serviceid').focus();
});

//
// modal cleanup functions
//
function cleanmodalnewcode() {
	$('#newcode input[name=code]').val('');
	$('#newcode input[name=msg]').val('');
	$('#newcode select[name=type]').val('0');
}

function cleanmodaleditcode() {
	$('#editcode input[name=code]').val('');
	$('#editcode input[name=msg]').val('');
	$('#editcode select[name=type]').val('0');
}

function cleanmodalnewrule() {
	$('#newrule input[name=serviceid]').val('');
	$('#newrule input[name=alertcode]').val('');
	$('#newrule input[name=resetdays]').val('1');
	$('#newrule input[name=email]').val('');
	$('#newrule input[name=msg]').val('');
}

function cleanmodaleditrule() {
	$('#newrule input[name=serviceid]').val('');
	$('#newrule input[name=alertcode]').val('');
	$('#newrule input[name=resetdays]').val('');
	$('#newrule input[name=email]').val('');
	$('#newrule input[name=msg]').val('');
}

//
// modal cleanup execute
//
$('#modalnewcode').on('hidden.bs.modal', function () {
	cleanmodalnewcode();
});

$('#modaleditcode').on('hidden.bs.modal', function () {
	cleanmodaleditcode();
});

$('#modalnewrule').on('hidden.bs.modal', function () {
	cleanmodalnewrule();
});

$('#modaleditrule').on('hidden.bs.modal', function () {
	cleanmodaleditrule();
});
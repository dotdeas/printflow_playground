//
// code functions
//
function addalertcode(sitepage) {
	var code=$('#newcode input[name=code]').val();
	var msg=$('#newcode input[name=msg]').val();
	var type=$('#newcode select[name=type]').val();
		if(code=="") {
			toastr.error('Ange en varningskod');
			newcode.code.focus();
		} else if(type=="0") {
			toastr.error('Ange en varningstyp');
			newcode.type.focus();
		} else {
			jQuery.ajax({
				type: 'post',
				url: 'functions/ajaxhelper.php',
				data: 'function=1&code='+code,
				cache: false,
				success: function(response) {
					if(response==1) {
						toastr.error('Varningskod finns redan');
						newcode.code.focus();
					} else {
						jQuery.ajax({
							type: 'post',
							url: 'functions/ajaxhelper.php',
							data: 'function=2&code='+code+'&type='+type+'&msg='+msg,
							cache: false,
							success: function(response) {
								if(response==1) {
									if(sitepage==1) {
										jQuery.ajax({
											type: 'post',
											url: 'functions/ajaxhelper.php',
											data: 'function=3',
											cache: false,
											success: function(response) {
												$('#modalnewcode').modal('hide');
												cleanmodalnewcode();
												toastr.success('Varningskod sparad');
												$('#codesbody').empty();
												$('#codesbody').append(response);
											}
										});
									} else if(sitepage==2) {
										jQuery.ajax({
											type: 'post',
											url: 'functions/ajaxhelper.php',
											data: 'function=7',
											cache: false,
											success: function(response) {
												$('#modalnewcode').modal('hide');
												cleanmodalnewcode();
												toastr.success('Varningskod sparad');
												$('#actbody').empty();
												$('#actbody').append(response);
											}
										});
									}
								} else {
									toastr.error('Något blev fel, prova igen');
								}
							}
						});
					}
				}
			});
		}
}

function getactaddalertcode(alertcode) {
	if(alertcode=="") {
		toastr.error('Något blev fel, prova igen');
	} else {
		$('#newcode input[name=code]').val(alertcode);
		$('#bcadd').attr('onclick','addalertcode(\'2\');');
		$('#modalnewcode').modal('show');
	}
}

function editalertcode() {
	var codeid=$('#editcode input[name=e_codeid]').val();
	var msg=$('#editcode input[name=e_msg]').val();
	var type=$('#editcode select[name=e_type]').val();
		if(codeid=="") {
			toastr.error('Något blev fel, prova igen');
			$('#modaleditcode').modal('hide');
		} else if(type=="0") {
			toastr.error('Ange en varningstyp');
			editcode.e_type.focus();
		} else {
			jQuery.ajax({
				type: 'post',
				url: 'functions/ajaxhelper.php',
				data: 'function=5&codeid='+codeid+'&type='+type+'&msg='+msg,
				cache: false,
				success: function(response) {
					if(response==1) {
						jQuery.ajax({
							type: 'post',
							url: 'functions/ajaxhelper.php',
							data: 'function=3',
							cache: false,
							success: function(response) {
								$('#modaleditcode').modal('hide');
								cleanmodaleditcode();
								toastr.success('Ändringar sparade');
								$('#codesbody').empty();
								$('#codesbody').append(response);
							}
						});
					}
				}
			});
		}
}

function geteditalertcode(codeid) {
	if(codeid=="") {
		toastr.error('Något blev fel, prova igen');
	} else {
		jQuery.ajax({
			type: 'post',
			url: 'functions/ajaxhelper.php',
			data: 'function=4&codeid='+codeid,
			cache: false,
			success: function(response) {
				if(response!="") {
					var codedata=response.split(";");
						$('#editcode input[name=e_codeid]').val(codeid);
						$('#editcode input[name=e_code]').val(codedata[0]);
						$('#editcode select[name=e_type]').val(codedata[1]);
						$('#editcode input[name=e_msg]').val(codedata[2]);
					$('#modaleditcode').modal('show');
				} else {
					toastr.error('Något blev fel, prova igen');
				}
			}
		});
	}
}

function deletealertcode() {
	var codeid=$('#editcode input[name=e_codeid]').val();
		if(codeid=="") {
			toastr.error('Något blev fel, prova igen');
			$('#modaleditcode').modal('hide');
		} else {
			jQuery.ajax({
				type: 'post',
				url: 'functions/ajaxhelper.php',
				data: 'function=6&codeid='+codeid,
				cache: false,
				success: function(response) {
					if(response==1) {
						jQuery.ajax({
							type: 'post',
							url: 'functions/ajaxhelper.php',
							data: 'function=3',
							cache: false,
							success: function(response) {
								$('#modaleditcode').modal('hide');
								cleanmodaleditcode();
								toastr.success('Varningskod raderad');
								$('#codesbody').empty();
								$('#codesbody').append(response);
							}
						});
					}
				}
			});
		}
}

//
// rule functions
//
function addrule(sitepage) {
	var serviceid=$('#newrule input[name=serviceid]').val();
	var alertcode=$('#newrule input[name=alertcode]').val();
	var resetdays=$('#newrule input[name=resetdays]').val();
	var email=$('#newrule input[name=email]').val();
	var msg=$('#newrule input[name=msg]').val();
		if(serviceid=="") {
			toastr.error('Ange ett avtal');
			newrule.serviceid.focus();
		} else if(alertcode=="") {
			toastr.error('Ange en varningskod');
			newrule.alertcode.focus();
		} else {
			jQuery.ajax({
				type: 'post',
				url: 'functions/ajaxhelper.php',
				data: 'function=8&serviceid='+serviceid+'&alertcode='+alertcode,
				cache: false,
				success: function(response) {
					if(response==1) {
						toastr.error('Regel finns redan');
						newrule.serviceid.focus();
					} else {
						jQuery.ajax({
							type: 'post',
							url: 'functions/ajaxhelper.php',
							data: 'function=9&serviceid='+serviceid+'&alertcode='+alertcode+'&resetdays='+resetdays+'&email='+email+'&msg='+msg,
							cache: false,
							success: function(response) {
								if(response==1) {
									if(sitepage==1) {
										jQuery.ajax({
											type: 'post',
											url: 'functions/ajaxhelper.php',
											data: 'function=10',
											cache: false,
											success: function(response) {
												$('#modalnewrule').modal('hide');
												cleanmodalnewrule();
												toastr.success('Regel sparad');
												$('#rulesbody').empty();
												$('#rulesbody').append(response);
											}
										});
									} else if(sitepage==2) {
										jQuery.ajax({
											type: 'post',
											url: 'functions/ajaxhelper.php',
											data: 'function=7',
											cache: false,
											success: function(response) {
												$('#modalnewrule').modal('hide');
												cleanmodalnewrule();
												toastr.success('Regel sparad');
												$('#actbody').empty();
												$('#actbody').append(response);
											}
										});
									}
								} else {
									toastr.error('Något blev fel, prova igen');
								}
							}
						});
					}
				}
			});
		}
}

function getactaddrule(serviceid,alertcode) {
	if(serviceid=="" || alertcode=="") {
		toastr.error('Något blev fel, prova igen');
	} else {
		$('#newrule input[name=serviceid]').val(serviceid);
		$('#newrule input[name=alertcode]').val(alertcode);
		$('#bradd').attr('onclick','addrule(\'2\');');
		$('#modalnewrule').modal('show');
	}
}

function doeditrule() {
	var ruleid=$('#editrule input[name=e_ruleid]').val();
	var resetdays=$('#editrule input[name=e_resetdays]').val();
	var email=$('#editrule input[name=e_email]').val();
	var msg=$('#editrule input[name=e_msg]').val();
		if(ruleid=="") {
			toastr.error('Något blev fel, prova igen');
			$('#modaleditrule').modal('hide');
		} else {
			jQuery.ajax({
				type: 'post',
				url: 'functions/ajaxhelper.php',
				data: 'function=12&ruleid='+ruleid+'&resetdays='+resetdays+'&email='+email+'&msg='+msg,
				cache: false,
				success: function(response) {
					if(response==1) {
						jQuery.ajax({
							type: 'post',
							url: 'functions/ajaxhelper.php',
							data: 'function=10',
							cache: false,
							success: function(response) {
								$('#modaleditrule').modal('hide');
								cleanmodaleditrule();
								toastr.success('Ändringar sparade');
								$('#rulesbody').empty();
								$('#rulesbody').append(response);
							}
						});
					}
				}
			});
		}
}

function geteditrule(ruleid) {
	if(ruleid=="") {
		toastr.error('Något blev fel, prova igen');
	} else {
		jQuery.ajax({
			type: 'post',
			url: 'functions/ajaxhelper.php',
			data: 'function=11&ruleid='+ruleid,
			cache: false,
			success: function(response) {
				if(response!="") {
					var ruledata=response.split(";");
						$('#editrule input[name=e_ruleid]').val(ruleid);
						$('#editrule input[name=e_serviceid]').val(ruledata[0]);
						$('#editrule input[name=e_alertcode]').val(ruledata[1]);
						$('#editrule input[name=e_resetdays]').val(ruledata[2]);
						$('#editrule input[name=e_email]').val(ruledata[3]);
						$('#editrule input[name=e_msg]').val(ruledata[4]);
					$('#modaleditrule').modal('show');
				} else {
					toastr.error('Något blev fel, prova igen');
				}
			}
		});
	}
}

function deleterule() {
	var ruleid=$('#editrule input[name=e_ruleid]').val();
		if(ruleid=="") {
			toastr.error('Något blev fel, prova igen');
			$('#modaleditrule').modal('hide');
		} else {
			jQuery.ajax({
				type: 'post',
				url: 'functions/ajaxhelper.php',
				data: 'function=13&ruleid='+ruleid,
				cache: false,
				success: function(response) {
					if(response==1) {
						jQuery.ajax({
							type: 'post',
							url: 'functions/ajaxhelper.php',
							data: 'function=10',
							cache: false,
							success: function(response) {
								$('#modaleditrule').modal('hide');
								cleanmodaleditrule();
								toastr.success('Regel raderad');
								$('#rulesbody').empty();
								$('#rulesbody').append(response);
							}
						});
					}
				}
			});
		}
}
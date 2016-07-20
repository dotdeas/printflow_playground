<div class="modal fade" id="modaleditrule" tabindex="-1" role="dialo" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<form name="editrule" id="editrule" action="rules.php" method="post">
			<input type="hidden" name="e_ruleid" id="e_ruleid" value="">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Redigera regel</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="serviceid">Avtal</label>
								<input type="text" class="form-control" name="e_serviceid" id="e_serviceid" autocomplete="off" tabindex="1" disabled>
							</div>
							<div class="form-group">
								<label for="email">E-post mottagare</label>
								<input type="text" class="form-control" name="e_email" id="e_email" autocomplete="off" tabindex="3">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="alertcode">Varningskod</label>
								<input type="text" class="form-control" name="e_alertcode" id="e_alertcode" autocomplete="off" tabindex="2" disabled>
							</div>
							<div class="form-group">
								<label for="resetdays">Återställ efter (antal dagar)</label>
								<input type="text" class="form-control" name="e_resetdays" id="e_resetdays" autocomplete="off" onkeypress="return onlynumbers(event);" tabindex="4">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="msg">Meddelande</label>
						<input type="text" class="form-control" name="e_msg" id="e_msg" autocomplete="off" tabindex="5">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger pull-left" name="brdel" id="brdel" onclick="deleterule();" tabindex="-1">Radera</button>
					<button type="button" class="btn btn-default" data-dismiss="modal" tabindex="8">Avbryt</button>
					<button type="button" class="btn btn-primary" name="bredit" id="bredit" onclick="doeditrule();" tabindex="6">Spara</button>
				</div>
			</div>
		</form>
	</div>
</div>
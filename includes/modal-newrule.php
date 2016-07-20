<div class="modal fade" id="modalnewrule" tabindex="-1" role="dialo" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<form name="newrule" id="newrule" action="rules.php" method="post">
			<input type="hidden" name="value" id="value" value="baddrule">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Ny regel</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="serviceid">Avtal</label>
								<input type="text" class="form-control" name="serviceid" id="serviceid" autocomplete="off" tabindex="1">
							</div>
							<div class="form-group">
								<label for="email">E-post mottagare</label>
								<input type="text" class="form-control" name="email" id="email" autocomplete="off" tabindex="3">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="alertcode">Varningskod</label>
								<input type="text" class="form-control" name="alertcode" id="alertcode" autocomplete="off" tabindex="2">
							</div>
							<div class="form-group">
								<label for="resetdays">Återställ efter (antal dagar)</label>
								<input type="text" class="form-control" name="resetdays" id="resetdays" autocomplete="off" value="1" onkeypress="return onlynumbers(event);" tabindex="4">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="msg">Meddelande</label>
						<input type="text" class="form-control" name="msg" id="msg" autocomplete="off" tabindex="5">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal" tabindex="8">Avbryt</button>
					<button type="button" class="btn btn-primary" name="bradd" id="bradd" onclick="addrule('1');" tabindex="6">Spara</button>
				</div>
			</div>
		</form>
	</div>
</div>
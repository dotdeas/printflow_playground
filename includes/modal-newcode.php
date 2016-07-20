<div class="modal fade" id="modalnewcode" tabindex="-1" role="dialo" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<form name="newcode" id="newcode" action="codes.php" method="post">
			<input type="hidden" name="value" id="value" value="baddcode">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Ny varningskod</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="code">Kod</label>
								<input type="text" class="form-control" name="code" id="code" autocomplete="off" tabindex="1">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="type">Typ</label>
								<select class="form-control" name="type" id="type" autocomplete="off" tabindex="2">
									<option value="0" selected></option>
									<option value="1">Förbrukning</option>
									<option value="2">Information</option>
									<option value="4">Kritisk</option>
									<option value="3">Varning</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="msg">Meddelande/Förbrukning</label>
						<input type="text" class="form-control" name="msg" id="msg" autocomplete="off" tabindex="3">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal" tabindex="5">Avbryt</button>
					<button type="button" class="btn btn-primary" name="bcadd" id="bcadd" onclick="addalertcode('1');" tabindex="4">Spara</button>
				</div>
			</div>
		</form>
	</div>
</div>
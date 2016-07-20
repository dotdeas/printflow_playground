<div class="modal fade" id="modaleditcode" tabindex="-1" role="dialo" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<form name="editcode" id="editcode" action="codes.php" method="post">
			<input type="hidden" name="e_codeid" id="e_codeid" value="">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Redigera varningskod</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="e_code">Kod</label>
								<input type="text" class="form-control" name="e_code" id="e_code" autocomplete="off" tabindex="1" disabled>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="e_type">Typ</label>
								<select class="form-control" name="e_type" id="e_type" autocomplete="off" tabindex="2">
									<option value="" selected></option>
									<option value="1">Förbrukning</option>
									<option value="2">Information</option>
									<option value="4">Kritisk</option>
									<option value="3">Varning</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="e_msg">Meddelande/Förbrukning</label>
						<input type="text" class="form-control" name="e_msg" id="e_msg" autocomplete="off" tabindex="3">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger pull-left" name="bcdel" id="bcdel" onclick="deletealertcode();" tabindex="-1">Radera</button>
					<button type="button" class="btn btn-default" data-dismiss="modal" tabindex="5">Avbryt</button>
					<button type="button" class="btn btn-primary" name="bcedit" id="bcedit" onclick="editalertcode();" tabindex="4">Spara</button>
				</div>
			</div>
		</form>
	</div>
</div>
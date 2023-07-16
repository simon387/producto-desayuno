<div class="modal fade" id="newProductModal" tabindex="-1" role="dialog" aria-labelledby="newProductModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="newProductModalLabel">Nuevo Producto</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row form-group">
					<div class="col-3">
						<label class="control-label" for="name">Nombre</label>
					</div>
					<div class="col-9">
						<div class="form-group">
							<input type="text" class="form-control" id="name" autocomplete="off" required>
						</div>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-3">
						<label class="control-label" for="supplier">Proveedor</label>
					</div>
					<div class="col-9">
						<div class="form-group">
							<select class="form-control" id="supplier" autocomplete="off" required></select>
						</div>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-3">
						<label class="control-label" for="unit">Unidad</label>
					</div>
					<div class="col-9">
						<div class="form-group">
							<input type="text" class="form-control" id="unit" autocomplete="off">
						</div>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-3">
						<label class="control-label" for="note">Note</label>
					</div>
					<div class="col-9">
						<div class="form-group">
							<input type="text" class="form-control" id="note" autocomplete="off">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Anular</button>
				<button disabled id="btn-add-product" class="btn btn-primary" type="button" data-dismiss="modal">Guardar</button>
			</div>
		</div>
	</div>
</div>

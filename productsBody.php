<div class="container-fluid">

	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">
			Lista de todos los Productos de el almacén
		</h1>
		<button class="btn btn-primary btn-icon-split btn-sm" id="btn-new-product">
				<span class="icon text-white-50">
					<em class="fas fa-plus"></em>
				</span>
			<span class="text">Nuevo producto</span>
		</button>
	</div>

	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Productos</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive overflow-hidden">
				<table class="table table-bordered table-striped" id="dataTableProducts" aria-describedby="table">
					<thead>
					<tr>
						<th scope="row" class="col" data-field="id">id</th>
						<th scope="row" class="col" data-field="name">Nombre</th>
						<th scope="row" class="col" data-field="supplier">Proveedor</th>
						<th scope="row" class="col" data-field="unit">Unidad</th>
						<th scope="row" class="col" data-field="note">Note</th>
						<th scope="row" class="col" data-field=""></th>
					</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>

</div>

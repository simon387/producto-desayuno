<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Producto Desayuno</h1>
		<div class="d-none d-md-block"><!-- per valeria -->
			<button class="btn btn-info btn-icon-split btn-sm" id="btn-prev-page">
				<span class="icon text-white-50">
					<em class="fas fa-arrow-left"></em>
				</span>
				<span class="text">Período Anterior</span>
			</button>
			<button disabled class="btn btn-info btn-icon-split btn-sm" id="btn-next-page">
				<span class="icon text-white-50">
					<em class="fas fa-arrow-right"></em>
				</span>
				<span class="text">Período Siguiente</span>
			</button>
			<button class="btn btn-primary btn-icon-split btn-sm" id="btn-new-page">
				<span class="icon text-white-50">
					<em class="fas fa-plus"></em>
				</span>
				<span class="text">Nuevo período</span>
			</button>
		</div>
	</div>

	<div class="card shadow mb-4">
		<div class="card-header py-3">
<!--			<h6 class="m-0 font-weight-bold text-primary">Período Almacén desde <span id="period-from"></span> hasta <span id="period-to"></span>-->
<!--				 - Productos del proveedor: <span id="supplier-selected"></span>-->
<!--			</h6>-->
			<h6 class="m-0 font-weight-bold text-primary">Período Almacén desde <span id="period-from"></span> hasta <span id="period-to"></span>
				- Productos de categoria: <span id="category-selected"></span>
			</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered responsive table-striped" id="dataTableDashboard" aria-describedby="table">
					<thead>
					<tr>
						<th data-priority="1" scope="row" class="col" data-field="name">Producto</th>
						<th data-priority="6" scope="row" class="col" data-field="unit">Unidad</th>
						<th data-priority="7" scope="row" class="col" data-field="note">Note</th>
						<th data-priority="3" scope="row" class="col" data-field="deposit0">Nevera</th>
						<th data-priority="4" scope="row" class="col" data-field="deposit1">Pase</th>
						<th data-priority="2" scope="row" class="col" data-field="left">Cuanto Quedan</th>
						<th data-priority="5" scope="row" class="col" data-field="lastOperation">Última Edición</th>
					</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>

	<nav aria-label="...">
		<ul id="main-paginator" class="pagination pagination-sm">
		</ul>
	</nav>
</div>

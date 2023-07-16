<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="display: none">

	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
		<div class="sidebar-brand-icon rotate-n-15">
			<em class="fas fa-laugh-wink"></em>
		</div>
		<div class="sidebar-brand-text mx-3">Almacén <sup>2</sup></div>
	</a>

	<hr class="sidebar-divider my-0">

	<li class="nav-item">
		<a class="nav-link" href="index.php">
			<em class="fas fa-fw fa-tachometer-alt"></em>
			<span>Dashboard</span></a>
	</li>

	<hr class="sidebar-divider">

	<div class="sidebar-heading">Logs</div>

	<li class="nav-item">
		<a class="nav-link" href="logs.php">
			<em class="fas fa-fw fa-chart-area"></em>
			<span>Operaciones</span></a>
	</li>

	<hr class="sidebar-divider">

	<?php if ($_SESSION['super-admin']) { ?>
	<div class="sidebar-heading">Admin</div>

	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
		   aria-expanded="true" aria-controls="collapseTwo">
			<em class="fas fa-fw fa-cog"></em>
			<span>Modificar Almacén</span>
		</a>
		<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Personalizar:</h6>
				<a class="collapse-item" href="periods.php">Períodos</a>
				<a class="collapse-item" href="suppliers.php">Proveedores</a>
				<a class="collapse-item" href="products.php">Productos</a>
			</div>
		</div>
	</li>
	<hr class="sidebar-divider">
	<?php } ?>

	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>
</ul>

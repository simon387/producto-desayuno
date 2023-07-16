$(document).ready(function () {
	$("#form-search").css("display", "none").removeClass(["d-none", "d-sm-inline-block"]);
	getAllSuppliers();
	$("#btn-new-product").on("click", function () {
		$('#newProductModal').modal('show');
	});
	$("#btn-add-product").on("click", function () {
		addNewProduct();
	});
	$("#name").on("change", function () {
		document.getElementById("btn-add-product").disabled = document.getElementById("name").value === "";
	});
});

function getAllSuppliers() {
	blockScreen();
	$.ajax({
		type: 'GET',
		url: rest + "supplier/readAll.php",
		processData: false,
		contentType: false,
		success: function (data) {
			const array = JSON.parse(data).list;
			const select = document.getElementById('supplier');
			loadSelect(array, select);
			getDatatableData(array);
		}
	});
}

function loadSelect(array, select) {
	for (let i = 0; i < array.length; i++) {
		const opt = document.createElement('option');
		opt.value = array[i]["id"];
		opt.innerHTML = array[i]["name"].toUpperCase();
		select.appendChild(opt);
	}
}

const dataTableProducts = $('#dataTableProducts').DataTable({
	language: {
		url: "vendor/datatables/es.json",
	},
	searching: true,
	autoWidth: false,
	columnDefs: [
		{"width": "10%", orderable: false, targets: [0]},
		{"width": "20%", orderable: false, targets: [1]},
		{"width": "20%", orderable: false, targets: [2]},
		{"width": "20%", orderable: false, targets: [3]},
		{"width": "20%", orderable: false, targets: [4]},
		{"width": "10%", orderable: false, targets: [5]},
	],
	aaSorting: [],
});

function getDatatableData(suppliers) {
	$.ajax({
		type: "GET",
		url: rest + "controllers/product.php",
		success: function (data) {
			renderTableProducts(dataTableProducts, data, suppliers);
		},
		error: function () {
			unblockScreen();
		}
	});
}

function renderTableProducts(dataTable, data, suppliers) {
	dataTable.clear();
	// const array = JSON.parse(data).list;
	$.each(data.list, function (ind, o) {
		const id = o["id"];
		const name = null === o["name"] ? "" : o["name"];
		const supplier = null === o["supplier"] ? "" : o["supplier"];
		const unit = null === o["unit"] ? "" : o["unit"];
		const note = null === o["note"] ? "" : o["note"];
		dataTable.row.add([
			id,
			'<input id="name-' + o.id + '" class="form-control" type="text" onchange="saveProduct(' + o.id + ')" value="' + escapeHTML(name) + '">',
			generateSupplierSelect(o.id, supplier, suppliers),
			'<input id="unit-' + o.id + '" class="form-control" type="text" onchange="saveProduct(' + o.id + ')" value="' + escapeHTML(unit) + '">',
			'<input id="note-' + o.id + '" class="form-control" type="text" onchange="saveProduct(' + o.id + ')" value="' + escapeHTML(note) + '">',
			'<button onclick="deleteProduct(' + o.id + ')" class="btn btn-danger btn-circle"><em class="fas fa-trash"></em></button>'
		]);
	});
	dataTable.draw();
	unblockScreen();
}

function generateSupplierSelect(id, supplier, suppliers) {
	let select = '<select id="supplier-' + id + '" class="form-control" onchange="saveProduct(' + id + ')">';
	for (let i = 0; i < suppliers.length; i++) {
		const selected = parseInt(supplier) === parseInt(suppliers[i]["id"]) ? "selected" : "";
		const opt = '<option ' + selected + ' value="' + suppliers[i]["id"] + '">' + suppliers[i]["name"].toUpperCase() + '</option>';
		select += opt;
	}
	return select + '</select>';
}

function saveProduct(id) {
	blockScreen();
	const name = document.getElementById("name-" + id).value;
	const supplier = parseInt(document.getElementById("supplier-" + id).value);
	const unit = document.getElementById("unit-" + id).value;
	const note = document.getElementById("note-" + id).value;
	id = parseInt(id);
	$.ajax({
		type: "PUT",
		url: rest + "controllers/product.php",
		contentType: "application/json; charset=utf-8",
		dataType: "json",
		data: JSON.stringify({
			id, name, supplier, unit, note
		}),
		success: function () {
			unblockScreen();
		}
	});
}

function addNewProduct() {
	const name = document.getElementById("name").value;
	if (name === "") {
		return;
	}
	blockScreen();
	document.getElementById("name").value = "";
	const supplier = document.getElementById("supplier").value;
	const unit = document.getElementById("unit").value;
	document.getElementById("unit").value = "";
	const note = document.getElementById("note").value;
	document.getElementById("note").value = "";
	$.ajax({
		type: "POST",
		url: rest + "controllers/product.php",
		contentType: "application/json; charset=utf-8",
		processData: false,
		dataType: "json",
		data: JSON.stringify({
			name, supplier, unit, note
		}),
		success: function () {
			location.reload();
		}
	});
}

function deleteProduct(id) {
	blockScreen();
	$.ajax({
		type: "DELETE",
		url: rest + "controllers/product.php",
		data: JSON.stringify({
			id
		}),
		success: function () {
			location.reload();
		},
		error: function () {
			unblockScreen();
		}
	});
}
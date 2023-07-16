let period;
let user;

$(document).ready(function () {
	getLastPeriod();
	// getSuppliers();
	getCategories();
	// new period
	$("#btn-new-page").on("click", function () {
		$('#newPeriodModal').modal('show');
	});
	// prev period
	$("#btn-prev-page").on("click", function () {
		$.ajax({
			type: 'GET',
			url: rest + "period/previous.php?id=" + period["id"],
			processData: false,
			contentType: false,
			success: function (data) {
				try {
					const previous = JSON.parse(data);
					if (null !== previous["id"]) {
						period = previous;
						refreshPeriod();
						document.getElementById("btn-next-page").disabled = false;
					} else {
						document.getElementById("btn-prev-page").disabled = true;
					}
				} catch(error) {
					document.getElementById("btn-prev-page").disabled = true;
				}
			},
		});
	});
	// next period
	$("#btn-next-page").on("click", function () {
		$.ajax({
			type: 'GET',
			url: rest + "period/next.php?id=" + period["id"],
			processData: false,
			contentType: false,
			success: function (data) {
				document.getElementById("btn-prev-page").disabled = false;
				const next = JSON.parse(data);
				if (null !== next["id"]) {
					period = next;
					refreshPeriod();
				}
			},
		});
	});
	// search
	$("#input-search").on("textInput input", function () {
		search();
	});
	$("#btn-search").on("click", function () {
		search();
	});
	// local memory preferences
	const ITEMS_PER_PAGE = "items_per_page";
	const select = $('select[name="dataTableDashboard_length"]');
	select.change(function() {
		localStorage.setItem(ITEMS_PER_PAGE, this.value);
	});
	if (localStorage.getItem(ITEMS_PER_PAGE)) {
		select.val(localStorage.getItem(ITEMS_PER_PAGE));
		select.change();
	}
});

function search() {
	// document.getElementById("supplier-selected").innerHTML = "todos los proveedores";
	document.getElementById("category-selected").innerHTML = "todas las categorias";
	const query = document.getElementById("input-search").value;
	$.ajax({
		type: "POST",
		url: rest + "product/search.php",
		contentType: "application/json; charset=utf-8",
		processData: false,
		dataType: "json",
		data: JSON.stringify({
			query,
			period: period["id"],
		}),
		success: function (data_) {
			removeActiveClassFromBaseSelector();
			renderTableDashboard(dataTableDashboard, data_, true);
		},
		error: function () {
			dataTableDashboard.clear();
			dataTableDashboard.draw();
		},
	});
}

const dataTableDashboard = $('#dataTableDashboard').DataTable({
	paging: true,
	language: {
		url: "vendor/datatables/es.json",
	},
	searching: true,
	autoWidth: false,
	columnDefs: [
		{"width": "20%", orderable: false, targets: [0]},
		{"width": "10%", orderable: false, targets: [1]},
		{"width": "10%", orderable: false, targets: [2]},
		{"width": "10%", orderable: false, targets: [3]},
		{"width": "10%", orderable: false, targets: [4]},
		{"width": "10%", orderable: false, targets: [5]},
		{"width": "20%", orderable: false, targets: [6]},
	],
	aaSorting: [],
	rowReorder: {
		selector: 'td:nth-child(2)'
	},
});

function getLastPeriod() {
	$.ajax({
		type: 'GET',
		url: rest + "period/readLast.php",
		processData: false,
		contentType: false,
		success: function (data) {
			period = JSON.parse(data);
			getUserInfo();
		},
	});
}

function getUserInfo() {
	$.ajax({
		type: 'GET',
		url: rest + "user/read.php?id=" + userId,
		processData: false,
		contentType: false,
		success: function (data) {
			user = JSON.parse(data);
			refreshPeriod();
		},
	});
}

function refreshPeriod() {
	document.getElementById("period-from").innerHTML = period["start"];
	document.getElementById("period-to").innerHTML = period["end"] === null ? "ahora" : period["end"];
	if (null === period["end"]) {
		document.getElementById("btn-next-page").disabled = true;
	}
	if ("1" === period["counter"]) {
		document.getElementById("btn-prev-page").disabled = true;
	}
	// getDatatableDataBySupplierAndPeriod(2, period["id"]);
	getDatatableDataByCategoryAndPeriod(1, period["id"]);
}

// function getSuppliers() {
// 	$.ajax({
// 		type: 'GET',
// 		url: rest + "supplier/readAll.php",
// 		processData: false,
// 		contentType: false,
// 		success: function (data) {
// 			const array = JSON.parse(data).list;
// 			let innerHTML = "";
// 			for (let i = 1; i < array.length; i++) {
// 				let active = "";
// 				if (i === 1) {
// 					active = "active";
// 					document.getElementById("supplier-selected").innerHTML = array[i]["name"].toUpperCase();
// 				}
// 				innerHTML += '<li class="page-item ' + active + '" data-text="' + array[i]["id"] +
// 					'"><a class="page-link" href="#">' + array[i]["name"].toUpperCase() + '</a></li>';
// 			}
// 			document.getElementById("main-paginator").innerHTML = innerHTML;
// 			$(".page-item").on("click", function () {
// 				removeActiveClassFromBaseSelector();
// 				$(this).addClass('active');
// 				document.getElementById("supplier-selected").innerHTML = this.innerText;
// 				getDatatableDataBySupplierAndPeriod($(this).attr("data-text"), period["id"]);
// 			});
// 		}
// 	});
// }

function getCategories() {
	$.ajax({
		type: 'GET',
		url: rest + "controllers/category.php",
		processData: false,
		contentType: false,
		success: function (data) {
			const array = data.list;
			let innerHTML = "";
			for (let i = 1; i < array.length; i++) {
				let active = "";
				if (i === 1) {
					active = "active";
					document.getElementById("category-selected").innerHTML = array[i]["name"].toUpperCase();
				}
				innerHTML += '<li class="page-item ' + active + '" data-text="' + array[i]["id"] +
					'"><a class="page-link category-selector" href="#">' + array[i]["name"].toUpperCase() + '</a></li>';
			}
			document.getElementById("main-paginator").innerHTML = innerHTML;
			$(".page-item").on("click", function () {
				removeActiveClassFromBaseSelector();
				$(this).addClass('active');
				document.getElementById("category-selected").innerHTML = this.innerText;
				getDatatableDataByCategoryAndPeriod($(this).attr("data-text"), period["id"]);
			});
		}
	});
}

function removeActiveClassFromBaseSelector() {
	const elems = document.querySelectorAll(".page-item");
	[].forEach.call(elems, function (el) {
		el.classList.remove("active");
	});
}

// function getDatatableDataBySupplierAndPeriod(supplierID, periodID) {
// 	blockScreen();
// 	$.ajax({
// 		type: "GET",
// 		url: rest + "product/read.php?supplier_id=" + supplierID + "&period_id=" + periodID,
// 		success: function (data) {
// 			renderTableDashboard(dataTableDashboard, data);
// 		},
// 		error: function () {
// 			unblockScreen();
// 			dataTableDashboard.clear();
// 			dataTableDashboard.draw();
// 		}
// 	});
// }

function getDatatableDataByCategoryAndPeriod(categoryID, periodID) {
	blockScreen();
	$.ajax({
		type: "GET",
		url: rest + "product/read.php?category_id=" + categoryID + "&period_id=" + periodID,
		// url: rest + "product/read.php?supplier_id=" + supplierID + "&period_id=" + periodID,
		success: function (data) {
			renderTableDashboard(dataTableDashboard, data);
		},
		error: function () {
			unblockScreen();
			dataTableDashboard.clear();
			dataTableDashboard.draw();
		}
	});
}

function renderTableDashboard(dataTable, data, isFromSearch = false) {
	dataTable.clear();
	const array = isFromSearch ? data.list : JSON.parse(data).list;
	let unitIsAlwaysEmpty = true;
	let noteIsAlwaysEmpty = true;
	$.each(array, function (ind, o) {
		const id = o["id"];
		const name = isFromSearch ? o["supplier"].toUpperCase() + " - <strong>" + o["name"] + "</strong>" : "<strong>" + o["name"] + "</strong>";
		const unit = null === o["unit"] ? "" : o["unit"];
		unitIsAlwaysEmpty &= unit === "";
		const note = null === o["note"] ? "" : o["note"];
		noteIsAlwaysEmpty &= unit === "";
		const deposit0 = null === o["deposit0"] ? "" : parseInt(o["deposit0"]);
		const deposit1 = null === o["deposit1"] ? "" : parseInt(o["deposit1"]);
		const left = calcFlow(deposit0, deposit1);
		const lastOperation = null === o["lastOperation"] ? "" : o["lastOperation"];
		dataTable.row.add([
			name,
			unit,
			note,
			'<input onkeypress="return event.charCode >= 48 && event.charCode <= 57" oninput="this.value = Math.round(this.value)" onchange="updateProduct(' + id + ', 0)" type="number" min="0" step="1" value="' + deposit0 + '" class="form-control" id="deposit0-' + id + '">',
			'<input onkeypress="return event.charCode >= 48 && event.charCode <= 57" oninput="this.value = Math.round(this.value)" onchange="updateProduct(' + id + ', 1)" type="number" min="0" step="1" value="' + deposit1 + '" class="form-control" id="deposit1-' + id + '">',
			// '<input onchange="updateProduct(' + id + ', 2)" type="number" min="0" value="' + outflow0 + '" class="form-control" id="outflow0-' + id + '">',
			'<input disabled type="number" value="' + left + '" class="form-control text-center" id="left-' + id + '">',
			'<div id="lastOperation-' + id + '">' + lastOperation + '</div>',
		]);
	});
	dataTable.draw();
	dataTable.column(1).visible(!unitIsAlwaysEmpty);
	dataTable.column(2).visible(!noteIsAlwaysEmpty);
	unblockScreen();
}

function updateProduct(id, operation) {
	let deposit0 = document.getElementById("deposit0-" + id).value;
	let deposit1 = document.getElementById("deposit1-" + id).value;
	deposit0 = deposit0 === "" ? 0 : deposit0;
	deposit1 = deposit1 === "" ? 0 : deposit1;
	const outflow0 = 0;
	const outflow1 = 0;
	const left = calcFlow(deposit0, deposit1);
	document.getElementById("left-" + id).value = left;
	let num;
	switch (operation) {
		case 0:
			operation = "<em>Almacen</em>";
			num = deposit0;
			break;
		case 1:
			operation = "<em>Servicio</em>";
			num = deposit1;
			break;
		case 2:
			operation = "<em>Salida Servicio</em>";
			num = outflow0;
			break;
	}
	const lastOperation = getCurrentFormattedTimestamp() + " - <strong>" + username + "</strong> ha puesto " + operation + " a " + num;
	document.getElementById("lastOperation-" + id).innerHTML = lastOperation;
	$.ajax({
		type: "PUT",
		url: rest + "product/update.php",
		contentType: "application/json; charset=utf-8",
		dataType: "json",
		data: JSON.stringify({
			id,
			deposit0,
			deposit1,
			outflow0,
			outflow1,
			left,
			userId,
			lastOperation,
		}),
	});
}

$("#btn-new-page-confirm").on("click", function () {
	blockScreen();
	$.ajax({
		type: "POST",
		url: rest + "period/create.php",
		success: function () {
			location.reload();
		},
	});
});

function calcFlow(deposit0, deposit1) {
	let left = Number(deposit0) + Number(deposit1);
	if (left < 0) {
		left = 0;
	}
	return left;
}
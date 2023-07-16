$(document).ready(function () {
	$("#form-search").css("display", "none").removeClass(["d-none", "d-sm-inline-block"]);
	getDatatableData();
});

const dataTableLogs = $('#dataTableLogs').DataTable({
	language: {
		url: "vendor/datatables/es.json",
	},
	searching: true,
	autoWidth: false,
	columnDefs: [
		{"width": "5%", orderable: false, targets: [0]},
		{"width": "5%", orderable: false, targets: [1]},
		{"width": "10%", orderable: false, targets: [2]},
		{"width": "10%", orderable: false, targets: [3]},
	],
	aaSorting: [],
});

function getDatatableData() {
	blockScreen();
	$.ajax({
		type: "GET",
		url: rest + "operation/readAll.php",
		success: function (data) {
			renderTableLogs(dataTableLogs, data);
		},
		error: function () {
			unblockScreen();
		}
	});
}

function renderTableLogs(dataTable, data) {
	dataTable.clear();
	const array = JSON.parse(data).list;
	$.each(array, function (ind, o) {
		const user = o["user"];
		const timestamp = null === o["description"] ? "" : o["description"].substring(0, 19);
		const product = null === o["product"] ? "" : undefined === o["product"] ? "" : o["product"].toUpperCase();
		const description = null === o["description"] ? "" : o["description"].substring(22);
		dataTable.row.add([
			user,
			timestamp,
			product,
			description,
		]);
	});
	dataTable.draw();
	unblockScreen();
}
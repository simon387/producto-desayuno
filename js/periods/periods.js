$(document).ready(function () {
	$("#form-search").css("display", "none").removeClass(["d-none", "d-sm-inline-block"]);
	getDatatableData();
});

const dataTablePeriods = $('#dataTablePeriods').DataTable({
	language: {
		url: "vendor/datatables/es.json",
	},
	searching: true,
	autoWidth: false,
	columnDefs: [
		{"width": "25%", orderable: false, targets: [0]},
		{"width": "25%", orderable: false, targets: [1]},
		{"width": "25%", orderable: false, targets: [2]},
		{"width": "25%", orderable: false, targets: [3]},
	],
	aaSorting: [],
});

function getDatatableData() {
	blockScreen();
	$.ajax({
		type: "GET",
		url: rest + "period/readAll.php",
		success: function (data) {
			renderTablePeriods(dataTablePeriods, data);
		},
		error: function () {
			unblockScreen();
		}
	});
}

function renderTablePeriods(dataTable, data) {
	dataTable.clear();
	const array = JSON.parse(data).list;
	$.each(array, function (ind, o) {
		const start = null === o["start"] ? "" : o["start"];
		const end = null === o["end"] ? "" : o["end"];
		const actual = o["actual"] === "1" ? "Si" : "no";
		dataTable.row.add([
			start,
			end,
			actual,
			o["actual"] === "0" ? '<button onclick="deletePeriod(' + o.id + ')" class="btn btn-danger btn-circle"><em class="fas fa-trash"></em></button>' : ""
		]);
	});
	dataTable.draw();
	unblockScreen();
}

function deletePeriod(id) {
	blockScreen();
	const lastOperation = getCurrentFormattedTimestamp() + " - <strong>" + username + "</strong> ha cancelado el periodo id " + id;
	$.ajax({
		type: "DELETE",
		url: rest + "period/delete.php?id=" + id,
		data: JSON.stringify({
			lastOperation,
			userId,
		}),
		success: function () {
			location.reload();
		},
		error: function () {
			unblockScreen();
		}
	});
}
/*















------------------------------------------------------------------

  

 */

function EmployeeSalaryAdapter(endPoint) {
	this.initAdapter(endPoint);
}

EmployeeSalaryAdapter.inherits(AdapterBase);



EmployeeSalaryAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "component",
	        "amount",
	        "details"
	];
});

EmployeeSalaryAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" ,"bVisible":false},
			{ "sTitle": "Salary Component" },
			{ "sTitle": "Amount"},
			{ "sTitle": "Details"}
	];
});

EmployeeSalaryAdapter.method('getFormFields', function() {
	return [
	        [ "id", {"label":"ID","type":"hidden"}],
            [ "component", {"label":"Salary Component","type":"select2","remote-source":["SalaryComponent","id","name"]}],
	        [ "amount", {"label":"Amount","type":"text","validation":"float"}],
	        [ "details", {"label":"Details","type":"textarea","validation":"none"}]
	];
});

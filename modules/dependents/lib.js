/*















------------------------------------------------------------------

  

 */


/**
 * EmployeeDependentAdapter
 */

function EmployeeDependentAdapter(endPoint) {
	this.initAdapter(endPoint);
}

EmployeeDependentAdapter.inherits(AdapterBase);



EmployeeDependentAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "name",
	        "relationship",
	        "dob",
	        "id_number"
	];
});

EmployeeDependentAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" ,"bVisible":false},
			{ "sTitle": "Name" },
			{ "sTitle": "Relationship"},
			{ "sTitle": "Date of Birth"},
			{ "sTitle": "Id Number"}
	];
});

EmployeeDependentAdapter.method('getFormFields', function() {
	return [
	        [ "id", {"label":"ID","type":"hidden"}],
	        [ "name", {"label":"Name","type":"text","validation":""}],
	        [ "relationship", {"label":"Relationship","type":"select","source":[["Child","Child"],["Spouse","Spouse"],["Parent","Parent"],["Other","Other"]]}],
	        [ "dob", {"label":"Date of Birth","type":"date","validation":""}],
	        [ "id_number", {"label":"Id Number","type":"text","validation":"none"}]
	];
});

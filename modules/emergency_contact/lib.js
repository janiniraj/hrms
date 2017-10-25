/*















------------------------------------------------------------------

  

 */


function EmergencyContactAdapter(endPoint) {
	this.initAdapter(endPoint);
}

EmergencyContactAdapter.inherits(AdapterBase);



EmergencyContactAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "name",
	        "relationship",
	        "home_phone",
	        "work_phone",
	        "mobile_phone"
	];
});

EmergencyContactAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" ,"bVisible":false},
			{ "sTitle": "Name" },
			{ "sTitle": "Relationship"},
			{ "sTitle": "Home Phone"},
			{ "sTitle": "Work Phone"},
			{ "sTitle": "Mobile Phone"}
	];
});

EmergencyContactAdapter.method('getFormFields', function() {
	return [
	        [ "id", {"label":"ID","type":"hidden"}],
	        [ "name", {"label":"Name","type":"text","validation":""}],
	        [ "relationship", {"label":"Relationship","type":"text","validation":"none"}],
	        [ "home_phone", {"label":"Home Phone","type":"text","validation":"none"}],
	        [ "work_phone", {"label":"Work Phone","type":"text","validation":"none"}],
	        [ "mobile_phone", {"label":"Mobile Phone","type":"text","validation":"none"}]
	];
});

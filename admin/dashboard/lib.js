/*















------------------------------------------------------------------

  

 */

function DashboardAdapter(endPoint) {
	this.initAdapter(endPoint);
}

DashboardAdapter.inherits(AdapterBase);



DashboardAdapter.method('getDataMapping', function() {
	return [];
});

DashboardAdapter.method('getHeaders', function() {
	return [];
});

DashboardAdapter.method('getFormFields', function() {
	return [];
});


DashboardAdapter.method('get', function(callBackData) {
});


DashboardAdapter.method('getInitData', function() {
	var that = this;
	var object = {};
	var reqJson = JSON.stringify(object);
	var callBackData = [];
	callBackData['callBackData'] = [];
	callBackData['callBackSuccess'] = 'getInitDataSuccessCallBack';
	callBackData['callBackFail'] = 'getInitDataFailCallBack';
	
	this.customAction('getInitData','admin=dashboard',reqJson,callBackData);
});



DashboardAdapter.method('getInitDataSuccessCallBack', function(data) {

	$("#numberOfEmployees").html(data['numberOfEmployees']+" Employees");
	$("#numberOfCompanyStuctures").html(data['numberOfCompanyStuctures']+" Departments");
	$("#numberOfUsers").html(data['numberOfUsers']+" Users");
	$("#numberOfProjects").html(data['numberOfProjects']+" Active Projects");
	$("#numberOfAttendanceLastWeek").html(data['numberOfAttendanceLastWeek']+" Entries Last Week");
	$("#numberOfLeaves").html(data['numberOfLeaves']+" Upcoming");
	$("#numberOfTimeEntries").html(data['numberOfTimeEntries']);
    $("#numberOfCandidates").html(data['numberOfCandidates']+" Candidates");
    $("#numberOfJobs").html(data['numberOfJobs']+" Active");
    $("#numberOfCourses").html(data['numberOfCourses']+" Courses");

});

DashboardAdapter.method('getInitDataFailCallBack', function(callBackData) {
	
});

function clearUserEditForm(form) {
	form.attr('action', "");
	form.find('#modalName').val("");
	form.find('#modalEmail').val("");
	form.find('#modalGender').val("");
	form.find('#modalEducation').val("");
	form.find('#modalAddress').val("");
	form.find('#modalDescription').val("");
}

$(document).ready(function() {

	$('.edit-user').on('click', function(e) {
		var formAction = $(this).attr('data-action');
		var userData = JSON.parse($(this).attr('data-user'));
		var $modalForm = $('#editUser form');
		clearUserEditForm($modalForm);
		$modalForm.attr('action', formAction);
		$modalForm.find('#modalName').val(userData.name);
		$modalForm.find('#modalEmail').val(userData.email);
		$modalForm.find('#modalGender').val(userData.gender);
		$modalForm.find('#modalEducation').val(userData.education);
		$modalForm.find('#modalAddress').val(userData.address);
		$modalForm.find('#modalDescription').val(userData.description);
	});

	$('#userEditFormSubmit').on('click', function(e) {
		$('#editUser form').submit();
	});

	$('.delete-user').on('click', function(e) {
		var formAction = $(this).attr('data-action');
		var userData = JSON.parse($(this).attr('data-user'));
		var $modalForm = $('#deleteUser form');
		$modalForm.attr('action', formAction);
		$modalForm.find('#modalID').val(userData.id);
	});

	// $('#userDeleteFormSubmit').on('click', function(e) {
	// 	$('#deleteUser form').submit();
	// });

});
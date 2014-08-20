
elgg.provide('elgg.uservalidationbyadmin');

elgg.uservalidationbyadmin.init = function() {
	$('#uservalidationbyadmin-checkall').click(function() {
		var checked = $(this).attr('checked') == 'checked';
		$('#uservalidationbyadmin-form .elgg-body').find('input[type=checkbox]').attr('checked', checked);
	});

	$('.uservalidationbyadmin-submit').click(function(event) {
		var $form = $('#uservalidationbyadmin-form');
		event.preventDefault();

		// check if there are selected users
		if ($('#uservalidationbyadmin-form .elgg-body').find('input[type=checkbox]:checked').length < 1) {
			return false;
		}

		// confirmation
		if (!confirm($(this).attr('title'))) {
			return false;
		}

		$form.attr('action', $(this).attr('href')).submit();
	});
};

elgg.register_hook_handler('init', 'system', elgg.uservalidationbyadmin.init);

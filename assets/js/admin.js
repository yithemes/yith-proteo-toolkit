(function ($) {
	$('body').addClass('wizard__drawer--open');

	// select the demo to import on click and fix the next step url
	$('#demo-content-list li').on('click', function () {
		var t = $(this),
			chosen_demo = t.attr('data-demo'),
			selected_demo = $('.js-wizard-demo-import-select');
		t.addClass('selected').siblings().removeClass('selected');
		selected_demo.val(chosen_demo);
		var button_next = $('.wizard__button--next'),
		button_next_url = button_next.attr('href'),
		href = new URL(button_next_url, location);
		href.searchParams.set('selected_skin', chosen_demo);
		button_next.attr('href', href);
	});

	// select the first demo if none selected
	$('#demo-content-list li:first-child').addClass('selected').trigger('click');

	// retrieve url parameters
	function yith_proteo_wizard_get_query_string_params(){
		var vars = [], hash;
		var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
		for(var i = 0; i < hashes.length; i++)
		{
			hash = hashes[i].split('=');
			vars.push(hash[0]);
			vars[hash[0]] = hash[1];
		}
		return vars;
	}

	// select the demo to import from url
	function yith_proteo_set_demo_to_import_from_url() {
		var current_wizard_url = new URL(window.location.href),
		selected_skin = yith_proteo_wizard_get_query_string_params()["selected_skin"];
		if (undefined != selected_skin) {
			$('#demo-content-list li[data-demo="'+selected_skin+'"]').trigger('click');
		}
	}
	yith_proteo_set_demo_to_import_from_url();


	$('.yith-proteo-toolkit-wizard-nav ul li.active').prevAll('li').addClass('step-done');
})(jQuery);
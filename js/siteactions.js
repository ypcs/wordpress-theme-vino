jQuery(document).ready(function() {	
	
	/* Menu */
	
	$('#access ul li').hover(function() {
		$(this).children('ul').stop().fadeIn('fast');
	}, function() {
		$(this).children('ul').stop().fadeOut('fast');
	});
	
	/* Dropdown menu */
	$('select.menu option.current-menu-item').attr('selected', 'selected');
	$('select.menu').change(function() {
		window.location.href = $('select.menu option:selected').attr('value');
	});
	
	/* Add link to all events in google calendar plugin */
	$('.widget_gce_widget .gce-widget-list').append('<a target="_blank" href="http://www.vino.fi/toiminta/tulevat-tapahtumat/" class="bullet">Siirry tapahtumakalenteriin</a>');
	
	/* Add main-div height to vertical-divider div  and keep it that way */
	$('.vertical-divider').height( $('#main').height() - 19 );
	$(window).bind('resize', function () {
		$('.vertical-divider').height( $('#main').height() - 19 );
	});
		
});
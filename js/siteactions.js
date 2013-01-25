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
	$('.widget_gce_widget .gce-widget-list').append('<a target="_blank" href="https://www.google.com/calendar/embed?showPrint=0&mode=AGENDA&height=600&wkst=2&bgcolor=%23ffffff&src=ddcbm5h4hnmnbs23un0412qu2g%40group.calendar.google.com&color=%232952A3&ctz=Europe%2FHelsinki" class="bullet">Siirry tapahtumakalenteriin</a>');
	
	/* Add main-div height to vertical-divider div  and keep it that way */
	$('.vertical-divider').height( $('#main').height() - 19 );
	$(window).bind('resize', function () {
		$('.vertical-divider').height( $('#main').height() - 19 );
	});
		
});
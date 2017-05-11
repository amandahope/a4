/* Applies datepicker functionality to date fields */

$( function() {
  $( "#due_date" ).datepicker();
} );

/* Defines active tab in nav bar

$('nav ul li a').each(function() {
    var currentLocation = window.location.pathname;
    var thisLinksLocation = $(this).attr('href');
    if(currentLocation == thisLinksLocation) {
        $(this).parent().addClass('active');
    }
});

$('nav ul li ul li a').each(function() {
    var currentLocation = window.location.pathname;
    var thisLinksLocation = $(this).attr('href');
    if(currentLocation == thisLinksLocation) {
        $(this).parents('li').addClass('active');
    }
});
*/

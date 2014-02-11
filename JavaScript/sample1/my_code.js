$(document).ready(function() {

	// Hide the p tags
	$("p").hide();

	// clickin h text will show the p text
	$("h1").click(function() {
		$(this).next().slideToggle(300);
	});
});
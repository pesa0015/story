/*
$(document).ready(function() {
	$("[id^='story']").click(function() {
  		$("#new-story").fadeOut(500);
	});
});
*/

$(document).ready(function(){
	$("[id^='story']").click(function(){
        $("#new-story").slideToggle(0);
    });
});
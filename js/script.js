$(".alert-danger").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert-danger").alert('close');
});


$(function() {
	$( "#from" ).datepicker({
		dateFormat: "yy-mm-dd",
		defaultDate: "2013-08-01",
		changeMonth: true,
		changeYear: true,
		numberOfMonths: 3,
		onClose: function( selectedDate ) {
			$( "#to" ).datepicker( "option", "minDate", selectedDate );
		}
	});
	$( "#to" ).datepicker({
		dateFormat: "yy-mm-dd",
		defaultDate: "2013-08-31",
		changeMonth: true,
		changeYear: true,
		numberOfMonths: 3,
		onClose: function( selectedDate ) {
			$( "#from" ).datepicker( "option", "maxDate", selectedDate );
		}
	});
});



window.onload = function(){
document.getElementById('send').onclick = function(e){
	alert(document.getElementById("Book has been added").value);
	return false;
}
} 

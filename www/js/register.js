$(document).ready(function() {
    $("form").submit(function() {
	var data = $("form").serializeArray();
	var json = $.toJSON(data);
	var url = "ajax.php?action=validate-registration";
	var form = this;
	
	$.post(url, {data: json}, function(data) {
	    if ($.evalJSON(data).valid == true) {
		form.submit();
	    } else {
		alert("Foo: " + $.evalJSON(data).msg);

	    }
	});
	
	return false;
    });
});

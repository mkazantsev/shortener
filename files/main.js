$(document).ready(function() {
	$("form").submit(function() {
		var url = $(this).find("input#url").val();
		$.ajax({
			url: "shorten.php",
			type: "POST",
			data: { "url": url },
			dataType: "jsonp",
			success: function(data) {
				if (data.url) {
					$("#result").removeClass("error");
					$("#result").text(data.url);
				} else if (data.error) {
					$("#result").addClass("error");
					$("#result").text(data.error);
				}
			}
		});
		return false;
	});
});

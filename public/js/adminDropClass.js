$(document).ready(function () {
	load_data();

	function load_data(query) {
		$.ajax({
			url: 'http://localhost/phpdatabase/admin_drop_class.php',
			method: "POST",
			data: { query: query },
			success: function (data) {
				$('#result_drop_class').html(data);
			}
		});
	}
	$('#drop_class_search').keyup(function () {
		var search = $(this).val();
		if (search != '') {
			load_data(search);
		}
		else {
			load_data();
		}
	});
});
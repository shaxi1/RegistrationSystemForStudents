$(document).ready(function () {
	load_data();

	function load_data(query) {
		$.ajax({
			url: 'http://localhost/phpdatabase/client_fetch_cart.php',
			method: "POST",
			data: { query: query },
			success: function (data) {
				$('#result_cart').html(data);
			}
		});
	}
	$('#cart_search').keyup(function () {
		var search = $(this).val();
		if (search != '') {
			load_data(search);
		}
		else {
			load_data();
		}
	});
});
$(document).ready(function () {

	// Display amount and currency stats
	$('#amount').on('input', calculateExchangeRate);
	$('#from').change(calculateExchangeRate);
	$('#to').change(calculateExchangeRate);

	function calculateExchangeRate(e) {
		var my_url = "currency/calculateAmount";
		var amount = $('#amount').val();
		var rateFrom = $('#from').val();
		var rateTo = $('#to').val();

		if ($.isNumeric(amount)) {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
			})

			e.preventDefault();

			var formData = {
				rateFromId: rateFrom,
				rateToId: rateTo,
				amount: amount,
			}

			$.ajax({

				type: "POST",
				url: my_url,
				data: formData,
				dataType: 'json',
				success: function (data) {
					var currencyResult = '<h3>' + data.totalAmount + ' ' + data.toCode + '</h3>';
					currencyResult += '<br> 1 ' + data.fromName + ' equals ' + data.unitAmount + ' ' + data.toCode;
					currencyResult += '<br> ' + data.fromName + ' data last updated on ' + data.CurrencyFromUpdateDt;
					currencyResult += '<br> ' + data.toName + ' data last updated on ' + data.CurrencyToUpdateDt;
					$('#lblamount').html(currencyResult);
				},
				error: function (data) {
					console.log('Error:', data);
				}
			});
		} else {
			$('#lblamount').html('<h5 style="color:red;">Enter an amount</h5>');
		}
	};

});
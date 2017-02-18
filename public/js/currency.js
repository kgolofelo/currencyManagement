$(document).ready(function(){

    var url = "currency";

    // Display modal form for currency editing
	function triggerEdit()
	{
		$('.open-modal').click(function(){
			var currency_id = $(this).val();

			$.get(url + '/' + currency_id, function (data) {
				$('#currency_id').val(data.id);
				$('#name').val(data.name);
				$('#code').val(data.code);
				$('#rate').val(data.rate);
				$('#btn-save').val("update");

				$('#myModal').modal('show');
			}) 
		});
	}

    // Display modal form for creating a new currency
	$('#btn-add').click(function(){
		$('#btn-save').val("add");
		$('#frmCurrencies').trigger("reset");
		$('#myModal').modal('show');
	});
    

    // Delete currency and remove it from list
	function triggerDelete()
	{
		$('.delete-currency').click(function(){
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
			})
			var currency_id = $(this).val();

			$.ajax({

				type: "DELETE",
				url: url + '/' + currency_id,
				success: function (data) {
					console.log(data);

					$("#currency" + currency_id).remove();
				},
				error: function (data) {
					console.log('Error:', data);
				}
			});
		});
	}
	
	// Delete all currencies
	$('.delete-all').click(function(){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		})
		
		$.ajax({

			type: "POST",
			url: url + "/destroyAll" ,
			success: function (data) {
				$("#currency-list").html("");
			},
			error: function (data) {
				console.log('Error:', data);
			}
		});
	});
	
    // Create a new currency / Update an existing currency
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault(); 

        var formData = {
            name: $('#name').val(),
            code: $('#code').val(),
			rate: $('#rate').val(),
        }

        // Determines the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();

        var type = "POST"; // New currency
        var currency_id = $('#currency_id').val();;
        var my_url = url;

        if (state == "update"){
            type = "PUT"; // Updating an existing currency
            my_url += '/' + currency_id;
        }

        $.ajax({

            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                var currency = '<tr id="currency' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.code + '</td><td>' + data.rate + '</td><td>' + data.created_at + '</td><td>' + data.updated_at + '</td>';
                currency += '<td><button class="btn btn-warning btn-xs btn-detail open-modal" value="' + data.id + '">Edit</button>';
                currency += '<button class="btn btn-danger btn-xs btn-delete delete-currency" value="' + data.id + '">Delete</button></td></tr>';

                if (state == "add"){ // New record
                    $('#currency-list').append(currency);
                }else{ // Existing record
                    $("#currency" + currency_id).replaceWith( currency );
                }

                $('#frmCurrencies').trigger("reset");
				triggerEdit();
				triggerDelete();

                $('#myModal').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
	
	triggerEdit();
	triggerDelete();
});
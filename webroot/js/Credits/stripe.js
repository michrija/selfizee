
	var stripe = Stripe('pk_test_TmuB0JraZcQXqqYSrAsAem2100I1do7YQR');
	var form = $('#payment-form');
	form.submit(function(e) {
		var email = $('input[name="email"]').val();
		var name = $('input[name="name"]').val();
		var numbercard = $('input[name="number"]').val();
		e.preventDefault();
		form.find('.button').attr('disabled',true);
		
	stripe.createToken('bank_account', {
						  country: 'US',
						  currency: 'usd',
						  routing_number: '110000000',
						  account_number: '000123456789',
						  account_holder_name: name,
						  account_holder_type: 'individual',
						}).then(function(result,response) {

						 if (result.error) {
						 	form.prepend('<div class = "btn-danger">'+result.error.message+'</>')
						 }else {
						     var token = result.token.id
						     form.append($('<input type="hidden" name="stripeToken">').val(token))
						 	form.get(0).submit();
						 }
			
						});
	});
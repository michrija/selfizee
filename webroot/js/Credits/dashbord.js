 $(window).bind("load", function() {
   var id = $('.sessionId').val();
   var stripe = Stripe('pk_test_TmuB0JraZcQXqqYSrAsAem2100I1do7YQR');
   stripe.redirectToCheckout({
 
  // Make the id field from the Checkout Session creation API response
  // available to this file, so you can provide it as parameter here
  // instead of the {{CHECKOUT_SESSION_ID}} placeholder.
  sessionId: id,
}).then(function (result) {
  // If `redirectToCheckout` fails due to a browser or network
  // error, display the localized error message to your customer
  // using `result.error.message`.
});
 });



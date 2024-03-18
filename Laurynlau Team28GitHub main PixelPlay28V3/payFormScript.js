function validatePayment(){
  // Variables
  var cardNumber = document.getElementById('cardNumber').value;
  var cardExpiry = document.getElementById('cardExpiry').value;
  var cardCVV = document.getElementById('cardCVV').value;
  var today = new Date().toISOString().split('T')[0];


  //Validate the card number - 16 digits of only numbers
  if (/^\d{16}$/.test(number)) {
          alert('Valid number!');
          return true;
      } else {
          alert('Invalid number. Please enter a 16-digit numeric value.');
          return false;
      }

  if (cardExpiry < today) {
          alert('Invalid expiry date. Please select a date on or after today.');
          return false;
      } else {
      return true;
    }
} // validatePayment function close bracket

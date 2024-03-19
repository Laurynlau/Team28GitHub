var total = 0;
  // Function to calculate and update the subtotal for a specific product
  function updateSubtotal(event, productId, price) {
      // Prevent page reload
      event.preventDefault();

      // Get the quantity value
      var quantityInput = document.getElementById('quantity' + productId);
      var quantity = parseInt(quantityInput.value);

      // Calculate the subtotal
      var subtotal = price * quantity;

      // Update the subtotal element
      var subtotalElement = document.getElementById('subtotal' + productId);
      subtotalElement.innerText = 'Subtotal: £' + subtotal.toFixed(2);

      updateTotal();
  }

  function updateTotal() {
  // Reset total to zero
  total = 0;

  // Loop through all product subtotals and add to the total
  var subtotalElements = document.querySelectorAll('[id^="subtotal"]');
  subtotalElements.forEach(function (element) {
      var subtotal = parseFloat(element.innerText.replace('Subtotal: £', ''));
      total += subtotal;
  });

  // Update the total element
  var totalElement = document.getElementById('total');
  totalElement.innerText = '£' + total.toFixed(2);
}

updateTotal();

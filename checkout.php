<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image:url("FoodImage.jpg");
      margin: 0;
      padding: 20px;
    }

    h2 {
      color: #333;
      text-align: center;
    }

    form {
      max-width: 500px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      margin-bottom: 10px;
      color: #333;
    }

    input[type="text"],
    input[type="date"],
    input[type="tel"],
    input[type="radio"] {
      width: calc(100% - 20px);
      /* Adjust width to leave space for radio buttons */
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }

    input[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: yellow;
      color: black;
      font-size: medium;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
      background-color: darkorange;
    }

    #phoneNumberError {
      color: red;
      display: none;
    }

    .payment-method input[type="radio"] {
      /* Hide the default radio button */
      display: none;
    }

    .payment-method label {
      /* Style for the label */
      display: inline-block;
      margin-right: 10px;
      cursor: pointer;
    }

    .payment-method label::before {
      /* Radio button style */
      content: "";
      display: inline-block;
      width: 20px; /* Adjust size as needed */
      height: 20px; /* Adjust size as needed */
      border: 2px solid #333; /* Border color */
      border-radius: 50%; /* Make it circular */
      margin-right: 5px; /* Add spacing between label and button */
    }

    .payment-method input[type="radio"]:checked + label::before {
      /* Style for checked radio button */
      background-color: #333; /* Background color when checked */
    }

  </style>
</head>

<body>
  <h2>Checkout</h2>
  <form action="Process_Checkout.php" method="POST">
    <label for="deliveryAddress">Delivery Address:</label>
    <input type="text" id="deliveryAddress" name="deliveryAddress" required><br><br>

    <label for="deliveryDate">Delivery Date:</label>
    <input type="date" id="deliveryDate" name="deliveryDate" required><br><br>

    <label for="phoneNumber">Phone Number:</label>
    <input type="tel" id="phoneNumber" name="phoneNumber" pattern="[0-9]{10}" required>
    <span id="phoneNumberError" style="color: red; display: none;">Phone number must start with 98</span>
    <br><br>

    <label for="paymentMethod">Payment Method:</label><br>
    <div class="payment-method">
      <input type="radio" id="fonePay" name="paymentMethod" value="fonePay" required>
      <label for="fonePay">FonePay</label><br>
      <input type="radio" id="cashOnDelivery" name="paymentMethod" value="cashOnDelivery" required>
      <label for="cashOnDelivery">Cash on Delivery</label><br><br>
    </div>

    <input type="submit" value="Place Order">
  </form>

  <script>
    function setCurrentDateTime() {
      var currentDate = new Date().toISOString().slice(0, 10);
      var currentTime = new Date().toLocaleTimeString([], {
        hour: '2-digit',
        minute: '2-digit'
      });

      document.getElementById('deliveryDate').value = currentDate;
      document.getElementById('deliveryTime').value = currentTime;
    }

    // Call setCurrentDateTime() when the page is fully loaded
    document.addEventListener('DOMContentLoaded', function() {
      setCurrentDateTime();
    });

    function validatePhoneNumber() {
      var phoneNumberInput = document.getElementById('phoneNumber');
      var phoneNumber = phoneNumberInput.value;

      if (!phoneNumber.startsWith('98')) {
        document.getElementById('phoneNumberError').style.display = 'block';
        phoneNumberInput.focus();
        return false;
      }

      return true;
    }
  </script>
</body>

</html>
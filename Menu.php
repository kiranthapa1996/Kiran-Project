<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url("food3.jpg");
      margin: 0;
      padding: 0;
    }

    h1 {
      margin-left: 570px;
      color: white;
    }

    #contentWrapper {
      display: flex;
    }

    #menuItemsContainer {
      max-width: 800px;
      padding: 20px;
      margin-left: 350px;
    }

    .menuItem {
      background-color: #fff;
      color: black;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      padding: 20px;
      margin-bottom: 20px;
      border: 2px solid black;
    }

    .menuItem h3 {
      margin-top: 0;
      color: black;
    }

    .menuItem p {
      margin-bottom: 10px;
      color: black;
    }

    .menuItem button {
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .menuItem button:hover {
      background-color: #0056b3;
    }

    #calculationpart {
      background-color: white;
      padding: 20px;
      border: 2px solid black;
      margin-left: 20px;
      flex: 1;
    }

    #orderSummary {
      padding: 0;
      max-height: 300px;
      /* Adjust the maximum height as needed */
      overflow-y: auto;
      /* Enable vertical scrolling */
    }

    #orderSummary li {
      list-style: decimal;
      margin-bottom: 5px;
    }

    #checkoutButton {
      background-color: yellow;
      border: 2px solid black;
      cursor: pointer;
      margin-top: 20px;
    }

    #checkoutButton:hover {
      background-color: darkorange;
    }
  </style>
</head>

<body>
  <h1><u>Menus</u></h1>
  <div id="contentWrapper">
    <div id="menuItemsContainer">
      <!-- Food items will be dynamically rendered here -->
    </div>

    <div class="calculationpart" id="calculationpart" style="display: none;">
      <h2>Order Summary</h2>
      <ol id="orderSummary"></ol>
      <div id="totals">
        <p>Subtotal: Rs. <span id="subtotal">0.00</span></p>
        <p>Delivery Charge: Rs. <span id="deliveryCharge">20.00</span></p>
        <p>Grand Total: Rs. <span id="grandTotal">0.00</span></p>
      </div>
      <button id="checkoutButton" onclick="proceedToCheckout()">Proceed to Checkout</button>
      <button id="cancelButton" onclick="cancelOrder()">Cancel</button>
    </div>
  </div>
  <script>
    function proceedToCheckout() {
      // Redirect to the checkout page
      window.location.href = "checkout.php";
    }

    let selectedItems = []; // Array to store selected item IDs
    const deliveryCharge = 20.00; // Delivery charge

    // Fetch food items from the server
    $(document).ready(function() {
      $.ajax({
        url: 'ProcessOrder.php', // Server-side script to fetch menu items
        method: 'GET',
        success: function(data) {
          renderMenuItems(data); // Call a function to render the menu items
        },
        error: function(xhr, status, error) {
          console.error('Error fetching menu items:', error);
        }
      });
    });

    // Function to render menu items
    function renderMenuItems(menuItems) {
      var menuItemsContainer = $('#menuItemsContainer');
      menuItems.forEach(function(item) {
        var menuItemHtml = `
      <div class="menuItem">
        <h3>${item.name}</h3>
        <p>Description: ${item.description}</p>
        <p>Price: Rs. ${item.price}</p>
        <button onclick="buyItem(${item.id}, '${item.name}', ${item.price})">Buy</button>
        <button onclick="addToCart(${item.id}, ${item.price})">Add to Cart</button>
        <button onclick="addToFavorites(${item.id})">Add to Favorites</button>
      </div>
    `;
        menuItemsContainer.append(menuItemHtml);
      });
    }

    function buyItem(itemId, itemName, itemPrice) {
      console.log("Buying item with ID: " + itemId);
      selectedItems.push({
        id: itemId,
        name: itemName,
        price: itemPrice
      });

      // Update order summary
      updateOrderSummary();

      // Show calculation part
      $("#calculationpart").show();
    }

    // Function to handle "Add to Cart" button click
    // Function to handle "Add to Cart" button click
    function addToCart(itemId) {
      // Get the current date and time
      var currentDate = new Date().toISOString().slice(0, 19).replace('T', ' ');

      // Send an AJAX request to addToCart.php
      $.ajax({
        url: 'addToCart.php',
        method: 'POST',
        data: {
          itemId: itemId,
          addedDateTime: currentDate
          // Add other data like userId if needed
        },
        success: function(response) {
          alert(response); // Display the response from the server
        },
        error: function(xhr, status, error) {
          console.error('Error adding item to cart:', error);
        }
      });
    }

    $(document).ready(function() {
      // Initialize variables
      var calculationPart = $("#calculationpart");
      var menuItemsContainer = $("#menuItemsContainer");
      var menuOffsetTop = menuItemsContainer.offset().top;
      var calculationPartInitialTop = calculationPart.offset().top;

      // Update the position of the calculation part based on scroll
      $(window).scroll(function() {
        var scrollTop = $(window).scrollTop();
        var windowHeight = $(window).height();
        var calculationPartHeight = calculationPart.outerHeight();
        var bottomMargin = 20; // Adjust as needed

        // Check if the calculation part is outside the viewport
        if (scrollTop > menuOffsetTop && scrollTop + windowHeight > menuOffsetTop + calculationPartInitialTop + calculationPartHeight + bottomMargin) {
          calculationPart.css({
            "position": "fixed",
            "top": windowHeight - calculationPartHeight - bottomMargin,
          });
        } else {
          calculationPart.css({
            "position": "absolute",
            "top": calculationPartInitialTop,
          });
        }
      });
    });


    function updateOrderSummary() {
      let subtotal = 0;
      let orderSummaryHtml = "";

      selectedItems.forEach(item => {
        subtotal += parseFloat(item.price);
        orderSummaryHtml += `<li>${item.name}: Rs. ${item.price}</li>`;
      });

      const grandTotal = subtotal + deliveryCharge;

      $("#orderSummary").html(orderSummaryHtml);
      $("#subtotal").text(subtotal.toFixed(2));
      $("#grandTotal").text(grandTotal.toFixed(2));
    }


    // Function to handle Favorite button click
    function addToFavorites(itemId) {
      // Send an AJAX request to addToFavorites.php
      $.ajax({
        url: 'Myfavorites.php',
        method: 'POST',
        data: {
          itemId: itemId
        },
        success: function(response) {
          alert(response); // Display the response from the server
        },
        error: function(xhr, status, error) {
          console.error('Error adding item to favorites:', error);
        }
      });
    }

    function cancelOrder() {
      // Remove the last selected item from the array
      selectedItems.pop();

      // Update order summary
      updateOrderSummary();

      // Check if there are no more selected items
      if (selectedItems.length === 0) {
        // If no items are selected, hide the order summary section
        $("#calculationpart").hide();
      }
    }
  </script>
</body>

</html>
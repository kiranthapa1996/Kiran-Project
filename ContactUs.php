<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="form.css">
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      document.getElementById('contactForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission

        // Fetch form data
        var formData = new FormData(this);

        // Send form data to PHP script using AJAX
        fetch('submit_form.php', {
          method: 'POST',
          body: formData
        })
        .then(response => response.text())
        .then(data => {
          alert(data); // Display the response message
          this.reset(); // Reset the form after successful submission
        })
        .catch(error => console.error('Error:', error));
      });
    });
  </script>
</head>
<body>
  <div class="form-container">
    <h2>Contact Us</h2>
    <form id="contactForm" action="submit_form.php" method="post">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" placeholder="Your Name" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" placeholder="Your Email" required>

      <label for="message">Message:</label>
      <textarea id="message" name="message" placeholder="Your Message" required></textarea>

      <button type="submit">Submit</button>
    </form>
  </div>
</body>
</html>

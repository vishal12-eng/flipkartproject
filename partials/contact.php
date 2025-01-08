<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header>
        <h1>Contact Us</h1>
    </header>

    <main>
        <section id="contact-info">
            <h2>Our Contact Information</h2>
            <p>If you have any questions, feel free to reach out to us:</p>
            <ul>
                <li><strong>Phone:</strong> (123) 456-7890</li>
                <li><strong>Email:</strong> contact@yourcompany.com</li>
                <li><strong>Address:</strong> 123 Business St, Suite 400, City, State, Zip Code</li>
            </ul>
        </section>

        <section id="contact-form">
            <h2>Send Us a Message</h2>
            <form action="submit_form.php" method="POST">
                <label for="name">Your Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Your Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Your Message:</label>
                <textarea id="message" name="message" rows="4" required></textarea>

                <button type="submit">Send Message</button>
            </form>
        </section>

        <section id="location">
            <h2>Our Location</h2>
            <p>Visit us at our office:</p>
            <div id="map">
                <!-- Replace with an actual embedded map if needed -->
                <p>Map Placeholder</p>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Your Company Name. All rights reserved.</p>
    </footer>

</body>
</html>

<?php
include('partials-front/menu.php'); ?>


<html>
<head>
    <title>Contact Form</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<div class="contact">
    <h1>Contact Us</h1>
    <br><br>

    <form action="" method="POST" class="text-center">
        <div class="input-row">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter Your Name" required>
        </div>

        <div class="input-row">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter Your Email" required>
        </div>

        <div class="input-row">
            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" placeholder="Enter Your Phone Number" required>
        </div>

        <div class="input-row">
            <label for="feedback">Feedback:</label>
            <textarea id="feedback" name="feedback" placeholder="Enter Your Feedback" required></textarea>
        </div>

        <input type="submit" name="submit" value="Submit" class="btn-primary">
    </form>
</div>

</body>
</html>

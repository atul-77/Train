<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to signup Page</title>
    <link rel="stylesheet" href="bas.css">
</head>
<body>
    <img src="bg.jpg" alt="choochoo" class="bg">
    <div class="container">
        <h1>Welcome to Signup page for Booking portal</h1>
        <p>Please Enter your details to proceed</p>
        <form action="mainPage.php" method="post">
            <input type="text" name="name" id="naam" placeholder="Enter your name">
            <input type="text" name="address" id="jagah" placeholder="Enter your address">
            <input type="text" name="credit" id="credit" placeholder="Enter your credit card number">
            <button class="btn">
                Submit
            </button>

        </form>
    </div>
    <script src="bas.js"></script>
    
</body>
</html>
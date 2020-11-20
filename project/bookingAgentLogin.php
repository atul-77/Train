<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets\css\bookingAgentLogin.css">
</head>
<script src="bookingAgentLogin.js"></script>
<body>
    <div class="container">
        <h1>Railway Reservation System</h1>
        <h3>Login Page</h3>
        <form action="php\bookingAgent.php" method="post">
            <input type="name" name="name" id="name" placeholder="Enter your Full Name">
            <input type="cno" name="cno" id="cno" placeholder="Enter your Credit Card No">
            <br>
            <button class="btn" name="Submit">Submit</button>
            <p>Not a user already?Click <a href="php\mainpage.php">here</a> to sign up.</p>
        </form>
    </div>
</body>
</html>



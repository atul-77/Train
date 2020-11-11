<html>
    <head>
        <title>Login Page</title>
    </head>

    <link rel="stylesheet" href="assets/css/admin.css">
    <body bgcolor = "#FFFFFF">
        <div align = "center">
            <div style="width:300px; border: solid 1px #333333;" align="left">
                <div style="background-color: #333333; color: #FFFFFF; padding: 3px;"><b>Login</b></div>

                <div style="margin:30px;">
                    <form action="php/adminpage.php" method="post">
                        <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                        <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                        <input type = "submit" value = " Submit "/><br />
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
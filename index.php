<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include 'functions.php';
    if (isset($_COOKIE['id'])){
        header("Location: login.php?id=".$_COOKIE['id']);
    }
      view_header('Login',"login.css");   
    
    
    if(isset($_POST['submit']))
    {
        check_login();
    } else {
        echo "</br></br><form action='index.php' method='post'>
        Username: <input name='username' type='text'></br>
        Password: <input name='password' type='password'></br></br>
        <input type='submit' value='Login' name='submit'></form></br>
        <a href='add.php'>Register</a></br></span></div></body>";
    }
    
        ?>
    </body>
</html>

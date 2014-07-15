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
        
        // put your code here
     if (!isset($_GET['logout'])){
         if (!isset($_COOKIE['id'])){
             header("Location:index.php");
         }         
    }else{
        setcookie('id' , '' ,(time() - 3600));
        header("Location:index.php");
    }
    $user_id= $_COOKIE['id'];
        diplay_home_page($user_id);
        home_body($user_id);
       

        ?>
    </body>
</html>

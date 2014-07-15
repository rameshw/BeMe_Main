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
    //Database connection info
        include 'functions.php';   
        
        // put your code here
     if (!isset($_GET['logout'])){
         if (!isset($_COOKIE['id'])){
             header("Location:index.php");
         }  
        diplay_main_page();
    }else{
        setcookie('id' , '' ,(time() - 3600));
        header("Location:index.php");
    }
    
    
        ?>
    </body>
</html>

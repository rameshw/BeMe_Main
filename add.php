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
          
        //diplay_home_page();
    }else{
        setcookie('id' , '' ,(time() - 3600));
        header("Location:index.php");
    }
    
    view_header('Add Account',"login.css");
    
    
    if(isset($_POST['submit']))
    {
        add_acount();
    } else {
        add_account_message("");
    }
        
    

        ?>
    </body>
</html>

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
        
        if (!isset($_GET['logout'])){
         if (!isset($_COOKIE['id'])){
             header("Location:index.php");
         }  
        //diplay_home_page();
    }else{
        setcookie('id' , '' ,(time() - 3600));
        header("Location:index.php");
    } 
    view_header("Update Account","update.css");
        
    
    if(isset($_POST['submit']))
    {
        update_acount();
    } else {
        echo "</br></br><form action='update.php' method='post'>
        <p class='text'>Current Role:</p><input class='data' name='role' type='text' rows='3' cols='40'></br> 
        <p class='text'>Stories I Share:</p><input class='data'  name='stories' type='text' rows='3' cols='40'></br>
        <p class='text'>Frequent Expriences:</p><input class='data'  name='exp' type='text' rows='3' cols='40'></br>
        <p class='text'>My Events:</p><input class='data'  name='events' type='text' rows='3' cols='40'></br>
        <p class='text'>My Perpectives:</p><input class='data'  name='pers' type='text' rows='3' cols='40'></br></br>
        <input type='submit' value='Update' name='submit'></form></br>
        <a href='login.php'>Back</a></span></div></body>'";
    }
        
    
        ?>
    </body>
</html>

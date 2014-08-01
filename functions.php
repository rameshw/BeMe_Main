<?php
static $host = "127.0.0.1:3306";
static $username = "root";
static $password = "";
static $dbname = "beme";

function diplay_main_page(){
        global $host, $username, $password, $dbname;
        
        $user_id= $_COOKIE['id'];
        $con = mysql_connect($host, $username, $password );
        mysql_select_db($dbname, $con);

        if (mysql_errno())
        {
            return "Error: Failed to connect to MySQL: " . mysql_error();
        }
        $result = mysql_query("select user_name_first, user_name_surname from user_info where user_id='$user_id';", $con);
        $row = mysql_fetch_array($result);
        $name1= $row['user_name_first']; 
        $name2= $row['user_name_surname']; 
        mysql_close($con);
        //connect
        view_header("Welcome","login.css");
       
         echo "$name1 $name2!!!</br></br>Who would you like to be today?</br>
        <a href='home.php'>My Homepage</a></br>
        <a href='bemore.php'>BeMore</a></br>
        <a href='update.php'>Update Profile</a></br>
        <a href='?logout=true'>Logout</a>
        
        </span>       
        </div>
        </body>";    
 }
 
 function show_footer(){
             echo "<div id ='footer'>
             <div class='foot'><a href ='about.php'>about</a></div>
             <div class='foot'><a href ='about.php'>contact</a></div>
             <div class='foot'><a href ='about.php'>faq</a></div>
             <div class='foot'><a href ='about.php'>terms</a></div>
             <div class='foot'><a href ='about.php'>privacy</a></div></br>
             <div >a Ramesh Weerakoon production</div>
             <div >BeMe.com © 2014</div>
             </div>";
  }
  
  
  function show_add_story(){
            echo  "<div id='stories'><p class='myinfo'><b>My Stories</b></p>
              <div id='addstory'><form action='home.php' method='post'>
            <p class='addstr'>Story Title:</p><input name='title' type='text'/><br>
            <p class='addstr'>Link:</p><input name='link' type='text'/></br>
            <input type='submit' value='Add Story' name='submit'></form>  
            </div>";
}
        
   
        
 function view_header($page_name,$css){
        echo "<head>
            <title>BeMe.com $page_name</title>
                <meta http-equiv=content-type content='text/html; charset=utf-8'>
                <meta http-equiv=imagetoolbar content=false>
                <meta name=viewport content='initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no'>
                <meta name=format-detection content='telephone=no'>
                <link rel=icon type=image/png href=logo.png>
                <link rel=stylesheet href=$css>
                <link rel='icon' href='/favicon.ico'>
                <script type='text/javascript' src=keymaster.min.js></script>
                <script type='text/javascript' src='jquery.min.js'></script>
            </head>
            <body id='body'>";

        echo "<div id='header'><span id='span1'></br>Welcome to BeMe.com
        </br>";
    }       
 
function add_acount(){
        
        global $host, $username, $password, $dbname;
        $user_name_first=$_POST['first_name'];
        $user_name_last=$_POST['last_name'];
        $user_name=$_POST['username'];
        $user_pass=$_POST['password'];
        if ($user_name_first=="" or $user_name_last=="" or $user_name=="" or $user_pass==""){       
            add_account_message('Some fields empty');
            exit();
        }
        
        
        $con = mysql_connect($host, $username, $password );
        mysql_select_db($dbname, $con);

        if (mysql_errno())
        {
            return "Error: Failed to connect to MySQL: " . mysql_error();
        }
        
        $result = mysql_query("select user_id from user_info ='$user_name';", $con);
         $row = mysql_fetch_array($result);
         if ($row==null){
         
             $result = mysql_query("INSERT INTO user_info (user_name, user_name_first, user_name_surname, user_password) VALUES ('$user_name', '$user_name_first', '$user_name_last', '$user_pass');", $con);
             $row = mysql_fetch_array($result);

             $result = mysql_query("select user_id from  user_info where user_name='$user_name' and user_name_first='$user_name_first' and user_name_surname= '$user_name_last'and user_password='$user_pass';", $con);
             $row = mysql_fetch_array($result);
             
             $id=$row['user_id'];
             $result = mysql_query("INSERT INTO user_more_info (user_id, user_count, user_role, user_stories, user_exp, user_events, user_pers) VALUES ( $id, 0, '', '', '', '','');", $con);
             $row = mysql_fetch_array($result);
            
             add_account_message("New Account Added!");            

         }else{
             add_account_message('Username Already Exist!!');    
         }
         mysql_close($con);
}

function add_account_message($message){
   echo "</br><form action='add.php' method='post'>
                First Name: <input name='first_name' type='text'></br> 
                Last Name: <input name='last_name' type='text'></br>
                Username: <input name='username' type='text'></br>
                Password: <input name='password' type='password'></br>
                $message</br>
                <input type='submit' value='Register' name='submit'></form></br>
                
                <a href='index.php'>Sign In</a></span></div></body>";
  
}


function check_login(){      
        global $host, $username, $password, $dbname;
        $user_name=$_POST['username'];
        $user_pass=$_POST['password'];
        
        $con = mysql_connect($host, $username, $password );
        mysql_select_db($dbname, $con);

        if (mysql_errno())
        {
            return "Error: Failed to connect to MySQL: " . mysql_error();
        }

         $result = mysql_query("select user_id from user_info where user_name='$user_name' and user_password='$user_pass';", $con);
         $row = mysql_fetch_array($result);
         mysql_close($con);
         if ($row==null){           
             echo "</br><form action='index.php' method='post'>
               Wrong Username or Password!</br>
               Username: <input name='username' type='text'></br>
               Password: <input name='password' type='password'></br></br>
               <input type='submit' name='submit' value='Login'></form></br></span></div></body>";        
        }else{
               $user_id=$row['user_id'];              
               setcookie('id' , $user_id ,(time() + 3600));
               header("Location: login.php");
        }  
    } 
    
function add_story(){
        global $host, $username, $password, $dbname;
        $story_title=$_POST['title'];
        $video_link=$_POST['link'];
        $id=$_COOKIE['id'];
        
        if ($story_title!="" and $video_link!="") {
            $con = mysql_connect($host, $username, $password );
            mysql_select_db($dbname, $con);

            if (mysql_errno())
            {
                return "Error: Failed to connect to MySQL: " . mysql_error();
            }

             $result = mysql_query("INSERT INTO user_stories (user_id, story_title, story_link) values($id, '$story_title', '$video_link');", $con);
             $row = mysql_fetch_array($result);
              mysql_close($con);
        }
}

function diplay_home_page($user_id){
        
            global $host, $username, $password, $dbname;
            //$user_id= $_COOKIE['id'];
            $con = mysql_connect($host, $username, $password );
            mysql_select_db($dbname, $con);

            if (mysql_errno())
            {
                return "Error: Failed to connect to MySQL: " . mysql_error();
            }
            $result = mysql_query("select user_name_first, user_name_surname from user_info where user_id='$user_id';", $con);
            $row = mysql_fetch_array($result);
            $firstname= $row['user_name_first']; 
            $secondname= $row['user_name_surname']; 
            
            $result = mysql_query("select user_count from user_more_info where user_id='$user_id';", $con);
            $row = mysql_fetch_array($result);
            $count= $row['user_count'];
            mysql_close($con);
            display_header($firstname, $secondname, $count,$user_id);
} 

function display_header($firstname, $secondname, $count,$user_id){
            
         echo "<head>
        <title>BeMe.com- Home</title>
            <meta http-equiv=content-type content='text/html; charset=utf-8'>
            <meta http-equiv=imagetoolbar content=false>
            <meta name=viewport content='initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no'>
            <meta name=format-detection content='telephone=no'>
            <link rel='icon' href='/favicon.ico'>
            <link rel=stylesheet href=home.css>
            <script type='text/javascript' src=keymaster.min.js></script>
            <script type='text/javascript' src='jquery.min.js'></script>
        </head>
        <body id='body'>";
         echo "<div  id='header'>
        <div id='main1' class='tabs' style='width:15%;'><a href ='about.php' id='main' class='links'>BeMe.com</a></div>
        <div class='tabs' style='width:10%;'><a href ='?logout=true' class='links'>Logout</a></div>";
         
        //if user is not me
        if ($_COOKIE['id']!="$user_id"){
            echo "<div class='tabs' style='width:10%;'><a href ='home.php' class='links'>My Page</a></div>
        <div class='tabs' style='width:40%;'><a href ='view_user.php?id=$user_id' class='links'>$firstname $secondname</a></div>
        <div class='tabs' style='width:10%;'><a href ='addCount.php' class='links'>Be$firstname $count</a></div>
        <div class='tabs' style='width:10%;'><a href ='bemore.php' class='links'>BeMore</a></div>
        </div>";
            
        }else{
        ///////////// 
         echo "<div class='tabs' style='width:10%;'><a href ='update.php' class='links'>My Page</a></div>
        <div class='tabs' style='width:40%;'><a href ='home.php' class='links'>$firstname $secondname</a></div>
        <div class='tabs' style='width:10%;'><a href ='home.php' class='links'>BeMe $count</a></div>
        <div class='tabs' style='width:10%;'><a href ='bemore.php' class='links'>BeMore</a></div>
        </div>";
        }
} 

function home_body($user_id){
            global $host, $username, $password, $dbname;
            //$user_id= $_COOKIE['id'];
            $con = mysql_connect($host, $username, $password );
            mysql_select_db($dbname, $con);

            if (mysql_errno())
            {
                return "Error: Failed to connect to MySQL: " . mysql_error();
            }
            $result = mysql_query("select a.user_name_first, b.user_role, b.user_stories,b.user_exp,b.user_events,b.user_pers from user_info a, user_more_info b where a.user_id=$user_id and a.user_id=b.user_id;", $con);
            $row = mysql_fetch_array($result);
            $name=$row['user_name_first'];
            $role= $row['user_role']; 
            $stories= $row['user_stories']; 
            $exp= $row['user_exp']; 
            $events= $row['user_events']; 
            $pers= $row['user_pers']; 
            mysql_close($con);         
            
        echo "<div class ='left' >
            </br>
            <p id='events' class='myinfo'><b>My Events</b></p>
        </div>
        <div class ='right' >
            </br>
            <div id='aboutme' ><p class='myinfo'><b>About $name</b></br>
            I am a: $role </br>
            Stories I Share: $stories </br>
            Typical Day: $exp </br>
            My Events: $events </br>
            My Perspectives: $pers </br>
            </p></div>";
        
        if ($_COOKIE['id']==$user_id)
        {
            show_add_story();
        }
        
        if(isset($_POST['submit']))
        {
            add_story();
        }
        $con = mysql_connect($host, $username, $password );
            mysql_select_db($dbname, $con);

            if (mysql_errno())
            {
                return "Error: Failed to connect to MySQL: " . mysql_error();
            }
        $result = mysql_query("select count(user_id) as counts from user_stories where user_id=$user_id;", $con); 
        $row = mysql_fetch_array($result);
        $count=$row['counts'];
        mysql_close($con);     
        $height=300 + ($count*450);   
           echo"<style>
            .right{
                height:$height" . "px;
            }
            
            .left{
                height:$height". "px;
            }
            </style>";
           
        
        get_stories($user_id);
        echo "</div></div>";
        show_footer();
        echo "</body>";
}

 function get_stories($user_id){
        
            global $host, $username, $password, $dbname;
            
            $con = mysql_connect($host, $username, $password );
            mysql_select_db($dbname, $con);

            if (mysql_errno())
            {
                return "Error: Failed to connect to MySQL: " . mysql_error();
            }
            $result = mysql_query("select story_title, story_link from user_stories where user_id=$user_id;", $con);
           
            while($row = mysql_fetch_array($result)) {
               $title=$row['story_title'] ;
               $link=$row['story_link'];
               parse_str(parse_url($link,PHP_URL_QUERY),$arr);
               $video_id=$arr['v'];
               
               $data=@file_get_contents('http://gdata.youtube.com/feeds/api/videos/'.$video_id.'?v=2&alt=jsonc');
                if (false===$data) "return false";

                $obj=json_decode($data);
                $duration= $obj->data->duration;
                $duration=number_format((float)$duration/60, 1, '.', '');
                $views = $obj->data->viewCount;
                echo "<div class='eachstory'>&nbsp;&nbsp;&nbsp;&nbsp;<p class='allstories'>Story Title: $title</p>&nbsp;&nbsp;&nbsp;&nbsp;<p class='allstories'>Duration: $duration mins</p>&nbsp;&nbsp;&nbsp;&nbsp;<p class='allstories'>Views: $views</p></br>
                        &nbsp;&nbsp;&nbsp;&nbsp;<iframe width='600' height='345' src='http://www.youtube.com/embed/$video_id'> </iframe></br>
                        
                        </div>";
               //echo "&nbsp;&nbsp;&nbsp;&nbsp;<iframe src='$link' frameborder='0' width='100%' height='100%'></iframe></div>";
             }           
            
             mysql_close($con);
        }
        
 function update_acount(){
      global $host, $username, $password, $dbname;
        
        $id=$_COOKIE['id'];
        $role=$_POST['role'];
        $stories=$_POST['stories'];
        $exp=$_POST['exp'];
        $events=$_POST['events'];
        $pers=$_POST['pers'];
        
        $con = mysql_connect($host, $username, $password );
        mysql_select_db($dbname, $con);

        if (mysql_errno())
        {
            return "Error: Failed to connect to MySQL: " . mysql_error();
        }

         $result = mysql_query("update user_more_info set user_role='$role', user_stories='$stories', user_exp='$exp', user_events='$events', user_pers='$pers' where user_id=$id;", $con);
         $row = mysql_fetch_array($result);
         mysql_close($con);   
        
         echo "</br><form action='update.php' method='post'>
        <p class='text'>Current Role:</p><input class='data' name='role' type='text' rows='3' cols='40'></br> 
        <p class='text'>Stories I Share:</p><input class='data'  name='stories' type='text' rows='3' cols='40'></br>
        <p class='text'>Frequent Expriences:</p><input class='data'  name='exp' type='text' rows='3' cols='40'></br>
        <p class='text'>My Events:</p><input class='data'  name='events' type='text' rows='3' cols='40'></br>
        <p class='text'>My Perpectives:</p><input class='data'  name='pers' type='text' rows='3' cols='40'></br></br>
        Account Updated!
        <input type='submit' value='Update' name='submit'></form></br>
        <a href='login.php'>Back</a></span></div></body>'";             
    }
    
    
  function display_users(){
           global $host, $username, $password, $dbname;
            $id_user=$_COOKIE['id'];
            $con = mysql_connect($host, $username, $password );
            mysql_select_db($dbname, $con);

            if (mysql_errno())
            {
                return "Error: Failed to connect to MySQL: " . mysql_error();
            }
            $result = mysql_query("select a.user_id, a.user_name_first, a.user_name_surname, b.user_count, b.user_stories from user_info a, user_more_info b where a.user_id=b.user_id and a.user_id!= $id_user;", $con);
           echo "<div class ='left'>
            </br>
            <p id='events' class='myinfo'><b>My Events</b></p>
            </div>
            <div class ='right'>
            </br></br>";
            while($row = mysql_fetch_array($result)) {
                $id=$row['user_id'] ;
               $name1=$row['user_name_first'] ;
               $name2=$row['user_name_surname'];
               $count=$row['user_count'];
               $stories=$row['user_stories'];

               echo "<div class='users'><a href='view_user.php?id=$id'><b>$name1 $name2</b></a></br>
                    Beme count: $count</br>
                    Stories: $stories</br></div>";
                    
               }           
             
                echo "</div></div>";
                show_footer();
                echo "</body>";
             mysql_close($con);
}  
/* 
 * 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


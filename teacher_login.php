<?php
  
// Connect to database 
$servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "qpaper";
     
   // connect the database with the server
   $conn = new mysqli($servername,$username,$password,$dbname);
  
// mysqli_connect("servername","username","password","database_name")

if ($conn -> connect_errno)
{
   echo "Failed to connect to MySQL: " . $conn -> connect_error;
   exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style2.css"/>
    
<body>
  <br>
  
    <header class="header_section">
        <div class="main">
             <div class="logo">
                 
                     <img src="Untitled.png" width = "200" height = "80" /> 
                 
             </div>
             <div class="nav">
                 <a href="index.html#about">About</a>
                 <a href="teacher_login.php">Teacher</a>
                 <a href="admin_login.php">Admin</a>
                 <a class="active" href="index.html">Home</a>
             </div>
             </div>
        </header>
        
    <main id="main-holder">
        <h1 id="login-header">Login</h1>  
        <div class="login_img">
                 
          <img src="12-123249_teacher-teacher-login.png" width = "120" height = "120" /> 
      
         </div> 
        <form id="login-form" method="post" action="#">
          <input type="text" name="username-field" id="username-field" class="login-form-field" placeholder="Username">
          <input type="password" name="password-field" id="password-field" class="login-form-field" placeholder="Password">
          <input type="submit" value="Login" id="login-form-submit">
        
          <?php
        if(isset($_POST['username-field'])) 
        {
            if(!empty($_POST['username-field'])&& !empty($_POST['password-field']) )
            // Taking  values from the form data(input)
            {   
                $user= $_POST['username-field'];
                $pass= $_POST['password-field'];

                $flag=false;

                $q="SELECT * from user2";
                $q1 = mysqli_query($conn,$q);
                while ($q2 =mysqli_fetch_array($q1,MYSQLI_ASSOC)):; 
                $q3=$q2['username'];
                $q4= $q2['password'];
                if (($user==$q3)&&($pass==$q4))
                {
                  $flag=true;
                  header("Location:teacher.html");
                }

                endwhile; 

            
                if($flag==false)
                {
                     echo "<br>";
                     echo '<span style="color:red;font-weight:bold;">Incorrect Username or Password</span>';

                }
             }
             else
            {
                echo "<br>";
                echo '<span style="color:red;font-weight:bold;">All fields required </span>';
               

            }
          

        
        }
        mysqli_close($conn)
        ?>
        
        </form>
       
      </main>
    
</body>
</html>
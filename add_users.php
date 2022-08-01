
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
  
  // Get all the categories from category table
  
  
  $sql = "SELECT * FROM `branch`";
  $all_b = mysqli_query($conn,$sql);
  
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css"/>
    <title>Document</title>
    
</head>
<body>
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
        <br>
        <br>
        <br>
        <br>
        <br>
    <main id="user_holder">
        <h1 id="user-header">ADD USERS</h1>
        
        
        <form id="user_form" method="post" action="#">
            
            
              <label for="Name"> Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="text" id="name" name="name"><br><br>  
            

<label for="Designation"> Designation:</label>
            <input type="text" id="dname" name="dname"><br><br>
               

            <label for="Branch">Branch:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <select id="Branch" name="Branch">
            <?php 
                // use a while loop to fetch data 
                // from the $all_b variable 
                // and individually display as an option
                while ($branch1 = mysqli_fetch_array(
                        $all_b,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $branch1["bname"];
                    // The value we usually set is the primary key
                ?>">
                    <?php echo $branch1["bname"];
                        // To show the b name to the user
                    ?>
                </option>
            <?php 
                endwhile; 
                // While loop must be terminated
            ?>
            </select><br><br>

          <label for="email">Email-id:&nbsp;&nbsp;&nbsp;</label>
          <input type="email" id="email" name="email"><br><br>  



          <input type="submit" id="add1" value="Add" /><br><br>
          
          <?php
          
          if(isset($_POST['name'])) {
        
              if(!empty($_POST['name']) && !empty($_POST['dname'])&& !empty($_POST['email']))
              // Taking all 5 values from the form data(input)
              {   
                  $namee =  $_POST['name'];
                  $dnamee = $_POST['dname'];
                  $branchh = $_POST['Branch'];
                  $emaill = $_POST['email'];
                  
           
                  
                  
                  $query5 = "INSERT INTO user(uname,dname,bname,email) VALUES('$namee',
                  '$dnamee','$branchh','$emaill')";
                   $run5 = mysqli_query($conn,$query5) or die(mysqli_error());  

                    $q="SELECT userid, uname from user ORDER BY userid DESC LIMIT 1";
                    $q1 = mysqli_query($conn,$q);
                    $q2 =mysqli_fetch_array($q1,MYSQLI_ASSOC);
                    $q3= $q2['userid'];
                    $q4=$q2['uname'];

                    

                     function user_generate($chars) 
                    {
                      $data1 = '1234567890';
                         return substr(str_shuffle($data1), 0, $chars);
                     }
                          $user1=user_generate(4);

                    $user= $q4.$user1;

                     function password_generate($chars1) 
                    {
                      $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
                         return substr(str_shuffle($data), 0, $chars1);
                     }
                          $pass=password_generate(7);
            
                      $query6="INSERT into user2(userid,username,password) values('$q3','$user','$pass')";
                      $run6= mysqli_query($conn,$query6) or die(mysqli_error());  
                  
                  if(($run5==true)&&($run6==true))
                  {
                      
                      echo '<span style="color:green;font-weight:bold;">&nbsp;User added successfully!</span>';
                      echo "<br>";
                      echo "username:";
                      echo  $user;
                      echo "<br>";
                      echo "password:";
                      echo  $pass;



                      
                  }
                  else
                  {
                  
                      echo '<span style="color:red;font-weight:bold;">&nbsp;User not added</span>';
                         
                  }
                  
              }
              else
              {
                  echo '<span style="color:red;font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;All fields required </span>';
                 
  
              }
  
            }
         
          // Close connection
          mysqli_close($conn)
          ?> 
        
        </form>
          

       
      
      </main>
    
</body>
</html>


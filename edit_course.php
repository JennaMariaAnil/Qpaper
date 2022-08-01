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
$sql = "SELECT ccode FROM `course`";
$all_c = mysqli_query($conn,$sql);
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
    <main id="course_holder">
    <h1 id="course-header">&nbsp;DELETE COURSE</h1><br>
        <form id="course_form"  method=post>
        
    
        <label for="course_code">Course Code:</label>
            <select id="ccname" name="ccname">
            <?php 
                
                while ($ccode1 = mysqli_fetch_array(
                        $all_c,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $ccode1["ccode"];
                   
                ?>">
                    <?php echo $ccode1["ccode"];
                      
                    ?>
                </option>
            <?php 
                endwhile; 
                
            ?>
            </select> <br><br>
     
        <input type="submit" id="btna"  name="btna" value=Delete&nbsp;Course><br><br>
        
        
    
        <br>
        <br>
        <br>
    


<?php
        if(isset($_POST["btna"])) 
        {
            if(!empty($_POST['ccname']) )
            // Taking  values from the form data(input)
            {   
                $ccode = $_POST['ccname'];
                $b='bl';
                $bl=$ccode.$b;
                $c='co';
                $co=$ccode.$c;
         
               
                $query3 = "DELETE FROM course WHERE ccode='$ccode'" ;
                $query1= "DROP TABLE $bl";
                $query2= "DROP TABLE $co";
                $query4= "DROP TABLE $ccode";
                
            
                try
                {
                    $run1= mysqli_query($conn,$query1) or die(mysqli_error());  
                    $run2 = mysqli_query($conn,$query2) or die(mysqli_error());  
                    $run4= mysqli_query($conn,$query4) or die(mysqli_error());  
                    $run3 = mysqli_query($conn,$query3) or die(mysqli_error());  
                   
                    
                }
                catch(Exception $e)    
                {
                    echo '<span style="color:red;font-weight:bold;">Course does not exist!</span>';
                    $run4=false;
                    $run3=false;
                    $run1=false;
                    $run2=false;
                          
                
                }
                if($run3==true)
                {
                    
                    if($run4==true)
                    {
                        echo '<span style="color:green;font-weight:bold;">&nbsp;&nbsp;Course removed <br> &nbsp;&nbsp;&nbsp;successfully!</span>';
                        
                    }
                    
                }
                else
                {
                    if($run4==true)

                    {
                        echo '<span style="color:red;font-weight:bold;">&nbsp;Course not removed</span>';
                       
    
                    }
                }
            }
            else
            {
                echo '<span style="color:red;font-weight:bold;">All fields required </span>';
               

            }

        
        }
        // Close connection
        mysqli_close($conn)
        ?>  
            </form>           
      </main>  
        
</body>
</html>

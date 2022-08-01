
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


$sql = "SELECT * FROM `semester`";
$all_sem = mysqli_query($conn,$sql);

$sql = "SELECT * FROM `branch`";
$all_b = mysqli_query($conn,$sql);

$sql = "SELECT * FROM `scheme`";
$all_sc = mysqli_query($conn,$sql);



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
        <h1 id="course-header">Add Courses</h1>
        
        
        <form id="course_form"   method=post>
            
            <label for="semester">Semester:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <select id="semester" name="semester">
            <?php 
               
                while ($semester1 = mysqli_fetch_array(
                        $all_sem,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $semester1["sno"];
                    // The value we usually set is the primary key
                ?>">
                    <?php echo $semester1["sname"];
                        // To show the s name to the user
                    ?>
                </option>
            <?php 
                endwhile; 
                // While loop must be terminated
            ?>
              
            </select><br><br>
            <label for="Branch">Branch:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <select id="Branch" name="Branch">
            <?php 
                // use a while loop to fetch data 
                // from the $all_b variable 
                // and individually display as an option
                while ($branch1 = mysqli_fetch_array(
                        $all_b,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $branch1["bno"];
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


            <label for="Aademic_Year">Scheme:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <select id="Academic_Year" name="Academic_Year">
            <?php 
                // use a while loop to fetch data 
                // from the $all_b variable 
                // and individually display as an option
                while ($scheme1 = mysqli_fetch_array(
                        $all_sc,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $scheme1["scno"];
                    // The value we usually set is the primary key
                ?>">
                    <?php echo $scheme1["scname"];
                        // To show the sc name to the user
                    ?>
                </option>
            <?php 
                endwhile; 
                // While loop must be terminated
            ?>
            </select><br><br>

            
            
            <label for="course_name">Course Name:&nbsp;&nbsp;</label>
            <input type="text" id="cname" name="cname"><br><br>
            <label for="course_code">Course Code:&nbsp;&nbsp;</label>
            <input type="text" id="ccname" name="ccname"><br><br>

            <input type="submit" id="submit_1" name="submit_1" >
        
            <br><br>
            <?php
            
        if(isset($_POST['submit_1'])) 
        {
            
            if(!empty($_POST['semester']) && !empty($_POST['Branch'])&& !empty($_POST['Academic_Year'])&& !empty($_POST['cname'])&& !empty($_POST['ccname']))
            // Taking all 5 values from the form data(input)
            {   
                $semester =  $_POST['semester'];
                $branch = $_POST['Branch'];
                $scheme =  $_POST['Academic_Year'];
                $cname = $_POST['cname'];
                $ccode = $_POST['ccname'];
         
                // Performing insert query execution
                // here our table name is course
                $b='bl';
                $bl=$ccode.$b;
                $c='co';
                $co=$ccode.$c;
                $query = "INSERT INTO course VALUES('$ccode',
                '$cname','$semester','$branch ','$scheme')";

                $query2="CREATE TABLE $ccode (qno int NOT NULL PRIMARY KEY AUTO_INCREMENT, sno varchar(3), bno varchar(4), ccode varchar(7),
                mno varchar(2), qttno int(11), qt varchar(100),flag int,
                FOREIGN KEY(sno) REFERENCES semester(sno),
                FOREIGN KEY(bno) REFERENCES branch(bno),
                FOREIGN KEY(ccode) REFERENCES course(ccode),
                FOREIGN KEY(mno) REFERENCES module(mno),
                FOREIGN KEY(qttno) REFERENCES qtype(qttno))";

                $query3="CREATE TABLE $bl(qno int, blno varchar(2),
                FOREIGN KEY(qno) REFERENCES $ccode(qno),
                FOREIGN KEY(blno) REFERENCES blooms(blno))";
                $query4="CREATE TABLE $co(qno int, co varchar(3),
                FOREIGN KEY(qno) REFERENCES $ccode(qno),
                FOREIGN KEY(co) REFERENCES cos(co))";

                try
                {
                    $run1 = mysqli_query($conn,$query2) or die(mysqli_error());
                    $run2 = mysqli_query($conn,$query3) or die(mysqli_error());
                    $run3 = mysqli_query($conn,$query4) or die(mysqli_error());
                    $run = mysqli_query($conn,$query) or die(mysqli_error());  
                }
                catch(Exception $e)
                {
                    
                    echo '<span style="color:red;font-weight:bold;">&nbsp;&nbsp;&nbsp;Course already exists!</span>';
                    $run1=false;
                    $run=false;
                }
                if($run==true)
                {
                    
                    if($run1==true)
                    {
                        echo '<span style="color:green;font-weight:bold;">&nbsp;Course added successfully!</span>';
                        
                    }
                    
                }
                else
                {
                    if($run1==true)

                    {
                        echo '<span style="color:red;font-weight:bold;">&nbsp;Course not added</span>';
                       
    
                    }
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

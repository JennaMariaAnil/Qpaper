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
    <link rel="stylesheet" href="style6.css"/>
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
                 <a href="teacher.html">Teacher</a>
                 <a href="admin_login.html">Admin</a>
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
    <h1 id="course-header">&nbsp;View Questions</h1><br>
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
            </select> 
     
        <br><br><input type="submit" id="btna"  name="btna" value=View&nbsp;Questions><br><br>
        <br>
        <label for="Qt_no">Question no:</label>
        <input type="text" id="qt_no" name="qt_no"> <br><br>
        <input type="submit" id="btnb"  name="btnb" value=Delete&nbsp;Question><br><br>
        
    
       
    


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
               
                echo  "Qno";
                echo "\t";
                echo "&nbsp;&nbsp;"; 
                echo  "Question";
                echo "\t";
                echo "&nbsp;&nbsp;"; 
                echo  "Module";
                echo "\t";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                echo  "Marks";
                echo "\t";
                echo "&nbsp;&nbsp;"; 
                echo  "Bloom's Level";
                echo "\t";
                echo  "Course Outcome";
                echo "<br><br>";

                $q="SELECT c.qno, c.qt, m.mname, q.qttname, b.blno, 
                cc.co from $ccode c, qtype q, module m, $bl b, 
                $co cc where q.qttno=c.qttno and c.mno=m.mno and 
                c.qno=b.qno and c.qno =cc.qno";
                $q1 = mysqli_query($conn,$q);
                while ($q2 =mysqli_fetch_array($q1,MYSQLI_ASSOC)):; 
                $q3=$q2['qno'];
                $q4= $q2['qt'];
                $q5= $q2['mname'];
                $q6= $q2['qttname'];
                $q7= $q2['blno'];
                $q8= $q2['co'];
                echo "&nbsp";
                echo  $q3;
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                echo  $q4;
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                echo  $q5;
                echo "&nbsp;&nbsp;&nbsp;&nbsp;";
                echo  $q6;
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                echo  $q7;
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                echo  $q8;
                echo "<br>";


            endwhile; 
            }

        
        }
       
        ?>  
        <?php
        if(isset($_POST["btnb"])) 
        {
            if(!empty($_POST['qt_no'])&&!empty($_POST['ccname']) )
            // Taking  values from the form data(input)
            {   
                $qt_no = $_POST['qt_no'];
                $ccode = $_POST['ccname'];

                $b='bl';
                $bl=$ccode.$b;
                $c='co';
                $co=$ccode.$c;
               
                
                $query1="delete from $bl where qno='$qt_no'";
                $r1 = mysqli_query($conn,$query1);

                $query2="delete from $co where qno='$qt_no'";
                $r2 = mysqli_query($conn,$query2);

                $query3="delete from $ccode where qno='$qt_no'";
                $r3 = mysqli_query($conn,$query3);


                if($r3)
                {
                    echo '<span style="color:green;font-weight:bold;">&nbsp;Course removed successfully!</span>'; 
                }
          
            }

        
        }
        // Close connection
        mysqli_close($conn)
        ?>  
            </form>           
      </main>  
        
</body>
</html>
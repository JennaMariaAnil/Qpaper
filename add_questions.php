
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
  

  $sql = "SELECT * FROM `module`";
  $all_m = mysqli_query($conn,$sql);

  $sql = "SELECT * FROM `qtype`";
  $all_q = mysqli_query($conn,$sql);

  $sql = "SELECT * FROM `blooms`";
  $all_bl = mysqli_query($conn,$sql);

  $sql = "SELECT * FROM `cos`";
  $all_co = mysqli_query($conn,$sql);

  $sql = "SELECT ccode FROM `course`";
  $all_c = mysqli_query($conn,$sql);
  
  
  ?>
  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style3.css"/>
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
    <main id="qt_holder"  >
        <h1 id="qt-header">Add Questions</h1>
        
        
        <form id="course_form" method="post" action="#">
            <label id="Semester">Semester:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <select id="semester" name="semester">
            <?php 
               
                while ($semester1 = mysqli_fetch_array(
                        $all_sem,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $semester1["sno"];
                   
                ?>">
                    <?php echo $semester1["sname"];
                        
                    ?>
                </option>
            <?php 
                endwhile; 
                
            ?>
              
            </select>
            <label id="Branch">Branch:&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <select id="branch" name="branch">
            <?php 
                
                while ($branch1 = mysqli_fetch_array(
                        $all_b,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $branch1["bno"];
                    
                ?>">
                    <?php echo $branch1["bname"];
                        
                    ?>
                </option>
            <?php 
                endwhile; 
                
            ?>
            </select><br><br>

            <label id="course_code">Course Code:&nbsp;&nbsp;&nbsp;&nbsp;</label>
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
           
            <label id="Module_No">Module:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <select id="module_No" name="module_No">
            <?php 
               
                while ($module1 = mysqli_fetch_array(
                        $all_m,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $module1["mno"];
                    
                ?>">
                    <?php echo $module1["mname"];
                       
                    ?>
                </option>
            <?php 
                endwhile; 
               
            ?>
            </select><br><br>

            <label id="Question_type">Question type:&nbsp;&nbsp;</label>
            <select id="Type" name="Type">
            <?php 
               
                while ($qtype1 = mysqli_fetch_array(
                        $all_q,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $qtype1["qttno"];
                    
                ?>">
                    <?php echo $qtype1["qttname"];
                        
                    ?>
                </option>
            <?php 
                endwhile; 
                
            ?>
            </select><br><br>
            
                <label id="Blooms_l">Bloom's Level:&nbsp;&nbsp;</label><br>
                <div class="bloomss">  
                <?php 
               
                while ($bloom1 = mysqli_fetch_array(
                        $all_bl,MYSQLI_ASSOC)):; 
            ?>
                <input type="checkbox" id="bll[]" name="bll[]" value=<?php echo $bloom1["blno"];?>>
                <label for="<?php echo $bloom1["blno"];
                ?>"> <?php echo $bloom1["blname"];
                ?></label>
                <?php 
                endwhile; 
              
            ?> 
            </div>
            <br>


            <label id="CO">Course Outcomes:</label><br>
            <div class="bloomss"> 
            <?php
            while ($cos1 = mysqli_fetch_array(
                        $all_co,MYSQLI_ASSOC)):; 
            ?>
                <input type="checkbox" id="coo[]" name="coo[]" value=<?php echo $cos1["co"];?>>
                <label for="<?php echo $cos1["co"];
                ?>"> <?php echo $cos1["co_name"];
                ?></label>
                <?php 
                endwhile; 
               
            ?> 
        </div>
             
            <br>
         
            <label id="qt">Question:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><br>
            <textarea id="qts" name="qts" ></textarea><br>

            <input type="submit" id="add2" value="Add"><br><br>
            
            <?php
            
            
            if(isset($_POST['semester'])) 
        {
            if(!empty($_POST["semester"]) && !empty($_POST["branch"])&& !empty($_POST["module_No"])&& !empty($_POST["Type"])&& !empty($_POST["ccname"])&& !empty($_POST["bll"])&& !empty($_POST["coo"])&& !empty($_POST["qts"]))
          
            {   
                $semesterr =  $_POST["semester"];
                $branchh = $_POST["branch"];
                $module_Noo =  $_POST["module_No"];
                $ccnamee = $_POST["ccname"];
                $typee=$_POST["Type"];
                $qtss = $_POST["qts"];

                $b='bl';
                $bl=$ccnamee.$b;
                $c='co';
                $co=$ccnamee.$c;
         
          
                $query9 = "INSERT INTO $ccnamee (sno,bno,ccode,mno,qttno,qt,flag) VALUES('$semesterr',
                '$branchh','$ccnamee','$module_Noo',$typee,'$qtss',0)";

                $run = mysqli_query($conn,$query9) or die(mysqli_error()); 

                $q="SELECT qno from $ccnamee ORDER BY qno DESC LIMIT 1";
                $q1 = mysqli_query($conn,$q);
                $q2 =mysqli_fetch_array($q1,MYSQLI_ASSOC);
                $q3= $q2['qno'];
                
                foreach($_POST['bll'] as $check){
               
                $query10 = "INSERT INTO $bl VALUES('$q3','$check')";
                 $run1 = mysqli_query($conn,$query10) or die(mysqli_error());
                } 
                
                foreach($_POST['coo'] as $check1){
               
                $query11 = "INSERT INTO $co VALUES('$q3','$check1')";
                 $run2 = mysqli_query($conn,$query11) or die(mysqli_error());
                } 
                




                 if($run)
                 {
                     
                     echo '<span style="color:green;font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Question is added successfully!</span>';
                     
                 }
                 else
                 {
                 
                     echo '<span style="color:red;font-weight:bold;">&nbsp;Question is not added</span>';
                        
                 }
                
                
                
            }
            else
            {
                echo '<span style="color:red;font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All fields required </span>';
               

            }

        
        }
      
        mysqli_close($conn)
        ?> 
        </form>
      
      </main>
    
</body>
</html>
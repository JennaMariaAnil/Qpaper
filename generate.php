
<?php
session_start();
  
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
    <link rel="stylesheet" href="style5.css"/>
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
        
    <main id="qt_holder">
        <h1 id="qt-header">Generate Question Paper</h1>
        
         
        <form id="course_form" method="post" action="#">
            <label id="Semester">Semester:&nbsp;&nbsp;&nbsp;</label>
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
            <label id="Branch">Branch:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
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
            </select><br>

            <label id="course_code">Course Code:</label>
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

            <label id="qp_type">Question Paper Type:</label>
            <select id="qp" name="qp">
                <option value="series-1">series-1</option>
                <option value="series-2">series-2</option>
              
            </select><br><br>
              
           
            <label id="Module_No">Module NO:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><br>
                <div class="bloomss">   
                <?php 
               
                while ($module1 = mysqli_fetch_array(
                        $all_m,MYSQLI_ASSOC)):; 
            ?>
                <input type="checkbox" id="mm[]" name="mm[]" value=<?php echo $module1["mno"];?>>
                <label for="<?php echo $module1["mno"];
                ?>"> <?php echo $module1["mname"];
                ?></label>
                <?php 
                endwhile; 
              
            ?> 
                
            </div><br>


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

      

            
               
            <br>
  
            <input type="submit" id="generate" value="Generate"><br><br>
            <a href="sam.php">Click Here to download PDF</a>
            <br>

            <?php

            
            
            if(isset($_POST['semester'])) 
            
        {
            
            if(!empty($_POST["semester"]) && !empty($_POST["branch"])&& !empty($_POST["ccname"])&& !empty($_POST["qp"])&& !empty($_POST["mm"])&& !empty($_POST["bll"])&& !empty($_POST["coo"]))
          
            {   
                $semesterr =  $_POST["semester"];
                $branchh = $_POST["branch"];
                $ccnamee = $_POST["ccname"];
                $qptypee=$_POST["qp"];
               

                $b='bl';
                $bl=$ccnamee.$b;
                $c='co';
                $co=$ccnamee.$c;
          
                
                if($qptypee=="series-1")
                {
                    foreach($_POST['mm'] as $check)
                    {
                       
                        if($check=='m1')
                        {
                            foreach($_POST['coo'] as $checka)
                            {
                                
                             if(($checka=='CO1'))
                             {

                                 foreach($_POST['bll'] as $check1)
                              {
                         

                             if($check1=='L1'){
                                 $q="SELECT c.qt, c.qno from $ccnamee c, $bl b, $co cc where c.qno = b.qno and c.qno=cc.qno and b.blno='L1' and cc.co='CO1' and c.qttno=3 and c.mno='m1' and flag=0 order by rand() limit 1";
                                 $q1 = mysqli_query($conn,$q);
                                 $q2 =mysqli_fetch_array($q1,MYSQLI_ASSOC);
                                 $q3= $q2['qt'];
                                 $q4=$q2['qno'];
                                 $q5="update $ccnamee set flag=1 where qno='$q4'";
                                 $q6 = mysqli_query($conn,$q5);


                                
                             }
                             if($check1=='L2'){
                                 $p="SELECT c.qt,c.qno  from $ccnamee c, $bl b, $co cc where c.qno = b.qno and c.qno=cc.qno and b.blno='L2' and cc.co='CO1' and c.qttno=3 and c.mno='m1' and flag=0 order by rand() limit 1";
                                 $p1 = mysqli_query($conn,$p);
                                 $p2 =mysqli_fetch_array($p1,MYSQLI_ASSOC);
                                 $p3= $p2['qt'];
                                 $p4=$p2['qno'];
                                 $p5="update $ccnamee set flag=1 where qno='$p4'";
                                 $p6 = mysqli_query($conn,$p5);


                             }

                             if($check1=='L3'){
                                 $g="SELECT c.qt,c.qno from $ccnamee c, $bl b, $co cc where c.qno = b.qno and c.qno=cc.qno and b.blno='L3' and cc.co='CO1' and c.qttno=7 and c.mno='m1' and flag=0 order by rand() limit 1";
                                 $g1 = mysqli_query($conn,$g);
                                 $g2 =mysqli_fetch_array($g1,MYSQLI_ASSOC);
                                 $g3= $g2['qt'];
                                 $g4=$g2['qno'];
                                 $g5="update $ccnamee set flag=1 where qno='$g4'";
                                 $g6 = mysqli_query($conn,$g5);

                                
                             }
                             else if($check1=='L4')
                             {
                                 $g="SELECT c.qt,c.qno from $ccnamee c, $bl b, $co cc where c.qno = b.qno and c.qno=cc.qno and b.blno='L4'and cc.co='CO1' and c.qttno=7 and c.mno='m1' and flag=0 order by rand() limit 1";
                                 $g1 = mysqli_query($conn,$g);
                                 $g2 =mysqli_fetch_array($g1,MYSQLI_ASSOC);
                                 $g3= $g2['qt'];
                                 $g4=$g2['qno'];
                                 $g5="update $ccnamee set flag=1 where qno='$g4'";
                                 $g6 = mysqli_query($conn,$g5);
                             }
                             if($check1=='L5'){
                                 $k="SELECT c.qt,c.qno from $ccnamee c, $bl b, $co cc where c.qno = b.qno and c.qno=cc.qno and b.blno='L5'and cc.co='CO1' and c.qttno=7 and c.mno='m1' and flag=0 order by rand() limit 1";
                                 $k1 = mysqli_query($conn,$k);
                                 $k2 =mysqli_fetch_array($k1,MYSQLI_ASSOC);
                                 $k3= $k2['qt'];
                                 $k4=$k2['qno'];
                                 $k5="update $ccnamee set flag=1 where qno='$k4'";
                                 $k6 = mysqli_query($conn,$k5);

                                
                             }
                             else if($check1=='L6')
                             {
                                 $k="SELECT c.qt,c.qno from $ccnamee c, $bl b, $co cc where c.qno = b.qno and c.qno=cc.qno and b.blno='L6'and cc.co='CO1' and c.qttno=7 and c.mno='m1' and flag=0 order by rand() limit 1";
                                 $k1 = mysqli_query($conn,$k);
                                 $k2 =mysqli_fetch_array($k1,MYSQLI_ASSOC);
                                 $k3= $k2['qt'];
                                 $k4=$k2['qno'];
                                 $k5="update $ccnamee set flag=1 where qno='$k4'";
                                 $k6 = mysqli_query($conn,$k5);
                             }
                             



                         }

                          }
                          else if(($checka=='CO2'))
                             {

                                 foreach($_POST['bll'] as $check1)
                              {
                         

                             if($check1=='L1'){
                                 $q="SELECT c.qt,c.qno from $ccnamee c, $bl b, $co cc where c.qno = b.qno and c.qno=cc.qno  and b.blno='L1' and cc.co='CO2' and c.qttno=3 and c.mno='m1' and flag=0 order by rand() limit 1";
                                 $q1 = mysqli_query($conn,$q);
                                 $q2 =mysqli_fetch_array($q1,MYSQLI_ASSOC);
                                 $q3= $q2['qt'];
                                 $q4=$q2['qno'];
                                 $q5="update $ccnamee set flag=1 where qno='$q4'";
                                 $q6 = mysqli_query($conn,$q5);

                                
                             }
                             if($check1=='L2'){
                                 $p="SELECT c.qt,c.qno  from $ccnamee c, $bl b, $co cc where c.qno = b.qno and c.qno=cc.qno and b.blno='L2' and cc.co='CO2' and c.qttno=3 and c.mno='m1' and flag=0 order by rand() limit 1";
                                 $p1 = mysqli_query($conn,$p);
                                 $p2 =mysqli_fetch_array($p1,MYSQLI_ASSOC);
                                 $p3= $p2['qt'];
                                 $p4=$p2['qno'];
                                 $p5="update $ccnamee set flag=1 where qno='$p4'";
                                 $p6 = mysqli_query($conn,$p5);

                             }

                             if($check1=='L3'){
                                 $g="SELECT c.qt,c.qno from $ccnamee c, $bl b, $co cc where c.qno = b.qno and c.qno=cc.qno and b.blno='L3' and cc.co='CO2' and c.qttno=7 and c.mno='m1' and flag=0 order by rand() limit 1";
                                 $g1 = mysqli_query($conn,$g);
                                 $g2 =mysqli_fetch_array($g1,MYSQLI_ASSOC);
                                 $g3= $g2['qt'];
                                 $g4=$g2['qno'];
                                 $g5="update $ccnamee set flag=1 where qno='$g4'";
                                 $g6 = mysqli_query($conn,$g5);

                                
                             }
                             else if($check1=='L4')
                             {
                                 $g="SELECT c.qt,c.qno from $ccnamee c, $bl b, $co cc where c.qno = b.qno and c.qno=cc.qno and b.blno='L4'and cc.co='CO2' and c.qttno=7 and c.mno='m1' and flag=0 order by rand() limit 1";
                                 $g1 = mysqli_query($conn,$g);
                                 $g2 =mysqli_fetch_array($g1,MYSQLI_ASSOC);
                                 $g3= $g2['qt'];
                                 $g4=$g2['qno'];
                                 $g5="update $ccnamee set flag=1 where qno='$g4'";
                                 $g6 = mysqli_query($conn,$g5);
                             }
                             if($check1=='L5'){
                                 $k="SELECT c.qt,c.qno from $ccnamee c, $bl b, $co cc where c.qno = b.qno and c.qno=cc.qno  and b.blno='L5'and cc.co='CO2' and c.qttno=7 and c.mno='m1' and flag=0 order by rand() limit 1";
                                 $k1 = mysqli_query($conn,$k);
                                 $k2 =mysqli_fetch_array($k1,MYSQLI_ASSOC);
                                 $k3= $k2['qt'];
                                 $k4=$k2['qno'];
                                 $k5="update $ccnamee set flag=1 where qno='$k4'";
                                 $k6 = mysqli_query($conn,$k5);

                                
                             }
                             else if($check1=='L6')
                             {
                                 $k="SELECT c.qt,c.qno from $ccnamee c, $bl b, $co cc where c.qno = b.qno and c.qno=cc.qno and b.blno='L6'and cc.co='CO2' and c.qttno=7 and c.mno='m1' and flag=0 order by rand() limit 1";
                                 $k1 = mysqli_query($conn,$k);
                                 $k2 =mysqli_fetch_array($q1,MYSQLI_ASSOC);
                                 $k3= $k2['qt'];
                                 $k4=$k2['qno'];
                                 $k5="update $ccnamee set flag=1 where qno='$k4'";
                                 $k6 = mysqli_query($conn,$k5);
                             }
                             



                         }

                          }
                            }
               
                            

                        } 

                        if($check=='m2')
                        {
                            foreach($_POST['coo'] as $checkb)
                            {
                                
                             if(($checkb=='CO2'))
                             {

                                 foreach($_POST['bll'] as $check2)
                              {
                         

                             if($check2=='L1'){
                                 $qq="SELECT c.qt, c.qno from $ccnamee c, $bl b, $co cc where c.qno = b.qno and c.qno=cc.qno and b.blno='L1' and cc.co='CO2' and c.qttno=3 and c.mno='m2' and flag=0 order by rand() limit 1";
                                 $qq1 = mysqli_query($conn,$qq);
                                 $qq2 =mysqli_fetch_array($qq1,MYSQLI_ASSOC);
                                 $qq3= $qq2['qt'];
                                 $qq4=$qq2['qno'];
                                 $qq5="update $ccnamee set flag=1 where qno='$qq4'";
                                 $qq6 = mysqli_query($conn,$qq5);


                                
                             }
                             if($check2=='L2'){
                                 $pp="SELECT c.qt,c.qno  from $ccnamee c, $bl b, $co cc where c.qno = b.qno and c.qno=cc.qno and b.blno='L2' and cc.co='CO2' and c.qttno=3 and c.mno='m2' and flag=0 order by rand() limit 1";
                                 $pp1 = mysqli_query($conn,$pp);
                                 $pp2 =mysqli_fetch_array($pp1,MYSQLI_ASSOC);
                                 $pp3= $pp2['qt'];
                                 $pp4=$pp2['qno'];
                                 $pp5="update $ccnamee set flag=1 where qno='$pp4'";
                                 $pp6 = mysqli_query($conn,$pp5);


                             }

                             if($check2=='L3'){
                                 $gg="SELECT c.qt,c.qno from $ccnamee c, $bl b, $co cc where c.qno = b.qno and c.qno=cc.qno and b.blno='L3' and cc.co='CO2' and c.qttno=7 and c.mno='m2' and flag=0 order by rand() limit 1";
                                 $gg1 = mysqli_query($conn,$gg);
                                 $gg2 =mysqli_fetch_array($gg1,MYSQLI_ASSOC);
                                 $gg3= $gg2['qt'];
                                 $gg4=$gg2['qno'];
                                 $gg5="update $ccnamee set flag=1 where qno='$gg4'";
                                 $gg6 = mysqli_query($conn,$gg5);

                                
                             }
                             else if($check2=='L4')
                             {
                                 $gg="SELECT c.qt,c.qno from $ccnamee c, $bl b, $co cc where c.qno = b.qno and c.qno=cc.qno and b.blno='L4'and cc.co='CO2' and c.qttno=7 and c.mno='m2' and flag=0 order by rand() limit 1";
                                 $gg1 = mysqli_query($conn,$gg);
                                 $gg2 =mysqli_fetch_array($gg1,MYSQLI_ASSOC);
                                 $gg3= $gg2['qt'];
                                 $gg4=$gg2['qno'];
                                 $gg5="update $ccnamee set flag=1 where qno='$gg4'";
                                 $gg6 = mysqli_query($conn,$gg5);
                             }
                             if($check2=='L5'){
                                 $kk="SELECT c.qt,c.qno from $ccnamee c, $bl b, $co cc where c.qno = b.qno and c.qno=cc.qno and b.blno='L5'and cc.co='CO2' and c.qttno=7 and c.mno='m2' and flag=0 order by rand() limit 1";
                                 $kk1 = mysqli_query($conn,$kk);
                                 $kk2 =mysqli_fetch_array($kk1,MYSQLI_ASSOC);
                                 $kk3= $kk2['qt'];
                                 $kk4=$kk2['qno'];
                                 $kk5="update $ccnamee set flag=1 where qno='$kk4'";
                                 $kk6 = mysqli_query($conn,$kk5);

                                
                             }
                             else if($check2=='L6')
                             {
                                 $kk="SELECT c.qt,c.qno from $ccnamee c, $bl b, $co cc where c.qno = b.qno and c.qno=cc.qno and b.blno='L6'and cc.co='CO2' and c.qttno=7 and c.mno='m2' and flag=0 order by rand() limit 1";
                                 $kk1 = mysqli_query($conn,$kk);
                                 $kk2 =mysqli_fetch_array($kk1,MYSQLI_ASSOC);
                                 $kk3= $kk2['qt'];
                                 $kk4=$kk2['qno'];
                                 $kk5="update $ccnamee set flag=1 where qno='$kk4'";
                                 $kk6 = mysqli_query($conn,$kk5);
                             }
                             



                         }

                          }
                          else if(($checkb=='CO3'))
                             {

                                 foreach($_POST['bll'] as $check2)
                              {
                         

                             if($check2=='L1'){
                                 $qq="SELECT c.qt,c.qno from $ccnamee c, $bl b, $co cc where c.qno = b.qno and c.qno=cc.qno  and b.blno='L1' and cc.co='CO3' and c.qttno=3 and c.mno='m2' and flag=0 order by rand() limit 1";
                                 $qq1 = mysqli_query($conn,$qq);
                                 $qq2 =mysqli_fetch_array($qq1,MYSQLI_ASSOC);
                                 $qq3= $qq2['qt'];
                                 $qq4=$qq2['qno'];
                                 $qq5="update $ccnamee set flag=1 where qno='$qq4'";
                                 $qq6 = mysqli_query($conn,$qq5);

                                
                             }
                             if($check2=='L2'){
                                 $pp="SELECT c.qt,c.qno  from $ccnamee c, $bl b, $co cc where c.qno = b.qno and c.qno=cc.qno and b.blno='L2' and cc.co='CO3' and c.qttno=3 and c.mno='m2' and flag=0 order by rand() limit 1";
                                 $pp1 = mysqli_query($conn,$pp);
                                 $pp2 =mysqli_fetch_array($pp1,MYSQLI_ASSOC);
                                 $pp3= $pp2['qt'];
                                 $pp4=$pp2['qno'];
                                 $pp5="update $ccnamee set flag=1 where qno='$pp4'";
                                 $pp6 = mysqli_query($conn,$pp5);

                             }

                             if($check2=='L3'){
                                 $gg="SELECT c.qt,c.qno from $ccnamee c, $bl b, $co cc where c.qno = b.qno and c.qno=cc.qno and b.blno='L3' and cc.co='CO3' and c.qttno=7 and c.mno='m2' and flag=0 order by rand() limit 1";
                                 $gg1 = mysqli_query($conn,$gg);
                                 $gg2 =mysqli_fetch_array($gg1,MYSQLI_ASSOC);
                                 $gg3= $gg2['qt'];
                                 $gg4=$gg2['qno'];
                                 $gg5="update $ccnamee set flag=1 where qno='$gg4'";
                                 $gg6 = mysqli_query($conn,$gg5);

                                
                             }
                             else if($check2=='L4')
                             {
                                 $gg="SELECT c.qt,c.qno from $ccnamee c, $bl b, $co cc where c.qno = b.qno and c.qno=cc.qno and b.blno='L4'and cc.co='CO3' and c.qttno=7 and c.mno='m2' and flag=0 order by rand() limit 1";
                                 $gg1 = mysqli_query($conn,$gg);
                                 $gg2 =mysqli_fetch_array($gg1,MYSQLI_ASSOC);
                                 $gg3= $gg2['qt'];
                                 $gg4=$gg2['qno'];
                                 $gg5="update $ccnamee set flag=1 where qno='$gg4'";
                                 $gg6 = mysqli_query($conn,$gg5);
                             }
                             if($check2=='L5'){
                                 $kk="SELECT c.qt,c.qno from $ccnamee c, $bl b, $co cc where c.qno = b.qno and c.qno=cc.qno  and b.blno='L5'and cc.co='CO3' and c.qttno=7 and c.mno='m2' and flag=0 order by rand() limit 1";
                                 $kk1 = mysqli_query($conn,$kk);
                                 $kk2 =mysqli_fetch_array($kk1,MYSQLI_ASSOC);
                                 $kk3= $kk2['qt'];
                                 $kk4=$kk2['qno'];
                                 $kk5="update $ccnamee set flag=1 where qno='$kk4'";
                                 $kk6 = mysqli_query($conn,$kk5);

                                
                             }
                             else if($check2=='L6')
                             {
                                 $kk="SELECT c.qt,c.qno from $ccnamee c, $bl b, $co cc where c.qno = b.qno and c.qno=cc.qno and b.blno='L6'and cc.co='CO3' and c.qttno=7 and c.mno='m2' and flag=0 order by rand() limit 1";
                                 $kk1 = mysqli_query($conn,$kk);
                                 $kk2 =mysqli_fetch_array($kk1,MYSQLI_ASSOC);
                                 $kk3= $kk2['qt'];
                                 $kk4=$kk2['qno'];
                                 $kk5="update $ccnamee set flag=1 where qno='$kk4'";
                                 $kk6 = mysqli_query($conn,$kk5);
                             }
                             



                         }

                          }
                            }
               
                            

                        } 

                        if($check=='m3')
                        {
                            foreach($_POST['coo'] as $checkc)
                            {
                            if(($checkc=='CO3'))
                             {

                                 foreach($_POST['bll'] as $check3)
                              {
                         

                             if($check3=='L1'){
                                 $qqq="SELECT c.qt, c.qno from $ccnamee c, $bl b, $co cc where c.qno = b.qno and c.qno=cc.qno and b.blno='L1' and cc.co='CO2' and c.qttno=3 and c.mno='m2' and flag=0 order by rand() limit 1";
                                 $qqq1 = mysqli_query($conn,$qqq);
                                 $qqq2 =mysqli_fetch_array($qqq1,MYSQLI_ASSOC);
                                 $qqq3= $qqq2['qt'];
                                 $qqq4=$qqq2['qno'];
                                 $qqq5="update $ccnamee set flag=1 where qno='$qqq4'";
                                 $qqq6 = mysqli_query($conn,$qqq5);


                                
                             }
                             else if($check3=='L2'){
                                 $qqq="SELECT c.qt, c.qno from $ccnamee c, $bl b, $co cc where c.qno = b.qno and c.qno=cc.qno and b.blno='L2' and cc.co='CO2' and c.qttno=3 and c.mno='m2' and flag=0 order by rand() limit 1";
                                 $qqq1 = mysqli_query($conn,$qqq);
                                 $qqq2 =mysqli_fetch_array($qqq1,MYSQLI_ASSOC);
                                 $qqq3= $qqq2['qt'];
                                 $qqq4=$qqq2['qno'];
                                 $qqq5="update $ccnamee set flag=1 where qno='$qqq4'";
                                 $qqq6 = mysqli_query($conn,$qqq5);


                             }

                             
                             if($check3=='L5'){
                                 $kkk="SELECT c.qt,c.qno from $ccnamee c, $bl b, $co cc where c.qno = b.qno and c.qno=cc.qno and b.blno='L5'and cc.co='CO2' and c.qttno=7 and c.mno='m2' and flag=0 order by rand() limit 1";
                                 $kkk1 = mysqli_query($conn,$kkk);
                                 $kkk2 =mysqli_fetch_array($kkk1,MYSQLI_ASSOC);
                                 $kkk3= $kk2['qt'];
                                 $kkk4=$kk2['qno'];
                                 $kkk5="update $ccnamee set flag=1 where qno='$kkk4'";
                                 $kkk6 = mysqli_query($conn,$kkk5);

                                
                             }
                             else if($check3=='L6')
                             {
                                 $kkk="SELECT c.qt,c.qno from $ccnamee c, $bl b, $co cc where c.qno = b.qno and c.qno=cc.qno and b.blno='L6'and cc.co='CO2' and c.qttno=7 and c.mno='m2' and flag=0 order by rand() limit 1";
                                 $kkk1 = mysqli_query($conn,$kkk);
                                 $kkk2 =mysqli_fetch_array($kkk1,MYSQLI_ASSOC);
                                 $kkk3= $kkk2['qt'];
                                 $kkk4=$kkk2['qno'];
                                 $kkk5="update $ccnamee set flag=1 where qno='$kk4'";
                                 $kkk6 = mysqli_query($conn,$kkk5);
                             }
                             



                         }

                          }
                          
                            }
               
                            

                        } 
                        
                       
                                


                    }
                 


                    $e="SELECT b.bname from branch b, course c where b.bno=c.bno and c.ccode= '$ccnamee'";
                                    $e1 = mysqli_query($conn,$e);
                                    $e2 =mysqli_fetch_array($e1,MYSQLI_ASSOC);
                                    $e3= $e2['bname'];

                                 $f="SELECT cname from course where ccode= '$ccnamee'";
                                    $f1 = mysqli_query($conn,$f);
                                    $f2 =mysqli_fetch_array($f1,MYSQLI_ASSOC);
                                    $f3= $f2['cname'];
                                $z="/";
                                $time="Time: 2Hrs";
                                $max="Max.Marks :50";
                                $cn=$ccnamee."-".$f3."-".$qptypee;
                                $t="B.TECH-".$e3;
                                $qpc="QP Code:".$ccnamee.$z."2019".$z.$semesterr;
                                $_SESSION['time'] = $time;
                                $_SESSION['max'] = $max;
                                $_SESSION['name'] = $cn;
                                $_SESSION['btech'] = $t;
                                $_SESSION['qpcode'] = $qpc;
                                $_SESSION['qt1'] = "            1.  ".$q3;
                                $_SESSION['qt2'] = "            2.  ".$p3;
                                $_SESSION['qt3'] = "            3.  ".$g3;
                                $_SESSION['qt4'] = "            4.  ".$k3;
                                $_SESSION['qt5'] = "            5.  ".$qq3;
                                $_SESSION['qt6'] = "            6.  ".$pp3;
                                $_SESSION['qt7'] = "            7.  ".$gg3;
                                $_SESSION['qt8'] = "            8.  ".$kk3;
                                $_SESSION['qt9'] = "            9.  ".$qqq3;
                                $_SESSION['qt10'] = "           10.  ".$kkk3;
                                $_SESSION['T1'] = "PART-A";
                                $_SESSION['T11'] = "Answer all questions. Each question carries 3 marks";
                                $_SESSION['T2'] = "PART-B";
                                $_SESSION['T22'] = "Answer all questions. Each question carries 7 marks";

                }

             }

                 
               
               
                
                 
                
                
            
            else
            {
                echo '<span style="color:red;font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All fields required </span>';
               

            }

        
        }
        
        
      
        mysqli_close($conn);

        
        
        
        ?> 

        

        </form>
      
      </main>
    
</body>
</html>
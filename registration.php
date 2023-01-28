<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration</title>
</head>
<body>
<?php
        $conn = mysqli_connect("localhost", "root", "", "registration","3308");
          
          // Check connection
          if($conn === false){
              die("ERROR: Could not connect. " . mysqli_connect_error());
          }
          function Redirect($url, $permanent = false)
          {
              header('Location: ' . $url, true, $permanent ? 301 : 302);
  
              exit();
          }
          $first =  $_REQUEST['first'];
          $last = $_REQUEST['last'];
          $contact =  $_REQUEST['contact'];
          $name = $first . ' ' . $last;
          $SN= "SELECT SN from records order by SN desc LIMIT 1";



        
        $sql="INSERT INTO records  VALUES ('$SN','$name','$contact')";

        if(mysqli_query($conn, $sql)){
            echo "<h3>data stored in a database successfully." ;
            
            Redirect('Home.php', false);

        } else{
             if(mysqli_errno($conn) == 1062)
                       echo "<h1>Duplicate Entry</h1>";
            else{
                       echo "ERROR: Hush! Sorry $sql. " 
                . mysqli_error($conn);}
        }
        $conn->close();
        ?>
</body>
</html>
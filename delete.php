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

          
	$SN=$_GET['SN'];

    if(mysqli_query($conn, "delete from `records` where SN='$SN'")){
        echo "<h3>data stored in a database successfully." ;
        
        Redirect('Home.php', false);

    } else{
        
                   echo "ERROR: Hush! Sorry $sql. " 
            . mysqli_error($conn);}
    
	$conn->close();
    ?>
</body>
</html>
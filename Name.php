<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration</title>
    <link rel='stylesheet' href='style.css' type='text/css' />
    
    <script>
        function validateForm() {
        let x = document.forms["registration"]["first"].value;
        let y = document.forms["registration"]["last"].value;
        let z = document.forms["registration"]["contact"].value;
        if (x == "") {
            alert("First Name must be filled");
            return false;
        }
        if (y == "") {
            alert("Last Name must be filled");
            return false;
        }
        if (z == "") {
            alert("Contact No must be filled");
            return false;
        }
        }
        function confirmation(){
            var result = confirm("Are you sure to delete?");
            if(result){
                console.log("Deleted")
            }
        }
    </script>
    
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 50%;
            font-size: 25px;
            text-align: center;
            color: black;
            background-color: #f2f2f2;
            border-style: groove;margin-left: 40px;

        }
        td,th {
            border: 1px solid #dddddd;
            color: black;
            border-style: inset;
            font-size: 20px;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2
        }

    </style>
</head>
<body>


    <h1>Registration Form</h1>
    <form name='registration' onSubmit="return validateForm();" method="post" action="registration.php">
        <ul>
            <li><label for="first">Person Name: </label></li> 
            <li><input type="text" name="first" size="12" placeholder="First" /> 
                <input type="text" name="last" size="12" placeholder="Last"/></li><br><br>
            
            <li><label for="contact">Contact No: </label></li>
            <li><input type="text" name="contact" size="11" /></li><br><br>
            
             <button type="submit" name="submit" class="btn">Save</button>
        </ul>
        
    </form>
    
    <h1>Search</h1>
    <form action="Home.php" method="post">
        <div style="padding-left: 40px; ">
                <input type="text" name="valueToSearch" placeholder="Value To Search"><br><br>
                <input type="submit" name="search" value="Search"><br><br>
        </div>
    
    </form>

    <table>
        <tr>
        <th> SR </th>
        <th> <a style="color: black; text-decoration:none;" href="Name.php" >Name</a> </th>
        <th> Contact </th>
        <th> Delete </th>
  
        </tr>
    
    <?php 
           $conn = mysqli_connect("localhost", "root", "", "registration","3308");
           if($conn === false){
               die("ERROR: Could not connect. " . mysqli_connect_error());
           }
           function Redirect($url, $permanent = false)
           {
               header('Location: ' . $url, true, $permanent ? 301 : 302);
   
               exit();
           }   

    $sql = "SELECT * FROM records ORDER BY Name";
    $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['SN']; ?></td>
                    <td><?php echo $row['Name']; ?></td>
                    <td><?php echo $row['Contact']; ?></td>
                    <td>
                        <a onclick="confirmation()" href="delete.php?SN=<?php echo $row['SN']; ?>">X</a>
                    </td>
                </tr>
                <?php       
                }
            }
       
    ?>


    <?php
    
    if(isset($_POST['search']))
    {

        $valueToSearch = $_POST['valueToSearch'];
        $query = "SELECT * FROM `records` WHERE Name LIKE '%".$valueToSearch."%'";

        $search_result = $conn->query($query);
        if($search_result->num_rows > 0){
        while($row = $search_result->fetch_assoc()){
            ?>
						<tr>
							<td><?php echo $row['SN']; ?></td>
							<td><?php echo $row['Name']; ?></td>
                            <td><?php echo $row['Contact']; ?></td>
							<td>
								<a onclick="confirmation()"  href="delete.php?SN=<?php echo $row['SN']; ?>">X</a>
							</td>
						</tr>
						<?php       
                        }
        echo "</table>";
        } 
        else { echo "<h1>No results</h1>"; }
        
    }

?>

</body>
</html>
<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password,"smarmethods_tasks");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="description" content ="TASK3 SMART METHODS">
        <title>TASK3 SMART METHODS</title>
        <link type="text/CSS" rel="stylesheet" href="style.css"/>
    </head>

    <body>
 
        <form action="index.php" method="post">
            <div> 
                <?php 
                //TOP
                    if(isset($_POST["top"]))
                    {
                    $sql = "INSERT INTO control_panel2 (control) VALUES ('F')";
                        if (!$conn->query($sql)) {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }
                //LEFT
                    elseif(isset($_POST["left"]))
                    {
                        $sql = "INSERT INTO control_panel2 (control) VALUES ('L')";
                        
                        if (!$conn->query($sql)) {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                            }
                    }
                //RIGHT    
                    elseif(isset($_POST["right"]))
                    {
                        $sql = "INSERT INTO control_panel2 (control) VALUES ('R')";
                        
                        if (!$conn->query($sql)) {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                            }
                    }

                    //DOWN    
                    elseif(isset($_POST["down"]))
                    {
                        $sql = "INSERT INTO control_panel2 (control) VALUES ('B')";
                        
                        if (!$conn->query($sql)) {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                            }
                    }    

                    //STOP    
                    elseif(isset($_POST["stop"])){
                        $sql = "INSERT INTO control_panel2 (control) VALUES ('S')";
                        
                        if (!$conn->query($sql)) {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                            }
                    }    
     
                        //PRINT THE STORED VALUE
                        $sql = "SELECT control FROM control_panel2 ORDER BY num DESC LIMIT 1";

                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        echo sprintf("<p> --%s-- </p>", $row["control"]);

                        $conn->close();
                ?>
        </div>        
        </form>

    </body>

</html>



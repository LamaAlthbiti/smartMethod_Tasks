<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content ="TASK6 SMART METHODS">
        <meta name="outhor" content="Lama Althbiti">
        <title>TASK6 SMART METHODS</title>
        <link type="text/CSS" rel="stylesheet" href="style2.css"/>
    </head>

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
////////////////////////////////////////////////////////////////


?>  
    <body>

    <div id="mainDiv">
    <div id="div1">
        <form action="index.php" method="post">

          <div class="insid">
            <label class="label1"> DIRECTION </label><label>..Choose the direction..</label><br><br>
           
            <!--The DIRECTION-->
            <input type="radio" name="DIRECTION" value="FORWARD" /><label>FORWARD</label>
            <input type="radio" name="DIRECTION" value="BACKWARD" /><label>BACKWARD</label>
            <input type="radio" name="DIRECTION" value="LEFT"  /><label>LEFT</label>
            <input type="radio" name="DIRECTION" value="RIGHT" /><label>RIGHT</label>
          </div>  
          <br><br>
          <div class="insid">
             <!--The DISTANCE-->
            <label class="label1"> DISTANCE </label><label>..Determine the distance in meters..</label><br><br>
            <input class="input1" type="number" id="DISTANCE" name="DISTANCE"> 
          </div>  
          <br><br>

            <button name="add" >ADD</button> <!-- ADD new Row to the table-->
            <button type="button" name="start" onclick="drawMap()">START</button>  <!-- Start drawing the map-->
            <button name="delete">DELETE</button><!-- Delete the last row-->
            <button name="deleteA">DELETE All</button>  <!--Delete all rows-->
            <br><br><br>           
        </form>
        
  
<?php
          /////////////////////ADD NEW ROW /////////////////////
          if(isset($_POST["add"])) 
          {
            $DIRECTION = $_POST['DIRECTION'];
            $DISTANCE =  $_POST['DISTANCE'];

            $sql = "INSERT INTO task6 (direction,distance) VALUES ('$DIRECTION', '$DISTANCE')";
              if (!$conn->query($sql)) 
              {
              $msg = 'alert("Record updated successfully");';
              echo "Error: " . $sql . "<br>" . $conn->error;
              }
              else
              {
                   $msg= $conn->error;
              }
          }
          /////////////////////DELETE THE LAST ROW//////////////////////

          if(isset($_POST["delete"]))
          {
              $sql = "DELETE FROM task6 ORDER by num DESC LIMIT 1";
            if (!$conn->query($sql)) {
              echo "Error deleting record: " . $conn->error;
            }
          }

           /////////////////////DELETE ALL ROWS//////////////////////
          if(isset($_POST["deleteA"]))
          {
            $sql = "DELETE FROM task6";
          if (!$conn->query($sql)) {
            echo "Error deleting record: " . $conn->error;
          }
          }
          


      ////////////////PRINT THE TABLE////////////////////
      $result = mysqli_query($conn,"SELECT * FROM task6");
      echo"<div id='table'><table id='mytable'>
      <tr>
          <th style='width: 20px'>#</th>
          <th style='width: 100px'>DIRECTION</th>
          <th style='width: 100px'>DISTANCE</th>
      </tr>";
      $numRow=1;//ROW CONTER START  FROM 1.  
      while($row = mysqli_fetch_array($result))
      {
      echo "<tr>";
      echo "<td>". $numRow . "</td>";
      echo "<td>" . $row['direction'] . "</td>";
      echo "<td>" . $row['distance'] . "</td>";
      echo "</tr>";
      $numRow++;
      }
      echo "</table></div>";
      ?>

</div>

<div id="div2">
<canvas id="myCanvas" width="500" height="500" >
</div>
</div>
    
</body>

</html>
<!--////////////////////////////////// DRAW THE MAP ////////////////////////////////////////-->
<script>
function drawMap(){
var table=document.getElementById("mytable");
var c = document.getElementById("myCanvas");
var ctx = c.getContext("2d");
//(x=250, y=250) 
var x=250;
var y=250;
ctx.moveTo(x,y);//The center of the canvas

/////////////////////////////////////////////////
for(var i=1;i<table.rows.length;i++)
{
  var dirction = table.rows[i].cells[1].innerHTML;//get the value from table 
  var dictance = table.rows[i].cells[2].innerHTML;//get the value from table 
 
 
  switch(dirction){
    case "FORWARD":
        y=y-dictance;
        ctx.lineTo(x,y); 
        ctx.stroke();
        ctx.moveTo(x,y);
        break;

    case "BACKWARD":
        y=parseInt(dictance)+y;
        ctx.lineTo(x,y); 
        ctx.stroke();
        ctx.moveTo(x,y);
        break;

    case "LEFT": 
      x=x-dictance;
      ctx.lineTo(x,y); 
      ctx.stroke();
      ctx.moveTo(x,y);
      break;

    case "RIGHT": 
      x=x+parseInt(dictance);
      ctx.lineTo(x,y); 
      ctx.stroke();
      ctx.moveTo(x,y);
    break;  
  }
}
//window.alert(x+" "+y);  
}
</script>


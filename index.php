<?php
    include 'DBConnect.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (isset($_POST['button']))
        {
            $Stage = $_POST['Stage'];

            $Area = $_POST['Area'];

            $Display="";

            $sql = "SELECT * FROM schedules,area 
                    where schedules.AreaID = area.AreaID
                    and schedules.AreaID =$Area and schedules.Stage ='$Stage'";
            $result = $conn->query($sql);
            $_SESSION["test"]="";
            if ($result->num_rows > 0)
            {
                // output data of each row
                while($row = $result->fetch_assoc())
                {
                    $Display.= "Area Name: ". $row["AreaName"]." 
                - Times loadshedding is today: " . $row["Times"]." 
                - Loadshedding stage: " . $row["Stage"]."<br>";
                }
            } else {
                $Display.=  "0 results";
            }
            $conn->close();
        }
    }
?>

<html>
<body>

<form action="index.php" method="post">
    <label for="Stage">Choose a stage:</label>
    <select name="Stage" id="Stage">
        <option value="1" <?php if(isset($_POST['Stage'])&& $_POST['Stage']=="1") echo 'selected="selected"'; ?>>Stage 1</option>
        <option value="2" <?php if(isset($_POST['Stage'])&& $_POST['Stage']=="2") echo 'selected="selected"'; ?>>Stage 2</option>
        <option value="3"<?php if(isset($_POST['Stage'])&& $_POST['Stage']=="3") echo 'selected="selected"'; ?>>Stage 3</option>
        <option value="4"<?php if(isset($_POST['Stage'])&& $_POST['Stage']=="4") echo 'selected="selected"'; ?>>Stage 4</option>
    </select><br>
    <label for="Area">Choose a Area:</label>
    <select name="Area" id="Area">
        <option value="1"<?php if(isset($_POST['Area'])&& $_POST['Area']=="1") echo 'selected="selected"'; ?>>St Georges</option>
        <option value="2"<?php if(isset($_POST['Area'])&& $_POST['Area']=="2") echo 'selected="selected"'; ?>>North End</option>
        <option value="3"<?php if(isset($_POST['Area'])&& $_POST['Area']=="3") echo 'selected="selected"'; ?>>Summerstrand</option>
    </select><br>
    <input type="submit" name ="button">
</form>

</body>
<?php
 if(isset($Display))echo $Display ;

?>
</html>

<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbDatabase= "loadshedding";
    // Create connection
    $conn = new mysqli($servername, $username, $password,$dbDatabase);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected successfully<br>";
    //GetData($conn);

    function GetData($conn)
    {
        $sql = "SELECT * FROM schedules,area where schedules.AreaID = area.AreaID";
        $result = $conn->query($sql);

        if ($result->num_rows > 0)
        {
            // output data of each row
            while($row = $result->fetch_assoc())
            {
                echo "Area Name: " . $row["AreaName"]. " 
                - Times loadshedding is today: " . $row["Times"]." 
                - Loadshedding stage: " . $row["Stage"]."<br>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
    }
?>
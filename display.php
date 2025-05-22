<?php

include 'DBConnector.php';

$sql = "SELECT * FROM employee";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<pre/>";
        print_r($row);

        echo "EmpID: " . $row["EmpID"]. 
        "<br>".
        " - Name: " . $row["EmpName"].
        " - Age: " . $row["Age"]. 
        " - Salary: " . $row["Salary"].
        " - HireDate: " . $row["HireDate"].
         "<br/><br/>";
    }
   
} else {
    echo "0 results";
}

$conn->close();
?>
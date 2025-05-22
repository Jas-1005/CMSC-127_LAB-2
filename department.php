<?php

include 'DBConnector.php';

$sql = "SELECT * FROM department";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $mgrID = $row["MgrEmpID"];
        
        if($mgrID){
            $sql_get_ManagerName = "SELECT EmpName FROM employee WHERE EmpID = '$mgrID'";    
            $mgrResult = $conn->query($sql_get_ManagerName);
            if($mgrResult && $mgrResult->num_rows>0){
                $mgrRow = $mgrResult->fetch_assoc();
                $mgrName = $mgrRow["EmpName"];
            } else {
                $mgrName = "-No manager found-"; // empname is null, mgr id is assigned, set to initial value
            }    
        } else {
            $mgrName = "--No assigned manager--"; //no assigned mgr ID, or mgr ID is null
        }
        echo "<tr>".
            "<td align='center'>".$row["DeptID"]."</td>".
            "<td align='center'>".$row["DeptName"]."</td>".
            "<td align='center'>".$mgrName."</td>".
            "<td align='center'>".$row["Budget"]."</td>".
            "<td align='center'>".$row["DeptCity"]."</td>".
            "</tr>";
        
    }
   
} else {
    echo "0 results";
}

$conn->close();
?>
 
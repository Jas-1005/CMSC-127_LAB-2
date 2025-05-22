<?php

// Use $_POST[“EmpID”] to access the ID of the employee in the current row
// Delete this employee from the database
// After this, redirect to index.php

//confirmation message
//echo "<script type='text/javascript'>alert('Are you sure you want to delete this employee?');</script>";
//FIXED!

include 'DBConnector.php';

$empID = $_POST["EmpID"];

$check_Mgr_sql = "SELECT EmpName, DeptName FROM employee as e, department as d WHERE d.MgrEmpID = $empID AND e.EmpID=$empID;";
$mgrResult = $conn->query($check_Mgr_sql);

if ($mgrResult && $mgrResult->num_rows > 0){
    $mgrRow = $mgrResult->fetch_assoc();
    $mgrName = $mgrRow['EmpName'];
    $deptName = $mgrRow['DeptName'];
}

$del_from_work_sql = "DELETE FROM work WHERE EmpID = '$empID';";
$delWorkResult = $conn->query($del_from_work_sql);

$del_from_emp_sql = "DELETE FROM employee WHERE EmpID = '$empID';";
$delEmpResult = $conn->query($del_from_emp_sql);
    
if ($delWorkResult && $delEmpResult) { 
    header("Location: index.php");
} else {
    echo "Error: ".$del_from_emp_sql."<br>".$conn->error;
}

$conn->close();
?> 
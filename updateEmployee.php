<?php
include 'DBConnector.php';

if (!isset($_POST['EmpID'])) {
    die("No employee ID provided.");
}

$empID = $_POST["EmpID"];
$name = $_POST["name"];
$age = $_POST["age"];
$salary = $_POST["salary"];
$HireDate = $_POST["date_hired"];
$percent_time = $_POST["percent_time"];
$department = $_POST['department'];
$designation = $_POST["designation"]; // 1 = Manager, 2 = Employee

$emp_query = "UPDATE employee 
              SET EmpName = '$name', Age = $age, Salary = $salary, HireDate = '$HireDate' 
              WHERE EmpID = $empID";
$conn->query($emp_query);

if(!$conn->query($emp_query)){
    echo"Error updating employee: ".$conn->error;
}

$deptSQL = "SELECT DeptID FROM department WHERE DeptName='$department' LIMIT 1";
$deptResult = $conn->query($deptSQL);

if(!$deptResult){
    echo"Error updating employee: ".$conn->error;
}

$deptRow = $deptResult->fetch_assoc();
$deptID = $deptRow['DeptID'];

$work_query = "UPDATE work 
               SET DeptID = $deptID, Percent_Time = $percent_time 
               WHERE EmpID = $empID";
$conn->query($work_query);

if ($designation == 1) {
    $dept_query = "UPDATE department 
                   SET MgrEmpID = $empID 
                   WHERE DeptID = (SELECT DeptID FROM work WHERE EmpID = $empID)";
    $conn->query($dept_query);
} else {
    $dept_query = "UPDATE department 
                   SET MgrEmpID = NULL 
                   WHERE MgrEmpID = $empID";
    $conn->query($dept_query);
}

header("Location: index.php");
die;

?>

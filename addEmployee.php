<?php

//should replace manager, if ever a manager is entered
//put alert if empty
//FIXED!

include 'DBConnector.php';
$name = $_POST["name"];
$age = $_POST["age"];
$salary = $_POST["salary"];
$HireDate = $_POST["date_hired"];
$DeptID = $_POST["department"];
$Percent_Time = $_POST["percent_time"];
$designation = isset($_POST["designation"]) ? $_POST["designation"] : null;

$sql = "INSERT INTO employee (EmpID, EmpName, Age, Salary, HireDate) 
        VALUES (NULL, '$name', '$age', '$salary', '$HireDate');";
    
if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;

    $addEmpQuery = "INSERT INTO work (EmpID, DeptID, Percent_Time) 
            VALUES ('$last_id', '$DeptID', '$Percent_Time');";

    $result = $conn->query($addEmpQuery);

    if($designation == 1){
        $validateMgrQuery = "SELECT MgrEmpID, DeptName FROM department WHERE DeptID = $DeptID";
        $resultMgr = $conn->query($validateMgrQuery);
        
        if ($resultMgr && $row = $resultMgr->fetch_assoc()){
            $existingMgrID = $row['MgrEmpID'];
            $deptName = $row['DeptName'];
        
            
            if (!empty($existingMgrID) && $existingMgrID != 0 ){
                $existingMgrNameQuery = "SELECT EmpName FROM employee WHERE EmpID = $existingMgrID";
                $resultMgrName = $conn-> query($existingMgrNameQuery);

                if ($resultMgrName && $mgrRow = $resultMgrName->fetch_assoc()) {
                    $existingMgrName = $mgrRow['EmpName'];
                }

                echo "<script>alert('The {$deptName} already has a manager. {$name} will now replace {$existingMgrName} as the new manager of {$deptName}.'); window.location.href = 'employees.php';</script>";
            } else {
                 echo "<script>alert('The {$deptName} currently has no manager. {$name} will become the new manager of {$deptName}.'); window.location.href = 'employees.php';</script>";
            }
            $updateMgr = "UPDATE department SET MgrEmpID = $last_id WHERE DeptID = $DeptID";
            $conn->query($updateMgr);
            die;
        }

        echo "<script>window.location.href = 'employees.php';</script>";
        die;
    }
      
    echo "<script>alert('Employee added successfully!');window.location.href = 'employees.php';</script>";
    die;

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?> 
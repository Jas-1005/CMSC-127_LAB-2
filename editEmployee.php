<?php
include 'DBConnector.php';

// Use $_POST[“EmpID”] to access the ID of the employee in the current row
// Display a form with fields filled in with all the info of an employee (similar to Add New Employee Form but with initial values already)
// Don’t forget to add a “cancel” and “submit” buttons in the edit form
// After this, redirect to index.php

if (empty($_POST['EmpID'])) {
    die("No employee ID provided.");
}

$empID = $_POST['EmpID'];

$sql = "SELECT 
            e.EmpID, e.EmpName, e.Age, e.Salary, e.HireDate,
            w.Percent_Time,
            d.MgrEmpID, d.DeptName
        FROM employee e
        JOIN work w ON e.EmpID = w.EmpID
        JOIN department d ON w.DeptID = d.DeptID
        WHERE e.EmpID = $empID";

$result = $conn->query($sql);

if ($result->num_rows === 0) {
    die("No employee found.");
}

$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<style>
    body {
        margin: 50px;
        font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
        background-image: url('b2.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        color: white;
    }

    table {
        width: 100%;
        
    }

    td.label {
        width: 50px;
        text-align: right;
        padding-right: 10px;
    }

    .expand {
        width: 170px;
    }

</style>

<body>
    <h1>Employee Management :  Edit Form</h1>
    <br>
    <h3>Edit Employee:</h3>
    <form action="updateEmployee.php" method="post"  onsubmit="return confirm('This employee will be updated. Proceed?');">
        <table style="width:20%">
            <input type="hidden" name="EmpID" value="<?php echo $data['EmpID']; ?>">
            <tr>
                <td class="label">Name</td>
                <td><input type="text" name="name" value="<?php echo $data['EmpName']; ?>"required></td>
            </tr>
            <tr>
                <td class="label">Age</td>
                <td><input type="number" name="age" value="<?php echo $data['Age']; ?>"required></td>
            </tr>
            <tr>
                <td class="label">Salary</td>
                <td><input type="number" step=".01" name="salary" value="<?php echo $data['Salary']; ?>"required></td>
            </tr>
            <tr>
                <td class="label">Percent Time</td>
                <td><input type="text" name="percent_time" value="<?php echo $data['Percent_Time']; ?>"required></td>
            <tr>
                <td class="label">Date Hired</td>
                <td><input class="expand" type="date" name="date_hired" value="<?php echo $data['HireDate']; ?>"required></td>
            </tr>
            <tr>
                <td class="label">Department</td>
                <td>
                    <select class="expand" name="department" required>
                        <?php
                            $allDeptQuery = "SELECT DeptName FROM department";
                            $allDeptResult = $conn->query($allDeptQuery);
                        
                            while ($allDeptResult && $deptRow = $allDeptResult->fetch_assoc()){
                                $deptName = $deptRow['DeptName'];
                                $currentDeptName = ($deptName == $data['DeptName']? "selected": "");
                                echo"<option value='$deptName' $currentDeptName>$deptName</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="label">Designation</td>
                <td>
                    <input type="radio" name="designation" value="1" <?php if ($data['MgrEmpID'] == $empID) echo "checked"; ?> required> Manager<br>
                    <input type="radio" name="designation" value="2" <?php if ($data['MgrEmpID'] != $empID) echo "checked"; ?> required> Employee<br>
                </td>
            </tr>
            <tr>
                <td class="label"></td>
                <td><input type="Submit">
                    <input type="button" value="Cancel" onclick="window.location.href='employees.php'">
                </td>
            </tr>
        </table>
    </form>
    <br>
    <h2> All Employees</h2>
    <br>
    <?php
        include 'employeesDept.php';    
    ?>

</body>

</html>
       
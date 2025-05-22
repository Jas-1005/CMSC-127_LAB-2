<?php

include 'DBConnector.php';

$sql = "SELECT DeptName FROM department";
$deptData = $conn->query($sql);

if ($deptData->num_rows > 0) {
    // output data of each row
    while($data = $deptData->fetch_assoc()) {
        $deptName = $data["DeptName"];

        $empSql = "
            SELECT employee.*, work.*, department.MgrEmpID
            FROM department
            LEFT JOIN work ON department.DeptID = work.DeptID
            LEFT JOIN employee ON work.EmpID = employee.EmpID
            WHERE department.DeptName = '$deptName'
        ";

        $empData = $conn->query($empSql);

        echo "<h2>$deptName</h2>".
                "<table border='1' cellspacing='0' cellpadding='8'>".
                    "<tr>".
                        "<th>ID</th>".
                        "<th>Name</th>".
                        "<th>Age</th>".
                        "<th>Salary</th>".
                        "<th>Hire Date</th>".
                        "<th>Designation</th>".
                        "<th>Actions</th>".
                    "</tr>";

        if ($empData && $empData->num_rows > 0) {
            // output data of each row
            while($emp_row = $empData->fetch_assoc()) {
                if(!$emp_row["EmpID"]){
                    continue;
                }    
                
                echo "<tr>".
                    "<td align='center'>".$emp_row["EmpID"]."</td>".
                    "<td align='center'>".$emp_row["EmpName"]."</td>".
                    "<td align='center'>".$emp_row["Age"]."</td>".
                    "<td align='center'>".$emp_row["Salary"]."</td>".
                    "<td align='center'>".$emp_row["HireDate"]."</td>";

                if ($emp_row["MgrEmpID"] == $emp_row["EmpID"]) {
                    echo "<td align='center'> Manager </td>";
                }
                else {
                    echo "<td align='center'> Employee </td>";
                }

                echo "<td align='center'>" .
                    "<form action='deleteEmployee.php' method='post' 
                        onsubmit=\"return confirm('Are you sure you want to delete this employee?');\">".
                        "<input type='hidden' name='EmpID' value='" . $emp_row["EmpID"] . "'>" .
                        "<button type='submit'>Delete</button>" .
                    "</form>" .
                    "<form action='editEmployee.php' method='post' onsubmit=\"return confirm('Are you sure you want to edit this employee?');\">".
                        "<input type='hidden' name='EmpID' value='" . $emp_row["EmpID"] . "'>" .
                        "<button type='submit'>Edit</button>" .
                    "</form>" .
                "</td>";

                echo "</tr>";
            }

        } else {        
            echo "<tr>".
                    "<td align='center'>---</td>".
                    "<td align='center'>---</td>".
                    "<td align='center'>---</td>".
                    "<td align='center'>---</td>".
                    "<td align='center'>---</td>".
                    "<td align='center'>---</td>".
                    "<td align='center'>---</td>".
                    "</tr>";
        }

        echo "</table>";
    }
   
} else {
    echo "0 results";
}

$conn->close();
?>


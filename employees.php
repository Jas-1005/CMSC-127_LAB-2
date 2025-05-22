<!DOCTYPE html>
<html>
<style>
    nav {
        background-color: black ;
        padding: 10px 20px;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        height: auto;
    }

    nav a {
        color: black;
        text-decoration: none;
        background-color: white;
        padding: 8px 12px;
        border-radius: 4px;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    nav a:hover {
        background-color: #666;
    }

    body {
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
    <nav>
        <a href="index.php">GO TO INDEX</a>
    </nav>
    <h1>Employee Management</h1>
    <br>
    <h3>New Employee:</h3>
    <form action="addEmployee.php" method="post">
        <table style="width:20%">
            <tr>
                <td class="tlabel">Name</td>
                <td><input type="text" name="name" required></td>
            </tr>
            <tr>
                <td class="tlabel">Age</td>
                <td><input type="number" name="age" required></td>
            </tr>
            <tr>
                <td class="tlabel">Salary</td>
                <td><input type="number" step=".01" name="salary" required></td>
            </tr>
            <tr>
                <td class="tlabel">Percent Time</td>
                <td><input type="text" name="percent_time" required></td>
            </tr>
            <tr>
                <td class="tlabel">Date Hired</td>
                <td><input class="expand" type="date" name="date_hired" required></td>
            </tr>
            <tr>
                <td class="tlabel">Department</td>
                <td>
                    <select class="expand" name="department" required>
                        <option value="" disabled="">--Selected Department--</option>
                        <?php
                            include 'allDepartment.php'; 
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="tlabel">Designation</td>
                <td>
                    <input type="radio" name="designation" value="1" required>Manager<br>
                    <input type="radio" name="designation" value="2" required>Employee<br>
                </td>
            </tr>
            <tr>
                <td class="tlabel"></td>
                <td><input type="submit"></td>
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
       

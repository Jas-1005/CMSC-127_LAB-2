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
        margin: 50px;
        font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
        background-image: url('b2.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        color: white;
    }

    table, th, td {
        border: 1px solid silver;
    }
    
    table {
        width: 100%;
    }

    h1{
        color:darkgrey;
    }

    p{
        color:grey;
    }

    h2{
        color : white
    }

</style>
<body>
    <nav>
        <a href="employees.php">ADD EMPLOYEE</a>
    </nav>
    <h1>This page will display the content of each table in the <i style="color: gold;">sample </i>database.</h1>
    <p>Typing tutorial 2.0</p>
    <br>
    <h2>Department Table</h2>
    <table>
        <tr>
            <th>Department ID</th>
            <th>Department Name</th>
            <th>Manager Name</th>
            <th>Budget</th>
            <th>City</th>
        </tr>
    <?php
        include 'department.php';
    ?>
    </table>

    <?php
        include 'employeesDept.php';
    ?>

</body>
</html>
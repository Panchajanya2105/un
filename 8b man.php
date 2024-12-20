<html>

<body>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 50%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
    <?php
    // default
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mysql";
    $conn = mysqli_connect(
        $servername,
        $username,
        $password,
        $dbname
    );
    if (!$conn)
        die("Connection failed: " . $conn);

    // sql queries
    $crt = "create table if not exists student2(usn varchar(20),name
varchar(20),address varchar(20))";
    $result0 = mysqli_query($conn, $crt);
    $crt = "delete from student2";
    $result0 = mysqli_query($conn, $crt);
    $crt1 = "INSERT INTO `student2`(`usn`, `name`, `address`) VALUES
('1EW22CS001','ABC','add1')";
    $crt2 = "INSERT INTO `student2`(`usn`, `name`, `address`) VALUES
('1EW22CS031','XYZ','add2')";
    $crt3 = "INSERT INTO `student2`(`usn`, `name`, `address`) VALUES
('1EW22CS005','PQR','add3')";
    $result1 = mysqli_query($conn, $crt1);
    $result2 = mysqli_query($conn, $crt2);
    $result3 = mysqli_query($conn, $crt3);

    // Before sorting
    $sql = "SELECT * FROM student2";
    $result = mysqli_query($conn, $sql);
    echo "<br>";
    echo "<center> BEFORE SORTING </center>";
    echo "<table
border='2'>";
    echo "<tr>";
    echo "<th>USN</th><th>NAME</th><th>Address</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["usn"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["address"] . "</td></tr>";
    }
    echo "</table>";

    // After sorting
    $sql = "SELECT * FROM student2 ORDER BY name";
    $result = mysqli_query($conn, $sql);
    echo "<br>";
    echo "<center> AFTER SORTING <center>";
    echo "<table border='2'>";
    echo "<tr>";
    echo "<th>USN</th><th>NAME</th><th>Address</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["usn"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["address"] . "</td></tr>";
    }
    echo "</table>";
    $conn->close();
    ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records Sorting</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        table th {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Student Records</h1>
        <?php
        $conn = new mysqli("localhost", "root", "", "student_db");
        if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
        $conn->query("CREATE DATABASE IF NOT EXISTS student_db");
        $conn->select_db("student_db");
        $conn->query("CREATE TABLE IF NOT EXISTS students (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100),
            grade INT
        )");
        if ($conn->query("SELECT COUNT(*) FROM students")->fetch_row()[0] == 0) {
            $conn->query("INSERT INTO students (name, grade) VALUES
                ('Alice', 85), ('Bob', 75), ('Charlie', 90), ('David', 70), ('Eve', 95)");
        }
        $unsortedStudents = $conn->query("SELECT * FROM students")->fetch_all(MYSQLI_ASSOC);
        function selectionSort($array, $key) {
            $n = count($array);
            for ($i = 0; $i < $n - 1; $i++) {
                $minIdx = $i;
                for ($j = $i + 1; $j < $n; $j++) {
                    if ($array[$j][$key] < $array[$minIdx][$key]) {
                        $minIdx = $j;
                    }
                }
                $temp = $array[$minIdx];
                $array[$minIdx] = $array[$i];
                $array[$i] = $temp;
            }
            return $array;
        }
        $sortedStudents = selectionSort($unsortedStudents, 'grade');
        function renderTable($data) {
            foreach ($data as $row) {
                echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['grade']}</td></tr>";
            }
        }
        $conn->close();
        ?>
        <h2>Before Sorting</h2>
        <table>
            <thead>
                <tr><th>ID</th><th>Name</th><th>Grade</th></tr>
            </thead>
            <tbody>
                <?php renderTable($unsortedStudents); ?>
            </tbody>
        </table>

        <h2>After Sorting (By Grade)</h2>
        <table>
            <thead>
                <tr><th>ID</th><th>Name</th><th>Grade</th></tr>
            </thead>
            <tbody>
                <?php renderTable($sortedStudents); ?>
            </tbody>
        </table>
    </div>
</body>
</html>

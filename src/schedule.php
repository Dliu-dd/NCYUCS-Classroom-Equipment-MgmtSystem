<?php
session_start();
require "conn.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>課表</title>
<style>
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

th {
    background-color: #f2f2f2;
}
</style>
</head>
<body>

<?php
// Get parameters from the URL
$classroom = isset($_GET['classroom']) ? $_GET['classroom'] : '';
$week = isset($_GET['week']) ? $_GET['week'] : '';

// Your database connection code here

// Your SQL query using parameters

$sql = "SELECT username, DAYOFWEEK(BorrowDay) as dayOfWeek, reserved_classroom.start, reserved_classroom.end
        FROM reserved_classroom
        JOIN week ON reserved_classroom.BorrowDay BETWEEN week.start AND week.end
        WHERE week.week_no = ? AND classroom = ?
        UNION
        SELECT classname, weekday as dayOfWeek, start, end
        FROM class WHERE classroom = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $week, $classroom, $classroom);
$stmt->execute();
$stmt->bind_result($username, $dayOfWeek, $start, $end);

// Fetch data and store in an array
$data = [];
while ($stmt->fetch()) {
    $data[] = [
        'username' => $username,
        'dayOfWeek' => $dayOfWeek,
        'start' => $start,
        'end' => $end
    ];
}

// Your HTML and table structure here
echo "<h2>課表</h2>";
echo "<table>";
echo "<thead>";
echo "<tr>";
echo "<th>時間</th>";
echo "<th>星期一</th>";
echo "<th>星期二</th>";
echo "<th>星期三</th>";
echo "<th>星期四</th>";
echo "<th>星期五</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

$config = json_decode(file_get_contents('./schedule/config.json'), true);
$timeSlots = $config['course_time'];

foreach ($timeSlots as $key => $timeSlot) {
    echo "<tr>";
    echo "<td>" . $timeSlot['name'] . "<br>" . $timeSlot['time']['start'] . $config['time_range_connector'] . $timeSlot['time']['end'] . "</td>";

    if($start == $timeSlot['time']['start']){
        echo 'haha';
    }
    // Display data for each day
    for ($day = 1; $day <= 5; $day++) {
        echo "<td>";
        foreach ($data as $entry) {
            if ($entry['dayOfWeek'] == $day) {
            echo $entry['username'];
            }    
        }
        echo "</td>";
    }

    echo "</tr>";
}

echo "</tbody>";
echo "</table>";
?>
</body>
</html>

<?php
// index.php
$host = 'database.c94ea24a6tsn.ap-southeast-1.rds.amazonaws.com';
$db   = 'testdb';
$user = 'admin';
$pass = '12!ABCdef';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $sql = "INSERT INTO users (name) VALUES ('$name')";
    $conn->query($sql);
}

// Fetch users
$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple PHP MySQL App</title>
</head>
<body>
    <h1>User List</h1>
    <form method="POST">
        <input type="text" name="name" placeholder="Enter name" required>
        <button type="submit">Add</button>
    </form>
    <ul>
        <?php while ($row = $result->fetch_assoc()): ?>
            <li><?php echo htmlspecialchars($row['name']); ?></li>
        <?php endwhile; ?>
    </ul>
</body>
</html>

<?php $conn->close(); ?>

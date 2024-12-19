<?php
session_start();
include('db.php');

if (!isset($_SESSION['employee_id'])) {
    header("Location: login.php");
    exit;
}

$employee_id = $_SESSION['employee_id'];
if ($_GET['id'] == $employee_id) {
    // SQL query to delete employee by id
    $sql = "DELETE FROM employees WHERE id='$employee_id'";
    if ($conn->query($sql) === TRUE) {
        session_destroy(); // Logout the user
        echo "<script>
            alert(' employee deleted successfully!');
            window.location.href = 'employee_list.php'; // Redirect after the alert
        </script>";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "You cannot delete other employees.";
}

$conn->close();
?>

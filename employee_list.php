<?php
session_start();
include('db.php');

if (!isset($_SESSION['employee_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch all employees
$sql = "SELECT * FROM employees";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5 card p-5">
    <h2 class="text-center">Employee List</h2>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Mobile No.</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['first_name'] ?></td>
                    <td><?= $row['last_name'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['mobile_no'] ?></td>
                    <td>
                        <?php if ($row['id'] == $_SESSION['employee_id']): ?>
                            <a href="delete_employee.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


<?php
$conn->close();
?>

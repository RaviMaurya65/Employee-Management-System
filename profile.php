<?php
// Start the session and check if the employee is logged in
session_start();
if (!isset($_SESSION['employee_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit;
}

$employee_id = $_SESSION['employee_id'];

// Database connection
include('db.php');

// Fetch the employee details from the database
$sql = "SELECT * FROM employees WHERE id = $employee_id";
$result = $conn->query($sql);
$employee = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Update Profile</h2>
        <form method="POST" action="update_profile.php">
            <div class="conatiner card p-5">
                <div class="row">
                    <div class="col-md-4">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" name="first_name" value="<?= $employee['first_name'] ?>"
                            placeholder="First Name" required>
                    </div>
                    <div class="col-md-4">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" name="last_name" value="<?= $employee['last_name'] ?>"
                            placeholder="Last Name" required>
                    </div>
                    <div class="col-md-4">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value="<?= $employee['email'] ?>"
                            placeholder="Email" required>
                    </div>
                    <div class="col-md-4">
                        <label for="mobile_no">Mobile No.</label>
                        <input type="text" class="form-control" name="mobile_no" value="<?= $employee['mobile_no'] ?>"
                            placeholder="Mobile No." required>
                    </div>

                    <!-- Gender Radio Buttons -->
                    <div class="col-md-4">
                        <label>Gender</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="Male"
                                <?= $employee['gender'] == 'Male' ? 'checked' : '' ?>>
                            <label class="form-check-label">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="Female"
                                <?= $employee['gender'] == 'Female' ? 'checked' : '' ?>>
                            <label class="form-check-label">Female</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="address">Address</label>
                        <textarea class="form-control" name="address" placeholder="Address"
                            required><?= $employee['address'] ?></textarea>
                    </div>

                    <!-- Dropdown for State and Country -->
                    <div class="col-md-4">
                        <label for="state">State</label>
                        <select class="form-control" name="state" required>
                            <option value="">Select State</option>
                            <option value="UP" <?= $employee['state'] == 'UP' ? 'selected' : '' ?>>Uttar Pradesh
                            </option>
                            <option value="MH" <?= $employee['state'] == 'MH' ? 'selected' : '' ?>>Maharashtra</option>
                            <!-- Add other states here -->
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="country">Country</label>
                        <select class="form-control" name="country" required>
                            <option value="">Select Country</option>
                            <option value="IN" <?= $employee['country'] == 'IN' ? 'selected' : '' ?>>India</option>
                            <!-- Add other countries here -->
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" value="<?= $employee['username'] ?>"
                            placeholder="Username" required>
                    </div>
                    <div class="col-md-4">
                        <label for="password">New Password (leave blank to keep current)</label>
                        <input type="password" class="form-control" name="password" placeholder="New Password">
                    </div>
                    <div class="col-md-4">
                        <label for="">Update</label><br>
                        <button type="submit" class="btn btn-primary btn-block">Update Profile</button>
                    </div>
                    
                </div>
            </div>

        </form>
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
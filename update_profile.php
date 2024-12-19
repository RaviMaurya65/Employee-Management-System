<?php
session_start();
if (!isset($_SESSION['employee_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit;
}

include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_id = $_SESSION['employee_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $mobile_no = $_POST['mobile_no'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    // print_r($_POST);
    // die;
    // Check if the password is provided and encrypt it if so
    if (!empty($password)) {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "UPDATE employees SET first_name='$first_name', last_name='$last_name', email='$email', mobile_no='$mobile_no', 
                gender='$gender', address='$address', state='$state', country='$country', username='$username', password='$password' 
                WHERE id='$employee_id'";
    } else {
        // If no new password, just update other fields
       
        $sql = "UPDATE employees SET first_name='$first_name', last_name='$last_name', email='$email', mobile_no='$mobile_no', 
                gender='$gender', address='$address', state='$state', country='$country', username='$username' 
                WHERE id='$employee_id'";
                // echo $sql;
                // die;
    }

    if ($conn->query($sql) === TRUE) {
        
        echo "<script>
                alert('Profile updated successfully');
               </script>";
        header("Location: profile.php"); // Redirect to the profile page
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>

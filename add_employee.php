<?php
include('db.php');

// Handling form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $mobile_no = $_POST['mobile_no'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encrypting password

    // SQL query to insert employee data into database
    $sql = "INSERT INTO employees (first_name, last_name, email, mobile_no, gender, address, state, country, username, password)
            VALUES ('$first_name', '$last_name', '$email', '$mobile_no', '$gender', '$address', '$state', '$country', '$username', '$password')";

    if ($conn->query($sql) === TRUE) {
    // Your logic to add the new employee to the database
    // Assuming the insertion is successful:

    echo "<script>
            alert('New employee added successfully!');
            window.location.href = 'employee_list.php'; // Redirect after the alert
        </script>";

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container m-5 p-5 card">
        <h2>Add Employee</h2>
        <form method="POST" action="add_employee.php" id="employeeForm">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" name="first_name" id="first_name"
                            placeholder="First Name" >
                        <span id="first_name_error" class="text-danger"></span>
                    </div>
                    <div class="col-md-4">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name"
                            >
                        <span id="last_name_error" class="text-danger"></span>
                    </div>
                    <div class="col-md-4">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" >
                        <span id="email_error" class="text-danger"></span>
                    </div>
                    <div class="col-md-4">
                        <label for="mobile_no">Mobile No.</label>
                        <input type="text" class="form-control" name="mobile_no" id="mobile_no" placeholder="Mobile No."
                            >
                        <span id="mobile_no_error" class="text-danger"></span>
                    </div>

                    <!-- Gender Radio Buttons -->
                    <div class="col-md-4">
                        <label>Gender</label><br>
                        <label class="radio-inline mr-3"><input type="radio" name="gender" value="Male" >
                            Male</label>
                        <label class="radio-inline"><input type="radio" name="gender" value="Female" >
                            Female</label>
                        <span id="gender_error" class="text-danger"></span>
                    </div>

                    <div class="col-md-4">
                        <label for="address">Address</label>
                        <textarea class="form-control" name="address" id="address" placeholder="Address"
                            ></textarea>
                        <span id="address_error" class="text-danger"></span>
                    </div>

                    <!-- Dropdown for State and Country -->
                    <div class="col-md-4">
                        <label for="state">State</label>
                        <select class="form-control" name="state" id="state" >
                            <option value="">Select State</option>
                            <option value="UP">Uttar Pradesh</option>
                            <option value="MH">Maharashtra</option>
                        </select>
                        <span id="state_error" class="text-danger"></span>
                    </div>
                    <div class="col-md-4">
                        <label for="country">Country</label>
                        <select class="form-control" name="country" id="country" >
                            <option value="">Select Country</option>
                            <option value="IN">India</option>
                        </select>
                        <span id="country_error" class="text-danger"></span>
                    </div>

                    <div class="col-md-4">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username"
                            >
                        <span id="username_error" class="text-danger"></span>
                    </div>
                    <div class="col-md-4">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                            >
                        <span id="password_error" class="text-danger"></span>
                    </div>
                    <div class="col-md-4">
                        <label for="password">Add</label>
                        <br>
                        <button type="submit" class="btn btn-primary">Add Employee</button>
                    </div>

                </div>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    document.getElementById('employeeForm').addEventListener('submit', function(event) {
        let isValid = true;

        // Clear previous errors
        document.querySelectorAll('.text-danger').forEach(function(span) {
            span.innerHTML = '';
        });

        // First Name Validation
        if (document.getElementById('first_name').value.trim() === '') {
            document.getElementById('first_name_error').innerHTML = 'First Name is required';
            isValid = false;
        }

        // Last Name Validation
        if (document.getElementById('last_name').value.trim() === '') {
            document.getElementById('last_name_error').innerHTML = 'Last Name is required';
            isValid = false;
        }

        // Email Validation
        const email = document.getElementById('email').value.trim();
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (email === '') {
            document.getElementById('email_error').innerHTML = 'Email is required';
            isValid = false;
        } else if (!emailPattern.test(email)) {
            document.getElementById('email_error').innerHTML = 'Please enter a valid email';
            isValid = false;
        }

        // Mobile Number Validation
        const mobileNo = document.getElementById('mobile_no').value.trim();
        const mobilePattern = /^[0-9]{10}$/;
        if (mobileNo === '') {
            document.getElementById('mobile_no_error').innerHTML = 'Mobile No. is required';
            isValid = false;
        } else if (!mobilePattern.test(mobileNo)) {
            document.getElementById('mobile_no_error').innerHTML = 'Please enter a valid 10-digit mobile number';
            isValid = false;
        }

        // Gender Validation
        if (!document.querySelector('input[name="gender"]:checked')) {
            document.getElementById('gender_error').innerHTML = 'Gender is required';
            isValid = false;
        }

        // Address Validation
        if (document.getElementById('address').value.trim() === '') {
            document.getElementById('address_error').innerHTML = 'Address is required';
            isValid = false;
        }

        // State Validation
        if (document.getElementById('state').value === '') {
            document.getElementById('state_error').innerHTML = 'State is required';
            isValid = false;
        }

        // Country Validation
        if (document.getElementById('country').value === '') {
            document.getElementById('country_error').innerHTML = 'Country is required';
            isValid = false;
        }

        // Username Validation
        if (document.getElementById('username').value.trim() === '') {
            document.getElementById('username_error').innerHTML = 'Username is required';
            isValid = false;
        }

        // Password Validation
        if (document.getElementById('password').value.trim() === '') {
            document.getElementById('password_error').innerHTML = 'Password is required';
            isValid = false;
        }

        // If the form is not valid, prevent submission
        if (!isValid) {
            event.preventDefault();
        }
    });
</script>
</body>

</html>
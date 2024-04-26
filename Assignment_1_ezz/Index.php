<?php include 'header.php'; 
    header("Access-Control-Allow-Origin: http://localhost");
    header("Access-Control-Allow-Credentials: true");

?>
<main>
    <h2>User Registration</h2>
    <form id="registrationForm" action="Db_Ops.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name" >

        <label for="user_name">User Name:</label>
        <input type="text" id="user_name" name="user_name" >

        <label for="birthdate">Birthdate:</label>
        <input type="date" id="birthdate" name="birthdate" >

        <button type="button" id="checkActorsButton" onclick="getActorsBornToday()">Check Actors Born Today</button>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" >

        <label for="address">Address:</label>
        <textarea id="address" name="address" ></textarea>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" >

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" >

        <label for="user_image">User Image:</label>
        <input type="file" id="user_image" name="user_image" accept="image/*" >

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" >

        <input type="submit" value="Register">
    </form>
</main>
<?php include 'footer.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="API_Ops.js"></script>
<script>
    


    // Function to validate the form fields
    function validateForm() {
        var full_name = document.getElementById("full_name").value;
        var user_name = document.getElementById("user_name").value;
        var birthdate = document.getElementById("birthdate").value;
        var phone = document.getElementById("phone").value;
        var address = document.getElementById("address").value;
        var password = document.getElementById("password").value;
        var confirm_password = document.getElementById("confirm_password").value;
        var user_image = document.getElementById("user_image").value;
        var email = document.getElementById("email").value;

        // Check if any field is empty
        if (full_name === "" || user_name === "" || birthdate === "" || phone === "" || address === "" || password === "" || confirm_password === "" || user_image === "" || email === "") {
            alert("All fields are mandatory.");
            return false;
        }

        // Check if email is valid
        var email_pattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
        if (!email_pattern.test(email)) {
            alert("Please enter a valid email address.");
            return false;
        }

        // Check if birthdate is valid
        var birthdate_pattern = /^\d{4}-\d{2}-\d{2}$/;
        if (!birthdate_pattern.test(birthdate)) {
            alert("Please enter a valid birthdate (YYYY-MM-DD format).");
            return false;
        }

        // Check if full name contains only letters and spaces
        var full_name_pattern = /^[a-zA-Z\s]*$/;
        if (!full_name_pattern.test(full_name)) {
            alert("Please enter a valid full name (letters and spaces only).");
            return false;
        }

        // Check if password meets requirements (at least 8 characters with at least 1 number and 1 special character)
        var password_pattern = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/;
        if (!password_pattern.test(password)) {
            alert("Password must be at least 8 characters long and contain at least 1 number and 1 special character.");
            return false;
        }

        // Check if password matches confirm password
        if (password !== confirm_password) {
            alert("Passwords do not match.");
            return false;
        }

        // Validation passed
        return true;
    }
</script>

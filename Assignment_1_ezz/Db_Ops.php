<?php include 'Upload.php'; 

$hostName = 'localhost';
$dbUser = 'root';
$dbPassword = '';
$dbName = 'register';

// Function to establish connection to the database
function connectToDatabase($host, $user, $password, $database) {
    $conn = mysqli_connect($host, $user, $password, $database);
    if (!$conn) {
        die('Connection failed: ' . mysqli_connect_error());
    }
    return $conn;
}

// Function to create users table if it doesn't exist
function createUsersTable($conn) {
    $createTableQuery = "
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            full_name VARCHAR(255) NOT NULL,
            user_name VARCHAR(255) NOT NULL UNIQUE,
            birthdate DATE NOT NULL,
            phone VARCHAR(20) NOT NULL,
            address VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            user_image VARCHAR(255) -- Column to store image data
        )
    ";

    if (mysqli_query($conn, $createTableQuery)) {
        echo "Table 'users' created successfully.\n";
        return true;
    } else {
        echo "Error creating table: " . mysqli_error($conn) . "\n";
        return false;
    }
}

// Function to check if a user already exists
function userExists($conn, $user_name, $email) {
    $user_name = mysqli_real_escape_string($conn, $user_name);
    $email = mysqli_real_escape_string($conn, $email);
    
    $query = "SELECT * FROM users WHERE user_name = '$user_name' OR email = '$email'";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) > 0;
}

// Function to add user if not exists
function addUserIfNotExists($conn, $full_name, $user_name, $birthdate, $phone, $address, $password, $email, $user_image) {
    if (!userExists($conn, $user_name, $email)) {
        $user_image_path = saveImage($user_image);
        $insert_query = "INSERT INTO users (full_name, user_name, birthdate, phone, address, password, email,user_image) VALUES ('$full_name', '$user_name', '$birthdate', '$phone', '$address', '$password', '$email','$user_image_path')";
        
        if (mysqli_query($conn, $insert_query)) {
            echo "User registered successfully.";
            return true;
        } else {
            echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
            return false;
        }
    } else {
        echo "User already exists.";
        return false;
    }
}

// Connect to the database
$conn = connectToDatabase($hostName, $dbUser, $dbPassword, $dbName);

// Create users table if not exists
createUsersTable($conn);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $user_image = $_FILES['user_image'];

    // Add user if not exists
    addUserIfNotExists($conn, $full_name, $user_name, $birthdate, $phone, $address, $password, $email,$user_image);
}

// Close the database connection
mysqli_close($conn);
?>

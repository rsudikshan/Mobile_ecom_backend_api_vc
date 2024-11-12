<?php

session_start();

header('Content-Type: application/json');

/*header('Access-Control-Allow-Origin: *'); // Allow all origins for development or testing.
header('Access-Control-Allow-Credentials: true'); // Allows session cookies to be sent across domains.
header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); // Allow POST, GET requests (or others if needed).
header('Access-Control-Allow-Headers: Content-Type, Authorization'); // Add other headers if needed.

header('Access-Control-Allow-Origin: https://6e87-2400-1a00-b060-76ad-3c2f-afb0-c534-ab0d.ngrok-free.app');  // Replace with the exact ngrok URL
header('Access-Control-Allow-Credentials: true');  // This allows sending cookies
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');  // Specify allowed methods
header('Access-Control-Allow-Headers: Content-Type, Authorization');  // Include necessary headers*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../DBConnections/UserDB.php';
    $login_username = isset($_POST['username']) ? $_POST['username'] : "";
    $login_password = isset($_POST['password']) ? $_POST['password'] : "";

    if ($connection) {
        $query = "SELECT * FROM user_table WHERE username = ? AND password = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, 'ss', $login_username, $login_password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            $_SESSION['username'] = $login_username;
            session_write_close();
            $row = mysqli_fetch_assoc($result);
            $email = $row['email'];

            $response = array(
                "status" => "successful",
                "email" => $email
            );
            
            error_log("Session data before output: " . print_r($_SESSION, true));
            error_log("Session data before output: " . session_id());
            echo json_encode($response);
            error_log("Session data after output: " . print_r($_SESSION, true));

            ob_end_flush();
           
        } else {
            
            $response = array(
                "status" => "invalid"
            );
            echo json_encode($response);
        }
    }
}

//TODO password encrypt and decrypt
?>

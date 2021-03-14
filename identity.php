<?php
session_start();
$username = $_POST["username"];

$servername1 = "localhost";
$username1 = "user2297";
$password1 = "cyra9hacyz";
$dbname1 = "2297_db";

$conn = new mysqli($servername1, $username1, $password1, $dbname1);

$sql = "SELECT username, identity FROM tbl_member WHERE username='$username'";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ( $row["identity"] == "admin"){
            $url = "/admin login/index.php?username=" . $username;
            header( "Location: $url" );
        
        }
        elseif ($row["identity"] == "user"){
            
            $url = "/home.php?username=" . $username;
            header( "Location: $url" );
        }
        else{
            echo "Dun hack my page.";
        }
    }
}

#sa can check who is admin and pass the name to you, just give for admin page


?>

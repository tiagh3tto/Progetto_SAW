<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Include your database connection file here
include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/connection.php");

// Get the data from the request
$data = json_decode(file_get_contents('php://input'), true);
$selectedUsers = $data['data'];

// Prepare an SQL statement for updating the ban field
$stmt = mysqli_prepare($con, "UPDATE utenti SET Ban = NOT Ban WHERE Email = ?");

// Loop through the selected users and execute the SQL statement for each one
foreach ($selectedUsers as $user) {
    mysqli_stmt_bind_param($stmt, "s", $user['Email']);
        mysqli_execute($stmt);
}

// Now get the updated data for the selected users
$query = "SELECT Nome, Cognome, Email, Data_Nascita, Genere, Nazionalità, Ban FROM Utenti;";
$res = mysqli_query($con, $query);

$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);

// Convert the array to JSON
$updatedUsers = json_encode($rows);


// Send the updated data back as a JSON response
header('Content-Type: application/json');
echo json_encode($updatedUsers);
?>
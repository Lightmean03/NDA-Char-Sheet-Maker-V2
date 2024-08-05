<?php
// Start the session
session_start();

// Ensure the session variable 'name' is set
if (isset($_SESSION['name'])) {
    // Path to the JSON file in the data folder
    $jsonFile = 'data/' . $_SESSION['name'] . '.json';

    // Check if the file exists
    if (file_exists($jsonFile)) {
        // Read the JSON file
        $jsonContent = file_get_contents($jsonFile);

        // Decode the JSON data
        $data = json_decode($jsonContent, true);

        // Check if decoding was successful
        if ($data !== null) {
            // Print the JSON data in a readable format
            echo '<pre>';
            print_r($data);
            echo '</pre>';
        } else {
            echo "Error decoding JSON.";
        }
    } else {
        echo "JSON file not found.";
    }
} else {
    echo "Session variable 'name' is not set.";
}
?>


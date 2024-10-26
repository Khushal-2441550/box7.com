<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the form data
    $customer_id = $_POST['customer_id'];
    $customer_name = $_POST['customer_name'];
    $product_name = $_POST['product_name'];
    $rating = $_POST['rating'];
    $comments = $_POST['comments'];

    // Validate data
    if (!empty($customer_id) && !empty($customer_name) && !empty($product_name) && !empty($rating) && !empty($comments)) {
        // Connection to the database (update your credentials)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "feedbacks";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: ". $conn->connect_error);
        }

        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO feedback (customer_id, customer_name, product_name, rating, comments) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis", $customer_id, $customer_name, $product_name, $rating, $comments);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Thank you for your feedback!";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "All fields are required.";
    }
}
?>


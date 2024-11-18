<?php
// Include the database connection
include("config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form values
    $bookName = $_POST['book_name'];
    $authorName = $_POST['author_name'];
    $lenderName = $_POST['lender_name'];
    $department = $_POST['department'];
    $yearOfStudy = $_POST['year_of_study'];
    $lendingDate = $_POST['lending_date'];

    // Prepare and bind SQL insert statement
    $stmt = $conn->prepare("INSERT INTO lending (book_name, author_name, lender_name, department, year_of_study, lending_date) 
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $bookName, $authorName, $lenderName, $department, $yearOfStudy, $lendingDate);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Redirect to the index page after inserting the data
    header("Location: index.php");
    exit();
}
?>

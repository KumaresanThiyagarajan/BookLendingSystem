<?php
// Include the database connection
include("config.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM lending WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $record = $result->fetch_assoc();
} else {
    // Redirect if no ID is passed
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get updated details
    $book_name = $_POST['book_name'];
    $author_name = $_POST['author_name'];
    $lender_name = $_POST['lender_name'];
    $department = $_POST['department'];
    $year_of_study = $_POST['year_of_study'];
    $lending_date = $_POST['lending_date'];

    $update_sql = "UPDATE lending SET book_name=?, author_name=?, lender_name=?, department=?, year_of_study=?, lending_date=? WHERE id=?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssssssi", $book_name, $author_name, $lender_name, $department, $year_of_study, $lending_date, $id);
    $stmt->execute();

    // Redirect to index after update
    header("Location: index.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lending Details</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Edit Lending Details</h1>
        <form action="edit_lending.php?id=<?php echo $record['id']; ?>" method="POST">
            <div class="form-group">
                <label for="bookName">Book Name:</label>
                <input type="text" id="bookName" name="book_name" value="<?php echo htmlspecialchars($record['book_name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="authorName">Author Name:</label>
                <input type="text" id="authorName" name="author_name" value="<?php echo htmlspecialchars($record['author_name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="lenderName">Lender Name:</label>
                <input type="text" id="lenderName" name="lender_name" value="<?php echo htmlspecialchars($record['lender_name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="department">Department:</label>
                <input type="text" id="department" name="department" value="<?php echo htmlspecialchars($record['department']); ?>" required>
            </div>

            <div class="form-group">
                <label for="yearOfStudy">Year of Study:</label>
                <input type="text" id="yearOfStudy" name="year_of_study" value="<?php echo htmlspecialchars($record['year_of_study']); ?>" required>
            </div>

            <div class="form-group">
                <label for="lendingDate">Lending Date:</label>
                <input type="date" id="lendingDate" name="lending_date" value="<?php echo htmlspecialchars($record['lending_date']); ?>" required>
            </div>

            <div class="form-group">
                <button type="submit">Update Lending Details</button>
            </div>
        </form>
    </div>
</body>
</html>

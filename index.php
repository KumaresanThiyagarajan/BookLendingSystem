<?php
// Include the database connection
include("config.php");

$sql = "SELECT * FROM lending";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Store all records in $records array
    $records = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $records = [];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Book Lending System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Book Lending System</h1>

        <!-- Add Lending Form -->
        <h2>Add Lending Details</h2>
        <form id="lendingForm" action="handle_lending.php" method="POST">
    <div class="form-group">
        <label for="bookName">Book Name:</label>
        <input type="text" id="bookName" name="book_name" required>
    </div>
    <div class="form-group">
        <label for="authorName">Author Name:</label>
        <input type="text" id="authorName" name="author_name" required>
    </div>
    <div class="form-group">
        <label for="lenderName">Lender Name:</label>
        <input type="text" id="lenderName" name="lender_name" required>
    </div>
    <div class="form-group">
        <label for="department">Department:</label>
        <input type="text" id="department" name="department" required>
    </div>
    <div class="form-group">
        <label for="yearOfStudy">Year of Study:</label>
        <input type="text" id="yearOfStudy" name="year_of_study" required>
    </div>
    <div class="form-group">
        <label for="lendingDate">Lending Date:</label>
        <input type="date" id="lendingDate" name="lending_date" required>
    </div>
    <div class="form-group">
        <button type="submit">Add Lending Details</button>
    </div>
</form>

        <!-- Lending Records Table -->
        <h2>Lending Records</h2>
        <div class="table-container">
            <table id="lendingTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Book Name</th>
                        <th>Author Name</th>
                        <th>Lender Name</th>
                        <th>Department</th>
                        <th>Year of Study</th>
                        <th>Lending Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($records as $record): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($record['id']); ?></td>
                            <td><?php echo htmlspecialchars($record['book_name']); ?></td>
                            <td><?php echo htmlspecialchars($record['author_name']); ?></td>
                            <td><?php echo htmlspecialchars($record['lender_name']); ?></td>
                            <td><?php echo htmlspecialchars($record['department']); ?></td>
                            <td><?php echo htmlspecialchars($record['year_of_study']); ?></td>
                            <td><?php echo htmlspecialchars($record['lending_date']); ?></td>
                            <td class="actions">
                                <a href="edit_lending.php?id=<?php echo $record['id']; ?>" class="edit-button">Edit</a>
                                <a href="delete_lending.php?id=<?php echo $record['id']; ?>" class="delete-button" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'project');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete request
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM appointment_images WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    header('Location: manage_appointments_images.php');
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Appointment Images - Mahendi Magic Hub</title>
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/sidebar.css">
    <style>
    /* themes.css */
    body.light-mode {
        --background-color: #f8f9fa;
        --card-background: #ffffff;
        --text-color: #333;
        --border-color: #ccc;
        --btn-background: #90a14e;
        --btn-background-hover: #758f47;
        --btn-background-active: #667946;
    }
	body.light-mode .card h2 {
    color: black;
}
    body.dark-mode {
        --background-color: #121212;
        --card-background: #1e1e1e;
        --text-color: #e0e0e0;
        --border-color: #444;
        --btn-background: #90a14e;
        --btn-background-hover: #758f47;
        --btn-background-active: #667946;
    }
	    body.dark-mode .card h2 {
    color: white;
}
    body {
        background-color: var(--background-color);
        color: var(--text-color);
    }
    .admin-content {
        background-color: var(--background-color);
        padding: 50px;
        margin-left: 250px; /* Matches the width of the sidebar */
        margin-top: 20px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        overflow: hidden; /* Ensure content stays within the border */
    }
    .card {
        background-color: var(--card-background);
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }
    .admin-header {
        background-color: black;
        color: white;
        padding: 20px;
        text-align: center;
		 border-bottom: 4px solid var(--border-color);
    }
    h2 {
        font-size: 28px;
        font-weight: 600;
        color: var(--text-color);
        margin-bottom: 30px;
        border-bottom: 2px solid #90a14e;
        padding-bottom: 10px;
        letter-spacing: 0.5px;
    }
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    .table, .table th, .table td {
        border: 1px solid var(--border-color);
    }
    .table th, .table td {
        padding: 10px;
        text-align: left;
    }
    .table th {
        background-color: var(--card-background);
    }
    .btn {
        display: inline-block;
        background-color: var(--btn-background);
        text-decoration: none;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 16px;
        font-weight: 600;
        text-align: center;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
    }
    .btn:hover {
        background-color: var(--btn-background-hover);
        box-shadow: 0 5px 15px rgba(117, 143, 71, 0.3);
    }
    .btn:active {
        background-color: var(--btn-background-active);
    }
    </style>
</head>
<body>

    <?php include 'sidebar.php'; ?>

    <div class="admin-header">
        <h1>Manage Appointment Images - Mahendi Magic Hub</h1>
    </div>

    <div class="admin-content">
        <section class="card">
            <h2>Manage Appointment Images</h2>
            
            <!-- Display existing appointment images -->
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Appointment ID</th>
                        <th>Image Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Database connection
                        $conn = new mysqli('localhost', 'root', '', 'project');
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Fetch appointment images
                        $result = $conn->query("SELECT * FROM appointment_images");
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['appointment_id']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['img_name']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['price']) . '</td>';
                                echo '<td><img src="' . htmlspecialchars($row['images']) . '" alt="' . htmlspecialchars($row['img_name']) . '" style="width: 80px; height: auto; max-height: 80px;"></td>';
                                echo '<td><a href="?action=delete&id=' . htmlspecialchars($row['id']) . '" class="btn" onclick="return confirm(\'Are you sure you want to delete this image?\');">Delete</a></td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="6">No images found.</td></tr>';
                        }
                        $conn->close();
                    ?>
                </tbody>
            </table>
        </section>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const themeToggle = document.getElementById('theme-toggle');
        const currentTheme = localStorage.getItem('theme') || 'light-mode';
        
        document.body.classList.add(currentTheme);

        themeToggle.addEventListener('click', () => {
            const newTheme = document.body.classList.contains('light-mode') ? 'dark-mode' : 'light-mode';
            document.body.classList.remove('light-mode', 'dark-mode');
            document.body.classList.add(newTheme);
            localStorage.setItem('theme', newTheme);
        });
    });
    </script>
</body>
</html>

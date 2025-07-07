<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'project');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete request
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['appointment_id'])) {
    $appointment_id = $_GET['appointment_id'];

    // First, delete related images
    $stmt = $conn->prepare("DELETE FROM appointment_images WHERE appointment_id = ?");
    $stmt->bind_param('i', $appointment_id);
    $stmt->execute();

    // Then, delete the appointment
    $stmt = $conn->prepare("DELETE FROM appointments WHERE appointment_id = ?");
    $stmt->bind_param('i', $appointment_id);
    $stmt->execute();

    header('Location: manage_appointments.php');
    exit;
}

// Handle cancellation request
if (isset($_GET['action']) && $_GET['action'] === 'cancel' && isset($_GET['appointment_id'])) {
    $appointment_id = $_GET['appointment_id'];

    // Update the appointment status to canceled
    $stmt = $conn->prepare("UPDATE appointments SET status = 'canceled' WHERE appointment_id = ?");
    $stmt->bind_param('i', $appointment_id);
    $stmt->execute();

    header('Location: manage_appointments.php');
    exit;
}

// Handle confirmation request
if (isset($_GET['action']) && $_GET['action'] === 'confirm' && isset($_GET['appointment_id'])) {
    $appointment_id = $_GET['appointment_id'];

    // Update the appointment status to confirmed
    $stmt = $conn->prepare("UPDATE appointments SET status = 'confirmed' WHERE appointment_id = ?");
    $stmt->bind_param('i', $appointment_id);
    $stmt->execute();

    header('Location: manage_appointments.php');
    exit;
}

// Handle AJAX request to fetch appointment data
if (isset($_GET['ajax']) && $_GET['ajax'] === 'get_appointment' && isset($_GET['appointment_id'])) {
    $appointment_id = $_GET['appointment_id'];
    $result = $conn->query("SELECT * FROM appointments WHERE appointment_id = $appointment_id");
    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode([]);
    }
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Appointments - Mahendi Magic Hub</title>
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/sidebar.css">
    <style>
        /* Themes and layout styling */
        body.light-mode {
            --background-color: #f8f9fa;
            --card-background: #ffffff;
            --text-color: #333;
            --border-color: #ccc;
            --btn-background: #90a14e;
            --btn-background-hover: #758f47;
            --btn-background-active: #667946;
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
        body {
            background-color: var(--background-color);
            color: var(--text-color);
        }
        .admin-content {
            background-color: var(--background-color);
            padding: 50px;
            margin-left: 250px;
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
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
            background-color: var(--background-color);
        }

        .btn {
            display: inline-block;
            background-color: var(--btn-background);
            text-decoration: none;
            color: white;
            padding: 8px 10px;
            border-radius: 5px;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn:hover {
            background-color: var(--btn-background-hover);
        }
        button[type="submit"] {
            background-color: #90a14e;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button[type="submit"]:hover {
            background-color: #758f47;
        }
        .edit-form-container {
            display: none;
        }
    </style>
</head>
<body>

    <?php include 'sidebar.php'; ?>

    <div class="admin-header">
        <h1>Manage Appointments - Mahendi Magic Hub</h1>
    </div>

    <div class="admin-content">
        <section class="card">
            <h2>Manage Appointments</h2>
            
            <!-- Display existing appointments -->
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Number</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Confirm</th>
                        <th>Cancel</th>
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

                        // Fetch appointments
                        $result = $conn->query("SELECT * FROM appointments");
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . $row['appointment_id'] . '</td>';
                                echo '<td>' . $row['name'] . '</td>';
                                echo '<td>' . $row['email'] . '</td>';
                                echo '<td>' . $row['number'] . '</td>';
                                echo '<td>' . $row['date'] . '</td>';
                                echo '<td>' . $row['time'] . '</td>';
                                echo '<td>' . $row['address'] . '</td>';
                                echo '<td>' . $row['status'] . '</td>';
                                echo '<td><a href="?action=confirm&appointment_id=' . $row['appointment_id'] . '" class="btn" onclick="return confirm(\'Are you sure you want to confirm this appointment?\');">Confirm</a></td>';
                                echo '<td><a href="?action=cancel&appointment_id=' . $row['appointment_id'] . '" class="btn" onclick="return confirm(\'Are you sure you want to cancel this appointment?\');">Cancel</a></td>';
                                echo '<td><a href="?action=delete&appointment_id=' . $row['appointment_id'] . '" class="btn" onclick="return confirm(\'Are you sure you want to delete this appointment?\');">Delete</a></td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="11">No appointments found.</td></tr>';
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

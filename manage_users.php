<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'project');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle AJAX delete request
if (isset($_POST['action']) && $_POST['action'] === 'delete' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting user']);
    }
    $stmt->close();
    $conn->close();
    exit;
}

// Fetch users (same as before)
$result = $conn->query("SELECT * FROM users");
$users = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - Mahendi Magic Hub</title>
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
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .admin-content {
            background-color: var(--background-color);
            padding: 50px;
            margin-left: 250px;
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .card {
            background-color: var(--card-background);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
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
        a.btn {
            text-decoration: none;
        }
        .btn {
            display: inline-block;
            background-color: var(--btn-background);
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
            text-decoration: none;
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
        <h1>Manage Users - Mahendi Magic Hub</h1>
    </div>

    <div class="admin-content">
        <!-- Existing users -->
        <section class="card">
            <h2>Manage Users</h2>
            
            <!-- Display existing users -->
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Number</th>
                        <th>Username</th>
                        <th>Address</th>
                        <th>Created At</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody id="user-table-body">
                    <?php foreach ($users as $user): ?>
                        <tr data-id="<?= $user['id'] ?>">
                            <td><?= $user['id'] ?></td>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['number'] ?></td>
                            <td><?= $user['username'] ?></td>
                            <td><?= empty($user['address']) ? 'N/A' : $user['address'] ?></td>
                            <td><?= $user['created_at'] ?></td>
                            <td><button class="btn delete-btn">Delete</button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const userTableBody = document.getElementById('user-table-body');

            userTableBody.addEventListener('click', event => {
                if (event.target.classList.contains('delete-btn')) {
                    const row = event.target.closest('tr');
                    const userId = row.getAttribute('data-id');
                    if (confirm('Are you sure you want to delete this user?')) {
                        fetch('manage_users.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: new URLSearchParams({
                                action: 'delete',
                                id: userId,
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                row.remove();
                            } else {
                                alert(data.message || 'Failed to delete user.');
                            }
                        });
                    }
                }
            });

            // Theme toggle script
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

<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'project');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables for form
$package_name = '';
$package_price = '';
$package_description = '';
$imagePath = '';

// Handle form submission for adding or updating packages
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $package_name = $_POST['package_name'];
    $package_price = $_POST['package_price'];
    $package_description = $_POST['package_description'];
    $package_id = isset($_POST['package_id']) ? intval($_POST['package_id']) : null;

    // Handle image upload
    $imagePath = '';
    if (isset($_FILES['package_image']) && $_FILES['package_image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpName = $_FILES['package_image']['tmp_name'];
        $imageName = basename($_FILES['package_image']['name']);
        $uploadDir = 'images/index/'; // Relative path
        $uploadFile = $uploadDir . $imageName;

        // Check if the images directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true); // Create the directory if it does not exist
        }

        // Move the uploaded file to the images directory
        if (move_uploaded_file($imageTmpName, $uploadFile)) {
            // Set image path for database
            $imagePath = $uploadFile;
        } else {
            $error = "Failed to move uploaded file. Check if the directory exists and has appropriate permissions.";
        }
    }

    if ($package_id) {
        // Update package
        if ($imagePath) {
            $stmt = $conn->prepare("UPDATE packages SET package_name = ?, price = ?, package_description = ?, image = ? WHERE id = ?");
            $stmt->bind_param("sissi", $package_name, $package_price, $package_description, $imagePath, $package_id);
        } else {
            $stmt = $conn->prepare("UPDATE packages SET package_name = ?, price = ?, package_description = ? WHERE id = ?");
            $stmt->bind_param("sisi", $package_name, $package_price, $package_description, $package_id);
        }
    } else {
        // Add new package
        $stmt = $conn->prepare("INSERT INTO packages (package_name, price, package_description, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siss", $package_name, $package_price, $package_description, $imagePath);
    }

    if ($stmt->execute()) {
        // Redirect back with a success message
        header("Location: manage_packages.php?status=success");
        exit;
    } else {
        $error = "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Handle package deletion
if (isset($_GET['delete_id']) && is_numeric($_GET['delete_id'])) {
    $packageId = intval($_GET['delete_id']);

    // Fetch the image path from the database
    $stmt = $conn->prepare("SELECT image FROM packages WHERE id = ?");
    $stmt->bind_param("i", $packageId);
    $stmt->execute();
    $stmt->bind_result($imagePath);
    $stmt->fetch();
    $stmt->close();

    // If the image path exists, delete the file
    if ($imagePath) {
        $fullImagePath = $imagePath; // Relative path
        if (file_exists($fullImagePath)) {
            unlink($fullImagePath); // Delete the file
        }
    }

    // Delete the record from the database
    $stmt = $conn->prepare("DELETE FROM packages WHERE id = ?");
    $stmt->bind_param("i", $packageId);
    
    if ($stmt->execute()) {
        // Redirect back with a success message
        header("Location: manage_packages.php?status=deleted");
        exit;
    } else {
        $error = "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch package details if editing
$package_id = isset($_GET['edit_id']) ? intval($_GET['edit_id']) : null;
if ($package_id) {
    $stmt = $conn->prepare("SELECT package_name, price, package_description, image FROM packages WHERE id = ?");
    $stmt->bind_param("i", $package_id);
    $stmt->execute();
    $stmt->bind_result($package_name, $package_price, $package_description, $imagePath);
    $stmt->fetch();
    $stmt->close();
}

// Fetch packages
$result = $conn->query("SELECT * FROM packages");
$packages = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $packages[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Packages - Mahendi Magic Hub</title>
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
            padding-right: 100px;
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
        .form-group {
            margin-bottom: 25px;
        }
        .form-group label {
            font-size: 16px;
            font-weight: 500;
            color: var(--text-color);
            margin-bottom: 8px;
            display: block;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            font-size: 16px;
            color: var(--text-color);
            background-color: var(--background-color);
            transition: all 0.3s ease;
        }
        .form-group input:focus, .form-group textarea:focus {
            border-color: #90a14e;
            background-color: #ffffff;
            box-shadow: 0 0 8px rgba(144, 161, 78, 0.2);
        }
        textarea {
            resize: vertical;
            min-height: 100px;
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
        }
        .btn:hover {
            background-color: var(--btn-background-hover);
            box-shadow: 0 5px 15px rgba(117, 143, 71, 0.3);
        }
        .btn:active {
            background-color: var(--btn-background-active);
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
    </style>
</head>
<body>

    <?php include 'sidebar.php'; ?>

    <div class="admin-header">
        <h1>Manage Packages - Mahendi Magic Hub</h1>
    </div>

    <div class="admin-content">
        <section class="card">
            <h2><?php echo isset($package_id) ? 'Edit Package' : 'Add New Package'; ?></h2>
            <form action="manage_packages.php" method="POST" enctype="multipart/form-data">
                <?php if (isset($package_id)): ?>
                    <input type="hidden" name="package_id" value="<?php echo htmlspecialchars($package_id); ?>">
                <?php endif; ?>
                <div class="form-group">
                    <label for="package_name">Package Name</label>
                    <input type="text" id="package_name" name="package_name" value="<?php echo htmlspecialchars($package_name); ?>" placeholder="Enter package name" required>
                </div>
                <div class="form-group">
                    <label for="package_price">Package Price</label>
                    <input type="number" id="package_price" name="package_price" value="<?php echo htmlspecialchars($package_price); ?>" placeholder="Enter package price" required>
                </div>
                <div class="form-group">
                    <label for="package_description">Package Description</label>
                    <textarea id="package_description" name="package_description" placeholder="Enter package description" required><?php echo htmlspecialchars($package_description); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="package_image">Package Image</label>
                    <input type="file" id="package_image" name="package_image" accept="image/*">
                    <?php if (isset($imagePath) && $imagePath): ?>
                        <p>Current image: <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="Current Image" style="max-width: 100px;"></p>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn"><?php echo isset($package_id) ? 'Update Package' : 'Add Package'; ?></button>
            </form>            
        </section>
        
        <!-- Display existing packages -->
        <section class="card">
            <h2>Existing Packages</h2>
            <?php if (count($packages) > 0): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($packages as $package): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($package['id']); ?></td>
                                <td><?php echo htmlspecialchars($package['package_name']); ?></td>
                                <td><?php echo htmlspecialchars($package['package_description']); ?></td>
                                <td><?php echo htmlspecialchars($package['price']); ?></td>
                                <td>
                                    <?php 
                                    $imagePath = htmlspecialchars($package['image']); 
                                    ?>
                                    <img src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($package['package_name']); ?>" style="max-width: 100px;">
                                </td>
                                <td><a href="manage_packages.php?edit_id=<?php echo $package['id']; ?>" class="btn">Edit</a></td>
                                <td><a href="manage_packages.php?delete_id=<?php echo $package['id']; ?>" class="btn">Delete</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No packages found.</p>
            <?php endif; ?>
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

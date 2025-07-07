<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bridal Images - Mahendi Magic Hub</title>
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/sidebar.css">
    <style>
        /* Light Mode */
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
            transition: background-color 0.3s, color 0.3s;
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
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        table td img {
            width: 100px;
        }

        .form-container input[type="text"], .form-container input[type="number"], .form-container input[type="file"] {
            padding: 10px;
            margin-right: 10px;
			margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid var(--btn-background);
        }

       .btn {
            display: inline-block;
            background-color: var(--btn-background);
            color: white;
            padding:10px 15px;
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
<body class="light-mode">

    <?php
    // Include sidebar if necessary
    include 'sidebar.php';

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'project');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle image upload and database insertion
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
        $imageName = $_POST['image_name'];
        $price = $_POST['price'];
        $action = $_POST['action'];

        // Add new image
        if ($action === 'add') {
            if (isset($_FILES['image_file'])) {
                $file = $_FILES['image_file'];
                $fileName = $file['name'];
                $fileTmp = $file['tmp_name'];
                $uploadDir = 'images/bridal/'; // Folder where images will be uploaded

                // Ensure the directory exists
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $filePath = $uploadDir . basename($fileName);
                
                // Move the uploaded file to the designated directory
                if (move_uploaded_file($fileTmp, $filePath)) {
                    $stmt = $conn->prepare("INSERT INTO bridal_images(image_name, image_path, price) VALUES (?, ?, ?)");
                    $stmt->bind_param("ssi", $imageName, $filePath, $price);
                    $stmt->execute();
                    $stmt->close();
                    echo "Image uploaded and data inserted successfully!";
                } else {
                    echo "Failed to upload image.";
                }
            }
        }

        // Edit image details
        if ($action === 'edit' && isset($_POST['id'])) {
            $id = $_POST['id'];

            // Check if a new file was uploaded
            if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == 0) {
                $file = $_FILES['image_file'];
                $fileName = $file['name'];
                $fileTmp = $file['tmp_name'];
                $uploadDir = 'images/bridal/';

                $filePath = $uploadDir . basename($fileName);

                // Move new file and update path in database
                if (move_uploaded_file($fileTmp, $filePath)) {
                    $stmt = $conn->prepare("UPDATE bridal_images SET image_name = ?, image_path = ?, price = ? WHERE id = ?");
                    $stmt->bind_param("ssii", $imageName, $filePath, $price, $id);
                    $stmt->execute();
                    $stmt->close();
                }
            } else {
                // If no new file is uploaded, update just the name and price
                $stmt = $conn->prepare("UPDATE bridal_images SET image_name = ?, price = ? WHERE id = ?");
                $stmt->bind_param("sii", $imageName, $price, $id);
                $stmt->execute();
                $stmt->close();
            }
            echo "Image details updated!";
        }

        // Delete image
        if ($action === 'delete' && isset($_POST['id'])) {
            $id = $_POST['id'];

            // Get the image path to delete the file
            $stmt = $conn->prepare("SELECT image_path FROM bridal_images WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($imagePath);
            $stmt->fetch();
            $stmt->close();

            // Delete the file
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            // Delete the image entry from the database
            $stmt = $conn->prepare("DELETE FROM bridal_images WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();

            echo "Image deleted!";
        }
    }
    ?>

    <div class="admin-header">
        <h1>Manage Bridal Images</h1>
    </div>

    <div class="admin-content">
        <section class="card">
            <h2>Bridal Images</h2>

            <!-- Form for adding new images -->
            <div class="form-container">
                <form id="add-image-form" method="POST" enctype="multipart/form-data">
                    <input type="text" name="image_name" id="image-name" placeholder="Image Name" required>
                    <input type="file" name="image_file" id="image-file" required>
                    <input type="number" name="price" id="price" placeholder="Price" required>
                    <input type="hidden" name="action" value="add">
                    <button type="submit" class="btn">Add Image</button>
                </form>
            </div>

            <!-- Table for managing Bridal images -->
            <?php
            // Fetch Bridal images
            $query = "SELECT * FROM bridal_images";
            $result = $conn->query($query);
            
            echo "<table>";
            echo "<tr><th>ID</th><th>Image Name</th><th>Image</th><th>Price</th><th>Edit</th><th>Delete</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['image_name'] . "</td>";
                echo "<td><img src='" . $row['image_path'] . "' alt='" . $row['image_name'] . "' style='width: 80px; height: auto; max-height: 80px;'></td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td><button class='btn' onclick='editImage(" . $row['id'] . ", \"" . $row['image_name'] . "\", " . $row['price'] . ")'>Edit</button></td>";
                echo "<td><button class='btn' onclick='deleteImage(" . $row['id'] . ")'>Delete</button></td>";
                echo "</tr>";
            }

            echo "</table>";

            // Close connection
            $conn->close();
            ?>
    

    <!-- Edit Modal (Populated dynamically using JS) -->
    <div id="edit-modal" style="display: none;">
        <div class="form-container">
            <form id="edit-image-form" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="edit-id">
                <input type="text" name="image_name" id="edit-image-name" placeholder="Image Name" required>
                <input type="file" name="image_file" id="edit-image-file">
                <input type="number" name="price" id="edit-price" placeholder="Price" required>
                <input type="hidden" name="action" value="edit">
                <button type="submit" class="btn">Save Changes</button>
            </form>
        </div>
    </div>
    </section>
    </div>
    <script>
    // Form submission handling for adding images
    document.getElementById('add-image-form').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', '', true); // Send the request to the same page
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Optionally, refresh the page or dynamically update the table
                location.reload(); // Reload the page to see the new image
            }
        };
        xhr.send(formData);
    });

    // Function to edit an image
    function editImage(id, name, price) {
        document.getElementById('edit-id').value = id;
        document.getElementById('edit-image-name').value = name;
        document.getElementById('edit-price').value = price;
        document.getElementById('edit-modal').style.display = 'block';
    }

    // Form submission handling for editing images
    document.getElementById('edit-image-form').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', '', true); // Send the request to the same page
        xhr.onload = function() {
            if (xhr.status === 200) {
                alert("Record Edited successfully!");
                location.reload(); // Reload the page to see the updated image
            }
        };
        xhr.send(formData);
    });

    // Function to delete an image
    function deleteImage(id) {
        if (confirm("Are you sure you want to delete this image?")) {
            const formData = new FormData();
            formData.append('id', id);
            formData.append('action', 'delete');

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert("Record Deleted successfully!");
                    location.reload(); // Reload the page to remove the deleted image
                }
            };
            xhr.send(formData);
        }
    }
    </script>
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

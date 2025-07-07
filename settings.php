<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Mahendi Magic Hub</title>
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/sidebar.css">
	<!--<link rel="stylesheet" href="dashboard/themes.css"> -->
    <style>
	/* Light Mode (default) */


/* Additional CSS for changing <h2> text color in light mode */
body.light-mode .card h2 {
    color: black;
}

/* Dark Mode */
body.dark-mode {
    --background-color: #121212;
    --text-color: #e0e0e0;
    --card-background: #1e1e1e;
    --border-color: #333;
    --btn-background: #607d3b;
    --btn-background-hover: #4e6332;
    --btn-background-active: #3e5229;
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
            background-color: #f9f9f9;
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

        .btn {
    display: inline-block;
    background-color: #90a14e; /* Set the button background to green */
    color: white;
    padding: 12px 30px;
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
    background-color: #7c8d4f; /* A darker green for hover effect */
    box-shadow: 0 5px 15px rgba(117, 143, 71, 0.3);
}

.btn:active {
    background-color: #6b7d43; /* An even darker green for active state */
}

    </style>
</head>
<body class="light-mode">

    <?php include 'sidebar.php'; ?>

    <div class="admin-header">
        <h1>Settings - Mahendi Magic Hub</h1>
        
    </div>

    <div class="admin-content">
        <section class="card">
            <h2>Settings</h2>
            <p>Adjust website settings like theme.</p>
            <button id="theme-toggle" class="btn">Change Theme</button>
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

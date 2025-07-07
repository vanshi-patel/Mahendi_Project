<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Gallery - Mahendi Magic Hub</title>
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/sidebar.css">
    <style>
      /* themes.css */
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

      table {
          width: 100%;
          border-collapse: collapse;
          margin: 20px 0;
      }

      th, td {
          padding: 12px;
          text-align: left;
          border-bottom: 1px solid var(--btn-background);
      }

      th {
          background-color: var(--btn-background);
          color: white;
          font-size: 18px;
          font-weight: 600;
      }

      td a {
          display: block;
          color: var(--btn-background);
          text-decoration: none;
          font-size: 16px;
          font-weight: 600;
          padding: 10px 15px;
          border-radius: 5px;
          transition: background-color 0.3s ease;
      }

      td a:hover {
          background-color: var(--btn-background-hover);
          color: white;
      }

      td a:active {
          background-color: var(--btn-background-active);
      }
    </style>
</head>
<body>

    <?php include 'sidebar.php'; ?>

    <div class="admin-header">
        <h1>Manage Gallery - Mahendi Magic Hub</h1>
    </div>

    <div class="admin-content">
        <section class="card">
            <h2>Manage Image Categories</h2>
            <table>
                <tbody>
                    <tr>
                        <td><a href="manage_arabic_images.php">Manage Arabic Images</a></td>
                    </tr>
					<tr>
                        <td><a href="manage_western_images.php">Manage Western Images</a></td>
                    </tr>
					<tr>
                        <td><a href="manage_bridal_images.php">Manage Bridal Images</a></td>
                    </tr>
                    <tr>
                        <td><a href="manage_babyshower_images.php">Manage Babyshower Images</a></td>
                    </tr>
                    <tr>
                        <td><a href="manage_kankupagla_images.php">Manage Kanku Pagla Images</a></td>
                    </tr>
                    
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

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/sidebar.css">
</head>
<style>
/* sidebar.css */

.admin-sidebar {
    width: 250px;
    height: 100vh;
    background-color: #374045;
    position: fixed;
    top: 0;
    left: 0;
    padding-top: 20px;
    font-family: 'Arial', sans-serif;
    overflow-y: auto; /* Add scrollbar if content overflows */
}

.admin-sidebar ul {
    list-style-type: none;
    padding: 0;
}

.admin-sidebar ul li {
    padding: 15px;
    text-align: left;
}

.admin-sidebar ul li a {
    color: #d3d3d3;
    text-decoration: none;
    display: block;
    font-weight: 500;
    position: relative;
    padding-left: 20px;
    font-size: 16px; /* Main links font size */
}

.admin-sidebar ul li a:before {
    content: ">"; /* Adds > before each link */
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    color: #d3d3d3;
}

.admin-sidebar ul li a:hover {
    background-color: #90a14e;
    color: white;
    padding-left: 30px; /* Adds padding to shift text on hover */
    transition: 0.8s;
}

/* Ensure submenus are always visible */
   .admin-sidebar ul li ul {
    list-style-type: none;
    padding-left: 15px;
    display: block; /* Always show submenus */
}

.admin-sidebar ul li ul li {
    padding: 10px 15px;
}

.admin-sidebar ul li ul li a {
    font-size: 12px; /* Even smaller font size for sublinks */
}

.admin-sidebar ul li a.active {
    background-color: #758f47; 
    color: white;
    padding-left: 30px; 
    font-weight: bold; 
    border-left: 5px solid #90a14e; 
    transition: all 0.8s ease;
}

.admin-sidebar ul li a.active:before {
    color: white; 
}

@media (max-width: 768px) {
    .admin-sidebar {
        width: 100%;
        height: auto;
        position: relative;
    }
}
h2{
	color: white;
	text-align:center;
}
</style>
<body>
    <div class="admin-sidebar">
	<h2>Menu Bar</h2>
        <ul>
            <li><a href="admin.php">Dashboard</a></li>
            <li><a href="manage_packages.php">Manage Packages</a></li>
            <li class="manage-gallery">
                <a href="manage_gallery.php">Manage Gallery</a>
                <ul>
                    <li><a href="manage_arabic_images.php">Manage Arabic Images</a></li>
                    <li><a href="manage_western_images.php">Manage Western Images</a></li>
                    <li><a href="manage_bridal_images.php">Manage Bridal Images</a></li>
					<li><a href="manage_babyshower_images.php">Manage Baby-Shower Images</a></li>
                    <li><a href="manage_kankupagla_images.php">Manage Kanku-Pagla Images</a></li>     
                </ul>
            </li>
            <li><a href="manage_appointments.php">Manage Appointments</a>
			<ul>
                    <li><a href="manage_appointments_images.php">Manage Appointments Images</a></li>
			</ul>
			</li>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="settings.php">Settings</a></li>
        </ul>
    </div>

    <script>
        // JavaScript to handle active link and submenu display
        const links = document.querySelectorAll('.admin-sidebar ul li > a');
        const galleryLinks = document.querySelectorAll('.manage-gallery ul li a');

        // Function to set active link and submenu
        function setActiveLink(href) {
            links.forEach(link => link.classList.remove('active'));
            galleryLinks.forEach(link => link.classList.remove('active'));

            // Find and activate the clicked link
            links.forEach(link => {
                if (link.getAttribute('href') === href) {
                    link.classList.add('active');
                    if (link.closest('.manage-gallery')) {
                        link.closest('.manage-gallery').classList.add('active'); // Keep submenu open
                    }
                }
            });

            galleryLinks.forEach(link => {
                if (link.getAttribute('href') === href) {
                    link.classList.add('active');
                    link.closest('.manage-gallery').classList.add('active'); // Keep submenu open
                }
            });
        }

        // Event listener for each link
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                // Save the active link in localStorage to persist state on page reload
                localStorage.setItem('activeLink', this.getAttribute('href'));
            });
        });

        galleryLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                // Save the active link in localStorage to persist state on page reload
                localStorage.setItem('activeLink', this.getAttribute('href'));
            });
        });

        // When the page loads, check if an active link was stored and apply 'active' class
        window.addEventListener('DOMContentLoaded', () => {
            const activeLink = localStorage.getItem('activeLink');
            if (activeLink) {
                setActiveLink(activeLink);
            }
        });
    </script>
</body>
</html>

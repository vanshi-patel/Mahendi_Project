<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'project');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch total appointments
$totalAppointmentsQuery = "SELECT COUNT(*) as total FROM appointments";
$totalAppointmentsResult = $conn->query($totalAppointmentsQuery);
$totalAppointments = $totalAppointmentsResult->fetch_assoc()['total'];

// Fetch total images
$totalImagesQuery = "SELECT COUNT(*) as total FROM appointment_images";
$totalImagesResult = $conn->query($totalImagesQuery);
$totalImages = $totalImagesResult->fetch_assoc()['total'];

// Fetch total revenue
$totalRevenueQuery = "SELECT SUM(price) as total FROM appointment_images";
$totalRevenueResult = $conn->query($totalRevenueQuery);
$totalRevenue = $totalRevenueResult->fetch_assoc()['total'];

// Fetch appointments by month
$appointmentsByMonthQuery = "SELECT MONTH(date) as month, COUNT(*) as count FROM appointments GROUP BY MONTH(date)";
$appointmentsByMonthResult = $conn->query($appointmentsByMonthQuery);
$appointmentsByMonthData = [];
while ($row = $appointmentsByMonthResult->fetch_assoc()) {
    $appointmentsByMonthData[$row['month']] = $row['count'];
}

// Fetch revenue by month
$revenueByMonthQuery = "
    SELECT MONTH(a.date) as month, SUM(ai.price) as total
    FROM appointment_images ai
    JOIN appointments a ON ai.appointment_id = a.appointment_id
    GROUP BY MONTH(a.date)
";
$revenueByMonthResult = $conn->query($revenueByMonthQuery);
$revenueByMonthData = [];
while ($row = $revenueByMonthResult->fetch_assoc()) {
    $revenueByMonthData[$row['month']] = $row['total'];
}
$conn->close();

// Month names array
$monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Mahendi Magic Hub</title>
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
            --shadow-color: rgba(0, 0, 0, 0.1);
        }

        /* Dark Mode */
        body.dark-mode {
            --background-color: #121212;
            --card-background: #1e1e1e;
            --text-color: #e0e0e0;
            --border-color: #444;
            --btn-background: #90a14e;
            --btn-background-hover: #758f47;
            --btn-background-active: #667946;
            --shadow-color: rgba(255, 255, 255, 0.1);
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            font-family: 'Nunito Sans', sans-serif;
            margin: 0;
            padding: 0;
        }

        .admin-header {
            background-color: black;
            color: white;
            padding: 40px;
            text-align: center;
            border-bottom: 4px solid var(--border-color);
        }

        .admin-content {
            background-color: var(--background-color);
            margin-left: 250px;
            padding: 40px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .card {
            background-color: var(--card-background);
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: white;
            margin: 0;
            font-size: 2rem;
        }

        h2 {
            color: var(--text-color);
            margin: 0;
            font-size: 1.5rem;
        }

        .btn {
            padding: 12px 20px;
            background-color: var(--btn-background);
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: var(--btn-background-hover);
        }

        .btn:active {
            background-color: var(--btn-background-active);
        }

        @media (max-width: 768px) {
            .admin-content {
                margin-left: 0;
            }
        }

        .summary {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }

        .summary div {
            background-color: var(--card-background);
            border-radius: 10px;
            padding: 25px;
            flex: 1 1 calc(33.333% - 20px);
            min-width: 280px;
            text-align: center;
            box-shadow: 0 10px 30px var(--shadow-color);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .summary div:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px var(--shadow-color);
        }

        .summary div h2 {
            margin-top: 0;
            font-size: 1.5rem;
        }

        .summary div p {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .summary div:nth-child(1) {
    background-color: #2196f3; /* Light blue */
}

.summary div:nth-child(2) {
    background-color: #e91e63; /* Light pink */
}

.summary div:nth-child(3) {
    background-color:  #9c27b0; /* Light green */
}

        .chart-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
        }

        .chart {
            flex: 1 1 calc(50% - 20px);
            min-width: 500px;
            background: var(--card-background);
            border-radius: 10px;
            padding: 50px;
            box-shadow: 0 10px 30px var(--shadow-color);
            position: relative;
            transition: box-shadow 0.3s;
        }

        .chart:hover {
            box-shadow: 0 12px 35px var(--shadow-color);
        }

        .chart-title {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 1.5rem;
            color: var(--text-color);
            font-weight: 600;
        }
    </style>
</head>
<body class="light-mode">

    <?php include 'sidebar.php'; ?>

    <div class="admin-header">
        <h1>Admin Dashboard - Mahendi Magic Hub</h1>
    </div>

    <div class="admin-content">
        <section class="summary">
            <div>
                <h2>Total Appointments</h2>
                <p><?php echo htmlspecialchars($totalAppointments); ?> appointments</p>
            </div>
            <div>
                <h2>Total Revenue</h2>
                <p>Rs <?php echo htmlspecialchars(number_format($totalRevenue, 2)); ?> in revenue</p>
            </div>
            <div>
                <h2>Total Images</h2>
                <p><?php echo htmlspecialchars($totalImages); ?> images</p>
            </div>
        </section>

        <section class="chart-container">
            <div class="chart">
                <div class="chart-title">Appointments by Month</div>
                <canvas id="appointmentsChart"></canvas>
            </div>
            <div class="chart">
                <div class="chart-title">Revenue by Month</div>
                <canvas id="revenueChart"></canvas>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const themeToggle = document.getElementById('theme-toggle');
            const currentTheme = localStorage.getItem('theme') || 'light-mode';

            document.body.classList.add(currentTheme);

            if (themeToggle) {
                themeToggle.addEventListener('click', () => {
                    const newTheme = document.body.classList.contains('light-mode') ? 'dark-mode' : 'light-mode';
                    document.body.classList.toggle('light-mode');
                    document.body.classList.toggle('dark-mode');
                    localStorage.setItem('theme', newTheme);
                });
            }

            // Appointments by Month Chart
            const appointmentsCtx = document.getElementById('appointmentsChart').getContext('2d');
            const appointmentsChart = new Chart(appointmentsCtx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode(array_map(fn($month) => $monthNames[$month - 1], array_keys($appointmentsByMonthData))); ?>,
                    datasets: [{
                        label: 'Appointments',
                        data: <?php echo json_encode(array_values($appointmentsByMonthData)); ?>,
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        barThickness: 30
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Revenue by Month Chart
            const revenueCtx = document.getElementById('revenueChart').getContext('2d');
            const revenueChart = new Chart(revenueCtx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode(array_map(fn($month) => $monthNames[$month - 1], array_keys($revenueByMonthData))); ?>,
                    datasets: [{
                        label: 'Revenue',
                        data: <?php echo json_encode(array_values($revenueByMonthData)); ?>,
                        backgroundColor: 'rgba(153, 102, 255, 0.6)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 2,
                        fill: true,
                        barThickness: 30
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>

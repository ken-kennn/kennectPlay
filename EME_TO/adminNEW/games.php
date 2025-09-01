<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KennectPlay Dashboard</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- FontAwesome for icons -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex; /* Added for sidebar layout */
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: #333;
            color: #fff;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            transition: transform 0.3s ease;
            z-index: 1000; /* Ensure sidebar is above other content */
        }

        .sidebar-header {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #222;
        }

        .sidebar-header h2 {
            margin: 0;
            font-size: 1.5em;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            color: #fff;
            font-size: 1.5em;
            cursor: pointer;
            display: none; /* Hide by default */
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-nav li {
            padding: 15px 20px;
            border-bottom: 1px solid #444;
        }

        .sidebar-nav li a {
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .sidebar-nav li a i {
            margin-right: 10px;
        }

        /* Top Navigation Bar (Visible on Small Screens) */
        .top-nav {
            display: none; /* Hidden by default */
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            position: fixed;
            margin-bottom: 20em;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 999; /* Ensure top nav is above other content */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .top-nav > h2{
            margin-right: 3em;
        }

        .top-nav .hamburger {
            margin-left: 1em;
            font-size: 1.5em;
            cursor: pointer;
        }

        /* Dashboard Content Styles */
        .dashboard {
            margin-left: 250px; /* Added to accommodate the sidebar */
            margin-top: 80px;
            padding: 20px;
            flex: 1;
            transition: margin-left 0.3s ease; /* Added for smooth sidebar toggle */
        }

        /* Responsive Styles for Sidebar and Top Nav */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .top-nav {
                display: flex; /* Show top nav on small screens */
                justify-content: space-between;
                align-items: center;
            }

            .dashboard {
                margin-left: 0; /* Remove margin when sidebar is hidden */
            }
        }

        /* Existing Styles (No Changes) */
        .top-container {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }

        .metric {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            flex: 1;
            margin: 0 10px;
        }

        .metric h2 {
            margin: 0;
            font-size: 1.5em;
        }

        .metric p {
            font-size: 2em;
            margin: 10px 0 0;
        }

        .table-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f8f8f8;
        }

        .hamburger-close{
                display: none;
            }

        @media (max-width: 768px) {
            .top-container {
                flex-direction: column;
            }

            .metric {
                margin: 10px 0;
            }

            .hamburger-close{
                display: flex;
            }
        }
    </style>
</head>
<body>

    <!-- Top Navigation Bar (Visible on Small Screens) -->
    <div class="top-nav">
        <div class="hamburger" onclick="toggleSidebar()">&#9776;</div>
        <h2>KENNECTPLAY</h2>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>KENNECTPLAY</h2>
            <button class="hamburger-close" onclick="closeSidebar()">&#9776;</button>
        </div>
        <ul class="sidebar-nav">
            <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="games.php"><i class="fas fa-gamepad"></i> Games</a></li>
        </ul>
    </div>

    <!-- Dashboard Content -->
    <div class="dashboard">
        <div class="top-container">

            <div class="metric">
                <h2>Games</h2>
                <p id="game-count">0</p>
            </div>
        </div>

        <div class="table-container">
            <h2>Games</h2>
            <table id="games-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Genre</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Game rows will be inserted here dynamically -->
                </tbody>
            </table>
        </div>

    </div>

    <script>

        document.getElementById('post-count').textContent = posts.length;

        function populateTable(tableId, data, columns) {
            const tableBody = document.querySelector(`#${tableId} tbody`);
            tableBody.innerHTML = '';

            data.forEach(item => {
                const row = document.createElement('tr');
                columns.forEach(column => {
                    const cell = document.createElement('td');
                    cell.textContent = item[column];
                    row.appendChild(cell);
                });
                tableBody.appendChild(row);
            });
        }

        populateTable('users-table', users, ['id', 'name', 'email']);
        populateTable('games-table', games, ['id', 'title', 'genre']);
        populateTable('posts-table', posts, ['id', 'title', 'author']);

        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('active');
        }

        function closeSidebar() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.remove('active'); // Ensures sidebar closes
    }

    // Close sidebar when clicking outside of it
         document.addEventListener("click", function (event) {
            const sidebar = document.querySelector('.sidebar');
            const hamburger = document.querySelector('.hamburger');
            const hamburgerClose = document.querySelector('.hamburger-close');

            if (!sidebar.contains(event.target) && 
                !hamburger.contains(event.target) && 
                !hamburgerClose.contains(event.target)) {
                sidebar.classList.remove('active');
            }
          });
    </script>
</body>
</html>
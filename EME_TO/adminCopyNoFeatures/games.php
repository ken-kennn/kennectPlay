<?php

  include "../admin/admin_connection/adminDB_connection.php";

  $games_query = "SELECT * FROM sombillo_games";
  $games_result = $conn->query($games_query);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KennectPlay Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            display: flex;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .sidebar {
            width: 200px;
            background: #333;
            color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px;
            display: block;
            border-radius: 5px;
        }
        .sidebar a:hover {
            background: #555;
        }
        .main-content {
            flex: 1;
            padding: 20px;
        }
        .navbar {
            background: white;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .table_container {
            width: calc(100% - 220px);
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #333;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        h1 {
            margin-top: 20px;
            font-size: 24px;
            text-align: left;
            color: #333;
        }
       
    </style>
</head>
<body>
    
    <div class="sidebar">
        <h2>kennectPlay Dashboard Games</h2>
        <a href="index.php">Home</a>
        <a href="games.php">Games</a>
    </div>

    <div class="table_container">

        <h1>GAMES TABLE</h1>
        <table>
            <tr>
                <th>Game ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Genre</th>
                <th>Platform</th>
                <th>Release Date</th>
                <th>Rating</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $games_result->fetch_assoc()): ?>
              <tr>
                  <td><?php echo $row['game_id']; ?></td>
                  <td><?php echo $row['title']; ?></td>
                  <td><?php echo $row['description']; ?></td>
                  <td><?php echo $row['genre']; ?></td>
                  <td><?php echo $row['platform']; ?></td>
                  <td><?php echo $row['release_date']; ?></td>
                  <td><?php echo $row['rating']; ?></td>
                  <td>
                    <button class="update-btn" onclick="openModal(<?php echo htmlspecialchars(json_encode($row)); ?>)">Update</button>
                    <button class="delete-btn" onclick="deleteGame(<?php echo $row['game_id']; ?>)">Delete</button>                  
                 </td>
              </tr>
            <?php endwhile; ?>
        </table>

        <button class="add-game-btn" onclick="openAddModal()">Add Game</button>

    </div>
   

    <br>



</body>
</html>

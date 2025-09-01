<?php

  include "../admin/admin_connection/adminDB_connection.php";
  
  $users_query = "SELECT * FROM sombillo_users";
  $users_result = $conn->query($users_query);

  $games_query = "SELECT * FROM sombillo_games";
  $games_result = $conn->query($games_query);

  $posts_query = "SELECT * FROM sombillo_posts";
  $posts_result = $conn->query($posts_query);

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
        <h2>kennectPlay Dashboard</h2>
        <a href="index.php">Home</a>
        <a href="games.php">Games</a>
    </div>

    <div class="table_container">

        <h1>USERS TABLE</h1>
        <table>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
                <th>Bio</th>  
                <th>Created_at</th>
            </tr>

            <?php while ($row = $users_result->fetch_assoc()): ?>
              <tr>
                  <td><?php echo $row['user_id']; ?></td>
                  <td><?php echo $row['username']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><?php echo $row['password']; ?></td>
                  <td><?php echo $row['bio']; ?></td>
                  <td><?php echo $row['created_at']; ?></td>
              </tr>
            <?php endwhile; ?>
            
        </table>

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
              </tr>
            <?php endwhile; ?>
        </table>

        <h1>POSTS TABLE</h1>
        <table>
            <tr>
                <th>Post ID</th>
                <th>User ID</th>
                <th>Game ID</th>
                <th>Content</th>
                <th>Created_At</th>
            </tr>
            <?php while ($row = $posts_result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['post_id']; ?></td>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo $row['game_id']; ?></td>
                <td><?php echo $row['content']; ?></td>
                <td><?php echo $row['created_at']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        
    </div>
    <br>
</body>
</html>

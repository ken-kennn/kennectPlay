<?php

  include "../admin/admin_connection/adminDB_connection.php";

  $games_query = "SELECT * FROM sombillo_games";
  $games_result = $conn->query($games_query);



    if (isset($_POST['add_game'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $genre = $_POST['genre'];
        $platform = $_POST['platform'];
        $release_date = $_POST['release_date'];
        $rating = $_POST['rating'];

        $add_query = "INSERT INTO sombillo_games (title, description, genre, platform, release_date, rating) 
                    VALUES ('$title', '$description', '$genre', '$platform', '$release_date', '$rating')";

        if ($conn->query($add_query) === TRUE) {
            echo "<script>alert('Game added successfully!'); window.location.href='games.php';</script>";
        } else {
            echo "Error adding record: " . $conn->error;
        }
    }

    if (isset($_POST['delete_game'])) {
        $game_id = $_POST['game_id'];
        $delete_query = "DELETE FROM sombillo_games WHERE game_id=?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param("i", $game_id);
        
        if ($stmt->execute()) {
            echo "Game deleted successfully!";
        } else {
            echo "Error deleting game: " . $conn->error;
        }
    }

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
        .add-game-btn, .update-btn, .delete-btn {
        display: inline-block;
        padding: 5px 10px;
        margin: 5px;
        text-decoration: none;
        color: white;
        border-radius: 5px;
        }
        .add-game-btn {
            background-color: green;
        }
        .update-btn {
            background-color: blue;
        }
        .delete-btn {
            background-color: red;
        }
        .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0,0.4);
        padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 40%;
            border-radius: 5px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
        padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 40%;
            border-radius: 5px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    
    <div class="sidebar">
        <h2>kennectPlay</h2>
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
                    <button class="update-btn" onclick="openUpdateModal()">Update</button>
                    <button class="delete-btn" onclick="deleteGame(<?php echo $row['game_id']; ?>)">Delete</button>                  
                 </td>
              </tr>
            <?php endwhile; ?>
        </table>

        <button class="add-game-btn" onclick="openAddModal()">Add Game</button>

    </div>

    <div id="updateModal" class="modal">
        <div class="modal-content">
       
            <span class="close" onclick="closeUpdateModal()">&times;</span>
            <h2>Update Game</h2>
        
                <form id="updateForm" method="POST">
                
                    <input type="text" name="game_id"  id="game_id">
                    <label>Title:</label>
                    <input type="text" name="title" id="title" >

                    <label>Description:</label>
                    <textarea name="description" id="description" ></textarea>

                    <label>Genre:</label>
                    <input type="text" name="genre" id="genre" >

                    <label>Platform:</label>
                    <input type="text" name="platform" id="platform" >

                    <label>Release Date:</label>
                    <input type="date" name="release_date" id="release_date" >

                    <label>Rating:</label>
                    <input type="number" name="rating" id="rating" step="0.1" >

                    <button type="submit" name="update_game">Update</button>
                    
                </form>
             
                
        </div>

        
    </div>


    <script>
        function openModal(game) {
            document.getElementById('game_id').value = game.game_id;
            document.getElementById('title').value = game.title;
            document.getElementById('description').value = game.description;
            document.getElementById('genre').value = game.genre;
            document.getElementById('platform').value = game.platform;
            document.getElementById('release_date').value = game.release_date;
            document.getElementById('rating').value = game.rating;
            document.getElementById('updateModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('updateModal').style.display = 'none';
        }

     
    </script>

    <div id="addGameModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeAddModal()">&times;</span>
            <h2>Add New Game</h2>
            <form method="POST">
                <label>Title:</label>
                <input type="text" name="title" required>

                <label>Description:</label>
                <textarea name="description" required></textarea>

                <label>Genre:</label>
                <input type="text" name="genre" required>

                <label>Platform:</label>
                <input type="text" name="platform" required>

                <label>Release Date:</label>
                <input type="date" name="release_date" required>

                <label>Rating:</label>
                <input type="number" name="rating" step="0.1" required>

                <button type="submit" name="add_game">Add Game</button>
            </form>
        </div>
    </div>

    <script>

        function openAddModal() {
            document.getElementById('addGameModal').style.display = 'block';
        }
        
        function closeAddModal() {
            document.getElementById('addGameModal').style.display = 'none';
        }

        function openUpdateModal() {
            document.getElementById('updateModal').style.display = 'block';
        }
        
        function closeUpdateModal() {
            document.getElementById('updateModal').style.display = 'none';
        }

        function UpdateGame(){
            if (confirm('Are you sure you want to delete this game?')) {
                    var formData = new FormData();
                    formData.append('update_game', true);
                    formData.append('game_id', gameId);

                    fetch('games.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        alert(data);
                        location.reload();
                    })
                    .catch(error => console.error('Error:', error));
                }
        }

        function deleteGame(gameId) {
                if (confirm('Are you sure you want to delete this game?')) {
                    var formData = new FormData();
                    formData.append('delete_game', true);
                    formData.append('game_id', gameId);

                    fetch('games.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        alert(data);
                        location.reload();
                    })
                    .catch(error => console.error('Error:', error));
                }
        }
    </script>


   

    <br>



</body>
</html>

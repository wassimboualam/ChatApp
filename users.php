<?php 
    session_start();
    require_once "php/config.php";
    if (!isset($_SESSION["unique_id"])) {
       header("location: ./login.php");
    }
?>

<?php
    include_once "header.php";
    ?>
<body>
    <main class="wrapper">
        <section class="users">
            <header>
                <?php                
                $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                if(mysqli_num_rows($sql) > 0){
                $row = mysqli_fetch_assoc($sql);
                }
                ?>
                
                <div class="content">
                    <img src="php/images/<?= $row["img"]?>" alt="pfp">
                    <div class="details">
                        <span><?= $row["fname"]." ".$row["lname"] ?></span>
                        <p><?= $row["status"] ?></p>
                    </div>
                </div>
                <a href="php/logout.php?logout_id=<?= $row["unique_id"]?>" class="logout">Logout</a>
            </header>

            <div class="search">
                <span class="text">Select a user to start chat</span>
                <input type="text" placeholder="Enter name to search...">
                <button>
                    <i class="fas fa-search"></i>
                </button>
            </div>
            
            <div class="users-list">
                
                
            </div>
        </section>
    </main>
    <script src="javascript/user.js"></script>
    <script src="javascript/users.js"></script>
</body>
</html>
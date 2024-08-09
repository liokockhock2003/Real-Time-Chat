<?PHP 
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location: login.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Users Page</title>
</head>
<body>

    <?php
        require_once "php/config.php";
        $query = "SELECT * FROM users WHERE unique_id= ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $_SESSION['unique_id']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) > 0){
            $rows = mysqli_fetch_assoc($result);
        }
    ?>

    <div class="wrapper">
        <section class="users">
            <header>
                <div class="content">
                <img src="images/<?php echo $rows['img']?>" alt="">
                <div class="details">
                    <span><?php echo $rows['fname'] ." ". $rows['lname']?></span>
                    <p><?php echo $rows['status']?></p>
                </div>
            </div>
            <a class = "logout" href="php/logout.php?logout_id=<?php echo $rows['unique_id']?>">Logout</a>
            </header>

            <div class="search">
                <span class="text">
                    Select an user to start chat
                </span>
                <input type="text" placeholder="Enter name to search...">
                <button><i class="fa fa-search"></i></button>
            </div>

            <div class="users-list">  
                
            </div>
        </section>
    </div>

    <script src = "javascript/users.js"></script>
</body>
</html>
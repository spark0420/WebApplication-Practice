<!-- To make this page daynamic -->
<?php 
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location: login.php");
    }
?>

<?php include_once "header.php"; ?>
<body>
    <div class="wrapper">
        <section class="users">
            <header>
            <?php 
                include_once "php/config.php";
                $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                if(mysqli_num_rows($sql) > 0){
                    $row = mysqli_fetch_assoc($sql);
                }
            ?>    
                <div class="content">
                <img src="php/userimages/<?php echo $row['img'] ?>" alt="">
                <div class="details">
                    <!-- making users name area and status dynamic -->
                    <span><?php echo $row['fname'] . " " . $row['lname'] ?></span>
                    <p><?php echo $row['status'] ?></p>
                </div>
                </div>
                <a href="php/logout.php?logout_id=<?php echo $row['unique_id']?>" class="logout">Logout</a>
            </header>
            <div class="search">
                <span class="text">Select an user to start chat</span>
                <input type="text" placeholder="Enter name to search..">
                <button><i class = "fas fa-search"></i></button>
            </div>
            <div id = "users-list" class="users-list">
                <!-- For later reference -->
                <!-- <a href="#">
                    <div class="content">
                        <img src="images/profile1.jpg" alt="">
                        <div class="details">
                            <span>Sunyoung Park</span>
                            <p>Test message</p>
                        </div>
                    </div>
                    <div class="status-dot"><i class="fa fa-circle" aria-hidden="true"></i></div>
                </a> -->

                <!-- //For later reference -->
                <!-- <a href="#">
                    <div class="content">
                        <img src="images/profile1.jpg" alt="">
                        <div class="details">
                            <span>Sunyoung Park</span>
                            <p>Test message</p>
                        </div>
                    </div>
                    <div class="status-dot"><i class="fa fa-circle" aria-hidden="true"></i></div>
                </a>
                <a href="#">
                    <div class="content">
                        <img src="images/profile1.jpg" alt="">
                        <div class="details">
                            <span>Sunyoung Park</span>
                            <p>Test message</p>
                        </div>
                    </div>
                    <div class="status-dot"><i class="fa fa-circle" aria-hidden="true"></i></div>
                </a>
                <a href="#">
                    <div class="content">
                        <img src="images/profile1.jpg" alt="">
                        <div class="details">
                            <span>Sunyoung Park</span>
                            <p>Test message</p>
                        </div>
                    </div>
                    <div class="status-dot"><i class="fa fa-circle" aria-hidden="true"></i></div>
                </a>
                <a href="#">
                    <div class="content">
                        <img src="images/profile1.jpg" alt="">
                        <div class="details">
                            <span>Sunyoung Park</span>
                            <p>Test message</p>
                        </div>
                    </div>
                    <div class="status-dot"><i class="fa fa-circle" aria-hidden="true"></i></div>
                </a>
                <a href="#">
                    <div class="content">
                        <img src="images/profile1.jpg" alt="">
                        <div class="details">
                            <span>Sunyoung Park</span>
                            <p>Test message</p>
                        </div>
                    </div>
                    <div class="status-dot"><i class="fa fa-circle" aria-hidden="true"></i></div>
                </a> -->

            </div>
        </section>
    </div>

    <script src = "javascript/users.js"></script>
</body>
</html>
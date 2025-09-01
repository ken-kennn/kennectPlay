
<?php

  session_start();

  include 'db_connection.php';

  $sql = "SELECT * FROM sombillo_games";
  $result = $conn->query($sql);

  if(isset($_POST['register_user'])){
       
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

    $sql_save_user = mysqli_query($conn,"INSERT INTO sombillo_users (`username`,`email`,`password`) values('$username','$email', '$hashed_pass' ) ");

    if ($sql_save_user) {
      header("Location: index.php?success=Registration Successful!");
      exit();
    } else {
        header("Location: index.php?error=Registration Failed. Please try again.");
        exit();
    }


  }

  // function validate($data) {
  //     $data = trim($data);
  //     $data = stripslashes($data);
  //     $data = htmlspecialchars($data);
  //     return $data;
  // }

  if(isset($_POST['username']) && isset($_POST['password'])) {

      $username = mysqli_real_escape_string($conn, $_POST['username']);
      
      $password = mysqli_real_escape_string($conn,$_POST['password']);
      
      if(empty($username)){
          header("Location: index.php?error=USERNAME IS REQUIRED");
          exit();
      }
      else if(empty($password)){
          header("Location: index.php?error=PASSWORD IS REQUIRED");
          exit();
      }

      $sql_query = "SELECT username, password, user_id FROM sombillo_users WHERE username='$username'";
      
      $result = mysqli_query($conn, $sql_query);
      
      if(mysqli_num_rows($result) === 1){
          $row = mysqli_fetch_assoc($result);
          
          if(password_verify($password, $row['password'])){
              echo "Logged in";
              $_SESSION['username'] = $row['username']; 
              $_SESSION['password'] = $row['password']; 
              $_SESSION['user_id'] = $row['user_id']; 
              header("Location: admin/index.php");
              exit();
          }
          else{
              header("Location: index.php?error=USERNAME OR PASSWORD IS INCORRECT");
              exit();
          }
      }
      else{
          header("Location: index.php?error=USERNAME OR PASSWORD IS INCORRECT");
          exit();
      }
  }

  


?>


<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="icon" href="images/fevicon.png" type="image/gif" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>kennectPlay!!</title>


  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet" />

  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet" />
  <link href="css/responsive.css" rel="stylesheet" />

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>

         .logged_in{
          display: none;
         }
   
        .modal {
            display: none; 
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            width: 350px;
            background-color: rgba(31, 41, 55, 1);
            padding: 2rem;
            border-radius: 0.75rem;
            color: rgba(243, 244, 246, 1);
            position: relative;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 1.5rem;
            cursor: pointer;
            color: rgba(243, 244, 246, 0.8);
        }

        .close:hover {
            color: rgba(243, 244, 246, 1);
        }

        /* Button to Open Modal */
        .open-modal {
            background-color: rgba(167, 139, 250, 1);
            color: rgba(17, 24, 39, 1);
            border: none;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .open-modal:hover {
            background-color: rgba(139, 92, 246, 1);
        }

    .form-container {
            width: 320px;
            border-radius: 0.75rem;
            background-color: rgba(17, 24, 39, 1);
            padding: 2rem;
            color: rgba(243, 244, 246, 1);
            }

            .title {
            text-align: center;
            font-size: 1.5rem;
            line-height: 2rem;
            font-weight: 700;
            }

            .form {
            margin-top: 1.5rem;
            }

            .input-group {
            margin-top: 0.25rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
            }

            .input-group label {
            display: block;
            color: rgba(156, 163, 175, 1);
            margin-bottom: 4px;
            }

            .input-group input {
            width: 100%;
            border-radius: 0.375rem;
            border: 1px solid rgba(55, 65, 81, 1);
            outline: 0;
            background-color: rgba(17, 24, 39, 1);
            padding: 0.75rem 1rem;
            color: rgba(243, 244, 246, 1);
            }

            .input-group input:focus {
            border-color: rgba(167, 139, 250);
            }

            .forgot {
            display: flex;
            justify-content: flex-end;
            font-size: 0.75rem;
            line-height: 1rem;
            color: rgba(156, 163, 175,1);
            margin: 8px 0 14px 0;
            }

            .forgot a,.signup a {
            color: rgba(243, 244, 246, 1);
            text-decoration: none;
            font-size: 14px;
            }

            .forgot a:hover, .signup a:hover {
            text-decoration: underline rgba(167, 139, 250, 1);
            }

            .sign {
            display: block;
            width: 100%;
            background-color: rgba(167, 139, 250, 1);
            padding: 0.75rem;
            text-align: center;
            color: rgba(17, 24, 39, 1);
            border: none;
            border-radius: 0.375rem;
            font-weight: 600;
            }

            .social-message {
            display: flex;
            align-items: center;
            padding-top: 1rem;
            }

            .line {
            height: 1px;
            flex: 1 1 0%;
            background-color: rgba(55, 65, 81, 1);
            }

            .social-message .message {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
            color: rgba(156, 163, 175, 1);
            }

            .social-icons {
            display: flex;
            justify-content: center;
            }

            .social-icons .icon {
            border-radius: 0.125rem;
            padding: 0.75rem;
            border: none;
            background-color: transparent;
            margin-left: 8px;
            }

            .social-icons .icon svg {
            height: 1.25rem;
            width: 1.25rem;
            fill: #fff;
            }

            .signup {
            text-align: center;
            font-size: 0.75rem;
            line-height: 1rem;
            color: rgba(156, 163, 175, 1);
            }

  </style>

</head>

<body>

  
    <?php if(isset($_GET['error'])): ?>
        <script>
            window.onload = function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: "<?php echo $_GET['error']; ?>",
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Try Again'
                });
            };
        </script>
    <?php endif; ?>


    <?php if(isset($_GET['success'])): ?>
      <script>
          window.onload = function() {
              Swal.fire({
                  icon: 'success',
                  title: 'Success!',
                  text: "<?php echo $_GET['success']; ?>",
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'OK'
              });
          };
      </script>
    <?php endif; ?>


  <div class="hero_area">
    <header class="header_section long_section px-0">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="index.php">
          <span style="color: #ffffff;">
            kennectPlay!!
          </span>
        </a>
        <button style="color: #ffffff;" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span  class=""> </span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <div class="d-flex mx-auto flex-column flex-lg-row align-items-center">
            <ul class="navbar-nav  ">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.html"> About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="games.html">Games</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="community.html">Community</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact Us</a>
              </li>
            </ul>
          </div>

          <div class="quote_btn-container">

            <a href="" id="loginBtn">
              <span style="color: #ffffff;">Login</span>
              <!-- <a href="login.php"><span style="color: #ffffff;">Login DI MODAL</span></a> -->
              <i class="fa fa-user" aria-hidden="true" style="color: #ffffff;"></i>
            </a>

            <div class="logged_in">
              <a href="">LOGGED IN</a>
            </div>

            <form class="form-inline">
              <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit" style="color: #ffffff;">
                <i class="fa fa-search" aria-hidden="true"></i>
              </button>
            </form>

          </div>
          
        </div>
      </nav>

        <div style="display: none;" id="loginModal" class="modal" >
          <div class="modal-content"  >
            <span class="close">&times;</span>
            <div class="form-container" style="margin-right: 10px; " >
                
                <form class="form" onsubmit="return isvalid()" method="POST" style="padding-right: 5px;">
                <p class="title">Login</p>

                    <div class="input-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" placeholder="">
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="">
                        <div class="forgot">
                            <a rel="noopener noreferrer" href="#">Forgot Password ?</a>
                        </div>
                    </div>
                    <!-- <button class="sign">Log in</button> -->
                    <input type="submit" name="login_user" id="login" class="sign" value="Login"> <br>
                </form>
                <!-- <div class="social-message">
                    <div class="line"></div>
                    <p class="message">Login with social accounts</p>
                    <div class="line"></div>
                </div>
                <div class="social-icons">
                    <button aria-label="Log in with Google" class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="w-5 h-5 fill-current">
                            <path d="M16.318 13.714v5.484h9.078c-0.37 2.354-2.745 6.901-9.078 6.901-5.458 0-9.917-4.521-9.917-10.099s4.458-10.099 9.917-10.099c3.109 0 5.193 1.318 6.38 2.464l4.339-4.182c-2.786-2.599-6.396-4.182-10.719-4.182-8.844 0-16 7.151-16 16s7.156 16 16 16c9.234 0 15.365-6.49 15.365-15.635 0-1.052-0.115-1.854-0.255-2.651z"></path>
                        </svg>
                    </button>
                    <button aria-label="Log in with Twitter" class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="w-5 h-5 fill-current">
                            <path d="M31.937 6.093c-1.177 0.516-2.437 0.871-3.765 1.032 1.355-0.813 2.391-2.099 2.885-3.631-1.271 0.74-2.677 1.276-4.172 1.579-1.192-1.276-2.896-2.079-4.787-2.079-3.625 0-6.563 2.937-6.563 6.557 0 0.521 0.063 1.021 0.172 1.495-5.453-0.255-10.287-2.875-13.52-6.833-0.568 0.964-0.891 2.084-0.891 3.303 0 2.281 1.161 4.281 2.916 5.457-1.073-0.031-2.083-0.328-2.968-0.817v0.079c0 3.181 2.26 5.833 5.26 6.437-0.547 0.145-1.131 0.229-1.724 0.229-0.421 0-0.823-0.041-1.224-0.115 0.844 2.604 3.26 4.5 6.14 4.557-2.239 1.755-5.077 2.801-8.135 2.801-0.521 0-1.041-0.025-1.563-0.088 2.917 1.86 6.36 2.948 10.079 2.948 12.067 0 18.661-9.995 18.661-18.651 0-0.276 0-0.557-0.021-0.839 1.287-0.917 2.401-2.079 3.281-3.396z"></path>
                        </svg>
                    </button>
                    <button aria-label="Log in with GitHub" class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="w-5 h-5 fill-current">
                            <path d="M16 0.396c-8.839 0-16 7.167-16 16 0 7.073 4.584 13.068 10.937 15.183 0.803 0.151 1.093-0.344 1.093-0.772 0-0.38-0.009-1.385-0.015-2.719-4.453 0.964-5.391-2.151-5.391-2.151-0.729-1.844-1.781-2.339-1.781-2.339-1.448-0.989 0.115-0.968 0.115-0.968 1.604 0.109 2.448 1.645 2.448 1.645 1.427 2.448 3.744 1.74 4.661 1.328 0.14-1.031 0.557-1.74 1.011-2.135-3.552-0.401-7.287-1.776-7.287-7.907 0-1.751 0.62-3.177 1.645-4.297-0.177-0.401-0.719-2.031 0.141-4.235 0 0 1.339-0.427 4.4 1.641 1.281-0.355 2.641-0.532 4-0.541 1.36 0.009 2.719 0.187 4 0.541 3.043-2.068 4.381-1.641 4.381-1.641 0.859 2.204 0.317 3.833 0.161 4.235 1.015 1.12 1.635 2.547 1.635 4.297 0 6.145-3.74 7.5-7.296 7.891 0.556 0.479 1.077 1.464 1.077 2.959 0 2.14-0.020 3.864-0.020 4.385 0 0.416 0.28 0.916 1.104 0.755 6.4-2.093 10.979-8.093 10.979-15.156 0-8.833-7.161-16-16-16z"></path>
                        </svg>
                    </button>
                </div> -->
                <p class="signup">Don't have an account?
                    <!-- <a rel="noopener noreferrer" href="#" class="">Sign up</a> -->
                    <a href="" id="registerBtn">
                      <span style="color: #ffffff;">Sign up</span>
                      <!-- <a href="login.php"><span style="color: #ffffff;">Login</span></a> -->
                      <i class="fa fa-user" aria-hidden="true" style="color: #ffffff;"></i>
                    </a>
                </p>
              </div>
          </div>
        </div>

        <div style="display: none;" id="registerModal" class="modal">
          <div class="modal-content">
              <span class="close">&times;</span>
              <div class="form-container" style="padding-right: 5px;">
                  <p class="title">Register</p>

                  <form class="form" method="POST" enctype="multipart/form-data" style="padding-right: 20px;" >
                      <div class="input-group">
                          <label for="username">Username</label>
                          <input type="text" name="username" id="username" placeholder="" required>
                      </div>
                      <div class="input-group">
                          <label for="email">Email</label>
                          <input type="email" name="email" id="email" placeholder="" >
                      </div>  
                      <div class="input-group" style="margin-bottom: 20px;" >
                          <label for="password">Password</label>
                          <input type="password" name="password" id="password" placeholder="" required>
                      </div>
                      <!-- <button class="sign">Sign up</button> -->
                      <input type="submit" name="register_user" class="sign" value="Sign Up"> <br>
                  </form>

                  <p class="signup">Already have an account?
                    <a href="" id="loginBtn">
                      <span style="color: #ffffff;">Login</span>
                      <!-- <a href="login.php"><span style="color: #ffffff;">Login</span></a> -->
                      <i class="fa fa-user" aria-hidden="true" style="color: #ffffff;"></i>
                    </a>
                  </p>
                 
              </div>
          </div>
        </div>


        <script>
          document.addEventListener("DOMContentLoaded", function () {
            // Get modal and button elements
            var loginModal = document.getElementById("loginModal");
            var registerModal = document.getElementById("registerModal");
            var loginBtn = document.getElementById("loginBtn");
            var registerBtn = document.getElementById("registerBtn");
            var closeBtns = document.querySelectorAll(".close");

            // Open Login Modal
            loginBtn.addEventListener("click", function (event) {
                event.preventDefault();
                loginModal.style.display = "flex";
            });

            // Open Register Modal
            registerBtn.addEventListener("click", function (event) {
                event.preventDefault();
                registerModal.style.display = "flex";
            });

            // Close Modals when clicking close button
            closeBtns.forEach(function (closeBtn) {
                closeBtn.addEventListener("click", function () {
                    this.closest(".modal").style.display = "none"; // Close only the modal containing the clicked close button
                });
            });

            // Close modals when clicking outside the modal content
            window.addEventListener("click", function (event) {
                if (event.target === loginModal) {
                    loginModal.style.display = "none";
                }
                if (event.target === registerModal) {
                    registerModal.style.display = "none";
                }
            });
        });

        </script>
   

    </header>
    <!-- end header section -->
    <!-- slider section -->
    <section class="slider_section long_section">
      <div id="customCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container ">
              <div class="row">
                <div class="col-md-5">
                  <div class="detail-box">
                    <h1 style="color: #ffffff;">
                      Start <br>
                      Showcasing
                    </h1>
                    <p style="color: #ffffff;">
                      Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus quidem maiores perspiciatis, illo maxime voluptatem a itaque suscipit.
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn1">
                        Contact Us
                      </a>
                      <a href="" class="btn2">
                        About Us
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="img-box">
                    <img src="images/kennectPlay.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container ">
              <div class="row">
                <div class="col-md-5">
                  <div class="detail-box">
                    <h1 style="color: #ffffff;">
                      Start <br>
                      Showcasing
                    </h1>
                    <p style="color: #ffffff;">
                      Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus quidem maiores perspiciatis, illo maxime voluptatem a itaque suscipit.
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn1">
                        Contact Us
                      </a>
                      <a href="" class="btn2">
                        About Us
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="img-box">
                    <img src="images/kennectPlay.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container ">
              <div class="row">
                <div class="col-md-5">
                  <div class="detail-box">
                    <h1 style="color: #ffffff;">
                      Start <br>
                      Showcasing
                    </h1>
                    <p style="color: #ffffff;">
                      Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus quidem maiores perspiciatis, illo maxime voluptatem a itaque suscipit.
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn1">
                        Contact Us
                      </a>
                      <a href="" class="btn2">
                        About Us
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="img-box">
                    <img src="images/kennectPlay.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <ol class="carousel-indicators">
          <li data-target="#customCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#customCarousel" data-slide-to="1"></li>
          <li data-target="#customCarousel" data-slide-to="2"></li>
        </ol>
      </div>
    </section>
    <!-- end slider section -->
  </div>

  <!-- GAMES section -->

  <section class="furniture_section layout_padding">
    <div class="container">

      <div class="heading_container">
        <h2>
          Games
        </h2>
        <p>
          which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't an
        </p>
      </div>
    
      <div class="container">
        <div class="row">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="box" style="background-color:rgb(1, 1, 1); border: 1px solid white;">

                        <div class="img-box" style="background-color: green;">
                            <img src="<?= $row['image_url'] ?>" alt="<?= $row['title'] ?>" style="width:100%;">
                        </div>

                        <div class="detail-box">

                            <h5><?= $row['title'] ?></h5>
                            <p><?= $row['description'] ?></p>
                            <p><strong>Genre:</strong> <?= $row['genre'] ?></p>
                            <p><strong>Platform:</strong> <?= $row['platform'] ?></p>
                            <p><strong>Release Date:</strong> <?= $row['release_date'] ?></p>

                            <div class="rating_box">
                                <h6 class="rating_heading">
                                    Rating: <?= $row['rating'] ?>/5
                                </h6>

                            </div>
                            <a href="game_details.php?id=<?= $row['game_id'] ?>">View Details</a>
                        </div>

                    </div>
                </div>
            <?php endwhile; ?>
        </div>
      </div>



      </div>
    </div>
  </section>

  <!-- end furniture section -->


  <!-- about section -->

  <section class="about_section layout_padding long_section" style="background-color: #000000;">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="img-box">
            <img src="images/controller.png" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                About Us
              </h2>
            </div>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti dolorem eum consequuntur ipsam repellat dolor soluta aliquid laborum, eius odit consectetur vel quasi in quidem, eveniet ab est corporis tempore.
            </p>
            <a href="">
              Read More
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->

  <!-- blog section -->

  <!-- <section class="blog_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Latest Blog
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-4 mx-auto">
          <div class="box">
            <div class="img-box">
              <img src="images/b1.jpg" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Look even slightly believable. If you are
              </h5>
              <p>
                alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
              </p>
              <a href="">
                Read More
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 mx-auto">
          <div class="box">
            <div class="img-box">
              <img src="images/b2.jpg" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Anything embarrassing hidden in the middle
              </h5>
              <p>
                alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
              </p>
              <a href="">
                Read More
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 mx-auto">
          <div class="box">
            <div class="img-box">
              <img src="images/b3.jpg" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Molestias magni natus dolores odio commodi. Quaerat!
              </h5>
              <p>
                alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
              </p>
              <a href="">
                Read More
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->

  <!-- end blog section -->

  <!-- client section -->

  <section class="client_section layout_padding-bottom">
    <div class="container">
      <div class="heading_container">
        <h2>
          Testimonial
        </h2>
      </div>
      <div id="carouselExample2Controls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="row">
              <div class="col-md-11 col-lg-10 mx-auto">
                <div class="box">
                  <div class="img-box">
                    <img src="images/client.jpg" alt="" />
                  </div>
                  <div class="detail-box">
                    <div class="name">
                      <i class="fa fa-quote-left" aria-hidden="true"></i>
                      <h6>
                        Siaalya
                      </h6>
                    </div>
                    <p>
                      It is a long established fact that a reader will be
                      distracted by the readable cIt is a long established fact
                      that a reader will be distracted by the readable c
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="row">
              <div class="col-md-11 col-lg-10 mx-auto">
                <div class="box">
                  <div class="img-box">
                    <img src="images/client.jpg" alt="" />
                  </div>
                  <div class="detail-box">
                    <div class="name">
                      <i class="fa fa-quote-left" aria-hidden="true"></i>
                      <h6>
                        Siaalya
                      </h6>
                    </div>
                    <p>
                      It is a long established fact that a reader will be
                      distracted by the readable cIt is a long established fact
                      that a reader will be distracted by the readable c
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="row">
              <div class="col-md-11 col-lg-10 mx-auto">
                <div class="box">
                  <div class="img-box">
                    <img src="images/client.jpg" alt="" />
                  </div>
                  <div class="detail-box">
                    <div class="name">
                      <i class="fa fa-quote-left" aria-hidden="true"></i>
                      <h6>
                        Siaalya
                      </h6>
                    </div>
                    <p>
                      It is a long established fact that a reader will be
                      distracted by the readable cIt is a long established fact
                      that a reader will be distracted by the readable c
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel_btn-container">
          <a class="carousel-control-prev" href="#carouselExample2Controls" role="button" data-slide="prev">
            <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExample2Controls" role="button" data-slide="next">
            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- end client section -->

  <!-- contact section -->
  <section class="contact_section  long_section" style="background-color: #000000"; >
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <div class="heading_container">
              <h2>
                Contact Us
              </h2>
            </div>
            <form action="">
              <div>
                <input type="text" placeholder="Your Name" />
              </div>
              <div>
                <input type="text" placeholder="Phone Number" />
              </div>
              <div>
                <input type="email" placeholder="Email" />
              </div>
              <div>
                <input type="text" class="message-box" placeholder="Message" />
              </div>
              <div class="btn_box">
                <button>
                  SEND
                </button>
              </div>
            </form>
          </div>
        </div>
        <!-- <div class="col-md-6">
          <div class="map_container">
            <div class="map">
              <div id="googleMap"></div>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </section>
  <!-- end contact section -->

  <!-- info section -->
  <section class="info_section long_section" >

    <div class="container">
      <div class="contact_nav">
        <a href="">
          <i class="fa fa-phone" aria-hidden="true"></i>
          <span>
            Call : +01 123455678990
          </span>
        </a>
        <a href="">
          <i class="fa fa-envelope" aria-hidden="true"></i>
          <span>
            Email : kennectPlay@gmail.com
          </span>
        </a>
        <a href="">
          <i class="fa fa-map-marker" aria-hidden="true"></i>
          <span>
            Location
          </span>
        </a>
      </div>

      <div class="info_top ">
        <div class="row ">
          <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="info_links">
              <h4>
                QUICK LINKS
              </h4>
              <div class="info_links_menu">
                <a class="" href="index.php">Home <span class="sr-only">(current)</span></a>
                <a class="" href="about.html"> About</a>
                <a class="" href="games.html">Games</a>
                <a class="" href="blog.html">Community</a>
                <a class="" href="contact.html">Contact Us</a>
              </div>
            </div>
          </div>
          <!-- <div class="col-sm-6 col-md-4 col-lg-3 mx-auto">
            <div class="info_post">
              <h5>
                INSTAGRAM FEEDS
              </h5>
              <div class="post_box">
                <div class="img-box">
                  <img src="images/f1.png" alt="">
                </div>
                <div class="img-box">
                  <img src="images/f2.png" alt="">
                </div>
                <div class="img-box">
                  <img src="images/f3.png" alt="">
                </div>
                <div class="img-box">
                  <img src="images/f4.png" alt="">
                </div>
                <div class="img-box">
                  <img src="images/f5.png" alt="">
                </div>
                <div class="img-box">
                  <img src="images/f6.png" alt="">
                </div>
              </div>
            </div>
          </div> -->
          <div class="col-md-4">
            <div class="info_form">
              <h4>
                SIGN UP TO KENNECTPLAY
              </h4>
              <form action="">
                <input type="text" placeholder="Enter Your Email" />
                <button type="submit">
                  Subscribe
                </button>
              </form>
              <div class="social_box">
                <a href="">
                  <i class="fa fa-facebook" aria-hidden="true"></i>
                </a>
                <a href="">
                  <i class="fa fa-twitter" aria-hidden="true"></i>
                </a>
                <a href="">
                  <i class="fa fa-linkedin" aria-hidden="true"></i>
                </a>
                <a href="">
                  <i class="fa fa-instagram" aria-hidden="true"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end info_section -->


  <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <p>
        &copy; <span id="displayYear"></span> All Rights Reserved By
        <a href="https://html.design/">. . . </a>
      </p>
    </div>
  </footer>
  <!-- footer section -->


  <!-- jQery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
  <!-- End Google Map -->




</body>

</html>
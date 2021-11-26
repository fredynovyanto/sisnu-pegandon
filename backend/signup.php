<?php 
    session_start();
    require_once('../includes/db.php');

    if (isset($_SESSION['login']) && isset($_COOKIE['_uid_']) && isset($_COOKIE['_uiid_'])) {
        header("Location: ../index.php"); 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>SIGN UP || Admin Panel</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <script data-search-pseudo-elements defer src="js/all.min.js"></script>
    <script src="js/feather.min.js"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <?php
                if (isset($_POST['submit'])) {
                    $first_name = trim($_POST['first-name']);
                    $last_name = trim($_POST['last-name']);
                    $full_name = $first_name . " " . $last_name;
                    $nick_name = trim($_POST['nick-name']);
                    //cek nickname yang sama
                    $sqlNickname = "SELECT * FROM users WHERE user_nickname = :nickname";
                    $stmtNickname = $pdo->prepare($sqlNickname);
                    $stmtNickname->execute([
                        ':nickname' => $nick_name
                    ]);
                    $countNickname = $stmtNickname->rowCount();
                    if ($countNickname != 0) {
                        $error_nickname_exist = "Nickname already exist!";
                    }

                    $email = trim($_POST['email']);
                    //cek email yang sama
                    $sqlEmail = "SELECT * FROM users WHERE user_email = :email";
                    $stmtEmail = $pdo->prepare($sqlEmail);
                    $stmtEmail->execute([
                        ':email' => $email
                    ]);
                    $countEmail = $stmtEmail->rowCount();
                    if ($countEmail != 0) {
                        $error_email_exist = "Email already exist!";
                    }

                    $password = trim($_POST['password']);
                    $confirm_password = trim($_POST['confirm-password']);
                    if ($password != $confirm_password) {
                        $error = "Password doesn't match";
                    } else {
                        $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
                        $sql = "INSERT INTO users (user_name, user_nickname, user_email, user_password, user_photo, registered_on) 
                                VALUES (:name, :nickname, :email, :password, :photo, :date)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([
                            ':name' => $full_name,
                            ':nickname' => $nick_name,
                            ':email' => $email,
                            ':password' => $hash,
                            ':photo' => 'user.jpg',
                            ':date' => date('M n, y')
                        ]);
                        $success = true;
                    }
                }
                ?>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header justify-content-center">
                                    <h3 class="font-weight-light my-4">Create Account</h3>
                                </div>
                                <div class="card-body">
                                    <form action="signup.php" method="POST">
                                        <?php
                                        if (isset($error_nickname_exist)) {
                                            echo "<p class='alert alert-danger'>{$error_nickname_exist}</p>";
                                        }
                                        if (isset($error_email_exist)) {
                                            echo "<p class='alert alert-danger'>{$error_email_exist}</p>";
                                        } else if (isset($error)) {
                                            echo "<p class='alert alert-danger'>{$error}</p>";
                                        } elseif (isset($success)) {
                                            echo "<p class='alert alert-success'>Account created successfully. <a href='signin.php'>Sign in now</a></p>";
                                        }
                                        ?>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group"><label class="small mb-1" for="inputFirstName">First Name</label>
                                                    <input name="first-name" class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter first name" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"><label class="small mb-1" for="inputLastName">Last Name</label>
                                                    <input name="last-name" class="form-control py-4" id="inputLastName" type="text" placeholder="Enter last name" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="small mb-1" for="userNickname">Nick Name</label>
                                            <input name="nick-name" class="form-control py-4" id="userNickname" type="text" placeholder="Enter nick name" required />
                                        </div>
                                        <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Email</label>
                                            <input name="email" class="form-control py-4" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" required />
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group"><label class="small mb-1" for="inputPassword">Password</label>
                                                    <input name="password" class="form-control py-4" id="inputPassword" type="password" placeholder="Enter password" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                                                    <input name="confirm-password" class="form-control py-4" id="inputConfirmPassword" type="password" placeholder="Confirm password" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-4 mb-0">
                                            <button name="submit" class="btn btn-primary btn-block">Create Account</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small"><a href="signin.php">Have an account? Go to signin</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!--Script JS-->
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>
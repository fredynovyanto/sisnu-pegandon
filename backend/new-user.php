<?php
$title_page = "New User";
require_once('./includes/header.php'); ?>
<?php require_once('./includes/navbar-top.php'); ?>


<!--Side Nav-->
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <?php
        $curr_page = basename(__FILE__);
        require_once("./includes/sidebar.php") ?>
    </div>


    <div id="layoutSidenav_content">
        <main>
            <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
                <div class="container-fluid">
                    <div class="page-header-content">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="edit-3"></i></div>
                            <span>Create New User</span>
                        </h1>
                    </div>
                </div>
            </div>
            <?php
            if (isset($_POST['create'])) {
                $user_name = trim($_POST['user_name']);
                $user_nickname = trim($_POST['user_nickname']);
                //cek nickname yang sama
                $sqlNickname = "SELECT * FROM users WHERE user_nickname = :nickname";
                $stmtNickname = $pdo->prepare($sqlNickname);
                $stmtNickname->execute([
                    ':nickname' => $user_nickname
                ]);
                $countNickname = $stmtNickname->rowCount();
                if ($countNickname != 0) {
                    $error_nickname_exist = "Nickname already exist!";
                    exit($error_nickname_exist);
                }
                $user_email = trim($_POST['user_email']);
                //cek email yang sama
                $sqlEmail = "SELECT * FROM users WHERE user_email = :email";
                $stmtEmail = $pdo->prepare($sqlEmail);
                $stmtEmail->execute([
                    ':email' => $user_email
                ]);
                $countEmail = $stmtEmail->rowCount();
                if ($countEmail != 0) {
                    $error_email_exist = "Email already exist!";
                    exit("$error_email_exist");
                }
                $password = trim($_POST['user_password']);
                $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
                $user_role = $_POST['user_role'];
                $user_photo = $_FILES['user_photo']['name'];
                $user_photo_tmp = $_FILES['user_photo']['tmp_name'];
                move_uploaded_file("{$user_photo_tmp}", "./assets/img/{$user_photo}");
                $sql = "INSERT INTO users (user_name, user_nickname, user_email, user_password, user_photo, registered_on, user_role) 
                        VALUES (:username, :nickname, :email, :password, :photo, :date, :role)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':username' => $user_name,
                    ':nickname' => $user_nickname,
                    ':email' => $user_email,
                    ':password' => $hash,
                    ':photo' => $user_photo,
                    ':date' => date('M n, y'),
                    ':role' => $user_role
                ]);
                $success = true;
            }
            ?>
            <!--Start Table-->
            <div class="container-fluid mt-n10">
                <div class="card mb-4">
                    <div class="card-header">Create New User</div>
                    <div class="card-body">
                        <form action="new-user.php" method="POST" enctype="multipart/form-data">
                            <?php
                            if (isset($error_nickname_exist)) {
                                echo "<p class='alert alert-danger'>{$error_nickname_exist}</p>";
                            }
                            if (isset($error_email_exist)) {
                                echo "<p class='alert alert-danger'>{$error_email_exist}</p>";
                            } elseif (isset($success)) {
                                header("Location: users.php");
                            }
                            ?>
                            <div class="form-group">
                                <label for="user-name">User Name:</label>
                                <input name="user_name" class="form-control" id="user-name" type="text" placeholder="User Name..." required/>
                            </div>
                            <div class="form-group">
                                <label for="user-nickname">Nickname:</label>
                                <input name="user_nickname" class="form-control" id="user-nickname" type="text" placeholder="Nickname..." required/>
                            </div>
                            <div class="form-group">
                                <label for="user-email">User Email:</label>
                                <input name="user_email" class="form-control" id="user-email" type="email" placeholder="User Email..." required/>
                            </div>
                            <div class="form-group">
                                <label for="user-password">Password:</label>
                                <input name="user_password" class="form-control" id="user-password" type="password" placeholder="Password..." required/>
                            </div>
                            <div class="form-group">
                                <label for="user-role">Role:</label>
                                <select name="user_role" class="form-control" id="user-role">
                                    <option value="Admin">Admin</option>
                                    <option value="Subscriber">Subscriber</option>
                                </select>
                                <div class="form-group">
                                    <label for="post-title">Choose photo:</label>
                                    <input name="user_photo" class="form-control" id="post-title" type="file" />
                                </div>
                            </div>
                            <button name="create" type="submit" class="btn btn-primary mr-2 my-1">Create now!</button>
                        </form>
                    </div>
                </div>
            </div>
            <!--End Table-->
        </main>

        <?php require_once('./includes/footer.php'); ?>
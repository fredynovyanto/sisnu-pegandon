<?php
$title_page = "Update User";
require_once('./includes/header.php'); ?>
<?php require_once('./includes/navbar-top.php'); ?>


<!--Side Nav-->
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <?php
        $curr_page = basename(__FILE__);
        require_once("./includes/sidebar.php") ?>
    </div>

    <?php
    if (isset($_POST['edit'])) {
        $user_id = $_POST['user_id'];
        $url = "http://localhost/sisnu-pegandon/backend/user-update.php?id=" . $user_id;
        header("Location: {$url}");
    }
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
                <div class="container-fluid">
                    <div class="page-header-content">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="edit-3"></i></div>
                            <span>Updating User</span>
                        </h1>
                    </div>
                </div>
            </div>
            <?php
            if (isset($_POST['update'])) {
                $user_name = trim($_POST['user_name']);
                $user_nickname = trim($_POST['user_nickname']);
                //cek nickname yang sama
                $sqlNickname = "SELECT * FROM users WHERE user_nickname = :nickname";
                $stmtNickname = $pdo->prepare($sqlNickname);
                $stmtNickname->execute([
                    ':nickname' => $user_nickname
                ]);
                $countNickname = $stmtNickname->rowCount();
                if ($countNickname > 1) {
                    $error_nickname_exist = "Nickname already exist!";
                }
                $user_email = trim($_POST['user_email']);
                //cek email yang sama
                $sqlEmail = "SELECT * FROM users WHERE user_email = :email";
                $stmtEmail = $pdo->prepare($sqlEmail);
                $stmtEmail->execute([
                    ':email' => $user_email
                ]);
                $countEmail = $stmtEmail->rowCount();
                if ($countEmail > 1) {
                    $error_email_exist = "Email already exist!";
                }
                if (!isset($error_nickname_exist) && !isset($error_email_exist)) {
                    $user_role = $_POST['user_role'];
                    $user_photo = $_FILES['user_photo']['name'];
                    $user_photo_tmp = $_FILES['user_photo']['tmp_name'];
                    move_uploaded_file("{$user_photo_tmp}", "./assets/img/{$user_photo}");
                    if (empty($user_photo)) {
                        $sql = "SELECT * FROM users WHERE user_id = :id";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([
                            ':id' => $_GET['id']
                        ]);
                        $user = $stmt->fetch(PDO::FETCH_ASSOC);
                        $user_photo = $user['user_photo'];
                    }
                    $sqlUpdate = "UPDATE users SET user_name = :name, user_nickname = :nickname, user_email = :email, user_photo = :photo, user_role = :role WHERE user_id = :id";
                    $stmtUpdate = $pdo->prepare($sqlUpdate);
                    $stmtUpdate->execute([
                        ':name' => $user_name,
                        ':nickname' => $user_nickname,
                        ':email' => $user_email,
                        ':photo' => $user_photo,
                        ':role' => $user_role,
                        ':id' => $_GET['id']
                    ]);
                    header("Location: users.php");
                }
            }
            ?>
            <?php
            if (isset($_GET['id'])) {
                $user_id = $_GET['id'];
                $sql = "SELECT * FROM users WHERE user_id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':id' => $user_id
                ]);
                $users = $stmt->fetch(PDO::FETCH_ASSOC);
                $u_id = $users['user_id'];
                $username = $users['user_name'];
                $nickname = $users['user_nickname'];
                $email = $users['user_email'];
                $role = $users['user_role'];
                $photo = $users['user_photo'];
            }
            ?>
            <!--Start Table-->
            <div class="container-fluid mt-n10">
                <div class="card mb-4">
                    <div class="card-header">Edit User</div>
                    <div class="card-body">
                        <form action="user-update.php?id=<?= $_GET['id'] ?>" method="POST" enctype="multipart/form-data">
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
                                <input name="user_name" value="<?= $username ?>" class="form-control" id="user-name" type="text" placeholder="User Name..." required />
                            </div>
                            <div class="form-group">
                                <label for="user-nickname">Nickname:</label>
                                <input name="user_nickname" value="<?= $nickname ?>" class="form-control" id="user-nickname" type="text" placeholder="Nickname..." required />
                            </div>
                            <div class="form-group">
                                <label for="user-email">User Email:</label>
                                <input name="user_email" value="<?= $email ?>" class="form-control" id="user-email" type="email" placeholder="User Email..." required />
                            </div>
                            <div class="form-group">
                                <label for="user-role">Role:</label>
                                <select name="user_role" class="form-control" id="user-role">
                                    <option value="Admin" <?= $role == 'Admin' ? 'selected' : ''; ?>>Admin</option>
                                    <option value="Subscriber" <?= $role == 'Subscriber' ? 'selected' : ''; ?>>Subscriber</option>
                                </select>
                                <div class="form-group">
                                    <label for="user-photo">Choose photo:</label>
                                    <input name="user_photo" class="form-control" id="user-photo" type="file" />
                                    <img src="./assets/img/<?= $photo ?>" class="mt-3" width="100" height="100" alt="">
                                </div>
                            </div>
                            <button name="update" class="btn btn-primary mr-2 my-1" type="submit">Update now!</button>
                        </form>
                    </div>
                </div>
            </div>
            <!--End Table-->
        </main>

        <?php require_once('./includes/footer.php'); ?>
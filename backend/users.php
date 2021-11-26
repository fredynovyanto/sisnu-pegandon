<?php
$title_page = "Users";
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
                    <div class="page-header-content d-flex align-items-center justify-content-between text-white">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            <span>All Users</span>
                        </h1>
                        <a href="new-user.php" title="Add new user" class="btn btn-white">
                            <div class="page-header-icon"><i data-feather="plus"></i></div>
                        </a>
                    </div>
                </div>
            </div>
            <!--Start Table-->
            <div class="container-fluid mt-n10">
                <div class="card mb-4">
                    <div class="card-header">All Users</div>
                    <div class="card-body">
                        <div class="datatable table-responsive">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User Name</th>
                                        <th>Nickname</th>
                                        <th>User Email</th>
                                        <th>Photo</th>
                                        <th>Registered on</th>
                                        <th>Role</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM users";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute();
                                    while ($users = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $user_id = $users['user_id'];
                                        $user_name = $users['user_name'];
                                        $user_nickname = $users['user_nickname'];
                                        $user_email = $users['user_email'];
                                        $user_photo = $users['user_photo'];
                                        $registered_on = $users['registered_on'];
                                        $user_role = $users['user_role']; ?>
                                        <tr>
                                            <td><?= $user_id ?></td>
                                            <td>
                                                <?= $user_name ?>
                                            </td>
                                            <td>
                                                <?= $user_nickname ?>
                                            </td>
                                            <td>
                                                <?= $user_email ?>
                                            </td>
                                            <td>
                                                <img src="./assets/img/<?= $user_photo ?>" width="50" height="50" alt="">
                                            </td>
                                            <td><?= $registered_on ?></td>
                                            <td>
                                                <div class="badge badge-<?= $user_role == 'Admin' ? 'secondary' : 'success'; ?>">
                                                    <?= $user_role ?>
                                                </div>
                                            </td>
                                            <td>
                                                <form action="user-update.php" method="POST">
                                                    <input type="hidden" name="user_id" value="<?= $user_id ?>">
                                                    <button name="edit" type="submit" class="btn btn-primary btn-icon"><i data-feather="edit"></i></button>
                                                </form>
                                            </td>
                                            <td>
                                                <?php
                                                if (isset($_POST['delete'])) {
                                                    $user_id = $_POST['user_id'];
                                                    $sql = "DELETE FROM users WHERE user_id = :id";
                                                    $stmt = $pdo->prepare($sql);
                                                    $stmt->execute([
                                                        ':id' => $user_id
                                                    ]);
                                                    header("Location: users.php");
                                                }
                                                if ($user_id == $_SESSION['user_id']) { ?>
                                                    <button title="You can't delete yourself!" name="delete" type="submit" class="btn btn-red btn-icon"><i data-feather="trash-2"></i></button>
                                                <?php } else { ?>
                                                    <form action="users.php" method="POST">
                                                        <input type="hidden" name="user_id" value="<?= $user_id ?>">
                                                        <button name="delete" type="submit" class="btn btn-red btn-icon"><i data-feather="trash-2"></i></button>
                                                    </form>
                                                <?php }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Table-->
        </main>

        <?php require_once('./includes/footer.php'); ?>
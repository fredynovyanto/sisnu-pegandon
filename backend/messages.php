<?php
$title_page = "Messages";
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
                            <div class="page-header-icon"><i data-feather="mail"></i></div>
                            <span>Messages</span>
                        </h1>
                    </div>
                </div>
            </div>
            <!--Start Table-->
            <div class="container-fluid mt-n10">
                <div class="card mb-4">
                    <div class="card-header">All Comments</div>
                    <div class="card-body">
                        <div class="datatable table-responsive">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User Name</th>
                                        <th>User Email</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Response</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM messages";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute();
                                    while ($msg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $msg_id = $msg['msg_id'];
                                        $msg_username = $msg['msg_username'];
                                        $msg_email = $msg['msg_email'];
                                        $msg_detail = substr($msg['msg_detail'], 0, 20);
                                        $msg_date = $msg['msg_date'];
                                        $msg_status = $msg['msg_status'];
                                        $msg_state = $msg['msg_state']; ?>
                                        <tr>
                                            <td><?= $msg_id ?></td>
                                            <td>
                                                <?= $msg_username ?>
                                            </td>
                                            <td>
                                                <?= $msg_email ?>
                                            </td>
                                            <td><?= $msg_detail ?></td>
                                            <td><?= $msg_date ?></td>
                                            <td>
                                                <div class="badge badge-<?= $msg_status == 'Processed' ? 'success' : 'warning' ?>">
                                                    <?= $msg_status ?>
                                                </div>
                                            </td>
                                            <td>
                                                <?php
                                                if ($msg_state == 0) { ?>
                                                    <form action="reply.php" method="post">
                                                        <input type="hidden" name="msg_id" value="<?= $msg_id ?>">
                                                        <button name="response" type="submit" class="btn btn-success btn-icon"><i data-feather="mail"></i></button>
                                                    </form>

                                                <?php } else { ?>
                                                    <button class="btn btn-success btn-icon"><i data-feather="check"></i></button>
                                                <?php }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if (isset($_POST['delete-message'])) {
                                                    $msg_id = $_POST['msg_id'];
                                                    $sql = "DELETE FROM messages WHERE msg_id = :id";
                                                    $stmt = $pdo->prepare($sql);
                                                    $stmt->execute([
                                                        ':id' => $msg_id
                                                    ]);
                                                    header("Location: messages.php");
                                                }
                                                ?>
                                                <form action="messages.php" method="POST">
                                                    <input type="hidden" name="msg_id" value="<?= $msg_id ?>">
                                                    <button name="delete-message" type="submit" class="btn btn-red btn-icon"><i data-feather="trash-2"></i></button>
                                                </form>
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
<?php
$title_page = "Reply";
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
    if (isset($_POST['response'])) {
        $id = $_POST['msg_id'];
        $url = "http://localhost/sisnu-pegandon/backend/reply.php?msg_id=" . $id;
        header("Location: {$url}");
    }
    ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
                <div class="container-fluid">
                    <div class="page-header-content">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="mail"></i></div>
                            <span>Reply</span>
                        </h1>
                    </div>
                </div>
            </div>
            <?php
            $sqlMsg = "SELECT * FROM messages WHERE msg_id = :id";
            $stmtMsg = $pdo->prepare($sqlMsg);
            $stmtMsg->execute([
                ':id' => $_GET['msg_id']
            ]);
            $msg = $stmtMsg->fetch(PDO::FETCH_ASSOC);
            $msg_detail = $msg['msg_detail'];
            $username = $_SESSION['user_name'];

            if (isset($_POST['send-message'])) {
                $reply = trim($_POST['reply']);
                $sql = "UPDATE messages SET msg_status = :status, msg_state = :state, msg_reply = :reply WHERE msg_id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':status' => 'Processed',
                    ':state' => 1,
                    ':reply' => $reply,
                    ':id' => $_GET['msg_id']
                ]);
                header("Location: messages.php");
            }
            ?>
            <!--Start Form-->
            <div class="container-fluid mt-n10">
                <div class="card mb-4">
                    <div class="card-header">Reponse Area:</div>
                    <div class="card-body">
                        <form action="reply.php?msg_id=<?= $_GET['msg_id'] ?>" method="POST"> 
                            <div class="form-group">
                                <label for="post-content">Message:</label>
                                <textarea name="msg-detail" class="form-control" placeholder="Type here..." id="post-content" rows="9" readonly="true"><?= $msg_detail ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="user-name">User name:</label>
                                <input name="username" class="form-control" id="user-name" type="text" placeholder="User name ..." readonly="true" value="<?= $username ?>" />
                            </div>

                            <div class="form-group">
                                <label for="post-tags">Reply:</label>
                                <textarea name="reply" class="form-control" placeholder="Type your reply here..." id="post-tags" rows="9"></textarea>
                            </div>

                            <button name="send-message" class="btn btn-primary mr-2 my-1" type="submit">Send my respose</button>
                        </form>
                    </div>
                </div>
            </div>
            <!--End Form-->

        </main>

        <?php require_once('./includes/footer.php'); ?>
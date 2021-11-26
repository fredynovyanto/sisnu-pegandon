<nav class="topnav navbar navbar-expand shadow navbar-light bg-white" id="sidenavAccordion">
    <a class="navbar-brand d-none d-sm-block" href="index.php">Admin Panel</a><button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle" href="#"><i data-feather="menu"></i></button>
    <ul class="navbar-nav align-items-center ml-auto">
        <?php
        $sqlCom = "SELECT * FROM comments WHERE com_state = :state";
        $stmtCom = $pdo->prepare($sqlCom);
        $stmtCom->execute([
            ':state' => 0
        ]);
        $countCom = $stmtCom->rowCount();
        ?>
        <!--User Registration + New Comment Notification-->
        <li class="nav-item dropdown no-caret mr-3 dropdown-notifications">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownAlerts" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i data-feather="bell"></i>
                <?php
                if ($countCom != 0) { ?>
                    <span class="badge badge-red"><?= $countCom ?></span>
                <?php }
                ?>
            </a>

            <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownAlerts">
                <h6 class="dropdown-header dropdown-notifications-header">
                    <i class="mr-2" data-feather="bell"></i>
                    Notification
                </h6>
                <?php 
                    while ($com = $stmtCom->fetch(PDO::FETCH_ASSOC)) {
                        $com_date = $com['com_date'];
                        $com_detail = substr($com['com_detail'], 0, 30); ?>
                        <a class="dropdown-item dropdown-notifications-item" href="comments.php">
                            <div class="dropdown-notifications-item-icon bg-warning"><i data-feather="activity"></i></div>
                            <div class="dropdown-notifications-item-content">

                                <div class="dropdown-notifications-item-content-details">
                                    <?= $com_date?>
                                </div>
                                <div class="dropdown-notifications-item-content-text">
                                    <?= $com_detail?>
                                </div>
                            </div>
                        </a>
                <?php }
                ?>
                

                <a class="dropdown-item dropdown-notifications-footer" href="comments.php">
                    View All Comments
                </a>
            </div>
        </li>
        <!--User Registration + New Comment Notification-->
        <?php
        $sqlMsg = "SELECT * FROM messages WHERE msg_state = :state";
        $stmtMsg = $pdo->prepare($sqlMsg);
        $stmtMsg->execute([
            ':state' => 0
        ]);
        $countMsg = $stmtMsg->rowCount();
        ?>
        <!--Message Notification-->
        <li class="nav-item dropdown no-caret mr-3 dropdown-notifications">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownMessages" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i data-feather="mail"></i>
                <?php
                if ($countMsg != 0) { ?>
                    <span class="badge badge-red"><?= $countMsg ?></span>
                <?php }
                ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownMessages">
                <h6 class="dropdown-header dropdown-notifications-header">
                    <i class="mr-2" data-feather="mail"></i>
                    Message Notification
                </h6>
                <?php
                while ($msg = $stmtMsg->fetch(PDO::FETCH_ASSOC)) {
                    $msg_username = $msg['msg_username'];
                    $msg_email = $msg['msg_email'];
                    $msg_detail = $msg['msg_detail'];
                    $msg_date = $msg['msg_date']; ?>
                    <a class="dropdown-item dropdown-notifications-item" href="messages.php">
                        <div class="dropdown-notifications-item-content">
                            <div class="dropdown-notifications-item-content-text">
                                <?= $msg_detail ?>
                            </div>
                            <div class="dropdown-notifications-item-content-details">
                                <?= $msg_username ?> &#xB7; <?= $msg_date ?>
                            </div>
                        </div>
                    </a>
                <?php }
                ?>


                <a class="dropdown-item dropdown-notifications-footer" href="messages.php">
                    Read All Messages
                </a>
            </div>
        </li>
        <!--Message Notification-->
        <?php
        if (isset($_COOKIE['_uid_'])) {
            $user_id = base64_decode($_COOKIE['_uid_']);
        } elseif (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
        } else {
            $user_id = -1;
        }
        $sql = "SELECT * FROM users WHERE user_id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id' => $user_id
        ]);
        $users = $stmt->fetch(PDO::FETCH_ASSOC);
        $username = $users['user_name'];
        $user_email = $users['user_email'];
        $user_photo = $users['user_photo'];
        ?>
        <li class="nav-item dropdown no-caret mr-3 dropdown-user">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="./assets/img/<?= $user_photo ?>" /></a>
            <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                <h6 class="dropdown-header d-flex align-items-center">
                    <img class="dropdown-user-img" src="./assets/img/<?= $user_photo ?>" alt="<?= $username ?>" />
                    <div class="dropdown-user-details">
                        <div class="dropdown-user-details-name">
                            <?= $username ?>
                        </div>
                        <div class="dropdown-user-details-email">
                            <?= $user_email ?>
                        </div>
                    </div>
                </h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="profile.php">
                    <div class="dropdown-item-icon">
                        <i data-feather="settings"></i>
                    </div>
                    Profile
                </a>
                <a class="dropdown-item" href="../signout.php">
                    <div class="dropdown-item-icon">
                        <i data-feather="log-out"></i>
                    </div>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
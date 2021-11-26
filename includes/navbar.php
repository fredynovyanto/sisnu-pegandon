<?php session_start() ?>
<div id="layoutDefault">
    <div id="layoutDefault_content">
        <main>
            <nav class="navbar navbar-marketing navbar-expand-lg bg-white navbar-light">
                <div class="container">
                    <a class="navbar-brand text-dark" href="index.php">SISNU Pegandon</a><button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><img src="img/menu.png" style="height:20px;width:25px" /><i data-feather="menu"></i></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto mr-lg-5">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Home </a>
                            </li>
                            <li class="nav-item dropdown no-caret">
                                <a class="nav-link" href="contact.php">Contact</a>
                            </li>
                            <li class="nav-item dropdown no-caret">
                                <a class="nav-link" href="about.php">About</a>
                            </li>
                            <?php
                            if (isset($_SESSION['login']) && $_SESSION['user_role'] == 'Admin') { ?>
                                <li class="nav-item dropdown no-caret">
                                    <a class="nav-link" href="http://localhost/sisnu-pegandon/backend/index.php">Backend</a>
                                </li>
                            <?php } else {
                                
                            }
                            ?>
                            
                        </ul>
                        <?php
                        if (isset($_SESSION['login'])) { ?>
                            <form action="signout.php">
                                <button class="btn-teal btn rounded-pill px-4 ml-lg-4">Sign out (<?= $_SESSION['nickname'] ?>)</button>
                            </form>
                        <?php } else {
                            if (!isset($_COOKIE['_uid_']) && !isset($_COOKIE['_uiid_'])) {
                                echo '<a class="btn-teal btn rounded-pill px-4 ml-lg-4" href="backend/signin.php">Sign in</i></a>';
                                echo '<a class="btn-teal btn rounded-pill px-4 ml-lg-4" href="backend/signup.php">Sign up</i></a>';
                            } else {
                                $user_id = base64_decode($_COOKIE['_uid_']);
                                $nickname = base64_decode($_COOKIE['_uiid_']);
                                $sqlCookie = "SELECT * FROM users WHERE user_id = :id AND user_nickname = :nickname";
                                $stmt = $pdo->prepare($sqlCookie);
                                $stmt->execute([
                                    ':id' => $user_id,
                                    ':nickname' => $nickname
                                ]);
                                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                                $username = $user['user_nickname'];
                                echo '
                                    <form action="signout.php">
                                        <button class="btn-teal btn rounded-pill px-4 ml-lg-4">Sign out (<?= $username ?>)</button>
                                    </form>
                                    ';
                            }
                        }
                        ?>


                    </div>
                </div>
            </nav>
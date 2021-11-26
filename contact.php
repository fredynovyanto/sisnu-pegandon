<?php $current_page = "Contact" ?>
<?php require_once('./includes/header.php'); ?>
<?php require_once('./includes/navbar.php') ?>

<header class="page-header page-header-dark bg-gradient-primary-to-secondary">
    <div class="page-header-content pt-10">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="page-header-title mb-3">Contact Us</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="svg-border-rounded text-white">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor">
            <path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0" />
        </svg>
    </div>
</header>
<section class="bg-white py-10">
    <div class="container">
        <?php
        if (isset($_SESSION['login'])) { ?>
            <form action="contact.php" method="POST">
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

                if (isset($_POST['send'])) {
                    $message = trim($_POST['message']);
                    $sql = "INSERT INTO messages SET msg_username = :username, msg_email = :email, msg_detail = :detail, msg_date = :date";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([
                        ':username' => $username,
                        ':email' => $user_email,
                        ':detail' => $message,
                        ':date' => date('D, d-M-Y / H:i:s a')
                    ]);
                    echo "<p class='alert alert-success'>Message has been send successfully!</p>";
                }
                ?>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="text-dark" for="inputName">Full name</label>
                        <input value="<?= $username ?>" readonly class="form-control py-4" id="inputName" type="text" placeholder="Full name" />
                    </div>
                    <div class="form-group col-md-6">
                        <label class="text-dark" for="inputEmail">Email</label>
                        <input value="<?= $user_email ?>" readonly class="form-control py-4" id="inputEmail" type="email" placeholder="name@example.com" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-dark" for="inputMessage">Message</label>
                    <textarea name="message" class="form-control py-3" id="inputMessage" type="text" placeholder="Enter your message..." rows="4"></textarea>
                </div>
                <div class="text-center">
                    <button name="send" class="btn btn-primary btn-marketing mt-4" type="submit">Submit Request</button>
                </div>
            </form>
            <div class="datatable table-responsive mt-5">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Your Messages : </th>
                            <th>Answer : </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM messages WHERE msg_username = :username";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([
                            ':username' => $_SESSION['user_name']
                        ]);
                        while ($msg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $msg_detail = $msg['msg_detail'];
                            $msg_answer = $msg['msg_reply']; ?>
                            <tr>
                                <td><?= $msg_detail ?>
                                </td>
                                <td>
                                    <?= $msg_answer ?>
                                </td>
                            </tr>
                        <?php }
                        ?>

                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <a href="./backend/signin.php">Sign in to contact us!</a>
        <?php }
        ?>
    </div>

    <div class="svg-border-rounded text-dark">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor">
            <path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0" />
        </svg>
    </div>
</section>
</main>
</div>
<div id="layoutDefault_footer">
    <footer class="footer pt-4 pb-4 mt-auto bg-dark footer-dark">
        <div class="container">
            <hr class="my-1" />
            <div class="row align-items-center">
                <div class="col-md-6 small">Copyright &#xA9; SISNU Pegandon 2021</div>
                <div class="col-md-6 text-md-right small">
                    <a href="privacy_policy.php">Privacy Policy</a>
                    &#xB7;
                    <a href="terms_conditions.php">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</div>
</div>
<?php require_once('./includes/footer.php'); ?>
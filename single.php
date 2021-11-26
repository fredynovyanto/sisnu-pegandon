<?php $current_page = "Detail Post" ?>
<?php require_once('./includes/header.php'); ?>
<?php require_once('./includes/navbar.php') ?>
<?php

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $sql = "SELECT * FROM posts WHERE post_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id' => $post_id
    ]);
    $posts = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if ($count == 0) {
        header('Location: index.php');
    }
    $post_title = $posts['post_title'];
    $post_detail = $posts['post_detail'];
    $post_image = $posts['post_image'];
    $post_category_id = $posts['post_category_id'];
    $sqlCategory = "SELECT * FROM categories WHERE category_id = :id";
    $stmt = $pdo->prepare($sqlCategory);
    $stmt->execute([
        ':id' => $post_category_id
    ]);
    $category = $stmt->fetch(PDO::FETCH_ASSOC);
    $post_category = $category['category_name'];

    $post_author = $posts['post_author'];

    $sqlCom = "SELECT * FROM comments WHERE com_post_id = :com_id";
    $stmtCom = $pdo->prepare($sqlCom);
    $stmtCom->execute([
        ':com_id' => $post_id
    ]);
    $countCom = $stmtCom->rowCount();
    $sql1 = "UPDATE posts SET post_views = post_views + 1, post_comment_count = :comment WHERE post_id = :id";
    $stmt = $pdo->prepare($sql1);
    $stmt->execute([
        ':comment' => $countCom,
        ':id' => $post_id
    ]);
} else {
    header('Location: index.php');
}
?>
<header class="page-header page-header-dark bg-gradient-primary-to-secondary">
    <div class="page-header-content pt-10">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="page-header-title mb-3"><?= $post_title ?></h1>
                    <p class="page-header-text">Category : <?= $post_category ?>, Posted by : <?= $post_author ?></p>
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
        <div class="row mb-5">
            <div class="col-md-4"></div>
            <div class="col-md-4 justify-content-center d-flex">
                <img src="./img/<?= $post_image ?>" alt="" class="img-fluid w-100">
            </div>
            <div class="col-md-4"></div>
        </div>
        <!--start post content-->
        <div>
            <h1><?= $post_title ?></h1>
            <p class="lead">
                <?= $post_detail ?>
            </p>
        </div>
        <!--end post content-->

        <!--start comment section-->
        <div class="pt-5 col-lg-8 col-xl-9">
            <div class="d-flex align-items-center justify-content-between flex-column flex-md-row">
                <h2 class="mb-0">Comments</h2>
            </div>
            <hr class="mb-4" />
            <?php
            $sql = "SELECT * FROM comments WHERE com_status = :status AND com_post_id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':status' => "approved",
                ':id' => $_GET['post_id']
            ]);
            $count = $stmt->rowCount();
            if ($count == 0) {
                echo "No comments";
            } else {
                $sql1 = "SELECT * FROM comments WHERE com_post_id = :id";
                $stmt1 = $pdo->prepare($sql1);
                $stmt1->execute([
                    ':id' => $_GET['post_id']
                ]);
                while ($comments = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                    $nickname = $comments['com_nickname'];
                    $date = $comments['com_date'];
                    $status = $comments['com_status'];
                    $com_user_id = $comments['com_user_id'];
                    $detail = $comments['com_detail'];

                    if (isset($_SESSION['user_id'])) {
                        $signin_userid = $_SESSION['user_id'];
                    } elseif (isset($_COOKIE['_uid_'])) {
                        $signin_userid = base64_decode($_COOKIE['_uid_']);
                    } else {
                        $signin_userid = -1;
                    }?>
                        <div class="card mb-5">
                            <div class="card-header d-flex justify-content-between">
                                <div class="mr-2 text-dark">
                                    <?= $nickname ?>
                                    <div class="text-xs text-muted"><?= $date ?></div>
                                </div>
                            </div>
                            <div class="card-body"><?= $detail ?></div>
                        </div>

            <?php
                }
            }
            ?>
            <hr class="mb-4" />
            <?php
            if (isset($_COOKIE['_uid_']) || isset($_COOKIE['_uiid_']) || isset($_SESSION['login'])) {
            ?>
                <div class="card">
                    <div class="card-header">Add Comment</div>
                    <div class="card-body">
                        <?php
                        if (isset($_POST['submit'])) {
                            $comment = trim($_POST['comment']);
                            $sqlComment = "INSERT INTO comments (com_post_id, com_detail, com_user_id, com_nickname, com_date, com_status) 
                                            VALUES (:post_id, :detail, :user_id, :nickname, :date, :status)";
                            $stmt = $pdo->prepare($sqlComment);
                            $stmt->execute([
                                ':post_id' => $_GET['post_id'],
                                ':detail' => $comment,
                                ':user_id' => $_SESSION['user_id'],
                                ':nickname' => $_SESSION['nickname'],
                                ':date' => date('D, d-M-Y / H:i:s a'),
                                ':status' => 'unapproved'
                            ]);
                            header("Location: single.php?post_id={$_GET['post_id']}");
                        }
                        ?>
                        <form action="single.php?post_id=<?= $_GET['post_id'] ?>" method="POST">
                            <textarea name="comment" placeholder="Type here..." class="form-control mb-2" rows="4"></textarea>
                            <button name="submit" type="submit" class="btn btn-primary btn-sm mr-2">Post Comment</button>
                        </form>
                    </div>
                </div>
            <?php
            } else {
                echo "<a href='./backend/signin.php'>Sign in to comment</a>";
            }
            ?>

        </div>
        <!--end comment section end-->
    </div>

    <!--Rounded style-->
    <div class="svg-border-rounded text-dark">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor">
            <path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0" />
        </svg>
    </div>
    <!--Rounded style-->
</section>
</main>
</div>

<!--Footer start-->
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
<!--Footer end-->

<?php require_once('./includes/footer.php'); ?>
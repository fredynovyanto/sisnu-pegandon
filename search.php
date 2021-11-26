<?php $current_page = "Search Result" ?>
<?php require_once('./includes/header.php'); ?>
<?php require_once('./includes/navbar.php') ?>

<?php
if (isset($_POST['search-keyword'])) {
    $url = "http://localhost/sisnu-pegandon/search.php?key=" . $_POST['search-keyword'];
    header("Location: {$url}");
}
if (isset($_GET['key'])) {
    $keyword = $_GET['key'];
    $sql = "SELECT * FROM posts WHERE post_status = :status AND post_title LIKE :title";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':status' => "Published",
        ':title' => '%' . trim($keyword) . '%'
    ]);
    $post_found = 0;
    $count = $stmt->rowCount();
    if ($count == 0) {
        $post_found = 0;
    } else {
        $post_found = $count;
    }
}
?>
<header class="page-header page-header-dark bg-gradient-primary-to-secondary">
    <div class="page-header-content pt-10">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="page-header-title mb-3">Search result for <?= $keyword ?></h1>
                    <p class="page-header-text">Total post found : <?= $post_found ?></p>
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
        $keyword = $_GET['key'];
        $sql = "SELECT * FROM posts WHERE post_status = :status AND post_title LIKE :title";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':status' => "Published",
            ':title' => '%' . trim($keyword) . '%'
        ]);
        $post_count = $stmt->rowCount();
        $post_per_page = 3;
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            if ($page == 1) {
                $page_id = 0;
            } else {
                $page_id = ($page * $post_per_page) - $post_per_page;
            }
        } else {
            $page = 1;
            $page_id = 0;
        }
        $total_page = ceil($post_count / $post_per_page);
        ?>
        <h1>Search Result:</h1>
        <hr />
        <div class="row">
            <?php
            $sql = "SELECT * FROM posts WHERE post_status = :status AND post_title LIKE :title ORDER BY post_id DESC LIMIT $page_id, $post_per_page";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':status' => "Published",
                ':title' => '%' . trim($keyword) . '%'
            ]);
            $count = $stmt->rowCount();
            if ($count == 0) {
                echo "No posts found! Try again";
            } else {
                while ($posts = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $post_id = $posts['post_id'];
                    $post_title = $posts['post_title'];
                    $post_detail = substr($posts['post_detail'], 0, 150);
                    $post_image = $posts['post_image'];
                    $post_author = $posts['post_author'];
                    $post_date = $posts['post_date'];
                    $post_views = $posts['post_views'];

                    $sqlAuthor = "SELECT * FROM users WHERE user_name = :name";
                    $stmtAuthor = $pdo->prepare($sqlAuthor);
                    $stmtAuthor->execute([
                        ':name' => $post_author
                    ]);
                    $author = $stmtAuthor->fetch(PDO::FETCH_ASSOC);
                    $photo_author = $author['user_photo'];
            ?>

                    <div class="col-md-6 col-xl-4 mb-5">
                        <a class="card post-preview lift h-100" href="single.php?post_id=<?= $post_id ?>"><img class="card-img-top" src="./img/<?= $post_image ?>" alt="<?= $post_image ?>" />
                            <div class="card-body">
                                <h5 class="card-title"><?= $post_title ?></h5>
                                <p class="card-text"><?= $post_detail ?></p>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <div class="post-preview-meta">
                                    <img class="post-preview-meta-img" src="./backend/assets/img/<?= $photo_author ?>" />
                                    <div class="post-preview-meta-details">
                                        <div class="post-preview-meta-details-name"><?= $post_author ?></div>
                                        <div class="post-preview-meta-details-date">Posted on : <?= $post_date ?> </div>
                                    </div>
                                </div>
                                <div class="post-preview-meta">
                                    <?= $post_views ?>
                                </div>
                            </div>
                        </a>
                    </div>

            <?php
                }
            }
            ?>
        </div>

        <?php
        if ($post_count > $post_per_page) { ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-blog justify-content-center">
                    <?php
                    if (isset($_GET['page'])) {
                        $prev = $_GET['page'] - 1;
                    } else {
                        $prev = 0;
                    }

                    if ($prev + 1 <= 1) {
                        echo '  <li class="page-item disabled">
                                    <a class="page-link" href="#!" aria-label="Previous"><span aria-hidden="true">&#xAB;</span></a>
                                </li>';
                    } else {
                        echo '  <li class="page-item">
                                    <a class="page-link" href="search.php?key=' . $_GET['key'] . '&page=' . $prev . '" aria-label="Previous"><span aria-hidden="true">&#xAB;</span></a>
                                </li>';
                    }
                    ?>

                    <?php
                    if (isset($_GET['page'])) {
                        $active = $_GET['page'];
                    } else {
                        $active = 1;
                    }
                    for ($i = 1; $i <= $total_page; $i++) {
                        if ($i == $active) {
                            echo '<li class="page-item active"><a class="page-link" href="search.php?key=' . $_GET['key'] . '&page=' . $i . '">' . $i . '</a></li>';
                        } else {
                            echo '<li class="page-item"><a class="page-link" href="search.php?key=' . $_GET['key'] . '&page=' . $i . '">' . $i . '</a></li>';
                        }
                    }

                    if (isset($_GET['page'])) {
                        $next = $_GET['page'] + 1;
                    } else {
                        $next = 2;
                    }

                    if ($next - 1 >= $total_page) {
                        echo '  <li class="page-item disabled">
                                    <a class="page-link" href="#!" aria-label="Next"><span aria-hidden="true">&#xBB;</span></a>
                                </li>';
                    } else {
                        echo '  <li class="page-item">
                                    <a class="page-link" href="search.php?key=' . $_GET['key'] . '&page=' . $next . '" aria-label="Next"><span aria-hidden="true">&#xBB;</span></a>
                                </li>';
                    }
                    ?>

                </ul>
            </nav>
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
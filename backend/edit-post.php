<?php
$title_page = "Edit Post";
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
        $post_id = $_POST['post_id'];
        $url = "http://localhost/sisnu-pegandon/backend/edit-post.php?post_id=" . $post_id;
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
                            <span>Try Updating Post</span>
                        </h1>
                    </div>
                </div>
            </div>

            <?php
            if (isset($_GET['post_id'])) {
                $post_id = $_GET['post_id'];
                $sql = "SELECT * FROM posts WHERE post_id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':id' => $post_id
                ]);
                $posts = $stmt->fetch(PDO::FETCH_ASSOC);
                $title = $posts['post_title'];
                $status = $posts['post_status'];
                $post_category_id = $posts['post_category_id'];
                $photo = $posts['post_image'];
                $detail = $posts['post_detail'];
                $tags = $posts['post_tags'];
            }
            ?>
            <?php
            if (isset($_POST['update'])) {
                $post_title = trim($_POST['post-title']);
                $post_status = $_POST['post-status'];
                $post_category = $_POST['post-category'];
                $post_photo = $_FILES['post-photo']['name'];
                $post_photo_tmp = $_FILES['post-photo']['tmp_name'];
                move_uploaded_file("{$post_photo_tmp}", "../img/{$post_photo}");
                if (empty($post_photo)) {
                    $sqlPhoto = "SELECT * FROM posts WHERE post_id = :id";
                    $stmtPhoto = $pdo->prepare($sqlPhoto);
                    $stmtPhoto->execute([
                        ':id' => $_GET['post_id']
                    ]);
                    $post = $stmtPhoto->fetch(PDO::FETCH_ASSOC);
                    $post_photo = $post['post_image'];
                }
                $post_detail = $_POST['post-detail'];
                $post_tags = $_POST['post-tags'];
                $sqlUpdate = "UPDATE posts SET post_title = :title, post_detail = :detail, post_category_id = :catid, post_image = :image, post_status = :status, post_tags = :tags WHERE post_id = :id";
                $stmtUpdate = $pdo->prepare($sqlUpdate);
                $stmtUpdate->execute([
                    ':id' => $_GET['post_id'],
                    ':title' => $post_title,
                    ':detail' => $post_detail,
                    ':catid' => $post_category,
                    ':image' => $post_photo,
                    ':status' => $post_status,
                    ':tags' => $post_tags
                ]);
                header("Location: all-post.php");
            }
            ?>
            <!--Start Table-->
            <div class="container-fluid mt-n10">
                <div class="card mb-4">
                    <div class="card-header">Update Post</div>
                    <div class="card-body">
                        <form action="edit-post.php?post_id=<?= $_GET['post_id'] ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="post-title">Post Title:</label>
                                <input name="post-title" value="<?= $title ?>" class="form-control" id="post-title" type="text" placeholder="Post title ..." />
                            </div>
                            <div class="form-group">
                                <label for="post-status">Post Status:</label>
                                <select name="post-status" class="form-control" id="post-status">
                                    <option value="Published" <?= $status == 'Published' ? 'selected' : ''; ?>>Published</option>
                                    <option value="Draft" <?= $status == 'Draft' ? 'selected' : ''; ?>>Draft</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="select-category">Select Category:</label>
                                <select name="post-category" class="form-control" id="select-category">
                                    <?php
                                    $sqlCat = "SELECT * FROM categories WHERE category_status = :status";
                                    $stmtCat = $pdo->prepare($sqlCat);
                                    $stmtCat->execute([
                                        ':status' => 'Published'
                                    ]);
                                    while ($cat = $stmtCat->fetch(PDO::FETCH_ASSOC)) {
                                        $cat_id = $cat['category_id'];
                                        $cat_name = $cat['category_name']; ?>
                                        <option value="<?= $cat_id; ?>" <?= $cat_id == $post_category_id ? 'selected' : ''; ?>><?= $cat_name ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="post-title">Choose photo:</label>
                                <input name="post-photo" class="form-control mb-2" id="post-title" type="file" />
                                <img src="../img/<?= $photo ?>" alt="" width="100" height="100">
                            </div>

                            <div class="form-group">
                                <label for="post-content">Post Details:</label>
                                <textarea name="post-detail" class="form-control" placeholder="Type here..." id="post-content" rows="9"><?= $detail ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="post-tags">Post Tags:</label>
                                <textarea name="post-tags" class="form-control" placeholder="Tags..." id="post-tags" rows="3"><?= $tags ?></textarea>
                            </div>
                            <button name="update" class="btn btn-primary mr-2 my-1" type="submit">Submit now</button>
                        </form>
                    </div>
                </div>
            </div>
            <!--End Table-->

        </main>

        <?php require_once('./includes/footer.php'); ?>
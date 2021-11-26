<?php
$title_page = "Tambah Post";
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
                            <div class="page-header-icon"><i data-feather="edit-3"></i></div>
                            <span>Tambah Post</span>
                        </h1>
                    </div>
                </div>
            </div>

            <?php 
                if (isset($_POST['create'])) {
                    $post_title = trim($_POST['post_title']);
                    $post_status = $_POST['post_status'];
                    $post_category = $_POST['post_category'];
                    $post_photo = $_FILES['post_photo']['name'];
                    $post_photo_tmp = $_FILES['post_photo']['tmp_name'];
                    move_uploaded_file("{$post_photo_tmp}", "../img/{$post_photo}");
                    $post_detail = $_POST['post_detail'];
                    $post_tags = $_POST['post_tags'];
                    $sql = "INSERT INTO posts (post_title, post_detail, post_category_id, post_image, post_date, post_status, post_author, post_views, post_comment_count, post_tags)
                            VALUES (:title, :detail, :catid, :image, :date, :status, :author, :views, :comment, :tags)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([
                        ':title' => $post_title, 
                        ':detail'=> $post_detail, 
                        ':catid' => $post_category, 
                        ':image' => $post_photo, 
                        ':date' => date('D, d-M-Y / H:i:s a'), 
                        ':status' => $post_status, 
                        ':author' => $_SESSION['user_name'], 
                        ':views' => 0, 
                        ':comment' => 0, 
                        ':tags' => $post_tags
                    ]);
                    header("Location: all-post.php");
                }
            ?>
            <!--Start Form-->
            <div class="container-fluid mt-n10">
                <div class="card mb-4">
                    <div class="card-header">Menambah Post Baru</div>
                    <div class="card-body">
                        <form action="add-new.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="post-title">Post Title:</label>
                                <input name="post_title" class="form-control" id="post-title" type="text" placeholder="Post title ..." required />
                            </div>
                            <div class="form-group">
                                <label for="post-status">Post Status:</label>
                                <select name="post_status" class="form-control" id="post-status">
                                    <option value="Published">Published</option>
                                    <option value="Draft">Draft</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="select-category">Select Category:</label>
                                <select name="post_category" class="form-control" id="select-category">
                                <?php 
                                    $sqlCat = "SELECT * FROM categories WHERE category_status = :status";
                                    $stmtCat = $pdo->prepare($sqlCat);
                                    $stmtCat->execute([
                                        ':status' => 'Published'
                                    ]);
                                    while ($cat = $stmtCat->fetch(PDO::FETCH_ASSOC)) {
                                        $cat_id = $cat['category_id'];
                                        $cat_name = $cat['category_name']; ?>
                                        <option value="<?= $cat_id?>"><?= $cat_name ?></option>
                                <?php }
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="post-title">Choose photo:</label>
                                <input name="post_photo" class="form-control" id="post-title" type="file" required />
                            </div>

                            <div class="form-group">
                                <label for="post-content">Post Details:</label>
                                <textarea name="post_detail" class="form-control" placeholder="Type here..." id="post-content" rows="9" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="post-tags">Post Tags:</label>
                                <textarea name="post_tags" class="form-control" placeholder="Tags..." id="post-tags" rows="3" required></textarea>
                            </div>
                            <button name="create" class="btn btn-primary mr-2 my-1" type="submit">Submit now</button>
                        </form>
                    </div>
                </div>
            </div>
            <!--End Form-->

        </main>

        <?php require_once('./includes/footer.php'); ?>
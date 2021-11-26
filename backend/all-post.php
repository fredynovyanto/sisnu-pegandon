<?php
$title_page = "All Post";
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
                            <div class="page-header-icon"><i data-feather="layout"></i></div>
                            <span>All Posts</span>
                        </h1>
                    </div>
                </div>
            </div>

            <!--Start Table-->
            <div class="container-fluid mt-n10">
                <div class="card mb-4">
                    <div class="card-header">All Posts</div>
                    <div class="card-body">
                        <div class="datatable table-responsive">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Category</th>
                                        <th>Author</th>
                                        <th>Image</th>
                                        <th>Date</th>
                                        <th>Details</th>
                                        <th>Tags</th>
                                        <th>Comments</th>
                                        <th>Views</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Category</th>
                                        <th>Author</th>
                                        <th>Image</th>
                                        <th>Date</th>
                                        <th>Details</th>
                                        <th>Tags</th>
                                        <th>Comments</th>
                                        <th>Views</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM posts";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute();
                                    while ($posts = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $post_id = $posts['post_id'];
                                        $post_title = $posts['post_title'];
                                        $post_detail = substr($posts['post_detail'], 0, 10);
                                        $post_category_id = $posts['post_category_id'];
                                        $sqlCat = "SELECT * FROM categories WHERE category_id = :id";
                                        $stmtCat = $pdo->prepare($sqlCat);
                                        $stmtCat->execute([
                                            ':id' => $post_category_id
                                        ]);
                                        $categories = $stmtCat->fetch(PDO::FETCH_ASSOC);
                                        $category_name = $categories['category_name'];
                                        $post_image = $posts['post_image'];
                                        $post_date = $posts['post_date'];
                                        $post_status = $posts['post_status'];
                                        $post_author = $posts['post_author'];
                                        $post_views = $posts['post_views'];
                                        $post_comment_count = $posts['post_comment_count'];
                                        $post_tags = substr($posts['post_tags'], 0, 10); ?>
                                        <tr>
                                            <td><?= $post_id ?></td>
                                            <td>
                                                <a href="../single.php?post_id=<?= $post_id ?>" target="_blank"><?= $post_title ?></a>
                                            </td>
                                            <td>
                                                <div class="badge badge-<?= $post_status == 'Published' ? 'success' : 'warning'; ?>"><?= $post_status ?>
                                                </div>
                                            </td>
                                            <td><?= $category_name ?></td>
                                            <td><?= $post_author ?></td>
                                            <td>
                                                <img src="../img/<?= $post_image ?>" width="50" height="50" alt="">
                                            </td>
                                            <td><?= $post_date ?></td>
                                            <td><?= $post_detail ?></td>
                                            <td><?= $post_tags ?></td>
                                            <td>
                                                <a href="comments.php"><?= $post_comment_count ?></a>
                                            </td>
                                            <td><?= $post_views ?></td>
                                            <td>
                                                <form action="edit-post.php" method="POST">
                                                    <input type="hidden" name="post_id" value="<?= $post_id?>">
                                                    <button name="edit" type="submit" class="btn btn-blue btn-icon"><i data-feather="edit"></i></button>
                                                </form>
                                            </td>
                                            <td>
                                                <?php
                                                if (isset($_POST['delete-post'])) {
                                                    $post_id = $_POST['post_id'];
                                                    $sql = "DELETE FROM posts WHERE post_id = :id";
                                                    $stmt = $pdo->prepare($sql);
                                                    $stmt->execute([
                                                        ':id' => $post_id
                                                    ]);
                                                    header("Location: all-post.php");
                                                }
                                                ?>
                                                <form action="all-post.php" method="POST">
                                                    <input type="hidden" name="post_id" value="<?= $post_id ?>">
                                                    <button name="delete-post" type="submit" class="btn btn-red btn-icon"><i data-feather="trash-2"></i></button>
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
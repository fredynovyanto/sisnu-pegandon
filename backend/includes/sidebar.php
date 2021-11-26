<nav class="sidenav shadow-right sidenav-light">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">
            <?php
            if ($curr_page == 'index.php') { ?>
                <a class="nav-link collapsed pt-4 active" href="index.php">
                    <div class="nav-link-icon"><i data-feather="activity"></i></div>
                    Dashboard
                </a>
            <?php } else { ?>
                <a class="nav-link collapsed pt-4" href="index.php">
                    <div class="nav-link-icon"><i data-feather="activity"></i></div>
                    Dashboard
                </a>
            <?php }
            ?>
            <?php
            if ($curr_page == 'add-new.php' || $curr_page == 'all-post.php' || $curr_page == 'edit-post.php') { ?>
                <a class="nav-link collapsed active" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="nav-link-icon"><i data-feather="layout"></i></div>
                    Posts
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" data-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavLayout">
                        <a class="nav-link" href="all-post.php">All Posts</a>
                        <a class="nav-link" href="add-new.php">Tambah Post</a>
                    </nav>
                </div>
            <?php } else { ?>
                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="nav-link-icon"><i data-feather="layout"></i></div>
                    Posts
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" data-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavLayout">
                        <a class="nav-link" href="all-post.php">All Posts</a>
                        <a class="nav-link" href="add-new.php">Tambah Post</a>
                    </nav>
                </div>
            <?php }
            ?>

            <?php
            if ($curr_page == 'new-category.php' || $curr_page == 'categories.php' || $curr_page == 'edit-category.php') { ?>
                <a class="nav-link active" href="categories.php">
                    <div class="nav-link-icon"><i data-feather="chevrons-up"></i></div>
                    Kategori
                </a>
            <?php } else { ?>
                <a class="nav-link" href="categories.php">
                    <div class="nav-link-icon"><i data-feather="chevrons-up"></i></div>
                    Kategori
                </a>
            <?php }
            ?>

            <?php
            if ($curr_page == 'anggota.php' || $curr_page == 'anggota-new.php' || $curr_page == 'anggota-edit.php') { ?>
                <a class="nav-link active" href="anggota.php">
                    <div class="nav-link-icon"><i data-feather="users"></i></div>
                    Anggota
                </a>
            <?php } else { ?>
                <a class="nav-link" href="anggota.php">
                    <div class="nav-link-icon"><i data-feather="users"></i></div>
                    Anggota
                </a>
            <?php }
            ?>

            <?php
            if ($curr_page == 'users.php' || $curr_page == 'new-user.php' || $curr_page == 'user-update.php') { ?>
                <a class="nav-link active" href="users.php">
                    <div class="nav-link-icon"><i data-feather="user"></i></div>
                    Pengguna
                </a>
            <?php } else { ?>
                <a class="nav-link" href="users.php">
                    <div class="nav-link-icon"><i data-feather="user"></i></div>
                    Pengguna
                </a>
            <?php }
            ?>


            <a class="nav-link" href="comments.php">
                <div class="nav-link-icon"><i data-feather="package"></i></div>
                Komentar
            </a>
            <?php
            if ($curr_page == 'messages.php' || $curr_page == 'reply.php') { ?>
                <a class="nav-link active" href="messages.php">
                    <div class="nav-link-icon"><i data-feather="mail"></i></div>
                    Pesan
                </a>
            <?php } else { ?>
                <a class="nav-link" href="messages.php">
                    <div class="nav-link-icon"><i data-feather="mail"></i></div>
                    Pesan
                </a>
            <?php }
            ?>
        </div>
    </div>

    <div class="sidenav-footer">
        <div class="sidenav-footer-content">
            <div class="sidenav-footer-subtitle">Login sebagai:</div>
            <div class="sidenav-footer-title"><?= $_SESSION['user_name'] ?></div>
        </div>
    </div>

</nav>
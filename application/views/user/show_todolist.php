<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <link rel="icon" href="https://freeiconshop.com/wp-content/uploads/edd/list-flat.png" type="image/png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do list</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= base_url("assets/bootstrap/") ?>css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="js-sidebar">
            <!-- Content For Sidebar -->
            <div class="h-100" style="background: linear-gradient(45deg, rgba(0, 255, 255, 0.2), rgba(255, 255, 255, 0.2), rgba(152, 255, 152, 0.2));">
                <div class="sidebar-logo">
                    <a href="#">App To Do List</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Menu
                    </li>
                    <li class="sidebar-item">
                        <a href="<?= site_url('user/post_todolist') ?>" class="sidebar-link">
                            <i class="fa-solid fa-home pe-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#posts" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-gear pe-2"></i>
                            Setting
                        </a>
                        <ul id="posts" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="<?= base_url("auth") ?>" class="sidebar-link">Login</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="<?= base_url('auth/logout'); ?>" class="sidebar-link">Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="https://e7.pngegg.com/pngimages/527/663/png-clipart-logo-person-user-person-icon-rectangle-photography.png" class="avatar img-fluid rounded-circle" alt="">
                            </a>
                            <div class="dropdown-menu p-2 text-muted dropdown-menu-end" style="text-align: center;">
                                <img src="https://e7.pngegg.com/pngimages/527/663/png-clipart-logo-person-user-person-icon-rectangle-photography.png" class="avatar img-fluid rounded-circle" alt="" style=" position: center;">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $this->session->userdata('username'); ?> (<?php echo $this->session->userdata('bagian'); ?>)</h5>
                                    <p class="card-text"><?php echo $this->session->userdata('role'); ?></p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                        <div class="card text-center">
                          <div class="card-header">
                            <h3><?= $post_todolist->title ? html_escape($post_todolist->title) : "No Title" ?></h3>
                          </div>
                          <div class="card-body">
                            <p class="card-text" ><?= $post_todolist->content ?></p>
                          </div>
                          <div class="card-footer text-muted">
                            Published at <?= $post_todolist->created_at ?>
                          </div>
                    </div>
                </div>
            </main>
            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a href="#" class="text-muted">
                                    <strong>Aps version 1.0</strong>
                                </a>
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="<?= base_url("contact") ?>" onclick="tampilkanForm()" class="text-muted">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url("assets/bootstrap/") ?>js/script.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script type="text/javascript">
        $("#myTable").DataTable();
    </script>
</body>

</html>

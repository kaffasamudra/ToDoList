<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <link rel="icon" href="https://freeiconshop.com/wp-content/uploads/edd/list-flat.png" type="image/png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url("assets/bootstrap/") ?>css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="js-sidebar">
            <!-- Content For Sidebar -->
            <div class="h-100" style="background: linear-gradient(45deg, rgba(0, 255, 255, 0.2), rgba(255, 255, 255, 0.2), rgba(152, 255, 152, 0.2));">
                <div class="sidebar-logo">
                    <a href="#">Aps To Do List</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Admin Menu
                    </li>
                    <li class="sidebar-item">
                        <a href="<?= site_url('admin/dashboard') ?>" class="sidebar-link"><i class="fa-solid fa-list pe-2"></i>Overview</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="<?= site_url('admin/todolist') ?>" class="sidebar-link collapsed" data-bs-target="#pages"
                            aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                            To Do List
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="<?= site_url('admin/feedback') ?>" class="sidebar-link collapsed" data-bs-target="#auth" 
                            aria-expanded="false"><i class="fa-regular fa-user pe-2"></i>
                            Feedback
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#posts" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-sliders pe-2"></i>
                            Setting
                        </a>
                        <ul id="posts" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="<?= base_url('login'); ?>" class="sidebar-link">Login</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="<?= base_url('login/logout'); ?>" class="sidebar-link">Logout</a>
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
                                    <h5 class="card-title"><?php echo $this->session->userdata('user'); ?></h5>
                                    <p class="card-text"><?php //echo $this->session->userdata('role'); ?></p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="row">
                        <div class="mb-3">
                            <h4>To Do List</h4>
                        </div>

                        <!-- Table Element -->
	                    <div class="card border-0">
	                        <div class="card-header">
	                            <h5 class="card-title">
	                                Tabel To Do List
	                            </h5>
	                            <h6 class="card-subtitle text-muted">
	                                Pantau aktivitas karyawan
	                            </h6>
	                        </div>
	                        <div class="card-body">
	                            <table 	id="myTable" class="table table-striped" style="width:100%">
	                                <thead>
	                                    <tr>
	                                        <th scope="col">Judul</th>
	                                        <th scope="col">Tanggal</th>
	                                        <th scope="col">Aksi</th>
	                                    </tr>
	                                </thead>
	                                <tbody>
	                                    <?php foreach($todolist as $todolist): ?>
	                                    <tr>
	                                        <td>
	                                            <div><?= $todolist->title ?></div>
	                                        </td>
	                                        <td>
	                                            <div class="text-gray"><small><?= $todolist->created_at ?><small></div>
	                                        </td>
	                                        <td>
	                                            <div class="action">
	                                                <a href="<?= site_url('showtodolist/'.$todolist->slug) ?>" class="button button-small"  role="button">Preview</a>
	                                            </div>
	                                        </td>
	                                    </tr>
	                                    <?php endforeach ?>
	                                </tbody>
	                            </table>
	                        </div>
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
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <script src="<?= base_url("assets/bootstrap/") ?>js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
	<script type="text/javascript">
		new DataTable('#myTable', {
	    layout: {
	        topStart: {
	            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
	        }
	    }
	});
	</script>
</body>

</html>

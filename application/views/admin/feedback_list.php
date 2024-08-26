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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
                        <a href="<?= site_url('admin/dashboard') ?>" class="sidebar-link"><i class="fa-solid fa-home pe-2"></i>Overview</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="<?= site_url('admin/todolist') ?>" class="sidebar-link collapsed" data-bs-target="#pages"
                            aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                            To Do List
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="<?= site_url('admin/feedback') ?>" class="sidebar-link collapsed" data-bs-target="#auth" 
                            aria-expanded="false"><i class="fa-solid fa-list pe-2"></i>
                            Feedback
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#posts" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-gear pe-2"></i>
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
                <div class="row">
                    <div class="content">
    					<h1>Feedback</h1>
                        <div class="row row-cols-1 row-cols-md-3 g-4">
    						<?php foreach($feedbacks as $feedback): ?>
                              <div class="col">
                                <div class="card h-90">
                                    <div class="card-header">
                                        <b><?= $feedback->name ?></b> <small class="text-gray"><?= $feedback->email ?></small><div><small class="text-gray"><?= $feedback->created_at ?></small></div>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text"><?= $feedback->message ?></p>
                                        <a href="#" data-delete-url="<?= site_url('admin/feedback/delete/'.$feedback->id) ?>" class="btn btn-primary" role="button" onclick="deleteConfirm(this)">Delete</a>
                                    </div>
                                </div>
                              </div>
    						<?php endforeach ?>
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
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
		function deleteConfirm(event){
			Swal.fire({
				title: 'Delete Confirmation!',
				text: 'Are you sure to delete the item?',
				icon: 'warning',
				showCancelButton: true,
				cancelButtonText: 'No',
				confirmButtonText: 'Yes Delete',
				confirmButtonColor: 'red'
			}).then(dialog => {
				if(dialog.isConfirmed){
					window.location.assign(event.dataset.deleteUrl);
				}
			});
		}
	</script>
	<?php if($this->session->flashdata('message')): ?>
		<script>
			const Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000,
				timerProgressBar: true,
				didOpen: (toast) => {
					toast.addEventListener('mouseenter', Swal.stopTimer)
					toast.addEventListener('mouseleave', Swal.resumeTimer)
				}
			})

			Toast.fire({
				icon: 'success',
				title: '<?= $this->session->flashdata('message') ?>'
			})
		</script>
	<?php endif ?>
</body>

</html>

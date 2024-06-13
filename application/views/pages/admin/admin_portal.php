<body class="hold-transition login-page">

    <div class="login-box">

        <div class="card card-outline card-success">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>Your</b>System</a>
            </div>

            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <?php echo form_open("adminPages/login"); ?>
                <div class="input-group mb-3">
                    <input type="text" id="admin_username" name="admin_username" class="form-control"
                        placeholder="Username" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-solid fa-user text-success"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" id="admin_password" name="admin_password" class="form-control"
                        placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock text-success"></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col">
                        <button type="submit" class="btn btn-outline-success btn-block">Sign In</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
                <p class="mb-0">
                    <a href="#">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="#" class="badge badge-success">Visit Landing Page</a>
                </p>
            </div>
        </div>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                <?php echo $this->session->flashdata('error'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

    </div>

</body>

</html>
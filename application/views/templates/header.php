<html>
<head>
    <!-- Implementation of links, stylesheets, scripts -->
    <title>ciBlog</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <script src="http://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
</head>

<body>
    <!-- Navbar 1/3 Left -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary navbar-inverse">
        <div class="container">
            <div>
                <a class="navbar-brand" href="<?php echo base_url(); ?>">ciBlog</a>
            </div>

            <!-- Navbar 2/3 Middle -->
            <div id="navbar">
                <ul class="nav navbar-nav">
                    <li><a class="nav-link" href="<?php echo base_url(); ?>">Home</a></li>
                    <li><a class="nav-link" href="<?php echo base_url(); ?>about">About</a></li>
                    <li><a class="nav-link" href="<?php echo base_url(); ?>posts">Blog</a></li>
                    <li><a class="nav-link" href="<?php echo base_url(); ?>categories">Categories</a></li>
                </ul>
            </div>

            <!-- Navbar 3/3 Right -->
                <div>
                    <ul class="navbar navbar-nav navbar-dark">
                        <?php if(!$this->session->userdata('logged_in')) : ?>
                        <li><a class="nav-link" style="float: right" href="<?php echo base_url(); ?>users/login">Sign In!</a></li>
                        <li><a class="nav-link" style="float: right" href="<?php echo base_url(); ?>users/register">Sign Up!</a></li>
                        <?php endif; ?>
                        <?php if($this->session->userdata('logged_in')) : ?>
                        <li><a class="nav-link" style="float: right" href="<?php echo base_url(); ?>posts/create">Create Post</a></li>
                        <li><a class="nav-link" style="float: right" href="<?php echo base_url(); ?>categories/create">Create Category</a></li>
                        <li><a class="nav-link" style="float: right" href="<?php echo base_url(); ?>users/logout">Logout</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
        </div>
    </nav>
    <br>
    <div class="container">

<!-- Flash messages -->
<?php if($this->session->flashdata('user_registered')): ?>
    <?php echo '<p class="alert-success">'.$this->session->flashdata('user_registered').'</p>'; ?>
    <?php endif; ?>

    
    <?php if($this->session->flashdata('post_created')): ?>
    <?php echo '<p class="alert-success">'.$this->session->flashdata('post_created').'</p>'; ?>
    <?php endif; ?>

    <?php if($this->session->flashdata('post_updated')): ?>
    <?php echo '<p class="alert-success">'.$this->session->flashdata('post_updated').'</p>'; ?>
    <?php endif; ?>
    
    <?php if($this->session->flashdata('post_deleted')): ?>
    <?php echo '<p class="alert-success">'.$this->session->flashdata('post_deleted').'</p>'; ?>
    <?php endif; ?>

    <?php if($this->session->flashdata('category_created')): ?>
    <?php echo '<p class="alert-success">'.$this->session->flashdata('category_created').'</p>'; ?>
    <?php endif; ?>

    <?php if($this->session->flashdata('login_failed')): ?>
    <?php echo '<p class="alert-danger">'.$this->session->flashdata('login_failed').'</p>'; ?>
    <?php endif; ?>
    
    <?php if($this->session->flashdata('user_loggedin')): ?>
    <?php echo '<p class="alert-success">'.$this->session->flashdata('user_loggedin').'</p>'; ?>
    <?php endif; ?>
        
    <?php if($this->session->flashdata('user_loggedout')): ?>
    <?php echo '<p class="alert-success">'.$this->session->flashdata('user_loggedout').'</p>'; ?>
    <?php endif; ?>
            
    <?php if($this->session->flashdata('category_deleted')): ?>
    <?php echo '<p class="alert-success">'.$this->session->flashdata('category_deleted').'</p>'; ?>
    <?php endif; ?>




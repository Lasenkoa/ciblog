<h2><?= $title; ?></h2>

<?php echo validation_errors(); ?>

<center><?php echo form_open('users/register'); ?>
<div class="col-md-4" style="align-items: center">
    <label>Name</label>
    <input type="text" class="form-control" name="name" placeholder="Name">
</div>
<div class="col-md-4">
    <label>Zipcode</label>
    <input type="text" class="form-control" name="zipcode" placeholder="Zipcode">
</div>
<div class="col-md-4">
    <label>Email</label>
    <input type="text" class="form-control" name="email" placeholder="Email">
</div>
<div class="col-md-4">
    <label>Username</label>
    <input type="text" class="form-control" name="username" placeholder="Username">
</div>
<div class="col-md-4">
    <label>Password</label>
    <input type="password" class="form-control" name="password" placeholder="Password">
</div>
<div class="col-md-4">
    <label>Confirm Password</label>
    <input type="password" class="form-control" name="password2" placeholder="Confirm Password">
</div><br>
<button type="submit" class="btn btn-primary" >Submit</button>
<?php echo form_close(); ?></center>
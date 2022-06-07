<h2><?= $title ?></h2><br>
<?php foreach ($posts as $post) : ?>
    <h3><?php echo $post['title']; ?></h3>

    <div class="col-md-3">
        <small class="post-date">Posted on: <?php echo $post['created_at']; ?> in <strong><?php echo $post['name']; ?></strong></small><br>
        <img src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?>"><br>
    </div><br>

    <div class="col-md-9">
        <?php echo word_limiter($post['body'], 50); ?>
        <p><a class="btn btn-primary" href="<?php echo site_url('/posts/'.$post['slug']); ?>">Read More</a></p><br>
    </div>
    
<?php endforeach; ?>
<div class="pagination-links">
<?php echo $this->pagination->create_links(); ?></div>
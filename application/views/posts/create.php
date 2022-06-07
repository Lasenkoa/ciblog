<h2><?= $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('posts/create'); ?>
<div>
  <label>Title</label>
  <input type="text" class="form-control" name="title" placeholder="Add Title">
</div>
<div class="form-label">
  <label>Body</label>
  <textarea id="editor1" class="form-control" name="body" placeholder="Add Body"></textarea><br>
  <div class="form-group">
    <label>Category</label>
    <select name="category_id" class="form-control">
      <?php foreach($categories as $category): ?>
        <option value="<?php echo $category['id'] ?>"><?php echo $category['name']; ?></option>
        <?php endforeach; ?>
    </select><br>
  </div>
  <div class="form-group">
    <label>Upload Image</label><br>
    <input type="file" name="userfile" size="20">
  </div><br>
  <button type="submit" class="btn btn-primary">Submit</button>
</div>
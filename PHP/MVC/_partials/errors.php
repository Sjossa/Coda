<?php if (!empty($error)): ?>
  <?php foreach ($error as $value): ?>
    <div class="alert alert-danger mt-2" role="alert">
      <?php echo $value; ?>
    </div>
  <?php endforeach; ?>
<?php endif; ?>


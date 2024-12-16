<?php if(!empty($errors)): ?>
    <?php foreach($errors as $value): ?>
        <div class="alert alert-danger mt-2 text-center" role="alert">
            <?php echo $value; ?>
        </div>
    <?php endforeach;?>
<?php endif;?>
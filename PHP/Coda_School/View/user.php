<h1 class="text-center"><?php echo isset($_GET['id']) ? "Modification" : "Inscription";?></h1>
<form method="post">
    <div class="mb-3">
        <label for="name "class="form-label">Username</label>
        <input type="text" name="name" class="form-control" value="<?php echo isset($user['username']) ? $user['username'] : ''?>" required>
    </div>
    <div class="mb-3">
        <label for="mail" class="form-label">Email</label>
        <input type="email" name="mail" class="form-control" value="<?php echo isset($user['email']) ? $user['email'] : ''?>" required>
    </div>
    <div class="mb-3">
        <p>Les espaces sont interdit</p>
        <label for="pass" class="form-label">Password</label>
        <input type="password" class="form-control" id="pass" name="pass" <?php echo isset($_GET['id']) ? null : 'required'; ?>>
    </div>
    <div class="mb-3">
        <label for="cpassword" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="pass" name="cpassword" <?php echo isset($_GET['id']) ? null : 'required'; ?>>
    </div>
    <div class="mb-3 form-check">
        <label for="enable" class="form-check-label">Enable</label>
        <input
            type="checkbox"
            class="form-check-input"
            id="enable"
            name="enable"
            <?php echo ($user['id'] === $_SESSION['userId']) ? 'disabled' : null; ?>
            <?php echo isset($user['enabled']) && $user['enabled'] ? 'checked' : null; ?>>
    </div>
    <button
        type="submit"
        class="btn  <?php echo isset($_GET['id']) ? 'btn-success' : 'btn-primary'; ?>"
        name="<?php echo isset($_GET['id']) ? 'modif_button' : 'valid_button';?>">
        <?php echo isset($_GET['id']) ? 'Editer' : 'Crée';?>
    </button>
</form>

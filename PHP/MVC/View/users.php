<?php
/**
 * @var array $users
 */
?>

<h1>Liste des utilisateurs</h1>
<div class="row">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">
        <a href="index.php?component=users&sortby=id">ID</a>
        </th>
        <th scope="col"><a href="index.php?component=users&sortby=username">username </a>
</th>
        <th scope="col"><a href="index.php?component=users&sortby=email">email</a></th>
        <th scope="col"><a href="index.php?component=users&sortby=enabled">enabled</a> </th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user): ?>
        <tr>
          <td><?php echo $user['id']; ?></td>
          <td><?php echo $user['username']; ?></td>
          <td><?php echo $user['email']; ?></td>

          <td>
            <?php if ($user['id'] !== $_SESSION['user_id']): ?>
              <a href="index.php?component=users&action=toggle_enabled&id=<?php echo $user['id']; ?>">
                <i class="fa-solid <?php echo ($user['enabled']) ? "fa-check text-success" : "fa-xmark text-danger"; ?>"></i>
              </a>
            <?php else: ?>
              <i class="fa-solid <?php echo ($user['enabled']) ? "fa-check text-success" : "fa-xmark text-danger"; ?>"></i>
            <?php endif; ?>
          </td>
          <td>
            <?php if ($user['id'] !== $_SESSION['user_id']): ?>
              <a href="index.php?component=users&action=delete&id=<?php echo $user['id']; ?>" onclick="return confirm('Êtes-vous sûr ?');">
                <i class="fa-solid fa-trash text-danger"></i>
              </a>

              <?php endif; ?>
              <a href="index.php?component=user&action=edit&id=<?php echo $user['id']; ?>">
              <i class="fa-solid fa-pen-to-square ms-2"></i>
              </a>



          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<<?php
/**
 * @var array $users
 */
?>

<div class="mt-2 mb-2 d-flex justify-content-center align-items-center">
    <h1 class="text-center">Liste des utilisateurs</h1>
    <a href="index.php?component=user&action=new" class="ms-4 btn btn-primary">Nouveau Utilisateur <i class="fa-solid fa-plus"></i></a>
</div>
<div class="row">
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><a href="index.php?component=users&sortby=id&sens=asc">#</a></th>
            <th scope="col"><a href="index.php?component=users&sortby=username&sens=asc">Username</a></th>
            <th scope="col"><a href="index.php?component=users&sortby=email&sens=asc">Email</a></th>
            <th scope="col"><a href="index.php?component=users&sortby=enabled&sens=asc">Actif</a></th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user): ?>
            <tr>
                <td><?php echo $user['id'];?></td>
                <td><?php echo $user['username'];?></td>
                <td><?php echo $user['email'];?></td>
                <td>
                    <?php if($user['id'] !== $_SESSION['userId']): ?>
                        <a href="#">
                            <i class="fa-solid <?php echo ($user['enabled']) ? 'fa-check text-success' : 'fa-xmark text-danger'; ?> icon-link"
                               data-id="<?php echo $user['id'];?>"></i>
                        </a>
                    <?php else: ?>
                        <i class="fa-solid <?php echo ($user['enabled']) ? 'fa-check text-success' : 'fa-xmark text-danger'; ?>"
                           title="Vous ne pouvez pas desactiver votre compte">
                        </i>
                    <?php endif; ?>
                    <div class="spinner-border spinner-border-sm d-none spinner-enabled text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </td>
                <td>
                    <?php if($user['id'] !== $_SESSION['userId']): ?>
                        <a
                                href="index.php?component=users&action=delete&id=<?php echo $user['id'];?>"
                                onclick="return confirm('Etes vous sur de vouloir suprimer');"
                        >
                            <i class="fa-solid fa-trash text-danger"></i>
                        </a>
                    <?php endif; ?>
                    <a href="index.php?component=user&action=edit&id=<?php echo $user['id'];?>">
                        <i class="fa-solid fa-pen-to-square text-primary ms-2"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="./asset/js/components/user.js" type="module"></script>
<script type="module">
    import {UpdateUserEnabled} from "./asset/js/components/user.js";

    document.addEventListener('DOMContentLoaded', async () => {
        await UpdateUserEnabled()
    })
</script>
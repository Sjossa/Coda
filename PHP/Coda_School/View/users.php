<?php
/**
 * @var array   $users
 */
?>

<h1 class="text-center">Liste des utilisateurs</h1>
<div class="text-end me-5">
    <a href="index.php?component=user&action=create">
        <i class="fa-solid fa-user-plus fa-2xl" style="color: black"></i>
    </a>
</div>
<table class="table">
    <thead>
    <tr>
        <th scope="col"><a href="index.php?component=users&sortby=id">#</a></th>
        <th scope="col"><a href="index.php?component=users&sortby=username">Username</a></th>
        <th scope="col"><a href="index.php?component=users&sortby=email">Email</a></th>
        <th scope="col"><a href="index.php?component=users&sortby=enabled">Enable</a></th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach($users as $user) :?>
        <tr class="table align-middle">
            <td><?php echo$user['id']?></td>
            <td><?php echo$user['username']?></td>
            <td><?php echo$user['email']?></td>
            <td>
                <?php if ($user['id'] !== $_SESSION['user_id']) :?>
                <a href="index.php?component=users&action=toggle-enabled&id=<?php echo $user['id']?>">
                    <i
                            class="fa-solid
                            <?php
                                echo $user['enabled'] ?
                                    "fa-user-check text-success" :
                                    "fa-user-lock text-danger"
                            ?>"
                    >
                    </i>
                </a>
                <?php else : ?>

                    <i
                            class="fa-solid
                            <?php
                            echo $user['enabled'] ?
                                "fa-user-check text-success" :
                                "fa-user-lock text-danger"
                            ?>"
                            title="Vous ne pouvez pas désactiver le compte que vous utilisez"
                    >
                    </i>

                <?php endif; ?>
            </td>
            <td>
               <?php if ($user['id'] !== $_SESSION['user_id']) : ?>
                    <a
                            href="index.php?component=users&action=delete&id=<?php echo $user['id']?>"
                            onclick="return confirm('Êtes-vous sur de vouloir supprimer');"

                    >
                        <i class="fa-solid fa-trash text-danger"></i>
                    </a>
                <?php endif; ?>
                <a href="index.php?component=user&action=edit&id=<?php echo $user['id']?>">
                    <i class="fa-solid fa-user-pen"></i>
                </a>

            </td>

        </tr>
    <?php endforeach; ?>
    </tbody>


</table>

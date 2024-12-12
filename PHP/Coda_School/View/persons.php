<?php
/**
 * @var array   $persons
 */
?>
    <h1 class="text-center">Liste des personnes</h1>
    <div class="text-end me-5">
        <a href="index.php?component=user&action=create">
            <i class="fa-solid fa-user-plus fa-2xl" style="color: black"></i>
        </a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><a href="index.php?component=persons&sortby=id">#</a></th>
            <th scope="col"><a href="index.php?component=persons&sortby=last_name">Last Name</a></th>
            <th scope="col"><a href="index.php?component=persons&sortby=first_name">First Name</a></th>
            <th scope="col"><a href="index.php?component=persons&sortby=address">Address</a></th>
            <th scope="col"><a href="index.php?component=persons&sortby=type">Type</a></th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach($persons as $person) :?>
            <tr class="table align-middle">
                <td><?php echo$person['id']?></td>
                <td><?php echo$person['last_name']?></td>
                <td><?php echo$person['first_name']?></td>
                <td><?php echo$person['address']?></td>
                <td><?php echo $person['type'] === 1 ? "Elève" : "Enseignant"; ?></td>
                <td><a href="index.php?component=person&action=edit&id=<?php echo $person['id']?>">
                        <i class="fa-solid fa-user-pen"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php
/**
 * @var array $users
 * @var string $username
 */
?>
<div class="mt-2">
    <h1 class="fs-1"><?php echo $username?></h1>
</div>
<div class="mt-2">
    <p><i class="fa-solid fa-user text-primary"></i> <?php echo $users['nb'];?></p>
</div>
<div class="row mt-5">
    <div class="col-sm-6 mb-3 mb-sm-0">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Liste Utilisateurs</h5>
                <p class="card-text">Permet de voir la liste de tous les users de la base</p>
                <a href="index.php?component=users" class="btn btn-primary">Go Liste</a>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Ajouter un Utilisateur</h5>
                <p class="card-text">Vous permet d'ajouter des utilisateurs a votre base de donner</p>
                <a href="index.php?component=user&action=new" class="btn btn-primary">Go New</a>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-sm-6 mb-3 mb-sm-0">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Liste Persones</h5>
                <p class="card-text">Permet de voir la liste de toutes les persones</p>
                <a href="index.php?component=persons" class="btn btn-primary">Go Persones</a>
            </div>
        </div>
    </div>
</div>

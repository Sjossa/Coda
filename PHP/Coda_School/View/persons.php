<?php
/**
 * @var array $persons
 */
?>

<div class="mt-2 mb-2 d-flex justify-content-center align-items-center">
    <h1 class="text-center">Liste des personnes</h1>
    <a href="index.php?component=person&action=new" class="ms-4 btn btn-primary">Nouvelle Personnes <i class="fa-solid fa-plus"></i></a>
</div>
<div class="row">
    <div class="col d-flex justify-content-center">
        <div class="spinner-border text-primary d-none" role="status" id="spinner">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>
<div class="row">
    <table class="table" id="liste-person">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Lastname</th>
            <th scope="col">Firstname</th>
            <th scope="col">Address</th>
            <th scope="col">Zip_code</th>
            <th scope="col">City</th>
            <th scope="col">Phone</th>
            <th scope="col">Type</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<div class="row">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center" id="pagination">
        </ul>
    </nav>
</div>
<script src="./asset/js/components/persons.js" type="module"></script>
<script type="module">
    import {refreshPagePersons} from "./asset/js/components/persons.js"
    document.addEventListener('DOMContentLoaded', async () => {
        let curentPage = 1
        await refreshPagePersons(curentPage)
    })
</script>

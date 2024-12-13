<?php
/**
 * @var array   $persons
 */
?>
<h1 class="text-center">
    Liste des personnes
</h1>
<div class="d-flex justify-content-center">
<div class="spinner-border text-info d-none" role="status" id="spinner" >
</div>
</div>
<div class="text-end me-5">
    <a href="index.php?component=user&action=create">
        <i class="fa-solid fa-user-plus fa-2xl" style="color: black"></i>
    </a>
</div>
<table class="table" id="list-persons">
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



    </tbody>
</table>

<script src="./Assets/JavaScript/Services/person.js" type="module">

    </script>

    <script type="module">
        import {getPersons} from './Assets/JavaScript/Services/person.js'
    document.addEventListener('DOMContentLoaded', async () => {
alert('lol')

        const spinner = document.querySelector('#spinner')
        spinner.classList.remove('d-none')
    

        const data = await getPersons()

    })
</script>

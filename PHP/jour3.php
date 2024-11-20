<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mon formulaire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body cl>
    <div class="container">
        <form method="post">
            <div class="mb-3">
                <label for="lastname" class="form-label">Nom</label>
                <input type="text" name="lastname" id="lastname" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="firstname" class="form-label">Prénom</label>
                <input type="text" name="firstname" id="firstname" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Adresse</label>
                <textarea name="address" id="address" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="zipcode" class="form-label">Coda postal</label>
                <input type="text" name="zipcode" id="zipcode" class="form-control">
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">Ville</label>
                <input type="text" name="city" id="city" class="form-control">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Tél</label>
                <input type="text" name="phone" id="phone" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Valider</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
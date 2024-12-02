<?php
require "partie_back/article.php"
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Articles</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>

<body>
  <div class="container">
    <header class="d-flex justify-content-center py-3">
      <ul class="nav nav-pills">
        <li class="nav-item">
          <a href="#" class="nav-link active" aria-current="page">Home</a>
        </li>
        <li class="nav-item"><a href="#" class="nav-link">Features</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Pricing</a></li>
        <li class="nav-item"><a href="#" class="nav-link">FAQs</a></li>
        <li class="nav-item"><a href="#" class="nav-link">About</a></li>
      </ul>
    </header>

    <div class="row justify-content-center">
      <div class="col">
        <form method="post" class="w-100 d-flex justify-content-center">
          <input class="form-control form-control-lg w-75" type="text" placeholder="Saisir ici votre recherche"
            aria-label=".form-control-lg example">
          <button type="button" class="btn btn-outline-primary ms-1">OK</button>
        </form>
      </div>
    </div>
    <div class="row mt-5">
      <?php foreach ($articles as $article): ?>
        <div class="col-4 mb-4">
          <div class="card" style="width: 18rem;">
            <img src="<?php echo $article['image']; ?>" class="card-img-top" alt="Article Image" />
            <div class="card-body">
              <h5 class="card-title"><?php echo $article['titre']; ?></h5>
              <p class="card-text">
                <?php echo strlen($article['contenu']) > 100
                  ? substr($article['contenu'], 0, 100) . '...'
                  : $article['contenu']; ?>
              </p>
              <a href="index.php" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</body>

</html>


<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item disabled">
      <a class="page-link">Previous</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>

<ul class="nav col-md-4 justify-content-end">
  <li class="nav-item">
    <a href="#" class="nav-link px-2 text-body-secondary">Home</a>
  </li>
  <li class="nav-item">
    <a href="#" class="nav-link px-2 text-body-secondary">Features</a>
  </li>
  <li class="nav-item">
    <a href="#" class="nav-link px-2 text-body-secondary">Pricing</a>
  </li>
  <li class="nav-item">
    <a href="#" class="nav-link px-2 text-body-secondary">FAQs</a>
  </li>
  <li class="nav-item">
    <a href="#" class="nav-link px-2 text-body-secondary">About</a>
  </li>
</ul>
</footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

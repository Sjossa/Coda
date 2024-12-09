import {
  getMovieCard,
  getMovieDetails,
  getPopularMovies,
  getImagesDetails,
  IMAGE_URL,
} from "../services/movie.js";

document.addEventListener("DOMContentLoaded", async () => {
  // Initialisation des éléments DOM
  const contentElement = document.querySelector("#content");
  const previousBtnElement = document.querySelector("#previous-btn");
  const nextBtnElement = document.querySelector("#next-btn");
  const spinnerElement = document.querySelector("#spinner");
  const modalElement = document.querySelector("#modal");
  const modal = new bootstrap.Modal(modalElement);

  let currentPage = 1;

  // Fonction pour mettre à jour le contenu principal avec les films populaires
  const setHomeBody = (results) => {
    const homeBody = results.map(getMovieCard);
    contentElement.innerHTML = homeBody.join("");

    const moreInfoBtn = document.querySelectorAll(".more-info-btn");

    // Ajout des événements sur les boutons "plus d'infos"
    moreInfoBtn.forEach((btn) => {
      btn.addEventListener("click", async (e) => {
        e.preventDefault();
        const movieId = e.target.getAttribute("data-id");

        // Récupérer les détails du film et les images
        const movieDetails = await getMovieDetails(movieId);
        const imageDetails = await getImagesDetails(movieId);

        // Mettre à jour le titre de la modale
        modalElement.querySelector(".modal-title").textContent =
          movieDetails.title;

        const genres = movieDetails.genres
          .map(
            (genre) =>
              `<span class="badge text-bg-info ms-1 text-white">${genre.name}</span>`
          )
          .join("");

        // Insérer le corps principal dans la modale
        modalElement.querySelector(".modal-body").innerHTML = `

        <div id="carouselExample" class="carousel slide mt-3">
              <div class="carousel-inner"></div>
              <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </a>
            </div>

            <div>Durée (min): ${movieDetails.runtime}</div>
            ${genres}
            <div>${movieDetails.overview}</div>

          `;

        // Ajouter les images dans le carrousel
        const carouselInner = modalElement.querySelector(".carousel-inner");
        if (imageDetails && imageDetails.backdrops.length > 0) {
          imageDetails.backdrops.forEach((image, index) => {
            const isActive = index === 0 ? "active" : "";
            const carouselItem = `
                <div class="carousel-item ${isActive}">
                  <img
                    src="${IMAGE_URL}${image.file_path}"
                    class="d-block w-100"
                    alt="${movieDetails.title} image ${index + 1}">
                </div>
              `;
            carouselInner.insertAdjacentHTML("beforeend", carouselItem);
          });
        } else {
          carouselInner.innerHTML = `<p>Aucune image disponible</p>`;
        }

        // Afficher la modale
        modal.show();
      });
    });
  };

  // Fonction pour naviguer vers la page précédente
  previousBtnElement.addEventListener("click", async () => {
    if (currentPage > 1) {
      currentPage--;
      spinnerElement.classList.remove("d-none");
      const { results } = await getPopularMovies(currentPage);
      setHomeBody(results);
      spinnerElement.classList.add("d-none");
    } else {
      alert("Vous avez atteint la première page");
    }
  });

  // Fonction pour naviguer vers la page suivante
  nextBtnElement.addEventListener("click", async () => {
    currentPage++;
    spinnerElement.classList.remove("d-none");
    const { results } = await getPopularMovies(currentPage);
    setHomeBody(results);
    spinnerElement.classList.add("d-none");
  });

  // Chargement initial des films populaires
  spinnerElement.classList.remove("d-none");
  const { results } = await getPopularMovies();
  setHomeBody(results);
  spinnerElement.classList.add("d-none");
});

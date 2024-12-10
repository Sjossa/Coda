import {
  getMovieCard,
  getMovieDetails,
  getMovieImages,
  getPopularMovies,
  IMAGE_URL,
} from "../services/movie.js";

export const getCarousel = (images) => {
  const imagesBody = [];

  for (let i = 0; i < images.length; i++) {
    imagesBody.push(`<div class="carousel-item ${
      i === 0 ? "active" : ""
    }"><img src="${IMAGE_URL}${images[i].file_path}"
                            class="d-block w-100" alt="..."></div>`);
  }

  return `<div id="carousel" class="carousel slide">
                  <div class="carousel-inner">
                    ${imagesBody.join("")}
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div>`;
};

export const getMovieModal = async (movieId) => {
  const modalElement = document.querySelector("#modal");
  const modal = new bootstrap.Modal(modalElement);
  const movieDetails = await getMovieDetails(movieId);
  const images = await getMovieImages(movieId);

  const carouselElement = getCarousel(images.backdrops);

  modalElement.querySelector(".modal-title").innerHTML = movieDetails.title;

  const genres = movieDetails.genres.map(
    (genre) =>
      `<span class="badge text-bg-info ms-1 text-white">${genre.name}</span>`
  );

  modalElement.querySelector(".modal-body").innerHTML = `
                      ${carouselElement}
                      ${genres.join("")}
                      <div class="mt-2 mb-2">Durée (min): ${
                        movieDetails.runtime
                      }</div>
                      <div>${movieDetails.overview}</div>
                      <i class="fa-regular ms-5 fa-heart color-text-danger like" id="like" data-id="${movieId}"></i>`;

  const carousel = new bootstrap.Carousel("#carousel", { interval: 2000 });
  carousel.cycle();
  modal.show();

  // Charger les films aimés depuis localStorage
  let Tableau = JSON.parse(localStorage.getItem("tableau")) || [];

  // Sélectionner l'icône de like
  const likeButton = modalElement.querySelector(".like");

  if (Tableau.includes(movieId)) {
    likeButton.style.backgroundColor = "red";
  }

  // Ajouter un écouteur d'événements pour le bouton like
  likeButton.addEventListener("click", () => {
    if (Tableau.includes(movieId)) {
      Tableau = Tableau.filter((id) => id !== movieId);
      likeButton.style.backgroundColor = "";
    } else {
      Tableau.push(movieId);
      likeButton.style.backgroundColor = "red";
    }

    // Sauvegarder le tableau mis à jour dans le localStorage
    let t_JSON = JSON.stringify(Tableau);
    localStorage.setItem("tableau", t_JSON);
  });

};

document.addEventListener("DOMContentLoaded", async () => {
  const contentElement = document.querySelector("#content");
  const previousBtnElement = document.querySelector("#previous-btn");
  const nextBtnElement = document.querySelector("#next-btn");
  const spinnerElement = document.querySelector("#spinner");

  let currentPage = 1;

  const setHomeBody = (results) => {
    const homeBody = [];

    for (let i = 0; i < results.length; i++) {
      homeBody.push(getMovieCard(results[i]));
    }

    contentElement.innerHTML = homeBody.join("");

    const likes = document.querySelectorAll(".like");

    let Tableau = JSON.parse(localStorage.getItem("tableau")) || [];

    likes.forEach((like) => {
      const movieId = like.getAttribute("data-id");
      if (Tableau.includes(movieId)) {
        like.style.backgroundColor = "red";
      }
    });



    for (let i = 0; i < likes.length; i++) {
      likes[i].addEventListener("click", (e) => {
        const movieId = e.target.getAttribute("data-id");


        if (e.target.style.backgroundColor === "red") {
          e.target.style.backgroundColor = "";

          Tableau = Tableau.filter((id) => id !== movieId);
        } else {
          e.target.style.backgroundColor = "red";

          Tableau.push(movieId);
        }




        let t_JSON = JSON.stringify(Tableau);
        localStorage.setItem("tableau", t_JSON);
      });
    }

    console.log(Tableau);

    const moreInfoBtn = document.querySelectorAll(".more-info-btn");

    for (let i = 0; i < moreInfoBtn.length; i++) {
      moreInfoBtn[i].addEventListener("click", async (e) => {
        e.preventDefault();
        const movieId = e.target.getAttribute("data-id");
        await getMovieModal(movieId);
      });
    }
  };

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

  nextBtnElement.addEventListener("click", async () => {
    currentPage++;
    spinnerElement.classList.remove("d-none");
    const { results } = await getPopularMovies(currentPage);
    setHomeBody(results);
    spinnerElement.classList.add("d-none");
  });

  spinnerElement.classList.remove("d-none");
  const { results } = await getPopularMovies();
  setHomeBody(results);
  spinnerElement.classList.add("d-none");
});

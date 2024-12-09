import { getMovieCard, getPopularMovies, getMovieDetails } from "../services/movie.js";

document.addEventListener("DOMContentLoaded", async () => {
  const contentElement = document.querySelector("#content");
  const buttonElement = document.querySelector("#after");
  const button2Element = document.querySelector("#previous");
  let page = 1;

  // Fonction pour afficher les films dans la page
  const setHomeBody = (movies) => {
    const homeBody = movies.map((movie) => getMovieCard(movie)).join('');
    contentElement.innerHTML = homeBody;

    // Ajouter un événement de clic sur chaque bouton "Plus d'infos"
    const moreInfoButtons = document.querySelectorAll('.more-info-btn');
    moreInfoButtons.forEach((button) => {
      button.addEventListener('click', (e) => {
        const movieId = e.target.getAttribute('data-id');  // Récupère l'ID du film à partir de l'attribut data-id
        showMovieDetails(movieId);  // Appelle la fonction pour afficher les détails du film
      });
    });
  };

  const showMovieDetails = async (movieId) => {
    const movieDetails = await getMovieDetails(movieId);
    console.log(movieDetails);

  };


  const { results } = await getPopularMovies(page);
  setHomeBody(results);

  buttonElement.addEventListener("click", async () => {
    page++;
    const { results } = await getPopularMovies(page);
    setHomeBody(results);
  });

  button2Element.addEventListener("click", async () => {
    if (page > 1) {
      page--;
      const { results } = await getPopularMovies(page);
      setHomeBody(results);
    } else {
      alert("Vous êtes déjà à la première page !");
    }
  });
});

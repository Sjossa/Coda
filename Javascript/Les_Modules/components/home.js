import { getMovieCard,getPopularMovies } from "../services/movie.js";

document.addEventListener("DOMContentLoaded", async() => {
  const contentElement = document.querySelector("#content")
  const {results} =  await getPopularMovies()
  const buttonElement = document.querySelector("#after")
  const button2Element = document.querySelector("#previous")
  const homebody = []

  let page = 1

  for (let i = 0; i < results.length; i++) {
  homebody.push(getMovieCard(results[i]))
  }

  contentElement.innerHTML = homebody.join('')



  buttonElement.addEventListener("click", async () => {
    page++;
    const { results } = await getPopularMovies(page); // Ajout de la page à la requête
    const homebody = results.map(result => getMovieCard(result));
    contentElement.innerHTML = homebody.join('');
  });

  button2Element.addEventListener("click", async () => {
    if (page > 1) {
      page--;
      const { results } = await getPopularMovies(page); 
      const homebody = results.map(result => getMovieCard(result));
      contentElement.innerHTML = homebody.join('');
    } else {
      alert("Vous êtes déjà à la première page !");
    }
  });


});

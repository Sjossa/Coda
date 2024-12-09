const API_KEY =
  "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI0NGU5ZTkzYWY5ZmRkMDUyODFkNzlmNzYxMGFiNTk5NiIsIm5iZiI6MTczMzQ2NzA3OS44NSwic3ViIjoiNjc1MjliYzc4MGU1YjhmMGE3NTYyYTc4Iiwic2NvcGVzIjpbImFwaV9yZWFkIl0sInZlcnNpb24iOjF9.Ql9azWT9FNOcTzg9M4VC1983N_XuxqwpMXPn2zBRodc";
const IMAGE_URL = "https://image.tmdb.org/t/p/original/";

// Récupérer les films populaires
export const getPopularMovies = async (page = 1) => {
  const response = await fetch(
    `https://api.themoviedb.org/3/movie/popular?language=fr-CA&include_image_language=fr-CA&page=${page}`,
    {
      headers: {
        Authorization: `Bearer ${API_KEY}`,
      },
    }
  );
  return await response.json();
};

// Récupérer les détails d'un film spécifique
export const getMovieDetails = async (movieId) => {
  const response = await fetch(
    `https://api.themoviedb.org/3/movie/${movieId}?api_key=${API_KEY}&language=fr-CA`,
    {
      headers: {
        Authorization: `Bearer ${API_KEY}`,
      },
    }
  )
  const data = await response.json();
  return data;
};

// Générer la carte d'un film
export const getMovieCard = (movie) => {
  return `<div class="col-3 mb-4">
    <div class="card" style="width: 18rem;">
      <img src="${IMAGE_URL}${movie.poster_path}" class="card-img-top" alt="${movie.title}">
      <div class="card-body">
        <h5 class="card-title">${movie.title}</h5>
        <p class="card-text">${movie.overview.substring(0, 100)}</p>
        <a href="#" class="btn btn-primary more-info-btn" data-id="${movie.id}">+ d'info</a>
      </div>
    </div>
  </div>`;
};

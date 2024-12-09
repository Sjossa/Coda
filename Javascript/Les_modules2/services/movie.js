const API_KEY =
  "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI0NGU5ZTkzYWY5ZmRkMDUyODFkNzlmNzYxMGFiNTk5NiIsIm5iZiI6MTczMzQ2NzA3OS44NSwic3ViIjoiNjc1MjliYzc4MGU1YjhmMGE3NTYyYTc4Iiwic2NvcGVzIjpbImFwaV9yZWFkIl0sInZlcnNpb24iOjF9.Ql9azWT9FNOcTzg9M4VC1983N_XuxqwpMXPn2zBRodc";
export const IMAGE_URL = `https://image.tmdb.org/t/p/original`;

// Récupérer les films populaires
export const getPopularMovies = async (page = 1) => {
  const response = await fetch(
    `https://api.themoviedb.org/3/movie/popular?page=${page}&language=fr-FR`,
    {
      method: "GET",
      headers: {
        Authorization: `Bearer ${API_KEY}`,
      },
    }
  );

  return await response.json();
};

// Récupérer les détails d'un film
export const getMovieDetails = async (id) => {
  const response = await fetch(
    `https://api.themoviedb.org/3/movie/${id}?language=fr-CI`,
    {
      method: "GET",
      headers: {
        Authorization: `Bearer ${API_KEY}`,
      },
    }
  );

  return await response.json();
};

// Récupérer les images d'un film
export const getImagesDetails = async (id) => {
  const response = await fetch(
    `https://api.themoviedb.org/3/movie/${id}/images`,
    {
      method: "GET",
      headers: {
        Authorization: `Bearer ${API_KEY}`,
      },
    }
  );
  return await response.json();
};

// Générer la carte d'un film
export const getMovieCard = (movie) => {
  return `<div class="col-3 mt-3">
            <div class="card" style="width: 18rem;">
              <img src="${IMAGE_URL}${
    movie.poster_path
  }" class="card-img-top" alt="..." >
              <div class="card-body">
                <h5 class="card-title">${movie.title}</h5>
                <p class="card-text">${movie.overview.substring(0, 100)} ...</p>
                <a href="#" class="btn btn-primary more-info-btn" data-id="${
                  movie.id
                }">+ d'infos</a>
              </div>
            </div></div>`;
};

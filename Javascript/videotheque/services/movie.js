const API_KEY =
  "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIwNjE3ODRlY2VmMzVjNmY3YmUzOTc5MDM0NGY5NjNlMyIsIm5iZiI6MTUzOTI3MDczNC40MDgsInN1YiI6IjViYmY2ODRlOTI1MTQxNzljYTAwMDQ5YyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.cdEdt4PLTDzUKFU1qFZgJ2Ze4q4CUasQVRfKFpsP1cs";
export const IMAGE_URL = `https://image.tmdb.org/t/p/original`;
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

export const getMovieDetails = async (id) => {
  const response = await fetch(
    `https://api.themoviedb.org/3/movie/${id}?language=fr-FR`,
    {
      method: "GET",
      headers: {
        Authorization: `Bearer ${API_KEY}`,
      },
    }
  );

  return await response.json();
};

export const getMovieImages = async (id) => {
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
                }">+ d'infos  </a>
                <i class="fa-regular ms-5 fa-heart color-text-danger like" data-id="${
                  movie.id
                }"></i>
              </div>
            </div></div>`;
};

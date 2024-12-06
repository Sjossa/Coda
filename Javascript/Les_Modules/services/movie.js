const API_KEY =
  "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI0NGU5ZTkzYWY5ZmRkMDUyODFkNzlmNzYxMGFiNTk5NiIsIm5iZiI6MTczMzQ2NzA3OS44NSwic3ViIjoiNjc1MjliYzc4MGU1YjhmMGE3NTYyYTc4Iiwic2NvcGVzIjpbImFwaV9yZWFkIl0sInZlcnNpb24iOjF9.Ql9azWT9FNOcTzg9M4VC1983N_XuxqwpMXPn2zBRodc"; //changer par votre API

const IMAGE_URL = "https://image.tmdb.org/t/p/original/";

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


export const getMovieCard = (movie) => {
  return `<div class="col-3 mb-4">
  <div class="card" class="me-3" style="width: 18rem;">
  <img src="${IMAGE_URL}${movie.poster_path}" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">${movie.title}</h5>
    <p class="card-text">${movie.overview.substring(0, 100)}</p>
    <a href="#" class="btn btn-primary"> + d'info</a>
  </div>
</div>
</div>`;







};

import {getMovieModal} from "./home.js";

const API_KEY = 'eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIwNjE3ODRlY2VmMzVjNmY3YmUzOTc5MDM0NGY5NjNlMyIsIm5iZiI6MTUzOTI3MDczNC40MDgsInN1YiI6IjViYmY2ODRlOTI1MTQxNzljYTAwMDQ5YyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.cdEdt4PLTDzUKFU1qFZgJ2Ze4q4CUasQVRfKFpsP1cs'

const autoCompleteJS = new autoComplete({
    selector: '#search',
    threshold: 2,
    data: {
        src: async (query) => {a
           const response = await fetch(
               `https://api.themoviedb.org/3/search/movie?query=${query}&language=fr-FR`,
               {
                   headers: {
                       Authorization: `Bearer ${API_KEY}`
                   }
               }
           )
            const data = await response.json()
            return data.results
        },
        keys: ['title']
    }
})

autoCompleteJS.input.addEventListener('selection', async (e) => {

    await getMovieModal(e.detail.selection.value.id)
    document.querySelector('#search').value = e.detail.selection.match
})

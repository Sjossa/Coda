import {countPage, getPersons} from "../services/persons.js";

const getRowPerson = (person) => {
    const line = document.createElement('tr')
    line.innerHTML = `
    <td>${person.id}</td>
    <td>${person.last_name}</td>
    <td>${person.first_name}</td>
    <td>${person.address}</td>
    <td>${person.zip_code}</td>
    <td>${person.city}</td>
    <td>${person.phone}</td>
    <td>${person.type === 1 ? 'Eleve' : 'Prof'}</td>
    <td></td>
    `
    return line
}

export const refreshPagePersons = async (page) => {
    const spinner = document.querySelector('#spinner')
    const tableElement = document.querySelector('#liste-person')
    const tbody = tableElement.querySelector('tbody')

    spinner.classList.remove('d-none')

    const data = await getPersons(page)
    tbody.innerHTML = ''
    for (let i = 0; i < data.results.length; i++) {
        tbody.appendChild(getRowPerson(data.results[i]))
    }
    getPagination(data.count.nbPersons, page)
    spinner.classList.add('d-none')
}

const getPagination = (total, page) => {
    const nbPage = countPage(total)
    const paginationElement = document.querySelector('#pagination')
    paginationElement.innerHTML = ''
    paginationElement.innerHTML += '<li class="page-item"><a class="page-link" href="#" id="prev-link">Previous</a></li>'

    for(let i = 0; i < nbPage; i++) {
        const PagNbElement = `<li class="page-item"><a class="page-link nb-page-link" href="#" data-page="${i+1}">${i+1}</a></li>`
        paginationElement.innerHTML += PagNbElement
    }
    paginationElement.innerHTML += '<li class="page-item"><a class="page-link" href="#" id="next-link">Next</a></li>'
    handlePaginationClick(page)
}

const handlePaginationClick = (curentPage) => {
    const nextLink = document.querySelector('#next-link')
    const previousLink = document.querySelector('#prev-link')
    const nbPageLink = document.querySelectorAll('.nb-page-link')

    previousLink.addEventListener('click', async () => {
        if(curentPage > 1) {
            curentPage--
            await refreshPagePersons(curentPage)
        }
    })
    nextLink.addEventListener('click', async () => {
        curentPage++
        await refreshPagePersons(curentPage)
    })

    nbPageLink.forEach(btn => {
        btn.addEventListener('click', async (e) => {
            await refreshPagePersons(e.target.getAttribute("data-page"))
        })
    })
}
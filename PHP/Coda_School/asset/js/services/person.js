export const autoCompleteAddress = async (adressValue) => {
    const res = await fetch(`https://api-adresse.data.gouv.fr/search/?q=${adressValue}&type=housenumber&autocomplete=1`, {
        method: 'GET'
    })
    return res.json()
}

export const createPerson = async (form) => {
    const data = new FormData(form)

    const res = await fetch(`index.php?component=person&action=new`, {
        method: 'POST',
        body: data,
        headers: {
            'X-Requested-Width': 'XMLHttpRequest'
        }
    })

    return res.json()
}

export const updatePerson = async (form, id) => {
    const data = new FormData(form)

    const res = await fetch(`index.php?component=person&action=edit&id=${id}`, {
        method: 'POST',
        body: data,
        headers: {
            'X-Requested-Width': 'XMLHttpRequest'
        }
    })

    return res.json()
}
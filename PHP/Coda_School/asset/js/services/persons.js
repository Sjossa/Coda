export const getPersons = async (page = 1) => {
    const res = await fetch(`index.php?component=persons&page=${page}`, {
        headers: {
            'X-Requested-Width': 'XMLHttpRequest'
        }
    })
    return await res.json()
}

export const countPage = (total) => {
    return Math.ceil(total/20)
}
export const toogleUser = async (id) => {
    const res = await fetch(`index.php?component=users&action=toogle_enabled&id=${id}`, {
        method: 'GET',
        headers: {
            'X-Requested-Width': 'XMLHttpRequest'
        }
    })
    return await res.json()
}
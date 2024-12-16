export const toogleUser = async (id) => {
    const res = await fetch(`index.php?component=users&action=toogle_enabled&id=${id}`, {
        method: 'GET',
        headers: {
            "Content-Type": "application/json"
        }
    })
    return await res.json()
}
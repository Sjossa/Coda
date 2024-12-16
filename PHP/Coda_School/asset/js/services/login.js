export const login = async (username, password) => {
    const res = await fetch('index.php?component=login', {
        method: 'POST',
        body: new URLSearchParams({
            username: username,
            password: password
        })
    })
    return await res.json()
}
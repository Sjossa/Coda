export const getPersons = async () =>{
const response = await fetch('index.php?component=persons')
return await response.json()
}

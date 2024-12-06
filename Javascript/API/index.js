document.addEventListener("DOMContentLoaded", () => {
  const searchBtnElement = document.querySelector("#btn-search");
  const listElement = document.querySelector("#search-result-list");
  const spinnerElement = document.querySelector("#spinner");
  const zipCodeElement = document.querySelector("#zip-code");
  const formElement = document.querySelector("#form")

  zipCodeElement.addEventListener("keypress", (e) => {
    e.preventDefault();
    console.log(e.keyCode);
  });

  formElement.addEventListener("submit", async (e) => {
    e.preventDefault()
    const zipCodeValue = document.querySelector("#zip-code").value;

    if (zipCodeValue.length === 5) {
      spinnerElement.classList.remove("d-none");
      searchBtnElement.Disabled = false;
      const result = await fetch(
        `https://apicarto.ign.fr/api/codes-postaux/communes/${zipCodeValue}`,
        {
          method: "GET",
        }
      );

      if (result.ok) {
        const data = await result.json();
        listElement.innerHTML = "";

        for (let i = 0; i < data.length; i++) {
          const liElement = document.createElement("li");
          liElement.classList.add("list-group-item");
          liElement.innerHTML = `${data[i].nomCommune} (${data[i].codePostal})`;
          listElement.appendChild(liElement);
        }
      }
      searchBtnElement.Disabled = false;
      spinnerElement.classList.add("d-none");
    }
  });
});

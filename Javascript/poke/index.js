document.addEventListener("DOMContentLoaded", () => {
  const buttonElement = document.querySelector("#button");
  const button2Element = document.querySelector("#button2");
  const divElement = document.querySelector("#texte");
  const pageInfo = document.querySelector("#page-info");

  let page = 1;

  async function fetchArticles() {
    const urlElement = `https://newsapi.org/v2/everything?q=Disney&language=fr&pageSize=10&page=${page}&apiKey=da80f07b7b90409da2ca41d013f6221e`;
    const result = await fetch(urlElement);

    if (result.ok) {
      const data = await result.json();
      const articles = data.articles;

      let resultsHtml = "";
      articles.forEach((article, index) => {
        const author = article.author || "Auteur inconnu";
        const title = article.title || "Titre non disponible";
        const description = article.description || "Description non disponible";
        const sourceName = article.source.name || "Source inconnue";

        resultsHtml += `
          <div class="result-item" style="padding: 10px; border: 1px solid #ddd; margin: 5px 0;">
            <p>${index + 1}: <strong>${author}</strong></p>
            <p><strong>${title}</strong></p>
            <p>${description}</p>
            <p>Source: <strong>${sourceName}</strong></p>
          </div>
        `;
      });

      divElement.innerHTML = resultsHtml;
      pageInfo.textContent = `Page actuelle : ${page}`;
    } else {
      console.error(`Erreur : ${result.status} - ${result.statusText}`);
      divElement.innerHTML = `<p style="color: red;">Erreur lors de la récupération des données.</p>`;
    }
  }

  buttonElement.addEventListener("click", () => {
    page++;
    fetchArticles();
  });

  button2Element.addEventListener("click", () => {
    if (page > 1) {
      page--;
      fetchArticles();
    } else {
      alert("Vous êtes déjà à la première page !");
    }
  });

  fetchArticles();
});

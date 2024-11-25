function toggleMenu() {
  const menu = document.querySelector(".menu");
  menu.classList.toggle("active");
}

$(document).ready(function () {
  // Initialisation du slider sans les boutons par défaut
  var slider = $(".slide").bxSlider({
    mode: "vertical", // Mode vertical
    slideWidth: 500, // Largeur des slides
    startSlide: 0, // Démarre à la première slide
    infiniteLoop: false,
    slideMargin: 10, // Marge entre les slides
    minSlides: 3, // Affiche 3 slides minimum
    controls: false, // Désactive les boutons de navigation par défaut
    pager: false, // Désactive les boutons de pagination
  });

  // Ajout de votre propre bouton "précédent"
  $("#prevButton").click(function () {
    slider.goToPrevSlide();
  });

  // Ajout de votre propre bouton "suivant"
  $("#nextButton").click(function () {
    slider.goToNextSlide();
  });
});

const playButton = document.getElementById("playButton");
const video = document.getElementById("myVideo");



document.querySelector(".click").addEventListener("click", function () {
  const text = this.querySelector(".hidden-text");
  text.style.display = text.style.display === "none" ? "block" : "none";
});

document.addEventListener("DOMContentLoaded", () => {
  const nextBtn = document.querySelector("#next-btn");
  const prevBtn = document.querySelector("#previous-btn");
  const barElement = document.querySelector(".progress-bar");

  const parentForm = document.querySelector('.tab-content');
  const enfantForm = document.querySelectorAll('formulaire')

  let formulaire = 0

  let progressValue = 0;

  prevBtn.disabled = true;

  const updateBar = (value) => {
    if (barElement) {
      barElement.style.width = `${value}%`;
      barElement.innerHTML = `${value}%`;
      console.log(` ${value}%`);
    } else {
      console.error("erreur");
    }
  };

  const updateButton = (value) => {
    nextBtn.disabled = value >= 100;
    prevBtn.disabled = value <= 0;
  };

  const forms = document.querySelectorAll("form");

  nextBtn.addEventListener("click", () => {
    progressValue = Math.min(progressValue + 10, 100);
    updateButton(progressValue);
    updateBar(progressValue);
    

  });

  prevBtn.addEventListener("click", () => {
    progressValue = Math.max(progressValue - 10, 0);
    updateButton(progressValue);
    updateBar(progressValue);
  });
});



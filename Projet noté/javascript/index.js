document.addEventListener("DOMContentLoaded", () => {
  const nextBtn = document.querySelector("#next-btn");
  const prevBtn = document.querySelector("#previous-btn");
  const barElement = document.querySelector(".progress-bar");

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

  const updateButtonStates = (value) => {
    nextBtn.disabled = value >= 100;
    prevBtn.disabled = value <= 0;
  };

  const forms = document.querySelectorAll("form");

  nextBtn.addEventListener("click", () => {
    progressValue = Math.min(progressValue + 10, 100);
    updateButtonStates(progressValue);
    updateBar(progressValue);
  });

  prevBtn.addEventListener("click", () => {
    progressValue = Math.max(progressValue - 10, 0);
    updateButtonStates(progressValue);
    updateBar(progressValue);
  });
});

nextBtn.addEventListener("click", () => {
  console.log("lol");
});

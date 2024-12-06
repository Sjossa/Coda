document.addEventListener("DOMContentLoaded", () => {
  const btnStep1Element = document.querySelector("#btn-step-1");
  const formStep1Element = document.querySelector("#form-step-1");
  const collapseOneElement = document.querySelector("#collapse-one");
  const collapseOneBtnElement = document.querySelector("#collapse-one-btn");

  const collapseTwoElement = document.querySelector("#collapse-two");
  const collapseTwoBtnElement = document.querySelector("#collapse-two-btn");
  const btnStep2Element = document.querySelector("#btn-step-2");
  const formStep2Element = document.querySelector("#form-step-2");

  const collapseThreeElement = document.querySelector("#collapse-three");
  const collapseThreeBtnElement = document.querySelector("#collapse-three-btn");
  const btnStep3Element = document.querySelector("#btn-step-3");
  const formStep3Element = document.querySelector("#form-step-3");

  const needDentalCheckboxElement = document.querySelector("#need-dental");
  const form3DentalSolutionsElement = document.querySelector(
    "#form-3-dental-solutions"
  );

  const toastMessageElement = document.querySelector("#toast-message");
  const toastMessage = new bootstrap.Toast(toastMessageElement);

  const modalElement = document.querySelector("#modal");
  const modal = new bootstrap.Modal(modalElement);

  const validElement = document.querySelector("#valid");
  const falsedElement = document.querySelector("#false");
  const retryElement = document.querySelector("#retry");








  const showNextStep = (currentCollapse, nextCollapse, currentBtn, nextBtn) => {
    currentCollapse.classList.remove("show");
    currentBtn.classList.add("collapsed");
    currentBtn.setAttribute("aria-expanded", false);
    currentBtn.disabled = true;

    nextCollapse.classList.add("show");
    nextBtn.classList.remove("collapsed");
    nextBtn.setAttribute("aria-expanded", true);
    nextBtn.disabled = false;
  };

  needDentalCheckboxElement.addEventListener("change", (e) => {
    if (e.target.checked) {
      form3DentalSolutionsElement.classList.remove("d-none");
    } else {
      form3DentalSolutionsElement.classList.add("d-none");
    }
  });

  const hasPartnerRadioBtnElements = document.querySelectorAll(
    'input[type=radio][name="has-partner"]'
  );

  hasPartnerRadioBtnElements.forEach((hasPartnerRadioBtn) => {
    hasPartnerRadioBtn.addEventListener("change", (event) => {
      if (event.target.value === "true") {
        formStep2Element.elements["partner_lastname"].disabled = false;
        formStep2Element.elements["partner_lastname"].required = true;

        formStep2Element.elements["partner_firstname"].disabled = false;
        formStep2Element.elements["partner_firstname"].required = true;
      } else {
        formStep2Element.elements["partner_lastname"].disabled = true;
        formStep2Element.elements["partner_lastname"].required = false;
        formStep2Element.elements["partner_lastname"].value = "";

        formStep2Element.elements["partner_firstname"].disabled = true;
        formStep2Element.elements["partner_firstname"].required = false;
        formStep2Element.elements["partner_firstname"].value = "";
      }
    });
  });

  btnStep1Element.addEventListener("click", () => {
    if (!formStep1Element.checkValidity()) {
      formStep1Element.reportValidity();
      return false;
    }

    showNextStep(collapseOneElement, collapseTwoElement, collapseOneBtnElement, collapseTwoBtnElement);



    updateProgressBar(33);
  });

  btnStep2Element.addEventListener("click", () => {
    if (!formStep2Element.checkValidity()) {
      formStep2Element.reportValidity();
      return false;
    }

    showNextStep(collapseTwoElement, collapseThreeElement, collapseTwoBtnElement, collapseThreeBtnElement);



    updateProgressBar(66);
  });

  const updateProgressBar = (value) => {
    const progressElement = document.querySelector("#form-progress");
    const progressBarElement = progressElement.querySelector(".progress-bar");

    progressElement.setAttribute("aria-valuenow", value);
    progressBarElement.style.width = `${value}%`;
    progressBarElement.innerHTML = `${value}%`;
  };

  btnStep3Element.addEventListener("click", () => {
    if (!formStep3Element.checkValidity()) {
      formStep3Element.reportValidity();
      return false;
    }

    collapseThreeElement.classList.remove("show");
    collapseThreeBtnElement.classList.add("collapsed");
    collapseThreeBtnElement.setAttribute("aria-expanded", false);
    collapseThreeBtnElement.disabled = true;

    updateProgressBar(100);

    // Afficher la modale pour confirmation
    modal.show();
  });

  // Gestion du bouton "Oui" dans la modale
  validElement.addEventListener("click", () => {
    // Réinitialisation du formulaire
    document.querySelector("#form-step-1").reset();
    document.querySelector("#form-step-2").reset();
    document.querySelector("#form-step-3").reset();

    // Réinitialisation des collapses
    collapseThreeElement.classList.remove("show");
    collapseThreeBtnElement.classList.add("collapsed");
    collapseThreeBtnElement.setAttribute("aria-expanded", false);
    collapseThreeBtnElement.disabled = true;

    collapseTwoElement.classList.remove("show");
    collapseTwoBtnElement.classList.add("collapsed");
    collapseTwoBtnElement.setAttribute("aria-expanded", false);
    collapseTwoBtnElement.disabled = true;

    collapseOneElement.classList.add("show");
    collapseOneBtnElement.classList.remove("collapsed");
    collapseOneBtnElement.setAttribute("aria-expanded", true);
    collapseOneBtnElement.disabled = false;

    updateProgressBar(0);

    toastMessageElement.classList.remove("text-bg-danger");
    toastMessageElement.classList.add("text-bg-success");
    toastMessageElement.querySelector(".toast-body").innerText =
      "Formulaire bien envoyé";
    toastMessage.show();

    modal.hide();
  });

  falsedElement.addEventListener("click", () => {
    toastMessageElement.classList.remove("text-bg-success");
    toastMessageElement.classList.add("text-bg-danger");
    toastMessageElement.querySelector(".toast-body").innerText =
      "Action annulée";
    toastMessage.show();
    modal.hide();

    // Revenir à la première étape du formulaire
    collapseThreeElement.classList.remove("show");
    collapseThreeBtnElement.classList.add("collapsed");
    collapseThreeBtnElement.setAttribute("aria-expanded", false);
    collapseThreeBtnElement.disabled = true;

    collapseTwoElement.classList.remove("show");
    collapseTwoBtnElement.classList.add("collapsed");
    collapseTwoBtnElement.setAttribute("aria-expanded", false);
    collapseTwoBtnElement.disabled = true;

    collapseOneElement.classList.add("show");
    collapseOneBtnElement.classList.remove("collapsed");
    collapseOneBtnElement.setAttribute("aria-expanded", true);
    collapseOneBtnElement.disabled = false;

    updateProgressBar(0);
  });

});



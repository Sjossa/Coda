document.addEventListener("DOMContentLoaded", () => {
  const btnStep1Element = document.querySelector("#btn-step-1");
  const formStep1Element = document.querySelector("#form-step-1");

  const formStep2Element = document.querySelector("#form-step-2");
  const btnStep2Element = document.querySelector("#btn-step-2");
  const backBtnStep2Element = document.querySelector("#back-btn-step-2");

  const formStep3Element = document.querySelector("#form-step-3");
  const backBtnStep3Element = document.querySelector("#back-btn-step-3");
  const needDentalCheckboxElement = document.querySelector("#need-dental");
  const form3DentalSolutionsElement = document.querySelector(
    "#form-3-dental-solutions"
  );

  const modalValidBtnElement = document.querySelector("#modal-valid-btn");
  const modalClosedBtnElement = document.querySelector("#modal-close-btn");

  const modalElement = document.querySelector("#modal");
  const modal = new bootstrap.Modal(modalElement, { backdrop: "static" });

  const toastElement = document.querySelector("#toast-message");
  const toastBodyElemnt = document.querySelector(".toast-body");
  const toast = new bootstrap.Toast(toastElement, { delay: 10000 });

  const searchAddressBtn = document.querySelector("#search-address-btn");
  const searchAddressValue = document.querySelector("#search-address");

  searchAddressBtn.addEventListener("click", async (e) => {
    const addressInput = document.querySelector("#search-address").value;

    const result = await fetch(
      `https://api-adresse.data.gouv.fr/search/?q=${addressInput}`,
      {
        method: "GET",
      }
    );

    if (result.ok) {
      const data = await result.json();

      const features = data.features;
      let resultsHtml = "";
      features.forEach((feature, index) => {
        const label = feature.properties.label;
        const city = feature.properties.city;
        const postcode = feature.properties.postcode;
        const street = feature.properties.street;

        resultsHtml += `
          <div
            class="result-item"
            data-label="${label}"
            data-city="${city}"
            data-postcode ="${postcode}"
            data-street ="${street}"



            style="cursor: pointer; padding: 10px; border: 1px solid #ddd; margin: 5px 0;">
            ${index + 1}: ${label}
          </div>
        `;
      });

      const modalBody = modalElement.querySelector(".modal-body");
      modalElement.querySelector(".modal-title").innerHTML =
        "Choisisez l'adresse";
      modalBody.innerHTML = resultsHtml;

      modalBody.addEventListener("click", (event) => {
        const target = event.target;

        if (target.classList.contains("result-item")) {
          const selectedstreet = target.dataset.street;
          const selectedCity = target.dataset.city;
          const selectedPostcode = target.dataset.postcode;

          document.querySelector("#adress").value = selectedstreet;
          document.querySelector("#city").value = selectedCity;
          document.querySelector("#zip-code").value = selectedPostcode;

          modal.hide();
          searchAddressValue.value = "";
          modalValidBtnElement.style.display = "";
          modalClosedBtnElement.style.display = "";
          // toastBodyElemnt.innerHTML = "oooo";
        }
      });

      modalValidBtnElement.style.display = "none";
      modalClosedBtnElement.style.display = "none";

      modal.show();
    }
  });

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

  hasPartnerRadioBtnElements.forEach((hasPartnerRadioBtnElement) => {
    hasPartnerRadioBtnElement.addEventListener("change", (event) => {
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

    toggleCollapse("one", "close");
    toggleCollapse("two", "open");
    updateProgressBar(33);
  });

  btnStep2Element.addEventListener("click", () => {
    if (!formStep2Element.checkValidity()) {
      formStep2Element.reportValidity();
      return false;
    }

    toggleCollapse("two", "close");
    toggleCollapse("three", "open");
    updateProgressBar(66);
  });

  backBtnStep2Element.addEventListener("click", () => {
    if (!formStep2Element.checkValidity()) {
      formStep2Element.reportValidity();
      return false;
    }

    toggleCollapse("two", "close");
    toggleCollapse("one", "open");
    updateProgressBar(0);
  });

  const btnStep3 = document.querySelector("#btn-step-3");

  btnStep3.addEventListener("click", () => {
    const formStep3 = document.querySelector("#form-step-3");
    if (!formStep3.checkValidity()) {
      formStep3.reportValidity();
      return false;
    }

    updateProgressBar(100);

    modalElement.querySelector(".modal-title").innerHTML =
      "Confirmation du formulaire d'inscription";
    modalElement.querySelector(".modal-body").innerHTML = `
            <div>Nom: ${document.querySelector("#lastname").value}</div>
            <div>Prénom: ${formStep1Element.elements["firstname"].value}</div>
        `;

    modal.show();
    toggleCollapse("three", "close");
  });

  backBtnStep3Element.addEventListener("click", () => {
    if (!formStep3Element.checkValidity()) {
      formStep3Element.reportValidity();
      return false;
    }

    toggleCollapse("three", "close");
    toggleCollapse("two", "open");
    updateProgressBar(33);
  });

  modalValidBtnElement.addEventListener("click", () => {
    formStep1Element.reset();
    formStep2Element.reset();
    formStep3Element.reset();

    updateProgressBar(0);
    toggleCollapse("one", "open");

    modal.hide();
  });

  modalElement.addEventListener("hidden.bs.modal", () => {
    toast.show();
  });

  const toggleCollapse = (collapseNumber, action) => {
    if (action === "close") {
      document
        .querySelector(`#collapse-${collapseNumber}`)
        .classList.remove("show");
      document
        .querySelector(`#collapse-${collapseNumber}-btn`)
        .classList.add("collapsed");
      document
        .querySelector(`#collapse-${collapseNumber}-btn`)
        .setAttribute("aria-expanded", false);
      document.querySelector(`#collapse-${collapseNumber}-btn`).disabled = true;
    } else if (action === "open") {
      document
        .querySelector(`#collapse-${collapseNumber}`)
        .classList.add("show");
      document
        .querySelector(`#collapse-${collapseNumber}-btn`)
        .classList.remove("collapsed");
      document
        .querySelector(`#collapse-${collapseNumber}-btn`)
        .setAttribute("aria-expanded", true);
      document.querySelector(
        `#collapse-${collapseNumber}-btn`
      ).disabled = false;
    }
  };

  const updateProgressBar = (value) => {
    const progressElement = document.querySelector("#form-progress");
    const progressBarElement = progressElement.querySelector(".progress-bar");

    progressElement.setAttribute("aria-valuenow", value);
    progressBarElement.style.width = `${value}%`;
    progressBarElement.innerHTML = `${value}%`;
  };
});

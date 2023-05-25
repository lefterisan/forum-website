const accordionHeaders = document.querySelectorAll(".accordion-header");

accordionHeaders.forEach(header => { //anigma menu
  header.addEventListener("click", () => {
    const accordionBtn = header.querySelector(".accordion-btn");
    const accordionContent = header.nextElementSibling;

    accordionBtn.classList.toggle("active");
    accordionContent.classList.toggle("active");
  });
});

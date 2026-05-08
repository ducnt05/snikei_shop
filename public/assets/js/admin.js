// Dropdown functionality for all dropdown items
document.querySelectorAll(".dropdown").forEach(function (dropdown) {
  dropdown.addEventListener("click", function (event) {
    let submenu = this.querySelector(".submenu");

    if (!submenu) {
      return;
    }

    if (event.target.closest("a") && !event.target.closest(".arrow")) {
      return;
    }

    if (submenu.style.display === "block") {
      submenu.style.display = "none";
    } else {
      submenu.style.display = "block";
    }
  });
});
var darkmode = document.querySelector(".fa-sun");
if (darkmode) {
  darkmode.addEventListener("click", function () {
    document.body.classList.toggle("dark-mode");
  });
}

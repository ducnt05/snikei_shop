var btn = document.querySelector(".btn-add");
if (btn) {
  btn.addEventListener("click", function () {
    window.location.href = "./product_add.php";
  });
}

// Dropdown functionality for all dropdown items
document.querySelectorAll(".dropdown").forEach(function (dropdown) {
  dropdown.addEventListener("click", function () {
    let submenu = this.querySelector(".submenu");

    if (submenu.style.display === "block") {
      submenu.style.display = "none";
    } else {
      submenu.style.display = "block";
    }
  });
});
var darkmode = document.querySelector(".fa-sun");
if (darkmode){
  darkmode.addEventListener("click",function(){
    document.body.classList.toggle("dark-mode")
  })
}

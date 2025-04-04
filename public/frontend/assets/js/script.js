//alert("hello");
document.addEventListener("DOMContentLoaded", function () {
    var menuItems = document.querySelectorAll('.has-submenu');

    menuItems.forEach(function (item) {
        item.addEventListener('click', function () {
            this.querySelector('.submenu').classList.toggle('active');
            this.querySelector('.toggle-icon').innerHTML = (this.querySelector('.submenu').classList.contains('active')) ? '<i class="fa-solid fa-minus"></i>' : '<i class="fa-solid fa-plus"></i>';
        });
    });
});


function showVeg() {
   // alert("veg");
    let vegItems = document.querySelectorAll(".veg-item");
    let vegMenu = document.querySelector('.veg-menu');
    let nonvegItems = document.querySelectorAll(".nonveg-item");
    let nonvegMenu = document.querySelector('.nonveg-menu');

    vegMenu.classList.add('active');
    nonvegMenu.classList.remove('active');

    nonvegItems.forEach(function (el) {
        el.classList.add("d-none");
    });

    vegItems.forEach(function (el) {
        el.classList.remove("d-none");
    });

};

function showNonveg() {
 //   alert("non veg");
    let vegItems = document.querySelectorAll(".veg-item");
    let vegMenu = document.querySelector('.veg-menu');
    let nonvegItems = document.querySelectorAll(".nonveg-item");
    let nonvegMenu = document.querySelector('.nonveg-menu');

    vegMenu.classList.remove('active');
    nonvegMenu.classList.add('active');

    nonvegItems.forEach(function (el) {
        el.classList.remove("d-none");
    });

    vegItems.forEach(function (el) {
        el.classList.add("d-none");
    });

};

function showDiv() {
    var showItem = document.getElementById("show");
    //   var btnText = document.getElementById("notification");
    var expandText = document.getElementById("expandtext");

    if (showItem.style.display === "block") {
        showItem.style.display = "none";
        expandText.innerHTML = "Show <i class='fa-solid fa-chevron-down ml-2'></i>";
        // showItem.style.display = "none";

    } else if (showItem.style.display === "none") {
        showItem.style.display = "block";
        expandText.innerHTML = "Hide <i class='fa-solid fa-chevron-up ml-2'></i>";

    }
}


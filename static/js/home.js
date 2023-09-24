// top nav -------------------------------------------------------------
const help_div = document.getElementById("help_div");

help_div.addEventListener("mousedown" , () => {

    $(".list").slideToggle();
});

// search part
const searchicon = document.querySelector(".search-icon");
const searchinput = document.querySelector(".search_input");

searchicon.addEventListener("click" , () => {

    searchinput.classList.toggle("active");
});


// list part
const links_div = document.getElementById("links_div");
const menu_icon = document.querySelector(".menu_icon");
const close_icon = document.querySelector(".close_icon");

menu_icon.addEventListener("click", () => {

    links_div.style.cssText = `
    
    left: 0;
    `;
});

close_icon.addEventListener("click" , () => {

    links_div.style.cssText = `
    
    left: -100%;
    `;
});





// slider ---------------


const swiper1 = new Swiper('.swiper-container-1', {
    // Optional parameters
    direction: 'vertical',
    loop: true,
    autoplay:true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
        },

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});


const swiper2 = new Swiper('.swiper-container-2', { 
    // Optional parameters
    direction: 'horizontal',
    loop: true,
    pagination: true,
    pagination: {
        el: ".swiper-pagination",
    },
    autoplay:true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
        },
});

const swiper3 = new Swiper('.swiper-container-3', { 
    // Optional parameters
    direction: 'horizontal',
    loop: true,
    autoplay:true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
        },
});





//up button page ----------------------------------------------------------------------------
let upbtn = document.getElementById("upbtn");

window.onscroll = () => {
    if (scrollY >= 1000) {
        upbtn.style.display = "block";
    }
    else {
        upbtn.style.display = "none";
    }
}

upbtn.onclick = () => {
    scroll({
        top : 0,
        behavior : "smooth"
    })
};





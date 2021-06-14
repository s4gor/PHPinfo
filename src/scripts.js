"use strict";

let topButton = document.getElementById('topButton');

function showButton() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        topButton.style.display = "block";
    } else {
        topButton.style.display = "none";
    }
}

window.onscroll = () => {
    showButton();
}

function goTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

topButton.addEventListener('click', goTop);

"use strict";

function main() {
    var topButton = document.getElementById('topButton-phpinfo-WP');
    var tabcontent = document.getElementsByClassName("tabcontent");
    var tablinks = document.getElementsByClassName("tablinks");
    var save = document.getElementById('phpinfo-htaccess-save');
    var backup = document.getElementById('phpinfo-htaccess-backup');
    var restore = document.getElementById('phpinfo-htaccess-restore');
    var outPut = document.getElementById('phpinfo-output');


    function showButton() {
        if (topButton !== null) {
            if (document.body.scrollTop > 400 || document.documentElement.scrollTop > 400) {
                topButton.style.display = "block";
            }
            else {
                topButton.style.display = "none";
            }
        }
    }

    window.onscroll = function () {
        showButton();
    };

    function goTop() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    if (topButton !== null) {
        topButton.addEventListener('click', goTop);
    }

    function manageContent() {

        outPut.style.display = "none";
        for (let i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        for (let i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
    }

    manageContent();

    if(tabcontent[0] !== null) {
        tabcontent[0].style.display = "block";
        tablinks[0].className += " active";
    }

    let i;

    for(let link of tablinks) {
        link.addEventListener('click', () => {
            manageContent();
            if(link.id == 'info-tab') i = 2;
            else if(link.id == 'extension-tab') i = 1;
            else i = 0;
            document.getElementById(tabcontent[i].id).style.display = "block";
            event.currentTarget.className += " active";
        });
    }
}

if(document.getElementById('phpinfo-wp') !== null) {
    main();
}

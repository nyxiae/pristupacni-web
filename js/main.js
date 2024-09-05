$(document).ready(function () {

    // VARIJABLE 
    var currentPath = window.location.pathname.replace(/\/+$/, '');
    let accessibility = $(".accessibility-container");
    let backToTopButton = $('#js-back-to-top');
    let body = $("body");


    // skriven gumb za povratak na početak web stranice 
    backToTopButton.hide();
    
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            backToTopButton.fadeIn();
        } else {
            backToTopButton.fadeOut();
        }
    });

    backToTopButton.click(function (e) {
        e.preventDefault();
        $('html, body').animate({ scrollTop: 0 }, 800);
    });


    $("#accessilityBtn").on("click", function () {

        if (accessibility.hasClass("show")) {
            accessibility.removeClass("show");
            body.removeClass("dmargins");
        } else {
            accessibility.addClass("show").focus();
            body.addClass("dmargins");
        }
    })

    $("#close_container").on("click", function(){
        accessibility.removeClass("show");
        body.removeClass("dmargins");
    });

    $('#switchId').on('change', function () {
        var img = $('#headerImg');
        if ($(this).is(':checked')) {
            img.attr('src', '/photo/header-img2.webp');
            img.attr('alt', 'slika grada, noćna verzija');
        } else {
            img.attr('src', '/photo/header-img.webp');
            img.attr('alt', 'slika grada, dnevna verzija');
        }
    });
    
    $('.js-toggle-password').on('click', function() {
        console.log("Nee");
        var $passwordInput = $('input[name="lozinka"]');
        var $icon = $(this).find('i');

        if ($passwordInput.attr('type') === 'password') {
            $passwordInput.attr('type', 'text');
            $icon.removeClass('fa-eye-slash').addClass('fa-eye');
        } else {
            $passwordInput.attr('type', 'password');
            $icon.removeClass('fa-eye').addClass('fa-eye-slash');
        }
    });

    $('.nav-link').each(function () {
        if ($(this).attr('href') === currentPath) {
            $(this).parent().addClass('active');
        } else {
            $(this).parent().removeClass('active');
        }
    });

    function toggleButtonState(button) {
        button.classList.toggle('button-active');
    }

    // Select the buttons by their IDs or accurate selectors
    const buttons = {
        omoTypeFont: document.getElementById('changeFont'),
        highlightLinks: document.getElementById('highlightLink'),
        greyImages: document.getElementById('greyImg'),
        turnOffLights: document.querySelector('button[title="Isključi svjetla"]') // Ensuring the right button is selected
    };

    // Check if buttons are found and add event listeners
    if (buttons.omoTypeFont) {
        buttons.omoTypeFont.addEventListener('click', () => toggleButtonState(buttons.omoTypeFont));
    }
    if (buttons.highlightLinks) {
        buttons.highlightLinks.addEventListener('click', () => toggleButtonState(buttons.highlightLinks));
    }
    if (buttons.greyImages) {
        buttons.greyImages.addEventListener('click', () => toggleButtonState(buttons.greyImages));
    }
    if (buttons.turnOffLights) {
        buttons.turnOffLights.addEventListener('click', () => toggleButtonState(buttons.turnOffLights));
    }
})
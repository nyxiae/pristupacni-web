$(document).ready(function () {

    // VARIJABLE 
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
            accessibility.addClass("show");
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
})
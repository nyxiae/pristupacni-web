     // Funkcija za postavljanje kolačića
     function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    // Funkcija za dohvaćanje kolačića
    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    // Funkcija za brisanje kolačića
    function eraseCookie(name) {
        document.cookie = name + '=; Max-Age=-99999999;';
    }

$(document).ready(function () {


    // Pohrana početnih veličina fonta
    $('*').each(function () {
        $(this).data('original-font-size', $(this).css('font-size'));
    });

    //vraćanje početnih postavki fonta
    $('#resetFontSize').on('click', function () {
        $('*').each(function () {
            var originalFontSize = $(this).data('original-font-size');
            $(this).css('font-size', originalFontSize);
        });
    });

    //smanji font
    $('#decreaseFontSize').on('click', function () {
        $('*').each(function () {
            var currentFontSize = parseInt($(this).css('font-size'));
            if (currentFontSize > 16) {
                $(this).css('font-size', (currentFontSize - 2) + 'px');
            }
        });
    });

    //povecaj font
    $('#increaseFontSize').on('click', function () {
        $('*').each(function () {
            var currentFontSize = parseInt($(this).css('font-size'));
            $(this).css('font-size', (currentFontSize + 1) + 'px');
        });
    });

    //promjena kontrasta
    $('.color-circle').on('click', function () {
        var themeClass = $(this).data('theme');
        $('*').not('.no-change, .no-change *').removeClass('black-yellow blue-yellow green-black red-black');
        $('*').not('.no-change, .no-change *').addClass(themeClass);
    });


    //podcrtaj linkove
    $('#underlineLink').on('click', function () {
        $('a').each(function () {
            if ($(this).hasClass('underline')) {
                $(this).removeClass('underline');
            } else {
                $(this).addClass('underline');
            }
        });
    });


    //istakni linkove
    $('#highlightLink').on('click', function () {
        $('a').each(function () {
            if ($(this).hasClass('highlight')) {
                $(this).removeClass('highlight');
            } else {
                $(this).addClass('highlight');
            }
        });
    });


    //sive slike
    $("#greyImg").on("click", function () {
        $('img').each(function () {
            if ($(this).hasClass('greyscale')) {
                $(this).removeClass('greyscale');
            } else {
                $(this).addClass('greyscale');
            }
        });
    })
    //vracanje originalnih postavki
    $('#resetWeb').on('click', function () {
        $('*').each(function () {
            var originalWeb = $(this).data('originalWeb');
            $(this).css('font-size', originalFontSize);
        });
    });


})
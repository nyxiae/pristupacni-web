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
    document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
}

$(document).ready(function () {

    var instance = new Mark(document.body);
    
    // Početne veličine fonta
    var initialFontSizes = {
        'p': '16px',
        'a.nav-link': '24px',
        'h1': '32px',
        'h2': '36px',
        'h3': '24px'
    };

    // Funkcija za primjenu pohranjenih postavki
    function applySettings() {
        var themeClass = getCookie('themeClass');
        var fontSize = getCookie('fontSize');
        var greyImg = getCookie('greyImg');
        var highlightLink = getCookie('highlightLink');
        var underlineLink = getCookie('underlineLink');
        var fontFamily= getCookie('fontFamily');
        var darkMode = getCookie('darkMode');

        if (themeClass) {
            $('body, header, footer, div, p, a, img').not('.no-change, .no-change *').removeClass('black-yellow blue-yellow green-black red-black greyscale underline highlight');
            $('body, header, footer, div, p, a, img').not('.no-change, .no-change *').addClass(themeClass);
        }

        if (fontSize) {
            try {
                var fontSizeObj = JSON.parse(fontSize);
                if (fontSizeObj && typeof fontSizeObj === 'object') {
                    $('p').css('font-size', fontSizeObj['p']);
                    $('a.nav-link').css('font-size', fontSizeObj['a.nav-link']);
                    $('h1').css('font-size', fontSizeObj['h1']);
                    $('h2').css('font-size', fontSizeObj['h2']);
                    $('h3').css('font-size', fontSizeObj['h3']);
                }
            } catch (e) {
                console.error("Error parsing font size from cookie", e);
                // Reset cookie if parsing fails
                eraseCookie('fontSize');
            }
        }

        if (greyImg === 'true') {
            $('img').addClass('greyscale');
        }else{
            $('img').removeClass('greyscale');
        }


        if (highlightLink === 'true') {
            $('a').addClass('highlight');
        }else{
            $('a').removeClass('highlight');
        }

        if (underlineLink === 'true') {
            $('a').addClass('underline');
        }else{
            $('a').removeClass('underline');
        }

        if (darkMode === 'true') {
            enableDarkMode();
        } else {
            disableDarkMode();
        }

        if (fontFamily) {
            $('body').removeClass('font-omotype font-roboto-slab').addClass(fontFamily);
            if (fontFamily === 'font-omotype') {
                $('#changeFont').html('Roboto Slab <span class="letter-inside"></span>');
                $('.letter-inside').removeClass('font-omotype').addClass('font-roboto-slab');
            } else if (fontFamily === 'font-roboto-slab') {
                $('#changeFont').html('Roboto Slab <span class="letter-inside"></span>');
                $('.letter-inside').removeClass('font-omotype').addClass('font-roboto-slab');
            }
        }
    }

    // Pozivanje funkcije za primjenu postavki prilikom učitavanja stranice
    applySettings();

    // Event handler za promjenu teme
    $('.color-circle').on('click', function () {
        var themeClass = $(this).data('theme');
        $('body, header, footer, div, p, a, img, :header').not('.no-change, .no-change *').removeClass('black-yellow blue-yellow green-black red-black');
        $('body, header, footer, div, p, a, img, :header').not('.no-change, .no-change *').addClass(themeClass);
        setCookie('themeClass', themeClass, 7); // Spremanje teme u kolačić na 7 dana
    });


    // Event handler za povećanje veličine fonta
    $('#increaseFontSize').on('click', function () {
        $('p, a.nav-link, h1, h2, h3').each(function () {
            var currentFontSize = parseInt($(this).css('font-size'));
            $(this).css('font-size', (currentFontSize + 2) + 'px');
        });

        var fontSizeObj = {
            'p': $('p').css('font-size'),
            'a.nav-link': $('a.nav-link').css('font-size'),
            'h1': $('h1').css('font-size'),
            'h2': $('h2').css('font-size'),
            'h3': $('h3').css('font-size')
        };
        setCookie('fontSize', JSON.stringify(fontSizeObj), 7); // Spremanje veličine fonta u kolačić na 7 dana
    });

    // Event handler za smanjivanje veličine fonta
    $('#decreaseFontSize').on('click', function () {
        $('p, a.nav-link, h1, h2, h3').each(function () {
            var currentFontSize = parseInt($(this).css('font-size'));
            if (currentFontSize > 16) {
                $(this).css('font-size', (currentFontSize - 2) + 'px');
            }
        });

        var fontSizeObj = {
            'p': $('p').css('font-size'),
            'a.nav-link': $('a.nav-link').css('font-size'),
            'h1': $('h1').css('font-size'),
            'h2': $('h2').css('font-size'),
            'h3': $('h3').css('font-size')
        };
        setCookie('fontSize', JSON.stringify(fontSizeObj), 7); // Spremanje veličine fonta u kolačić na 7 dana
    });

    //vraćanje početnih postavki fonta
    $('#resetFontSize').on('click', function () {
        $('p').css('font-size', initialFontSizes['p']);
        $('a.nav-link').css('font-size', initialFontSizes['a.nav-link']);
        $('h1').css('font-size', initialFontSizes['h1']);
        $('h2').css('font-size', initialFontSizes['h2']);
        $('h3').css('font-size', initialFontSizes['h3']);
    });


    // Omotype font
    $('#changeFont').on('click', function () {
        if ($('body').hasClass('font-omotype')) {
            $('body').removeClass('font-omotype').addClass('font-roboto-slab');
            $(this).html('Omotype Font <span class="letter-inside"></span>');
            $('.letter-inside').removeClass('font-omotype').addClass('font-roboto-slab');
 
            setCookie('fontFamily', 'font-roboto', 7);
        } else {
            $('body').removeClass('font-roboto-slab').addClass('font-omotype');
            $(this).html('Roboto Slab <span class="letter-inside"></span>');
            $('.letter-inside').removeClass('font-omotype').addClass('font-roboto-slab');
            setCookie('fontFamily', 'font-omotype', 7);
        }
    });

    // Podcrtavanje linkova
    $('#underlineLink').on('click', function () {
        $('a').each(function () {
            $(this).toggleClass('underline');
        });
        var underlineLinkState = $('a').hasClass('underline');
        setCookie('underlineLink', underlineLinkState, 7); // Spremanje stanja u kolačić na 7 dana
    });

    // Isticanje linkova
    $('#highlightLink').on('click', function () {
        $('a').each(function () {
            $(this).toggleClass('highlight');
        });
        var highlightLinkState = $('a').hasClass('highlight');
        setCookie('highlightLink', highlightLinkState, 7); // Spremanje stanja u kolačić na 7 dana
    });

    // Sive slike
    $("#greyImg").on("click", function () {
        $('img').each(function () {
            $(this).toggleClass('greyscale');
        });
        var greyImgState = $('img').hasClass('greyscale');
        setCookie('greyImg', greyImgState, 7); // Spremanje stanja u kolačić na 7 dana
    });

    // Event handler za resetiranje stilova na početne vrijednosti
    $('#resetStyles').on('click', function () {
        $('body, header, footer, div, p, a, img, :header').removeClass('black-yellow blue-yellow green-black red-black greyscale underline highlight font-omotype font-roboto');
        // Vraćanje početnih veličina fonta
        $('p').css('font-size', initialFontSizes['p']);
        $('a.nav-link').css('font-size', initialFontSizes['a.nav-link']);
        $('h1').css('font-size', initialFontSizes['h1']);
        $('h2').css('font-size', initialFontSizes['h2']);
        $('h3').css('font-size', initialFontSizes['h3']);

        eraseCookie('themeClass'); // Uklanjanje spremljene teme iz kolačića
        eraseCookie('fontSize'); // Uklanjanje spremljene veličine fonta iz kolačića
        eraseCookie('fontFamily');
        eraseCookie('greyImg'); // Uklanjanje spremljenog stanja sivih slika iz kolačića
        greyImg=false;
        eraseCookie('highlightLink'); // Uklanjanje spremljenog stanja isticanja linkova iz kolačića
        highlightLink=false;
        eraseCookie('underlineLink'); // Uklanjanje spremljenog stanja podcrtavanja linkova iz kolačića
        underlineLink=false;
        disableDarkMode(); // Ensure dark mode is turned off
        eraseCookie('darkMode'); // Remove dark mode cookie
    });


    $('#textInput').on('input', function() {
        var query = $(this).val().toLowerCase();

        // Unmark previous highlights
        instance.unmark();

        if (query.length > 0) {
            // Mark new highlights
            instance.mark(query, {
                element: 'span',
                className: 'highlight'
            });
        }
    });

    $('#turnOffLights').on('click', function () {
        if ($('body').css('background') === 'rgba(0, 0, 0, 0.83)') {
            disableDarkMode();
            setCookie('darkMode', 'false', 7);
        } else {
            enableDarkMode();
            setCookie('darkMode', 'true', 7);
        }
    });

     // Function to enable dark mode
     function enableDarkMode() {
        $('body').css('background', 'rgba(0, 0, 0, 0.83)');
        $('.box').css('background', 'white');
        $('#textInput').css('background', 'white');
        $('.naslov').css('color', '#ee1c4e');
    }

    // Function to disable dark mode
    function disableDarkMode() {
        $('body').css('background', '');
        $('.box').css('background', '');
        $('#textInput').css('background', '');
        $('.naslov').css('color', '');
    }
    
});
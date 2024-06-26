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
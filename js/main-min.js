$(document).ready(function(){let a=$(".accessibility-container"),s=$("#js-back-to-top"),e=$("body");s.hide(),$(window).scroll(function(){100<$(this).scrollTop()?s.fadeIn():s.fadeOut()}),s.click(function(a){a.preventDefault(),$("html, body").animate({scrollTop:0},800)}),$("#accessilityBtn").on("click",function(){a.hasClass("show")?(a.removeClass("show"),e.removeClass("dmargins")):(a.addClass("show"),e.addClass("dmargins"))}),$("#close_container").on("click",function(){a.removeClass("show"),e.removeClass("dmargins")}),$("#switchId").on("change",function(){var a=$("#headerImg");$(this).is(":checked")?(a.attr("src","/photo/header-img2.webp"),a.attr("alt","slika grada, noćna verzija")):(a.attr("src","/photo/header-img.webp"),a.attr("alt","slika grada, dnevna verzija"))})});
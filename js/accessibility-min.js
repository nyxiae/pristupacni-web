function setCookie(e,o,s){var t,n="";s&&((t=new Date).setTime(t.getTime()+24*s*60*60*1e3),n="; expires="+t.toUTCString()),document.cookie=e+"="+(o||"")+n+"; path=/"}function getCookie(e){for(var o=e+"=",s=document.cookie.split(";"),t=0;t<s.length;t++){for(var n=s[t];" "==n.charAt(0);)n=n.substring(1,n.length);if(0==n.indexOf(o))return n.substring(o.length,n.length)}return null}function eraseCookie(e){document.cookie=e+"=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;"}$(document).ready(function(){var o=new Mark(document.body),e="16px",s="32px",t="36px",n="24px";var i=getCookie("themeClass"),a=getCookie("fontSize"),l=getCookie("greyImg"),r=getCookie("highlightLink"),h=getCookie("underlineLink"),c=getCookie("fontFamily");if(i&&($("body, header, footer, div, p, a, img").not(".no-change, .no-change *").removeClass("black-yellow blue-yellow green-black red-black greyscale underline highlight"),$("body, header, footer, div, p, a, img").not(".no-change, .no-change *").addClass(i)),a)try{var g=JSON.parse(a);g&&"object"==typeof g&&($("p").css("font-size",g.p),$("h1").css("font-size",g.h1),$("h2").css("font-size",g.h2),$("h3").css("font-size",g.h3))}catch(e){console.error("Error parsing font size from cookie",e),eraseCookie("fontSize")}"true"===l?$("img").addClass("greyscale"):$("img").removeClass("greyscale"),"true"===r?$("a").addClass("highlight"):$("a").removeClass("highlight"),"true"===h?$("a").addClass("underline"):$("a").removeClass("underline"),c&&($("body").removeClass("font-omotype font-roboto-slab").addClass(c),"font-omotype"===c||"font-roboto-slab"===c)&&($("#changeFont").html('Roboto Slab <span class="letter-inside"></span>'),$(".letter-inside").removeClass("font-omotype").addClass("font-roboto-slab")),$(".color-circle").on("click",function(){var e=$(this).data("theme");$("body, header, footer, div, p, a, img, :header").not(".no-change, .no-change *").removeClass("black-yellow blue-yellow green-black red-black"),$("body, header, footer, div, p, a, img, :header").not(".no-change, .no-change *").addClass(e),setCookie("themeClass",e,7)}),$("#increaseFontSize").on("click",function(){$("p, h1, h2, h3").each(function(){var e=parseInt($(this).css("font-size"));$(this).css("font-size",e+2+"px")});var e={p:$("p").css("font-size"),h1:$("h1").css("font-size"),h2:$("h2").css("font-size"),h3:$("h3").css("font-size")};setCookie("fontSize",JSON.stringify(e),7)}),$("#decreaseFontSize").on("click",function(){$("p, h1, h2, h3").each(function(){var e=parseInt($(this).css("font-size"));16<e&&$(this).css("font-size",e-2+"px")});var e={p:$("p").css("font-size"),h1:$("h1").css("font-size"),h2:$("h2").css("font-size"),h3:$("h3").css("font-size")};setCookie("fontSize",JSON.stringify(e),7)}),$("#resetFontSize").on("click",function(){$("p").css("font-size",e),$("h1").css("font-size",s),$("h2").css("font-size",t),$("h3").css("font-size",n)}),$("#changeFont").on("click",function(){$("body").hasClass("font-omotype")?($("body").removeClass("font-omotype").addClass("font-roboto-slab"),$(this).html('Omotype Font <span class="letter-inside"></span>'),$(".letter-inside").removeClass("font-omotype").addClass("font-roboto-slab"),setCookie("fontFamily","font-roboto",7)):($("body").removeClass("font-roboto-slab").addClass("font-omotype"),$(this).html('Roboto Slab <span class="letter-inside"></span>'),$(".letter-inside").removeClass("font-omotype").addClass("font-roboto-slab"),setCookie("fontFamily","font-omotype",7))}),$("#underlineLink").on("click",function(){$("a").each(function(){$(this).toggleClass("underline")}),setCookie("underlineLink",$("a").hasClass("underline"),7)}),$("#highlightLink").on("click",function(){$("a").each(function(){$(this).toggleClass("highlight")}),setCookie("highlightLink",$("a").hasClass("highlight"),7)}),$("#greyImg").on("click",function(){$("img").each(function(){$(this).toggleClass("greyscale")}),setCookie("greyImg",$("img").hasClass("greyscale"),7)}),$("#resetStyles").on("click",function(){$("body, header, footer, div, p, a, img, :header").removeClass("black-yellow blue-yellow green-black red-black greyscale underline highlight font-omotype font-roboto"),console.log("briši kolačiće"),$("p").css("font-size",e),$("h1").css("font-size",s),$("h2").css("font-size",t),$("h3").css("font-size",n),eraseCookie("themeClass"),eraseCookie("fontSize"),eraseCookie("fontFamily"),eraseCookie("greyImg"),greyImg=!1,eraseCookie("highlightLink"),highlightLink=!1,eraseCookie("underlineLink"),underlineLink=!1}),$("#textInput").on("input",function(){var e=$(this).val().toLowerCase();o.unmark(),0<e.length&&o.mark(e,{element:"span",className:"highlight"})})});
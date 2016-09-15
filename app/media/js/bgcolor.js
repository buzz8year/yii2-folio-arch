$(function(){
    var endpos = 300,
        begop = 0.65,
        beglog = 1,
        endmarg = 150,
        begcol = 0;

    if ($(window).width() <= 768) {
        var endcol = 255, endop = 1;
    } else {
        var endcol = 245, endop = 0.95;
    }

    $(document).scroll(function() {
        var scrol = $(this).scrollTop(),
            per = scrol/endpos,
            nrgb = Math.round(245 * per),
            ncol = 'rgb(' + nrgb + ',' + nrgb + ',' + nrgb + ')',
            npac = begop + ( ( endop - begop ) * per ),
            nlog = beglog + ( - beglog * per ),
            nmarg = endmarg * per;

        if ( scrol > 0 && scrol <= endpos ) {
            $('.car-filter').css({ 'background-color': 'rgb(' + nrgb + ',' + nrgb + ',' + nrgb + ')', opacity: npac });
            $('.logo-wrp').animate({ opacity: nlog }, 0);
            $('.magic-wrap > div').animate({ opacity: (0.5 - nlog), 'z-index': 0 }, 0);
            $('.magic-wrap > div:first-of-type > .brief').animate({ left: (endmarg - nmarg)*3 + 'px' }, 0);
            $('.a-index.text-left a').animate({ 'margin-left': nmarg + 'px' }, 0);
            $('.a-index.text-right a').animate({ 'margin-right': nmarg + 'px' }, 0);
            $('.a-index.text-vert a').animate({ 'margin-top': (nmarg*2) + 'px', 'margin-bottom': (-nmarg*2) + 'px' }, 0);

        } else if ( scrol > endpos ) {
            $('.car-filter').css({ 'background-color': 'rgb(' + endcol + ',' + endcol + ',' + endcol + ')', opacity: endop });
            $('.logo-wrp').animate({ opacity: 0 }, 0);
            $('.magic-wrap > div').animate({ opacity: (0.5 - (nlog * 3)), 'z-index': 0 }, 0);
            $('.magic-wrap > div:first-of-type > .brief').animate({ left: 0 }, 0);
            $('.a-index.text-left a').animate({ 'margin-left': endmarg + 'px' }, 0);
            $('.a-index.text-right a').animate({ 'margin-right': endmarg + 'px' }, 0);
            $('.a-index.text-vert a').animate({ 'margin-top': (endmarg*2) + 'px', 'margin-bottom': (-endmarg*2) + 'px' }, 0);

        } else if ( scrol == 0 ) {
            $('.car-filter').css({ 'background-color': 'rgb(' + begcol + ',' + begcol + ',' + begcol + ')', opacity: begop });
            $('.logo-wrp').animate({ opacity: beglog }, 0);
            $('.magic-wrap > div').animate({ opacity: 0, 'z-index': -1 }, 0);
            $('.magic-wrap > div:first-of-type > .brief').animate({ left: 300 + 'px' }, 0);
            $('.a-index.text-left a').animate({ 'margin-left': 0 }, 0);
            $('.a-index.text-right a').animate({ 'margin-right': 0 }, 0);
            $('.a-index.text-vert a').animate({ 'margin-top': 0, 'margin-bottom': 0 }, 0);

        } else { }
    });

    particlesJS.load('particles-js', 'particles.json', function() {});

});

// $(function(){ // Code in a function to create an isolate scope
//
//     var speed = 500;
//     var moving_frequency = 15; // Affects performance !
//     var links = document.getElementsByTagName('a');
//     var href;
//     for(var i=0; i<links.length; i++){
//         href = (links[i].attributes.href === undefined) ? null : links[i].attributes.href.nodeValue.toString();
//         if(href !== null && href.length > 1 && href.substr(0, 1) == '#'){
//             links[i].onclick = function(){
//                 var element;
//                 var href = this.attributes.href.nodeValue.toString();
//                 if(element = document.getElementById(href.substr(1))){
//                     var hop_count = speed/moving_frequency
//                     var getScrollTopDocumentAtBegin = getScrollTopDocument();
//                     var gap = (getScrollTopElement(element) - getScrollTopDocumentAtBegin) / hop_count;
//
//                     for(var i = 1; i <= hop_count; i++){
//                         (function(){
//                             var hop_top_position = gap*i;
//                             setTimeout(function(){  window.scrollTo(0, hop_top_position + getScrollTopDocumentAtBegin); }, moving_frequency*i);
//                         })();
//                     }
//                 }
//
//                 return false;
//             };
//         }
//     }
//
//     var getScrollTopElement =  function(e){
//         var top = 0;
//
//         while (e.offsetParent != undefined && e.offsetParent != null)
//         {
//             top += e.offsetTop + (e.clientTop != null ? e.clientTop : 0);
//             e = e.offsetParent;
//         }
//
//         return top;
//     };
//
//     var getScrollTopDocument = function(){
//         return document.documentElement.scrollTop + document.body.scrollTop;
//     };
// });

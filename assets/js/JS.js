$(document).ready(function () {

    // $('#hamburger').click(function(){
    //     $('#navnav').slideToggle();
    // });
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function () {
        if (window.innerWidth > 1000) {
            var currentScrollPos = window.pageYOffset;
            if (prevScrollpos > currentScrollPos) {
                document.getElementById("header").style.top = "0";
            } else {
                document.getElementById("header").style.top = "-100px";
            }
            prevScrollpos = currentScrollPos;
        }


    }

    var sidenav = $('#sidenav');
    var opennavbutton = $('#openlogo');
    $('#opensidenav').click(function () {
        $('#sidenav').toggleClass('show');
        $(this).find('img').toggle();
        // if(opennavbutton.style=='none'){
        //     $('#openlogo').css({'display':'block'});
        //     $('#closelogo').css({'display':'none'});
        // }else{
        //     $('#openlogo').css({'display':'none'});
        //     $('#closelogo').css({'display':'block'});
        // }

        // $('#sidenav').css({
        //     'right': '0'
        // });
        // $('.overlay').css({
        //     'display': 'block'
        // });

    });
    // $('.overlay').click(function () {

    //     if (window.matchMedia('(max-width: 800px)').matches) {
    //         $('#sidenav').css({
    //             'right': '-100%'
    //         });
    //     } else{
    //         $('#sidenav').css({
    //             'right': '-40%'
    //         });
    //     }
    //     $('.overlay').css({
    //         'display': 'none'
    //     });

    // });

    $('.drop-button').click(function () {
        $(this).next('.drop-content').slideToggle();
    });


});
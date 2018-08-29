$(document).ready(function () {
    //DISPLAY TABLES
    /*$(".displayTable").hide();
    $('.affiche').click(function(){
        $(this).children('.displayTable').slideToggle();
        console.log("index : " + display);
    })*/

    //TRANSFORM P IN INPUT ON CLICK
    $('.editInput').click(function (){
        let contentP = $(this).text();
        $(this).replaceWith(replaceByInput(this));
        $('.' + this.className + '').val(contentP);
    })

    function replaceByInput($item){
        return '<input type=text class=' + $item.className + ' name=' + $item.title + '>';
    }

    //ADD CLASS CENTER FOR DIV ON FORMS
    if(!$('form').has('div').hasClass('center')){
        $('form > div > div').addClass('center');
    }

    //DISPLAY FORMS
    $(".display-form").hide();
    $( ".add").click(function() {
        $(".form").slideToggle();
    });

    //DISPLAY INGREDIENT CATEGORIES
    $(".categoriesList").hide();
    $(".display-more").click(function (){
        $(this).next(".categoriesList").slideToggle();
    } )
});
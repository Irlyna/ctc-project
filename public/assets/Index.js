$(document).ready(function () {
    //DISPLAY TABLES
    /*$(".displayTable").hide();
    $('.affiche').click(function(){
        $(this).children('.displayTable').slideToggle();
        console.log("index : " + display);
    })*/

    //TRANSFORM TD IN INPUT ON CLICK
    $('.editInput').click(function (){
        let contentTd = $(this).text();
        console.log(contentTd);
        $(this).replaceWith(replaceByInput());
        $('.' + this.classeName + '').val(contentTd);
    })

    function replaceByInput(){
        let input = '<td><input type=text class=' + this.className + '></td>';
        return input;
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

    //ADD STEP IN FORM RECIPE
    //Don't work
    $(".addStep").click(function(){
        $('.addStep').attr('id', 'step');
        $('.step').clone().insertAfter('.step')
    });
});
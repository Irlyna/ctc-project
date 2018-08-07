$(document).ready(function () {
    //DISPLAY TABLES
    $(".displayTable").hide();
    $('.affiche').click(function(){
        $(this).children('.displayTable').slideToggle();
        console.log("index : " + display);
    })

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
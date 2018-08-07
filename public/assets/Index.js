$(document).ready(function () {
    //DISPLAY DETAILS OF RECIPES)

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
    $(".addStep").click(function(){
        $('.addStep').attr('id', 'step');
        $('.step').clone().insertAfter('.step')
    });
});
jQuery(document).ready(function () {
    //Removing tooltip for pages and adding tooltips for the next and previous
    $(".page").removeAttr("title");
    $(".next").attr("title", "Volgende");
    $(".prev").attr("title", "Vorige");
});
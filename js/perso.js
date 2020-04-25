$( document ).ready(function(){
    $(".showhide").on("click", function(){
            var linkbouton = $(this).text().toUpperCase();

            if (linkbouton === "+"){
                $( this ).parent("article").children( ".content" ).addClass('ShowContent');
                $( this ).parent("article").children( ".content" ).removeClass('HideContent');
                linkbouton = "-";
            }
            else {
                linkbouton ="+";
                $( this ).parent("article").children( ".content" ).addClass('HideContent');
                $( this ).parent("article").children( ".content" ).removeClass('ShowContent');
            }
            $(this).text(linkbouton);
    });
    //$( "article" ).parent().children( "" );
});
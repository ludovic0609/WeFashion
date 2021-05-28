(function () {

    $(".delete_product").on("submit", function(){
        return confirm("Voulez vous supprimer ce produit?");
    });
    $(".delete_category").on("submit", function(){
        return confirm("Voulez vous supprimer cette catégorie?");
    });


})($)
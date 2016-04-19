    $(document).ready(function() {
        var secureMenuToggle = $("#js-mobile-menu").unbind();
            $("#js-navigation-menu").removeClass("show");
            
            secureMenuToggle.on("click", function(e) {
            
            e.preventDefault();
            
            $("#js-navigation-menu").slideToggle(function(){
            
            if($("#js-navigation-menu").is(":hidden")) {
            $("#js-navigation-menu").removeAttr("style");
            }
            });
        });

        var insecureMenuToggle = $("#js-centered-navigation-mobile-men").unbind();
            $("#js-centered-navigation-menu").removeClass("show");
            
            insecureMenuToggle.on("click", function(e) {
            
            e.preventDefault();
            
            $("#js-centered-navigation-menu").slideToggle(function(){
            
            if($("#js-centered-navigation-menu").is(":hidden")) {
            $("#js-centered-navigation-menu").removeAttr("style");
            }
            });
        });            
    }); 
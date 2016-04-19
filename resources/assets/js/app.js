    $(document).ready(function() {
        var menuToggle = $("#js-mobile-menu").unbind();
            $("#js-navigation-menu").removeClass("show");
            console.log(menuToggle);
            menuToggle.on("click", function(e) {
            console.log('foo1');
            e.preventDefault();
            console.log('foo2');
            $("#js-navigation-menu").slideToggle(function(){
            console.log('foo3');
            if($("#js-navigation-menu").is(":hidden")) {
            $("#js-navigation-menu").removeAttr("style");
            }
            });
        });
    }); 
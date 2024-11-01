(function($){
    $(function() {


        $("body").on("click", ".wdic-settings-circle", function () {
            console.log($(".wdic-select-popup-overlay"));
            $(".wdic-ref-image img").hide();
            if ($(this).hasClass("wdic-toggle-circle")) {
                $(".wdic-toggle-help-image").show();
            }
            else if ($(this).hasClass("wdic-checkbox-circle")){
                $(".wdic-checkbox-help-image").show();
            }
            else if ($(this).hasClass("wdic-dropdown-circle")){
                $(".wdic-dropdown-help-image").show();
            }
            else if ($(this).hasClass("wdic-submit-button-circle")){
                $(".wdic-submit-help-image").show();
            }

            $(".wdic-select-popup-overlay").addClass("wdic-select-popup-overlay-target");
        });

        $("body").on("click", ".wdic-select-popup-overlay-target .wdic-close", function () {
            console.log($("#wdic_popup1"));
            $("#wdic_popup1").removeClass("wdic-select-popup-overlay-target");
        })



    })
})(jQuery);

(function ($) {
    $(function () {

        if($("tr#what-i-charge")) {
            var squigglelink = "<a class='wdic-link' href='squiggledevelopment.com/store'>More Plugins!</a>"
            $("tr#what-i-charge div.row-actions").prepend(squigglelink);
        }

    })
})(jQuery);


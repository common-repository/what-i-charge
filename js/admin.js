(function($){
    $(function(){
        window.onresize = function(){
            checkWidth();
        }
        function checkWidth() {
            if($(document).width()<=1350){
                $(".wdic-serviceOptDel").html("X");
            }
            else {
                $(".wdic-serviceOptDel").html("X");

            }
        }
        checkWidth();


        $("body").on("click", ".wdic-create-subservice", function(){
            console.log($(".wdic-select-popup-overlay"));
            $(".wdic-select-popup-overlay").addClass("wdic-select-popup-overlay-target");
        });

        $("body").on("click", ".wdic-select-popup-overlay-target .wdic-close", function(){
            console.log($("#wdic_popup1"));
            $("#wdic_popup1").removeClass("wdic-select-popup-overlay-target");
        })


        //subservice delete
        $("body").on("click", ".wdic-x", function(e){
            if(window.confirm("are you sure you want to delete this?")){
                $(this).parents(".wdic-submenu-container").remove();
            }
            e.stopPropagation();
            e.preventDefault();
        });

        $("body").on("click", ".wdic-add-toggle-option", function(e){
            var container = $(this).parents(".wdic-option-container");
            console.log(container);
            var numChildren = container.children().length;
            container.children().first().find(".wdic-serviceOptDel").show();
            var copy = container.children().last().clone();
            copy.find(".wdic-toggle-index").first().html(numChildren+1);
            copy.find("input").each(function(){
                $(this).val("");
            })
            container.append(copy);

            e.stopPropagation();
            e.preventDefault();
        });

        $("body").on("click", ".wdic-delete-toggle-option", function(e){
            e.preventDefault();
            e.stopPropagation();
            var optionContainer = $(this).parents(".wdic-option-container");
            if(optionContainer.children().length==1 && confirm("are you sure you want to delete this option(which will remove the category)?")){
                $(this).parents(".wdic-toggleOpts").remove();

                return;
            }
            if(!confirm("are you sure you want to delete this option?")){
                return;
            }

            var option = $(this).parents(".wdic-toggle-option");
            console.log(optionContainer);
            console.log(option);
            option.remove();
            for(var i = 0; i < optionContainer.children().length;i++){
                optionContainer.children().eq(i).find(".wdic-toggle-index").first().html(i+1);
            }

        });



        $("body").on("click", ".wdic-add-checkbox-option", function(e){
            var container = $(this).parents(".wdic-option-container");
            console.log(container);
            var numChildren = container.children(".wdic-checkbox-option").length;
            container.children(".wdic-checkbox-option").first().find(".wdic-serviceOptDel").show();
            var copy = container.children(".wdic-checkbox-option").last().clone();
            copy.find(".wdic-checkbox-index").first().html(numChildren+1);
            copy.find("input").each(function(){
                $(this).val("");
            })
            container.find(".wdic-mobile-only").before(copy);

            e.stopPropagation();
            e.preventDefault();
        });

        $("body").on("click", ".wdic-delete-checkbox-option", function(e){
            e.preventDefault();
            e.stopPropagation();
            var optionContainer = $(this).parents(".wdic-option-container");
            if(optionContainer.children().length==1 && confirm("are you sure you want to delete this option(which will remove the category)?")){
                $(this).parents(".wdic-checkOpts").remove();

                return;
            }
            if(!confirm("are you sure you want to delete this option?")){
                return;
            }

            var option = $(this).parents(".wdic-checkbox-option");
            console.log(optionContainer);
            console.log(option);
            option.remove();
            for(var i = 0; i < optionContainer.children().length;i++){
                optionContainer.children().eq(i).find(".wdic-checkbox-index").first().html(i+1);
            }

        });


        $("body").on("click", ".wdic-add-drop-option", function(e){
            var container = $(this).parents(".wdic-option-container");
            console.log(container);
            var numChildren = container.children(".wdic-drop-option").length;
            container.children().first().find(".wdic-serviceOptDel").show();
            var copy = container.children(".wdic-drop-option").last().clone();
            copy.find(".wdic-drop-index").first().html(numChildren+1);
            copy.find("input").each(function(){
                $(this).val("");
            })
            container.find(".wdic-mobile-only").before(copy);

            e.stopPropagation();
            e.preventDefault();
        });

        $("body").on("click", ".wdic-delete-drop-option", function(e){
            e.preventDefault();
            e.stopPropagation();
            var optionContainer = $(this).parents(".wdic-option-container");
            if(optionContainer.children().length==1 && confirm("are you sure you want to delete this option(which will remove the category)?")){
                $(this).parents(".wdic-dropOpts").remove();

                return;
            }
            if(!confirm("are you sure you want to delete this option?")){
                return;
            }

            var option = $(this).parents(".wdic-drop-option");
            console.log(optionContainer);
            console.log(option);
            option.remove();
            for(var i = 0; i < optionContainer.children().length;i++){
                optionContainer.children().eq(i).find(".wdic-drop-index").first().html(i+1);
            }

        });


        //end adding and deleting subservices


        $("#wdic-edit-form").on("submit", function(e){
            var submenus = [];
            $("body").find(".wdic-submenu-container").each(function(){
                if($(this).is(".wdic-dropOpts")){
                    var dropdown = {};
                    dropdown.type="dropdown";
                    dropdown.selectBackgroundColor = $(this).find("input[name='wdic_drop_select_background_color']").val();
                    dropdown.headingColor = $(this).find("input[name='wdic_drop_heading_color']").val();
                    dropdown.hoverColor = $(this).find("input[name='wdic_drop_hover_color']").val();
                    dropdown.backgroundColor = $(this).find("input[name='wdic_drop_bg_color']").val();
                    dropdown.textColor = $(this).find("input[name='wdic_drop_text_color']").val();
                    dropdown.id = $(this).find(".wdic-subservice-dropdown-id").val();
                    dropdown.name = $(this).find("[name='wdic-subservice-drop-name']").val();


                    var options = [];
                    $(this).find(".wdic-drop-option").each(function(){
                        var option = {};

                        option.name = $(this).find("[name='wdic-submenu-option-name']").val();
                        option.priceType = $(this).find(".wdic-priceSelect").val();
                        option.price = $(this).find("[name='wdic-option-price']").val();
                        options.push(option);
                    })
                    dropdown.options = options;
                    submenus.push(dropdown);

                }else if($(this).is(".wdic-checkOpts")){
                    var checkbox = {};
                    checkbox.type="checkbox";
                    checkbox.headingColor = $(this).find("input[name='wdic_check_heading_color']").val();
                    checkbox.backgroundColor = $(this).find("input[name='wdic_check_bg_color']").val();
                    checkbox.textColor = $(this).find("input[name='wdic_check_text_color']").val();
                    checkbox.checkBgColor = $(this).find("input[name='wdic_check_bg_check_color']").val();
                    checkbox.checkmarkColor = $(this).find(".wdic-checkSelect").val();


                    checkbox.id = $(this).find("input[name='wdic-subservice-checkbox-id']").val();
                    checkbox.name = $(this).find("input[name='wdic-subservice-checkbox-name']").val();
                    var options = [];
                    $(this).find(".wdic-checkbox-option").each(function(){
                       var option = {};
                        option.name = $(this).find("input[name='wdic-submenu-option-name']").val();
                        option.priceType = $(this).find(".wdic-priceSelect").val();
                        option.price = $(this).find("input[name='wdic-option-price']").val();
                        options.push(option);
                    })
                    checkbox.options = options;
                    submenus.push(checkbox);

                }else if($(this).is(".wdic-toggleOpts")) {
                    var toggle = {};
                    toggle.type = "toggle";
                    toggle.headingColor = $(this).find("input[name='wdic_toggle_heading_color']").val();
                    toggle.OnColor = $(this).find("input[name='wdic_toggle_on_color']").val();
                    toggle.OffColor = $(this).find("input[name='wdic_toggle_off_color']").val();

                    toggle.id = $(this).find("input[name='wdic-subservice-toggle-id']").val();
                    toggle.name = $(this).find("input[name='wdic-submenu-option-name']").val();
                    toggle.heading = $(this).find("input[name='wdic-subservice-toggle-heading']").val();
                    toggle.priceType = $(this).find(".wdic-priceSelect").val();
                    toggle.price = $(this).find("input[name='wdic-option-price']").val();
                    //var options = [];
                    //$(this).find(".wdic-toggle-option").each(function () {
                    //    var option = {};
                    //    option.priceType =
                    //
                    //    options.push(option);
                    //});
                    //toggle.options = options;
                    submenus.push(toggle);

                }



            })
            console.log(submenus);
            var json = JSON.stringify(submenus);
            //json = json.replace(/"/g, "\\\"");
            var submenuInput = $("<input type=\"hidden\" name=\"submenu_json\" >");
            submenuInput.val(json);
            $(this).append(submenuInput);
            //e.stopPropagation();
            //e.preventDefault();
        });




        $("body").on("click", ".wdic-add-toggle", function(){
            console.log(wdicPluginURL);
            var div = document.createElement("div");
            $(div).load(ajaxurl, {action:"get_subservice",service:"toggle"}, function(data){
                console.log(data);
                $(".wdic-service-options-here").append($(div).find(".wdic-submenu-container"));
            });
            //$("#subCatCreation").append($(div));

            $("#wdic_popup1").removeClass("wdic-select-popup-overlay-target");

        });



        $("body").on("click", ".wdic-add-dropdown", function(){
            console.log(wdicPluginURL);
            var div = document.createElement("div");
            $(div).load(ajaxurl, {action:"get_subservice",service:"dropdown"}, function(data){
                console.log(data);
                $(".wdic-service-options-here").append($(div).find(".wdic-submenu-container"));

            });
            //$("#subCatCreation").append($(div));
            $("#wdic_popup1").removeClass("wdic-select-popup-overlay-target");

        });

        $("body").on("click", ".wdic-add-checkbox", function(){
            console.log(wdicPluginURL);
            var div = document.createElement("div");
            $(div).load(ajaxurl, {action:"get_subservice",service:"checkbox"}, function(data){
                console.log(data);
                $(".wdic-service-options-here").append($(div).find(".wdic-submenu-container"));

            });
            //$("#subCatCreation").append($(div));
            $("#wdic_popup1").removeClass("wdic-select-popup-overlay-target");

        });

        $("body").on("click", ".wdic-redBtn", function(){
            var serviceID = $(this).attr("service-id");
            var nonce = $(this).attr("delete-nonce");
            var button = this;
            var deleteConfirmation = confirm("Are you sure you want to delete this service?");
            if (deleteConfirmation == false) {
                return;
            }
            $.post(ajaxurl, {nonce:nonce, id:serviceID, action:"delete_service"}, function(data){
               console.log(data);
                $(button).parents(".wdic-catagory-list").remove();
            });
        });


        //move subservices up and down
        $("body").on("click", ".wdic-move-up", function(){
            var parentContainter = $(this).parents(".wdic-submenu-container")[0];
            //console.log(parentContainter);
            var index = $(".wdic-submenu-container").index(parentContainter);
            if(index==0){
                return;
            }
            var sibling = $(parentContainter).prev();
            //var sibling = $(parentContainter).prev(".wdic-submenu-container");
            console.log(sibling);
            $(parentContainter).insertBefore($(sibling));
        })

        $("body").on("click", ".wdic-move-down", function(){
            var parentContainter = $(this).parents(".wdic-submenu-container")[0];
            //console.log(parentContainter);
            var index = $(".wdic-submenu-container").index(parentContainter);
            if(index==$(".wdic-submenu-container").length-1){
                return;
            }
            var sibling = $(parentContainter).next();
            //var sibling = $(parentContainter).prev(".wdic-submenu-container");
            console.log(sibling);
            $(parentContainter).insertAfter($(sibling));
        })

        //move services up and down
        $("body").on("click", ".wdic-move-up", function(){
            var parentContainter = $(this).parents(".wdic-catagory-list")[0];
            //console.log(parentContainter);
            var index = $(".wdic-catagory-list").index(parentContainter);
            if(index==0){
                return;
            }
            var sibling = $(parentContainter).prev();
            //var sibling = $(parentContainter).prev(".wdic-submenu-container");
            console.log(sibling);
            $(parentContainter).insertBefore($(sibling));
            serviceOrder()
        })

        $("body").on("click", ".wdic-move-down", function(){
            var parentContainter = $(this).parents(".wdic-catagory-list")[0];
            //console.log(parentContainter);
            var index = $(".wdic-catagory-list").index(parentContainter);
            if(index==$(".wdic-catagory-list").length-1){
                return;
            }
            var sibling = $(parentContainter).next();
            //var sibling = $(parentContainter).prev(".wdic-submenu-container");
            console.log(sibling);
            $(parentContainter).insertAfter($(sibling));
            serviceOrder()
        })

        function serviceOrder() {
            var serviceOrderNonce = $("#wdic_reorder_services_nonce").val();
            var orderArray = [];
            $(".wdic-catagory-list").each(function(){
               var serviceOrderID = $(this).find(".wdic-redBtn").attr("service-id");
              orderArray.push(serviceOrderID);
            });
            $.post(ajaxurl, {action:"reorder_services",serviceJSON:orderArray, wdic_reorder_services_nonce: serviceOrderNonce}, function(data){
                console.log(data);
            });

        }

    })
})(jQuery);


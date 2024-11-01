(function($){
    $(document).ready(function(){

        var originalServiceName = [];
        $(".wdic-service-name").each(function(index){
           originalServiceName[index] = $(this).find(".wdic-service-name-inner-text").text();
        });

    function checkWidth(){


            if($("#wdic-frontend-container").width()<=500){
                console.log("hey")
                $(".wdic-service-name").addClass("wdic-shrink");
                $(".wdic-innerHeading").addClass("wdic-shrink");
                $(".wdic-serviceText").addClass("wdic-shrink");
                $("#wdic_top_tabs").addClass("wdic-shrink");
                $(".wdic-toggle-heading").addClass("wdic-shrink");
                $(".wdic-toggle-option").addClass("wdic-shrink");
                $(".wdic-bottomDiv").addClass("wdic-shrink");
                $(".wdic-toggle-container").addClass("wdic-shrink");
                $(".wdic-checkbox-container").addClass("wdic-shrink");
                $(".wdic-frontend-dropdown-container").addClass("wdic-shrink");
                $(".wdic-continue-to-submission").addClass("wdic-shrink");
                $(".wdic-check-option-name").addClass("wdic-shrink");
                $(".wdic-checkbox-heading").addClass("wdic-shrink");
                $(".wdic-dropdown-heading").addClass("wdic-shrink");
                $(".wdic-checkout-email").addClass("wdic-shrink");
                $(".wdic-checkout-email-input").addClass("wdic-shrink");
                $(".wdic-checkout-options").addClass("wdic-shrink");
                $(".wdic-notes").addClass("wdic-shrink");
                $(".wdic-textarea").addClass("wdic-shrink");
                $(".wdic-checkout-name").addClass("wdic-shrink");
                $(".wdic-checkout-price").addClass("wdic-shrink");
                $(".wdic-checkout-submit").addClass("wdic-shrink");
                $(".wdic-checkout-cancel").addClass("wdic-shrink");

            }else{
                $(".wdic-service-name").removeClass("wdic-shrink");
                $(".wdic-innerHeading").removeClass("wdic-shrink");
                $(".wdic-serviceText").removeClass("wdic-shrink");
                $("#wdic_top_tabs").removeClass("wdic-shrink");
                $(".wdic-toggle-heading").removeClass("wdic-shrink");
                $(".wdic-toggle-option").removeClass("wdic-shrink");
                $(".wdic-bottomDiv").removeClass("wdic-shrink");
                $(".wdic-toggle-container").removeClass("wdic-shrink");
                $(".wdic-checkbox-container").removeClass("wdic-shrink");
                $(".wdic-frontend-dropdown-container").removeClass("wdic-shrink");
                $(".wdic-continue-to-submission").removeClass("wdic-shrink");
                $(".wdic-check-option-name").removeClass("wdic-shrink");
                $(".wdic-checkbox-heading").removeClass("wdic-shrink");
                $(".wdic-dropdown-heading").removeClass("wdic-shrink");
                $(".wdic-checkout-email").removeClass("wdic-shrink");
                $(".wdic-checkout-email-input").removeClass("wdic-shrink");
                $(".wdic-checkout-options").removeClass("wdic-shrink");
                $(".wdic-notes").removeClass("wdic-shrink");
                $(".wdic-textarea").removeClass("wdic-shrink");
                $(".wdic-checkout-name").removeClass("wdic-shrink");
                $(".wdic-checkout-price").removeClass("wdic-shrink");
                $(".wdic-checkout-submit").removeClass("wdic-shrink");
                $(".wdic-checkout-cancel").removeClass("wdic-shrink");

            }
        $(".wdic-service-name").each(function (index) {
            var boxHeight = $(this).height();
            console.log(boxHeight);
            var $textDiv = $(this).find(".wdic-service-name-inner-text")
            $textDiv.text(originalServiceName[index]);
            var words = $textDiv.text().split(" ");
            var isLarger = false;
            while ($textDiv.height() > boxHeight) {
                words.pop();
                $textDiv.text(words.join(" ") + "...");
            }


        });
        }

        checkWidth();

        window.onresize = function(){
            checkWidth();
        }

        var $currentService = $(".wdic-service-content-container").eq(0);

        $("body").on("click", ".wdic-onoffswitch-label", function(){
            var $parent = $(this).parent();
            var priceAmount = parseFloat($parent.find("[name=wdic-toggle-option-price]").val());
            if($parent.find("input").attr("checked")){//turn off
                console.log($(this).attr("offColor"));
                $parent.find(".wdic-onoffswitch-checkbox").removeAttr("checked");
                $parent.find("label").css("background-color",$(this).attr("offColor"));
                $parent.find("label").css("border-color",$(this).attr("offColor"));
                $parent.find("span").css("background-color",$(this).attr("offColor"));
                $parent.find("span").css("border-color",$(this).attr("offColor"));
                modifyPrice(priceAmount*-1);
            }else{//turn on
                $parent.find(".wdic-onoffswitch-checkbox").attr("checked","checked");
                $parent.find("label").css("background-color",$(this).attr("onColor"));
                $parent.find("label").css("border-color",$(this).attr("onColor"));
                $parent.find("span").css("background-color",$(this).attr("onColor"));
                $parent.find("span").css("border-color",$(this).attr("onColor"));
                modifyPrice(priceAmount);
                console.log($(this).attr("onColor"))
            }
        });

        $('body').on("click",".wdic-onoffswitch-span",function(){
            var label = $(this).parent().find("label");
            label.trigger("click");
        })

        $("body").on("click", ".wdic-checkbox li", function(){
            var span = $(this).find(".wdic-checkbox-span");
            console.log(span);
            var priceAmount = parseFloat($(this).find("[name=wdic-check-option-price]").val());
            if(span.hasClass("wdic-checkbox-span-active")){//turn off
                span.css("background-color","");
                modifyPrice(priceAmount*-1);
                span.css("background-image","");
            }else{//turn on

                span.css("background-color",span.attr("background-color"));
                span.css("background-image","url("+span.attr("checkmarkColor")+")" );
                modifyPrice(priceAmount);

            }
            span.toggleClass("wdic-checkbox-span-active");

        })
        $("body").on("click", ".wdic-fdc-header", function(){
            var $dropdownContainer = $(this).parents(".wdic-frontend-dropdown-container")
            var $span = $dropdownContainer.find(".wdic-fdc-header span");
            var $ul = $dropdownContainer.find("ul");
            openCloseDropdown($ul, $span);
        })

        function openCloseDropdown($ul, $span){
            if($ul.hasClass("wdic-active")){
                $span.removeClass("wdic-active");
                $span.addClass("wdic-unactive");
                $ul.slideUp(400, "linear", function(){
                    $ul.removeClass("wdic-active");
                });

            }else{
                $span.addClass("wdic-active");
                $span.removeClass("wdic-unactive");
                $ul.slideDown(400,"linear", function(){
                    $ul.addClass("wdic-active");

                });
                $ul.css("display","inline-block");
            }
        }
        $('body').on('hover', ".wdic-dropdown-item", function() {
           $(this).parent().find('li').css("background-color", $(this).attr("wdic-back-color") )
            $(this).css("background-color", $(this).attr("wdic-hover-color"))
        } )

        $("body").on("click", ".wdic-frontend-dropdown-container li", function(){
            var $dropdownContainer = $(this).parents(".wdic-frontend-dropdown-container")
            var $span = $dropdownContainer.find(".wdic-fdc-header span");
            var $ul = $dropdownContainer.find("ul");
            $dropdownContainer.find("h2").text($(this).text());
            var newPriceAmmount = parseFloat($(this).attr("wdic-price"));
            var adjustedPriceAmmount = parseFloat($(this).attr("wdic-price")) - parseFloat($dropdownContainer.find("h2").attr("wdic-price"));

            modifyPrice(adjustedPriceAmmount);
            $dropdownContainer.find("h2").attr("wdic-price", newPriceAmmount );
            openCloseDropdown($ul,$span);

        });

        $("body").on("click", ".wdic-service-name", function(){
            var index = $(this).index();

            $(".wdic-service-content-container").fadeOut(200, function(){
                $currentService = $(".wdic-service-content-container").eq(index);
                $(".wdic-service-content-container").eq(index).fadeIn(400);
                $(".wdic-service-checkout").hide();
                $(".wdic-bottomDiv").show();
            });

        })


        function modifyPrice(byAmount){
            byAmount = parseFloat(byAmount);
            var price = parseFloat($currentService.find(".wdic-price-amount").eq(0).text());
            price += byAmount;
            price = price.toFixed(2);
            $currentService.find(".wdic-price-amount").text(price);

        }

        $("body").on("click", ".wdic-continue-to-submission", function() {
            $(".wdic-service-checkout").show();
            $(".wdic-bottomDiv").hide();
            computeCheckoutString();
            document.body.scrollTop = document.documentElement.scrollTop = 0;
        })

        function computeCheckoutString () {
            console.log($currentService);
            var serviceName = $currentService.find(".wdic-innerHeading").text();
            var basePrice = $currentService.find(".wdic-base-price").val();
            var textAreaString = serviceName+": "+basePrice+"\r\n\r\n";
             $currentService.find(".wdic-subservice-container").each(function () {
                 if ($(this).hasClass("wdic-toggle-container") && $(this).find(".wdic-onoffswitch-checkbox").is(":checked")) {
                     var toggleName = $(this).find(".wdic-toggle-heading").text();
                     var togglePrice = $(this).find("[name=wdic-toggle-option-price]").val();
                     textAreaString += toggleName+": " + togglePrice;


                 }else if ($(this).hasClass("wdic-frontend-dropdown-container") &&$(this).find(".wdic-fdc-header h2").attr("wdic-price") !=0 ) {
                     var dropdownName = $(this).find(".wdic-dropdown-heading").text();
                     var dropdownPrice = $(this).find(".wdic-fdc-header h2").attr("wdic-price");
                     var dropSelection = $(this).find(".wdic-fdc-header h2").text();
                     textAreaString += dropdownName.trim()+"\r\n\t" + dropSelection.trim()+": " + dropdownPrice.trim();

                 }else if($(this).hasClass("wdic-checkbox-container") && $(this).find("li  span.wdic-checkbox-span-active").length > 0) {
                     var checkboxHeading = $(this).find(".wdic-checkbox-heading").text();
                     textAreaString += checkboxHeading.trim();
                     $(this).find("li span.wdic-checkbox-span-active").each(function () {
                         var optionHeading = $(this).parent().find(".wdic-check-option-name").text();
                         var optionPrice = $(this).parent().find("input").val();
                         textAreaString += "\r\n\t" +optionHeading + ": " + optionPrice;
                     })

                 }else{
                     return;
                 }
                 textAreaString+="\r\n\r\n";

             })
            var price = parseFloat($currentService.find(".wdic-price-amount").eq(0).text());
            textAreaString += price;
            $currentService.find(".wdic-textarea-options-list").val(textAreaString)
        }

      $("body").on("click", ".wdic-checkout-cancel", function () {
            hideCheckout();

      })

      $("body").on("click", ".wdic-checkout-submit", function (){
          var $checkoutContainer = $(this).parents(".wdic-service-checkout");
          var userEmail = $checkoutContainer.find(".wdic-checkout-email-input").val();
          var serviceNotes = $checkoutContainer.find(".wdic-textarea-options-list").val();
          var userComments= $checkoutContainer.find(".wdic-email-notes").val();
          var emailNonce = $("#wdic_email_nonce").val();

          if (userEmail  == "") {
              // alert("please enter an email");
              $checkoutContainer.find(".wdic-checkout-email-input").focus().css("background-color","#D24D57");
          } else  {

              $.post(ajaxurl, {
                  action: "email_services",
                  user_email: userEmail,
                  service_notes: serviceNotes,
                  user_comments: userComments,
                  wdic_email_nonce: emailNonce
              }, function (data) {
                  alert(wicEmailSuccessMessage);
                  hideCheckout();
              }).fail(function(data){
                 alert(data.responseText);
              });
          }

      })

        function hideCheckout () {
            $(".wdic-service-checkout").hide();
            $(".wdic-bottomDiv").show();
            document.body.scrollTop = document.documentElement.scrollTop = 0;
        }


    });
})(jQuery);
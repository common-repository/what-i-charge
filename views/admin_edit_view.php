<meta name="viewport" content="width=device-width, initial-scale=1">
<div id="wdic_container">
    <div id="what-i-charge-admin">


        <form id="wdic-edit-form" enctype="multipart/form-data" method="post" action="<?php echo admin_url("admin.php?page=what_i_charge_menu") ?>">
            <input type="hidden" name="current_post_id" value="new">

            <?php wp_nonce_field("wdic_edit_submission"); ?>
            <?php
                $priceColor = "";
                $headingColor = "";
                $backgroundColor = "";
                $toggleCardColor = "";
                $dropCardColor = "";
                $checkCardColor = "";
                $descriptionColor ="";
                if(isset($currentService)){
                    $priceColor = get_post_meta($currentService->ID, "wdic_service_price_color", true);
                    $serviceDescription = get_post_meta($currentService->ID, "service_description", true);
                    $serviceDescriptionColor = get_post_meta($currentService->ID, "wdic_service_description_color", true);
                    $headingColor = get_post_meta($currentService->ID, "wdic_service_heading_color", true);
                    $serviceBackgroundColor = get_post_meta($currentService->ID, "wdic_service_background_color", true);
                    $toggleCardColor = get_post_meta($currentService->ID, "wdic_toggle_card_color", true);
                    $dropCardColor = get_post_meta($currentService->ID, "wdic_drop_card_color", true);
                    $checkCardColor = get_post_meta($currentService->ID, "wdic_check_card_color", true);
                    $submitTextColor = get_post_meta($currentService->ID, "wdic_submit_text_color", true);
                    $submitBackgroundColor = get_post_meta($currentService->ID, "wdic_submit_background_color", true);
                    $negativeBackgroundColor = get_post_meta($currentService->ID, "wdic_negative_background_color", true);

                }else {

                    $serviceBackgroundColor = get_option("wdic_service_bg_color");
                    $headingColor = get_option("wdic_service_heading_color");
                    $serviceDescription = get_option("service_description");
                    $serviceDescriptionColor = get_option("wdic_service_description_color");
                    $priceColor = get_option("wdic_service_price_color");
                    $toggleCardColor = get_option("wdic_toggle_card_color");
                    $checkCardColor = get_option("wdic_check_card_color");
                    $dropCardColor = get_option("wdic_drop_card_color");
                    $submitTextColor = get_option("wdic_submit_btn_text_color");
                    $submitBackgroundColor = get_option("wdic_affirmative_btn_background_color");
                    $negativeBackgroundColor = get_option("wdic_negative_btn_background_color");
                }
            ?>

            <?php if ($isNewService): ?>
                <div class="wdic-heading-center">
                    <h1 class="wdic_serviceHead">New Service</h1>
                </div>

            <div class="wdic-form-labels">
                <div class="wdic-color-choices">
                    <div class="wdic-service-name-container">
                        <label id="wdic_label-sn-space-correct">Service Name:</label>
                        <input name="wdic_name" type="text" autofocus>
                    </div>
                    <div>
                    <label id="wdic_label-bp-space-correct">Base Price:</label>
                    <input name="wdic_base_price"  type="number" step="0.01">
                    </div>
                <div class="wdic-service-description-container">
                    <label class="wdic_label-desc-space-correct">Service Description:</label>
                    <section class="wdic-service-description"><textarea id="wdic_service_description" name="wdic_service_description"></textarea></section>
                </div>
            </div>
                </div>

    <?php else: ?>
        <input type="hidden" name="current_post_id" value="<?php echo $currentService->ID ?>">
                <div class="wdic-heading-center">
                    <h1 class="wdic_serviceHead">Edit Service</h1>
                </div>
        <div class="wdic-form-labels">
            <div class="wdic-color-choices">
                <div class="wdic-service-name-container">
                    <label>Service Name:</label>
                    <input name="wdic_name" type="text"  value="<?php echo esc_html(get_post_meta($currentService->ID, "service_name", true)); ?>">
                 </div>
                <div>
                 <label>Base Price:</label>
                 <input name="wdic_base_price"  type="number" step="0.01" value="<?php echo get_post_meta($currentService->ID, "service_price", true); ?>">
               </div>
<!--            <label>Icon:</label>-->
<!--            <input type="file" class="wdic-icon-uploader"  value="--><?php //echo get_post_meta($currentService->ID, "service_icon", true); ?><!--">-->
<!--            <div class="wdic-clear"></div>-->

            <!--                <label>Service Description:<textarea name="wdic_service_description">--><?php //echo get_post_meta($currentService->ID, "service_description", true); ?><!--</textarea></label>-->
            <div class="wdic-service-description-container">
                <label class="wdic_label-desc-space-correct">Service Description:</label>
                <section class="wdic-service-description"> <textarea id="wdic_service_description" name="wdic_service_description"><?php echo get_post_meta($currentService->ID, "service_description", true);?></textarea></section>
            </div>

        </div>
            </div>


    <?php endif; ?>
            <input type="hidden" name="wdic_edit" value="true">
            



    <div id="wdic_subCatCreation">




    </div>

    <div class="wdic-service-options-here">
        <?php if(isset($currentService)):
            $submenujson = get_post_meta($currentService->ID, "service_submenu", true);
            $submenujson = !$submenujson ? "[]" : $submenujson;
            $submenujson = json_decode($submenujson);
            if($submenujson!=null){
                foreach($submenujson as $submenu){
                    if(!isset($submenu->type)){
                        continue;
                    }
                    if($submenu->type == "dropdown"){
                        include "admin_dropdown_view.php";
                    }else if($submenu->type == "checkbox"){
                        include "admin_checkbox_view.php";
                    }else if($submenu->type == "toggle"){
                        include "admin_toggle_view.php";
                    }
                }
            }

        endif; ?>
    </div>
    <div class="wdic-add-service-optbox">

<!--        <span id="createService"><a class="create-subservice" href="#popup1"><span class="white">+ </a></span>-->
        <a id="wdic_create_service" class="wdic-create-subservice wdic-white wdic-sub-service-btn" href="#popup1">+</a>
    </div>


    <div id="wdic_popup1" class="wdic-select-popup-overlay">
        <div class="wdic-popup">
            <ul>

                <li class="wdic-add-toggle wdic-list-item">Add Toggle</li>

                <li class="wdic-add-dropdown wdic-list-item">Add Dropdown Menu</li>

                <li class="wdic-add-checkbox wdic-list-item">Add Checkbox</li>
            </ul>

            <a class="wdic-close">&times;</a>

        </div>
    </div>
    <div class="wdic-subServiceBtn">
        <input id="wdic_subService_btn" type="submit" class="wdic-white" value="Submit Service">
    </div>


</form>
</div>



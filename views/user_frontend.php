<div id="wdic-frontend-container">
    <input type="hidden" id="wdic_email_nonce" name="wdic_email_nonce" value="<?php echo wp_create_nonce("wdic_email_nonce"); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <div id="wdic_top_tabs">
        <?php
        $query = new WP_Query(array("post_type" => "squigwdicservice", "post_per_page" => -1, "orderby" => "menu_order", "order" => "ASC"));

        if ($query->have_posts()): while ($query->have_posts()): $query->the_post();
            $headingColor = get_option("wdic_service_heading_color");
            $backgroundColor = get_option("wdic_service_bg_color");
            ?>
<!--            <div style="background-color: --><?php //echo $backgroundColor; ?><!--" class="wdic-service-name"-->
<!--                 style="background-color: --><?php //echo get_post_meta(get_the_ID(), "service_color", true) ?><!--">-->
<!--                <p style="color: --><?php //echo $headingColor; ?><!--"-->
<!--                   class="wdic-innerText">--><?php //echo get_post_meta(get_the_ID(), "service_name", true); ?><!--</p>-->
<!--            </div>-->
            <div style="color: <?php echo $headingColor; ?>; background-color: <?php echo $backgroundColor?>" class="wdic-service-name">
                <div class="wdic-service-name-inner-text"> <?php echo get_post_meta(get_the_ID(), "service_name", true); ?></div>
            </div>

            <?php
        endwhile; endif;
        $query->rewind_posts();
        ?>

    </div>


    <ul>
        <?php
        $first = true;
        if ($query->have_posts()):while ($query->have_posts()): $query->the_post();
            $priceColor = get_option("wdic_service_price_color");
            $headingColor = get_option("wdic_service_heading_color");
            $backgroundColor = get_option("wdic_service_bg_color");
            $submitTextColor = get_option("wdic_submit_text_color");
            $affirmativeBgColor = get_option("wdic_submit_background_color");
            $negativeBgColor = get_option("wdic_negative_background_color");
            $descriptionColor = get_option("wdic_service_description_color");
            $continueText = get_option("wdic_continue_button_text", "Continue");
            $cancelText = get_option("wdic_cancel_button_text", "Cancel");
            $submitText = get_option("wdic_submit_button_text", "Submit");
            $emailText = get_option('wdic_email_text', "Your Email");
            $selectedOptionsText =  get_option('wdic_selected_options_text', "Selected Options");
            $additionalNotesText =  get_option('wdic_additional_notes_text', "Additional Notes");
            $textareaNotes =  get_option('wdic_textarea_comments_text', "Please type any other comments you wish to send");


            ?>
            <li style="background-color: <?php echo $backgroundColor; ?>"
                class="wdic-service-content-container" <?php if ($first) {
                echo "style='display:block'";
            }
            $first = false; ?>>
                <div class="wdic-bottomDiv">

                    <h1 style="color: <?php echo $headingColor; ?> !important;"
                        class="wdic-innerHeading"><?php echo get_post_meta(get_the_ID(), "service_name", true); ?></h1>

                    <p style="color: <?php echo $descriptionColor ?>" class="wdic-serviceText"><?php echo get_post_meta(get_the_ID(), "service_description", true); ?>
                    </p>


                    <!--                <p class="wdic-service-submenu">--><?php //echo get_post_meta(get_the_ID(), "service_icon", true); ?>
                    <!--                </p>-->

                    <div style="background-color: <?php echo $backgroundColor; ?>" class="wdic-service-submenu">
                        <?php
                        $submenujson = get_post_meta(get_the_ID(), "service_submenu", true);
                        $submenujson = !$submenujson ? "[]" : $submenujson;
                        $submenujson = json_decode($submenujson);
                        $checkboxIndex = 0;
                        $dropDownIndex = 0;
                        $toggleIndex = 0;
                        $dropCardColor = get_option("wdic_drop_card_color");
                        $toggleCardColor = get_option("wdic_toggle_card_color");
                        $checkCardColor = get_option("wdic_check_card_color");
                        if($submenujson!=null){

                            foreach ($submenujson as $submenu) {
                                if(!isset($submenu->type)){
                                    continue;
                                }
                                if ($submenu->type == "dropdown") {
                                    include "frontend/frontend_dropdown_view.php";
                                } else if ($submenu->type == "checkbox") {
                                    include "frontend/frontend_checkbox_view.php";
                                } else if ($submenu->type == "toggle") {
                                    include "frontend/frontend_toggle_view.php";
                                }
                            }
                        }
                        ?>
                    </div>
                    <input type="hidden" class="wdic-base-price" value="<?php echo get_post_meta(get_the_ID(), "service_price", true); ?>">
                    <?php
                    $currencyPosition = get_option("wdic_currency_selector", "left");
                    $currencySymbol = get_option("wdic_currency_input", "$");
                    if ($currencyPosition == "left"):?>
                        <p style="color: <?php echo $priceColor; ?>" class="wdic-service-price">
                            <span class="wdic-price-symbol"><?php echo $currencySymbol; ?></span><span
                                class="wdic-price-amount"><?php echo get_post_meta(get_the_ID(), "service_price", true); ?></span>
                        </p>
                        <?php
                    else:
                        ?>
                        <p style="color: <?php echo $priceColor; ?>" class="wdic-service-price"><span
                                class="wdic-price-amount"><?php echo get_post_meta(get_the_ID(), "service_price", true); ?></span><span
                                class="wdic-price-symbol"><?php echo $currencySymbol; ?></span>
                        </p>
                        <?php
                    endif;
                    ?>

                    <button style="background-color: <?php echo $affirmativeBgColor; ?>; color: <?php echo $submitTextColor; ?>"  class="wdic-continue-to-submission"><?php echo $continueText ?></button>
                </div>

                <div class="wdic-service-checkout">

                    <label class="wdic-checkout-email" style="color: <?php echo $headingColor; ?>"><?php echo $emailText ?></label>
                    <input class="wdic-checkout-email-input" type="email" required>
                    <label class="wdic-checkout-options" style="color: <?php echo $headingColor; ?>"><?php echo $selectedOptionsText ?></label>
                    <textarea class="wdic-textarea wdic-textarea-options-list" readonly></textarea>
                    <label class="wdic-notes"  style="color: <?php echo $headingColor; ?>"><?php echo $additionalNotesText ?></label>
                    <textarea class="wdic-textarea wdic-email-notes" placeholder="<?php echo $textareaNotes ?>" onfocus="this.placeholder = ''"></textarea>
                    <div class="wdic-catagory-and-price">

                        <div class="wdic-checkout-price">
                            <label class="wdic-checkout-name"><?php echo get_post_meta(get_the_ID(), "service_name", true); ?>: </label>
                            <?php
                            if ($currencyPosition == "left"):?>
                            <p style="color: <?php echo $priceColor; ?>" class="wdic-service-price">
                                <span class="wdic-price-symbol"><?php echo $currencySymbol; ?></span><span
                                    class="wdic-price-amount"><?php echo get_post_meta(get_the_ID(), "service_price", true); ?></span>
                            </p>
                            <?php
                            else:
                            ?>
                            <p style="color: <?php echo $priceColor; ?>" class="wdic-service-price"><span
                                    class="wdic-price-amount"><?php echo get_post_meta(get_the_ID(), "service_price", true); ?></span><span
                                    class="wdic-price-symbol"><?php echo $currencySymbol; ?></span>
                            </p>
                            <?php
                            endif;
                            ?>

                        </div>
                    </div>

                        <div class="wdic-checkout-buttons">
                            <button style="background-color: <?php echo $negativeBgColor; ?>; color: <?php echo $submitTextColor; ?>" class="wdic-checkout-cancel"><?php echo $cancelText ?></button>
                            <button style="background-color: <?php echo $affirmativeBgColor ; ?>; color: <?php echo $submitTextColor; ?>" class="wdic-checkout-submit"><?php echo $submitText ?></button>
                        </div>
                </div>
            </li>


            <?php
        endwhile; endif;
        ?>
    </ul>

</div>
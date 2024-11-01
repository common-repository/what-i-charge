<?php
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['wdic_service_page'])){
        if(!current_user_can("manage_options")){
            wp_die("you do not have permission to modify these settings");
        }

        check_admin_referer("wdic_edit_settings");


        //button Text
        $continueText = esc_html($_POST['wdic_continue_button_text']);
        $cancelText  = esc_html($_POST['wdic_cancel_button_text']);
        $submitText  = esc_html($_POST['wdic_submit_button_text']);
        $successText  = esc_html($_POST['wic_email_success_message']);
        $emailError = esc_html($_POST['wic_email_error_message']);


        update_option("wdic_continue_button_text", $continueText);
        update_option("wdic_cancel_button_text", $cancelText);
        update_option("wdic_submit_button_text", $submitText);
        update_option("wic_email_success_message", $successText);
        update_option("wic_email_error_message", $emailError);

        $emailText = esc_html($_POST['wdic_email_text']);
        $selectedOptionsText = esc_html($_POST['wdic_selected_options_text']);
        $additionalNotesText = esc_html($_POST['wdic_additional_notes_text']);
        $textareaNotes = esc_html($_POST['wdic_textarea_comments_text']);

        update_option("wdic_email_text", $emailText );
        update_option("wdic_selected_options_text", $selectedOptionsText );
        update_option("wdic_additional_notes_text", $additionalNotesText );
        update_option("wdic_textarea_comments_text", $textareaNotes );



        //currency
        $currencySymbol = esc_html($_POST['wdic_currency_input']);
        update_option("wdic_currency_input", $currencySymbol);


        $currencyPosition = $_POST['wdic_currency_selector'];

        if ($currencyPosition != "left" && $currencyPosition != "right") {
            $currencyPosition = "left";
        }

        update_option("wdic_currency_selector", $currencyPosition);


        //User Email Save
        $userEmail = $_POST['wdic_user_email'];

        if(!filter_var($userEmail, FILTER_VALIDATE_EMAIL) ) {
            wp_die("This is not a valid email");

        }

        update_option("wdic_user_email", $userEmail);





        wp_die("<h1>Your settings have been updated</h1>
                <script>setTimeout(function(){window.location.reload();},3000)</script>");

    }
    $customCSS = false;


?>
<meta name="viewport" content="width=device-width, initial-scale=1" xmlns="http://www.w3.org/1999/html">
<div id="wdic_container">
    <div id="what-i-charge-admin">

        <h1 class="wdic-serviceHead-center">Set General Settings</h1>



        <form method="post" >
            <input type="hidden" name="current_post_id" value="new">
            <input type="hidden" name="wdic_service_page" value="1">

            <?php wp_nonce_field("wdic_edit_settings"); ?>

            <div class="wdic-form-labels">


                <div class="wdic-general-settings-card">
                    <div class="wdic-email">
                        <label name="wdic_user_email_text" id="wdic_user_email">Email for client submissions:</label>
                        <input name="wdic_user_email" type="email" class="wdic-email-input"
                               value="<?php echo get_option("wdic_user_email", get_option("admin_email", "")); ?>">
                    </div>
                    <div id="wdic_currency_div">
                        <label name="wdic_currency" id="wdic_currency">Currency:</label>
                        <input name="wdic_currency_input" id="wdic_currency_input"
                               value="<?php echo get_option("wdic_currency_input", "$"); ?>">
                    </div>
                    <div id="wdic_currency_symbol_div">
                        <label id="wdic_symbol">Currency symbol position:</label>
                        <select name="wdic_currency_selector" id="wdic_symbol_select">
                            <?php
                            $currencyPosition = get_option("wdic_currency_selector", "left");
                            if ($currencyPosition == "left") :?>
                                <option value="left" selected>Left</option>
                                <option value="right">Right</option>
                                <?php


                            else :?>
                                <option value="left">Left</option>
                                <option value="right" selected>Right</option>
                                <?php
                            endif;

                            ?>

                        </select>
                    </div>




                    <div class="wdic-text-change">
                        <div>
                            <label id="submit_button_label">Submit Button Text</label>
                            <input class="submit-button-input" name="wdic_submit_button_text"
                                   value="<?php echo get_option("wdic_submit_button_text", "Submit"); ?>"/>
                        </div>

                        <div>
                            <label id="continue_button_label">Continue Button Text</label>
                            <input class="continue-button-input" name="wdic_continue_button_text"
                                   value="<?php echo get_option("wdic_continue_button_text", "Continue"); ?>"/>
                        </div>
                        <div>
                            <label id="cancel_button_label">Cancel Button Text</label>
                            <input class="cancel-button-input" name="wdic_cancel_button_text"
                                   value="<?php echo get_option("wdic_cancel_button_text", "Cancel"); ?>"/>
                        </div>
                            <div>
                                <label id="email_text_label">Your Email Text</label>
                                <input class="email-text-input" name="wdic_email_text"
                                       value="<?php echo get_option("wdic_email_text", "Your Email"); ?>"/>
                            </div>
                        <div>
                            <label id="selected_options_label">Select Options Text</label>
                            <input class="selected-options-input" name="wdic_selected_options_text"
                                   value="<?php echo get_option("wdic_selected_options_text", "Selected Options"); ?>"/>
                        </div>
                        <div>
                            <label id="additional_notes_label">Additional Notes Text</label>
                            <input class="additional-notes-input" name="wdic_additional_notes_text"
                                   value="<?php echo get_option("wdic_additional_notes_text", "Additional Notes"); ?>"/>
                        </div>
                        <div>
                            <label id="textarea_comments_label">Text Area Notes</label>
                            <input class="textarea-comments-input" name="wdic_textarea_comments_text"
                                   value="<?php echo get_option("wdic_textarea_comments_text", "Please type any other comments you wish to send"); ?>"/>
                        </div>

                        <div>
                            <label id="success_text_label">Submission Success Text</label>
                            <input class="success-text-input" name="wic_email_success_message"
                                   value="<?php echo get_option("wic_email_success_message", "Thank you for your submission!"); ?>"/>
                        </div>

                        <div>
                            <label id="email_error_text_label">Email Error Alert Text</label>
                            <input class="email-error-text-input" name="wic_email_error_message"
                                   value="<?php echo get_option("wic_email_error_message", "This is not a valid Email"); ?>"/>
                        </div>

                    </div>


                </div>


               

                <div id="wdic_popup1" class="wdic-select-popup-overlay">
                    <div class="wdic-popup">
                        <div class="wdic-ref-image">
                            <img class="wdic-checkbox-help-image" src="<?php echo plugin_dir_url(__FILE__); ?>images/checkboxOptions.png">
                            <img class="wdic-toggle-help-image" src="<?php echo plugin_dir_url(__FILE__); ?>images/toggleOptions.png">
                            <img class="wdic-dropdown-help-image" src="<?php echo plugin_dir_url(__FILE__); ?>images/dropdownOptions.png">
                            <img class="wdic-submit-help-image" src="<?php echo plugin_dir_url(__FILE__); ?>images/buttonOptions.png">
                        </div>

                        <a class="wdic-close">&times;</a>


                    </div>
                </div>




                <div class="wdic-submit-settings-container">
                    <input class="wdic-sub-service-btn wdic_white" type="submit" value="Save Settings">
                </div>
            </div>
        </form>
    </div>
</div>
<?php
/*
Plugin Name: What I Charge
Plugin URI: https://squiggledevelopment.com
Description: What I Charge allows your clients to dynamically generate quotes for services you offer
Author: Squiggle Development LLC
Version: 1.1
Author URI: https://squiggledevelpment.com
License: GPL2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


namespace SquiggleDevWDIC{

    class WhatICharge{

        function __construct(){
            add_action("admin_menu", array($this,"adminMenu"));
            add_action("admin_enqueue_scripts", array($this, "adminEnqueueScripts"));
            add_filter("the_content", array($this,"pluginContent"));
            add_action("wp_enqueue_scripts", array($this, "enqueueFrontEnd"));
            add_action("wp_ajax_delete_service", array($this, "deleteService"));
            add_action("wp_ajax_get_subservice", array($this,"ajax_get_subservice"));
            add_action("wp_ajax_reorder_services", array($this, "reorder_services"));
            add_action("wp_ajax_email_services", array($this, "email_services"));
            add_action("wp_ajax_nopriv_email_services", array($this, "email_services"));
            add_action("init", array($this, "registerPostType"));
            add_filter( 'plugin_action_links', array($this, 'squiggle_plugin_action_links'), 10, 2);



            register_activation_hook(__FILE__, array("SquiggledevWDIC\\WhatICharge", "registerPlugin"));
            register_deactivation_hook(__FILE__, array("SquiggledevWDIC\\WhatICharge", "degregisterPlugin"));
        }

        function registerPostType(){
            register_post_type("squigwdicservice");
        }

        function email_services(){
            check_ajax_referer("wdic_email_nonce", "wdic_email_nonce", true);
            $userEmail = $_POST['user_email'];
            $serviceNotes = $_POST['service_notes'];
            $userComment = $_POST['user_comments'];
            $adminEmail = get_option("wdic_user_email", get_option("admin_email", ""));

            
            if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL) ) {
                http_response_code(500);
                wp_die(get_option("wic_email_error_message", "This is not a valid Email"));
            }
             

            if (!$adminEmail || $adminEmail == "" ) {
                http_response_code(500);
                wp_die("No Admin email was setup");
            }
            $emailSubject = "Request from: ". $userEmail;
            $emailBody = $serviceNotes . "\n\n". $userComment;


            if(!wp_mail($adminEmail, $emailSubject, $emailBody)) {
                http_response_code(500);
                wp_die("email error");
            };
            wp_die("success");



        }


        function ajax_get_subservice(){
            if(!current_user_can("manage_options")){
                wp_die("invalid permission");
            }
            $service = $_POST['service'];
            if($service == "toggle"){
                include __DIR__."/views/admin_toggle_view.php";
            }
            else if($service == "dropdown"){
                include __DIR__."/views/admin_dropdown_view.php";

            }else if($service == "checkbox"){
                include __DIR__."/views/admin_checkbox_view.php";

            }
            wp_die();
        }
         function reorder_services (){
             check_ajax_referer("wdic_reorder_services_nonce","wdic_reorder_services_nonce", true);

             if(!current_user_can("manage_options")) {
                 wp_die("invalid permissions");
             }
             $serviceArray = $_POST["serviceJSON"];

             for ($i = 0; $i < count($serviceArray); $i++) {
                $servicePost =  get_post($serviceArray[$i]);
                 $servicePost->menu_order = $i;
                 wp_update_post($servicePost);
             }
             wp_die();
         }
        function deleteService(){
            if(!current_user_can("manage_options")){
                wp_die("invalid request");
            }
            if(!wp_verify_nonce($_POST['nonce'], "delete_service")){
                wp_die("you do not have permission to use this action");
            }

            $id = $_POST['id'];

            $wdicServiceCheck = get_post($id);
            if($wdicServiceCheck != null && $wdicServiceCheck->post_type != "squigwdicservice") {
                wp_die("This is not a What I Charge service");

            }

            wp_trash_post($id);
            wp_die("success");


        }

        function enqueueFrontEnd(){
            wp_enqueue_style("wdic-frontend-css", plugin_dir_url(__FILE__)."stylesheets/wdicfrontendstyle.css" );
            wp_register_script("what_i_charge_frontend", plugin_dir_url(__FILE__)."js/wdic_frontend.js", array("jquery"));
            wp_localize_script("what_i_charge_frontend", "ajaxurl", admin_url("admin-ajax.php"));
            wp_localize_script("what_i_charge_frontend", "wicEmailSuccessMessage", get_option("wic_email_success_message", "Thank you for your submission!"));
            wp_enqueue_style("what_i_charge_custom", plugin_dir_url(__FILE__)."stylesheets/custom.css", array("wdic-frontend-css"));
            wp_enqueue_script("what_i_charge_frontend");

        }

        function pluginContent($content){
            if(is_page("what-i-charge")){
                ob_start();
                include  __DIR__ . "/views/user_frontend.php";

                $pluginContent = ob_get_contents();
                ob_end_clean();
                return $pluginContent;

            }
            return $content;
        }

        function pageTemplate($template){
            if(is_page("what-i-charge")){
                return __DIR__ . "/what_i_charge_frontend.php";
            }
            return $template;
        }



        static function registerPlugin(){
            if(!get_page_by_path("what-i-charge")){
                wp_insert_post(array("post_type"=>"page", "post_status"=>"publish", "post_title"=>"What I Charge", "post_name"=>"what-i-charge"));
            }

            //create options
            
            //Text Vars
            if(!get_option("wdic_submit_button_text")){
                update_option("wdic_submit_button_text", "Submit");
            }
            if(!get_option("wdic_continue_button_text")){
                update_option("wdic_continue_button_text", "Continue");
            }
            if(!get_option("wdic_cancel_button_text")){
                update_option("wdic_cancel_button_text", "Cancel");
            }
            if(!get_option("wdic_email_text")){
                update_option("wdic_email_text", "Your Email");
            }
            if(!get_option("wdic_selected_options_text")){
                update_option("wdic_selected_options_text", "Selected Options");
            }
            if(!get_option("wdic_additional_notes_text")){
                update_option("wdic_additional_notes_text", "Additional Notes");
            }
            if(!get_option("wdic_textarea_comments_text")){
                update_option("wdic_textarea_comments_text", "Please type any other comments you wish to send");
            }
            if(!get_option("success_text_label")){
                update_option("success_text_label", "Thank you for your submission!");
            }
            if(!get_option("email_error_text_label")){
                update_option("email_error_text_label", "This is not a valid Email");
            }


            //card colors
            if(!get_option("wdic_toggle_card_color")){
                update_option("wdic_toggle_card_color", "#283238");
            }

            if(!get_option("wdic_check_card_color")){
                update_option("wdic_check_card_color", "#283238");
            }

            if(!get_option("wdic_drop_card_color")){
                update_option("wdic_drop_card_color", "#283238");
            }


            if(!get_option("wdic_service_bg_color")){
                update_option("wdic_service_bg_color", "#647c8a");
            }
            if(!get_option("wdic_service_heading_color")){
                update_option("wdic_service_heading_color", "#ffffff");
            }
            if(!get_option("wdic_service_description_color")){
                update_option("wdic_service_description_color", "#ffffff");
            }
            if(!get_option("wdic_service_price_color")){
                update_option("wdic_service_price_color", "#ffffff");
            }


            //toggle
            if(!get_option("wdic_toggle_heading_color")){
                update_option("wdic_toggle_heading_color", "#ffffff");
            }

            if(!get_option("wdic_toggle_on_color")){
                update_option("wdic_toggle_on_color", "#3fc380");
            }

            if(!get_option("wdic_toggle_off_color")){
                update_option("wdic_toggle_off_color", "#95a5a6");
            }


            //checkboxes
            if(!get_option("wdic_check_heading_color")){
                update_option("wdic_check_heading_color", "#ffffff");
            }

            if(!get_option("wdic_check_bg_check_color")){
                update_option("wdic_check_bg_check_color", "#22A7F0");
            }

            if(!get_option("wdic_check_text_color")){
                update_option("wdic_check_text_color", "#ffffff");
            }

            if(!get_option("wdic_check_bg_check_color")){
                update_option("wdic_check_bg_check_color", "#3aafda");
            }


            //Dropdown
            if(!get_option("wdic_drop_heading_color")){
                update_option("wdic_drop_heading_color", "#ffffff");
            }

            if(!get_option("wdic_drop_bg_color")){
                update_option("wdic_drop_bg_color", "#2c3e50");
            }


            if(!get_option("wdic_drop_text_color")){
                update_option("wdic_drop_text_color", "#e4f1fe");
            }

            if(!get_option("wdic_drop_hover_color")){
                update_option("wdic_drop_hover_color", "#336e7b");
            }


            if(!get_option("wdic_drop_select_option_color")){
                update_option("wdic_drop_select_option_color", "#446cb3");
            }


            //currency

            if(!get_option("wdic_currency_input")){
                update_option("wdic_currency_input", "$");
            }

            if(!get_option("wdic_currency_selector")){
                update_option("wdic_currency_selector", "left");
            }

            //submit button

            if(!get_option("wdic_submit_btn_text_color")){
                update_option("wdic_submit_btn_text_color", "#ffffff");
            }

            if(!get_option("wdic_affirmative_btn_background_color")){
                update_option("wdic_affirmative_btn_background_color", "#66CC99");
            }

            if(!get_option("wdic_negative_btn_background_color")){
                update_option("wdic_negative_btn_background_color", "#CF000F");
            }


        }

        function adminMenu(){
            add_menu_page("What I Charge", "What I Charge", "manage_options", "what_i_charge_menu", array($this,"adminMenuPage"));
            add_submenu_page("what_i_charge_menu", "Settings", "Settings", "manage_options", "what_i_charge_settings_menu", array($this,"adminSettingsPage"));
        }


        function adminSettingsPage() {
            if(!current_user_can("manage_options")) {
                wp_die("you do not have permission to view");
            }
            include "views/admin_settings_sub_menu.php";
        }
        function adminMenuPage(){
            if(!current_user_can("manage_options")){
                wp_die("you do not have permission to view");
            }
            if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['wdic-submission'])){
                check_admin_referer("wdic_edit_submission");
                $serviceName = $_POST['wdic-name'];
                $sericePrice = $_POST['wdic-base-price'];
                $data = array("post_type"=>"squigwdicservice", "post_status"=>"publish");
                $postID = wp_insert_post($data);
                add_post_meta($postID,"service_name", $serviceName);
                add_post_meta($postID, "service_price", $sericePrice);
            }
            include "views/admin_settings_view.php";
        }

        function adminEnqueueScripts(){
            wp_enqueue_script("what_i_charge_admin_global", plugin_dir_url(__FILE__)."js/admin_global.js", array("jquery"));
            wp_enqueue_style("what_i_charge_admin_globals_styles", plugin_dir_url(__FILE__)."stylesheets/wdic_admin_global.css");


            if(get_current_screen()->base == "what-i-charge_page_what_i_charge_settings_menu"){
                wp_enqueue_style("what_i_charge_admin_settings", plugin_dir_url(__FILE__)."stylesheets/wdicsettings.css");
                wp_enqueue_script("what_i_charge_settings_scripts", plugin_dir_url(__FILE__)."js/wdic_settings.js");
            }else if(strpos(get_current_screen()->base, "what_i_charge_menu")!=false){
                wp_enqueue_script("what_i_charge_admin", plugin_dir_url(__FILE__)."js/admin.js", array("jquery","media-upload", "thickbox"));
                wp_localize_script("what_i_charge_admin", "wdicPluginURL", plugin_dir_url(__FILE__));
                wp_enqueue_style("what_i_charge_style", plugin_dir_url(__FILE__)."stylesheets/wdicstyle.css");

            }
        }

        function squiggle_plugin_action_links($links, $file)
        {

            $upgrade_link = '<a href="https://squiggledevelopment.com/product/what-i-charge-plugin/" target="_blank" style="color:#F2784B;"> Upgrade to Pro</a>';
            if( $file == 'wicfree/plugin.php' ) array_unshift( $links, $upgrade_link );

            return $links;
        }

    }

    new WhatICharge();



}
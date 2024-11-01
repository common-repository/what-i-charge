<?php


if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['wdic_edit'])) {
    check_admin_referer("wdic_edit_submission");
    if(!current_user_can("manage_options")){
        wp_die("you must have manage options permission");
    }
    if (!isset($_POST['current_post_id']) || !isset($_POST['wdic_name']) ||
        !isset($_POST['wdic_service_description']) ||
        !isset($_POST['wdic_base_price'])
    ) {
        wp_die("what do I charge : not all parameters are set");
    }
    $id = isset($_POST['current_post_id']) ? $_POST['current_post_id'] : 0;
    $name = esc_html($_POST['wdic_name']);
    $description = esc_html($_POST['wdic_service_description']);
    $basePrice = $_POST['wdic_base_price'];
    if(!filter_var($basePrice, FILTER_VALIDATE_FLOAT)){
        wp_die("price must be a float");
    }

    $submenu = isset($_POST['submenu_json']) ? $_POST['submenu_json'] : "[]";
    if(json_decode(stripslashes($submenu))===null){
        wp_die("invalid submenu json");
    }


    $createNew = false;
    if ($id == 0) {
        $createNew = true;
        $id = wp_insert_post(array("post_type" => "squigwdicservice", "post_status" => "publish"));
    }
    $squigPost = get_post($id);

    if ($squigPost->post_type != "squigwdicservice" ) {
        wp_die("This is not a What I Charge Service");
    }

    update_post_meta($id, "service_name", $name);
    update_post_meta($id, "service_price", $basePrice);
    update_post_meta($id, "service_description", $description);
    update_post_meta($id, "service_submenu", $submenu);

    if($createNew){
        //updated the order to be the last
        $servicesQuery = new WP_Query(array("post_type"=>"squigwdicservice"));
        $index = $servicesQuery->post_count;
        $post = get_post($id);
        $post->menu_order = $index;
        wp_update_post($post);
    }

}
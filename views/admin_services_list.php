<meta name="viewport" content="width=device-width, initial-scale=1">
<div id="wdic_container">
    <input type="hidden" id="wdic_reorder_services_nonce" name="wdic_reorder_services_nonce" value="<?php echo wp_create_nonce("wdic_reorder_services_nonce"); ?>">
    <div class="wdic-heading">
    <h1 class="wdic_serviceHead wdic-service-list-heading">Services</h1>
    <div id="wdic_service_plus_position"><a id="wdic_createServicePlus" data-tooltip="Create New Service" data-placement="right" href="<?php echo $_SERVER['REQUEST_URI'] ?>&edit=new">+</a></div>
  </div>




    <ul id="wdic-categories">
        <?php
        $query = new WP_Query(array("post_type" => "squigwdicservice", "posts_per_page" => -1, "orderby" => 'menu_order', "order"=> "ASC" ));


        if ($query->have_posts()):while ($query->have_posts()) :
            $query->the_post()?>

            <li class="wdic-catagory-list">
                <div class="wdic-service-arrows">
                    <span class="wdic-move-up"><img class="wdic-up-arrow-service" src="<?php echo plugin_dir_url(__FILE__); ?>images/wdic-arrow.svg"></span>
                    <span class="wdic-move-down"><img class="wdic-down-arrow-service" src="<?php echo plugin_dir_url(__FILE__); ?>images/wdic-arrow.svg"></span>
                </div>
                <div class="wdic-service-name"><?php echo get_post_meta(get_the_ID(), "service_name", true); ?></div>
<!--                <div class="wdic-service-price"><span class="wdic-center-test"> --><?php //echo get_post_meta(get_the_ID(), "service_price", true); ?><!--</span></div>-->

                <div class="wdic-catButtons">
<!--                        <button class="blueBtn" type="">View</button>-->
<!--                        THIS NEEDS HELP-->
                        <a href="<?php echo $_SERVER['REQUEST_URI']."&edit=".get_the_ID(); ?>"><button class="wdic-greenBtn" type=""> Edit</button></a>
                        <button delete-nonce="<?php echo wp_create_nonce("delete_service") ?>" service-id="<?php the_ID();   ?>" class="wdic-redBtn" type="">Delete</button>
                </div>
            </li>
        <?php
        endwhile;endif;
        ?>
    </ul>

</div>
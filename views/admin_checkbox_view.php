<?php
    if(!isset($submenu)){
        $submenu = new stdClass();
        $submenu->name = "";
        $textColor ="#ECECEC" ;
//        $backgroundColor = "#cccccc";
        $headingColor ="#ECECEC" ;
        $checkmarkBGColor ="#03A9F4" ;
        $checkmarkColor = "whiteCheck";



        $option = new stdClass();
        $option->name = "";
        $option->priceType="baseIncrease";
        $option->price="";
        $option->whiteCheck="";
        $option->blackCheck="";

        $submenu->options = array($option);
    }


$submenu->textColor = $submenu->textColor ? $submenu->textColor : get_option("wdic_check_text_color", $textColor);
$submenu->headingColor = $submenu->headingColor ? $submenu->headingColor : get_option("wdic_check_heading_color", $headingColor);
$submenu->checkBgColor =  isset($submenu->checkBgColor) ? $submenu->checkBgColor : get_option("wdic_check_bg_check_color", $checkmarkBGColor);
$submenu->checkmarkColor =  isset($submenu->checkmarkColor) ? $submenu->checkmarkColor : get_option("wdic_check_checkmark_color", $checkmarkColor);


?>



<div  class="wdic-submenu-container wdic-checkOpts">


    <input name="wdic-subservice-checkbox-id" type="hidden" value="new">
    <div class="wdic-checkbox-top-content">
        <div class="wdic-arrows">
            <span class="wdic-move-up"><img class="wdic-up-arrow" src="<?php echo plugin_dir_url(__FILE__); ?>images/wdic-arrow.svg"></span>
            <span class="wdic-move-down"><img class="wdic-down-arrow" src="<?php echo plugin_dir_url(__FILE__); ?>images/wdic-arrow.svg"></span>
        </div>

           <h1 class="wdic_optHead">Checkboxes</h1>
        <span class="wdic-x wdic-checkboxDelete">X</span>
    </div>


    <!--        <button class="wdic-serviceOptDel checkboxDelete wdic-heading-delete " type=""><span class="wdic_white"> -</span></button>-->

        <div class="wdic-check-center">

                <label>Heading Text</label>
                <input required name="wdic-subservice-checkbox-name" type="text" value="<?php echo isset($submenu->name) ? esc_html($submenu->name): ""; ?>">
            </div>





    <div>
        <div class="wdic-option-container">
            <?php
            $index = 1;
            if(isset($submenu->options) && is_array($submenu->options)):
            foreach($submenu->options as $option): ?>
                <div class="wdic-checkbox-option">

                    <label class="wdic-option-label">option <span class="wdic-checkbox-index"><?php echo $index; ?></span>:</label>
                    <input required name="wdic-submenu-option-name" type="text" value="<?php echo isset($option->name) ? esc_html($option->name) : ""; ?>">
                    <label class="wdic-indent wdic-mobile-label">Price:</label>
                    <input required name="wdic-option-price" class="wdic-price-pad" type="number" step="0.01" value="<?php echo (isset($option->price) && filter_var($option->price, FILTER_VALIDATE_FLOAT)) ? $option->price : 0; ?>">
                    <button class="wdic-serviceOpt wdic-add-checkbox-option wdic-white" type="">+</button>
                    <button class="wdic-serviceOptDel wdic-delete-checkbox-option wdic-white" type="">-</button>
                </div>
            <?php $index++; endforeach; endif; ?>
            <button class="wdic-serviceOpt wdic-add-checkbox-option wdic-white wdic-mobile-only" type="">+</button>
        </div>

    </div>

</div><div class="wdic-col2">
    <!-- Column two start -->



    <!-- Column two end -->


</div>



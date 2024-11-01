<?php
if(!isset($submenu)){
    $submenu = new stdClass();
    $submenu->name = "";
    $textColor = "#ffffff" ;
    $backgroundColor =  "#009688";
    $hoverColor =  "#19A094";
    $option = new stdClass();
    $option->name = "";
    $option->price="";
    $option->priceType="baseIncrease";
    $headingColor = "#ffffff";
    $submenu->options = array($option);
    $selectBackgroundColor = "#009688";

}



$submenu->textColor = $submenu->textColor ? $submenu->textColor : get_option("wdic_drop_text_color", $textColor);
$submenu->backgroundColor = $submenu->backgroundColor ? $submenu->backgroundColor : get_option("wdic_drop_bg_color", $backgroundColor);
$submenu->hoverColor = $submenu->hoverColor ? $submenu->hoverColor : get_option("wdic_drop_hover_color", $hoverColor);
$submenu->headingColor = $submenu->headingColor ? $submenu->headingColor : get_option("wdic_drop_heading_color", $headingColor);
$submenu->selectBackgroundColor = $submenu->selectBackgroundColor ? $submenu->selectBackgroundColor : get_option("wdic_drop_select_option_color", $selectBackgroundColor);

?>
<div  class="wdic-submenu-container wdic-dropOpts">
    <input name="wdic-subservice-drop-id" type="hidden" value="new">

    <div class="wdic-dropdown-top-content">

        <div class="wdic-arrows">
        <span class="wdic-move-up"><img class="wdic-up-arrow" src="<?php echo plugin_dir_url(__FILE__); ?>images/wdic-arrow.svg"></span>
        <span class="wdic-move-down"><img class="wdic-down-arrow" src="<?php echo plugin_dir_url(__FILE__); ?>images/wdic-arrow.svg"></span>
        </div>

        <h1 class="wdic_optHead">Dropdown</h1>
        <span class="wdic-x wdic-dropDelete">X</span>

        <!--        <button class="wdic-serviceOptDel wdic-dropDelete wdic-heading-delete " type=""><span class="wdic_white"> -</span></button>-->
    </div>


    <div class="wdic-drop-center">

        <!-- Column one start -->
        <div>
            <label>Heading Text</label>
            <input required name="wdic-subservice-drop-name" type="text" value="<?php echo isset($submenu->name) ? esc_html($submenu->name): ""; ?>">
        </div>

    </div><div class="wdic-col2">
        <!-- Column two start -->



        <!-- Column two end -->


    </div>



    <div>
        <div class="wdic-option-container">
            <?php
            $index = 1;
            if(isset($submenu->options) && is_array($submenu->options)):
            foreach($submenu->options as $option): ?>
                <div class="wdic-drop-option">

                    <label class="wdic-option-label">option <span class="wdic-drop-index"><?php echo $index; ?></span>:</label>
                    <input required name="wdic-submenu-option-name" type="text" value="<?php echo isset($option->name) ? esc_html($option->name) : ""; ?>">
                    <label class="wdic-mobile-label">Price:</label>
                    <input required name="wdic-option-price" class="wdic-price-pad" type="number" step="0.01" value="<?php echo (isset($option->price) && filter_var($option->price, FILTER_VALIDATE_FLOAT)) ? $option->price : 0; ?>">
                    <button class="wdic-serviceOpt wdic-add-drop-option wdic-white" type="">+</button>
                    <button class="wdic-serviceOptDel wdic-delete-drop-option wdic-white" type="">-</button>
                </div>
                <?php $index++; endforeach; endif; ?>
            <button class="wdic-serviceOpt wdic-add-drop-option wdic-white wdic-mobile-only" type="">+</button>
        </div>



    </div>
</div>



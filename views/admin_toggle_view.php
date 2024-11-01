<?php
if(!isset($submenu)){
    $submenu = new stdClass();
    $submenu->name = "";
    $submenu->heading = "";

    $submenu->priceType = "baseIncrease";
    $submenu->price = "";

    $OnColor = "#77C2BB";
    $OffColor = "#B0AFAF";
    $headingColor = "#ECECEC";
}

$submenu->OnColor = $submenu->OnColor ? $submenu->OnColor : get_option("wdic_toggle_on_color", $OnColor);
$submenu->headingColor = $submenu->headingColor ? $submenu->headingColor : get_option("wdic_toggle_heading_color", $headingColor);
$submenu->OffColor = $submenu->OffColor ? $submenu->OffColor : get_option("wdic_toggle_off_color", $OffColor);
?>
<div  class="wdic-submenu-container wdic-toggleOpts">
    <input name="wdic-subservice-toggle-id" type="hidden" value="new">
    <div class="wdic-toggle-top-content">
        <div class="wdic-arrows">
        <span class="wdic-move-up"><img class="wdic-up-arrow" src="<?php echo plugin_dir_url(__FILE__); ?>images/wdic-arrow.svg"></span>
        <span class="wdic-move-down"><img class="wdic-down-arrow" src="<?php echo plugin_dir_url(__FILE__); ?>images/wdic-arrow.svg"></span>
        </div>
        <h1 class="wdic_optHead">Toggle</h1>
        <span class="wdic-x  wdic-toggleDelete">X</span>

<!--        <button class="wdic-serviceOptDel wdic-toggleDelete wdic-heading-delete" type=""><span class="wdic_white"> -</span></button>-->
    </div>

        <div class="wdic-toggle-center">
            <div>

                <label>Heading Text</label>
                <input required name="wdic-subservice-toggle-heading" type="text" value="<?php echo isset($submenu->heading) ? esc_html($submenu->heading) : ""; ?>">
            </div>
            <div>
                <label>On/Off Option</label>
                <input required name="wdic-submenu-option-name" class="wdic-toggle-option-text" type="text" value="<?php echo isset($submenu->name) ? esc_html($submenu->name) : ""; ?>">

            </div>


                <div class="wdic-toggle-option">

                    <label>Price:</label>
                    <input required name="wdic-option-price" type="number" step="0.01" value="<?php echo (isset($submenu->price) && filter_var($submenu->price, FILTER_VALIDATE_FLOAT) ) ? $submenu->price : 0; ?>">
                    <!--                    <button class="wdic-serviceOptDel wdic-delete-toggle-option wdic-white" type="">-</button>-->
                </div>



            <!-- Column one end -->
        </div><div class="wdic-col2">
            <!-- Column two start -->



            <!-- Column two end -->


        </div>


</div>



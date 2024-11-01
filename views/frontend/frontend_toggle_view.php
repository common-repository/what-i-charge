<div class="wdic-toggle-container wdic-subservice-container" style="background-color: <?php echo $toggleCardColor ?>">
    <div class="wdic-toggle-heading" style="color:<?php echo get_option("wdic_toggle_heading_color"); ?>"><?php echo isset($submenu->heading) ? esc_html($submenu->heading) : ""; ?></div>
    <div class='wdic-toggle-option-container'>
        <div class="wdic-toggle-option" style="color:<?php echo get_option("wdic_toggle_heading_color"); ?>"><?php echo isset($submenu->name) ? esc_html($submenu->name) : ""; ?></div>

        <div class="wdic-frontend-toggle-option">
            <div class="wdic-onoffswitch">
                <?php $onColor = get_option("wdic_toggle_on_color"); $offColor = get_option("wdic_toggle_off_color"); ?>
                <input type="checkbox" name="onoffswitch" class="wdic-onoffswitch-checkbox"   >
                <span offColor="<?php echo $offColor ?>" onColor="<?php echo $onColor; ?>" style="border-color:<?php echo $offColor; ?>;background-color: <?php echo $offColor; ?>" class="wdic-onoffswitch-span"></span>
                <label offColor="<?php echo $offColor; ?>" onColor="<?php echo $onColor?>" style="border-color:<?php echo $offColor; ?>;background-color: <?php echo $offColor; ?>" class="wdic-onoffswitch-label" ></label>
            <input type="hidden" name="wdic-toggle-option-price" value="<?php echo (isset($submenu->price) && filter_var($submenu->price, FILTER_VALIDATE_FLOAT)) ? $submenu->price : 0; ?>">
            </div>
        </div>
    </div>

</div>
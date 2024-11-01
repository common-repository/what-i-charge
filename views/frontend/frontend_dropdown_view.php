<div class="wdic-frontend-dropdown-container wdic-subservice-container" style="background-color: <?php echo $dropCardColor ?>">
    <div class="wdic-dropdown-heading" style="color:<?php echo get_option("wdic_drop_heading_color"); ?>"><?php echo isset($submenu->name) ? esc_html($submunu->name) : ""; ?></div>
    <?php
    $dropdownTextColor = get_option("wdic_drop_text_color");
    $dropdownBackgroundColor = get_option("wdic_drop_bg_color");
    $dropdownHoverColor = get_option("wdic_drop_hover_color");
    $dropdownHeadingColor = get_option("wdic_drop_heading_color");
    $dropdownSelectBackgroundColor = get_option("wdic_drop_select_option_color");
    ?>

    <div onclick="" class="wdic-fdc-header" style="background-color: <?php echo $dropdownSelectBackgroundColor; ?>; color:<?php echo $dropdownTextColor; ?>">
        <h2  wdic-price="0" style="color: <?php echo $dropdownTextColor ?>">
            Please Select One
        </h2>
        <span ></span>
    </div>
    <ul>
        <li onclick="" wdic-price="0" style="color: <?php echo $dropdownTextColor ?>; background:<?php echo $dropdownBackgroundColor; ?>;" value='<?php echo $dropDownIndex;?>' class="wdic-dropdown-item" wdic-back-color="<?php echo $dropdownBackgroundColor?>" wdic-hover-color="<?php echo $dropdownHoverColor ?>">
            None
        </li>
        <?php
        if(isset($submenu->options) && is_array($submenu->options)):

        foreach ($submenu->options as $option):
            ?>
        <li onclick="" wdic-price="<?php echo (isset($option->price) && filter_var($option->price, FILTER_VALIDATE_FLOAT)) ? $option->price : 0; ?>" style="color: <?php echo $dropdownTextColor ?>; background:<?php echo $dropdownBackgroundColor; ?>;" value='<?php echo $dropDownIndex;?>' class="wdic-dropdown-item" wdic-back-color="<?php echo $dropdownBackgroundColor?>" wdic-hover-color="<?php echo $dropdownHoverColor ?>">
            <?php echo isset($option->name) ? esc_html($option->name) : ""; ?>
        </li>
            <?php $dropDownIndex++; endforeach; endif; ?>
    </ul>
</div>



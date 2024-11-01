<div class="wdic-checkbox-container wdic-subservice-container" style="background-color: <?php echo $checkCardColor ?>">

    <div class="wdic-checkbox">
        <?php
        $checkmarkColor = "whiteCheck";
        $checkmarkBGColor = get_option("wdic_check_bg_check_color");
        //        $checkmarkBackgroundColor = $submenu->backgroundColor;
        $checkmarkTextColor = get_option("wdic_check_text_color");
        ?>
        <h2 class="wdic-checkbox-heading"style="border-color:<?php echo $checkmarkBackgroundColor ?> ; color:<?php echo(get_option("wdic_check_heading_color")) ?>"><?php echo isset($submenu->name)?esc_html($submenu->name):""; ?></h2>
            <ul>
                <?php
                if(isset($submenu->options) && is_array($submenu->options)):
                foreach ($submenu->options as $option):
                ?>
                <li>
                    <span checkmarkColor="<?php echo plugin_dir_url(__FILE__)."../images/".$checkmarkColor.".png"; ?>" background-color="<?php echo $checkmarkBGColor; ?>" style="border-color: <?php echo $checkmarkBGColor; ?>"class="wdic-checkbox-span" <?php echo $checkboxIndex; ?>></span>
                    <span class="wdic-check-option-name" style="color: <?php echo $checkmarkTextColor; ?>"> <?php echo isset($option->name) ? esc_html($option->name) : ""; ?></span>
                    <input type="hidden" name="wdic-check-option-price" value="<?php echo (isset($option->price) && filter_var($option->price, FILTER_VALIDATE_FLOAT)) ? $option->price : 0;?>">

                </li>
                    <?php $checkboxIndex++; endforeach; endif; ?>
            </ul>
    </div>

</div>

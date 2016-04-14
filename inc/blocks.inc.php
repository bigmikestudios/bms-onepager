<?php

// set up global block picker
function global_block_choices( $field ) {

    // reset choices
    $field['choices'] = array();


    // get the textarea value from options page without any formatting

    $global_blocks = get_field('blocks','option');
    //trace($global_blocks);
    $choices = array();

    if ($global_blocks) {
        foreach($global_blocks as $block) {
            if ($block['name']) $choices[] = $block['name'];
        }
    }

    // remove any unwanted white space
    $choices = array_map('trim', $choices);


    // loop through array and add to field 'choices'
    if( is_array($choices) ) {
        foreach( $choices as $choice ) {
            $field['choices'][ $choice ] = $choice;
        }
    }

    // return the field
    return $field;

}

add_filter('acf/load_field/name=global_block', 'global_block_choices');

function the_block($block){
    ?>
    <div class="strata block <?php echo $block['name']; ?>">
        <div class="container-fluid">
            <div class="row">
                <?php require "blocks/".$block['acf_fc_layout'].".php"; ?>
            </div>
        </div>
    </div>
    <?php
}

function the_global_block($name) {
    // get the global blocks.
    $global_blocks = get_field('blocks','option');

    // get the specific global block we are after.
    $my_block = false;
    foreach($global_blocks as $global_block) {
        //trace($global_block);
        if ($global_block['name'] == $name ) {
            the_block($global_block);
            return;
        }
    }
    // if we are here, we didn't find the block
    ?><p>NO GLOBAL BLOCK NAMED "<?php echo $name; ?>" EXISTS.</p><?php
}
<?php
include "../../../include/db.php";

include "../../../include/authenticate.php"; if (!checkperm("a")) {exit ("Permission denied.");}
$plugin_page_heading = $lang['wordpress_image_config_heading'];
$plugin_name = 'wordpress_image';
if(!in_array($plugin_name, $plugins))
{plugin_activate_for_setup($plugin_name);}

$page_def[] = config_add_section_header($lang['wordpress_image_heading'],$lang['wordpress_image_heading_description']);
$page_def[] = config_add_text_input(
    'wordpress_image_url',
    $lang['wordpress_image_url']
);
$page_def[] = config_add_text_input(
    'wordpress_image_user',
    $lang['wordpress_image_user']
);
$page_def[] = config_add_text_input(
    'wordpress_image_key',
    $lang['wordpress_image_key']
);

// Do the page generation ritual -- don't change this section.
config_gen_setup_post($page_def, $plugin_name);
include '../../../include/header.php';
config_gen_setup_html($page_def, $plugin_name, null, $plugin_page_heading);
include '../../../include/footer.php';
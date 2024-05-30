<?php
###############################
## ResourceSpace
## Local Configuration Script
###############################

# All custom settings should be entered in this file.
# Options may be copied from config.default.php and configured here.

# MySQL database settings
$mysql_server = 'db';
$mysql_username = 'readwrite';
$mysql_password = 'larsole';
$read_only_db_username = 'read';
$read_only_db_password = 'larsole';
$mysql_db = 'resourcespace';

# Base URL of the installation
$baseurl = 'https://resourcespace.ppzv.de';

# Email settings
$email_notify = 'testuser@paulparey.de';
$email_from = 'testuser@paulparey.de';
# Secure keys
$spider_password = '417ca5bdfb1597256f9b3115050bd476cd483617433d14554af3c64c8d085191';
$scramble_key = '8c44d270375ae31150e8f32ef1ca5f230bc97bd5c7c435b164ad020dc9e17f5e';
$api_scramble_key = '09bcbc91e81276a1c8986bb1bb49da144a7ca4cd7f56071c036e32b744f30cd5';

# Paths
$imagemagick_path = '/usr/bin';
$ghostscript_path = '/usr/bin';
$ffmpeg_path = '/usr/bin';
$exiftool_path = '/usr/bin';
$antiword_path = '/usr/bin';
$pdftotext_path = '/usr/bin';

$applicationname = 'ResourceSpace';
$homeanim_folder = 'filestore/system/slideshow_651f4bc0da999c1';

/*

New Installation Defaults
-------------------------

The following configuration options are set for new installations only.
This provides a mechanism for enabling new features for new installations without affecting existing installations (as would occur with changes to config.default.php)

*/

// Set imagemagick default for new installs to expect the newer version with the sRGB bug fixed.
$imagemagick_colorspace = "sRGB";

$contact_link=false;

$slideshow_big=true;
$home_slideshow_width=1920;
$home_slideshow_height=1080;

$themes_simple_view=true;

$stemming=true;
$case_insensitive_username=true;
$user_pref_user_management_notifications=true;
$themes_show_background_image = true;

$use_zip_extension=true;
$collection_download=true;

$ffmpeg_preview_force = true;
$ffmpeg_preview_extension = 'mp4';
$ffmpeg_preview_options = '-f mp4 -b:v 1200k -b:a 64k -ac 1 -c:v libx264 -pix_fmt yuv420p -profile:v baseline -level 3 -c:a aac -strict -2';

$daterange_search = true;
$upload_then_edit = true;

$purge_temp_folder_age=90;
$filestore_evenspread=true;

$comments_resource_enable=true;

$api_upload_urls = array();

$use_native_input_for_date_field = true;
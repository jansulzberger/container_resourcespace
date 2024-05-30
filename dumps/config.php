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
$mysql_password = 'pass';
$read_only_db_username = 'readwrite';
$read_only_db_password = 'pass';
$mysql_db = 'resourcespace';

# Base URL of the installation
$baseurl = 'https://localhost';

# Email settings
$email_notify = 'jansulzberger@googlemail.com';
$email_from = 'jansulzberger@googlemail.com';
# Secure keys
$spider_password = '383c126e68cf3b46dee23270081f9ffbb2792b757cbce0eae8a2105cb5336313';
$scramble_key = 'e3afd21189d11ca2fdf9e7a6910c06edbd9947e651736951423c35cabe0d5909';
$api_scramble_key = 'cddaaaf1ba310ffe74a9175c9ff5cb8428a19c2ef533baed53220f78121a553b';

# Paths
$imagemagick_path = '/usr/bin';
$ghostscript_path = '/usr/bin';
$ffmpeg_path = '/usr/bin';
$exiftool_path = '/usr/bin';
$antiword_path = '/usr/bin';
$pdftotext_path = '/usr/bin';

$applicationname = 'ResourceSpace';
$homeanim_folder = 'filestore/system/slideshow_d1058af8204684c';

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

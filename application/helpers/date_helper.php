<?php
if (!function_exists('format_french_date')) {
    function format_french_date($date_string)
    {
        setlocale(LC_TIME, 'fr_FR.UTF-8');
        return strftime("%A %d %B %Y", strtotime($date_string));
    }
}
?>

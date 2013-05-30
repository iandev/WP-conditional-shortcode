<?php
/*
 * Update functions
 */

/**
 * Main upgrade function.
 */
function condshort_upgrade() {
    $upgrade_failed = false;
    $upgrade_debug = array();
    $version = get_option('condshort-version', false);
    if (empty($version)) {
        $version = CONDSHORT_VERSION;
    }
    if (version_compare($version, CONDSHORT_VERSION, '<')) {
        $first_step = str_replace('.', '', $version);
        $last_step = str_replace('.', '', CONDSHORT_VERSION);
        for ($index = $first_step; $index <= $last_step; $index++) {
            if (function_exists('condshort_upgrade_' . $index)) {
                $response = call_user_func('condshort_upgrade_' . $index);
                if ($response !== true) {
                    $upgrade_failed = true;
                    $upgrade_debug[$first_step][$index] = $response;
                }
            }
        }
    }
    if ($upgrade_failed == true) {
        update_option('condshort_upgrade_debug', $upgrade_debug);
        // @todo Add perm message to display for admin
    }
    update_option('condshort-version', CONDSHORT_VERSION);
}
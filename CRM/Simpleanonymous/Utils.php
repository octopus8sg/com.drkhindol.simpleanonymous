<?php

use CRM_Simpleanonymous_ExtensionUtil as E;

use \Firebase\JWT\JWT;

class CRM_Simpleanonymous_Utils
{


    /**
     * @param $input
     * @param $preffix_log
     */
    public static function write_log($input, $preffix_log="Simple Anonymous Log")
    {
        $simpleanonymous_settings = CRM_Core_BAO_Setting::getItem("Simple Anonymous Settings", 'simpleanonymous_settings');
        if ($simpleanonymous_settings['save_log'] == '1') {
            $masquerade_input = $input;
            if (is_array($masquerade_input)) {
                $fields_to_hide = ['Signature'];
                foreach ($fields_to_hide as $field_to_hide) {
                    unset($masquerade_input[$field_to_hide]);
                }
                Civi::log()->debug($preffix_log . "\n" . print_r($masquerade_input, TRUE));
                return;
            }
            Civi::log()->debug($preffix_log . "\n" . $masquerade_input);
            return;
        }
    }

}
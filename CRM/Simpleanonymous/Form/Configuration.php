<?php

use CRM_Simpleanonymous_ExtensionUtil as E;

/**
 * Form controller class
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/quickform/
 */
class CRM_Simpleanonymous_Form_Configuration extends CRM_Core_Form {
    public function buildQuickForm()
    {
        $save_log = $this->add('checkbox', 'save_log', 'Save extension debug to log');
        $anonynomous_email = $this->add('email', 'anonynomous_email', 'Anonynomous Email', ['size' => 100]);
        $types = ['Contact'];
        $profiles = CRM_Core_BAO_UFGroup::getValidProfiles($types);

        if (empty($profiles)) {
            CRM_Core_Session::setStatus(ts("You will need to create a Profile containing the %1 fields you want to edit before you can use Update multiple contributions. Navigate to Administer CiviCRM > Customize Data and Screens > CiviCRM Profile to configure a Profile. Consult the online Administrator documentation for more information.", [1 => $types[0]]), ts('Profile Required'), 'error');
            CRM_Utils_System::redirect($this->_userContext);
        }

        $profile = $this->add('select', 'profile', ts('Select Profile'),
            [
                '' => ts('- select profile -'),
            ] + $profiles, TRUE
        );

        $this->addButtons([
            [
                'type' => 'submit',
                'name' => E::ts('Submit'),
                'isDefault' => TRUE,
            ],
        ]);
        parent::buildQuickForm();
    }

    public function setDefaultValues()
    {
        $defaults = [];
        $simpleanonymous_settings = CRM_Core_BAO_Setting::getItem("Simple Anonymous Settings", 'simpleanonymous_settings');
        if (!empty($simpleanonymous_settings)) {
            $defaults = $simpleanonymous_settings;
        }
        return $defaults;
    }

    public function postProcess()
    {
        $values = $this->exportValues();
        $simpleanonymous_settings['save_log'] = $values['save_log'];
        $simpleanonymous_settings['anonynomous_email'] = $values['anonynomous_email'];
        $simpleanonymous_settings['profile'] = $values['profile'];


        CRM_Core_BAO_Setting::setItem($simpleanonymous_settings, "Simple Anonymous Settings", 'simpleanonymous_settings');
        CRM_Core_Session::setStatus(E::ts('Simple Anonymous Settings Saved', ['domain' => 'com.drkhindol.simpleanonymous']), 'Configuration Updated', 'success');

        parent::postProcess();
    }


}

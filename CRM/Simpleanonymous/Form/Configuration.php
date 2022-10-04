<?php

use CRM_Simpleanonymous_ExtensionUtil as E;
use CRM_Simpleanonymous_Utils as U;

/**
 * Form controller class
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/quickform/
 */
class CRM_Simpleanonymous_Form_Configuration extends CRM_Core_Form {

    /**
     * Variable to store redirect path.
     * @var string
     */
    protected $_userContext;

    public function buildQuickForm()
    {
        $save_log = $this->add('checkbox', 'save_log', 'Save extension debug to log');
//        $anonynomous_email = $this->add('email', 'anonynomous_email', 'Anonynomous Email', ['size' => 100]);
        $anonynomous_id = $this->addEntityRef('anonynomous_id', E::ts('Anonymous User'),
            ['create' => false, 'multiple' => false, 'class' => 'huge'],
            true);

        $types = ['Contact'];
        $profiles = CRM_Core_BAO_UFGroup::getValidProfiles($types);
        if (empty($profiles)) {
            $error_message = "You will need to create a Profile for Anonymous. Navigate to Administer CiviCRM > Customize Data and Screens > CiviCRM Profile to configure a Profile. Consult the online Administrator documentation for more information.";
            $error_title = 'Profile Required';
            U::showErrorMessage($error_message, $error_title);
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
        $simpleanonymous_settings['anonynomous_id'] = $values['anonynomous_id'];
        $simpleanonymous_settings['profile'] = $values['profile'];


        CRM_Core_BAO_Setting::setItem($simpleanonymous_settings, "Simple Anonymous Settings", 'simpleanonymous_settings');
        CRM_Core_Session::setStatus(E::ts('Simple Anonymous Settings Saved', ['domain' => 'com.drkhindol.simpleanonymous']), 'Configuration Updated', 'success');

        parent::postProcess();
    }


}

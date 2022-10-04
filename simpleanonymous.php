<?php

require_once 'simpleanonymous.civix.php';

// phpcs:disable
use CRM_Simpleanonymous_ExtensionUtil as E;

// phpcs:enable

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function simpleanonymous_civicrm_config(&$config)
{
    _simpleanonymous_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function simpleanonymous_civicrm_install()
{
    _simpleanonymous_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function simpleanonymous_civicrm_postInstall()
{
    _simpleanonymous_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function simpleanonymous_civicrm_uninstall()
{
    _simpleanonymous_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function simpleanonymous_civicrm_enable()
{
    _simpleanonymous_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function simpleanonymous_civicrm_disable()
{
    _simpleanonymous_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function simpleanonymous_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL)
{
    return _simpleanonymous_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function simpleanonymous_civicrm_entityTypes(&$entityTypes)
{
    _simpleanonymous_civix_civicrm_entityTypes($entityTypes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 */
//function simpleanonymous_civicrm_preProcess($formName, &$form) {
//
//}


/**
 * @param $op
 * @param $objectName
 * @param $objectId
 * @param $params
 */
function simpleanonymous_civicrm_pre($op, $objectName, $objectId, &$params)
{
    if ($op === 'create') {
        CRM_Simpleanonymous_Utils::write_log($objectName, 'objectName');
        CRM_Simpleanonymous_Utils::write_log($objectId, 'objectId');
        CRM_Simpleanonymous_Utils::write_log($params, 'params');
    }
}

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 */

function simpleanonymous_civicrm_navigationMenu(&$menu)
{
    _simpleanonymous_civix_insert_navigation_menu($menu, 'Administer/CiviContribute', [
        'label' => E::ts('Configure Simple Anonymous'),
        'name' => 'configure_simple_anonymous',
        'url' => 'civicrm/simpleanonymous/configuration',
        'permission' => 'adminster CiviCRM',
        'operator' => 'OR',
        'separator' => 0,
    ]);
    _simpleanonymous_civix_navigationMenu($menu);
}

<?php

require_once 'profilecontrol.civix.php';
// phpcs:disable
use CRM_Profilecontrol_ExtensionUtil as E;
// phpcs:enable

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function profilecontrol_civicrm_config(&$config) {
  _profilecontrol_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function profilecontrol_civicrm_xmlMenu(&$files) {
  _profilecontrol_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function profilecontrol_civicrm_install() {
  _profilecontrol_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function profilecontrol_civicrm_postInstall() {
  _profilecontrol_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function profilecontrol_civicrm_uninstall() {
  _profilecontrol_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function profilecontrol_civicrm_enable() {
  _profilecontrol_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function profilecontrol_civicrm_disable() {
  _profilecontrol_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function profilecontrol_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _profilecontrol_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function profilecontrol_civicrm_managed(&$entities) {
  _profilecontrol_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Add CiviCase types provided by this extension.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function profilecontrol_civicrm_caseTypes(&$caseTypes) {
  _profilecontrol_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Add Angular modules provided by this extension.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function profilecontrol_civicrm_angularModules(&$angularModules) {
  // Auto-add module files from ./ang/*.ang.php
  _profilecontrol_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function profilecontrol_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _profilecontrol_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function profilecontrol_civicrm_entityTypes(&$entityTypes) {
  _profilecontrol_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_themes().
 */
function profilecontrol_civicrm_themes(&$themes) {
  _profilecontrol_civix_civicrm_themes($themes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 */
//function profilecontrol_civicrm_preProcess($formName, &$form) {
//
//}

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 */
//function profilecontrol_civicrm_navigationMenu(&$menu) {
//  _profilecontrol_civix_insert_navigation_menu($menu, 'Mailings', [
//    'label' => E::ts('New subliminal message'),
//    'name' => 'mailing_subliminal_message',
//    'url' => 'civicrm/mailing/subliminal',
//    'permission' => 'access CiviMail',
//    'operator' => 'OR',
//    'separator' => 0,
//  ]);
//  _profilecontrol_civix_navigationMenu($menu);
//}

/**
 * Implementation of hook_civicrm_buildForm
 */
function profilecontrol_civicrm_buildForm($formName, &$form) {
  if ($formName == 'CRM_UF_Form_Group') {
    $roles = CRM_Profilecontrol_Utils::roles();
    $form->add('select', 'profilecontrol_cms_roles', ts('Restrict Acess to Roles'),
      $roles, FALSE, ['class' => 'crm-select2 huge', 'multiple' => 1]);
    $form->add('advcheckbox', 'profilecontrol_negate', ts('Negate Access Roles?'));
    $form->add('select', 'profilecontrol_anonymous_access', ts('Allow access to anonymous users?'), [ '' => '', 'yes' => 'Yes', 'no' => 'No'], FALSE, ['class' => 'crm-select2 huge']);
    if ($form->_action & CRM_Core_Action::UPDATE) {
      $domainID = CRM_Core_Config::domainID();
      $settings = Civi::settings($domainID);
      $form->setDefaults(['profilecontrol_cms_roles' => $settings->get('profilecontrol_cms_roles_' . $form->getVar('_id'))]);
      $form->setDefaults(['profilecontrol_negate' => $settings->get('profilecontrol_negate_' . $form->getVar('_id'))]);
      $form->setDefaults(['profilecontrol_anonymous_access' => $settings->get('profilecontrol_anonymous_access_' . $form->getVar('_id'))]);
    }
  }
}

/**
 * Implementation of hook_civicrm_postProcess
 */
function profilecontrol_civicrm_postProcess($formName, &$form) {
  if ($formName == 'CRM_UF_Form_Group') {
    if ($form->_id) {
      $id = $form->_id;
    }
    else {
      $id = CRM_Core_DAO::getFieldValue('CRM_Core_DAO_UFGroup', $form->_submitValues['title'], 'id', 'title');
    }
    if ($id) {
      $profilecontrol_cms_roles = $form->_submitValues['profilecontrol_cms_roles'] ?? [];
      $profilecontrol_negate = $form->_submitValues['profilecontrol_negate'] ?? NULL;
      $profilecontrol_anonymous_access = $form->_submitValues['profilecontrol_anonymous_access'] ?? '';
      $domainID = CRM_Core_Config::domainID();
      $settings = Civi::settings($domainID);
      $settings->set('profilecontrol_cms_roles_' . $id, $profilecontrol_cms_roles);
      $settings->set('profilecontrol_negate_' . $id, $profilecontrol_negate);
      $settings->set('profilecontrol_anonymous_access_' . $id, $profilecontrol_anonymous_access);
    }
  }
}

function profilecontrol_civicrm_preProcess($formName, &$form) {
  if (in_array($formName, ['CRM_Profile_Form_Edit',
    'CRM_Profile_Form_Search', 'CRM_Profile_Form_Dynamic'])) {
    $domainID = CRM_Core_Config::domainID();
    $settings = Civi::settings($domainID);
    $roles = $settings->get('profilecontrol_cms_roles_' . $form->getVar('_gid'));
    $anonymousAccess = $settings->get('profilecontrol_anonymous_access_' . $form->getVar('_gid'));
    if (!empty($roles)) {
      $negate = $settings->get('profilecontrol_negate_' . $form->getVar('_gid'));
      $loggedInUserUfID = CRM_Utils_System::getLoggedInUfID();
      if ($loggedInUserUfID) {
        $hasRole = CRM_Profilecontrol_Utils::isRolePresentToUser($loggedInUserUfID, $roles);
        // If there is no negate and no role, then the message is denied.
        // Negate and have a role, then show a denied message.
        if ((!$negate && !$hasRole) || ($negate && $hasRole)) {
          CRM_Utils_System::permissionDenied();
        }
      }
    }
    // Anonymous access is set to 'No' and the user is not logged in, then
    // show access denied message.
    if (!empty($anonymousAccess) && $anonymousAccess == 'no' &&
      !CRM_Utils_System::isUserLoggedIn()) {
      CRM_Utils_System::permissionDenied();
    }
  }
}

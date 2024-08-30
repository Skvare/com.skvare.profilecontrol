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
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function profilecontrol_civicrm_install() {
  _profilecontrol_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function profilecontrol_civicrm_enable() {
  _profilecontrol_civix_civicrm_enable();
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

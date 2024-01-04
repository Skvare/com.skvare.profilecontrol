<?php

// phpcs:disable
use CRM_Profilecontrol_ExtensionUtil as E;

class CRM_Profilecontrol_Utils {

  /**
   * Function to get Roles.
   *
   * @return array
   */
  public static function roles() {
    $roles = [];
    if (CIVICRM_UF == 'Drupal8') {
      $roles = user_role_names(TRUE);
    }
    elseif (CIVICRM_UF == 'Drupal' || CIVICRM_UF == 'Backdrop') {
      $roles = user_roles(TRUE);
    }
    elseif (CIVICRM_UF == 'WordPress') {
      $roles = CRM_Cmsuser_Utils::getJoomlaGroups();
    }

    return $roles;
  }

  /**
   * Function to check user have mentioned role
   *
   * @param $cmsUserID
   * @param $roles
   */
  public static function isRolePresentToUser($userId, $roles) {
    $account = self::loadUser($userId);
    $hasRole = FALSE;
    if (CIVICRM_UF == 'Drupal8') {
      $userRoles = $account->getRoles();
      foreach ($roles as $role) {
        if (in_array($role, $userRoles)) {
          $hasRole = TRUE;
          break;
        }
      }
    }
    elseif (CIVICRM_UF == 'Drupal') {
      foreach ($roles as $role) {
        if ($account !== FALSE && isset($account->roles[$role])) {
          $hasRole = TRUE;
          break;
        }
      }
    }
    elseif (CIVICRM_UF == 'Backdrop') {
      foreach ($roles as $role) {
        if ($account !== FALSE && in_array($role, $account->roles)) {
          $hasRole = TRUE;
          break;
        }
      }
    }
    elseif (CIVICRM_UF == 'WordPress') {
      foreach ($roles as $role) {
        if (in_array($role, (array)$account->roles)) {
          $hasRole = TRUE;
          break;
        }
      }
    }
    elseif (CIVICRM_UF == 'Joomla') {
      foreach ($roles as $role) {
        if ($account !== FALSE && isset($account->groups[$role])) {
          $hasRole = TRUE;
          break;
        }
      }
    }

    return $hasRole;
  }

  /**
   * Function to get user details.
   * @param $userId
   * @return \Drupal\Core\Entity\EntityBase|\Drupal\Core\Entity\EntityInterface|\Drupal\user\Entity\User|WP_User|null
   */
  public static function loadUser($userId) {
    if (CIVICRM_UF == 'Drupal8') {
      $account = \Drupal\user\Entity\User::load($userId);
    }
    elseif (CIVICRM_UF == 'Drupal' || CIVICRM_UF == 'Backdrop') {
      $account = user_load((int)$userId, TRUE);
    }
    elseif (CIVICRM_UF == 'WordPress') {
      $account = new WP_User($userId);
    }
    elseif (CIVICRM_UF == 'Joomla') {
      $account = JUser::getInstance((int)$userId);
    }

    return $account;
  }

  public static function AnonymouseRoels() {
    if (CIVICRM_UF == 'Drupal8') {
      $user_role_names = user_role_names(TRUE);
      var_dump($user_role_names);exit;
      return $user_role_names['authenticated'];
    }
    elseif (CIVICRM_UF == 'Drupal' || CIVICRM_UF == 'Backdrop') {
      $user_role_names = user_roles(TRUE);
      return $user_role_names[DRUPAL_AUTHENTICATED_RID];
    }
    elseif (CIVICRM_UF == 'WordPress') {
      global $wp_roles;
      $wp_roles->get_names();
    }
    elseif (CIVICRM_UF == 'Joomla') {
      $account = JUser::getInstance((int)$userId);
    }

    return $account;
  }

}

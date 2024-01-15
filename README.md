# com.skvare.profilecontrol

![Screenshot](/images/profile_setting.png)

Control the profile visibility using CMS user roles.

This will control the accessibility of your profile based on your role, even if you give permissions to the CMS like `profile create`, `profile listings', etc.

Each profile can have its own controls for accessibility.

The extension is licensed under [AGPL-3.0](LICENSE.txt).

## Requirements

* PHP v7.2+
* CiviCRM 5.51

## Installation (Web UI)

Learn more about installing CiviCRM extensions in the [CiviCRM Sysadmin Guide](https://docs.civicrm.org/sysadmin/en/latest/customize/extensions/).

## Installation (CLI, Zip)

Sysadmins and developers may download the `.zip` file for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
cd <extension-dir>
cv dl com.skvare.profilecontrol@https://github.com/Skvare/com.skvare.profilecontrol/archive/master.zip
```

## Installation (CLI, Git)

Sysadmins and developers may clone the [Git](https://en.wikipedia.org/wiki/Git) repo for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
git clone https://github.com/Skvare/com.skvare.profilecontrol.git
cv en profilecontrol
```

## Getting Started
* Go to profile settings and expand the `Advanced Settings` panel.
* Here you will see the fields `Restrict Acess to Roles`, `Negate Access Roles?`, `Allow access to anonymous users?`.
* Choose the appropriate setting as per your needs.
* `Restrict Acess to Roles` is the role list of CMS, its multiselect field.
* `Negate Access Roles?` : We can revert the role selection.
* `Allow access to anonymous users?`: accessibility for anonymous users.


## Get support now

Control the profile visibility extension is open source software. Its support and improvement depends upon the good will and contribution of open source developers' time and the investment of money by individuals and organizations.

We do our best to answer requests and fix bugs, and are committed to continuing development and supporting the extension as both CMS and CiviCRM evolve.

Primary development is managed by [Skvare](https://skvare.com), but a community of developers supports and contributes to the module.

If you or your organization has specific or immediate needs, or simply wishes to support the continued development and maintenance of this extension you can [Contact Skvare](https://skvare.com/contact) and our dedicated team of account managers, business analysts, project managers, and developers will work to get the solution you need, as fast as we can.

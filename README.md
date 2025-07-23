# com.skvare.profilecontrol

![Screenshot](/images/profile_setting.png)

## Overview

The Profile Access Control extension provides granular control over CiviCRM profile visibility based on CMS user roles. This powerful extension allows administrators to restrict access to specific profiles beyond CiviCRM's standard permission system, creating role-based access controls that integrate seamlessly with your CMS (Drupal, WordPress, Joomla, or Backdrop) user management system.

**Key Features:**
- Role-based profile access control using CMS user roles
- Individual profile-level access management
- Support for positive and negative role matching
- Anonymous user access controls
- Integration with existing CMS permission systems
- Override CiviCRM's default profile permissions
- Flexible access rules for different user groups
- Compatible with complex organizational hierarchies


## Benefits

- **Enhanced Security:** Restrict sensitive profiles to authorized roles only
- **Flexible Access Management:** Fine-tune who can access which profiles
- **CMS Integration:** Leverage existing CMS role structures
- **Granular Control:** Set different access rules for each profile
- **Organizational Compliance:** Meet privacy and access requirements
- **User Experience:** Show relevant profiles to appropriate user groups
- **Administrative Efficiency:** Centralized profile access management


## Use Cases

This extension is ideal for organizations that need:

### Member Organizations
- **Public Profiles:** Basic contact information visible to all members
- **Board Profiles:** Detailed information restricted to board members
- **Staff Profiles:** Internal contact details for staff only
- **Volunteer Profiles:** Volunteer-specific information for coordinators

### Educational Institutions
- **Student Profiles:** Academic information restricted to faculty
- **Alumni Profiles:** Graduate information for alumni association members
- **Faculty Profiles:** Research and contact details for academic staff
- **Parent Profiles:** Family information restricted to school administrators

### Healthcare Organizations
- **Patient Intake:** Medical forms restricted to healthcare providers
- **Staff Directories:** Internal contact information for employees
- **Volunteer Profiles:** Community volunteer information for coordinators
- **Board Profiles:** Governance information for board members

### Professional Associations
- **Member Directories:** Professional listings for verified members
- **Committee Profiles:** Committee-specific information for participants
- **Executive Profiles:** Leadership information for board access
- **Public Profiles:** General information for website visitors

## Requirements

- **CiviCRM:** 5.51 or higher
- **PHP:** 7.2 or higher (recommended 7.4+)
- **CMS:** Drupal, WordPress, Joomla, or Backdrop with user role system
- **Permissions:** Administrative access to manage profiles and users
- **Integration:** Properly synchronized CiviCRM-CMS user accounts

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

## Configuration

### Profile-Level Access Control

After installation, configure access controls for each profile:

1. **Navigate to Profile Management:**
  - Go to **Administer > Customize Data and Screens > Profiles**
  - Select the profile you want to configure
  - Click **Settings**

2. **Access Advanced Settings:**
  - Scroll to the **Advanced Settings** panel
  - Expand the panel to reveal access control options

3. **Configure Access Controls:**
   The extension adds three key fields to profile configuration:

#### Restrict Access to Roles

**Purpose:** Define which CMS user roles can access this profile

**Configuration:**
- **Field Type:** Multi-select dropdown
- **Options:** All available CMS user roles
- **Behavior:** Users must have one of the selected roles to access the profile

**Examples:**
- **Staff Directory:** Select "Staff" and "Manager" roles
- **Member Portal:** Select "Member" and "Premium Member" roles
- **Volunteer Forms:** Select "Volunteer Coordinator" and "Staff" roles

#### Negate Access Roles

**Purpose:** Reverse the role selection logic

**Configuration:**
- **Field Type:** Checkbox
- **Default:** Unchecked (normal role matching)
- **When Checked:** Users with selected roles are DENIED access

**Use Cases:**
- **Exclude Certain Roles:** Allow access to everyone except specific roles
- **Temporary Restrictions:** Block access for suspended user roles
- **Security Measures:** Prevent access for untrusted or limited roles

**Example Scenarios:**
```
Restrict Access to Roles: "Suspended", "Pending Approval"
Negate Access Roles: Checked
Result: All users EXCEPT those with "Suspended" or "Pending Approval" roles can access
```

#### Allow Access to Anonymous Users

**Purpose:** Control whether non-logged-in users can access the profile

**Configuration:**
- **Field Type:** Checkbox
- **Default:** Follows CiviCRM's standard anonymous access rules
- **When Checked:** Anonymous users can access regardless of role restrictions

**Considerations:**
- **Public Profiles:** Check for publicly visible contact directories
- **Registration Forms:** Check for public event registration or membership signup
- **Private Information:** Uncheck for profiles containing sensitive data

### Access Control Examples

#### Example 1: Staff Directory (Internal Only)

```
Profile: "Staff Contact Directory"
Restrict Access to Roles: "Staff", "Manager", "Administrator"
Negate Access Roles: Unchecked
Allow Access to Anonymous Users: Unchecked

Result: Only logged-in users with Staff, Manager, or Administrator roles can view
```

#### Example 2: Public Member Directory (Exclude Suspended)

```
Profile: "Member Directory"
Restrict Access to Roles: "Suspended Member"
Negate Access Roles: Checked
Allow Access to Anonymous Users: Checked

Result: Everyone can view except users with "Suspended Member" role
```

#### Example 3: Board-Only Information

```
Profile: "Board Member Details"
Restrict Access to Roles: "Board Member", "Executive Director"
Negate Access Roles: Unchecked
Allow Access to Anonymous Users: Unchecked

Result: Only Board Members and Executive Director can access
```

#### Example 4: Public Registration Form

```
Profile: "Event Registration"
Restrict Access to Roles: (none selected)
Negate Access Roles: Unchecked
Allow Access to Anonymous Users: Checked

Result: Available to all users, logged in or anonymous
```

## Support and Contributing

- **Issues:** Report bugs and feature requests on [GitHub Issues](https://github.com/Skvare/com.skvare.profilecontrol/issues)

## Credits

Developed by [Skvare, LLC](https://skvare.com/contact) for the CiviCRM community.

## About Skvare

Skvare LLC specializes in CiviCRM development, Drupal integration, and providing technology solutions for nonprofit organizations, professional societies, membership-driven associations, and small businesses. We are committed to developing open source software that empowers our clients and the wider CiviCRM community.

**Contact Information**:
- Website: [https://skvare.com](https://skvare.com)
- Email: info@skvare.com
- GitHub: [https://github.com/Skvare](https://github.com/Skvare)

## Support

[Contact us](https://skvare.com/contact) for support or to learn more.

---

## Related Extensions

You might also be interested in other Skvare CiviCRM extensions:

- **Database Custom Field Check**: Prevents adding custom fields when table limits are reached
- **Image Resize**: Automatically resizes contact images for consistent display
- **Registration Button Label**: Customize button labels on event registration pages
- **Unlink User Account**: Safely unlink user accounts from contacts without deleting data

For a complete list of our open source contributions, visit our [GitHub organization page](https://github.com/Skvare).

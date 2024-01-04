{literal}
  <script type="text/javascript">
    CRM.$(function($) {
      $('.crm-dedupesetting-form-block-profilecontrol_anonymous_access').insertAfter('.crm-uf-advancesetting-form-block-is_update_dupe');
      $('.crm-dedupesetting-form-block-profilecontrol_negate').insertAfter('.crm-uf-advancesetting-form-block-is_update_dupe');
      $('.crm-dedupesetting-form-block-profilecontrol_cms_roles').insertAfter('.crm-uf-advancesetting-form-block-is_update_dupe');
    });
  </script>
{/literal}

<table class="form-layout-compressed" style="display: none">
  <tr class="crm-dedupesetting-form-block-profilecontrol_cms_roles">
    <td class="label">{$form.profilecontrol_cms_roles.label}</td>
    <td>{$form.profilecontrol_cms_roles.html}
    </td>
  </tr>
  <tr class="crm-dedupesetting-form-block-profilecontrol_negate">
    <td class="label">{$form.profilecontrol_negate.label}</td>
    <td>{$form.profilecontrol_negate.html}
    </td>
  </tr>
  <tr class="crm-dedupesetting-form-block-profilecontrol_anonymous_access">
    <td class="label">{$form.profilecontrol_anonymous_access.label}</td>
    <td>{$form.profilecontrol_anonymous_access.html}
    </td>
  </tr>
</table>

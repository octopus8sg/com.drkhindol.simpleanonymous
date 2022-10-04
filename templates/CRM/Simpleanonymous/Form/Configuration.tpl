{* HEADER *}

<table class="form-layout">
  <tbody>
  <tr>
    <td class="label">{$form.save_log.label}</td>
    <td>{$form.save_log.html}
      <br>
      <span class="description">Save debug info of the extension in the log file</span></td>
  </tr>
  <tr>
    <td class="label">{$form.hide_email.label}</td>
    <td>{$form.hide_email.html}
      <br>
      <span class="description">Hide Primary Email Field</span></td>
  </tr>
  <tr>
    <td class="label">{$form.hide_profile.label}</td>
    <td>{$form.hide_profile.html}
      <br>
      <span class="description">Hide Profile Section</span></td>
  </tr>
  <tr>
    <td class="label">{$form.anonynomous_id.label}</td>
    <td>{$form.anonynomous_id.html}
      <br>
      <span class="description">Anonymous User</span></td>
  </tr>
  <tr>
    <td class="label">{$form.profile.label}</td>
    <td>{$form.profile.html}
      <br>
      <span class="description">Profile for the Anonymous User Extension</span></td>
  </tr>
  </tbody>
</table>

{* FOOTER *}
<div class="crm-submit-buttons">
{include file="CRM/common/formButtons.tpl" location="bottom"}
</div>

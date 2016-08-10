<?php
  /**
   * Paypal Form
   *
   * @package CMS Pro
   * @author wojoscripts.com
   * @copyright 2010
   * @version $Id: form.tpl.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<form action="#" method="post" id="admin_form" name="admin_form">
  <div class="box top5">
    <h3><?php echo _UA_P_SUMMARY.' - '.$row2['displayname'];?></h3>
    <table class="display">
      <tr>
        <th><?php echo _MS_TITLE;?>:</th>
        <td><?php echo $row['title'.$core->dblang];?></td>
      </tr>
      <tr>
        <th><?php echo _MS_PRICE;?>:</th>
        <td><?php echo $core->formatMoney($row['price']);?></td>
      </tr>
      <tr>
        <th><?php echo _MS_PERIOD;?>:</th>
        <td><?php echo $row['days'] . ' ' .$member->getPeriod($row['period']);?></td>
      </tr>
      <tr>
        <th><?php echo _MS_RECURRING;?>:</th>
        <td><?php echo ($row['recurring'] == 1) ? _YES : _NO;?></td>
      </tr>
      <tr>
        <th><?php echo _UA_VALID_UNTIL;?>:</th>
        <td><?php echo $member->calculateDays($row['period'], $row['days']);?></td>
      </tr>
      <tr>
        <th><?php echo _MS_DESC;?>:</th>
        <td><?php echo $row['description'.$core->dblang];?></td>
      </tr>
      <tr>
        <td colspan="2"><?php echo $row2['extra3'];?></td>
      </tr>
      <?php if($core->checkTable("mod_invoices")):?>
      <tr>
        <td colspan="2"><input type="submit" value="Confirm Submission" name="dosubmit" class="button"/></td>
      </tr>
      <?php endif;?>
    </table>
  </div>
  <?php if($core->checkTable("mod_invoices")):?>
  <div id="msgholder3"></div>
  <input name="user_id" type="hidden" value="<?php echo $user->uid;?>" />
  <input name="membership_id" type="hidden" value="<?php echo $row['id'];?>" />
  <?php endif;?>
</form>
<?php if($core->checkTable("mod_invoices")):?>
<script type="text/javascript">
// <![CDATA[
	$(document).ready(function () {
		var options = {
			target: "#msgholder3",
			//beforeSubmit:  showLoader,
			success: showResponse,
			url: "gateways/offline/controller.php",
			data: {
				processInvoice: 1
			}
		};
		$("#admin_form").ajaxForm(options);
	});
	
	function showResponse(msg) {
		$("#msgholder3").html(msg);
	}
	
// ]]>
</script>
<?php endif;?>
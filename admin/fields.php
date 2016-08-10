<?php
  /**
   * Custom Fields
   *
   * @package CMS Pro
   * @author wojoscripts.com
   * @copyright 2010
   * @version $Id: logs.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  if(!$user->getAcl("Fields")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
?>
<?php switch($core->action): case "edit": ?>
<?php $row = $core->getRowById("custom_fields", $content->id);?>
<div class="block-top-header">
  <h1><img src="images/fields-sml.png" alt="" /><?php echo _CFL_TITLE2;?></h1>
  <div class="divider"><span></span></div>
</div>
<p class="info"><span><?php echo $core->langIcon();?></span><?php echo _CFL_INFO2 . _REQ1 . required() . _REQ2;?></p>
<div class="block-border">
  <div class="block-header">
    <h2><?php echo _CFL_SUBTITLE2 . $row['title'.$core->dblang];?></h2>
  </div>
  <div class="block-content">
    <form action="#" method="post" id="admin_form" name="admin_form">
      <table class="forms">
        <tfoot>
          <tr>
            <td><div class="button arrow">
                <input type="submit" value="<?php echo _CFL_UPDATE;?>" name="dosubmit" />
                <span></span></div></td>
            <td><a href="index.php?do=fields" class="button-orange"><?php echo _CANCEL;?></a></td>
          </tr>
        </tfoot>
        <tbody>
          <tr>
            <th><?php echo _CFL_NAME;?>: <?php echo required();?></th>
            <td><input name="title<?php echo $core->dblang;?>" type="text" class="inputbox" value="<?php echo $row['title'.$core->dblang];?>" size="55" /></td>
          </tr>
          <tr>
            <th><?php echo _CFL_TIP;?>:</th>
            <td><input name="tooltip<?php echo $core->dblang;?>" type="text" class="inputbox" value="<?php echo $row['tooltip'.$core->dblang];?>" size="55" /></td>
          </tr>
          <tr>
            <th><?php echo _CFL_SECTION;?>:</th>
            <td><select class="custombox" name="type" style="width:250px">
                <?php echo Content::getFieldSection($row['type']);?>
              </select></td>
          </tr>
          <tr>
            <th><?php echo _CFL_REQ;?>:</th>
            <td><label for="req-1"><?php echo _YES;?></label>
              <input name="req" type="radio" id="req-1" value="1" <?php getChecked($row['req'], 1); ?> />
              <label for="req-2"><?php echo _NO;?></label>
              <input name="req" type="radio" id="req-2" value="0"  <?php getChecked($row['req'], 0); ?> /></td>
          </tr>
          <tr>
            <th><?php echo _PUBLISHED;?>:</th>
            <td><label for="active-1"><?php echo _YES;?></label>
              <input name="active" type="radio" id="active-1" value="1" <?php getChecked($row['active'], 1); ?> />
              <label for="active-2"><?php echo _NO;?></label>
              <input name="active" type="radio" id="active-2" value="0"  <?php getChecked($row['active'], 0); ?> /></td>
          </tr>
        </tbody>
      </table>
      <input name="id" type="hidden" value="<?php echo $content->id;?>" />
    </form>
  </div>
</div>
<?php echo $core->doForm("processField","ajax.php");?>
<?php break;?>
<?php case"add": ?>
<div class="block-top-header">
  <h1><img src="images/fields-sml.png" alt="" /><?php echo _CFL_TITLE3;?></h1>
  <div class="divider"><span></span></div>
</div>
<p class="info"><span><?php echo $core->langIcon();?></span><?php echo _CFL_INFO3 . _REQ1 . required() . _REQ2;?></p>
<div class="block-border">
  <div class="block-header">
    <h2><?php echo _CFL_SUBTITLE3;?></h2>
  </div>
  <div class="block-content">
    <form action="#" method="post" id="admin_form" name="admin_form">
      <table class="forms">
        <tfoot>
          <tr>
            <td><div class="button arrow">
                <input type="submit" value="<?php echo _CFL_ADD;?>" name="dosubmit" />
                <span></span></div></td>
            <td><a href="index.php?do=fields" class="button-orange"><?php echo _CANCEL;?></a></td>
          </tr>
        </tfoot>
        <tbody>
          <tr>
            <th><?php echo _CFL_NAME;?>: <?php echo required();?></th>
            <td><input name="title<?php echo $core->dblang;?>" type="text" class="inputbox" size="55" /></td>
          </tr>
          <tr>
            <th><?php echo _CFL_TIP;?>:</th>
            <td><input name="tooltip<?php echo $core->dblang;?>" type="text" class="inputbox" size="55" /></td>
          </tr>
          <tr>
            <th><?php echo _CFL_SECTION;?>:</th>
            <td><select class="custombox" name="type" style="width:250px">
                <?php echo Content::getFieldSection();?>
              </select></td>
          </tr>
          <tr>
            <th><?php echo _CFL_REQ;?>:</th>
            <td><label for="req-1"><?php echo _YES;?></label>
              <input name="req" type="radio" id="req-1" value="1"  />
              <label for="req-2"><?php echo _NO;?></label>
              <input name="req" type="radio" id="req-2" value="0" checked="checked"  /></td>
          </tr>
          <tr>
            <th><?php echo _PUBLISHED;?>:</th>
            <td><label for="active-1"><?php echo _YES;?></label>
              <input name="active" type="radio" id="active-1" value="1" checked="checked" />
              <label for="active-2"><?php echo _NO;?></label>
              <input name="active" type="radio" id="active-2" value="0"  /></td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
</div>
<?php echo $core->doForm("processField","ajax.php");?>
<?php break;?>
<?php default: ?>
<?php $fieldrow = $content->getCustomFields();?>
<div class="block-top-header">
  <h1><img src="images/fields-sml.png" alt="" /><?php echo _CFL_TITLE1;?></h1>
  <div class="divider"><span></span></div>
</div>
<p class="info"><span><?php echo $core->langIcon();?></span><?php echo _CFL_INFO1;?></p>
<div class="block-border">
  <div class="block-header">
    <h2><span><a href="index.php?do=fields&amp;action=add" class="add"><?php echo _CFL_ADDNEW;?></a></span><?php echo _CFL_SUBTITLE1;?></h2>
  </div>
  <div class="block-content">
    <table class="display sortable-table" id="pagetable">
      <thead>
        <tr>
          <th width="20">#</th>
          <th class="left sortable"><?php echo _CFL_NAME;?></th>
          <th class="left sortable"><?php echo _CFL_SECTION;?></th>
          <th class="sortable"><?php echo _CFL_POSITION;?></th>
          <th><?php echo _CFL_REQ;?></th>
          <th><?php echo _EDIT;?></th>
          <th><?php echo _DELETE;?></th>
        </tr>
      </thead>
      <?php if($fieldrow):?>
      <tfoot>
        <tr>
          <td colspan="7"><a href="javascript:void(0);" id="serialize" class="button-alt button-blue"><?php echo _CFL_SAVE;?></a></td>
        </tr>
      </tfoot>
      <?php endif;?>
      <tbody>
        <?php if(!$fieldrow):?>
        <tr>
          <td colspan="7"><?php echo $core->msgInfo(_CFL_NOFIELDS,false);?></td>
        </tr>
        <?php else:?>
        <?php foreach ($fieldrow as $row):?>
        <tr id="node-<?php echo $row['id'];?>">
          <th class="id-handle center"><?php echo $row['id'];?>.</th>
          <td><?php echo $row['title' . $core->dblang];?></td>
          <td><?php echo Content::fieldSection($row['type']);?></td>
          <td align="center"><?php echo $row['sorting'];?></td>
          <td align="center"><img src="images/<?php echo $row['req'] ? "yes" : "no";?>.png" alt=""/></td>
          <td align="center"><a href="index.php?do=fields&amp;action=edit&amp;id=<?php echo $row['id'];?>"><img src="images/edit.png" alt="" class="tooltip" title="<?php echo _EDIT;?>"/></a></td>
          <td align="center"><a href="javascript:void(0);" class="delete" id="item_<?php echo $row['id'];?>" data-title="<?php echo $row['title'.$core->dblang];?>"><img src="images/delete.png" alt="" class="tooltip" title="<?php echo _DELETE;?>"/></a></td>
        </tr>
        <?php endforeach;?>
        <?php unset($row);?>
        <?php endif;?>
      </tbody>
    </table>
  </div>
</div>
<?php echo Core::doDelete(_DELETE.' '._CFL_FIELD, "deleteField");?>
<script type="text/javascript"> 
// <![CDATA[
  var tableHelper = function (e, tr) {
	  tr.children().each(function () {
		  $(this).width($(this).width());
	  });
	  return tr;
  };
  $(document).ready(function () {
	  $("#pagetable tbody").sortable({
		  helper: tableHelper,
		  handle: '.id-handle',
		  opacity: .6
	  }).disableSelection();
  
	  $('#serialize').click(function () {
		  serialized = $("#pagetable tbody").sortable('serialize');
		  $.ajax({
			  type: "POST",
			  url: "ajax.php?sortfields",
			  data: serialized,
			  success: function (msg) {
				  $("#msgholder").html(msg);
			  }
		  });
	  })
  
	  $(".sortable-table").tablesorter({
		  headers: {
			  0: {
				  sorter: false
			  },
			  4: {
				  sorter: false
			  },
			  5: {
				  sorter: false
			  },
			  6: {
				  sorter: false
			  }
		  }
	  });
  });
// ]]>
</script> 
</script>
<?php break;?>
<?php endswitch;?>
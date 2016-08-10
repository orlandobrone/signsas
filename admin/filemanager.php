<?php
  /**
   * File Manager
   *
   * @package CMS Pro
   * @author wojoscripts.com
   * @copyright 2010
   * @version $Id: filemanager.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');

  if(!$user->getAcl("FM")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
  
  require("manager/class_fm.php");
  $fm = new Filemanager();
  
  $result = $fm->renderAll();
?>
<div class="block-top-header">
  <h1><img src="images/filemngr-sml.png" alt="" /><?php echo _FM_TITLE;?></h1>
  <div class="divider"><span></span></div>
</div>
<div class="block-border">
  <div class="block-header">
    <h2 style="font-size:14px">
    <span><a href="javascript:void(0);" onclick="$('#uploader').slideToggle();"><?php echo _FM_MFILEUPL;?></a></span>
      <?php foreach($result['crumbs'] as $k => $crumb):?>
      <?php if($k != _HOME) echo '&nbsp;/&nbsp;'?>
      <a href="<?php echo $crumb;?>"><?php echo $k;?></a>
      <?php endforeach;?>
    </h2>
  </div>
  <div class="block-content">
    <div id="uploader" style="display:none">
      <div class="uploader">
        <div class="dragspace hidden">
          <p class="zonemessage"><?php echo _FM_DRAGF;?></p>
          <p class="message"><?php echo str_replace("[FILETYPES]", implode(", ",Filemanager::$fileext), _FM_FILEINFO);?></p>
        </div>
        <div class="buttons">
          <div class="addbutton hidden">
            <form action="manager/controller.php" method="post" id="uploadform" name="uploadform" enctype="multipart/form-data">
              <div class="fileuploader">
                <input type="text" class="filename" readonly="readonly"/>
                <input type="button" name="file" class="filebutton" value="<?php echo _BROWSE;?>"/>
                <input type="file" name="filedata" />
                <input name="filedir" type="hidden" value="<?php echo $fm->rel_dir;?>" />
              </div>
            </form>
          </div>
        </div>
        <div class="uploadspace hidden"></div>
        <div class="buttons"> <a class="startbutton button-green hidden"><?php echo _FM_START;?></a> <a class="clearbutton button button-orange hidden"><?php echo _FM_CLEAR;?></a> </div>
      </div>
    </div>
    <div id="maindata">
    <form action="#" method="post" id="admin_form" name="admin_form">
      <table class="display sortable-table">
        <thead>
          <tr>
            <th class="firstrow">&nbsp;</th>
            <th class="left"><?php echo _FM_NAME;?></th>
            <th class="left"><?php echo _FM_SIZE;?></th>
            <th class="left"><?php echo _FM_FILELM;?></th>
            <th class="right">&nbsp;</th>
            <th class="right">&nbsp;</th>
          </tr>
          <?php foreach ($result['dirs'] as $i => $dir):?>
          <?php if($dir['type'] == 'back'):?>
          <tr>
            <td class="subtitle"></td>
            <td class="subtitle"><a href="<?php echo $dir['link'];?>"><strong><?php echo $dir['name'];?></strong></a></td>
            <td class="subtitle"></td>
            <td class="subtitle"></td>
            <td class="subtitle"></td>
            <td class="subtitle"></td>
          </tr>
          <?php endif;?>
          <?php endforeach;?>
        </thead>
        <tfoot>
          <tr>
            <td colspan="6" class="right"><div style="float:left"><input name="donew" type="text"  class="inputbox" size="25" /> <a href="javascript:void(0);" class="button-green" id="new-file"><?php echo _FM_NEWFILE;?></a> <a href="javascript:void(0);" class="button-blue" id="new-dir"><?php echo _FM_NEWDIR;?></a></div><a href="javascript:void(0);" class="button" id="copy-files"><?php echo _COPY;?></a> <a href="javascript:void(0);" class="button" id="move-files"><?php echo _MOVE;?></a> <a href="javascript:void(0);" class="button" id="zip-files"><?php echo _ZIP;?></a> <a href="javascript:void(0);" class="button-orange" id="delete-files"><?php echo _DELETE;?></a> <a href="javascript:void(0);" class="button-blue" id="masterSelect" style="width:100px; text-align:center"><?php echo _FM_SEL_ALL;?></a></td>
          </tr>
          <tr>
            <td colspan="6"><strong><?php echo _FM_DIRS . ': <span id="dcount">' . $result['dir_count'].'</span> ' . _FM_FILES . ': <span id="fcount">' . $result['file_count'] . '</span>';?></strong></td>
          </tr>
        </tfoot>
        <tbody id="dirdata">
          <?php foreach ($result['dirs'] as $i => $dir):?>
          <?php if($dir['type'] == 'back'):?>
          <?php else:?>
          <?php $i++;?>
          <tr id="dirid_<?php echo $i;?>">
            <th><img src="manager/images/mime/folder.png" alt="" /></th>
            <td class="left"><a href="index.php?do=filemanager&amp;cdir=<?php echo $dir['path'];?>"><?php echo $dir['name'];?></a></td>
            <td class="left"></td>
            <td class="left"><?php echo $dir['ftime'];?></td>
            <th class="firstrow"><input name="multid[]" type="checkbox" id="multid-<?php echo $i;?>" value="<?php echo $dir['path'];?>" /></th>
            <th class="firstrow"><a href="javascript:void(0);" id="folder-options_<?php echo $i;?>" data-name="<?php echo $dir['name'];?>" data-path="<?php echo $dir['path'];?>"><img src="images/mod-config.png" alt="" /></a></th>
          </tr>
          <?php endif;?>
          <?php endforeach;?>
        </tbody>
        <tbody id="filedata">
          <?php foreach ($result['files'] as $i => $file):?>
          <?php $i++;?>
          <tr id="fileid_<?php echo $i;?>">
            <th><img src="manager/images/mime/<?php echo $file['ext'];?>" alt="" /></th>
            <td class="left"><?php echo $file['name'];?></td>
            <td class="left"><?php echo $file['size'];?></td>
            <td class="left"><?php echo $file['ftime'];?></td>
            <th class="firstrow"><input name="multif[]" type="checkbox" id="multif-<?php echo $i;?>" value="<?php echo $file['path'];?>" /></th>
            <th class="firstrow"><a href="javascript:void(0);" id="item-options_<?php echo $i;?>" data-name="<?php echo $file['fname'];?>" data-path="<?php echo $file['path'];?>"><img src="images/mod-config.png" alt="" /></a></th>
          </tr>
          <?php endforeach;?>
        </tbody>
      </table>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="assets/fileupload.js"></script> 
<script type="text/javascript">
// <![CDATA[
function requestDefault() {
    $('.display tbody tr').each(function () {
        if ($(this).find('input:checked').length) {
            $(this).animate({
                'backgroundColor': '#FFBFBF'
            }, 400);
        }
    });
}

function responseDelete(msg) {
    $('.display tbody tr').each(function () {
        if ($(this).find('input:checked').length) {
            $(this).fadeOut(400, function () {
                $(this).remove();
            });
        }
    });
    $("#msgholder").html(msg);
}

$(window).ready(function () {
    $(".uploader").FileUploader({
        url: "manager/controller.php?filedir=<?php echo $fm->rel_dir;?>",
        maxAllowedFiles: 10,
        maxFileSize: <?php echo Filemanager::maxFile;?>, 
		    dataType : 'json', 
			allowedTypes : [<?php echo '"'.implode('","', str_replace('.', '', Filemanager::$fileext)).'"';?> ],
			msg: {
			  extTitle: "<?php echo _FM_ERRFILETYPE;?>",
			  extError: "<?php echo str_replace(" [FILETYPES]", implode(",", Filemanager::$fileext), _FM_ERRFILETYPE_T);?>",
			  sizeTitle: "<?php echo _FM_ERRFILESIZE;?>",
			  sizeError: "<?php echo str_replace(" [LIMIT]", Filemanager::maxFile, _FM_ERRFILESIZE_T);?>",
			  dropFiles: "<?php echo _FM_DROPF;?>",
			  ierror: "<?php echo _ERROR;?>",
        },
        onUploadComplete: function (json) {
            var html = '';
            html += '<tr id="fileid_' + json.ftime + '" class="added-list">'
            html += '<th><img src="manager/images/mime/' + json.ext + '" alt="" /></th>';
            html += '<td class="left">' + json.name + '</td>';
            html += '<td class="left">' + json.fsize + '</td>';
            html += '<td class="left">' + json.ftime + '</td>';
            html += '<th class="firstrow"><div class="ez-checkbox" id="file-added-' + json.ftime + '">';
            html += '<input id="multif-' + json.ftime + '" class="ez-hide" type="checkbox" value="' + json.path + '" name="multif[]">';
            html += '</div></th>';
            html += '<th class="firstrow"><a href="javascript:void(0);" id="item-options_' + json.ftime + '" data-name="' + json.fname + '" data-path="' + json.path + '">';
            html += '<img src="images/mod-config.png" alt="" /></a></th>';
            html += '</tr>';

            $(".display tbody#filedata").append(html);
            $(".display tbody#filedata tr.added-list").effect("highlight", {}, 800);
        }
    });
});
$(document).ready(function () {
    function showLoader() {
        $('#loader').fadeIn(200);
    }

    function hideLoader() {
        $('#loader').fadeOut(200);
    };

    $('#maindata').on('click', '#masterSelect', function (e) {
        e.preventDefault();
        if ($('#masterSelect').html() == '<?php echo _FM_SEL_UALL;?>') {
            $('input[name^="multid"], input[name^="multif"]').each(function () {
                $(this).attr("checked", null);
                $(this).trigger('change');
                $("[id^=file-added-], [id^=folder-added-]").removeClass('ez-checked');
            });
            $('#masterSelect').html('<?php echo _FM_SEL_ALL;?>');
        } else {
            $('input[name^="multid"], input[name^="multif"]').each(function () {
                $(this).attr("checked", status);
                $(this).trigger('change');
                $("[id^=file-added-], [id^=folder-added-]").addClass('ez-checked');
            });
            $('#masterSelect').html('<?php echo _FM_SEL_UALL;?>');
        }
    });
    // Zip files/folders
    $('#maindata').on('click', '#zip-files', function (e) {
        e.preventDefault();
        var str = $("#admin_form").serialize();
        str += '&action=dozip';
        str += '&cur_dir=<?php echo $fm->rel_dir;?>';
        $.ajax({
            type: "post",
            dataType: 'json',
            url: "manager/controller.php",
            data: str,
            beforeSend: showLoader(),
            success: function (json) {
                hideLoader();
                if (json.type == "success") {
                    $(json.message).insertBefore('.display tbody#filedata tr:first').effect("highlight", {}, 3000);
                    $("#msgholder").html(json.info);
                } else {
                    $("#msgholder").html(json.message);
                }
            }
        });
        return false;
    });

    // Folder options
    $('#maindata').on("click", "[id^=folder-options_]", function () {
        var id = $(this).attr('id').replace('folder-options_', '');
        var parent = $(this).parent().parent();
        var name = $(this).attr('data-name');
        var path = $(this).attr('data-path');
        var text = '<div><input name="rename-dir" id="rename-dir" type="text" class="inputbox" size="45" value="' + name + '"/></div>';
        $.confirm({
            title: '<?php echo _FM_DELFILE_D;?>',
            message: text,
            buttons: {
                '<?php echo _RENAME;?>': {
                    'class': 'no',
                    'action': function () {
                        $.ajax({
                            type: 'post',
                            dataType: 'json',
                            url: "manager/controller.php",
                            data: 'action=renameDir&path=' + path + '&newname=' + encodeURIComponent($('input[name="rename-dir"]').val()),
                            beforeSend: showLoader(),
                            success: function (json) {
                                hideLoader();
                                if (json.type == "success") {
                                    $("#dirid_" + id).replaceWith(json.message);
                                    $("#dirid_" + json.uid).effect("highlight", {}, 3000);
                                    $("#msgholder").html(json.info);
                                } else {
                                    $("#msgholder").html(json.message);
                                }
                            }
                        });

                    }
                },
                '<?php echo _CANCEL;?>': {
                    'class': 'no',
                    'action': function () {}
                },
                '<?php echo _DELETE;?>': {
                    'class': 'yes last',
                    'action': function () {
                        $.ajax({
                            type: 'post',
                            url: "manager/controller.php",
                            data: 'action=deleteSingle&path=' + path + '&name=' + encodeURIComponent(name),
                            beforeSend: function () {
                                parent.animate({
                                    'backgroundColor': '#FFBFBF'
                                }, 400);
                            },
                            success: function (msg) {
                                parent.fadeOut(400, function () {
                                    parent.remove();
                                });
                                $('html, body').animate({
                                    scrollTop: 0
                                }, 600);
                                $("#msgholder").html(msg);
                            }
                        });
                    }
                },
            }
        });
    });

    // File options
    $('#maindata').on("click", "[id^=item-options_]", function () {
        var id = $(this).attr('id').replace('item-options_', '');
        var parent = $(this).parent().parent();
        var name = $(this).attr('data-name');
        var path = $(this).attr('data-path');
        var text = '<div><input name="rename-file" id="rename-file" type="text" class="inputbox" size="45" value="' + name + '"/></div>';
        $.confirm({
            title: '<?php echo _FM_DELFILE_D;?>',
            message: text,
            buttons: {
                '<?php echo _RENAME;?>': {
                    'class': 'no',
                    'action': function () {
                        $.ajax({
                            type: 'post',
                            dataType: 'json',
                            url: "manager/controller.php",
                            data: 'action=renameFile&path=' + path + '&newname=' + encodeURIComponent($('input[name="rename-file"]').val()),
                            beforeSend: showLoader(),
                            success: function (json) {
                                hideLoader();
                                if (json.type == "success") {
                                    $("#fileid_" + id).replaceWith(json.message);
                                    $("#fileid_" + json.uid).effect("highlight", {}, 3000);
                                    $("#msgholder").html(json.info);
                                } else {
                                    $("#msgholder").html(json.message);
                                }
                            }
                        });

                    }
                },
                '<?php echo _CANCEL;?>': {
                    'class': 'no',
                    'action': function () {}
                },
                '<?php echo _DELETE;?>': {
                    'class': 'yes last',
                    'action': function () {
                        $.ajax({
                            type: 'post',
                            url: "manager/controller.php",
                            data: 'action=deleteSingle&path=' + path + '&name=' + encodeURIComponent(name),
                            beforeSend: function () {
                                parent.animate({
                                    'backgroundColor': '#FFBFBF'
                                }, 400);
                            },
                            success: function (msg) {
                                parent.fadeOut(400, function () {
                                    parent.remove();
                                });
                                $('html, body').animate({
                                    scrollTop: 0
                                }, 600);
                                $("#msgholder").html(msg);
                            }
                        });
                    }
                },
            }
        });
    });

    /** Multiple Delete **/
    $('#maindata').on("click", "a#delete-files", function () {
        var str = $("#admin_form").serialize();
        str += '&action=deleteMulti';
        $.ajax({
            type: "post",
            url: "manager/controller.php",
            data: str,
            beforeSend: requestDefault,
            success: responseDelete
        });
        return false;
    });

    // Create File
    $('#maindata').on("click", "a#new-file", function () {
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: "manager/controller.php",
            data: 'action=createFile&path=<?php echo $fm->rel_dir;?>&name=' + $('input[name="donew"]').val(),
            beforeSend: showLoader(),
            success: function (json) {
                hideLoader();
                if (json.type == "success") {
                    $('.display tbody#filedata').prepend(json.message);
                    $("#msgholder").html(json.info);
                } else {
                    $("#msgholder").html(json.message);
                }
            }
        });
    });

    // Create Directory
    $('#maindata').on("click", "a#new-dir", function () {
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: "manager/controller.php",
            data: 'action=createDir&path=<?php echo $fm->rel_dir;?>&name=' + $('input[name="donew"]').val(),
            beforeSend: showLoader(),
            success: function (json) {
                hideLoader();
                if (json.type == "success") {
                    $('.display tbody#dirdata').prepend(json.message);
                    $("#msgholder").html(json.info);
                } else {
                    $("#msgholder").html(json.message);
                }
            }
        });
    });


    // Copy files/folders
    $('#maindata').on("click", "a#copy-files", function () {
        $.ajax({
            type: 'post',
            url: "manager/controller.php",
            data: 'action=listDir',
            beforeSend: showLoader(),
            success: function (data) {
                hideLoader();
                $(data).insertAfter('#dirlist option:first');
            }
        });

        var text = '<select name="path" id="dirlist" style="width:250px;padding:5px">';
        text += '<option value=""><?php echo _HOME;?></option>';
        text += '</select>';
        $.confirm({
            title: '<?php echo _FM_SELDIR;?>',
            message: text,
            buttons: {
                '<?php echo _COPY;?>': {
                    'class': 'no',
                    'action': function () {
                        var str = $("#admin_form").serialize();
                        str += '&action=copyAll';
                        str += '&path=' + $('#dirlist :selected').val();
                        $.ajax({
                            type: "post",
                            url: "manager/controller.php",
                            data: str,
                            beforeSend: showLoader(),
                            success: function (data) {
                                hideLoader();
                                $('html, body').animate({
                                    scrollTop: 0
                                }, 600);
                                $("#msgholder").html(data);
                            }
                        });

                    }
                },
                '<?php echo _CANCEL;?>': {
                    'class': 'no',
                    'action': function () {}
                }
            }
        });
    });

    // Move files/folders
    $('#maindata').on("click", "a#move-files", function () {
        $.ajax({
            type: 'post',
            url: "manager/controller.php",
            data: 'action=listDir',
            beforeSend: showLoader(),
            success: function (data) {
                hideLoader();
                $(data).insertAfter('#dirlist option:first');
            }
        });

        var text = '<select name="path" id="dirlist" style="width:250px;padding:5px">';
        text += '<option value=""><?php echo _HOME;?></option>';
        text += '</select>';
        $.confirm({
            title: '<?php echo _FM_SELDIR;?>',
            message: text,
            buttons: {
                '<?php echo _MOVE;?>': {
                    'class': 'no',
                    'action': function () {
                        var str = $("#admin_form").serialize();
                        str += '&action=moveAll';
                        str += '&path=' + $('#dirlist :selected').val();
                        $.ajax({
                            type: "post",
                            url: "manager/controller.php",
                            data: str,
                            beforeSend: requestDefault,
                            success: responseDelete
                        });

                    }
                },
                '<?php echo _CANCEL;?>': {
                    'class': 'no',
                    'action': function () {}
                }
            }
        });
    });
});
// ]]>
</script>
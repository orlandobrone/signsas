<?php
/**********************************************************************************
 * Contact Form Generator is (c) Top Studio
 * It is strictly forbidden to use or copy all or part of an element other than for your 
 * own personal and private use without prior written consent from Top Studio http://topstudiodev.com
 * Copies or reproductions are strictly reserved for the private use of the person 
 * making the copy and not intended for a collective use.
 *********************************************************************************/


session_start();

require_once('editor/class/class.contactformeditor.php');
$contactformeditor_obj = new contactFormEditor();

$contactformeditor_obj->authentication(false);

$user_login_file_path = 'editor/inc/user.php';
// é keeps utf-8

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Contact Form Generator</title>

<link rel="stylesheet" type="text/css" href="editor/css/global.css"/>

</head>

<script src="<?php echo $contactformeditor_obj->path_jquery; ?>"></script>
<script src="<?php echo $contactformeditor_obj->path_jquery_ui;?>"></script>
<link rel="stylesheet" href="<?php echo $contactformeditor_obj->path_jquery_ui_theme;?>"> 

<script>
$(function()
{
	// SET UP DIALOG BOX
	$('#cfg-dialog-message').dialog({
									autoOpen: false,
									modal: true,
									resizable:false,
									draggable:false,
									position: ['center', 200]
									});
	
	
	$('#cfg-resetpassword').click(function()
	{
			
		$('#cfg-dialog-message').html('<p>Delete the file "user.php" in the "editor/inc" directory to reset your password and create a new account.</p>');
			
		$('#cfg-dialog-message').dialog({
				autoOpen: true,
				title: 'Reset your password',
				buttons:{
					Ok: function(){$(this).dialog('close');}
				}
		});		
	});

	$('#cr').val($('#copyright-header').html());


});
</script>
<style type="text/css">
body{
	background-color:#f7f7f7;
}
p{
	font-family:Arial, Helvetica, sans-serif;
	font-size:14px;
}
.ui-widget {
	font-size: 11px;
}
.ui-widget p{
	font-family:Verdana, Geneva, sans-serif;
	font-size: 11px;
}


a{
	text-decoration:none;
}


h2{
	font-family:Arial, Helvetica, sans-serif;
	font-size:20px;
	font-weight:normal;
	text-align:left;
	color:#333;
	margin-bottom:0;
}

#content{
	margin-top:100px;
	margin-left:auto;
	margin-right:auto;
	width:900px;
}
#logout{
	text-align:right;
	font-family:Arial, Helvetica, sans-serif;
	font-size:14px;
}
#logout a{
	color:#09F;
}
#logout a:hover{
	text-decoration:underline;
}

.header{
	text-align:center;
	border-bottom:1px solid #D6D6D6;
	padding:4px 10px 14px 10px;
	margin-bottom:20px;
}
.header a{
	color: #333;
}
.header a:hover{
	color:#09F;
}

.selectall{
	margin-bottom:10px;
}

.deleteselected-item.inactive{
	color:#aaa;
}
.deleteselected-item.active{
	color:#cc0000;
	cursor:pointer;
}
.deleteselected-item.active:hover{
	text-decoration:underline;
	color:#cc0000;
}

.label-selectall{
	cursor:pointer;
}
.label-selectall:hover{
	color:#09F;
}

.list{
	clear:both;
	margin-top:4px;
	padding:8px 6px;
	font-family:Arial, Verdana, Geneva, sans-serif;
	font-size:14px;
	background-color:#fff;
	border:1px solid #eee;
	-webkit-border-radius:5px;
	-moz-border-radius:5px;
	border-radius:5px;
}

.list a{
	color:#09F;
}
.list a:hover{
	text-decoration:underline;
}
.list-item.selected{
	background-color:#2d7ceb;
	color:#FFF;
	border-top:1px solid #4a8deb;
	border-bottom:1px solid #1b6ce0;
}

.list-item.selected a{
	color:#FFF;
}


.list-item{
	padding:10px 0 10px 0;
	border-top:1px solid #fff;
	border-bottom:1px solid #e5e5e5;
}
.list-item:last-child{
	border-bottom:none;
}

.list-item-name,
.list-item-zip,
.list-item-edit,
.list-item-view,
.list-item-date{
	float:left;
}
.list-item-name{
	width:360px;
	margin-right:10px;
}
.list-item-name a{
	font-weight:bold;
}

.list-item-view, .list-item-edit{
	width:70px;
}
.list-item-zip{
	width:90px;
}
.list-item-date{
	width:120px;
}

.list-item-zip,
.list-item-edit,
.list-item-view,
.list-item-date{
	margin-top:3px; /* same vertical alignment edit/view/download with form name+checkbox */
}

/**
 * DEBUG

	.list-item{
		background-color:#333;
	}
	.list-item-name{
		background-color:#666;
	}
	.list-item-zip, .list-item-view, .list-item-edit{
		background-color:#999;
	}
	.list-item-date{
		background-color:#ccc;
	} */

.loading{
	display:none;
}
.clear{
	clear:both;
}

#logo{
	margin-bottom:10px;
}

#copyright{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	text-align:center;
	margin-bottom:6px;
	color:#333;
}
#copyright a{
	color:#333;
	text-decoration:none;
}
#copyright a:hover{
	color:#09F;
}
#getnextupdate{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
}
#getnextupdate a{
	color:#09F;
}
#getnextupdate a:hover{
	text-decoration:underline;

}
</style>

<body>
<?php //print_r($_SESSION); echo '<hr/>';print_r($_COOKIE);?>

<div id="content">

		<div class="header">
			<div id="logo">
			<img src="editor/img/logo-home.png" />
			</div>
			
			<div id="copyright">
			<strong>Version <?php echo $contactformeditor_obj->version;?></strong> Copyright © <?php echo date('Y');?> <a href="http://www.topstudiodev.com" target="_blank"><span id="copyright-header">Top Studio</span></a>
			</div>
			
			<div id="getnextupdate">
			<a href="http://www.topstudiodev.com" target="_blank">Click here to be notified of the next update</a>
			</div>
			
		</div>
		
		<?php
		// PHP VERSION CHECK
		if(!$contactformeditor_obj->isphp5())
		{
			echo $contactformeditor_obj->warning_php5;
		}
		?>
	
		
			<style type="text/css">
			#label-rememberme{
				font-family:Arial, Helvetica, sans-serif;
				font-size:12px;
				cursor:pointer;
			}
			#cfg-resetpassword-container{
				text-align:center;
				margin-top:50px;
			}
			#cfg-resetpassword{
				color:#09F;
				font-family:Arial, Helvetica, sans-serif;
				font-size:12px;
				cursor:pointer;
			}
			#cfg-resetpassword:hover{
				text-decoration:underline;
			}
			.user-container{
				text-align:left;
				background-color:#FFF;
				width:300px;
				margin:auto;
				padding:16px;
				/*
				-moz-box-shadow: 0 0 3px #c4c4c4;
				-webkit-box-shadow: 0 0 3px #c4c4c4;
				box-shadow: 0 0 3px #c4c4c4;
				*/
				border:1px solid #eee;
				
				-moz-border-radius:4px;
				-khtml-border-radius:4px;
				-webkit-border-radius:4px;
				border-radius:4px;

			}
			.label-user{
				font-size:16px;
			}
			.input-user{
				width:284px;
			}
			.button-floatright{
				float:right;
			}
			.user-error, .user-validation{
				padding:6px 12px;
				width:560px;
				margin-right:auto;
				margin-left:auto;
				font-size:13px;
			}
			.user-error p, .user-validation p{
				margin:6px 0;
				line-height:20px;
			}
			
			</style>
			
			
			<?php
			// ERROR ACCOUNT CREATION
			if(isset($_SESSION['error']) && $_SESSION['error'])
			{
				echo '<div class="user-error">';
					
				foreach($_SESSION['error'] as $error_value)
				{
				?>
				<p><strong>ERROR</strong>: <?php echo $error_value;?></p>
				<?php
					
				}
				echo '</div>';
				
				unset($_SESSION['error']);
			}
				
			// VALIDATION ACCOUNT CREATION
			if(isset($_SESSION['validation']) && $_SESSION['validation'])
			{
				echo '<div class="user-validation">';
				echo '<p>'.$_SESSION['validation'].'</p>';
				echo '</div>';
				
				unset($_SESSION['validation']);
			}
			
			if(!file_exists($user_login_file_path))
			{
				?>
				
				<?php
				#CHMOD CONTROL

				if(!is_writable('editor/inc'))
				{
					@chmod('editor/inc', 0755);
					
					if(!is_writable('editor/inc'))
					{
						@chmod('editor/inc', 0777);
						
						if(!is_writable('editor/inc'))
						{
							?>
							<div class="user-error">
							<p>To create your access to Contact Form Generator, you must make the 'editor/inc' directory writable.</p>
							<p>Set the permission to 755 for the 'editor/inc' directory with your FTP software to solve this issue.</p>
							<p>Set the permission to 777 if it does not work otherwise.</p>
							</div>
							<?php
						}
					}
				}
				?>
				
				<?php
				if(is_writable('editor/inc'))
				{
				?>
				
				<p style="font-family:Arial, Helvetica, sans-serif; font-size:18px; font-weight:bold; text-align:center; ">Create your account:</p>
				<div class="user-container">
					<form action="editor/inc/form-createaccount.php" method="post">
						<label for="user-login" class="label-user">Username</label>
						<input type="text" id="user-login" name="user-login" class="input-user" />
						
						<label for="user-password-1"  class="label-user">Password</label>
						<input type="password" id="user-password-1" name="user-password-1" class="input-user" />
						
						<label for="user-password-2"  class="label-user">Re-type Password</label>
						<input type="password" id="user-password-2" name="user-password-2" class="input-user" />
						
						<input type="submit" value="Create Account" class="cfg-button cfg-button-sidepadding button-blue button-floatright" />
					</form>
					<div class="clear"></div>
				</div>
				<?php
				} // is writable
				?>
				<?php
			}
			?>
			<?php
			if(!isset($_SESSION['user']) && file_exists($user_login_file_path))
			{
				?>
				<div class="user-container">
					<form action="editor/inc/form-login.php" method="post">
					
					<input type="hidden" name="cr" id="cr" />
				
					<label for="user-login" class="label-user">Username</label>
					<input type="text" id="user-login" name="user-login" class="input-user" />
					
					<label for="user-password"  class="label-user">Password</label>
					<input type="password" id="user-password" name="user-password" class="input-user"  />
							
					<input type="checkbox" id="rememberme" name="rememberme" value="1" /><label for="rememberme" id="label-rememberme">Remember me</label>
					<input type="submit" value="Log In" class="cfg-button cfg-button-sidepadding button-blue button-floatright" />
					<div class="clear"></div>
					
					</form>
					
				</div>
				<div id="cfg-resetpassword-container"><span id="cfg-resetpassword">Reset your password</span></div>
				<?php
			}
			?>
				
			
<?php
if(isset($_SESSION['user']) && $_SESSION['user'])
{
	?>
<script>
$(function()
{
	$('.item-selectall').click(function(){
		var list_container = $(this).closest('.list');
		list_container.find('.item-checkbox-delete').prop('checked', this.checked);
		
		if($(this).is(':checked') && list_container.find('.item-checkbox-delete:checked').length)
		{
			list_container.find('.deleteselected-item').removeClass('inactive').addClass('active');
			list_container.find('.list-item').addClass('selected');
		} else{
			list_container.find('.deleteselected-item').removeClass('active').addClass('inactive');
			list_container.find('.list-item').removeClass('selected');
		}
	});
	
	$('.item-checkbox-delete').click(function(){
		var list_container = $(this).closest('.list');
		
		$(this).closest('.list-item').toggleClass('selected');
		

		if(list_container.find('.item-checkbox-delete:checked').length)
		{
			list_container.find('.deleteselected-item').removeClass('inactive').addClass('active');
		} else{
			list_container.find('.deleteselected-item').removeClass('active').addClass('inactive');
		}
	});
	

	
	$('body').on('click', '.deleteselected-item.delete-form.active, .deleteselected-item.delete-upload.active', function()
	{
		var list_container = $(this).closest('.list');
		var button = $(this);
		var loading = list_container.find('.delete_loading');
		var checkbox = list_container.find('.item-selectall');
		var checkbox_val = Array();
		
		var checked = list_container.find('.item-checkbox-delete:checked');
		
		checked.each(function(){
			checkbox_val.push($(this).val());
		});
		
		
		if(button.is('.delete-form'))
		{
			var dialog_title = 'Delete form';
			var alert_msg = '<p>Are you sure you want to delete the selected form(s)?</p><p>There is no undo.</p>';
			var software_version = list_container.find('.software_version').val();
			var post_obj = {'form_dir':checkbox_val, 'software_version':software_version};
			var post_url = 'editor/inc/editform-delete.php';
		}
		
		if(button.is('.delete-upload'))
		{
			var dialog_title = 'Delete file';
			var alert_msg = '<p>Are you sure you want to delete this file?</p><p>There is no undo.</p>';
			var post_url = 'editor/inc/editimage-delete.php';
			var post_obj = {'filename':checkbox_val};
		}
		
		
		$('#cfg-dialog-message').html('<p>'+alert_msg+'</p>');
			
		$('#cfg-dialog-message').dialog({
				autoOpen: true,
				title: dialog_title,
				buttons:{
							'Delete': function(){
											$(this).dialog('close');
				
											button.hide();
											loading.show();
												
											$.post(post_url, post_obj,
														function(data)
														{
															// console.log(data);
															
															var json_data = $.parseJSON(data);
															loading.hide();
															button.show();

															if(json_data && json_data['response'] == 'nok')
															{ // ^--  if json_data prevents "Cannot read property 'response' of null"
																$('#cfg-dialog-message').html('<p>'+json_data['response_msg']+'</p>');

																$('#cfg-dialog-message').dialog(
																{
																	autoOpen: true,
																	title: 'Error',
																	buttons: {
																		Ok: function(){$(this).dialog('close');}
																	}
																});
															} else{
																checkbox.prop('checked', false);
																
																checked.each(function(){
																	$(this).closest('.list-item').slideUp('fast', function(){$(this).remove()});
																	button.removeClass('active').addClass('inactive');
																});
															}
														});
								
										},
							Cancel: function(){
											$( this ).dialog('close');
										}
						}
			}); // end dialog message
	}); // end delete

});
</script>
	
	
	<div id="logout"><a href="editor/inc/form-logout.php">Logout</a></div>
	
	<?php
	/**************************************************************************************
	 * ERROR: writable contactform-download dir
	 */
	if(!is_writable('editor/contactform-download/'.$contactformeditor_obj->forms_index_filename))
	{
		
		if(!is_writable('editor/contactform-download'))
		{
			@chmod('editor/contactform-download', 0755);
			
			if(!is_writable('editor/contactform-download'))
			{
				@chmod('editor/contactform-download', 0777);
				
				if(!is_writable('editor/contactform-download'))
				{
					?>
					<div class="user-error">
					<?php echo $contactformeditor_obj->error_not_writable_dir_form_download;?>
					</div>
					<?php
				}
			}
		}
	}
	
	/**************************************************************************************
	 * ERROR: writable json index file
	 * Write the json index file if it's missing
	 */
	if(!is_file('editor/contactform-download/'.$contactformeditor_obj->forms_index_filename))
	{
		
		$fp = fopen('editor/contactform-download/'.$contactformeditor_obj->forms_index_filename, 'w+');
				
		fwrite($fp, $contactformeditor_obj->reset_json_index_content);
				
		fclose($fp);
	}
	
	if(!is_writable('editor/contactform-download/'.$contactformeditor_obj->forms_index_filename))
	{
		?>
		<div class="user-error">
		<?php echo $contactformeditor_obj->error_not_writable_form_index_file;?>
		</div>
		<?php
	}
	?>
	
	<?php
	/**************************************************************************************
	 * ERROR: writable upload dir
	 */
	if(!is_writable('editor/upload'))
	{
		
		if(!is_writable('editor/upload'))
		{
			@chmod('editor/upload', 0755);
			
			if(!is_writable('editor/upload'))
			{
				@chmod('editor/upload', 0777);
				
				if(!is_writable('editor/upload'))
				{
					?>
					<div class="user-error">
					<?php echo $contactformeditor_obj->error_not_writable_dir_upload;?>
					</div>
					<?php
				}
			}
		}
	}
	?>
	
	<div align="center">
	<a class="cfg-button cfg-button-sidepadding button-blue" href="editor">Create a new form</a>
	</div>
	
	
	<h2>Forms</h2>
	
	<div class="list">
	
		
		<?php
		$form_decode = json_decode(file_get_contents('editor/contactform-download/'.$contactformeditor_obj->forms_index_filename), true);
		
		$printobject = '';
		
		$array_form_names = array();
		$array_form_dir = array();
		
		foreach($form_decode['forms'] as $key=>$value)
		{
			$array_form_names[$key] = $value['form_name'].' #'.$form_decode['forms'][$key]['form_id'];
			
			$array_form_dir[] = $value['form_dir']; // used to hide v1.5+ dirs in the v1.5- listing
		}
		
		// forms sorted in alphabetical order
		asort($array_form_names);
		
		if($array_form_names)
		{
			?>
			<div class="selectall">
			<input type="hidden" class="software_version" value="1.5" />
			<input type="checkbox" class="item-selectall" id="item-selectall-1_5" />
			<label class="label-selectall" for="item-selectall-1_5">Select all</label>&nbsp;&nbsp;&nbsp;<span class="deleteselected-item delete-form inactive">Delete Selected</span><img src="editor/img/loading.gif" class="loading delete_loading" />
			</div>
			<?php
		}
		?>
		<?php
		foreach($array_form_names as $form_key=>$form_name)
		{
			if(is_dir('editor/contactform-download/'.$form_decode['forms'][$form_key]['form_dir']))
			{
				$printobject = 1;
				// find zip archive
				$zipfile = '';
				$contactform_objects = scandir('editor/contactform-download/'.$form_decode['forms'][$form_key]['form_dir']);
				foreach($contactform_objects as $value_contactform_objects)
				{
					if(substr($value_contactform_objects, -3) == 'zip')
					{
						$zipfile = $value_contactform_objects;
					}
				}

				?>
				<div class="list-item">
					
					<div class="list-item-name">
					<input type="checkbox" class="item-checkbox-delete" value="<?php echo $form_decode['forms'][$form_key]['form_dir'];?>" />
					<a href="<?php echo 'editor/?id='.$form_decode['forms'][$form_key]['form_id'];?>" class="dir_href"><?php echo $form_name; ?></a>
					</div>
					
					<div class="list-item-edit">
					<a href="<?php echo 'editor/?id='.$form_decode['forms'][$form_key]['form_id'];?>" class="dir_href">Edit</a>
					</div>
					
					<div class="list-item-view">
					<a href="<?php echo 'editor/contactform-download/'.$form_decode['forms'][$form_key]['form_dir'];?>/index.php" target="_blank" class="dir_href">View</a>
					</div>
					
					<div class="list-item-zip">
					<?php
					if($zipfile)
					{
					?>
						<a href="<?php echo 'editor/contactform-download/'.$form_decode['forms'][$form_key]['form_dir'].'/'.$zipfile;?>" >Download</a>
					<?php
					} else echo '&nbsp;';
					?>
					</div>
					
					
					<div class="list-item-date">
						<?php
						$form_date = '';
						if(isset($form_decode['forms'][$form_key]['date']) && $form_decode['forms'][$form_key]['date'])
						{
							$form_date = date('Y/m/d H:i', $form_decode['forms'][$form_key]['date']);
						}
						echo $form_date;
						?>
					</div>
					
					<div class="clear"></div>
					
				</div>
		<?php
			} // is_dir
		} // foreach($form_decode['forms'] as $form)
		
		if(!$printobject)
		{
			echo '<p>No contact form created yet</p>';
		}
		?>
	</div><!-- end of list -->


	<?php
	$objects = scandir('editor/contactform-download/');
	$show_older_version = '';
	foreach($objects as $value)
	{
		if(is_dir('editor/contactform-download/'.$value) && !in_array($value, $array_form_dir) && $value != '.' && $value != '..')
		{
			$show_older_version = 1;
			break;
		}
	}
	?>
	<?php
	if($show_older_version)
	{
	?>
	<h2>Forms created with older versions of Contact Form Generator (prior to version 1.5)</h2>
	<div class="list">
	
		<div class="selectall">
		<input type="hidden" class="software_version" value="1.4" />
		<input type="checkbox" class="item-selectall" id="item-selectall-1_4" />
		<label class="label-selectall" for="item-selectall-1_4">Select all</label>&nbsp;&nbsp;&nbsp;<span class="deleteselected-item delete-form inactive">Delete Selected</span><img src="editor/img/loading.gif" class="loading delete_loading" />
		</div>
	
		
		<?php
		
		$printobject = '';
		
		foreach($objects as $value)
		{

			if(is_dir('editor/contactform-download/'.$value) && !in_array($value, $array_form_dir) && $value != '.' && $value != '..')
			{
				$printobject = 1;
				
				// find zip archive
				$zipfile = '';
				$contactform_objects = scandir('editor/contactform-download/'.$value);
				foreach($contactform_objects as $value_contactform_objects)
				{
					if(substr($value_contactform_objects, -3) == 'zip')
					{
						$zipfile = $value_contactform_objects;
					}
				}

			?>
			<div class="list-item">
			
				<input type="hidden" class="form_dir" value="<?php echo $value;?>" />
		
				<div class="list-item-name">
				<input type="checkbox" class="item-checkbox-delete" value="<?php echo $value;?>" />
				<?php echo $value;?>
				</div>
				
				<div class="list-item-edit">&nbsp;
				</div>
				
				<div class="list-item-view">
				<a href="<?php echo 'editor/contactform-download/'.$value;?>" target="_blank" class="dir_href">View</a>
				</div>
				
				<div class="list-item-zip">&nbsp;
				<?php
				if($zipfile)
				{
				?>
				<a href="<?php echo 'editor/contactform-download/'.$value.'/'.$zipfile;?>" >Download</a>
				<?php
				}
				?>
				</div>
				
				<div class="list-item-date">&nbsp;
				</div>
			
				
				<div class="clear"></div>
				
			</div>
			<?php
			}
		}
		if(!$printobject)
		{
			echo '<p style="font-style:italic">No contact form created yet</p>';
		}
		?>
		
	</div><!-- list -->
	<?php
	} // if $show_older_version
	?>



	<h2>Uploads</h2>
	<div class="list">
	
	
		<?php
		$objects = scandir('editor/upload');
		// http://stackoverflow.com/questions/2947941/how-to-iterate-over-non-english-file-names-in-php
		$notemptydir = '';
		
		foreach($objects as $object)
		{
			if($object != "." && $object != ".." && $object != 'index.html')
			{
				$notemptydir = true;
				break;
			}
		}
		
		if($notemptydir)
		{
			?>
			<div class="selectall">
			<input type="checkbox" class="item-selectall" id="upload-selectall" />
			<label class="label-selectall" for="upload-selectall">Select all</label>&nbsp;&nbsp;&nbsp;<span class="deleteselected-item delete-upload inactive">Delete Selected</span><img src="editor/img/loading.gif" class="loading delete_loading" />
			</div>
			<?php
		}
		
		foreach($objects as $object)
		{ 
			if($object != "." && $object != ".." && $object != 'index.html')
			{
					$notemptydir = true;
					?>
					<div class="list-item">
					
						<div class="list-item-name">
							<?php 
							$img_ext = array ('jpg', 'jpeg', 'jpe', 'gif', 'png');
							if( in_array(substr($object, -3), $img_ext) )
							{
								?>
								<img src="editor/upload/<?php echo $object;?>" height="40" style="margin-left:4px" />
								<br />
								<input type="checkbox" class="item-checkbox-delete" value="<?php echo htmlentities($object, ENT_QUOTES, 'UTF-8');?>" />
								<?php echo $object;?>
								<?php

							}

							?>
						</div>
					
						
						<div class="clear"></div>
					
					</div>

					<?php
			} 
		}
		if(!$notemptydir)
		{
			echo '<p>No image uploaded yet</p>';
		}
		?>

	</div><!-- end of list -->

	<?php
} // end if(!isset($_SESSION['error'])
?>
	
</div><!-- end of content -->

<div id="cfg-dialog-message" title="" style="display:none"></div><!-- for the display of confirmation or error messages in a jquery dialog box -->


<!--<div id="copyright">© <?php echo @date('Y');?> <a href="http://www.topstudiodev.com" target="_blank">Top Studio</a></div>-->
</body>
</html>
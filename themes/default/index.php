<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Lista de Supermercado</title>
		<link rel="stylesheet" type="text/css" href="<?php mttinfo('template_url');?>style.css">
		<meta name="viewport" id="viewport" content="width=device-width">
	</head>
	<body>
		<script type="text/javascript" src="<?php mttinfo('mtt_url'); ?>jquery/jquery-1.4.4.min.js"></script>
		<script type="text/javascript" src="<?php mttinfo('mtt_url'); ?>jquery/jquery-ui-1.8.7.custom.min.js"></script>
		<script type="text/javascript" src="<?php mttinfo('mtt_url'); ?>jquery/jquery.autocomplete-1.1.js"></script>
		<script type="text/javascript" src="<?php mttinfo('mtt_url'); ?>mytinytodo.js?v=1.4.3"></script>
		<script type="text/javascript" src="<?php mttinfo('mtt_url'); ?>mytinytodo_lang.php?v=1.4.3"></script>
		<script type="text/javascript" src="<?php mttinfo('mtt_url'); ?>mytinytodo_ajax_storage.js?v=1.4.3"></script>
		<script type="text/javascript">
		$().ready(function() {
		mytinytodo.mttUrl = "<?php mttinfo('mtt_url'); ?>";
		mytinytodo.templateUrl = "<?php mttinfo('template_url'); ?>";
		mytinytodo.db = new mytinytodoStorageAjax(mytinytodo);
		mytinytodo.init({
		needAuth: <?php echo $needAuth ? "true" : "false"; ?>,
		isLogged: <?php echo ($needAuth && is_logged()) ? "true" : "false"; ?>,
		showdate: <?php echo (Config::get('showdate') && !isset($_GET['pda'])) ? "true" : "false"; ?>,
		singletab: <?php echo (isset($_GET['singletab']) || isset($_GET['pda'])) ? "true" : "false"; ?>,
		duedatepickerformat: "<?php echo htmlspecialchars(Config::get('dateformat2')); ?>",
		firstdayofweek: <?php echo (int) Config::get('firstdayofweek'); ?>,
		autotag: <?php echo Config::get('autotag') ? "true" : "false"; ?>
		<?php if(isset($_GET['list'])) echo ",openList: ". (int)$_GET['list']; ?>
		<?php if(isset($_GET['pda'])) echo ", touchDevice: true"; ?>
		}).loadLists(1);
		});
		</script>
		<div id="wrapper">
			<div id="container">
				<div id="mtt_body">
					<div id="loading"></div>
					<div id="bar">
						<div id="msg"><span class="msg-text"></span><div class="msg-details"></div></div>
					</div>
					<br clear="all" />
					<div id="toolbar" class="mtt-htabs">
						<div id="htab_newtask">
							<table class="mtt-taskbox"><tr><td class="mtt-tb-cell">
								<div class="mtt-tb-c">
									<form id="newtask_form" method="post">
										<label id="task_placeholder" class="placeholding" for="task">
											<input type="text" name="task" value="" maxlength="250" id="task" autocomplete="off" autofocus/>
											<span><?php _e('htab_newtask');?></span>
										</label>
										<div id="newtask_submit" class="mtt-taskbox-icon mtt-icon-submittask" title="<?php _e('btn_add');?>"></div>
									</form>
								</div>
							</td>
						</tr>
					</table>
				</div>
				<div style="clear:both"></div>
			</div>
			<h3>
			<span>Pendiente (<span id="total">0</span>) </span>
			</h3>
			<div id="taskcontainer">
			<ol id="tasklist" class="sortable"></ol>
		</div>
		</div> <!-- end of page_tasks -->
		<div id="page_taskedit" style="display:none">
			<div><a href="#" class="mtt-back-button"><?php _e('go_back');?></a></div>
			<h3 class="mtt-inadd"><?php _e('add_task');?></h3>
			<h3 class="mtt-inedit"><?php _e('edit_task');?>
			<div id="taskedit-date" class="mtt-inedit">
				(<span class="date-created" title="<?php _e('taskdate_created');?>"><span></span></span><span class="date-completed" title="<?php _e('taskdate_completed');?>"> &mdash; <span></span></span>)
			</div>
			</h3>
			<form id="taskedit_form" name="edittask" method="post">
				<input type="hidden" name="isadd" value="0" />
				<input type="hidden" name="id" value="" />
				<div class="form-row form-row-short">
					<span class="h"><?php _e('priority');?></span>
					<select name="prio">
						<option value="2">+2</option><option value="1">+1</option><option value="0" selected="selected">&plusmn;0</option><option value="-1">&minus;1</option>
					</select>
				</div>
				<div class="form-row form-row-short">
					<span class="h"><?php _e('due');?> </span>
					<input name="duedate" id="duedate" value="" class="in100" title="Y-M-D, M/D/Y, D.M.Y, M/D, D.M" autocomplete="off" />
				</div>
				<div class="form-row-short-end"></div>
				<div class="form-row"><div class="h"><?php _e('task');?></div> <input type="text" name="task" value="" class="in500" maxlength="250" /></div>
				<div class="form-row"><div class="h"><?php _e('note');?></div> <textarea name="note" class="in500"></textarea></div>
				<div class="form-row"><div class="h"><?php _e('tags');?></div>
				<table cellspacing="0" cellpadding="0" width="100%"><tr>
					<td><input type="text" name="tags" id="edittags" value="" class="in500" maxlength="250" /></td>
					<td class="alltags-cell">
						<a href="#" id="alltags_show"><?php _e('alltags_show');?></a>
						<a href="#" id="alltags_hide" style="display:none"><?php _e('alltags_hide');?></a></td>
					</tr></table>
				</div>
				<div class="form-row" id="alltags" style="display:none;"><?php _e('alltags');?> <span class="tags-list"></span></div>
				<div class="form-row form-bottom-buttons">
					<input type="submit" value="<?php _e('save');?>" />
					<input type="button" id="mtt_edit_cancel" class="mtt-back-button" value="<?php _e('cancel');?>" />
				</div>
			</form>
			</div>  <!-- end of page_taskedit -->
			<div id="authform" style="display:none">
				<form id="login_form">
					<div class="h"><?php _e('password');?></div>
					<div><input type="password" name="password" id="password" /></div>
					<div><input type="submit" value="<?php _e('btn_login');?>" /></div>
				</form>
			</div>
			<div id="priopopup" style="display:none">
				<span class="prio-neg prio-neg-1">&minus;1</span>
				<span class="prio-zero">&plusmn;0</span>
				<span class="prio-pos prio-pos-1">+1</span>
				<span class="prio-pos prio-pos-2">+2</span>
			</div>
			<div id="taskviewcontainer" class="mtt-menu-container" style="display:none">
				<ul>
					<li id="view_tasks"><?php _e('tasks');?> (<span id="cnt_total">0</span>)</li>
					<li id="view_past"><?php _e('f_past');?> (<span id="cnt_past">0</span>)</li>
					<li id="view_today"><?php _e('f_today');?> (<span id="cnt_today">0</span>)</li>
					<li id="view_soon"><?php _e('f_soon');?> (<span id="cnt_soon">0</span>)</li>
				</ul>
			</div>
			<div id="tagcloud" style="display:none">
				<a id="tagcloudcancel" class="mtt-img-button"><span></span></a>
				<div id="tagcloudload"></div>
				<div id="tagcloudcontent"></div>
			</div>
			<div id="taskcontextcontainer" class="mtt-menu-container" style="display:none">
				<ul>
					<li id="cmenu_edit"><b><?php _e('action_edit');?></b></li>
					<li id="cmenu_note"><?php _e('action_note');?></li>
					<li id="cmenu_prio" class="mtt-menu-indicator" submenu="cmenupriocontainer"><div class="submenu-icon"></div><?php _e('action_priority');?></li>
					<li id="cmenu_move" class="mtt-menu-indicator" submenu="cmenulistscontainer"><div class="submenu-icon"></div><?php _e('action_move');?></li>
					<li id="cmenu_delete"><?php _e('action_delete');?></li>
				</ul>
			</div>
			<div id="cmenupriocontainer" class="mtt-menu-container" style="display:none">
				<ul>
					<li id="cmenu_prio:2"><div class="menu-icon"></div>+2</li>
					<li id="cmenu_prio:1"><div class="menu-icon"></div>+1</li>
					<li id="cmenu_prio:0"><div class="menu-icon"></div>&plusmn;0</li>
					<li id="cmenu_prio:-1"><div class="menu-icon"></div>&minus;1</li>
				</ul>
			</div>
			<div id="cmenulistscontainer" class="mtt-menu-container" style="display:none">
				<ul>
				</ul>
			</div>
			<div id="slmenucontainer" class="mtt-menu-container" style="display:none">
				<ul>
					<li id="slmenu_list:-1" class="list-id--1 mtt-need-list" <?php if(is_readonly()) echo 'style="display:none"' ?>><div class="menu-icon"></div><a href="#alltasks"><?php _e('alltasks'); ?></a></li>
					<li class="mtt-menu-delimiter slmenu-lists-begin mtt-need-list" <?php if(is_readonly()) echo 'style="display:none"' ?>></li>
				</ul>
			</div>
			<div id="page_ajax" style="display:none"></div>
		</div>
		<div id="space"></div>
	</div>
</div>
</body>
</html>
<!-- r390 -->
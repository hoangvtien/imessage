<!-- BEGIN: main --> 	
<link type="text/css" rel="stylesheet" href="{DATAURL}style.css" media="screen"/>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery/jquery.cookie.js"></script>
<script type="text/javascript" src="{DATAURL}jwplayer.js"></script>
<script type="text/javascript" src="{DATAURL}js/jquery.tinyscrollbar.min.js"></script>
<script type="text/javascript" src="{DATAURL}showemotion.js"></script>
<script type="text/javascript" src="{DATAURL}emotionsdata.js"></script>
<script type="text/javascript">
	var timeupdate = 5000;
	var maxtime = 0;
	var chatsound = $.cookie("nvchatsound") || 1;
	var emotionurl = '{DATAURL}';
	var dataurl = '{SERVERURL}';
	var token = '{TOKEN}';
	var itemgb = {ITEMBG};
	var lastitem = {NUMITEM};
	var isprosess = 0;
	var minlength = 2;
	var lastchat = 0;
	var timeout = 3000;
	var timereloadonline = 600000;
	var dingtimeout = 5000;
	var lastding = 0;
	var messtimeout = ['{LANG.time_out_1}','{LANG.time_out_2}'];
	var messlenght = ['{LANG.lenght_1}','{LANG.lenght_2}'];
	var textsound = ['{LANG.sound_on}','{LANG.sound_off}'];
	var texttime = ['{LANG.atamoment}','{LANG.sago}','{LANG.mago}','{LANG.hago}'];
	var textding = ['{LANG.ding_1}','{LANG.ding_2}'];
	var textquoteuser = '{LANG.answer}';
</script>
<script type="text/javascript" src="{DATAURL}imessage.js"></script>
{LANG.hj} <a target="_top" href="{EDITINFO}" title="{LANG.update_info}">{USERNAME}</a> ! {LANG.online}: <span title="{LANG.online_info}" id="online" class="a">{ONLINE}</span>
<div class="fr wrap-emotion clearfix">
	{LANG.settime}: <span id="settime" class="a">5s</span> | {LANG.sound}: <span class="a" id="sound"></span> | <span class="a" id="emotions">{LANG.emotions}</span> | <span class="a" onclick="dingchat();">buzz</span>
	<div class="emotion-content" id="emotiondata"></div>
</div>
<form class="clearfix form" id="form">
	<table cellpadding="0" cellspacing="0">
		<tr>
			<td><input type="text" maxlength="160" name="q" id="q" class="q" autocomplete="off"/></td>
			<td style="width:40px"><input class="fr" type="submit" id="s" value="{LANG.submit}"/></td>
		</tr>
	</table>
</form>
<div id="content">
	<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
	<div class="viewport" style="height:{HEIGHT}px">
		<div class="overview" id="overview">
			<!-- BEGIN: loop --> 
			<div class="item clearfix{BG}" id="item{ID}">
				<img class="avatar fl" src="{DATA.1}" width="30" height="30" alt="{DATA.2}" />
				<span title="{LANG.answer}" onclick="quoteuser($(this));" class="a">{DATA.2}</span> - <span id="{DATA.5}" class="time">{DATA.3}</span><br />
				{DATA.4}
			</div>
			<!-- END: loop --> 
		</div>
	</div>
</div>
<div id="player"></div>
<script type="text/javascript">
jwplayer("player").setup({flashplayer: "{DATAURL}player.swf",playlist: [{file: "{DATAURL}message.mp3", title: "Message", description: "Chat Message"},{file: "{DATAURL}ding.mp3", title: "Ding", description: "Ding Message"},],volume: 100,height: 1,width: 1});
</script>
<!-- END: main --> 
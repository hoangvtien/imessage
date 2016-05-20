<!-- BEGIN: main --> 
<link type="text/css" rel="stylesheet" href="{DATAURL}style.css" media="screen"/>
<div class="text-center">{LANG.login_info}</div>
<div class="text-center"><em>{LANG.login_info1}</em>? <a target="_top" href="{REGISTERURL}" title="{LANG.reg1}">{LANG.reg}</a> <em>{LANG.now}!</em></div>
<form id="login">
    <div class="login">
        <input type="text" class="txt" id="username" name="username"/>
        <input type="password" class="txt" id="password" name="password"/>
        <input type="submit" value="{LANG.login}" id="s"/>
    </div>
</form>
<script type="text/javascript">
$(document).ready(function(){
    $('#login').submit(function(){
        if( $('#username').val() == '' ){
            alert('{LANG.err_username}'); $('#username').select(); return !1;
        };
        if( $('#password').val() == '' ){
            alert('{LANG.err_pass}'); $('#password').select(); return !1;
        };
        $('[type=submit]').attr('disabled','disabled');
        $.ajax({
            type: 'POST',
            url: '{NV_BASE_SITEURL}index.php',
            data: '{BASEPOST}&username=' + $('#username').val() + '&password=' + $('#password').val(),
            success: function(data){
                if(data=='OK'){
                    window.location.href = window.location.href;
                } else alert(data);
                $('[type=submit]').removeAttr('disabled');
            }
        });
        return !1;
    });
});
</script>
<!-- END: main --> 
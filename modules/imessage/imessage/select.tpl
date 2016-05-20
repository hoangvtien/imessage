<!-- BEGIN: main --> 
<link type="text/css" rel="stylesheet" href="{DATAURL}style.css" media="screen"/>
<div class="text-center">{LANG.login_info}</div>
<div class="login">
    <select id="groupselect">
        <option value="">{LANG.group_select}</option>
        <!-- BEGIN: group --> 
        <option value="{URL}">{TITLE}</option>
        <!-- END: group --> 
    </select>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#groupselect').change(function(){
        if( $(this).val() != '' ){
            window.location = $(this).val();
        };
    });
});
</script>
<!-- END: main --> 
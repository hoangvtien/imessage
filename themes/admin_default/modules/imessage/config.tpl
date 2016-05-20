<!-- BEGIN: main -->
<!-- BEGIN: empty -->
<div class="alert alert-warning">
    {LANG.group_empty}
</div>
<!-- END: empty -->
<!-- BEGIN: data -->
<form action="{FORM_ACTION}" method="post">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <col class="w250"/>
            <tbody>
                <tr>
                    <td><strong>{LANG.config_allow}</strong></td>
                    <td>
                        <!-- BEGIN: group -->
                        <input type="checkbox" name="group[]" id="groupchat{ID}" value="{ID}"{CHECKED}/> <label for="groupchat{ID}">{NAME}</label><br />
                        <!-- END: group -->
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" class="text-center">
                        <input type="submit" name="submit" value="{LANG.submit}" class="btn btn-primary"/>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</form>
<!-- END: data -->
<!-- END: main -->

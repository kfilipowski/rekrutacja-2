<form>
    {include file="_step_begin.tpl"}
    {include file="_step_age.tpl"}
    {include file="_step_color.tpl"}
    {include file="_step_swim.tpl"}
    {include file="_step_final.tpl"}
    <br/>
    <input type="submit" name="reset" value="Reset">
    {if !$form->isFinalStep()}
        <input type="submit" name="next" value="Next">
    {/if}
    {if $form->isFinalStep()}
        <style>
            body { 
                background: {$form->getBgColor()};
            }
        </style>
    {/if}
</form>

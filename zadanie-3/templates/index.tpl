<html>
<head>
    <title>Zadanie 3</title>
</head>
<body{if $form->getBgColor()} style="background:{$form->getBgColor()};"{/if}>
    <style>
        .info.error {
            color: red;
        }
    </style>
    <form method="post">
        {include file="_step_begin.tpl"}
        {include file="_step_age.tpl"}
        {include file="_step_color.tpl"}
        {include file="_step_swim.tpl"}
        {include file="_step_final.tpl"}
        <br/>
        <input type="submit" name="reset" value="Reset">
        {if !$form->isFinalStep()}
            <input type="submit" value="Next">
        {/if}
    </form>
</body>
</html>

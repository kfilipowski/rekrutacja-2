{if $form->isColorStep()}
    <label for="color">Color:</label>
    <select name="color" id="color">
        <option>-- --</option>
        {foreach from=$form->getColors() item=item}
            <option value="{$item}">
                {$item}
            </option>
        {/foreach}
    </select>
    {if isset($errors.color)}
        <p class="info error">
            {$errors.color}
        </p>
    {/if}
{/if}

{if $form->isBeginStep()}
    <label for="name">What is your name?</label>
    <input type="text" name="name" id="name"/>
    {if isset($errors.name)}
        <p class="info error">{$errors.name}</p>
    {/if}
    <br/>
    <label for="sex">What is your sex?</label>
    <select name="sex" id="sex">
        <option>-- --</option>
        <option value=1>Mężczyzna</option>
        <option value=2>Kobieta</option>
    </select>
    {if isset($errors.sex)}
        <p class="info error">{$errors.sex}</p>
    {/if}
{/if}

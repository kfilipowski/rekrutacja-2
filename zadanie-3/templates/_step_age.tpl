{if $form->isAgeStep()}
    <label for="age">What is your age?</label>
    <input type="number" name="age" min="1" max="100" id="age"/>
    {if isset($errors.age)}
        <p class="info error">{$errors.age}</p>
    {/if}
{/if}

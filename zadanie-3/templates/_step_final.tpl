{if $form->isFinalStep()}
    <ul>
        <li>Name: {$form->getName()}</li>
        <li>Sex: {if $form->isMen()}male{else}female{/if}</li>
        {if $form->isMen()}
            <li>Age: {$form->getAge()}</li>
        {else}
            <li>Color: {$form->getColor()}</li>
        {/if}
        <li>Can swim: {if $form->canSwim()}yes{else}no{/if}</li>
    </ul>
{/if}

<div class="files">
    <h1>List of files</h1>
    {if isset($files) && count($files)}
        <ul>
            {foreach $files as $file}
                <li>
                    {$file->name()}
                    ({$file->size()} kb)
                </li>
            {/foreach}
        </ul>
    {else}
        <p>No files</p>
    {/if}
</div>

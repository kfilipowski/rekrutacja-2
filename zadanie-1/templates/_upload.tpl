<div>
    <h1>Upload</h1>
    <form action="index.php?upload" method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit" name="submit" value="Upload">
    </form>
    {if isset($info) && !empty($info)}
        <p class="info {$info[0].type}">
            {$info[0].content}
        </p>
    {/if}
</div>

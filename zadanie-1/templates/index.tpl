<html>
<head>
    <title>Zadanie 1</title>
</head>
<body>
<style>
    .info.error {
        color: red;
    }
    .info.success {
        color: green;
    }
</style>
    <div>
        <h1>Upload</h1>
        <form action="index.php?upload" method="post" enctype="multipart/form-data">
            <input type="file" name="file" id="file">
            <input type="submit" name="submit" value="Upload">
        </form>
        {if isset($info) && !empty($info)}
            <p class="info {$info[0].type}">
                {$info[0].content}
            </p>
        {/if}
    </div>
    <div>
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
<div>
</div>
</body>
</html>

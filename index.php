
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap 4 Website Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="magnific-popup.css">
    <link rel="stylesheet" href="styles.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="jquery.magnific-popup.min.js"></script>
    <script>
        $(function() {
            $('.card-file').magnificPopup({
                type: 'image',
                gallery:{
                    enabled:true
                }
                // other options
                // ..
            });
        });
    </script>
</head>
<body>

<?php 
$dir = __DIR__;
if (isset($_GET['dir'])) {
    if (is_dir(__DIR__.'/'.$_GET['dir'])) {
        $dir = __DIR__.'/'.$_GET['dir'];
    }
}

$relativeDir = trim(str_replace(__DIR__, '', $dir), '/');
?>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a class="navbar-brand" href="#">
        <strong class="text-info">Gal</strong>lery of P<strong class="text-info">ics</strong>
        <small>Yet another awesome gallery</small>
    </a>
</nav>

<!-- breadcrumpbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="?">Home</a></li>
        <?php $folderParts = explode('/', $relativeDir); ?>
        <?php foreach ($folderParts as $i => $folderItem) { ?>
        <li class="breadcrumb-item" aria-current="page">
            <?php if ($i == count($folderParts) - 1) { ?>
            <?php echo $folderItem; ?>
            <?php } else { ?>
            <a href="?dir=<?php echo implode('/', array_slice($folderParts, 0, $i + 1)); ?>"><?php echo $folderItem; ?></a>
            <?php } ?>
        </li>
        <?php } ?>
    </ol>
</nav>

<div class="container-fluid main-wrapper">
    <div class="row"><div class="col-12 main-row">
    <?php
    // display folders
    foreach (glob($dir.'/*', GLOB_ONLYDIR) as $folder) {
        $folderUrl = trim(str_replace(__DIR__, '', $folder), '/');
        ?>
        <a href="?dir=<?php echo $folderUrl; ?>" class="card card-folder">
            <div class="card-body">
                <h5 class="card-title" title="<?php echo addslashes(basename($folder)); ?>"><?php echo basename($folder); ?></h5>
                <div>
                    <?php
                    // check if has folders
                    if (count(glob($folder.'/*', GLOB_ONLYDIR)) > 0) {
                        ?><div class="preview-thumb-wrapper"><i class="far fa-folder"></i></div><?php
                    }
                    
                    $imageFiles = glob($folder.'/*.jpg');
                    if (count($imageFiles) > 0) {
                        foreach ($imageFiles as $i => $imageFile) {
                            if ($i >= 3) break;
                            $imageUrl = ltrim(str_replace(__DIR__, '', $imageFile), '/');
                            ?>
                            <div class="preview-thumb-wrapper">
                                <img src="<?php echo $imageUrl; ?>" />
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </a>
        <?php
    }  
    ?>

    <?php
    // display images
    foreach (glob($dir.'/*.jpg') as $imageFile) {
        $imageFilerUrl = trim(str_replace(__DIR__, '', $imageFile), '/');
        ?>
        <a href="<?php echo $imageFilerUrl; ?>" class="card card-folder card-file">
            <div class="card-body card-body-main-image-wrapper">
                <img src="<?php echo $imageFilerUrl; ?>" class="main-image" />
            </div>
        </a>
        <?php
    }  
    ?>
    </div></div>
</div>

</body>
</html>

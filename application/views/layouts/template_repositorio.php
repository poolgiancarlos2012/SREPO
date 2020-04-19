<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $this->layout->getTitle(); ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php echo $this->layout->css; ?>
</head>
<body>
    <?php echo $content_for_layout; ?>
    <?php echo $this->layout->js; ?>
</body>
</html>                                		                            
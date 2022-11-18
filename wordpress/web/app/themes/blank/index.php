<?php
/**
 * The main template file
 *
 * @package WordPress
 * @subpackage Blank
 * @since 1.0.0
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noindex, nofollow">
    <?php if (WP_ENV !== 'development'): ?>
    <script>
        window.location = '<?= getenv('WP_FRONTEND'); ?>';
    </script>
	<?php endif; ?>
</head>
<body>
</body>
</html>

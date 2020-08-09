<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/favicon.png" rel="icon" type="image/png" sizes="48x48">
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php if(isset($page->keywords)): ?>
    <meta name="keywords" content="<?php echo e($page->keywords); ?>">
    <?php endif; ?>
    <?php if(isset($page->description)): ?>
    <meta name="description" content="<?php echo e($page->description); ?>">
    <?php endif; ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <?php if(isset($page)): ?>
    <title><?php echo e($page->title); ?></title>
    <?php else: ?>
    <title></title>
    <?php endif; ?>

</head>

<body>
    <?php $__env->startComponent('components.nav'); ?>
    <?php if (isset($__componentOriginal318a60d359516fe3e2425886d804021946905e38)): ?>
<?php $component = $__componentOriginal318a60d359516fe3e2425886d804021946905e38; ?>
<?php unset($__componentOriginal318a60d359516fe3e2425886d804021946905e38); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
    <main class="main-content">
        <?php echo $__env->yieldContent('content'); ?>
    </main>
    <?php $__env->startComponent('components.footer'); ?>
    <?php if (isset($__componentOriginal2d1e7c5cf9e06da7dcbfcd38aa098b349a88533b)): ?>
<?php $component = $__componentOriginal2d1e7c5cf9e06da7dcbfcd38aa098b349a88533b; ?>
<?php unset($__componentOriginal2d1e7c5cf9e06da7dcbfcd38aa098b349a88533b); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
</body>

</html><?php /**PATH F:\projects\openserver\domains\cms\resources\views\site/layouts/site.blade.php ENDPATH**/ ?>
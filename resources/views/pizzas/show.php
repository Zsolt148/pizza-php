<?php
include(APP_ROOT . "/resources/views/layouts/header.php");
?>
    <section class="w-full px-6 pb-12 antialiased bg-white">
        <div class="px-10 py-24 mx-auto max-w-7xl">
            <h1 class="text-2xl font-semibold text-gray-700 mb-8">Show</h1>

			<?php $disabled = true; ?>
			<?php include_once 'form.php' ?>

            <?php if(auth()->check()) : ?>
                <a class="mt-5" href="<?php echo route($routes->get('opsystems.edit'), $opsystem['id']); ?>">
                    Edit
                </a>
			<?php endif; ?>
        </div>
    </section>
<?php
include(APP_ROOT . "/resources/views/layouts/footer.php");
?>
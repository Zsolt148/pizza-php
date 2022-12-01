<?php
include(APP_ROOT . "/resources/views/layouts/header.php");
?>
<section class="w-full px-6 pb-12 antialiased bg-white">
    <div class="px-10 py-24 mx-auto max-w-7xl">
        <h1 class="text-2xl font-semibold text-gray-700 mb-8">Export order</h1>

        <?php include_once APP_ROOT . '/resources/views/shared/status.php' ?>
		<?php include_once APP_ROOT . '/resources/views/shared/errors.php' ?>

        <form class="space-y-4 md:space-y-6" action='<?php echo route($routes->get('orders.download')); ?>' method="POST">
            <div class="text-sm text-gray-500">
                Example: <br>
                Popey <br>
                2005-11-12 11:21
            </div>
            <div>
                <label for="pizza_name" class="block mb-2 text-sm font-medium text-gray-900">Pizza name</label>
                <input type="text" name="pizza_name" id="pizza_name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                <label for="ordered_at" class="block mb-2 text-sm font-medium text-gray-900">Ordered at (date and time)</label>
                <input type="datetime-local" name="ordered_at" id="ordered_at" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
            </div>

            <button type="submit" class="w-full text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 shadow-lg shadow-blue-500/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Export
            </button>
        </form>
    </div>
</section>
<?php
include(APP_ROOT . "/resources/views/layouts/footer.php");
?>
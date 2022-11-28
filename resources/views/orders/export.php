<?php
include("../resources/views/layouts/header.php");
?>
<section class="w-full px-6 pb-12 antialiased bg-white">
    <div class="px-10 py-24 mx-auto max-w-7xl">
        <h1 class="text-2xl font-semibold text-gray-700 mb-8">Export order</h1>

		<?php include_once '../resources/views/shared/errors.php' ?>

        <form class="space-y-4 md:space-y-6" action="<?php echo route($routes->get('orders.export'), $order['id']); ?>" method="POST">
            <div>
                <label class="text-gray-700" for="id">ID</label>
                <input id="id" name="id" type="text" value="<?php echo isset($id) ? $order['id'] : null ?>" required <?php echo isset($disabled) ? 'disabled' : '' ?>>
            </div>

            <button type="submit" class="w-full text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 shadow-lg shadow-blue-500/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Export
            </button>
        </form>
    </div>
</section>
<?php
include("../resources/views/layouts/footer.php");
?>
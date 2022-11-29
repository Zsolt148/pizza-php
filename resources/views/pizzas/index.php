<?php
include(APP_ROOT . "/resources/views/layouts/header.php");
?>
<section class="w-full px-6 pb-12 antialiased bg-white">
    <div class="px-10 mx-auto max-w-7xl">
        <h1 class="text-2xl font-semibold text-gray-700 mb-8">
            Our pizzas
            <?php if(auth()->check()) : ?>
                - <a class="button" href="<?php echo route($routes->get('pizzas.create')); ?>">Add new</a>
		    <?php endif; ?>
        </h1>

		<?php include_once APP_ROOT . '/resources/views/shared/status.php' ?>
		<?php include_once APP_ROOT . '/resources/views/shared/errors.php' ?>

        <div class="overflow-x-auto relative">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="py-3 px-6">Name</th>
                        <th scope="col" class="py-3 px-6">Category name</th>
                        <th scope="col" class="py-3 px-6">Price</th>
                        <th scope="col" class="py-3 px-6">Order</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($pizzas as $pizza) { ?>
                    <tr class="bg-white border-b">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                            <span class="td-content"><?php echo $pizza['name']; ?></span>
                        </th>
                        <td class="py-4 px-6">
                            <span class="td-content"><?php echo $pizza['category_name']; ?></span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="td-content"><?php echo $pizza['cat_price']; ?> Ft</span>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<section>

<?php
include(APP_ROOT . "/resources/views/layouts/footer.php");
?>
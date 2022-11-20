<?php
include("../resources/views/layouts/header.php");
?>
<section class="w-full px-8 py-16 antialiased">
	<div class="max-w-7xl mx-auto">

        <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 my-12">
            <div class="w-full sm:max-w-lg p-8 py-10 overflow-hidden bg-white border-b-2 border-gray-300 rounded-lg shadow-2xl px-7" data-rounded="rounded-lg" data-rounded-max="rounded-full">
                <h3 class="mb-6 text-2xl font-medium text-center">Create your Account</h3>

                <?php include_once '../resources/views/shared/errors.php' ?>

                <form action="<?php echo route($routes->get('register.post')) ?>" method="POST">
                    <input type="text" name="name" id="name" class="block w-full px-4 py-3 mb-4 border border-2 border-transparent border-gray-200 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none" data-rounded="rounded-lg" data-primary="blue-500" placeholder="Name" required>
                    <input type="text" name="email" id="email" class="block w-full px-4 py-3 mb-4 border border-2 border-transparent border-gray-200 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none" data-rounded="rounded-lg" data-primary="blue-500" placeholder="Email address" required>
                    <input type="password" name="password" id="password" class="block w-full px-4 py-3 mb-4 border border-2 border-transparent border-gray-200 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none" data-rounded="rounded-lg" data-primary="blue-500" placeholder="Password" required>
                    <div class="block">
                        <button type="submit" class="w-full px-3 py-4 font-medium text-white bg-blue-600 rounded-lg" data-primary="blue-600" data-rounded="rounded-lg">Register</button>
                    </div>
                    <p class="w-full mt-4 text-sm text-center text-gray-500">Have an account? <a href="<?php echo route($routes->get('login')) ?>" class="text-blue-500 underline">Login here</a></p>
                </form>
            </div>
        </div>

	</div>
</section>
<?php
include("../resources/views/layouts/footer.php");
?>
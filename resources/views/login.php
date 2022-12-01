<?php
include(APP_ROOT . "/resources/views/layouts/header.php");
?>
<section class="w-full px-8 py-16 antialiased bg-gray-50">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col items-center justify-center lg:py-0">
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Sign in to your account
                    </h1>
                    <?php include_once APP_ROOT . '/resources/views/shared/status.php' ?>
                    <?php include_once APP_ROOT . '/resources/views/shared/errors.php' ?>

                    <form class="space-y-4 md:space-y-6" action="<?php echo route($routes->get('login.post')) ?>" method="POST">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="name@company.com" required="">
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                        </div>
                        <button type="submit" class="w-full text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 shadow-lg shadow-blue-500/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Login
                        </button>
                        <p class="text-sm font-light text-gray-500">
                            Don’t have an account yet? <a href="<?php echo route($routes->get('register')) ?>" class="font-medium text-primary-600 hover:underline">Sign up</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include(APP_ROOT . "/resources/views/layouts/footer.php");
?>
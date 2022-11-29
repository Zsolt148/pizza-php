<?php
include(APP_ROOT . "/resources/views/layouts/header.php");
?>

	<section class="bg-white">
		<div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
			<div class="mr-auto place-self-center lg:col-span-7">
				<h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl">Best pizzas in town</h1>
				<p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl">From checkout to global sales tax compliance, companies around the world use Flowbite to simplify their payment stack.</p>
				<a href="#" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 shadow-lg shadow-blue-500/50 font-medium rounded-lg text-base px-5 py-2.5 text-center">
					Get started
				</a>
				<a href="#" class="ml-5 px-5 py-2.5 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100">
					Browse
				</a>
			</div>
			<div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
				<img src="/public/images/pizza.png" alt="mockup">
			</div>
		</div>
	</section>

<?php
include(APP_ROOT . "/resources/views/layouts/footer.php");
?>
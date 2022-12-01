<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo SITE_NAME; ?></title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.4/dist/flowbite.min.css" />
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🍕</text></svg>">

</head>
<body>
<section class="w-full px-6 pb-12 antialiased bg-white" data-tails-scripts="//unpkg.com/alpinejs">
    <div class="mx-auto max-w-7xl">
        <nav class="bg-white px-2 sm:px-4 py-2.5 fixed w-full z-20 top-0 left-0 border-b border-gray-200">
            <div class="container flex flex-wrap items-center justify-between mx-auto">
                <a href="<?php echo route($routes->get('home')) ?>" class="flex items-center">
                    <img src="https://flowbite.com/docs/images/logo.svg" class="h-6 mr-3 sm:h-9" alt="Flowbite Logo">
                    <span class="self-center text-xl font-semibold whitespace-nowrap">
                        <?php echo SITE_NAME; ?>
                    </span>
                </a>
                <div class="flex md:order-2">
					<?php if(!auth()->check()) : ?>
                        <a href="<?php echo route($routes->get('login')) ?>" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 shadow-lg shadow-blue-500/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Sign In
                        </a>
					<?php else : ?>
                        <button type="button" class="flex space-x-2" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
							<span>Hi <?php echo auth()->user()->name ?>!</span>
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow" id="user-dropdown">
                            <div class="px-4 py-3">
                                <span class="block text-sm text-gray-900"><?php echo auth()->user()->name ?></span>
                                <span class="block text-sm font-medium text-gray-500 truncate"><?php echo auth()->user()->email ?></span>
                                <span class="block text-sm font-medium text-gray-500 truncate">Role: <?php echo auth()->user()->role ?></span>
                            </div>
                            <ul class="py-1" aria-labelledby="user-menu-button">
                                <li>
                                    <a href="<?php echo route($routes->get('logout')) ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign out</a>
                                </li>
                            </ul>
                        </div>
					<?php endif; ?>
                    <button data-collapse-toggle="navbar-sticky" type="button" class="ml-2 inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-sticky" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
                <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                    <ul class="flex flex-col p-4 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white">
                        <?php foreach(App\Models\Menu::mapMenus() as $menu) : ?>
                            <?php if($menu['children_count'] && $menu['children']) : ?>
                                <button type="button" class="flex space-x-2" id="order-menu-button" aria-expanded="false" data-dropdown-toggle="order-dropdown" data-dropdown-placement="bottom">
                                    <span class="text-xl font-medium block rounded"><?php echo $menu['name'] ?></span>
                                    <svg class="w-6 h-6 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                                <!-- Dropdown menu -->
                                <div class="z-50 hidden my-4 text-base font-medium list-none bg-white divide-y divide-gray-100 rounded shadow" id="order-dropdown">
									<?php foreach($menu['children'] as $sub) : ?>
                                        <ul class="py-1" aria-labelledby="order-menu-button-<?php echo $sub['id'] ?>">
                                            <li>
                                                <a href="<?php echo route($routes->get($sub['route'])) ?>" class="block px-4 py-2 text-gray-700 hover:bg-gray-100"><?php echo $sub['name'] ?></a>
                                            </li>
                                        </ul>
                                    <?php endforeach; ?>
                                </div>
                            <?php else : ?>
                                <li>
                                    <a href="<?php echo route($routes->get($menu['route'])) ?>" class="block text-xl py-2 pl-3 pr-4 rounded md:p-0 <?php echo isRoute($routes->get($menu['route'])) ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700' : 'text-gray-700 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700' ?>">
                                        <?php echo $menu['name'] ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</section>

<main class="overflow-x-hidden py-10">
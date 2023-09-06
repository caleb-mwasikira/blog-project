<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <section class="bg-white dark:bg-gray-900">
        <div class="container px-6 py-10 mx-auto">
            <div class="lg:flex lg:-mx-6">
                <div class="lg:w-3/4 lg:px-6">
                    <!-- Blog post -->
                    <div>
                        <img class="object-cover object-center w-full h-64 rounded-lg lg:h-80"
                            src="<?= $post->img_src ?? '' ?>" alt="" />

                        <div class="mt-8">
                            <span class="text-blue-500"><?= $post->category ?? '' ?></span>

                            <h1 class="mt-4 text-xl font-semibold text-gray-800 dark:text-white">
                                <?= $post->title ?? '' ?>
                            </h1>

                            <p class="mt-2 text-gray-500 dark:text-gray-400">
                                <?= $post->body ?? '' ?>
                            </p>

                            <div class="flex items-center justify-between mt-4">
                                <div>
                                    <a href="#"
                                        class="text-lg font-medium text-gray-700 dark:text-gray-300 hover:underline hover:text-gray-500">
                                        <?= $post->author ?? 'Unknown Author' ?>
                                    </a>

                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        <?= $post->published_date ?? 'Unknown Published Date' ?>
                                    </p>
                                </div>

                                <a href="/posts" class="inline-block text-blue-500 underline hover:text-blue-400">Go
                                    Back</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 lg:w-1/4 lg:mt-0 lg:px-6">
                    <div>
                        <h3 class="text-blue-500 capitalize">Design instument</h3>

                        <a href="#"
                            class="block mt-2 font-medium text-gray-700 hover:underline hover:text-gray-500 dark:text-gray-400 ">
                            How to raise $100k+ by using blox ui kit on your design
                        </a>
                    </div>

                    <hr class="my-6 border-gray-200 dark:border-gray-700">

                    <div>
                        <h3 class="text-blue-500 capitalize">UI Resource</h3>

                        <a href="#"
                            class="block mt-2 font-medium text-gray-700 hover:underline hover:text-gray-500 dark:text-gray-400 ">
                            Should you creat UI Product by using Blox?
                        </a>
                    </div>

                    <hr class="my-6 border-gray-200 dark:border-gray-700">

                    <div>
                        <h3 class="text-blue-500 capitalize">Premium Collection</h3>

                        <a href="#"
                            class="block mt-2 font-medium text-gray-700 hover:underline hover:text-gray-500 dark:text-gray-400 ">
                            Top 10 Blocks you can get on Blox's collection.
                        </a>
                    </div>

                    <hr class="my-6 border-gray-200 dark:border-gray-700">

                    <div>
                        <h3 class="text-blue-500 capitalize">Premium kits</h3>

                        <a href="#"
                            class="block mt-2 font-medium text-gray-700 hover:underline hover:text-gray-500 dark:text-gray-400 ">
                            Top 10 Ui kit you can get on Blox's collection.
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>

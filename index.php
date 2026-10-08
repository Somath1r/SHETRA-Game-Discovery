<?php
session_start();

include "config/database.php";

$queryTrending = mysqli_query(
    $conn,
    "SELECT * FROM games WHERE category = 'trending'"
);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SETHRA — Discover Your Next Game</title>

    <!-- Tailwind CSS -->
    <link href="./css/output.css" rel="stylesheet">

</head>

<body class="relative min-h-screen bg-[#09090b] text-white overflow-x-hidden">

  <div class="sethra-glow-wrapper">
    <div class="glow-purple-top"></div>
    <div class="glow-red-middle"></div>
    <div class="glow-purple-bottom"></div>
  </div>


   <header class="sticky top-0 z-20 w-full px-4 pt-4 sm:px-8">

    <!-- Nav Container (Border membungkus di samping logo & tombol, lalu melengkung ke atas) -->
    <nav class="mx-auto flex max-w-7xl items-center justify-between rounded-2xl border border-white/11 bg-[#09090b]/80 px-6 py-4 backdrop-blur-md shadow-2xl">

        <!-- LOGO (DIPERBESAR) -->
        <a href="#" class="flex items-center gap-4">
            <!-- Ukuran logo diperbesar dari h-9 w-9 menjadi h-12 w-12 -->
            <div class="flex h-13 w-13 items-center justify-center overflow-hidden rounded-xl border border-white/10 bg-white/5 p-1">
                <img src="./images/Logo web.jpeg" alt="Sethra Logo" class="h-full w-full object-cover rounded-lg">
            </div>
            <!-- Ukuran teks judul diperbesar ke text-2xl -->
            <span class="text-1xl font-extrabold tracking-wider text-white">
                SETHRA
            </span>
        </a>


        <!-- NAVIGATION LINKS -->
        <div class="hidden items-center gap-8 md:flex">
            <a href="#" class="text-sm font-medium text-white transition hover:text-purple-400">Home</a>
            <a href="#discover" class="text-sm font-medium text-gray-400 transition hover:text-white">Discover</a>
            <a href="#games" class="text-sm font-medium text-gray-400 transition hover:text-white">Games</a>
            <a href="#my-pc" class="text-sm font-medium text-gray-400 transition hover:text-white">My PC</a>
        </div>


        <!-- RIGHT BUTTONS -->
        <div class="flex items-center gap-3">

            <button
                class="hidden rounded-lg px-4 py-2 text-sm font-medium text-gray-400 transition hover:bg-white/5 hover:text-white sm:block"
            >
                Search
            </button>


            <?php if (isset($_SESSION["user_id"])): ?>

                <!-- USER MENU -->
                <div class="relative">

                    <!-- USER BUTTON -->
                    <button
                        id="userMenuButton"
                        type="button"
                        class="flex items-center gap-2 rounded-full px-4 py-2 text-sm font-medium text-white transition hover:bg-white/10"
                    >

                        <span>
                            <?= htmlspecialchars($_SESSION["username"]) ?>
                        </span>

                        <svg
                            class="h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="m19 9-7 7-7-7"
                            />
                        </svg>

                    </button>


                    <!-- DROPDOWN -->
                    <div
                        id="userMenu"
                        class="absolute right-0 z-50 mt-3 hidden w-52 overflow-hidden rounded-xl border border-white/10 bg-zinc-900 shadow-xl"
                    >

                        <!-- USER INFO -->
                        <div class="border-b border-white/10 px-4 py-3">

                            <p class="text-xs text-zinc-400">
                                Signed in as
                            </p>

                            <p class="mt-1 truncate font-medium text-white">
                                <?= htmlspecialchars($_SESSION["username"]) ?>
                            </p>

                        </div>


                        <!-- MENU -->
                        <div class="py-2">

                            <a
                                 href="auth/profile.php"
                                class="block px-4 py-2 text-sm text-zinc-300 transition hover:bg-white/10 hover:text-white"
                            >
                                My Profile
                            </a>

                            <a
                                href="#"
                                class="block px-4 py-2 text-sm text-zinc-300 transition hover:bg-white/10 hover:text-white"
                            >
                                My PC
                            </a>

                            <a
                                href="#"
                                class="block px-4 py-2 text-sm text-zinc-300 transition hover:bg-white/10 hover:text-white"
                            >
                                Settings
                            </a>

                        </div>


                        <!-- LOGOUT -->
                        <div class="border-t border-white/10 py-2">

                            <a
                                href="auth/logout.php"
                                class="block px-4 py-2 text-sm text-red-400 transition hover:bg-red-500/10 hover:text-red-300"
                            >
                                Log Out
                            </a>

                        </div>

                    </div>

                </div>


            <?php else: ?>

                <!-- GET STARTED -->
                <a
                    href="auth/login.php"
                    class="rounded-lg bg-white px-5 py-2 text-sm font-semibold text-black transition hover:bg-zinc-200"
                >
                    Get Started
                </a>

            <?php endif; ?>

        </div>

</nav>

</header>


    <!-- =========================================================
         HERO SECTION (z-10: Berada di atas background glow)
    ========================================================== -->
    <main class="relative z-10">

        <section class="relative">
            <div class="relative mx-auto max-w-7xl px-6 py-28">
                <div class="mx-auto max-w-4xl text-center">

                    <!-- Small Label -->
                    <p class="mb-6 text-sm font-medium uppercase tracking-[0.25em] text-gray-400">
                        Game Discovery Platform
                    </p>

                    <!-- Heading -->
                    <h1 class="bg-gradient-to-r from-pink-500 via-purple-400 to-violet-500 bg-clip-text text-5xl font-extrabold text-transparent sm:text-6xl">
                        Find Your Next Game <br> With Sethra
                    </h1>

                    <!-- Description -->
                    <p class="mx-auto mt-7 max-w-2xl text-base leading-relaxed text-gray-300 sm:text-lg">
                        Discover games based on your preferences, check whether your PC can run them, and get an estimated FPS before you play.
                    </p>

                    <!-- BOX CONTAINER (SEARCH & CTA) -->
                    <div class="mx-auto mt-10 max-w-2xl rounded-2xl border border-white/10 bg-white/[0.03] p-6 shadow-2xl backdrop-blur-md">
                        
                        <!-- SEARCH BAR -->
                        <div class="flex items-center rounded-xl border border-white/10 bg-black/40 p-2 transition focus-within:border-white/20">
                            <span class="px-3 text-gray-400">🔍</span>
                            <input type="text" placeholder="Search games, genres, or developers..." class="w-full bg-transparent px-2 py-3 text-sm text-white outline-none placeholder:text-gray-500">
                            <button class="rounded-lg bg-white px-5 py-3 text-sm font-semibold text-black transition hover:bg-gray-200">
                                Search
                            </button>
                        </div>

                        <!-- CTA BUTTONS -->
                        <div class="mt-6 flex flex-wrap justify-center gap-4">
                            <a href="#my-pc" class="rounded-lg bg-white px-6 py-3 text-sm font-semibold text-black transition hover:bg-gray-200">
                                Find Games for My PC
                            </a>
                            <a href="#games" class="rounded-lg border border-white/10 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/5">
                                Browse Games
                            </a>
                        </div>

                    </div>

                </div>
            </div>
        </section>


 <!-- ==================== GAMES ==================== -->
<section id="games">

    <div class="mx-auto max-w-7xl">


        <!-- ==========================================
             TRENDING GAMES
        =========================================== -->

        <div class="mb-20">

            <!-- Header -->
            <div class="mb-8 flex items-end justify-between">

                <div>
                    <p class="mb-2 text-sm font-medium uppercase tracking-widest text-purple-400">
                        What's Hot
                    </p>

                    <h2 class="text-3xl font-bold text-white md:text-4xl">
                        Trending Games
                    </h2>

                    <p class="mt-3 text-gray-400">
                        Discover what gamers are playing right now.
                    </p>
                </div>


                <!-- Navigation -->
                <div class="flex gap-2">

                    <button
                        id="trendingPrevBtn"
                        class="flex h-10 w-10 items-center justify-center rounded-full border border-white/10 bg-white/5 text-lg text-white transition hover:bg-purple-500">
                        <
                    </button>

                    <button
                        id="trendingNextBtn"
                        class="flex h-10 w-10 items-center justify-center rounded-full border border-white/10 bg-white/5 text-lg text-white transition hover:bg-purple-500">
                        >
                    </button>

                </div>

            </div>


            <!-- Trending Carousel -->
             
            <div class="overflow-hidden rounded-2xl">

               <div
                    id="trendingCarousel"
                    class="flex transition-transform duration-500 ease-in-out">

                    <?php
                    $index = 1;

                    while ($game = mysqli_fetch_assoc($queryTrending)):
                    ?>

                        <div class="min-w-full">

                            <div class="relative h-[450px] overflow-hidden rounded-2xl">

                                <a
                                    href="<?= htmlspecialchars($game['steam_url']) ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="block h-full w-full"
                                >

                                    <img
                                        src="./<?= htmlspecialchars($game['image']) ?>"
                                        alt="<?= htmlspecialchars($game['name']) ?>"
                                        class="h-auto w-full object-contain"
                                    >

                                    <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/40 to-transparent"></div>

                                    <div class="absolute bottom-0 left-0 max-w-xl p-8">

                                        <span class="text-sm font-medium text-purple-400">
                                            #<?= str_pad($index, 2, '0', STR_PAD_LEFT) ?> TRENDING
                                        </span>

                                        <h3 class="mt-2 text-4xl font-bold text-white">
                                            <?= htmlspecialchars($game['name']) ?>
                                        </h3>

                                        <p class="mt-3 text-gray-300">
                                            <?= htmlspecialchars($game['genre']) ?>
                                        </p>

                                        <p class="mt-4 text-sm leading-relaxed text-gray-400">
                                            <?= htmlspecialchars($game['description']) ?>
                                        </p>

                                    </div>

                                </a>

                            </div>

                        </div>

                    <?php
                    $index++;
                    endwhile;
                    ?>

                </div>
            </div>

        </div>

<!-- ==========================================
     FREE GAMES
=========================================== -->

<div class="mb-20">

    <!-- Header -->
    <div class="mb-8">

        <p class="mb-2 text-sm font-medium uppercase tracking-widest text-green-400">
            Free to Play
        </p>

        <h2 class="text-3xl font-bold text-white md:text-4xl">
            Free Games
        </h2>

        <p class="mt-3 text-gray-400">
            Great games you can play without spending anything.
        </p>

    </div>


    <!-- Carousel Area -->
    <div class="flex items-center gap-4">

        <!-- Previous -->
        <button
            id="freePrevBtn"
            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full border border-white/10 bg-white/5 text-lg text-white transition hover:border-purple-400 hover:bg-purple-500"
        >
            <
        </button>


        <!-- Cards -->
        <div class="min-w-0 flex-1 overflow-hidden">

            <div
                id="freeCarousel"
                class="flex gap-5 transition-transform duration-500 ease-in-out"
            >

                <?php

                $queryFree = mysqli_query(
                    $conn,
                    "SELECT * FROM games WHERE category = 'free'"
                );

                while ($game = mysqli_fetch_assoc($queryFree)) {

                ?>

                    <!-- Game Card -->
                    <a
                        href="<?= htmlspecialchars($game['steam_url']) ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="group block min-w-[75%] overflow-hidden rounded-xl border border-white/10 bg-white/5 sm:min-w-[45%] lg:min-w-[23.5%]"
                    >

                        <!-- Image -->
                        <div class="relative aspect-[3/4] overflow-hidden">

                            <img
                                src="./<?= htmlspecialchars($game['image']) ?>"
                                alt="<?= htmlspecialchars($game['name']) ?>"
                                class="h-full w-full object-contain transition duration-500 group-hover:scale-105"
                            >

                            <span
                                class="absolute left-3 top-3 rounded-md bg-green-500 px-2.5 py-1 text-xs font-bold text-black"
                            >
                                FREE
                            </span>

                        </div>


                        <!-- Information -->
                        <div class="p-4">

                            <h3 class="text-lg font-bold text-white">
                                <?= htmlspecialchars($game['name']) ?>
                            </h3>

                            <p class="mt-1 text-sm text-gray-400">
                                <?= htmlspecialchars($game['genre']) ?>
                            </p>

                            <div class="mt-4 flex justify-between">

                                <span class="text-sm text-gray-400">
                                    PC
                                </span>

                                <span class="text-sm text-green-400">
                                    ✓ Free
                                </span>

                            </div>

                        </div>

                    </a>

                <?php

                }

                ?>

            </div>

        </div>


        <!-- Next -->
        <button
            id="freeNextBtn"
            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full border border-white/10 bg-white/5 text-lg text-white transition hover:border-purple-400 hover:bg-purple-500"
        >
            >
        </button>

    </div>

</div>


        <!-- ==========================================
             BEFORE YOU DIE
        =========================================== -->

        <div>

            <!-- Header -->
            <div class="mb-8 flex items-end justify-between">

                <div class="max-w-2xl">

                    <p class="mb-2 text-sm font-medium tracking-widest text-purple-400">
                        Sethra Picks
                    </p>

                    <h2 class="text-3xl font-bold text-white md:text-4xl">
                        Games You Should Play
                        <span class="text-purple-400">
                            Before You Die
                        </span>
                    </h2>

                    <p class="mt-4 leading-relaxed text-gray-400">
                        Iconic games, unforgettable stories, and experiences
                        every gamer should try at least once.
                    </p>

                </div>


                <!-- Navigation -->
                <div class="flex shrink-0 gap-2">

                    <button
                        id="mustPrevBtn"
                        class="flex h-10 w-10 items-center justify-center rounded-full border border-white/10 bg-white/5 text-lg text-white transition hover:bg-purple-500">
                        <
                    </button>

                    <button
                        id="mustNextBtn"
                        class="flex h-10 w-10 items-center justify-center rounded-full border border-white/10 bg-white/5 text-lg text-white transition hover:bg-purple-500">
                        >
                    </button>

                </div>

            </div>


            <!-- Before You Die Carousel -->
            <div class="overflow-hidden">

                <div
                    id="mustCarousel"
                    class="flex gap-6 transition-transform duration-500 ease-in-out">

                    <?php

                    $queryMust = mysqli_query(
                        $conn,
                        "SELECT * FROM games WHERE category = 'must_play'"
                    );

                    while ($game = mysqli_fetch_assoc($queryMust)) {

                    ?>

                        <!-- Game Card -->
                        <a
                            href="<?= htmlspecialchars($game['steam_url']) ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="group block min-w-[85%] overflow-hidden rounded-2xl border border-white/10 bg-black sm:min-w-[60%] lg:min-w-[32%]"
                        >

                            <div class="relative h-[420px] overflow-hidden">

                                <img
                                    src="./<?= htmlspecialchars($game['image']) ?>"
                                    alt="<?= htmlspecialchars($game['name']) ?>"
                                    class="h-auto w-full object-contain transition duration-700 group-hover:scale-105"
                                >

                                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>

                                <div class="absolute bottom-0 left-0 p-6">

                                    <h3 class="mt-1 text-2xl font-bold text-white">
                                        <?= htmlspecialchars($game['name']) ?>
                                    </h3>

                                    <p class="mt-2 text-sm text-gray-300">
                                        <?= htmlspecialchars($game['genre']) ?>
                                    </p>

                                    <p class="mt-3 text-sm leading-relaxed text-gray-400">
                                        <?= htmlspecialchars($game['description']) ?>
                                    </p>

                                </div>

                            </div>

                        </a>

                    <?php

                    }

                    ?>

                </div>

            </div>

        </div>

    </div>

</section>



        <!-- =========================
             MY PC SECTION
        ========================== -->

        <section
            id="my-pc"
            class="border-y border-white/10 bg-white/[0.02]">

            <div class="mx-auto max-w-7xl px-6 py-24">

                <div class="grid gap-12 lg:grid-cols-2 lg:items-center">


                    <div>

                        <p class="mb-3 text-sm font-medium uppercase tracking-[0.2em] text-gray-500">
                            PC Compatibility
                        </p>

                        <h2 class="text-4xl font-bold tracking-tight">
                            Know what your PC can handle.
                        </h2>

                        <p class="mt-5 max-w-xl leading-relaxed text-gray-400">

                            Enter your PC specifications and Sethra
                            will help you discover games that match
                            your hardware.

                        </p>

                    </div>


                    <!-- PC CARD -->

<div
    class="rounded-2xl border border-white/10 bg-[#111114] p-6">

    <div class="grid gap-5 sm:grid-cols-2">

        <!-- PROCESSOR -->
        <div>

            <label
                for="cpu"
                class="text-sm text-gray-500">
                Processor
            </label>

            <select
                id="cpu"
                class="mt-2 w-full rounded-lg border border-white/10 bg-[#18181c] px-4 py-3 text-sm text-white outline-none transition focus:border-white/30">

                <option value="">Select CPU</option>

                <optgroup label="Intel">
                    <option>Intel Core i3-10100</option>
                    <option>Intel Core i5-10400</option>
                    <option>Intel Core i5-11400</option>
                    <option>Intel Core i5-12400</option>
                    <option>Intel Core i5-13400</option>
                    <option>Intel Core i7-12700</option>
                    <option>Intel Core i7-13700</option>
                    <option>Intel Core i9-13900</option>
                </optgroup>

                <optgroup label="AMD">
                    <option>Ryzen 3 3100</option>
                    <option>Ryzen 5 3600</option>
                    <option>Ryzen 5 5500</option>
                    <option>Ryzen 5 5600</option>
                    <option>Ryzen 5 7600</option>
                    <option>Ryzen 7 5700X</option>
                    <option>Ryzen 7 7800X3D</option>
                    <option>Ryzen 9 7900X</option>
                </optgroup>

                <optgroup label="Laptop CPU">
                    <option>Ryzen 5 5500U</option>
                    <option>Ryzen 5 5600H</option>
                    <option>Ryzen 7 5700U</option>
                    <option>Ryzen 7 5800H</option>
                    <option>Intel Core i5-1135G7</option>
                    <option>Intel Core i5-1235U</option>
                    <option>Intel Core i7-1165G7</option>
                </optgroup>

            </select>

        </div>


        <!-- GPU -->
        <div>

            <label
                for="gpu"
                class="text-sm text-gray-500">
                Graphics
            </label>

            <select
                id="gpu"
                class="mt-2 w-full rounded-lg border border-white/10 bg-[#18181c] px-4 py-3 text-sm text-white outline-none transition focus:border-white/30">

                <option value="">Select GPU</option>

                <!-- INTEGRATED GPU -->
                <optgroup label="Integrated Graphics">
                    <option>Intel UHD Graphics 630</option>
                    <option>Intel Iris Xe Graphics</option>
                    <option>AMD Radeon Graphics</option>
                    <option>AMD Radeon Vega 7</option>
                    <option>AMD Radeon 680M</option>
                    <option>AMD Radeon 780M</option>
                </optgroup>

                <!-- NVIDIA -->
                <optgroup label="NVIDIA GeForce">
                    <option>GTX 1050 Ti</option>
                    <option>GTX 1650</option>
                    <option>GTX 1660 Super</option>
                    <option>RTX 2060</option>
                    <option>RTX 3060</option>
                    <option>RTX 4060</option>
                    <option>RTX 4070</option>
                    <option>RTX 4080</option>
                    <option>RTX 4090</option>
                </optgroup>

                <!-- AMD -->
                <optgroup label="AMD Radeon">
                    <option>RX 570</option>
                    <option>RX 580</option>
                    <option>RX 6600</option>
                    <option>RX 6700 XT</option>
                    <option>RX 7600</option>
                    <option>RX 7700 XT</option>
                    <option>RX 7800 XT</option>
                    <option>RX 7900 XTX</option>
                </optgroup>

            </select>

        </div>


        <!-- RAM -->
        <div>

            <label
                for="ram"
                class="text-sm text-gray-500">
                RAM
            </label>

            <select
                id="ram"
                class="mt-2 w-full rounded-lg border border-white/10 bg-[#18181c] px-4 py-3 text-sm text-white outline-none transition focus:border-white/30">

                <option>4 GB</option>
                <option selected>8 GB</option>
                <option>12 GB</option>
                <option>16 GB</option>
                <option>24 GB</option>
                <option>32 GB</option>
                <option>64 GB</option>

            </select>

        </div>


        <!-- RESOLUTION -->
        <div>

            <label
                for="resolution"
                class="text-sm text-gray-500">
                Resolution
            </label>

            <select
                id="resolution"
                class="mt-2 w-full rounded-lg border border-white/10 bg-[#18181c] px-4 py-3 text-sm text-white outline-none transition focus:border-white/30">

                <option>720p</option>
                <option selected>1080p</option>
                <option>1440p</option>
                <option>4K</option>

            </select>

        </div>

    </div>


    <!-- BUTTON -->

    <button
        id="checkPcBtn"
        class="mt-6 w-full rounded-lg bg-white py-3 text-sm font-semibold text-black transition hover:bg-gray-200">

        Check My Games

    </button>

            </div>

        </div>

    </div>

</section>

    </main>



    <!-- =========================
         FOOTER
    ========================== -->

    <footer class="bg-[#09090b] py-12 border-t border-white/100">

        <div
            class="mx-auto flex max-w-7xl flex-col gap-3 px-6 py-8 text-sm text-white-300 sm:flex-row sm:items-center sm:justify-between">

            <p>
                © 2026 SETHRA Created by <br> Rafi Ahmad Zaky (2511102441228)
            </p>

            <p>
                Discover. Check. Buy. Play.
            </p>

        </div>

    </footer>

    <!-- JavaScript -->
    <script src="./js/script.js"></script>
</body>

</html>
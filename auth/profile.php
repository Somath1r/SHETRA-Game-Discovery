<?php

session_start();

include "../config/database.php";


// Pastikan user sudah login
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}


// Ambil data user
$user_id = $_SESSION["user_id"];

$query = mysqli_prepare(
    $conn,
    "SELECT id, username, email, role, created_at
     FROM users
     WHERE id = ?"
);

mysqli_stmt_bind_param(
    $query,
    "i",
    $user_id
);

mysqli_stmt_execute($query);

$result = mysqli_stmt_get_result($query);

$user = mysqli_fetch_assoc($result);


// Kalau user tidak ditemukan
if (!$user) {
    session_unset();
    session_destroy();

    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>My Profile - SETHRA</title>

    <link
        href="../css/output.css"
        rel="stylesheet"
    >

</head>


<body class="min-h-screen bg-zinc-950 text-white">


    <!-- HEADER -->

    <header class="border-b border-white/10">

        <nav class="mx-auto flex max-w-6xl items-center justify-between px-6 py-5">

            <!-- LOGO -->

            <a
                href="../index.php"
                class="flex items-center gap-3"
            >

                <img
                    src="../images/Logo web.jpeg"
                    alt="SETHRA Logo"
                    class="h-22 w-22 object-cover"
                >

                <span class="text-xl font-bold tracking-wide">
                    SETHRA
                </span>

            </a>


            <!-- BACK -->

            <a
                    href="../index.php"
                    class="flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium text-gray-400 transition hover:bg-white/5 hover:text-white"
                >
                    
                    <!-- Home Icon -->
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="h-4 w-4"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m2.25 12 8.954-8.954a1.125 1.125 0 0 1 1.592 0L21.75 12M4.5 9.75v9.75a1.5 1.5 0 0 0 1.5 1.5h3.75v-6h4.5v6H18a1.5 1.5 0 0 0 1.5-1.5V9.75"
                        />
                    </svg>

                    <span>Back to Home</span>

            </a>

        </nav>

    </header>


    <!-- MAIN -->

    <main class="mx-auto max-w-4xl px-6 py-12">


        <!-- TITLE -->

        <div class="mb-8">

            <p class="mb-2 text-sm font-medium text-purple-400">
                ACCOUNT
            </p>

            <h1 class="text-3xl font-bold">
                My Profile
            </h1>

            <p class="mt-2 text-gray-400">
                Manage your SETHRA account information.
            </p>

        </div>


        <!-- PROFILE CARD -->

        <div class="overflow-hidden rounded-2xl border border-white/10 bg-zinc-900">


            <!-- PROFILE HEADER -->

            <div class="border-b border-white/10 px-6 py-6">

                <div class="flex items-center gap-4">

                    <!-- AVATAR -->

                    <div
                        class="flex h-16 w-16 items-center justify-center rounded-full bg-purple-600/20 text-2xl font-bold text-purple-400"
                    >
                        <?= strtoupper(substr($user["username"], 0, 1)) ?>
                    </div>


                    <div>

                        <h2 class="text-xl font-semibold">
                            <?= htmlspecialchars($user["username"]) ?>
                        </h2>

                        <p class="text-sm text-gray-400">
                            <?= htmlspecialchars($user["email"]) ?>
                        </p>

                    </div>

                </div>

            </div>


            <!-- ACCOUNT INFORMATION -->

            <div class="px-6 py-6">

                <h3 class="mb-5 text-lg font-semibold">
                    Account Information
                </h3>


                <div class="grid gap-5 sm:grid-cols-2">


                    <!-- USERNAME -->

                    <div>

                        <p class="mb-2 text-sm text-gray-400">
                            Username
                        </p>

                        <div class="rounded-lg border border-white/10 bg-zinc-950 px-4 py-3">
                            <?= htmlspecialchars($user["username"]) ?>
                        </div>

                    </div>


                    <!-- EMAIL -->

                    <div>

                        <p class="mb-2 text-sm text-gray-400">
                            Email
                        </p>

                        <div class="rounded-lg border border-white/10 bg-zinc-950 px-4 py-3">
                            <?= htmlspecialchars($user["email"]) ?>
                        </div>

                    </div>


                    <!-- ROLE -->

                    <div>

                        <p class="mb-2 text-sm text-gray-400">
                            Account Role
                        </p>

                        <div class="rounded-lg border border-white/10 bg-zinc-950 px-4 py-3 capitalize">
                            <?= htmlspecialchars($user["role"]) ?>
                        </div>

                    </div>


                    <!-- CREATED -->

                    <div>

                        <p class="mb-2 text-sm text-gray-400">
                            Member Since
                        </p>

                        <div class="rounded-lg border border-white/10 bg-zinc-950 px-4 py-3">
                            <?= date("d F Y", strtotime($user["created_at"])) ?>
                        </div>

                    </div>

                </div>


                <!-- ACTIONS -->

                <div class="mt-8 flex flex-wrap gap-3">

                    <button
                        type="button"
                        class="rounded-lg bg-purple-600 px-5 py-2.5 text-sm font-semibold transition hover:bg-purple-500"
                    >
                        Edit Profile
                    </button>

                    <a
                        href="logout.php"
                        class="rounded-lg border border-white/10 px-5 py-2.5 text-sm font-medium text-gray-300 transition hover:bg-white/5 hover:text-white"
                    >
                        Log Out
                    </a>

                </div>

            </div>

        </div>

    </main>


</body>

</html>
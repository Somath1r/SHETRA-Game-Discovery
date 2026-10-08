<?php

session_start();

include "../config/database.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // Cek apakah username atau email sudah digunakan
    $check = mysqli_prepare(
        $conn,
        "SELECT id FROM users WHERE username = ? OR email = ?"
    );

    mysqli_stmt_bind_param(
        $check,
        "ss",
        $username,
        $email
    );

    mysqli_stmt_execute($check);

    $result = mysqli_stmt_get_result($check);

    if (mysqli_num_rows($result) > 0) {

        $message = "Username atau email sudah digunakan.";

    } else {

        // Hash password sebelum disimpan
        $hashedPassword = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        // Simpan user baru
        $query = mysqli_prepare(
            $conn,
            "INSERT INTO users (username, email, password)
             VALUES (?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $query,
            "sss",
            $username,
            $email,
            $hashedPassword
        );

        if (mysqli_stmt_execute($query)) {

            $message = "Akun berhasil dibuat! Silakan login.";

        } else {

            $message = "Gagal membuat akun.";
        }
    }
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

    <title>Register - SETHRA</title>

    <link href="/sethra/css/output.css" rel="stylesheet">
    
</head>

<body class="min-h-screen bg-[#08080c] text-white">

    <div class="flex min-h-screen items-center justify-center px-4">

        <div class="w-full max-w-md">

           <div class="mb-8 text-center">

                <img
                    src="../images/Logo web.jpeg"
                    alt="SETHRA Logo"
                    class="mx-auto mb-4 h-28 w-28 object-cover"
                >

                <h1 class="text-4xl font-extra-bold">SETHRA</h1>

                <p class="mt-2 text-gray-400">
                    Create your account
                </p>

            </div>


            <div class="rounded-2xl border border-white/10 bg-white/5 p-8">

                <h2 class="text-2xl font-bold">
                    Create Account
                </h2>

                <p class="mt-2 text-sm text-gray-400">
                    Join SETHRA and discover your next game.
                </p>


                <?php if ($message !== ""): ?>

                    <div class="mt-5 rounded-lg border border-purple-400/20 bg-purple-500/10 p-3 text-sm text-purple-300">
                        <?= htmlspecialchars($message) ?>
                    </div>

                <?php endif; ?>


                <form
                    method="POST"
                    class="mt-6 space-y-5"
                >

                    <!-- Username -->

                    <div>

                        <label
                            for="username"
                            class="mb-2 block text-sm text-gray-300"
                        >
                            Username
                        </label>

                        <input
                            type="text"
                            id="username"
                            name="username"
                            required
                            class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 text-white outline-none transition focus:border-purple-500"
                            placeholder="Enter username"
                        >

                    </div>


                    <!-- Email -->

                    <div>

                        <label
                            for="email"
                            class="mb-2 block text-sm text-gray-300"
                        >
                            Email
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            required
                            class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 text-white outline-none transition focus:border-purple-500"
                            placeholder="Enter email"
                        >

                    </div>


                    <!-- Password -->

                    <div>
                        <label for="password" class="mb-2 block text-sm text-gray-300">
                            Password
                        </label>

                        <div class="relative">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                required
                                class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 pr-12 text-white outline-none transition focus:border-purple-500"
                                placeholder="Enter password"
                            >

                            <button
                                type="button"
                                id="togglePassword"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 transition hover:text-white"
                                aria-label="Show password"
                            >
                                <!-- Eye -->
                                <svg
                                    id="eyeOpen"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                    />
                                </svg>

                                <!-- Eye slash -->
                                <svg
                                    id="eyeClosed"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="hidden h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 3l18 18"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M10.584 10.587a2 2 0 002.829 2.829"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9.88 5.09A9.94 9.94 0 0112 5c4.477 0 8.268 2.943 9.542 7a10.05 10.05 0 01-4.132 5.411M6.228 6.228A10.06 10.06 0 002.458 12C3.732 16.057 7.523 19 12 19a9.94 9.94 0 004.132-.91"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>


                    <!-- Submit -->

                    <button
                        type="submit"
                        class="w-full rounded-lg bg-purple-600 px-4 py-3 font-semibold text-white transition hover:bg-purple-500"
                    >
                        Create Account
                    </button>

                </form>


                <p class="mt-6 text-center text-sm text-gray-400">

                    Already have an account?

                    <a
                        href="login.php"
                        class="text-purple-400 hover:text-purple-300"
                    >
                        Login
                    </a>

                </p>

            </div>

        </div>

    </div>
    
    <script src="../js/script.js" defer></script>
</body>

</html>

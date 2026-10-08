<?php

session_start();

include "../config/database.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $login = trim($_POST["login"]);
    $password = $_POST["password"];

    // Cari user berdasarkan username atau email
    $query = mysqli_prepare(
        $conn,
        "SELECT id, username, email, password, role
         FROM users
         WHERE username = ? OR email = ?"
    );

    mysqli_stmt_bind_param(
        $query,
        "ss",
        $login,
        $login
    );

    mysqli_stmt_execute($query);

    $result = mysqli_stmt_get_result($query);

    if (mysqli_num_rows($result) === 1) {

        $user = mysqli_fetch_assoc($result);

        // Cek password
        if (password_verify($password, $user["password"])) {

            // Simpan data user ke session
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["role"] = $user["role"];

            // Setelah login, kembali ke homepage
            header("Location: ../index.php");
            exit;

        } else {

            $message = "Username/email atau password salah.";
        }

    } else {

        $message = "Username/email atau password salah.";
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

    <title>Login - SETHRA</title>

    <link
        href="/sethra/css/output.css"
        rel="stylesheet"
    >

</head>

<body class="min-h-screen bg-[#08080c] text-white">

    <div class="flex min-h-screen items-center justify-center px-4">

        <div class="w-full max-w-md">

            <!-- Logo & Title -->
            <div class="mb-8 text-center">

                <img
                    src="../images/Logo web.jpeg"
                    alt="SETHRA Logo"
                    class="mx-auto mb-4 h-20 w-20 object-contain"
                >

                <h1 class="text-4xl font-bold">
                    SETHRA
                </h1>

                <p class="mt-2 text-gray-400">
                    Welcome back
                </p>

            </div>


            <!-- Login Card -->
            <div class="rounded-2xl border border-white/10 bg-white/5 p-8">

                <h2 class="text-2xl font-bold">
                    Login
                </h2>

                <p class="mt-2 text-sm text-gray-400">
                    Sign in to continue to SETHRA.
                </p>


                <!-- Message -->
                <?php if ($message !== ""): ?>

                    <div
                        class="mt-5 rounded-lg border border-red-400/20 bg-red-500/10 p-3 text-sm text-red-300"
                    >
                        <?= htmlspecialchars($message) ?>
                    </div>

                <?php endif; ?>


                <!-- Form -->
                <form
                    method="POST"
                    class="mt-6 space-y-5"
                >

                    <!-- Username / Email -->
                    <div>

                        <label
                            for="login"
                            class="mb-2 block text-sm text-gray-300"
                        >
                            Username or Email
                        </label>

                        <input
                            type="text"
                            id="login"
                            name="login"
                            required
                            autocomplete="username"
                            class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 text-white outline-none transition focus:border-purple-500"
                            placeholder="Enter username or email"
                        >

                    </div>


                    <!-- Password -->
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
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white"
                            aria-label="Show password"
                        >
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


                    <!-- Button -->
                    <button
                        type="submit"
                        class="w-full rounded-lg bg-purple-600 px-4 py-3 font-semibold text-white transition hover:bg-purple-500"
                    >
                        Login
                    </button>

                </form>


                <!-- Register -->
                <p class="mt-6 text-center text-sm text-gray-400">

                    Don't have an account?

                    <a
                        href="register.php"
                        class="text-purple-400 transition hover:text-purple-300"
                    >
                        Create Account
                    </a>

                </p>

            </div>

        </div>

    </div>

    <script>
        const passwordInput = document.getElementById("password");
        const togglePasswordButton = document.getElementById("togglePassword");
        const eyeOpenIcon = document.getElementById("eyeOpen");
        const eyeClosedIcon = document.getElementById("eyeClosed");

        togglePasswordButton.addEventListener("click", function () {

            if (passwordInput.type === "password") {

                passwordInput.type = "text";

                eyeOpenIcon.classList.add("hidden");
                eyeClosedIcon.classList.remove("hidden");

                togglePasswordButton.setAttribute(
                    "aria-label",
                    "Hide password"
                );

            } else {

                passwordInput.type = "password";

                eyeOpenIcon.classList.remove("hidden");
                eyeClosedIcon.classList.add("hidden");

                togglePasswordButton.setAttribute(
                    "aria-label",
                    "Show password"
                );

            }

        });
    </script>
</body>

</html>
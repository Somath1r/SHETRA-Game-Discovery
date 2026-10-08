// ==========================================
// SHOW / HIDE PASSWORD
// ==========================================

const password = document.getElementById("password");
const togglePassword = document.getElementById("togglePassword");
const eyeOpen = document.getElementById("eyeOpen");
const eyeClosed = document.getElementById("eyeClosed");

if (password && togglePassword) {

    togglePassword.addEventListener("click", function () {

        if (password.type === "password") {

            password.type = "text";

            if (eyeOpen) {
                eyeOpen.classList.add("hidden");
            }

            if (eyeClosed) {
                eyeClosed.classList.remove("hidden");
            }

            togglePassword.setAttribute(
                "aria-label",
                "Hide password"
            );

        } else {

            password.type = "password";

            if (eyeOpen) {
                eyeOpen.classList.remove("hidden");
            }

            if (eyeClosed) {
                eyeClosed.classList.add("hidden");
            }

            togglePassword.setAttribute(
                "aria-label",
                "Show password"
            );

        }

    });

}


// ==========================================
// USER MENU
// ==========================================

const userMenuButton = document.getElementById("userMenuButton");
const userMenu = document.getElementById("userMenu");

if (userMenuButton && userMenu) {

    userMenuButton.addEventListener("click", function (event) {

        event.stopPropagation();

        userMenu.classList.toggle("hidden");

    });


    document.addEventListener("click", function (event) {

        if (
            !userMenuButton.contains(event.target) &&
            !userMenu.contains(event.target)
        ) {
            userMenu.classList.add("hidden");
        }

    });

}


// ==========================================
// TRENDING GAMES
// ==========================================

const trendingCarousel =
    document.getElementById("trendingCarousel");

const trendingNextBtn =
    document.getElementById("trendingNextBtn");

const trendingPrevBtn =
    document.getElementById("trendingPrevBtn");


if (
    trendingCarousel &&
    trendingNextBtn &&
    trendingPrevBtn
) {

    let trendingSlide = 0;

    const trendingTotal =
        trendingCarousel.children.length;


    trendingNextBtn.addEventListener("click", function () {

        trendingSlide++;

        if (trendingSlide >= trendingTotal) {
            trendingSlide = 0;
        }

        trendingCarousel.style.transform =
            `translateX(-${trendingSlide * 100}%)`;

    });


    trendingPrevBtn.addEventListener("click", function () {

        trendingSlide--;

        if (trendingSlide < 0) {
            trendingSlide = trendingTotal - 1;
        }

        trendingCarousel.style.transform =
            `translateX(-${trendingSlide * 100}%)`;

    });

}


// ==========================================
// FREE GAMES
// ==========================================

const freeCarousel =
    document.getElementById("freeCarousel");

const freeNextBtn =
    document.getElementById("freeNextBtn");

const freePrevBtn =
    document.getElementById("freePrevBtn");


if (
    freeCarousel &&
    freeNextBtn &&
    freePrevBtn
) {

    let freeSlide = 0;


    function getFreeVisible() {

        if (window.innerWidth >= 1024) {
            return 4;
        }

        if (window.innerWidth >= 640) {
            return 2;
        }

        return 1;

    }


    function getFreeMaxSlide() {

        const total =
            freeCarousel.children.length;

        const visible =
            getFreeVisible();

        return Math.max(
            0,
            total - visible
        );

    }


    freeNextBtn.addEventListener("click", function () {

        const maxSlide =
            getFreeMaxSlide();

        freeSlide++;

        if (freeSlide > maxSlide) {
            freeSlide = 0;
        }

        freeCarousel.style.transform =
            `translateX(-${freeSlide * (100 / getFreeVisible())}%)`;

    });


    freePrevBtn.addEventListener("click", function () {

        const maxSlide =
            getFreeMaxSlide();

        freeSlide--;

        if (freeSlide < 0) {
            freeSlide = maxSlide;
        }

        freeCarousel.style.transform =
            `translateX(-${freeSlide * (100 / getFreeVisible())}%)`;

    });


    window.addEventListener("resize", function () {

        freeSlide = 0;

        freeCarousel.style.transform =
            "translateX(0)";

    });

}


// ==========================================
// GAMES YOU SHOULD PLAY BEFORE YOU DIE
// ==========================================

const mustCarousel =
    document.getElementById("mustCarousel");

const mustNextBtn =
    document.getElementById("mustNextBtn");

const mustPrevBtn =
    document.getElementById("mustPrevBtn");


if (
    mustCarousel &&
    mustNextBtn &&
    mustPrevBtn
) {

    let mustSlide = 0;


    function getMustVisible() {

        if (window.innerWidth >= 1024) {
            return 3;
        }

        if (window.innerWidth >= 640) {
            return 2;
        }

        return 1;

    }


    function getMustMaxSlide() {

        const total =
            mustCarousel.children.length;

        const visible =
            getMustVisible();

        return Math.max(
            0,
            total - visible
        );

    }


    mustNextBtn.addEventListener("click", function () {

        const visible =
            getMustVisible();

        const maxSlide =
            getMustMaxSlide();

        mustSlide++;

        if (mustSlide > maxSlide) {
            mustSlide = 0;
        }

        mustCarousel.style.transform =
            `translateX(-${mustSlide * (100 / visible)}%)`;

    });


    mustPrevBtn.addEventListener("click", function () {

        const visible =
            getMustVisible();

        const maxSlide =
            getMustMaxSlide();

        mustSlide--;

        if (mustSlide < 0) {
            mustSlide = maxSlide;
        }

        mustCarousel.style.transform =
            `translateX(-${mustSlide * (100 / visible)}%)`;

    });


    window.addEventListener("resize", function () {

        mustSlide = 0;

        mustCarousel.style.transform =
            "translateX(0)";

    });

}
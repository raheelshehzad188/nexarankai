<script>
document.addEventListener("DOMContentLoaded", function(){
    const menu = document.getElementById("navMenu");
    const toggle = document.getElementById("menuToggle");
    const overlay = document.getElementById("menuOverlay");

    if (!menu || !toggle || !overlay) return;

    toggle.addEventListener("click", function(){
        menu.classList.toggle("active");
        overlay.classList.toggle("active");
        toggle.innerHTML = menu.classList.contains("active") ? "✕" : "☰";
    });

    overlay.addEventListener("click", function(){
        menu.classList.remove("active");
        overlay.classList.remove("active");
        toggle.innerHTML = "☰";
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const header = document.querySelector(".header");
    if (!header) return;

    window.addEventListener("scroll", function () {
        if (window.scrollY > 5) {
            header.classList.add("scrolled");
        } else {
            header.classList.remove("scrolled");
        }
    });
});
</script>

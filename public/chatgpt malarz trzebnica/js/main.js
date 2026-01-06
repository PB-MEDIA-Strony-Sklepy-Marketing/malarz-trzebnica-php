document.addEventListener("scroll", () => {
    document.querySelectorAll(".animate-fade").forEach(el => {
        el.style.opacity = 1;
    });
});
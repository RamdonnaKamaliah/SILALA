function setTheme(color) {
    document.body.classList.remove(
        "theme-green",
        "theme-blue",
        "theme-orange",
        "theme-purple",
        "theme-yellow"
    );

    document.body.classList.add(`theme-${color}`);

    console.log("Theme changed to:", color);
}











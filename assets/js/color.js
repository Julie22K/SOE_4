let theme_color; 
// function theme(color, border, front, back, btn) {
//     if (color == "#F5F5F5")
//         document.documentElement.style.setProperty("--text", "#000000");
//     else document.documentElement.style.setProperty("--text", "white");
//     document.documentElement.style.setProperty("--main", color);
//     var color2 = back + "50"; document.documentElement.style.setProperty("--main2", color2);
//     document.documentElement.style.setProperty("--main3", border);
//     document.documentElement.style.setProperty("--front", front);
//     document.documentElement.style.setProperty("--back", back + "4f");
//     document.documentElement.style.setProperty("--btn", btn);
//     var pallete = [color, border, front, back, btn];
//     savetheme(pallete);
// }
function savetheme(theme_color) {
    window.localStorage.setItem("theme", theme_color);
}
function readtheme() {
    return window.localStorage.getItem("theme");
}
$(document).ready(function () {
    if (localStorage.getItem("theme") !== null) {
        theme_color = readtheme();
        theme(theme_color);
    }
    else {
        theme('green')
    }
    let list = document.querySelectorAll(".color"); 

    function activeLink() { list.forEach((item) => item.classList.remove("active")); 
        this.classList.add("active"); }
    list.forEach((item) => item.addEventListener("click", activeLink));
});
function theme(themeName) {
    console.log(themeName);
    document.getElementById('theme-link').setAttribute('href', '../../assets/CSS/themes/' +
        themeName + '.css');
        savetheme(themeName);
}
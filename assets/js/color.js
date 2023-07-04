let pallete;function theme(color,border,front,back,btn){if(color=="#F5F5F5")
document.documentElement.style.setProperty("--text","#000000");else document.documentElement.style.setProperty("--text","white");document.documentElement.style.setProperty("--main",color);var color2=back+"50";document.documentElement.style.setProperty("--main2",color2);document.documentElement.style.setProperty("--main3",border);document.documentElement.style.setProperty("--front",front);document.documentElement.style.setProperty("--back",back+"4f");document.documentElement.style.setProperty("--btn",btn);var pallete=[color,border,front,back,btn];savetheme(pallete);}
function savetheme(pallete){const pallet=JSON.stringify(pallete);window.localStorage.setItem("theme",pallet);}
function readtheme(){return JSON.parse(window.localStorage.getItem("theme"));}
$(document).ready(function(){if(localStorage.getItem("theme")!==null){pallete=readtheme();theme(pallete[0],pallete[1],pallete[2],pallete[3],pallete[4]);}
else{theme("#003d08","#527445","#C2D4B3","#E5D3C9","#003d08");}
let list=document.querySelectorAll(".color");function activeLink(){list.forEach((item)=>item.classList.remove("active"));this.classList.add("active");}
list.forEach((item)=>item.addEventListener("click",activeLink));});
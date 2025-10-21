const   dropdaownn= document.getElementById("dropdaownn"),
close1 = document.querySelector(".close1"),
close2 = document.querySelector(".close2"),
dropdownnavv=document.getElementById("dropdownnavv"),
openWeelLucky= document.getElementById("openWeelLucky"),
momo5 = document.getElementById("momo5"),
closewheel = document.getElementById("closewheel");

dropdaownn.onclick = function(){
dropdownnavv.classList.toggle("hidden");
};
close1.onclick = function(){
dropdownnavv.classList.add("hidden");
};
close2.onclick = function(){
dropdownnavv.classList.add("hidden");
};

openWeelLucky.onclick = function(){
    momo5.classList.remove("hidden");
};

closewheel.onclick = function(){
    momo5.classList.toggle("hidden");
};

let wheel = document.querySelector(".wheel");
let spin = document.getElementById("Start-Spin");
let numberWheel = Math.ceil(Math.random() * 5000);

spin.onclick = function () {
wheel.style.transform = "rotate(" + numberWheel + "deg)";
numberWheel += Math.ceil(Math.random() * 1000);
};
const opentablelinke = document.getElementById("opentablelinke"),
    apearworldtable = document.getElementById("apearworldtable"),
    deletelink = document.getElementById("deletelink"),
    deletbodytable = document.getElementById("deletbodytable"),
    closeworld = document.getElementById("closeworld");
    
opentablelinke.onclick = function(){
    apearworldtable.classList.toggle("hidden");
};
closeworld.onclick = function(){
    apearworldtable.classList.add("hidden");
};
deletelink.onclick = function(){
    deletbodytable.classList.toggle("hidden");
};

const hiddenChangePawword = document.getElementById("hiddenChangePawword"),
    openChangePassword = document.getElementById("openChangePassword"),
    closeChangePassword = document.getElementById("closeChangePassword"),
    hiddenChangeEmail = document.getElementById("hiddenChangeEmail"),
    closeChangeEmail = document.getElementById("closeChangeEmail"),   
    openChangeEmail = document.getElementById("openChangeEmail");
    
openChangePassword.onclick = function(){
    hiddenChangePawword.classList.remove("hidden");
};
closeChangePassword.onclick = function(){
    hiddenChangePawword.classList.add("hidden");
};
openChangeEmail.onclick = function(){
    hiddenChangeEmail.classList.remove("hidden");
};
closeChangeEmail.onclick = function(){
    hiddenChangeEmail.classList.add("hidden");
};

        

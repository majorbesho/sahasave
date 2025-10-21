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
const ReferralBonus = document.getElementById("ReferralBonus"),
    PersonalBonus = document.getElementById("PersonalBonus"),
    contenthidden = document.getElementById("contenthidden"),
    openTopPersonal = document.getElementById("openTopPersonal"),
    back = document.getElementById("back"),
    back2 = document.getElementById("back2"),
    openTopReferral = document.getElementById("openTopReferral");

openTopPersonal.onclick = function(){
    contenthidden.classList.add("hidden"),
    ReferralBonus.classList.add("hidden"),
    PersonalBonus.classList.remove("hidden");
};
openTopReferral.onclick = function(){
    contenthidden.classList.add("hidden"),
    ReferralBonus.classList.remove("hidden"),
    PersonalBonus.classList.add("hidden");
}
back.onclick = function(){
    contenthidden.classList.remove("hidden"),
    ReferralBonus.classList.add("hidden"),
    PersonalBonus.classList.add("hidden");
}
back2.onclick = function(){
    contenthidden.classList.remove("hidden"),
    ReferralBonus.classList.add("hidden"),
    PersonalBonus.classList.add("hidden");
}



const closelogin=document.getElementById("closelogin"),
      closeRegister=document.getElementById("closeRegister"),
      closeForgetPassword=document.getElementById("closeForgetPassword"),
      hiddenlogin=document.getElementById("hiddenlogin"),
      openlogin=document.getElementById("openlogin"),
      openlogin2=document.getElementById("openlogin2"),
      openlogin3=document.getElementById("openlogin3"),
      openlogin4=document.getElementById("openlogin4"),
      openRegister=document.getElementById("openRegister"),
      openRegister2=document.getElementById("openRegister2"),
      openRegister3=document.getElementById("openRegister3"),
      openRegister4=document.getElementById("openRegister4"),
      openFrogetPassword=document.getElementById("openFrogetPassword"),  
      openFrogetPassword2=document.getElementById("openFrogetPassword2"),    
      hiddenRegister=document.getElementById("hiddenRegister"),
      hiddenForgetPassword=document.getElementById("hiddenForgetPassword");




openlogin.onclick = function(){
    hiddenlogin.classList.toggle("hidden");
};
openlogin2.onclick = function(){
    hiddenlogin.classList.toggle("hidden");
};
openlogin3.onclick = function(){
    hiddenRegister.classList.add("hidden"),
    hiddenlogin.classList.remove("hidden");
};
openlogin4.onclick = function(){
    hiddenRegister.classList.add("hidden"),
    hiddenlogin.classList.remove("hidden"),
    hiddenForgetPassword.classList.add("hidden");
};
openRegister.onclick = function(){
    hiddenRegister.classList.toggle("hidden");
};
openRegister2.onclick = function(){
    hiddenRegister.classList.toggle("hidden");
};
openRegister3.onclick = function(){
    hiddenRegister.classList.remove("hidden"),
    hiddenlogin.classList.add("hidden");
};
openRegister4.onclick = function(){
    hiddenRegister.classList.remove("hidden"),
    hiddenlogin.classList.add("hidden"),
    hiddenForgetPassword.classList.add("hidden");
};
openFrogetPassword.onclick = function(){
    hiddenForgetPassword.classList.toggle("hidden")
};
openFrogetPassword2.onclick = function(){
    hiddenForgetPassword.classList.toggle("hidden")
};
closelogin.onclick = function(){
    hiddenlogin.classList.add("hidden")
};
closeRegister.onclick = function(){
    hiddenRegister.classList.add("hidden")
};
closeForgetPassword.onclick = function(){
    hiddenForgetPassword.classList.add("hidden")
};


function fetchResponse(response) {
   if (!response.ok) return null;
   return response.json();
}

//verifica username
function json_checkUser(json){
   if(json.exists==true){
      document.querySelector('#errore_user').textContent="Username già in uso";
   }
   else{
      document.querySelector('#errore_user').textContent="";
      check[0]=true;
   }
}
function checkUser(event){
   check[0]=false;
   const input = document.querySelector('#user');
   fetch("check_username?q="+encodeURIComponent(input.value)).then(fetchResponse).then(json_checkUser);
}
//______________________________________________



//verifica email
function json_checkEmail(json) {
   if(json.exists==true)
      document.querySelector('#errore_mail').textContent="Mail già in uso";
   else{
      document.querySelector('#errore_mail').textContent="";
      check[1]=true;
   }
}

function checkMail(event) {
   check[1]=false;
   const emailInput = document.querySelector('#mail');
   if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(emailInput.value).toLowerCase())) {
       document.querySelector('#errore_mail').textContent = "Email non valida";
   }
   else {
       fetch("check_email?q="+encodeURIComponent(String(emailInput.value).toLowerCase())).then(fetchResponse).then(json_checkEmail);
       document.querySelector('#errore_mail').textContent = "";
   }
}
//______________________________________________


//verifica pwd
function checkPwd(event){
   check[2]=false;
   const pwd = document.querySelector('#pwd').value;
   console.log(pwd);
   const c_speciali = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
   if (!c_speciali.test(pwd)){
      document.querySelector('#errore_pwd').textContent="La password deve contenere almeno un carattere speciale";
   }
   else{
      if (pwd.length <= 8) {
         document.querySelector('#errore_pwd').textContent="La password è troppo corta";
   } else {
         document.querySelector('#errore_pwd').textContent="";
         check[2]=true;
   }
   }
}

function checkPwdV(event){
   check[3]=false;
   const pwd = document.querySelector('#pwd').value;
   const pwd_v = document.querySelector('#pwd_v').value;
   if(pwd===pwd_v){
      document.querySelector('#errore_pwd_v').textContent="";
      check[3]=true;
   }
   else
      document.querySelector('#errore_pwd_v').textContent="Le password non corrispondono";
}
//______________________________________________

function json_log(json){
   console.log(json);
   if(json)
      window.location.replace("benvenuto");
   else{
      alert("registriazione fallita");
      window.location.reload();
   }
}

function controllo(event){
   event.preventDefault();
   const token = document.head.querySelector('meta[name="csrf-token"]').content;
   //----------------
   if(check[0] && check[1] && check[2] && check[3]){
      const form_data={method: "post", body: new FormData(event.currentTarget) , headers: {'X-CSRF-TOKEN': token}}
      fetch("log", form_data).then(fetchResponse).then(json_log);//window.location.replace("benvenuto")
   }
}



let check=new Array(false, false, false, false);
//----MAIN
document.querySelector('#user').addEventListener('blur', checkUser);
document.querySelector('#mail').addEventListener('blur', checkMail);
document.querySelector('#pwd').addEventListener('blur', checkPwd);
document.querySelector('#pwd_v').addEventListener('blur', checkPwdV);

const form = document.querySelector('form');
form.addEventListener('submit', controllo);

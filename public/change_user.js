function fetchResponse(response) {
    if (!response.ok) return null;
    return response.json();
 }
 

//verifica username
function json_checkUser(json){
    check=false;
    if(json.exists==true){
       document.querySelector('#errore_user').textContent="Username già in uso";
    }
    else{
       document.querySelector('#errore_user').textContent="";
       check=true;
    }
 }
 function checkUser(event){
    const input = document.querySelector('#user');
    fetch("check_username?q="+encodeURIComponent(input.value)).then(fetchResponse).then(json_checkUser);
    console.log("check_username?q="+encodeURIComponent(input.value));
 }

 function onJSON(json){
    if(json[0]){
        alert('user modificato');
        window.location = 'logout';
    }
    else{
        alert('user non modificato, controllare la correttezza di tutti i campi');
    }
 }

 //______________________________________________

 function controllo(event){
    event.preventDefault();
    const u=document.querySelector('#user').value;
    const p=document.querySelector('#pwd').value;
    
    if(u==="" || typeof u === 'undefined'){
        document.querySelector('#errore_user').textContent="Inserire il nuovo nome";
    }
    else{
        if(typeof p === 'undefined' || p===""  ){
            document.querySelector('#errore_pwd').textContent="Inserire la password";
        }
        else{
            const form_i = document.querySelector('form');
            const form_data={method: "post", body: new FormData(form_i) }
            fetch("change_user", form_data).then(fetchResponse).then(onJSON);
        }
    }
 }

document.querySelector('#user').addEventListener('blur', checkUser);
const form = document.querySelector('form');
form.addEventListener('submit', controllo); 
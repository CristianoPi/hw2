function fetchResponse(response) {
    if (!response.ok) return null;
    return response.json();
 }
 function checkPwd(event){
    check[0]=false;
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
          check[0]=true;
    }
    }
 }
 
 function checkPwdV(event){
    check[1]=false;
    const pwd = document.querySelector('#pwd').value;
    const pwd_v = document.querySelector('#pwd_v').value;
    if(pwd===pwd_v){
       document.querySelector('#errore_pwd_v').textContent="";
       check[1]=true;
    }
    else
       document.querySelector('#errore_pwd_v').textContent="Le password non corrispondono";
 }

 function onJSON(json){
    if(json[0]){
        alert('password modificata');
        window.location = 'logout';
    }
    else{
        alert('password non modificata, controllare la correttezza di tutti i campi');
    }
 }

 
 function controllo(event){
    
    event.preventDefault();

    if(!check[0] || !check[1]){
        alert("DEVI RISPETTARE LE RICHIESTE")  
        return;
    }
        const o=document.querySelector('#pwd_old').value;
        const p=document.querySelector('#pwd').value;
        const p_v=document.querySelector('#pwd_v').value;
        
        if(o==="" || typeof o === 'undefined'){
            document.querySelector('#errore_pwd_old').textContent="Inserire la vecchia password";
        }
        else{
            if(typeof p === 'undefined' || p===""  ){
                document.querySelector('#errore_pwd').textContent="Inserire la nuova password";
            }
            else{
                if(typeof p_v === 'undefined' || p_v===""  ){
                    document.querySelector('#errore_pwd_v').textContent="Confermare la nuova password";
                }
                else{
                    const token = document.head.querySelector('meta[name="csrf-token"]').content;
                    const form_data={method: "post", body: new FormData(event.currentTarget),headers: {'X-CSRF-TOKEN': token} }
                    fetch("change_password", form_data).then(fetchResponse).then(onJSON);
                }
            }
        }
}

 
 let check=new Array(false, false)
 document.querySelector('#pwd').addEventListener('blur', checkPwd);
 document.querySelector('#pwd_v').addEventListener('blur', checkPwdV);
 const form = document.querySelector('form');
 form.addEventListener('submit', controllo); 
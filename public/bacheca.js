 function onResponse(response){
    return response.json();
}
function onjson_best(json){
    document.querySelector("#i2").style.backgroundImage = "url(foto_utenti/"+json['foto']+")";
    document.querySelector("#i2 .t2").textContent="Foto di:"+json['utente']['user'];
}

function onJSON(json){
    for(foto of json){
        console.log(foto);
        const photoSrc = "./foto_utenti/"+foto.foto;
        const image = createImage(photoSrc);
        image.addEventListener('click', onThumbnailClick);

        const info=document.createElement("div");
        info.classList.add("info");
        
        const user=document.createElement("span");
        const luogo=document.createElement("span");
        const macchina=document.createElement("span");
        const obiettivo=document.createElement("span");
        const F=document.createElement("span");
        const iso=document.createElement("span");
        const esposizione=document.createElement("span");

        user.textContent="FOTO DI: "+foto.utente.user;
        user.classList.add("info_user");
        luogo.textContent="LUOGO: "+foto.luogo;
        macchina.textContent="FOTOCAMERA: "+foto.Macchina;
        obiettivo.textContent="OBIETTIVO: "+foto.Obiettivo;
        F.textContent="F: "+foto.F;
        iso.textContent="iso: "+foto.iso;
        esposizione.textContent="T: "+foto.esposizione;

        info.appendChild(user);
        
        info.appendChild(luogo);

        info.appendChild(macchina);

        info.appendChild(obiettivo);
     
        info.appendChild(F);
     
        info.appendChild(iso);
      
        info.appendChild(esposizione);

        const tasti=document.createElement("div");
        tasti.classList.add("tasti");

        const desc=document.createElement("button");
        desc.textContent="DESCRIZIONE";
        desc.value=foto.descrizione;
        desc.addEventListener('click', on_b_desc);
        tasti.appendChild(desc);

        const comment= document.createElement("button");
        comment.textContent="COMMENTI";
        comment.value=foto.ID;
        comment.addEventListener('click', on_b_comment);
        tasti.appendChild(comment);
        
        const like_div=document.createElement("div");//per num di like
        like_div.classList.add("like_div");
        const num=document.createElement("span");

        const like= document.createElement("img");
        like.id=foto.ID;

        if(foto_liked.includes(foto.ID)){
            //unlike
            like.src="img/like.png";
            like.addEventListener('click', on_like);
            if(num_like[foto.ID])
                num.textContent=num_like[foto.ID];
            
        }
        else
        {
            //like
            like.src="img/no-like.png";
            like.addEventListener('click', on_unlike);
            if(num_like[foto.ID])
                num.textContent=num_like[foto.ID];
            else
                num.textContent="0";
              
        }
        like_div.appendChild(like);
        like_div.appendChild(num);
        tasti.appendChild(like_div);
      
      

        const div= document.createElement("div");
        div.classList.add("element");
        div.appendChild(image);
        div.appendChild(info);
        div.appendChild(tasti);
        bacheca.appendChild(div);
    }
}

function onjson_like(json){
    let i=0;
    for(like of json) {
        foto_liked[i]=like;
        i++;
    }

}
function onjson_num_like(json){
    for(num of json) {
        num_like[num.id_foto]=num.num;
    }
}

///MAIN
let num_like=new Array;
fetch("num_like").then(onResponse).then(onjson_num_like);

fetch("best_foto").then(onResponse).then(onjson_best);

//foto a cui ha messo like l'utente dell'attuale sessione
let foto_liked= new Array;
fetch("foto_liked").then(onResponse).then(onjson_like);

const bacheca=document.querySelector('#bacheca');
fetch("foto_all").then(onResponse).then(onJSON);



//modale
const modalView = document.querySelector('#modal-view');
modalView.addEventListener('click', onModalClick);

function onThumbnailClick(event) {
    const image = createImage(event.currentTarget.src);
    document.body.classList.add('no-scroll');
    modalView.style.top = window.pageYOffset + 'px';
    modalView.appendChild(image);
    modalView.classList.remove('hidden');
}
  
function onModalClick() {
    document.body.classList.remove('no-scroll');
    modalView.classList.add('hidden');
    modalView.innerHTML = '';
}

function createImage(src) {
    const image = document.createElement('img');
    image.src = src;
    return image;
}

//modale commento
function json_comment(json){
    const div=document.querySelector("#modal-comment .view-comment");
    div.innerHTML="";
    for(commento of json){
        const comment=document.createElement("div");

        const user=document.createElement("span");
        user.textContent=commento.utente.user+": ";
        user.classList.add('comment_user');

        const text=document.createElement("span");
        text.textContent=commento.descrizione;
        text.classList.add('comment_text');

        comment.appendChild(user);
        comment.appendChild(text);

        div.appendChild(comment);
    }

}

function on_b_comment(event){
    document.body.classList.add('no-scroll');
    document.getElementById("modal-comment").classList.add('modal');
    fetch("comment?q="+encodeURIComponent(event.currentTarget.value)).then(onResponse).then(json_comment);
    document.querySelector("#comment").value="";
    document.querySelector("#fotoID").value=event.currentTarget.value;
}

document.getElementById("close_c").addEventListener("click",close_modal_c);
function close_modal_c(){
    document.body.classList.remove('no-scroll');
    document.getElementById("modal-comment").classList.remove('modal');
    document.getElementById("modal-comment").classList.add('hiden');
}

//modale desc
function on_b_desc(event){
    document.body.classList.add('no-scroll');
    document.getElementById("modal-desc").classList.add('modal');
    document.querySelector("#modal-desc .modal-desc-content p").textContent=event.currentTarget.value;

}
document.getElementById("close_d").addEventListener("click", function() {
    document.body.classList.remove('no-scroll');
    document.getElementById("modal-desc").classList.remove('modal');
    document.getElementById("modal-desc").classList.add('hiden');
});

//________________
const form=document.querySelector("#modal-comment form");
form.addEventListener('submit', insert_comment);


function insert_comment(event){
    event.preventDefault();
    if(document.querySelector("#comment").value!==""){
        const foto_id=event.currentTarget.querySelector('#fotoID').value;
        const token = document.head.querySelector('meta[name="csrf-token"]').content;
        const form_data={method: "post", body: new FormData(event.currentTarget), headers: {'X-CSRF-TOKEN': token}}
        fetch("insert_comment", form_data).then(fetch("comment?q="+encodeURIComponent(foto_id)).then(onResponse).then(json_comment)).then(event.currentTarget.querySelector("#comment").value="");
    }
}

//like
function on_like(event){
    const url="unlike?q="+event.currentTarget.id;
    fetch(url).then(console.log('like tolto'));
    const parentElement = event.currentTarget.parentNode;
    const num=parentElement.querySelector("span");
    num.textContent--;
    event.currentTarget.src="img/no-like.png";
    event.currentTarget.removeEventListener('click', on_like);
    event.currentTarget.addEventListener('click', on_unlike);
    
}
function on_unlike(event){
    const url="like?q="+event.currentTarget.id;
    fetch(url).then(console.log('like messo'));
    const parentElement = event.currentTarget.parentNode;
    const num=parentElement.querySelector("span");
    num.textContent++;
    event.currentTarget.src="img/like.png";
    event.currentTarget.removeEventListener('click', on_unlike);
    event.currentTarget.addEventListener('click', on_like);
}


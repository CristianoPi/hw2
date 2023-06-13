function onResponse(response){
    return response.json();
}
function createImage(src) {
    const image = document.createElement('img');
    image.src = src;
    return image;
}
function onJSON(json){
    albumView.innerHTML="";
        if(json.total==0){
            const h1=document.createElement("h1");
            h1.textContent="Nessun risultato!"; 
            h1.classList.add("errore");
            albumView.appendChild(h1);
            return;
        }
        const results = json.hits;
        for(foto of results)
        {
            const img_url = foto.webformatURL;
            const image = createImage(img_url);
            image.addEventListener('click', onThumbnailClick);
            const div= document.createElement("div");
            div.classList.add("element");
            div.appendChild(image);
            albumView.appendChild(div);

        }
}
function cerca_foto(event){
    const token = document.head.querySelector('meta[name="csrf-token"]').content
    event.preventDefault();
    const form_data={method: "post", body: new FormData(event.currentTarget), headers: {'X-CSRF-TOKEN': token}}
    fetch("/search", form_data).then(onResponse).then(onJSON);
}
//modale
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
const modalView = document.querySelector('#modal-view');
modalView.addEventListener('click', onModalClick);

//______________

const albumView = document.querySelector('#album-view');
const form = document.querySelector('form');
form.addEventListener('submit', cerca_foto);
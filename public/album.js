function createImage(src) {
    const image = document.createElement('img');
    image.src = src;
    return image;
  }
  
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
function delete_foto(event){
  const str="delete_foto?id="+encodeURIComponent(event.currentTarget.id);
  console.log(str);
  fetch(str).then(window.location.replace("album"));
}

function onJSON(json){
    for(foto of json){
        const photoSrc = "./foto_utenti/"+foto.foto;
        const image = createImage(photoSrc);
        image.addEventListener('click', onThumbnailClick);
        const b= document.createElement("button");
        b.textContent="ELIMINA";
        const id=document.createAttribute("id");
        id.value = foto.ID;
        b.setAttributeNode(id);
        b.addEventListener('click', delete_foto);
        const div= document.createElement("div");
        div.classList.add("element");
        div.appendChild(image);
        div.appendChild(b);
        albumView.appendChild(div);
    }
 }

  function onResponse(response){
    return response.json()  ;
 }
  
  // Main
  const albumView = document.querySelector('#album-view');
  fetch("foto").then(onResponse).then(onJSON);
  
  const modalView = document.querySelector('#modal-view');
  modalView.addEventListener('click', onModalClick);


  
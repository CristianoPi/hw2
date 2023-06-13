
function onResponse(response){
    return response.json();
}
function onJSON(json){
    const albumDiv = document.getElementById("some_foto");
    let index=0;
    for (foto of json){
        const img = new Image();
        img.src = "foto_utenti/"+foto.foto;
        img.classList.add("photo");
        img.style.zIndex = index;
        img.onload = () => {
          img.style.opacity = 1;
        };

        albumDiv.appendChild(img);
    }
    albumDiv.appendChild(albumDiv.firstChild.cloneNode(true));
}
fetch("foto_all_nolog").then(onResponse).then(onJSON)
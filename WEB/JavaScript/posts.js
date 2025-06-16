function carregarPosts() {
  let web = new XMLHttpRequest();
  web.open("POST", "../php/carregarPosts.php");
  web.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  
  web.onload = function() {
    if (web.status >= 200 && web.status < 300) {
      let postsJSON = JSON.parse(web.responseText);
      let posts = document.getElementById("posts");
      posts.innerHTML = ""; // Clear existing posts

      if (postsJSON.length === 0) {
        posts.innerHTML = "<p>No hi ha publicacions disponibles.</p>";
        return;
      }
      else{
        console.log("entra");
        
        postsJSON.forEach(post => {
          posts.innerHTML += `
          <div class="post" id="post-${post.ID_publicacio}">
            <div class="titolPost">
              <div class="UserPost">
                <img src="${post.img_perfil}" alt="">
                <h3>${post.nom_usuari}</h3>
              </div>
            </div>
            <div class="equipDescripcioPost">
              <div class="equipPost">
                <div class="equipUserPost">
                  <div class="pokemonsPost"><img src="${post.pkmn1}" alt=""></div>
                  <div class="pokemonsPost"><img src="${post.pkmn2}" alt=""></div>
                  <div class="pokemonsPost"><img src="${post.pkmn3}" alt=""></div>
                  <div class="pokemonsPost"><img src="${post.pkmn4}" alt=""></div>
                  <div class="pokemonsPost"><img src="${post.pkmn5}" alt=""></div>
                  <div class="pokemonsPost"><img src="${post.pkmn6}" alt=""></div>
                </div>
              </div>
            </div>
            <div class="descripcioPost">
              <p>${post.estrategia}</p>
            </div>
          </div>
          `;
        });
      }

    } else {
      console.error("Failed to load posts:", web.statusText);
    }
  }
  web.send();
}

carregarPosts();
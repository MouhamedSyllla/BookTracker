<nav style="margin-top: 0;" class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand ps-3 fs-4" href="<?php echo BASE_URL; ?>">
        <div style="width:100px; height: 50px" class="logo_container">
            <!-- <img  style="height: " src="<?php echo BASE_URL; ?>/app/assets/images/logo.png" alt="Logo"  class="logo_image image-fluid"> -->
            <div class="logo_text">
                <span style="height: "   class="book">Book<br>Tracker</span>
                <!-- <span style="height: 50px" class="tracker">Tracker</span> -->
            </div>
        </div>
    </a>
    <?php 
      $togglerClass = 'custom_toggler';
      $togglerElement = '<span class="navbar-toggler-icon"></span>';
      if(isLoggedIn()){
        
        $togglerElement = '<img   class="userPicture rounded-circle" src="' . BASE_URL . $_SESSION['user_avatar'] . '"  alt="Profile utilisateur">';
        $togglerClass .= ' logged-in';
      } else {
        $togglerClass .= ' not-logged-in'; // Class for when not logged in
      }
    ?>
    <button class="navbar-toggler <?php echo $togglerClass; ?> " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <?php echo $togglerElement ?>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">BookTracker</h5>
        <button type="button" class="btn-close custom_toggler" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        
        <ul class="navbar-nav justify-content-end ms-auto flex-lg-row flex-column-reverse flex-grow-1 pe-3 align-items-center justify-content-start gap-4">
          <li class="d-flex mt-2 mx-5 ">
            <form class="searchForm w-100 w-lg-75 mx-3 mx-lg-5" role="search" onsubmit="redirectToSearch(event)">
                <input class="form-control custom_form me-2 search-input" id="searchInput" type="search" placeholder="Rechercher par titre, auteur..." aria-label="Search" required>
            </form>
          </li>
            <?php if (isLoggedIn()): ?>
                <li>
                  <a class="nav-link" aria-current="page" href="<?php echo BASE_URL; ?>/Book/">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M360-240h440v-107H360v107ZM160-613h120v-107H160v107Zm0 187h120v-107H160v107Zm0 186h120v-107H160v107Zm200-186h440v-107H360v107Zm0-187h440v-107H360v107ZM160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Z"/></svg>                  
                </a>
                </li>
                <li>
                  <a class="nav-link" aria-current="page" href="<?php echo BASE_URL;?>/Loan/">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1E124A"><path d="M840-680H600v-80h240v80ZM200-120v-640q0-33 23.5-56.5T280-840h240v80H280v518l200-86 200 86v-278h80v400L480-240 200-120Zm80-640h240-240Z"/></svg>                  </a>
                </li>
                <li>
                  <button class="btn outline_btn " type="submit">
                    <a class="" aria-current="page" href="<?php echo BASE_URL; ?>/User/logout">
                      <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>
                      Se déconnecter
                    </a>
                  </button>
                </li>
                <li class="nav-item">
                    <button class="btn yellow_btn" type="submit">
                    <a class="" aria-current="page" href="<?php echo BASE_URL; ?>/Book/create">
                      <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M200-120v-640q0-33 23.5-56.5T280-840h240v80H280v518l200-86 200 86v-278h80v400L480-240 200-120Zm80-640h240-240Zm400 160v-80h-80v-80h80v-80h80v80h80v80h-80v80h-80Z"/></svg>                      Ajouter Livre
                    </a>
                    </button>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo BASE_URL; ?>/User">
                      <img  class="userPicture rounded-circle" src="<?php echo BASE_URL . $_SESSION['user_avatar']; ?>" alt="Profile">
                    </a>
                </li> 

            <?php else: ?>
                <li>
                  <a class="nav-link" aria-current="page" href="<?php echo BASE_URL; ?>/home/about">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M440-280h80v-240h-80v240Zm40-320q17 0 28.5-11.5T520-640q0-17-11.5-28.5T480-680q-17 0-28.5 11.5T440-640q0 17 11.5 28.5T480-600Zm0 520q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg>
                    A propos
                  </a>
                </li>
                <li>
                  <button class="btn outline_btn " type="submit">
                    <a aria-current="page" href="<?php echo BASE_URL; ?>/User/register">
                      <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M320-320h480v-480h-80v280l-100-60-100 60v-280H320v480Zm0 80q-33 0-56.5-23.5T240-320v-480q0-33 23.5-56.5T320-880h480q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H320ZM160-80q-33 0-56.5-23.5T80-160v-560h80v560h560v80H160Zm360-720h200-200Zm-200 0h480-480Z"/></svg>                  
                      S'inscrire
                    </a>
                  </button>
                </li>
                <li>
                  <button class="btn yellow_btn " type="submit">
                    <a aria-current="page" href="<?php echo BASE_URL; ?>/User/login">
                      <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M480-120v-80h280v-560H480v-80h280q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H480Zm-80-160-55-58 102-102H120v-80h327L345-622l55-58 200 200-200 200Z"/></svg>
                      Se connecter
                    </a>
                  </button>
                </li>
            <?php endif; ?>  
        </ul>

      </div>
    </div>
  </div>
  <script>
        function redirectToSearch(event) {
            event.preventDefault(); // Prevents the form from submitting the usual way
            const input = document.getElementById('searchInput').value;
            
            window.location.href = "<?php echo BASE_URL; ?>/Book/search/" + encodeURIComponent(input); // Redirects to the search URL
            document.getElementById('searchInput').value = (input);
        }
        document.addEventListener('DOMContentLoaded', () => {
          // Get the full URL
          const url = window.location.pathname;
          
          // Split the URL to find the search term
          const parts = url.split('/');
          // console.log(parts);
          if (parts[parts.length - 2] && parts[parts.length - 2] === 'search'){
            const searchTerm = parts[parts.length - 1]; // Get the last part of the URL
            // Set the input field value
            if (searchTerm) {
              document.getElementById('searchInput').value = decodeURIComponent(searchTerm);
          }
        }

        
        
    });
    </script>
</nav>
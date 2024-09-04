<body>
<div class="accessibility-container no-change">
    <div class="accessibility-wrapper no-change">
        <div class="bottom-border">
            <button tabindex="4" type="button" id="close_container" accesskey="x" aria-label="Zatvori" title="Zatvori"> Zatvori  </button>
        </div>
        <div class="font-size-settings bottom-border">
            <p class="w-100">Veličina fonta</p>
            <div class="fs-btn">
                <button id="decreaseFontSize"><p class="no-change">A -</p></button>
                <button id="increaseFontSize"><p class="no-change">A +</p></button>
            </div>
            <button id="resetFontSize">Preporučena veličina fonta <i class="fa-solid fa-arrows-rotate"></i></button>
        </div>
        <div class="bottom-border">
            <button id="changeFont">OmoType Font <span class="letter-inside"></span></button>
        </div>
        <div class="contrast-settings bottom-border">
            <p>Kontrast</p>
            <button>Odaberi boju <i class="fa-solid fa-eye-dropper"></i></button>
            <div class="contrast-colors pt-1">
            <div class="contrast-colors pt-1">
                <button class="color-circle black" data-theme="black-yellow"></button>
                <button class="color-circle blue" data-theme="blue-yellow"></button>
                <button class="color-circle green" data-theme="green-black"></button>
                <button class="color-circle red" data-theme="red-black"></button>
            </div>
            </div>
        </div>
        <div class="bottom-border">
            <button id="underlineLink">Podcrtaj linkove <i class="fa-solid fa-underline"></i></button>
        </div>
        <div class="bottom-border">
            <button id="highlightLink">Istakni linkove <i class="fa-solid fa-arrow-rotate-left"></i></button>
        </div>
        <div class="bottom-border">
            <button id="greyImg">Slike sivih tonova <i class="fa-solid fa-droplet-slash"></i></button>
        </div>
        <div class="bottom-border">
            <button>Isključi svjetla <i class="fa-regular fa-lightbulb"></i></button>
        </div>
        <div class="bottom-border">
            <button id="resetStyles">Vrati na početne postavke <i class="fa-solid fa-arrow-rotate-left"></i></button>
        </div>
    </div>
</div>
<header>
    <div class="upper-header">
        <div class="change-photo">
            <div class="form-check form-switch form-switch-xl">
                <input tabindex="1" class="form-check-input" type="checkbox" id="switchId">
                <label class="form-check-label d-none" for="switchId">Promjena fotografije</label>
            </div>
        </div>
        <div class="search">
            <div class="mb-0">
                <label for="textInput" class="form-label d-none">Pretraga</label>
                <input tabindex="2" type="text" id="textInput" class="form-control" placeholder="Pretraži">
            </div>
        </div>

        <div class="accessibility">
            <div class="mb-0">
                <label for="accessilityBtn" class="form-label d-none">Opcije pristupačnosti</label>
                <button tabindex="3" type="button" id="accessilityBtn" class="form-control">
            </div>
        </div>
    </div>
    <div class="title">
    
        <h1 class="header-title">Pristupačni prozor u svijet informacija o ponudama telekom-operatora i HŽPP-a</h1>
    </div>
    <div class="img-header">
        <a href="#"> <!--promijeniti nakon deploya-->
         <img id="headerImg" src="/photo/header-img.webp" alt="slika grada, dnevna verzija">
        </a>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">      
        <div class="navbar-nav w-100 d-flex justify-content-around">
            <div class="nav-item">
                <a class="nav-link" href="/">Početna</a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="/novosti">Novosti</a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="/mladi">Mladi</a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="/osi">OSI</a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="/seniori">Seniori</a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="/kontakti">Kontakti</a>
            </div>

            <div class="nav-item dropdown">
            <a data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                Projekti
            </a>
            <ul class="dropdown-menu">
                <li class="dropdown-item"><a class="dropdown-anchor" href="/admin/view/kompanija/index.php">Kompanija</a></li>
                <li class="dropdown-item"><a class="dropdown-anchor" href="/admin/view/ponuda/index.php">Ponuda</a></li> 
            </ul>
        </div>
        </ul>
        
    </nav>
</header>


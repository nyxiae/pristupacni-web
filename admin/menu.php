<?php
$active_menu = isset($active_menu) ? $active_menu : "";

$menu_items = array(
    'stranica' => array(
        'stranica'
    ),
    'kompanija' => array(
        'kompanija','ponuda'
    ),
    'projekti' => array(
        'projekti'
    ),
    'korisnik' => array(
        'narudzba'
    ),
    'kupac' => array(
        'kupac'
    )
);

// Function to check if a specific menu item group is active
function isMenuItemActive($active_menu, $group) {
    global $menu_items;
    return in_array($active_menu, $menu_items[$group]);
}
?>
    <div id="navbar-cms" class="navbar justify-content-between">
        <div class="item <?= $active_menu == "pocetna" ? "active" : "" ?>"><a href="/"><i class="fa fa-srednji fa-home" aria-hidden="true"></i> <span class="to-hide">Početna</span></a></div>
            <div class="item <?= isMenuItemActive($active_menu, 'stranica') ? "active" : "" ?>"><a href="/view/stranica/index.php"><i class="fa fa-srednji fa-file" aria-hidden="true"></i> <span class="to-hide">Stranica</span></a></div>
            <div class="item">
                <div class="nav-item dropdown">
                    <a data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle <?= isMenuItemActive($active_menu, 'kompanija') ? 'active' : '' ?>">
                        <i class="fa fa-srednji fa-building" aria-hidden="true"></i> <span class="to-hide">Kompanija</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu <?= isMenuItemActive($active_menu, 'kompanija') ? 'in' : '' ?>">
                        <li class="dropdown-item <?= $active_menu == "kompanija" ? "active" : "" ?>"><a href="/view/kompanija/index.php">Kompanija</a></li>
                        <li class="dropdown-item <?= $active_menu == "ponuda" ? "active" : "" ?>"><a href="/view/ponuda/index.php">Ponuda</a></li> 
                    </ul>
                </div>
            </div>
            <div class="item <?= isMenuItemActive($active_menu, 'projekti') ? "active" : "" ?>"><a href="/view/projekti/index.php"><i class="fa fa-srednji fa-tasks" aria-hidden="true"></i> <span class="to-hide">Projekti</span></a></div>
            <div class="item <?= isMenuItemActive($active_menu, 'korisnik') ? "active" : "" ?>"><a href="/view/narudzba/index.php"><i class="fa fa-srednji fa-user" aria-hidden="true"></i> <span class="to-hide">Korisnik</span></a></div>
            <div class="item <?= isMenuItemActive($active_menu, 'kupac') ? "active" : "" ?>"><a href="/view/kupac/index.php"><i class="fa fa-srednji fa-users" aria-hidden="true"></i> <span class="to-hide">Kupac</span></a></div>
            <div class="item"><a href="javascript:;" onclick="logout()"><i class="fa fa-srednji fa-sign-out" aria-hidden="true"></i> <span class="to-hide">Odjava (<?= isset($_SESSION["ime"]) && isset($_SESSION["prezime"]) ? $_SESSION["ime"].' '.$_SESSION["prezime"] : "" ?>)</span></a></div>
        </div>
    </div>

<script>
    $(function(){
        $('.navbar-toggler').on('click', function(){
            if($('#navbar').hasClass("show")){
                $('#navbar').removeClass('show')
            }else{
                $('#navbar').addClass('show')
            }
        })
    })
</script>
<?php
$active_menu = isset($active_menu) ? $active_menu : "";

$menu_items = array(
    'stranica' => array(
        'stranica'
    ),
    'kompanija' => array(
        'kompanija','ponuda'
    ),
    'projekt' => array(
        'projekt'
    ),
    'korisnik' => array(
        'narudzba'
    ),
    'log' => array(
        'log'
    ),
);

// Function to check if a specific menu item group is active
function isMenuItemActive($active_menu, $group) {
    global $menu_items;
    return in_array($active_menu, $menu_items[$group]);
}
?>
    <div id="navbar-cms" class="navbar justify-content-between">
        <div class="item <?= $active_menu == "pocetna" ? "active" : "" ?>"><a href="/admin/index.php"><i class="fa fa-home" aria-hidden="true"></i> Početna</a></div>
            <div class="item <?= isMenuItemActive($active_menu, 'stranica') ? "active" : "" ?>"><a href="/admin/view/stranica/index.php"><i class="fa fa-file" aria-hidden="true"></i> Stranica</a></div>
            <div class="item <?= isMenuItemActive($active_menu, 'kompanija') ? 'active' : '' ?>">
                <div class="nav-item dropdown">
                    <a data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle <?= isMenuItemActive($active_menu, 'kompanija') ? 'active' : '' ?>">
                        <i class="fa fa-building" aria-hidden="true"></i> Kompanija
                        <span class="caret">
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item <?= $active_menu == "kompanija" ? "active" : "" ?>"><a href="/admin/view/kompanija/index.php">Kompanija</a></li>
                        <li class="dropdown-item <?= $active_menu == "ponuda" ? "active" : "" ?>"><a href="/admin/view/ponuda/index.php">Ponuda</a></li> 
                    </ul>
                </div>
            </div>
            <div class="item <?= isMenuItemActive($active_menu, 'projekt') ? "active" : "" ?>"><a href="/admin/view/projekt/index.php"><i class="fa fa-tasks" aria-hidden="true"></i> Projekti</a></div>
            <div class="item <?= isMenuItemActive($active_menu, 'korisnik') ? "active" : "" ?>"><a href="/admin/view/narudzba/index.php"><i class="fa fa-user" aria-hidden="true"></i> Korisnik</a></div>
            <div class="item <?= isMenuItemActive($active_menu, 'log') ? "active" : "" ?>"><a href="/admin/view/log/index.php"><i class="fa fa-code" aria-hidden="true"></i> Zapisi</a></div>
            <div class="item"><a href="javascript:;" onclick="logout()"><i class="fa fa-sign-out" aria-hidden="true"></i> Odjava (<?= isset($_SESSION["ime"]) && isset($_SESSION["prezime"]) ? $_SESSION["ime"].' '.$_SESSION["prezime"] : "" ?>)</a></div>
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
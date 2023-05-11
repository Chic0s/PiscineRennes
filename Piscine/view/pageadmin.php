<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/controler/page-admin.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/controler/admin-controlers/ajout-modification-suppression-admin.php');
?>
<form action="admin" method="post">
    <input type="submit" name="disconnect" value="Se déconnecter">
</form>
<br>
<div class="tabs">
    <div class="tab-registers">
        <button <?php echo ($selectedTab == 0) ? 'class="active-tab"' : ''; ?>>Créneaux</button>
        <button <?php echo ($selectedTab == 1) ? 'class="active-tab"' : ''; ?>>Codes</button>
        <button <?php echo ($selectedTab == 2) ? 'class="active-tab"' : ''; ?>>Ventes</button>
        <button <?php echo ($selectedTab == 3) ? 'class="active-tab"' : ''; ?>>Réservations</button>
        <button <?php echo ($selectedTab == 4) ? 'class="active-tab"' : ''; ?>>Piscines</button>
        <button <?php echo ($selectedTab == 5) ? 'class="active-tab"' : ''; ?>>Bassins</button>
        <button <?php echo ($selectedTab == 6) ? 'class="active-tab"' : ''; ?>>Formules</button>
        <button <?php echo ($selectedTab == 7) ? 'class="active-tab"' : ''; ?>>Comptes administrateur</button>
    </div>
    <div class="tab-bodies">
        <div style="<?php echo ($selectedTab == 0) ? 'display:block;' : 'display:none;'; ?>">
            <form action="admin" method="post" onsubmit="return confirm('Êtes-vous sûr(e) de vouloir modifier/supprimer ce créneau ?');">
                <table aria-describedby="Gestion des crénaux">
                    <tr>
                        <th scope="col">Identifiant</th>
                        <th scope="col">Bassin</th>
                        <th scope="col">Date/heure de début</th>
                        <th scope="col">Date/heure de fin</th>
                        <th scope="col">Nombre de places</th>
                        <th scope="col">Nombre de réservations</th>
                    </tr>
                    <?php
                    require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/controler/admin-controlers/creneaux-admin-controler.php');
                    ?>
                </table>
            </form>
        </div>
        <div style="<?php echo ($selectedTab == 1) ? 'display:block;' : 'display:none;'; ?>">
            <form action="admin" method="post" onsubmit="return confirm('Êtes-vous sûr(e) de vouloir modifier/supprimer ce code ?');">
                <table aria-describedby="Gestion des codes">
                    <tr>
                        <th scope="col">Identifiant</th>
                        <th scope="col">Code</th>
                        <th scope="col">Date d'achat</th>
                        <th scope="col">Date de péremption</th>
                        <th scope="col">Formule</th>
                        <th scope="col">Réservation</th>
                    </tr>
                    <?php
                    require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/controler/admin-controlers/code-admin-controler.php');
                    ?>
                </table>
            </form>
        </div>
        <div style="<?php echo ($selectedTab == 2) ? 'display:block;' : 'display:none;'; ?>">
            <form action="admin" method="post" onsubmit="return confirm('Êtes-vous sûr(e) de vouloir modifier/supprimer cette vente ?');">
                <table aria-describedby="Gestion des ventes">
                    <tr>
                        <th scope="col">Identifiant</th>
                        <th scope="col">Date de vente</th>
                        <th scope="col">Date de péremption</th>
                        <th scope="col">Nombre de codes restants</th>
                        <th scope="col">Formule</th>
                    </tr>
                    <?php
                    require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/controler/admin-controlers/vente-admin-controler.php');
                    ?>
                </table>
        </div>
        <div style="<?php echo ($selectedTab == 3) ? 'display:block;' : 'display:none;'; ?>">
            <form action="admin" method="post" onsubmit="return confirm('Êtes-vous sûr(e) de vouloir supprimer cette réservation ?');">
                <table aria-describedby="Gestion des réservations">
                    <tr>
                        <th scope="col">Identifiant</th>
                        <th scope="col">Créneau</th>
                        <th scope="col">Date/heure de réservation</th>
                        <th scope="col">Code utilisé</th>
                    </tr>
                    <?php
                    require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/controler/admin-controlers/reservation-admin-controler.php');
                    ?>
                </table>
            </form>
        </div>
        <div style="<?php echo ($selectedTab == 4) ? 'display:block;' : 'display:none;'; ?>">
            <form action="admin" method="post" onsubmit="return confirm('Êtes-vous sûr(e) de vouloir modifier/supprimer cette piscine ?');">
                <table aria-describedby="Gestion des piscines">
                    <tr>
                        <th scope="col">Identifiant</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Adresse</th>
                        <th scope="col">État</th>
                        <th scope="col">Emplacement de l'image</th>
                    </tr>
                    <?php
                    require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/controler/admin-controlers/piscine-admin-controler.php');
                    ?>
                </table>
            </form>
        </div>
        <div style="<?php echo ($selectedTab == 5) ? 'display:block;' : 'display:none;'; ?>">
            <form action="admin" method="post" onsubmit="return confirm('Êtes-vous sûr(e) de vouloir modifier/supprimer ce bassin ?');">
                <table aria-describedby="Gestion des bassin">
                    <tr>
                        <th scope="col">Identifiant</th>
                        <th scope="col">Piscine</th>
                        <th scope="col">Description</th>
                    </tr>
                    <?php
                    require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/controler/admin-controlers/bassin-admin-controler.php');
                    ?>
                </table>
            </form>
        </div>
        <div style="<?php echo ($selectedTab == 6) ? 'display:block;' : 'display:none;'; ?>">
            <form action="admin" method="post" onsubmit="return confirm('Êtes-vous sûr(e) de vouloir modifier/supprimer cette formule ?');">
                <table aria-describedby="Gestion des formule">
                    <tr>
                        <th scope="col">Identifiant</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Type</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Description</th>
                    </tr>
                    <?php
                    require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/controler/admin-controlers/formule-admin-controler.php');
                    ?>
                </table>
            </form>
        </div>
        <div style="<?php echo ($selectedTab == 7) ? 'display:block;' : 'display:none;'; ?>">
            <form action="admin" method="post" onsubmit="return confirm('Êtes-vous sûr(e) de vouloir modifier/supprimer ce compte administrateur ?');">
                <table aria-describedby="Gestion des comptes administrateur">
                    <tr>
                        <th scope="col">Identifiant</th>
                        <th scope="col">Nom d'utilisateur</th>
                        <th scope="col">Mot de passe</th>
                    </tr>
                    <?php
                    require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/controler/admin-controlers/adminpage-admin-controler.php');
                    ?>
                </table>
            </form>
        </div>
    </div>
</div>
<script src="assets/js/tabSystem.js"></script>

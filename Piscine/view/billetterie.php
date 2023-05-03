<div class=Achat>
    <div class="AchatBox">
        <h1>Billetterie</h1>
        <br>
        <p class="centrer">Sélectionnez la ou les offre(s) que vous souhaiteriez acheter.</p>
        <br>
        <div class="GenerationForm decallage-gauche">
            <form method="post" action="" class="FormulaireAchat">
                <?php
                session_start();
                require_once($_SERVER['DOCUMENT_ROOT'].'/Piscine/model/billeterie.php');
                ?>
                <input class="ButtonFormPost" type="submit" value="Valider">
            </form>
        </div>
    </div>
</div>
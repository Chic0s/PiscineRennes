<div class=Achat>
    <div class="AchatBox">
        <h1>Billetterie</h1>
        <br>
        <p class="centrer">Sélectionnez la ou les offre(s) que vous souhaiteriez acheter.</p>
        <br>
        <div class="GenerationForm ">
            <form method="post" action="" class="FormulaireAchat">
                <div>
                <?php
                require_once($_SERVER['DOCUMENT_ROOT'].'/Piscine/controler/billeterie.php');
                ?>
                </div>
                <br>
                <input class="ButtonFormPost centrer" type="submit" value="Valider">
            </form>
        </div>
    </div>
</div>
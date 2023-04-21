<div class="slider"><div class=slide>
    <img src="/Piscine/assets/img/Piscines/Piscine-Brequiny.jpg" class="imgslider active" alt="">
</div></div>

<div class=Achat>
    <div class="AchatBox">
        <h3>Achat</h3>
        <p>Vous pouvez selectionner l'offre que vous souhaiteriez acheter : </p>
        <br>
        <div class="GenerationForm">
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
<?php
//session_start();
?>
  <a class="ReturnBoutique" href="/Piscine/boutique">Retour à la boutique</a>
  <form class="credit-card" method="post" action="/Piscine/success">
    <div class="form-header">
      <h4 class="title-card">Paiement - Carte de Crédit</h4>
    </div>
    <div class="form-body">
      <!-- Card Number -->
      <input type="text" class="card-number" placeholder="Numero de carte" maxlength="16">
      <!-- Date Field -->
      <div class="date-field">
        <div class="month">
          <select name="Month">
            <option value="Janvier">Janvier</option>
            <option value="Février">Février</option>
            <option value="Mars">Mars</option>
            <option value="Avril">Avril</option>
            <option value="Mai">Mai</option>
            <option value="Juin">Juin</option>
            <option value="Juillet">Juillet</option>
            <option value="Aout">Aout</option>
            <option value="Septembre">Septembre</option>
            <option value="Octobre">Octobre</option>
            <option value="Novembre">Novembre</option>
            <option value="Décembre">Décembre</option>
          </select>
        </div>
        <div class="year">
          <select name="Year">
            <option value="2023">2023</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
            <option value="2026">2026</option>
            <option value="2027">2027</option>
            <option value="2028">2028</option>
            <option value="2029">2029</option>
            <option value="2030">2030</option>
            <option value="2031">2031</option>
          </select>
        </div>
      </div>
      <!-- Card Verification Field -->
      <div class="card-verification">
        <div class="cvv-input">
          <input type="text" placeholder="CVV" maxlength="3">
        </div>
        <div class="cvv-details">
          <p>Mastercard, Visa, American Express</p>
        </div>
      </div>
      <?php
      require_once $_SERVER['DOCUMENT_ROOT'] . '/Piscine/controler/payement.php';
      echo 'Prix total : ' . $price . ' €';
      ?>
      <!-- Buttons -->
      <button type="submit" class="proceed-btn"><a href="">Achat</a></button>
    </div>
  </form>

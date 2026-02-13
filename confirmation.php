<?php
include 'assets/includes/conn.php';
include 'assets/includes/header.php';

$pickupNumber = isset($_GET['pickup']) ? intval($_GET['pickup']) : 0;
// Double digit formatting strings
$pickupDisplay = str_pad($pickupNumber, 2, '0', STR_PAD_LEFT);

$orderId = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
$total = isset($_GET['total']) ? floatval($_GET['total']) : 0;
?>

<div class="confirm-screen" id="confirm-screen">
    <div class="confirm-icon">✅</div>
    <h1 data-t="thank_you">Thank you!</h1>
    <h2 data-t="enjoy_meal">Enjoy your meal</h2>

    <p class="pickup-label" data-t="pickup_label">Your pickup number is</p>
    <div class="pickup-number">#<?= $pickupDisplay ?></div>

    <div class="confirm-summary">
        <div class="summary-row" style="color:#fff;">
            <span class="label">Order #<?= $orderId ?></span>
            <span class="value">&euro;&nbsp;<?= number_format($total, 2, ',', '.') ?></span>
        </div>
    </div>

    <img src="assets/img/logo.png" alt="Happy Herbivore" style="height:120px; margin:24px auto;">

    <p class="countdown" id="countdown"></p>
</div>

<script>
    sessionStorage.removeItem('hh_cart');

    let seconds = 10;
    const countdownEl = document.getElementById('countdown');

    function updateCountdown() {
        const lang = sessionStorage.getItem('hh_lang') || 'en';
        const returning = lang === 'nl' ? 'Terug naar het begin in' : 'Returning to home in';
        const sec = lang === 'nl' ? 'seconden…' : 'seconds…';
        countdownEl.innerHTML = returning + ' <strong>' + seconds + '</strong> ' + sec;
    }

    updateCountdown();

    const timer = setInterval(() => {
        seconds--;
        if (seconds <= 0) {
            clearInterval(timer);
            window.location.href = 'index.php';
        } else {
            updateCountdown();
        }
    }, 1000);
</script>

<?php include 'assets/includes/footer.php'; ?>
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

<!-- Hidden receipt for printing -->
<div id="receipt" class="receipt">
    <div class="receipt-header">
        <div class="receipt-logo">🌿 Happy Herbivore</div>
        <div class="receipt-tagline">Healthy in a Hurry</div>
    </div>
    <div class="receipt-divider">================================</div>
    <div class="receipt-meta">
        <div>Bestelling #<span id="r-order-id"></span></div>
        <div id="r-datetime"></div>
    </div>
    <div class="receipt-divider">================================</div>
    <div id="r-items" class="receipt-items"></div>
    <div class="receipt-divider">--------------------------------</div>
    <div class="receipt-totals">
        <div class="receipt-row"><span>Subtotaal</span><span id="r-subtotal"></span></div>
        <div class="receipt-row"><span>BTW (9%)</span><span id="r-tax"></span></div>
        <div class="receipt-divider">================================</div>
        <div class="receipt-row receipt-total"><span>TOTAAL</span><span id="r-total"></span></div>
    </div>
    <div class="receipt-divider">================================</div>
    <div class="receipt-payment">Betaald met pinpas ✓</div>
    <div class="receipt-pickup">
        <div>Ophaalnummer</div>
        <div class="receipt-pickup-number" id="r-pickup"></div>
    </div>
    <div class="receipt-divider">================================</div>
    <div class="receipt-footer">
        <div>Bedankt & Eet Smakelijk!</div>
        <div class="receipt-website">happyherbivore.nl</div>
    </div>
</div>

<script>
    // --- Receipt printing ---
    (function printReceipt() {
        const receiptData = sessionStorage.getItem('hh_receipt');
        if (!receiptData) return;

        try {
            const r = JSON.parse(receiptData);
            document.getElementById('r-order-id').textContent = r.order_id;
            document.getElementById('r-pickup').textContent = '#' + String(r.pickup_number).padStart(2, '0');

            // Date/time
            const now = new Date();
            document.getElementById('r-datetime').textContent =
                now.toLocaleDateString('nl-NL') + ' ' + now.toLocaleTimeString('nl-NL', { hour: '2-digit', minute: '2-digit' });

            // Items
            const itemsEl = document.getElementById('r-items');
            let itemsHtml = '';
            if (r.items && r.items.length) {
                r.items.forEach(item => {
                    const qty = item.qty || item.quantity || 1;
                    const price = parseFloat(item.price);
                    const lineTotal = (qty * price).toFixed(2).replace('.', ',');
                    const name = item.name || item.product_name || 'Item';
                    itemsHtml += '<div class="receipt-item">';
                    itemsHtml += '<span>' + qty + 'x ' + name + '</span>';
                    itemsHtml += '<span>€ ' + lineTotal + '</span>';
                    itemsHtml += '</div>';
                });
            }
            itemsEl.innerHTML = itemsHtml;

            // Totals
            document.getElementById('r-subtotal').textContent = '€ ' + parseFloat(r.subtotal).toFixed(2).replace('.', ',');
            document.getElementById('r-tax').textContent = '€ ' + parseFloat(r.tax).toFixed(2).replace('.', ',');
            document.getElementById('r-total').textContent = '€ ' + parseFloat(r.total).toFixed(2).replace('.', ',');

            // Clean up
            sessionStorage.removeItem('hh_receipt');

            // Auto-print after short delay to let the page render
            setTimeout(() => { window.print(); }, 500);
        } catch (e) {
            console.error('Receipt error:', e);
        }
    })();

    // --- Cart cleanup & countdown ---
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
<?php
include 'assets/includes/conn.php';
include 'assets/includes/header.php';
?>

<div class="payment-screen" id="payment-screen">
    <!-- Header -->
    <div class="kiosk-header">
        <div class="header-left">
            <button class="btn-back" onclick="window.history.back()">&#8592;</button>
            <img src="assets/img/logo.png" alt="Happy Herbivore" class="header-logo">
        </div>
        <span class="header-title" data-t="payment">Payment</span>
    </div>

    <div class="payment-content">
        <h1 data-t="total_to_pay">Total to Pay</h1>
        <div class="payment-total-display" id="payment-total-display">...</div>

        <div class="payment-instructions">
            <p data-t="tap_card">Please tap your card on the terminal</p>
            <div class="terminal-animation">
                <div class="card-wave"></div>
                <div class="terminal-icon">📟</div>
            </div>
        </div>
    </div>

    <!-- The Popup (Overlay) Requested -->
    <div class="payment-modal-overlay" id="payment-modal">
        <div class="payment-modal">
            <div class="payment-animation">💳</div>
            <h2 data-t="payment_instr">Follow instructions on the terminal</h2>
            <p data-t="processing">Processing payment...</p>
        </div>
    </div>
</div>

<script>
    // Logic to handle payment screen specific behaviour
    document.addEventListener('DOMContentLoaded', () => {
        handlePaymentScreen();
    });
</script>

<?php include 'assets/includes/footer.php'; ?>
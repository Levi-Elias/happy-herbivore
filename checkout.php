<?php
include 'assets/includes/conn.php';
include 'assets/includes/header.php';
?>

<div class="cart-screen" id="cart-screen">
    <!-- Header -->
    <div class="kiosk-header">
        <div class="header-left">
            <button class="btn-back" onclick="window.location.href='menu.php'">&#8592;</button>
            <img src="assets/img/logo.png" alt="Happy Herbivore" class="header-logo">
        </div>
        <span class="header-title" data-t="your_order">Your Order</span>
    </div>

    <!-- Cart Items (populated by JS) -->
    <div class="cart-items" id="cart-items">
        <!-- JS will render items here -->
    </div>

    <!-- Order Summary -->
    <div class="order-summary" id="order-summary">
        <div class="summary-card">
            <h2 data-t="order_summary">Order Summary</h2>

            <div class="summary-row">
                <span class="label" data-t="subtotal">Subtotal</span>
                <span class="value" id="summary-subtotal">&euro;&nbsp;0,00</span>
            </div>
            <div class="summary-row">
                <span class="label" data-t="btw">BTW (9%)</span>
                <span class="value" id="summary-tax">&euro;&nbsp;0,00</span>
            </div>
            <div class="summary-row total">
                <span class="label" data-t="total">Total</span>
                <span class="value" id="summary-total">&euro;&nbsp;0,00</span>
            </div>

            <div class="summary-actions">
                <button class="btn-gray" onclick="window.location.href='menu.php'" data-t="add_more">Add More
                    Items</button>
                <button class="btn-orange" id="btn-checkout" onclick="initiatePayment()" data-t="place_order">Place
                    Order</button>
            </div>
        </div>
    </div>

    <!-- Payment Modal (Hidden by default) -->
    <div class="payment-modal-overlay" id="payment-modal">
        <div class="payment-modal">
            <div class="payment-animation">💳</div>
            <h2 data-t="payment_instr">Follow instructions on the terminal</h2>
            <p data-t="processing">Processing payment...</p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => renderCart());
</script>

<?php include 'assets/includes/footer.php'; ?>
/* ===================================================
   Happy Herbivore — Kiosk JavaScript v3
   Includes payment modal, full translations menu
   =================================================== */

const CART_KEY = 'hh_cart';
const LANG_KEY = 'hh_lang';
const TAX_RATE = 0.09; // 9% BTW

/* =======================
   TRANSLATIONS
   ======================= */
const translations = {
    en: {
        start_order: 'Start Your Order',
        tagline: 'Healthy in a Hurry',
        categories: 'Categories',
        add: 'Add',
        view_order: 'View Order',
        cancel_order: 'Cancel Order',
        items_in_order: 'items in your order',
        your_order: 'Your Order',
        order_summary: 'Order Summary',
        subtotal: 'Subtotal',
        btw: 'BTW (9%)',
        total: 'Total',
        add_more: 'Add More Items',
        place_order: 'Place Order',
        cart_empty: 'Your cart is empty',
        start_shopping: 'Start Shopping',
        card: 'Card',
        cash: 'Cash',
        thank_you: 'Thank you!',
        enjoy_meal: 'Enjoy your meal',
        pickup_label: 'Your pickup number is',
        returning: 'Returning to home in',
        seconds: 'seconds…',
        payment: 'Payment',
        total_to_pay: 'Total to Pay',
        tap_card: 'Please tap your card on the terminal',

        // Categories
        cat_1: 'Breakfast',
        cat_2: 'Lunch & Dinner',
        cat_3: 'Handhelds',
        cat_4: 'Sides',
        cat_5: 'Dips',
        cat_6: 'Drinks',

        // Products (English - matches DB)
        desc_1: 'Açaí, banana, granola, chia, coconut',
        desc_2: 'Scrambled eggs, spinach, yogurt-herb sauce',
        desc_3: 'Peanut butter, banana, cacao nibs',
        desc_4: 'Almond milk oats, apple, cinnamon, walnuts',
        desc_5: 'Quinoa, tofu, sweet potato, kale, tahini',
        desc_6: 'Kale, edamame, avocado, cucumber',
        desc_7: 'Falafel, hummus, vegetables',
        desc_8: 'Brown rice, tempeh, broccoli',
        desc_9: 'Spiced chickpeas, hummus, vegetables',
        desc_10: 'Grilled halloumi, avocado, chili flakes',
        desc_11: 'BBQ jackfruit, purple slaw',
        desc_12: 'Oven baked with smoked paprika',
        desc_13: 'Crispy breaded zucchini',
        desc_14: 'Five baked falafel bites',
        desc_15: 'Celery, carrots, cucumber',
        desc_16: 'Smooth chickpea hummus',
        desc_17: 'Creamy avocado with a hint of lime',
        desc_18: 'Tangy Greek yogurt with herbs',
        desc_19: 'Spicy and creamy sriracha mayo',
        desc_20: 'Rich peanut sauce',
        desc_21: 'Spinazie, pineapple, cucumber',
        desc_22: 'Matcha with almond milk',
        desc_23: 'Lemon, strawberry, cucumber',
        desc_24: 'Mixed berries with almond milk',
        desc_25: 'Orange juice, sparkling water',
    },
    nl: {
        start_order: 'Begin Uw Bestelling',
        tagline: 'Gezond in een Handomdraai',
        categories: 'Categorieën',
        add: 'Toevoegen',
        view_order: 'Bekijk Bestelling',
        cancel_order: 'Annuleer Bestelling',
        items_in_order: 'items in uw bestelling',
        your_order: 'Uw Bestelling',
        order_summary: 'Besteloverzicht',
        subtotal: 'Subtotaal',
        btw: 'BTW (9%)',
        total: 'Totaal',
        add_more: 'Meer Toevoegen',
        place_order: 'Bestelling Plaatsen',
        cart_empty: 'Uw bestelling is leeg',
        start_shopping: 'Begin met Bestellen',
        card: 'Pinpas',
        cash: 'Contant',
        thank_you: 'Bedankt!',
        enjoy_meal: 'Eet smakelijk',
        pickup_label: 'Uw ophaalnummer is',
        returning: 'Terug naar het begin in',
        seconds: 'seconden…',
        payment_instr: 'Volg de instructies op het betaalapparaat',
        processing: 'Betaling verwerken...',
        payment: 'Betaling',
        total_to_pay: 'Totaal te betalen',
        tap_card: 'Houd uw kaart tegen het apparaat',

        // Categories
        cat_1: 'Ontbijt',
        cat_2: 'Lunch & Diner',
        cat_3: 'Broodjes',
        cat_4: 'Bijgerechten',
        cat_5: 'Dips',
        cat_6: 'Dranken',

        // Products (Dutch translations)
        desc_1: 'Açaí, banaan, granola, chia, kokos',
        desc_2: 'Roerei, spinazie, yoghurt-kruidensaus',
        desc_3: 'Pindakaas, banaan, cacao nibs',
        desc_4: 'Amandelmelk havermout, appel, kaneel, walnoten',
        desc_5: 'Quinoa, tofu, zoete aardappel, boerenkool, tahin',
        desc_6: 'Boerenkool, edamame, avocado, komkommer',
        desc_7: 'Falafel, hummus, groenten',
        desc_8: 'Zilvervliesrijst, tempeh, broccoli',
        desc_9: 'Gekruide kikkererwten, hummus, groenten',
        desc_10: 'Gegrilde halloumi, avocado, chilivlokken',
        desc_11: 'BBQ jackfruit, paarse koolsalade',
        desc_12: 'Ovengebakken met gerookte paprika',
        desc_13: 'Krokant gepaneerde courgette',
        desc_14: 'Vijf gebakken falafel hapjes',
        desc_15: 'Bleekselderij, wortelen, komkommer',
        desc_16: 'Zachte kikkererwten hummus',
        desc_17: 'Romige avocado met limoen',
        desc_18: 'Frisse Griekse yoghurt met kruiden',
        desc_19: 'Pittige sriracha mayonaise',
        desc_20: 'Rijke pindasaus',
        desc_21: 'Spinazie, ananas, komkommer',
        desc_22: 'Matcha met amandelmelk',
        desc_23: 'Citroen, aardbei, komkommer',
        desc_24: 'Gemengde bessen met amandelmelk',
        desc_25: 'Sinaasappelsap, bruiswater',
        // Duplicates (Dips)
        desc_26: 'Zachte kikkererwten hummus',
        desc_27: 'Romige avocado met limoen',
        desc_28: 'Frisse Griekse yoghurt met kruiden',
        desc_29: 'Pittige sriracha mayonaise',
        desc_30: 'Rijke pindasaus',
        desc_31: 'Zachte kikkererwten hummus',
        desc_32: 'Romige avocado met limoen',
        desc_33: 'Frisse Griekse yoghurt met kruiden',
        desc_34: 'Pittige sriracha mayonaise',
        desc_35: 'Rijke pindasaus',
    }
};

let currentLang = sessionStorage.getItem(LANG_KEY) || 'en';

function setLanguage(lang) {
    currentLang = lang;
    sessionStorage.setItem(LANG_KEY, lang);
    applyTranslations();
    updateFlagButtons();
}

function applyTranslations() {
    const t = translations[currentLang] || translations.en;

    // Standard text elements
    document.querySelectorAll('[data-t]').forEach(el => {
        const key = el.getAttribute('data-t');
        if (t[key]) {
            el.textContent = t[key];
        }
    });

    // Product descriptions
    document.querySelectorAll('[data-t-desc]').forEach(el => {
        const id = el.getAttribute('data-t-desc');
        const key = 'desc_' + id;
        if (t[key]) {
            el.textContent = t[key];
        } else if (t['desc_' + (parseInt(id) > 25 ? (id > 30 ? id - 15 : id - 10) : id)]) {
            // Fallback for English keys if not explicitly defined in map above (though they should be)
            el.textContent = t['desc_' + (parseInt(id) > 25 ? (id > 30 ? id - 15 : id - 10) : id)];
        }
    });
}

function updateFlagButtons() {
    document.querySelectorAll('.flag-btn').forEach(flag => {
        flag.classList.remove('active');
    });
    const activeFlag = document.getElementById('flag-' + currentLang);
    if (activeFlag) activeFlag.classList.add('active');
}

function t(key) {
    return (translations[currentLang] || translations.en)[key] || key;
}

/* =======================
   CART — sessionStorage
   ======================= */
function getCart() {
    try {
        return JSON.parse(sessionStorage.getItem(CART_KEY)) || [];
    } catch {
        return [];
    }
}

function saveCart(cart) {
    sessionStorage.setItem(CART_KEY, JSON.stringify(cart));
    updateCartBar();
    updateCartBadge();
}

function addToCart(productId, name, price, image) {
    const cart = getCart();
    const existing = cart.find(item => item.id === productId);
    if (existing) {
        existing.qty += 1;
    } else {
        cart.push({ id: productId, name, price: parseFloat(price), qty: 1, image });
    }
    saveCart(cart);

    // Visual feedback
    const card = document.getElementById('card-' + productId);
    if (card) {
        card.classList.add('add-flash');
        setTimeout(() => card.classList.remove('add-flash'), 400);
    }
}

function removeFromCart(productId) {
    let cart = getCart().filter(item => item.id !== productId);
    saveCart(cart);
    renderCart();
}

function updateQuantity(productId, delta) {
    const cart = getCart();
    const item = cart.find(i => i.id === productId);
    if (!item) return;
    item.qty += delta;
    if (item.qty <= 0) {
        saveCart(cart.filter(i => i.id !== productId));
    } else {
        saveCart(cart);
    }
    renderCart();
}

function clearCart() {
    sessionStorage.removeItem(CART_KEY);
    updateCartBar();
    updateCartBadge();
}

function cancelOrder() {
    clearCart();
    const cartBar = document.getElementById('cart-bar');
    if (cartBar) cartBar.classList.add('hidden');
}

/* =======================
   CART BADGE
   ======================= */
function updateCartBadge() {
    const badge = document.getElementById('cart-badge');
    if (!badge) return;
    const cart = getCart();
    const totalItems = cart.reduce((sum, item) => sum + item.qty, 0);
    if (totalItems > 0) {
        badge.textContent = totalItems;
        badge.classList.remove('hidden');
    } else {
        badge.classList.add('hidden');
    }
}

/* =======================
   BOTTOM CART BAR
   ======================= */
function updateCartBar() {
    const bar = document.getElementById('cart-bar');
    if (!bar) return;

    const cart = getCart();
    const totalItems = cart.reduce((sum, item) => sum + item.qty, 0);
    const subtotal = cart.reduce((sum, item) => sum + item.price * item.qty, 0);
    const total = subtotal + (subtotal * TAX_RATE);

    const countEl = document.getElementById('cart-bar-count');
    const totalEl = document.getElementById('cart-bar-total');

    if (totalItems > 0) {
        bar.classList.remove('hidden');
        if (countEl) countEl.textContent = totalItems;
        if (totalEl) totalEl.textContent = '€\u00A0' + formatPrice(total);
    } else {
        bar.classList.add('hidden');
    }
}

/* =======================
   NAVIGATE
   ======================= */
function goToCheckout() {
    const cart = getCart();
    if (cart.length === 0) return;
    window.location.href = 'checkout.php';
}

/* =======================
   RENDER CART
   ======================= */
function renderCart() {
    const container = document.getElementById('cart-items');
    const summarySection = document.getElementById('order-summary');
    if (!container) return;

    const cart = getCart();

    if (cart.length === 0) {
        container.innerHTML = `
            <div class="cart-empty">
                <div class="cart-empty-icon">🛒</div>
                <p>${t('cart_empty')}</p>
                <a href="menu.php" class="btn-orange">${t('start_shopping')}</a>
            </div>
        `;
        if (summarySection) summarySection.style.display = 'none';
        return;
    }

    if (summarySection) summarySection.style.display = '';

    let html = '';
    cart.forEach(item => {
        const lineTotal = formatPrice(item.price * item.qty);
        const unitPrice = formatPrice(item.price);
        html += `
            <div class="cart-item" data-id="${item.id}">
                <img src="${escapeHtml(item.image)}" alt="${escapeHtml(item.name)}" class="item-img">
                <div class="item-info">
                    <div class="item-name">${escapeHtml(item.name)}</div>
                    <div class="item-price">€\u00A0${unitPrice}</div>
                </div>
                <div class="qty-controls">
                    <button class="qty-btn" onclick="updateQuantity(${item.id}, -1)">−</button>
                    <span class="qty-value">${item.qty}</span>
                    <button class="qty-btn" onclick="updateQuantity(${item.id}, 1)">+</button>
                </div>
                <div class="item-total">€\u00A0${lineTotal}</div>
                <button class="btn-delete" onclick="removeFromCart(${item.id})">🗑</button>
            </div>
        `;
    });
    container.innerHTML = html;

    // Update summary
    const subtotal = cart.reduce((sum, item) => sum + item.price * item.qty, 0);
    const tax = subtotal * TAX_RATE;
    const total = subtotal + tax;

    const elSub = document.getElementById('summary-subtotal');
    const elTax = document.getElementById('summary-tax');
    const elTotal = document.getElementById('summary-total');
    if (elSub) elSub.textContent = '€\u00A0' + formatPrice(subtotal);
    if (elTax) elTax.textContent = '€\u00A0' + formatPrice(tax);
    if (elTotal) elTotal.textContent = '€\u00A0' + formatPrice(total);
}

/* =======================
   PAYMENT FLOW (V5)
   ======================= */
function initiatePayment() {
    // Redirect to separate payment screen
    window.location.href = 'payment.php';
}

function handlePaymentScreen() {
    const totalEl = document.getElementById('payment-total-display');
    if (!totalEl) return;

    const cart = getCart();
    if (cart.length === 0) {
        window.location.href = 'index.php'; // Should not happen
        return;
    }

    // Calc total
    const subtotal = cart.reduce((sum, item) => sum + item.price * item.qty, 0);
    const total = subtotal + (subtotal * TAX_RATE);
    totalEl.textContent = '€\u00A0' + formatPrice(total);

    // Show popup immediately or after short delay? User said "waar dan die popup op komt"
    // Let's show it after 1 second
    setTimeout(() => {
        const modal = document.getElementById('payment-modal');
        if (modal) modal.classList.add('active');

        // Then simulate successful payment after 4 more seconds
        setTimeout(() => {
            submitOrder(); // Reuse logic
        }, 4000);

    }, 1000);
}

async function submitOrder() {
    const cart = getCart();
    // Default to card since cash is removed
    const paymentMethod = 'card';

    try {
        const response = await fetch('api/place_order.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                items: cart,
                payment_method: paymentMethod,
            }),
        });

        const data = await response.json();

        if (data.success) {
            window.location.href = `confirmation.php?pickup=${data.pickup_number}&order_id=${data.order_id}&total=${data.total}`;
        } else {
            alert('Error: ' + (data.error || 'Could not place order'));
            // Hide popup if error
            const modal = document.getElementById('payment-modal');
            if (modal) modal.classList.remove('active');
        }
    } catch (err) {
        alert('Connection error. Please try again.');
        const modal = document.getElementById('payment-modal');
        if (modal) modal.classList.remove('active');
    }
}

/* =======================
   CATEGORY SWITCHING
   ======================= */
function switchCategory(btnEl, catId) {
    document.querySelectorAll('.cat-btn').forEach(b => b.classList.remove('active'));
    btnEl.classList.add('active');

    document.querySelectorAll('.category-group').forEach(g => {
        g.classList.toggle('hidden', parseInt(g.dataset.catId) !== catId);
    });
}

/* =======================
   SLIDESHOW
   ======================= */
function initSlideshow() {
    const slides = document.querySelectorAll('.slideshow .slide');
    if (slides.length <= 1) return;

    let current = 0;
    setInterval(() => {
        slides[current].classList.remove('active');
        current = (current + 1) % slides.length;
        slides[current].classList.add('active');
    }, 5000);
}

function formatPrice(n) {
    return n.toFixed(2).replace('.', ',');
}

function escapeHtml(str) {
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
}

document.addEventListener('DOMContentLoaded', () => {
    currentLang = sessionStorage.getItem(LANG_KEY) || 'en';
    applyTranslations();
    updateFlagButtons();
    updateCartBadge();
    updateCartBar();
    initSlideshow();
    handlePaymentScreen(); // Only runs if on payment page
});

<?php
include 'assets/includes/conn.php';

// Fetch categories
$catStmt = $conn->query("SELECT * FROM categories ORDER BY sort_order");
$categories = $catStmt->fetchAll(PDO::FETCH_ASSOC);

// Icons map
$icons = [
    1 => '🥐', // Breakfast
    2 => '🥗', // Lunch & Dinner
    3 => '🥪', // Handhelds
    4 => '🍟', // Sides
    5 => '🥣', // Dips
    6 => '🥤', // Drinks
];

// Fetch all available products with their images
$prodStmt = $conn->query("
    SELECT p.product_id, p.category_id, p.name, p.description, p.price, p.kcal,
           i.filename AS image
    FROM products p
    LEFT JOIN images i ON p.image_id = i.image_id
    WHERE p.available = 1
    ORDER BY p.sort_order, p.name
");
$allProducts = $prodStmt->fetchAll(PDO::FETCH_ASSOC);

// Group products by category
$productsByCategory = [];
foreach ($allProducts as $prod) {
    $productsByCategory[$prod['category_id']][] = $prod;
}

// Diet tags map
// Default is Vegan (1), Vegetarian (2)
$dietMap = [
    2 => 'vegetarian', // Garden Breakfast Wrap (Eggs)
    10 => 'vegetarian', // Halloumi Toastie
    18 => 'vegetarian', // Greek Yogurt Ranch
    28 => 'vegetarian', // Duplicate of 18
    33 => 'vegetarian', // Duplicate of 18
];

// Default to first category
$activeCatId = $categories[0]['category_id'] ?? 1;
?>
<?php include 'assets/includes/header.php'; ?>

<div class="menu-screen" id="menu-screen">
    <!-- Header -->
    <div class="kiosk-header">
        <img src="assets/img/logo.png" alt="Happy Herbivore" class="header-logo">
        <div class="lang-flags-header">
        </div>
    </div>

    <!-- Body: sidebar + grid -->
    <div class="menu-body">
        <!-- Category Sidebar -->
        <div class="category-sidebar">
            <h2 data-t="categories">Categories</h2>
            <?php foreach ($categories as $cat): ?>
                <button class="cat-btn <?= $cat['category_id'] == $activeCatId ? 'active' : '' ?>"
                    data-cat-id="<?= $cat['category_id'] ?>"
                    onclick="switchCategory(this, <?= $cat['category_id'] ?>)">
                    <span class="cat-icon"><?= $icons[$cat['category_id']] ?? '🍽️' ?></span>
                    <span data-t="cat_<?= $cat['category_id'] ?>"><?= htmlspecialchars($cat['name']) ?></span>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Product Grid -->
        <div class="product-grid-wrapper" id="product-grid-wrapper">
            <?php foreach ($categories as $cat):
                $catId = $cat['category_id'];
                $prods = $productsByCategory[$catId] ?? [];
                ?>
                <div class="product-grid category-group <?= $catId == $activeCatId ? '' : 'hidden' ?>"
                    data-cat-id="<?= $catId ?>">
                    <?php foreach ($prods as $prod):
                        $diet = $dietMap[$prod['product_id']] ?? 'vegan';
                        $dietLabel = $diet === 'vegan' ? 'VEGAN' : 'VEGA';
                        $dietClass = $diet === 'vegan' ? 'badge-vegan' : 'badge-vega';
                        ?>
                        <div class="product-card" id="card-<?= $prod['product_id'] ?>">
                            <div class="card-img-wrapper" style="position:relative;">
                                <img src="<?= htmlspecialchars($prod['image'] ?? 'assets/img/logo.png') ?>"
                                    alt="<?= htmlspecialchars($prod['name']) ?>" class="card-img">
                                <span class="diet-badge <?= $dietClass ?>" data-t="diet_<?= $diet ?>"><?= $dietLabel ?></span>
                            </div>
                            <div class="card-body">
                                <div>
                                    <div class="card-name"><?= htmlspecialchars($prod['name']) ?></div>
                                    <div class="card-desc" data-t-desc="<?= $prod['product_id'] ?>">
                                        <?= htmlspecialchars($prod['description'] ?? '') ?>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <span
                                        class="card-price">&euro;&nbsp;<?= number_format($prod['price'], 2, ',', '.') ?></span>
                                    <button class="btn-add"
                                        onclick="addToCart(<?= $prod['product_id'] ?>, '<?= addslashes($prod['name']) ?>', <?= $prod['price'] ?>, '<?= addslashes($prod['image'] ?? 'assets/img/logo.png') ?>')"
                                        data-t="add">Add</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Bottom Cart Bar (hidden until items added) -->
    <div class="cart-bar hidden" id="cart-bar">
        <div class="cart-bar-info">
            <span class="cart-bar-count" id="cart-bar-count">0</span>
            <span data-t="items_in_order">items in your order</span>
            <span class="cart-bar-total" id="cart-bar-total">&euro;&nbsp;0,00</span>
        </div>
        <div class="cart-bar-actions">
            <button class="btn-cancel" onclick="cancelOrder()" data-t="cancel_order">Cancel Order</button>
            <button class="btn-orange" onclick="goToCheckout()" data-t="view_order">View Order</button>
        </div>
    </div>
</div><?php include 'assets/includes/footer.php'; ?>
<?php
include 'assets/includes/conn.php';

// Fetch some product images for the slideshow
$stmt = $conn->query("
    SELECT i.filename
    FROM images i
    JOIN products p ON p.image_id = i.image_id
    WHERE p.available = 1
    ORDER BY RAND()
    LIMIT 6
");
$slideImages = $stmt->fetchAll(PDO::FETCH_COLUMN);
?>
<?php include 'assets/includes/header.php'; ?>

<div class="idle-screen" id="idle-screen">
    <!-- Language flags -->
    <div class="lang-flags">
        <img src="assets/img/flag_nl.png" alt="Nederlands" title="Nederlands" onclick="setLanguage('nl')">
        <img src="assets/img/flag_uk.png" alt="English" title="English" onclick="setLanguage('en')">
    </div>

    <!-- Logo -->
    <img src="assets/img/logo.png" alt="Happy Herbivore" class="idle-logo">

    <!-- Food Slideshow -->
    <div class="slideshow" id="slideshow">
        <?php foreach ($slideImages as $i => $img): ?>
            <img src="<?= htmlspecialchars($img) ?>" alt="Delicious food" class="slide <?= $i === 0 ? 'active' : '' ?>">
        <?php endforeach; ?>
    </div>

    <!-- Start Order Button -->
    <a href="menu.php" class="btn-start" id="btn-start" data-t="start_order">Start Your Order</a>

    <!-- Tagline -->
    <p class="idle-tagline" data-t="tagline">Healthy in a Hurry</p>
</div>

<?php include 'assets/includes/footer.php'; ?>
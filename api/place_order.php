<?php
/**
 * POST /api/place_order.php
 * Body JSON: { items: [{id, name, price, qty, image}], payment_method: "card"|"cash" }
 * Returns:  { success, pickup_number, order_id, total }
 */
header('Content-Type: application/json');

require_once __DIR__ . '/../assets/includes/conn.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (!$input || empty($input['items'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'No items provided']);
    exit;
}

$items = $input['items'];
$paymentMethod = $input['payment_method'] ?? 'card';

try {
    $conn->beginTransaction();

    // Calculate total
    $subtotal = 0;
    foreach ($items as $item) {
        $subtotal += floatval($item['price']) * intval($item['qty']);
    }
    $tax = round($subtotal * 0.09, 2); // 9% BTW
    $total = round($subtotal + $tax, 2);

    // Generate pickup number: next number today (1-99 cycling)
    $today = date('Y-m-d');
    $pickupStmt = $conn->prepare("
        SELECT COALESCE(MAX(pickup_number), 0) + 1 AS next_num
        FROM orders
        WHERE order_date = :today
    ");
    $pickupStmt->execute([':today' => $today]);
    $pickupNumber = intval($pickupStmt->fetchColumn());
    if ($pickupNumber > 99)
        $pickupNumber = 1;

    // Insert order
    $orderStmt = $conn->prepare("
        INSERT INTO orders (order_status_id, pickup_number, price_total, payment_method, is_paid, order_date)
        VALUES (2, :pickup, :total, :payment, 1, :order_date)
    ");
    $orderStmt->execute([
        ':pickup' => $pickupNumber,
        ':total' => $total,
        ':payment' => $paymentMethod,
        ':order_date' => $today,
    ]);
    $orderId = $conn->lastInsertId();

    // Insert order products
    $prodStmt = $conn->prepare("
        INSERT INTO order_product (order_id, product_id, product_name, price, quantity)
        VALUES (:order_id, :product_id, :product_name, :price, :quantity)
    ");
    foreach ($items as $item) {
        $prodStmt->execute([
            ':order_id' => $orderId,
            ':product_id' => intval($item['id']),
            ':product_name' => $item['name'],
            ':price' => floatval($item['price']),
            ':quantity' => intval($item['qty']),
        ]);
    }

    $conn->commit();

    echo json_encode([
        'success' => true,
        'order_id' => intval($orderId),
        'pickup_number' => $pickupNumber,
        'total' => $total,
    ]);

} catch (Exception $e) {
    $conn->rollBack();
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}

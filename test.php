<?php
// 1. GRAMMAR, COMMENTS, VARIABLES & CONSTANTS
const CURRENCY = "VND";
const MEMBER_DISCOUNT_RATE = 0.10;
const MEMBER_MIN_FEE = 100000;
const PACKAGING_FEE = 2000;
const SERVICE_RATE = 0.05;

$drinkName = "Bear Coffee";
$unitPrice = 40000;
$rawQuantity = "4";
$customerStatus = "MEMBER";
$productAvailable = true;

// 2. TYPE INSPECTION
echo "KIỂM TRA KIỂU DỮ LIỆU ĐẦU VÀO" . PHP_EOL;
var_dump($drinkName);
var_dump($unitPrice);
var_dump($rawQuantity);
var_dump($customerStatus);
var_dump($productAvailable);

// 3. EXPLICIT CASTING
$quantity = (int)$rawQuantity;
echo "Giá trị quantity sau ép kiểu: ";
var_dump($quantity);
echo "Kiểu dữ liệu trước ép kiểu: " . gettype($rawQuantity) . PHP_EOL;
echo "Kiểu dữ liệu sau ép kiểu: " . gettype($quantity) . PHP_EOL;

// 4. ARITHMETIC: SUBTOTAL
$subtotal = $unitPrice * $quantity;
echo "Subtotal: " . $subtotal . " " . CURRENCY . PHP_EOL;

// 5. STRICT COMPARISON + LOGICAL AND
$isMember = ($customerStatus === "MEMBER");
$isEligibleDiscount = $isMember && ($subtotal >= MEMBER_MIN_FEE);
$discount = $isEligibleDiscount ? ($subtotal * MEMBER_DISCOUNT_RATE) : 0;

// 6. PACKAGING FEE, SERVICE FEE & TOTAL
$packagingFee = $quantity * PACKAGING_FEE;
$priceAfterDiscount = $subtotal - $discount;
$serviceFee = $priceAfterDiscount * SERVICE_RATE;
$total = $priceAfterDiscount + $packagingFee + $serviceFee;

// 7. CHECKOUT GATE
$hasValidQuantity = ($quantity > 0);
$isValidCustomer = ($customerStatus === "MEMBER") || ($customerStatus === "GUEST");
$canOrder = $hasValidQuantity && $productAvailable && $isValidCustomer;
var_dump($canOrder);

// 8. CONCATENATION: TẠO RECEIPT CHUỖI VĂN BẢN
$receipt = "HOA DON CUA HANG SMARTCAFE" . PHP_EOL;
$receipt .= "Product: " . $drinkName . PHP_EOL;
$receipt .= "Unit Price: " . $unitPrice . " " . CURRENCY . PHP_EOL;
$receipt .= "Quantity: " . $quantity . PHP_EOL;
$receipt .= "Subtotal: " . $subtotal . " " . CURRENCY . PHP_EOL;
$receipt .= "Discount: " . $discount . " " . CURRENCY . PHP_EOL;
$receipt .= "Packaging Fee: " . $packagingFee . " " . CURRENCY . PHP_EOL;
$receipt .= "Service Fee: " . $serviceFee . " " . CURRENCY . PHP_EOL;
$receipt .= "Total: " . $total . " " . CURRENCY . PHP_EOL;
if ($canOrder) {
    $receipt .= "Status: READY TO ORDER" . PHP_EOL;
} else {
    $receipt .= "Status: BLOCKED" . PHP_EOL;
}
echo $receipt;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QuickCheckout</title>
</head>
<body>
    <h1>QuickCheckOrder</h1>
    <p>Product: <?= $drinkName ?></p>
    <p>Quantity: <?= $quantity ?></p>
    <p>Total: <?= $total ?> <?= CURRENCY ?></p>
</body>
</html>
<?php
$quantity = (int)$rawQuantity;

$subtotal = $unitPrice * $quantity;

$isMember = ($customerStatus === "MEMBER");
$isEligibleDiscount = $isMember && ($subtotal >= MEMBER_MIN_FEE);
$discount = $isEligibleDiscount ? ($subtotal * MEMBER_DISCOUNT_RATE) : 0;

$packagingFee = $quantity * PACKAGING_FEE_PER_ITEM;
$priceAfterDiscount = $subtotal - $discount;
$serviceFee = $priceAfterDiscount * SERVICE_RATE;

$total = $priceAfterDiscount + $packagingFee + $serviceFee;

$hasValidQuantity = ($quantity > 0);
$isValidCustomer = ($customerStatus === "MEMBER") || ($customerStatus === "GUEST");
$canOrder = $hasValidQuantity && $productAvailable && $isValidCustomer;
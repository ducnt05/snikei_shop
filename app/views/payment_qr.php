<?php
$paymentQr = $paymentQr ?? [];
$totalPrice = (float) ($paymentQr['total_price'] ?? 0);
$bankName = (string) ($paymentQr['bank_name'] ?? 'TECHCOMBANK');
$accountName = (string) ($paymentQr['account_name'] ?? 'NGUYEN ANH DUC');
$accountNumber = (string) ($paymentQr['account_number'] ?? '33027102005');
$note = (string) ($paymentQr['note'] ?? 'Thanh toan don hang SNIKEI');
$qrImageUrl = 'https://img.vietqr.io/image/' . rawurlencode($bankName) . '-' . rawurlencode($accountNumber) . '-compact2.png?amount=' . rawurlencode((string) round($totalPrice)) . '&addInfo=' . rawurlencode($note) . '&accountName=' . rawurlencode($accountName);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán QR</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_checkout_qr.css">
</head>
<body>
    <main class="qr-page">
        <section class="qr-card">
            <div class="qr-header">
                <p>Quét mã để chuyển tiền</p>
                <h1><?= htmlspecialchars($accountName, ENT_QUOTES, 'UTF-8') ?></h1>
                <div class="qr-subtitle"><?= htmlspecialchars($bankName, ENT_QUOTES, 'UTF-8') ?> · <?= htmlspecialchars($accountNumber, ENT_QUOTES, 'UTF-8') ?></div>
            </div>

            <div class="qr-amount">
                <span>Số tiền cần thanh toán</span>
                <strong>$<?= number_format($totalPrice, 0, ',', '.') ?></strong>
            </div>

            <div class="qr-box">
                <img src="<?= htmlspecialchars($qrImageUrl, ENT_QUOTES, 'UTF-8') ?>" alt="QR thanh toán">
            </div>

            <div class="qr-note">
                Nội dung chuyển khoản: <strong><?= htmlspecialchars($note, ENT_QUOTES, 'UTF-8') ?></strong>
            </div>

            <div class="qr-actions">
                <form action="<?= BASE_URL ?>/checkout/paid" method="POST">
                    <button type="submit" class="btn-paid">Đã thanh toán</button>
                </form>
                <a class="btn-home" href="<?= BASE_URL ?>">Về trang chủ</a>
            </div>

            <p class="qr-helper">Sau khi bạn chuyển khoản xong, bấm “Đã thanh toán” để quay về Home.</p>
        </section>
    </main>
</body>
</html>
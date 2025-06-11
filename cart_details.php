<?php
include 'includes/session.php';
$conn = $pdo->open();
$output = '';

if (isset($_SESSION['user'])) {
    try {
        // Sync session cart to database
        if (isset($_SESSION['cart'])) {
            $stmt = $conn->prepare("SELECT id FROM users WHERE id = :id");
            $stmt->execute(['id' => $_SESSION['user']]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$user) {
                $output = '<tr><td colspan="6">Invalid user session.</td></tr>';
                echo $output;
                exit;
            }

            foreach ($_SESSION['cart'] as $row) {
                $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM cart WHERE user_id = :user_id AND product_id = :product_id");
                $stmt->execute(['user_id' => $user['id'], 'product_id' => $row['productid']]);
                $crow = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($crow['numrows'] < 1) {
                    $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
                    $stmt->execute(['user_id' => $user['id'], 'product_id' => $row['productid'], 'quantity' => $row['quantity']]);
                } else {
                    $stmt = $conn->prepare("UPDATE cart SET quantity = :quantity WHERE user_id = :user_id AND product_id = :product_id");
                    $stmt->execute(['quantity' => $row['quantity'], 'user_id' => $user['id'], 'product_id' => $row['productid']]);
                }
            }
            unset($_SESSION['cart']);
        }

        // Fetch cart items
        $total = 0;
        $stmt = $conn->prepare("
            SELECT cart.id AS cartid, cart.quantity, products.name, products.price, products.photo
            FROM cart
            LEFT JOIN products ON products.id = cart.product_id
            WHERE cart.user_id = :user_id
        ");
        $stmt->execute(['user_id' => $_SESSION['user']]);
        $default_image = 'https://res.cloudinary.com/hipnfoaz7/image/upload/v1234567890/products/noimage.jpg';
        
        if ($stmt->rowCount() === 0) {
            $output = '<tr><td colspan="6">Your cart is empty.</td></tr>';
        } else {
            foreach ($stmt as $row) {
                $image_url = !empty($row['photo']) && strpos($row['photo'], 'cloudinary.com') !== false
                    ? htmlspecialchars(str_replace('/upload/', '/upload/w_100,h_100,c_fill,f_auto,q_auto/', $row['photo']), ENT_QUOTES, 'UTF-8')
                    : $default_image;
                $subtotal = $row['price'] * $row['quantity'];
                $total += $subtotal;
                $output .= "
                    <tr>
                        <td><button type='button' data-id='{$row['cartid']}' class='btn btn-danger btn-flat cart_delete'><i class='fa fa-remove'></i></button></td>
                        <td><img src='{$image_url}' width='100' height='100' alt='".htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8')."'></td>
                        <td>".htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8')."</td>
                        <td>₦".number_format($row['price'], 2)."</td>
                        <td class='input-group'>
                            <span class='input-group-btn'>
                                <button type='button' class='btn btn-default btn-flat minus' data-id='{$row['cartid']}'><i class='fa fa-minus'></i></button>
                            </span>
                            <input type='text' class='form-control' value='{$row['quantity']}' id='qty_{$row['cartid']}'>
                            <span class='input-group-btn'>
                                <button type='button' class='btn btn-default btn-flat add' data-id='{$row['cartid']}'><i class='fa fa-plus'></i></button>
                            </span>
                        </td>
                        <td>₦".number_format($subtotal, 2)."</td>
                    </tr>
                ";
            }
            $output .= "
                <tr>
                    <td colspan='5' align='right'><b>Total</b></td>
                    <td><b>₦".number_format($total, 2)."</b></td>
                </tr>
            ";
        }
    } catch (PDOException $e) {
        $output = '<tr><td colspan="6">Error loading cart: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</td></tr>';
    }
} else {
    // Guest cart
    if (!empty($_SESSION['cart'])) {
        try {
            $total = 0;
            $product_ids = array_column($_SESSION['cart'], 'productid');
            $placeholders = implode(',', array_fill(0, count($product_ids), '?'));
            $stmt = $conn->prepare("
                SELECT id, name, price, photo
                FROM products
                WHERE id IN ($placeholders)
            ");
            $stmt->execute($product_ids);
            $products = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $products[$row['id']] = $row;
            }
            
            $default_image = 'https://res.cloudinary.com/hipnfoaz7/image/upload/v1234567890/products/noimage.jpg';
            foreach ($_SESSION['cart'] as $row) {
                if (!isset($products[$row['productid']])) {
                    continue;
                }
                $product = $products[$row['productid']];
                $image_url = !empty($product['photo']) && strpos($product['photo'], 'cloudinary.com') !== false
                    ? htmlspecialchars(str_replace('/upload/', '/upload/w_100,h_100,c_fill,f_auto,q_auto/', $product['photo']), ENT_QUOTES, 'UTF-8')
                    : $default_image;
                $subtotal = $product['price'] * $row['quantity'];
                $total += $subtotal;
                $output .= "
                    <tr>
                        <td><button type='button' data-id='{$row['productid']}' class='btn btn-danger btn-flat cart_delete'><i class='fa fa-remove'></i></button></td>
                        <td><img src='{$image_url}' width='100' height='100' alt='".htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8')."'></td>
                        <td>".htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8')."</td>
                        <td>₦".number_format($product['price'], 2)."</td>
                        <td class='input-group'>
                            <span class='input-group-btn'>
                                <button type='button' class='btn btn-default btn-flat minus' data-id='{$row['productid']}'><i class='fa fa-minus'></i></button>
                            </span>
                            <input type='text' class='form-control' value='{$row['quantity']}' id='qty_{$row['productid']}'>
                            <span class='input-group-btn'>
                                <button type='button' class='btn btn-default btn-flat add' data-id='{$row['productid']}'><i class='fa fa-plus'></i></button>
                            </span>
                        </td>
                        <td>₦".number_format($subtotal, 2)."</td>
                    </tr>
                ";
            }
            $output .= "
                <tr>
                    <td colspan='5' align='right'><b>Total</b></td>
                    <td><b>₦".number_format($total, 2)."</b></td>
                </tr>
            ";
        } catch (PDOException $e) {
            $output = '<tr><td colspan="6">Error loading cart: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</td></tr>';
        }
    } else {
        $output = '<tr><td colspan="6">Shopping cart empty</td></tr>';
    }
}

$pdo->close();
echo $output;
?>

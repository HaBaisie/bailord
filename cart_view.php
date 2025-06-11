<?php
include 'includes/session.php';
$conn = $pdo->open();
$user_email = 'customer@example.com';
if (isset($_SESSION['user'])) {
    try {
        $stmt = $conn->prepare("SELECT email FROM users WHERE id = :id");
        $stmt->execute(['id' => $_SESSION['user']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $user_email = htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8');
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Database error: Unable to fetch user email.';
    }
}
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
    <?php include 'includes/navbar.php'; ?>
    <div class="content-wrapper">
        <div class="container">
            <section class="content">
                <div class="row">
                    <div class="col-sm-9">
                        <h1 class="page-header">YOUR CART</h1>
                        <?php
                        if (isset($_SESSION['error'])) {
                            echo "<div class='alert alert-danger'>" . htmlspecialchars($_SESSION['error']) . "</div>";
                            unset($_SESSION['error']);
                        }
                        if (isset($_GET['payment'])) {
                            $payment = htmlspecialchars($_GET['payment']);
                            if ($payment === 'success') {
                                echo "<div class='alert alert-success'>Payment successful! Your cart has been cleared.</div>";
                            } elseif ($payment === 'failed') {
                                echo "<div class='alert alert-danger'>Payment failed. Please try again.</div>";
                            }
                        }
                        ?>
                        <div class="box box-solid">
                            <div class="box-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <th></th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th width="20%">Quantity</th>
                                        <th>Subtotal</th>
                                    </thead>
                                    <tbody id="tbody"></tbody>
                                </table>
                            </div>
                        </div>
                        <?php
                        if (isset($_SESSION['user'])) {
                            echo "<div id='paystack-button'>
                                    <button id='paystack-checkout' class='btn btn-primary'>Checkout with Paystack</button>
                                  </div>";
                        } else {
                            echo "<h4>You need to <a href='login.php'>Login</a> to checkout.</h4>";
                        }
                        ?>
                    </div>
                    <div class="col-sm-3">
                        <?php include 'includes/sidebar.php'; ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php $pdo->close(); ?>
    <?php include 'includes/footer.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
var total = 0;
$(function(){
    $(document).on('click', '.cart_delete', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: 'cart_delete.php',
            data: {id: id},
            dataType: 'json',
            success: function(response){
                if (!response.error) {
                    getDetails();
                    getCart();
                    getTotal();
                } else {
                    alert('Error deleting item: ' + (response.message || 'Unknown error'));
                }
            },
            error: function(xhr, status, error) {
                console.error('Cart delete error:', error);
                alert('Failed to delete item.');
            }
        });
    });

    $(document).on('click', '.minus', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var qty = parseInt($('#qty_' + id).val()) || 1;
        if (qty > 1) {
            qty--;
            $('#qty_' + id).val(qty);
            updateCart(id, qty);
        }
    });

    $(document).on('click', '.add', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var qty = parseInt($('#qty_' + id).val()) || 1;
        qty++;
        $('#qty_' + id).val(qty);
        updateCart(id, qty);
    });

    function updateCart(id, qty) {
        $.ajax({
            type: 'POST',
            url: 'cart_update.php',
            data: {id: id, qty: qty},
            dataType: 'json',
            success: function(response){
                if (!response.error) {
                    getDetails();
                    getCart();
                    getTotal();
                } else {
                    alert('Error updating quantity: ' + (response.message || 'Unknown error'));
                }
            },
            error: function(xhr, status, error) {
                console.error('Cart update error:', error);
                alert('Failed to update quantity.');
            }
        });
    }

    getDetails();
    getTotal();

    $('#paystack-checkout').on('click', function(e){
        e.preventDefault();
        if (total <= 0) {
            alert('Your cart is empty.');
            return;
        }
        var handler = PaystackPop.setup({
            key: 'pk_test_79848b3271a3d80eef6a4c34d9d84f00d7a46dcb',
            email: '<?php echo $user_email; ?>',
            amount: total * 100,
            currency: 'NGN',
            callback: function(response) {
                window.location.href = 'sales.php?reference=' + encodeURIComponent(response.reference);
            },
            onClose: function() {
                alert('Payment window closed.');
            }
        });
        handler.openIframe();
    });
});

function getDetails() {
    $.ajax({
        type: 'POST',
        url: 'cart_details.php',
        dataType: 'html',
        success: function(response) {
            $('#tbody').html(response);
            getCart();
        },
        error: function(xhr, status, error) {
            console.error('Error fetching cart details:', error);
            $('#tbody').html('<tr><td colspan="6">Failed to load cart.</td></tr>');
        }
    });
}

function getTotal() {
    $.ajax({
        type: 'POST',
        url: 'cart_total.php',
        dataType: 'json',
        success: function(response) {
            total = response.total || 0;
        },
        error: function(xhr, status, error) {
            console.error('Error fetching total:', error);
            total = 0;
        }
    });
}
</script>
<script src="https://js.paystack.co/v1/inline.js"></script>
</body>
</html>

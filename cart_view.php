<?php
include 'includes/session.php';
$conn = $pdo->open();
$user_email = 'customer@example.com';
if (isset($_SESSION['user'])) {
    $stmt = $conn->prepare("SELECT email FROM users WHERE id = :id");
    $stmt->execute(['id' => $_SESSION['user']]);
    $user = $stmt->fetch();
    if ($user) {
        $user_email = $user['email'];
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
                        if (isset($_GET['payment'])) {
                            if ($_GET['payment'] === 'success') {
                                echo "<div class='alert alert-success'>Payment successful! Your cart has been cleared.</div>";
                            } elseif ($_GET['payment'] === 'failed') {
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
                                    <tbody id="tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php
                        if (isset($_SESSION['user'])) {
                            echo "
                                <div id='paystack-button'>
                                    <button id='paystack-checkout' class='btn btn-primary'>Checkout with Paystack</button>
                                </div>
                            ";
                        } else {
                            echo "
                                <h4>You need to <a href='login.php'>Login</a> to checkout.</h4>
                            ";
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
            data: {id:id},
            dataType: 'json',
            success: function(response){
                if(!response.error){
                    getDetails();
                    getCart();
                    getTotal();
                }
            }
        });
    });

    $(document).on('click', '.minus', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var qty = $('#qty_'+id).val();
        if(qty>1){
            qty--;
        }
        $('#qty_'+id).val(qty);
        $.ajax({
            type: 'POST',
            url: 'cart_update.php',
            data: {
                id: id,
                qty: qty,
            },
            dataType: 'json',
            success: function(response){
                if(!response.error){
                    getDetails();
                    getCart();
                    getTotal();
                }
            }
        });
    });

    $(document).on('click', '.add', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var qty = $('#qty_'+id).val();
        qty++;
        $('#qty_'+id).val(qty);
        $.ajax({
            type: 'POST',
            url: 'cart_update.php',
            data: {
                id: id,
                qty: qty,
            },
            dataType: 'json',
            success: function(response){
                if(!response.error){
                    getDetails();
                    getCart();
                    getTotal();
                }
            }
        });
    });

    getDetails();
    getTotal();

    // Paystack Checkout
    $('#paystack-checkout').on('click', function(e){
        e.preventDefault();
        var handler = PaystackPop.setup({
            key: 'pk_test_79848b3271a3d80eef6a4c34d9d84f00d7a46d6b', // Test Public Key
            email: '<?php echo htmlspecialchars($user_email); ?>',
            amount: total * 100, // NGN in kobo
            currency: 'NGN',
            callback: function(response){
                window.location='sales.php?reference=' + response.reference;
            },
            onClose: function(){
                alert('Payment window closed.');
            }
        });
        handler.openIframe();
    });
});

function getDetails(){
    $.ajax({
        type: 'POST',
        url: 'cart_details.php',
        dataType: 'json',
        success: function(response){
            $('#tbody').html(response);
            getCart();
        }
    });
}

function getTotal(){
    $.ajax({
        type: 'POST',
        url: 'cart_total.php',
        dataType: 'json',
        success: function(response){
            total = response;
        }
    });
}
</script>
<script src="https://js.paystack.co/v1/inline.js"></script>
</body>
</html>
</xai>

**Changes**:
- Removed `$_SESSION['user']['id']` checks.
- Queries `users` for email.
- Fixed Paystack key (corrected typo).
- Ensured redirect to `sales.php`.

#### 3. profile.php (Sample)
Displays user orders with tracking features.

<xaiArtifact artifact_id="39ea8753-ad99-45eb-894c-a4fa0d9f874e" artifact_version_id="2f2ddba3-70b1-47e3-a599-1ee57243acb3" title="profile.php" contentType="text/php">
<?php
include 'includes/session.php';
if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = 'Please log in to view your profile';
    header('location: login.php');
    exit;
}
$conn = $pdo->open();
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
    <?php include 'includes/navbar.php'; ?>
    <div class="content-wrapper">
        <div class="container">
            <section class="content">
                <?php
                if (isset($_SESSION['error'])) {
                    echo "<div class='alert alert-danger'>".htmlspecialchars($_SESSION['error'])."</div>";
                    unset($_SESSION['error']);
                }
                if (isset($_SESSION['success'])) {
                    echo "<div class='alert alert-success'>".htmlspecialchars($_SESSION['success'])."</div>";
                    unset($_SESSION['success']);
                }
                ?>
                <h2>Your Orders</h2>
                <div class="box">
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Location</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $conn->prepare("
                                    SELECT s.id, s.sales_date, s.status, s.location, s.pay_id,
                                           COALESCE(SUM(d.quantity * d.price), 0) as total
                                    FROM sales s
                                    LEFT JOIN details d ON d.sales_id = s.id
                                    WHERE s.user_id = :user_id
                                    GROUP BY s.id
                                    ORDER BY s.sales_date DESC
                                ");
                                $stmt->execute(['user_id' => $_SESSION['user']]);
                                foreach ($stmt as $row) {
                                    $map_button = ($row['status'] == 'approved' && $row['location']) ? '
                                        <button class="btn btn-sm btn-primary show-map" data-location="' . htmlspecialchars($row['location']) . '">View Map</button>
                                    ' : '-';
                                    echo "
                                        <tr>
                                            <td>" . $row['id'] . "</td>
                                            <td>" . date('M d, Y', strtotime($row['sales_date'])) . "</td>
                                            <td>$" . number_format($row['total'], 2) . "</td>
                                            <td>" . ucfirst($row['status']) . "</td>
                                            <td>" . ($row['location'] ? htmlspecialchars($row['location']) : '-') . "</td>
                                            <td>" . $map_button . "</td>
                                        </tr>
                                    ";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="map" style="height:400px; display:none; width:100%;"></div>
            </section>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</div>
<?php $pdo->close(); ?>
<?php include 'includes/scripts.php'; ?>
<script src="https://maps.googleapis.com/maps/api/js?key=your-google-maps-api-key&libraries=places"></script>
<script>
$(function(){
    $('.show-map').click(function(){
        var location = $(this).data('location');
        $('#map').show();
        initMap(location);
    });
});

function initMap(location) {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: {lat: 6.5244, lng: 3.3792} // Default: Lagos
    });
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({'address': location}, function(results, status) {
        if (status === 'OK') {
            map.setCenter(results[0].geometry.location);
            new google.maps.Marker({
                map: map,
                position: results[0].geometry.location,
                title: location
            });
        } else {
            alert('Geocode failed: ' + status);
            $('#map').hide();
        }
    });
}
</script>
</body>
</html>

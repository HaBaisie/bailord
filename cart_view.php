<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
     
      <div class="content-wrapper">
        <div class="container">

          <!-- Main content -->
          <section class="content">
            <div class="row">
                <div class="col-sm-9">
                    <h1 class="page-header">YOUR CART</h1>
                    <?php
                        // Display payment status message
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
                        if(isset($_SESSION['user'])){
                            echo "
                                <div id='paystack-button'>
                                    <button id='paystack-checkout' class='btn btn-primary'>Checkout with Paystack</button>
                                </div>
                            ";
                        }
                        else{
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
            key: 'pk_test_79848b3271a3d80eef6a4c34d9d84f00d7a46dcb', // Test Public Key
            email: '<?php echo isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : 'customer@example.com'; ?>', // Replace with actual user email
            amount: total * 100, // Convert total to kobo (assuming total is in NGN)
            currency: 'NGN', // Adjust if using another currency
            callback: function(response){
                // Redirect to sales.php with Paystack reference
                window.location = 'sales.php?reference=' + response.reference;
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
<!-- Paystack SDK -->
<script src="https://js.paystack.co/v1/inline.js"></script>
</body>
</html>

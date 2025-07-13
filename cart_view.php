```php
<?php
include 'includes/session.php';
$conn = $pdo->open();
$user_email = 'customer@example.com';
$user_id = isset($_SESSION['user']) ? $_SESSION['user'] : null;
if ($user_id) {
    try {
        $stmt = $conn->prepare("SELECT email, firstname FROM users WHERE id = :id");
        $stmt->execute(['id' => $user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $user_email = htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8');
            $user_firstname = htmlspecialchars($user['firstname'], ENT_QUOTES, 'UTF-8');
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Database error: Unable to fetch user details.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bailord</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Bailord eCommerce Template">
    <meta name="author" content="Your Name">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/icons/favicon-16x16.png">
    <link rel="manifest" href="assets/images/icons/site.webmanifest">
    <link rel="mask-icon" href="assets/images/icons/safari-pinned-tab.svg" color="#666666">
    <link rel="shortcut icon" href="assets/images/icons/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Bailord">
    <meta name="application-name" content="Bailord">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/plugins/jquery.countdown.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/skins/skin-demo-4.css">
    <link rel="stylesheet" href="assets/css/demos/demo-4.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
    <!-- Preload critical resources -->
    <link rel="preload" href="assets/css/bootstrap.min.css" as="style">
    <link rel="preload" href="assets/css/style.css" as="style">
    <!-- Updated preload paths -->
    <link rel="preload" href="https://bailord-0b4b2667ca4f.herokuapp.com/assets/js/jquery.min.js" as="script">
    <link rel="preload" href="https://bailord-0b4b2667ca4f.herokuapp.com/assets/js/bootstrap.bundle.min.js" as="script">
    <!-- DNS prefetch for external resources -->
    <link rel="dns-prefetch" href="//unpkg.com">
    <style>
        /* ... (CSS remains unchanged) ... */
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ... (DOMContentLoaded script remains unchanged) ...
        });
    </script>
</head>
<body class="hold-transition skin-blue layout-top-nav">
<div class="page-wrapper">
    <!-- ... (HTML structure remains unchanged up to the <script> section) ... -->
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
    var total = 0;
    var deliveryCost = 0;

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

        // Initialize Leaflet map
        var map = L.map('map').setView([6.5244, 3.3792], 13); // Default to Lagos, Nigeria
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        $('#pickup-button').on('click', function(e){
            e.preventDefault();
            if (total <= 0) {
                alert('Your cart is empty.');
                return;
            }
            $.ajax({
                type: 'POST',
                url: 'save_location.php',
                data: { location: '2 Ijegun Rd, Ikotun 100265, Lagos, Nigeria', user_id: <?php echo json_encode($user_id); ?> },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        proceedToPaystack(total, response.sales_id);
                    } else {
                        alert('Error saving pickup location: ' + (response.message || 'Unknown error'));
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error saving pickup location:', error);
                    alert('Failed to save pickup location.');
                }
            });
        });

        $('#delivery-button').on('click', function(e){
            e.preventDefault();
            if (total <= 0) {
                alert('Your cart is empty.');
                return;
            }
            $('#delivery-form').toggleClass('visible');
        });

        function loginKwik() {
            return $.ajax({
                type: 'POST',
                url: 'login_kwik.php',
                data: { user_id: <?php echo json_encode($user_id); ?> },
                dataType: 'json'
            });
        }

        function callKwikApi(kwikPayload, sales_id, address, name, phone, latitude, longitude) {
            $.ajax({
                type: 'POST',
                url: 'https://staging-api-test.kwik.delivery/send_payment_for_task',
                data: JSON.stringify(kwikPayload),
                contentType: 'application/json',
                success: function(response) {
                    console.log('Kwik API response:', response);
                    if (response.status === 200 && response.data && response.data.amount) {
                        deliveryCost = response.data.amount;
                        var totalWithDelivery = total + deliveryCost;
                        // Create Kwik task
                        var taskPayload = {
                            domain_name: 'staging-client-panel.kwik.delivery',
                            access_token: kwikPayload.access_token,
                            vendor_id: kwikPayload.vendor_id,
                            is_multiple_tasks: true,
                            timezone: '-60',
                            has_pickup: true,
                            has_delivery: true,
                            layout_type: 0,
                            auto_assignment: 0,
                            pickups: [{
                                address: '2 Ijegun Rd, Ikotun 100265, Lagos, Nigeria',
                                name: 'Habeebullahi Lawal',
                                latitude: '6.4320951',
                                longitude: '3.274',
                                time: '2025-07-13 12:00:00',
                                phone: '+2348161589373',
                                email: '<?php echo $user_email; ?>',
                                template_data: [
                                    { label: 'baseFare', data: 300 },
                                    { label: 'distanceFare', data: 25 },
                                    { label: 'timeFare', data: 30 },
                                    { label: 'totalTimeTaken', data: 0 },
                                    { label: 'job_distance', data: 0 },
                                    { label: 'pricingType', data: 'variable' },
                                    { label: 'insuranceAmount', data: 0 }
                                ],
                                template_name: 'pricing-template',
                                ref_images: []
                            }],
                            deliveries: [{
                                address: address,
                                name: name,
                                latitude: latitude.toString(),
                                longitude: longitude.toString(),
                                time: '2025-07-13 13:00:00',
                                phone: phone,
                                email: '<?php echo $user_email; ?>',
                                template_data: [
                                    { label: 'baseFare', data: 300 },
                                    { label: 'distanceFare', data: 25 },
                                    { label: 'timeFare', data: 30 },
                                    { label: 'totalTimeTaken', data: 0 },
                                    { label: 'job_distance', data: 0 },
                                    { label: 'pricingType', data: 'variable' },
                                    { label: 'insuranceAmount', data: 0 }
                                ],
                                template_name: 'pricing-template',
                                ref_images: [],
                                is_package_insured: 0
                            }],
                            insurance_amount: response.data.insurance_amount || 0,
                            total_no_of_tasks: response.data.total_no_of_tasks || 1,
                            total_service_charge: response.data.total_service_charge || 0,
                            payment_method: 262144,
                            amount: deliveryCost,
                            is_loader_required: response.data.is_loader_required || 0,
                            loaders_amount: response.data.loaders_amount || 0,
                            loaders_count: response.data.loaders_count || 0,
                            delivery_instruction: response.data.delivery_instruction || 'Leave package at front desk',
                            vehicle_id: response.data.vehicle_id || 1,
                            delivery_images: response.data.delivery_images || '',
                            is_cod_job: 1,
                            surge_cost: 0,
                            surge_type: 0,
                            is_task_otp_required: 0
                        };
                        console.log('Creating Kwik task with payload:', taskPayload);
                        $.ajax({
                            type: 'POST',
                            url: 'https://staging-api-test.kwik.delivery/createTask',
                            data: JSON.stringify(taskPayload),
                            contentType: 'application/json',
                            success: function(taskResponse) {
                                console.log('Kwik task creation response:', taskResponse);
                                if (taskResponse.status === 200 && taskResponse.data && taskResponse.data.job_id) {
                                    // Save job_id and tracking links
                                    $.ajax({
                                        type: 'POST',
                                        url: 'save_kwik_job.php',
                                        data: {
                                            sales_id: sales_id,
                                            job_id: taskResponse.data.job_id,
                                            pickup_tracking_link: taskResponse.data.pickup_tracking_link || '',
                                            delivery_tracking_link: 'https://www.openstreetmap.org/?mlat=' + latitude + '&mlon=' + longitude + '#map=15/' + latitude + '/' + longitude
                                        },
                                        dataType: 'json',
                                        success: function(saveResponse) {
                                            if (saveResponse.success) {
                                                proceedToPaystack(totalWithDelivery, sales_id);
                                            } else {
                                                alert('Error saving Kwik job: ' + (saveResponse.message || 'Unknown error'));
                                            }
                                        },
                                        error: function(xhr, status, error) {
                                            console.error('Error saving Kwik job:', xhr.responseText);
                                            alert('Failed to save delivery job: ' + error);
                                        }
                                    });
                                } else {
                                    alert('Error creating delivery task: ' + (taskResponse.message || 'Unknown error'));
                                    console.error('Task creation failed:', taskResponse);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Kwik createTask error:', xhr.responseText);
                                alert('Failed to create delivery task: ' + error);
                            }
                        });
                    } else if (response.status === 101) {
                        // Session expired, try logging in
                        loginKwik().done(function(loginResponse) {
                            if (loginResponse.success && loginResponse.access_token) {
                                console.log('New access token:', loginResponse.access_token);
                                kwikPayload.access_token = loginResponse.access_token;
                                kwikPayload.vendor_id = loginResponse.vendor_id || kwikPayload.vendor_id;
                                // Retry the API call with new token
                                callKwikApi(kwikPayload, sales_id, address, name, phone, latitude, longitude);
                            } else {
                                console.error('Login failed:', loginResponse.message);
                                // Fallback to default delivery cost
                                deliveryCost = 1000;
                                var totalWithDelivery = total + deliveryCost;
                                alert('Unable to calculate delivery cost: ' + (response.message || 'Unknown error') + '. Using default delivery cost of ₦' + deliveryCost);
                                proceedToPaystack(totalWithDelivery, sales_id);
                            }
                        }).fail(function(xhr, status, error) {
                            console.error('Login error:', xhr.responseText);
                            // Fallback to default delivery cost
                            deliveryCost = 1000;
                            var totalWithDelivery = total + deliveryCost;
                            alert('Unable to calculate delivery cost: ' + (response.message || 'Unknown error') + '. Using default delivery cost of ₦' + deliveryCost);
                            proceedToPaystack(totalWithDelivery, sales_id);
                        });
                    } else {
                        var errorMsg = response.message || 'Unknown error';
                        if (response.errors) {
                            errorMsg += ' - ' + JSON.stringify(response.errors);
                        }
                        console.error('Kwik API error response:', response);
                        // Fallback to default delivery cost
                        deliveryCost = 1000;
                        var totalWithDelivery = total + deliveryCost;
                        alert('Unable to calculate delivery cost: ' + errorMsg + '. Using default delivery cost of ₦' + deliveryCost);
                        proceedToPaystack(totalWithDelivery, sales_id);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Kwik send_payment_for_task error:', xhr.responseText);
                    // Fallback to default delivery cost
                    deliveryCost = 1000;
                    var totalWithDelivery = total + deliveryCost;
                    alert('Unable to calculate delivery cost: ' + error + '. Using default delivery cost of ₦' + deliveryCost);
                    proceedToPaystack(totalWithDelivery, sales_id);
                }
            });
        }

        $('#delivery-address-form').on('submit', function(e){
            e.preventDefault();
            var name = $('#delivery-name').val().trim();
            var phone = $('#delivery-phone').val().trim();
            var address = $('#delivery-address').val().trim();
            if (!name || !phone || !address) {
                alert('Please fill in all delivery details.');
                return;
            }
            // Validate phone number format
            if (!/^\+234\d{10}$/.test(phone)) {
                alert('Please enter a valid phone number in the format +234xxxxxxxxxx');
                return;
            }
            // Geocode the delivery address using Mapbox
            $.ajax({
                type: 'GET',
                url: 'https://api.mapbox.com/geocoding/v5/mapbox.places/' + encodeURIComponent(address + ', Nigeria') + '.json',
                data: {
                    access_token: 'pk.eyJ1IjoiaGFiYWlzaWUiLCJhIjoiY21kMWpjcHp2MTVtajJtcW5kcmo2ZTJ2OCJ9.pS4iUcgLoJITbyg-1CXl5w'
                },
                success: function(geocodeResponse) {
                    if (geocodeResponse.features && geocodeResponse.features.length > 0) {
                        var location = geocodeResponse.features[0].center;
                        var longitude = location[0];
                        var latitude = location[1];
                        // Update map with marker
                        map.eachLayer(function(layer) {
                            if (layer instanceof L.Marker) {
                                map.removeLayer(layer);
                            }
                        });
                        L.marker([latitude, longitude]).addTo(map);
                        map.setView([latitude, longitude], 15);
                        // Save delivery address to sales table
                        $.ajax({
                            type: 'POST',
                            url: 'save_location.php',
                            data: {
                                location: address,
                                user_id: <?php echo json_encode($user_id); ?>
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (!response.success) {
                                    alert('Error saving delivery address: ' + (response.message || 'Unknown error'));
                                    return;
                                }
                                // Fetch access token from database
                                $.ajax({
                                    type: 'POST',
                                    url: 'get_kwik_token.php',
                                    data: { user_id: <?php echo json_encode($user_id); ?> },
                                    dataType: 'json',
                                    success: function(tokenResponse) {
                                        if (!tokenResponse.success || !tokenResponse.access_token) {
                                            alert('Error retrieving access token: ' + (tokenResponse.message || 'Unknown error'));
                                            return;
                                        }
                                        // Simplified payload for Kwik API
                                        var kwikPayload = {
                                            custom_field_template: 'pricing-template',
                                            access_token: tokenResponse.access_token,
                                            domain_name: 'staging-client-panel.kwik.delivery',
                                            vendor_id: 3552,
                                            auto_assignment: 0,
                                            layout_type: 0,
                                            has_pickup: 1,
                                            has_delivery: 1,
                                            is_multiple_tasks: 1,
                                            payment_method: 262144,
                                            form_id: 2,
                                            is_schedule_task: 0,
                                            pickups: [{
                                                address: '2 Ijegun Rd, Ikotun 100265, Lagos, Nigeria',
                                                email: '<?php echo $user_email; ?>',
                                                phone: '+2348161589373',
                                                latitude: '6.4320951',
                                                longitude: '3.274'
                                            }],
                                            deliveries: [{
                                                address: address,
                                                email: '<?php echo $user_email; ?>',
                                                phone: phone,
                                                latitude: latitude.toString(),
                                                longitude: longitude.toString(),
                                                is_package_insured: 0
                                            }],
                                            is_loader_required: 0,
                                            delivery_instruction: 'Leave package at front desk',
                                            is_cod_job: 1,
                                            parcel_amount: total
                                        };
                                        console.log('Sending Kwik API payload:', kwikPayload);
                                        callKwikApi(kwikPayload, response.sales_id, address, name, phone, latitude, longitude);
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('Error retrieving access token:', xhr.responseText);
                                        alert('Failed to retrieve access token: ' + error);
                                    }
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error('Error saving delivery address:', xhr.responseText);
                                alert('Failed to save delivery address: ' + error);
                            }
                        });
                    } else {
                        alert('Unable to geocode address. Please ensure the address is valid and includes a city in Nigeria.');
                        console.error('Geocoding response:', geocodeResponse);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Geocoding error:', xhr.responseText);
                    alert('Failed to geocode address: ' + error);
                }
            });
        });

        function proceedToPaystack(amount, sales_id) {
            var handler = PaystackPop.setup({
                key: 'pk_test_79848b3271a3d80eef6a4c34d9d84f00d7a46dcb',
                email: '<?php echo $user_email; ?>',
                amount: amount * 100,
                currency: 'NGN',
                metadata: { sales_id: sales_id },
                callback: function(response) {
                    window.location.href = 'sales.php?reference=' + encodeURIComponent(response.reference);
                },
                onClose: function() {
                    alert('Payment window closed.');
                }
            });
            handler.openIframe();
        }

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
    });
    </script>
</div>
</body>
</html>

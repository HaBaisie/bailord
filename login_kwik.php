<?php
include 'includes/session.php';

$conn = $pdo->open();
$response = ['success' => false, 'message' => 'Unknown error'];

try {
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;
    if (!$user_id) {
        $response['message'] = 'User ID not provided';
        echo json_encode($response);
        exit;
    }

    // Vendor credentials (replace with actual values from Kwik)
    $vendor_email = 'your_vendor_email@example.com'; // Provided by Kwik
    $vendor_password = 'your_vendor_password'; // Provided by Kwik
    $domain_name = 'staging-client-panel.kwik.delivery';

    // Call Kwik login API
    $loginPayload = [
        'email' => $vendor_email,
        'password' => $vendor_password,
        'domain_name' => $domain_name,
        'api_login' => 1
    ];

    $ch = curl_init('https://staging-api-test.kwik.delivery/login');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($loginPayload));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
    $curl_response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($curl_response === false) {
        $response['message'] = 'Failed to connect to Kwik API';
        echo json_encode($response);
        exit;
    }

    $data = json_decode($curl_response, true);
    if ($http_code === 200 && isset($data['data']['access_token'])) {
        // Update token in database
        $stmt = $conn->prepare("INSERT INTO kwik_tokens (user_id, vendor_id, access_token) VALUES (:user_id, :vendor_id, :access_token)");
        $stmt->execute([
            'user_id' => $user_id,
            'vendor_id' => 3552, // Replace if different
            'access_token' => $data['data']['access_token']
        ]);

        $response['success'] = true;
        $response['access_token'] = $data['data']['access_token'];
        $response['vendor_id'] = isset($data['data']['vendor_id']) ? $data['data']['vendor_id'] : 3552;
        echo json_encode($response);
    } else {
        $response['message'] = isset($data['message']) ? $data['message'] : 'Failed to login';
        echo json_encode($response);
    }
} catch (PDOException $e) {
    $response['message'] = 'Database error: ' . $e->getMessage();
    echo json_encode($response);
} finally {
    $pdo->close();
}
?>
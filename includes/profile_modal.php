<?php
// Ensure $user is available; include session if not already included
if (!isset($user)) {
    include 'includes/session.php';
}
?>

<!-- Transaction History Modal -->
<div class="modal fade" id="transaction" tabindex="-1" role="dialog" aria-labelledby="transactionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="transactionLabel"><b>Transaction Full Details</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <p>Date: <span id="date"></span></p>
                    </div>
                    <div class="col-sm-6 text-right">
                        <p>Transaction#: <span id="transid"></span></p>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="detail">
                        <tr class="prepend_items">
                            <td colspan="3" align="right"><b>Total</b></td>
                            <td><span id="total"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Track Order Modal -->
<div class="modal fade" id="trackOrder" tabindex="-1" role="dialog" aria-labelledby="trackOrderLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="trackOrderLabel"><b>Track Order</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3">
                        <h4>Order ID:</h4>
                        <h4>Tracking Link:</h4>
                        <h4>Created At:</h4>
                    </div>
                    <div class="col-sm-9">
                        <h4 id="track_order_id"></h4>
                        <h4 id="track_link"></h4>
                        <h4 id="track_created"></h4>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>

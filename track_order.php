<div class="modal fade" id="transaction">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Transaction Details</b></h4>
            </div>
            <div class="modal-body">
                <p>Date: <span id="date"></span></p>
                <p>Transaction#: <span id="transid"></span></p>
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
                        <tr class="prepend_items"></tr>
                    </tbody>
                </table>
                <p>Total: <span id="total"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="track_order">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Track Order</b></h4>
            </div>
            <div class="modal-body">
                <p><strong>Order #:</strong> <span id="track_order_id"></span></p>
                <p><strong>Status:</strong> <span id="track_status"></span></p>
                <p><strong>Driver Name:</strong> <span id="track_driver_name"></span></p>
                <p><strong>Driver Phone:</strong> <span id="track_driver_phone"></span></p>
                <p><strong>Estimated Delivery:</strong> <span id="track_estimated_delivery"></span></p>
                <p><strong>Tracking Link:</strong> <span id="track_link"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>
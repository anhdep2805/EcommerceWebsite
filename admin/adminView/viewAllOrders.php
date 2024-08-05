<div id="ordersBtn">
  <h2>Order Details</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>O.N.</th>
        <th>Customer</th>
        <th>Contact</th>
        <th>Order Date</th>
        <th>Payment Method</th>
        <th>Order Status</th>
        <th>Payment Status</th>
        <th>More Details</th>
     </tr>
    </thead>
    <?php
      include_once "../config/dbconnect.php";
      $sql = "SELECT * FROM orders";
      $result = $conn->query($sql);
      
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
    ?>
    <tr>
      <td><?=$row["order_id"]?></td>
      <td><?=$row["user_address"]?></td>
      <td><?=$row["user_phone"]?></td>
      <td><?=$row["order_date"]?></td>
      <td><?=$row["order_cost"]?></td>
      
      <?php 
        // Hiển thị trạng thái đơn hàng dựa trên cột order_status
        if ($row["order_status"] == "not paid") {
      ?>
        <td><button class="btn btn-danger" onclick="ChangeOrderStatus('<?=$row['order_id']?>')">Not Paid</button></td>
      <?php
        } else if ($row["order_status"] == "paid") {
      ?>
        <td><button class="btn btn-success" onclick="ChangeOrderStatus('<?=$row['order_id']?>')">Paid</button></td>
      <?php
        } else {
      ?>
        <td><button class="btn btn-warning" onclick="ChangeOrderStatus('<?=$row['order_id']?>')">Pending</button></td>
      <?php
        }
      ?>
      
      <td><a class="btn btn-primary openPopup" data-href="./adminView/viewEachOrder.php?orderID=<?=$row['order_id']?>" href="javascript:void(0);">View</a></td>
    </tr>
    <?php
        }
      }
    ?>
  </table>
</div>

<!-- Modal -->
<div class="modal fade" id="viewModal" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Order Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;"></button>
      </div>
      <div class="order-view-modal modal-body"></div>
    </div><!--/ Modal content-->
  </div><!-- /Modal dialog-->
</div>

<script>
  // for view order modal  
  $(document).ready(function(){
    $('.openPopup').on('click', function(){
      var dataURL = $(this).attr('data-href');
  
      $('.order-view-modal').load(dataURL, function(){
        $('#viewModal').modal({show:true});
      });
    });
  });
</script>

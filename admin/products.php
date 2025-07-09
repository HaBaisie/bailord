<?php include 'includes/session.php'; ?>
<?php
$where = '';
if (isset($_GET['category']) && $_GET['category'] != 0) {
    $catid = $_GET['category'];
    $where = 'WHERE category_id = :catid';
}
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Product List</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Products</li>
        <li class="active">Product List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php
        if (isset($_SESSION['error'])) {
          echo "<div class='alert alert-danger alert-dismissible'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                  <h4><i class='icon fa fa-warning'></i> Error!</h4>
                  " . htmlspecialchars($_SESSION['error']) . "
                </div>";
          unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
          echo "<div class='alert alert-success alert-dismissible'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                  <h4><i class='icon fa fa-check'></i> Success!</h4>
                  " . htmlspecialchars($_SESSION['success']) . "
                </div>";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat" id="addproduct"><i class="fa fa-plus"></i> New</a>
              <div class="pull-right">
                <form class="form-inline">
                  <div class="form-group">
                    <label>Category: </label>
                    <select class="form-control input-sm" id="select_category">
                      <option value="0">ALL</option>
                      <?php
                        $conn = $pdo->open();
                        $stmt = $conn->prepare("SELECT * FROM category ORDER BY name");
                        $stmt->execute();
                        foreach ($stmt as $crow) {
                          $selected = ($crow['id'] == $catid) ? 'selected' : '';
                          echo "<option value='" . $crow['id'] . "' " . $selected . ">" . htmlspecialchars($crow['name']) . "</option>";
                        }
                        $pdo->close();
                      ?>
                    </select>
                  </div>
                </form>
              </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Name</th>
                  <th>Photo</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>Views Today</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();
                    try {
                      $now = date('Y-m-d');
                      $stmt = $conn->prepare("SELECT * FROM products $where");
                      if ($where) {
                        $stmt->bindParam(':catid', $catid, PDO::PARAM_INT);
                      }
                      $stmt->execute();
                      foreach ($stmt as $row) {
                        $image = (!empty($row['photo'])) ? '../images/' . $row['photo'] : '../images/noimage.jpg';
                        $counter = ($row['date_view'] == $now) ? $row['counter'] : 0;
                        echo "
                          <tr>
                            <td>" . htmlspecialchars($row['name']) . "</td>
                            <td>
                              <img src='" . htmlspecialchars($image) . "' height='30px' width='30px'>
                              <span class='pull-right'><a href='#edit_photo' class='photo' data-toggle='modal' data-id='" . $row['id'] . "'><i class='fa fa-edit'></i></a></span>
                            </td>
                            <td><a href='#description' data-toggle='modal' class='btn btn-info btn-sm btn-flat desc' data-id='" . $row['id'] . "'><i class='fa fa-search'></i> View</a></td>
                            <td>$ " . number_format($row['price'], 2) . "</td>
                            <td>" . $counter . "</td>
                            <td>
                              <button class='btn btn-success btn-sm edit btn-flat' data-id='" . $row['id'] . "'><i class='fa fa-edit'></i> Edit</button>
                              <button class='btn btn-danger btn-sm delete btn-flat' data-id='" . $row['id'] . "'><i class='fa fa-trash'></i> Delete</button>
                            </td>
                          </tr>
                        ";
                      }
                    } catch (PDOException $e) {
                      echo "<tr><td colspan='6'>" . htmlspecialchars($e->getMessage()) . "</td></tr>";
                    }
                    $pdo->close();
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/products_modal.php'; ?>
  <?php include 'includes/products_modal2.php'; ?>

</div>

<?php include 'includes/scripts.php'; ?>
<script>
$(function() {
  // Initialize DataTable
  $('#example1').DataTable();

  // Initialize CKEditor for add modal
  if (typeof CKEDITOR !== 'undefined') {
    CKEDITOR.replace('editor1');
  }

  // Handle edit modal
  $(document).on('click', '.edit', function(e) {
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  // Handle delete modal
  $(document).on('click', '.delete', function(e) {
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  // Handle photo modal
  $(document).on('click', '.photo', function(e) {
    e.preventDefault();
    $('#edit_photo').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  // Handle description modal
  $(document).on('click', '.desc', function(e) {
    e.preventDefault();
    $('#description').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  // Handle category filter
  $('#select_category').change(function() {
    var val = $(this).val();
    window.location = val == 0 ? 'products.php' : 'products.php?category=' + val;
  });

  // Handle add product button
  $('#addproduct').click(function(e) {
    e.preventDefault();
    $('#addnew').modal('show');
  });

  // Load categories when add modal is shown
  $('#addnew').on('shown.bs.modal', function() {
    getCategory();
  });

  // Clear appended items when modals close
  $("#addnew, #edit").on("hidden.bs.modal", function() {
    $('.append_items').remove();
    $('#subcategory, #edit_subcategory').html('<option value="" selected>- Select -</option>');
  });

  // Load subcategories when category changes in add modal
  $(document).on('change', '#category', function() {
    var category_id = $(this).val();
    console.log('Category selected:', category_id); // Debug
    $('#subcategory').html('<option value="" selected>Loading...</option>');
    if (category_id) {
      $.ajax({
        type: 'POST',
        url: 'subcategory_fetch.php',
        data: {category_id: category_id},
        dataType: 'json',
        success: function(response) {
          console.log('Subcategory response:', response); // Debug
          $('#subcategory').html('<option value="" selected>- Select -</option>' + response);
        },
        error: function(xhr, status, error) {
          console.error('Error loading subcategories:', status, error, xhr.responseText); // Debug
          $('#subcategory').html('<option value="" disabled>Error loading subcategories</option>');
        }
      });
    } else {
      $('#subcategory').html('<option value="" selected>- Select -</option>');
    }
  });

  // Load subcategories for edit modal
  $(document).on('change', '#edit_category', function() {
    var category_id = $(this).val();
    console.log('Edit category selected:', category_id); // Debug
    $('#edit_subcategory').html('<option value="" selected>Loading...</option>');
    if (category_id) {
      $.ajax({
        type: 'POST',
        url: 'subcategory_fetch.php',
        data: {category_id: category_id},
        dataType: 'json',
        success: function(response) {
          console.log('Edit subcategory response:', response); // Debug
          $('#edit_subcategory').html('<option value="" selected>- Select -</option>' + response);
        },
        error: function(xhr, status, error) {
          console.error('Error loading subcategories:', status, error, xhr.responseText); // Debug
          $('#edit_subcategory').html('<option value="" disabled>Error loading subcategories</option>');
        }
      });
    } else {
      $('#edit_subcategory').html('<option value="" selected>- Select -</option>');
    }
  });
});

function getRow(id) {
  $.ajax({
    type: 'POST',
    url: 'products_row.php',
    data: {id: id},
    dataType: 'json',
    success: function(response) {
      console.log('Product row response:', response); // Debug
      $('#desc').html(response.description);
      $('.name').html(response.prodname);
      $('.prodid').val(response.prodid);
      $('#edit_name').val(response.prodname);
      $('#edit_category').val(response.category_id);
      $('#edit_subcategory').html('<option value="' + (response.subcategory_id || '') + '" selected>' + (response.subcatname || '- Select -') + '</option>');
      $('#edit_price').val(response.price);
      if (typeof CKEDITOR !== 'undefined') {
        CKEDITOR.instances["editor2"].setData(response.description);
      }
      // Load subcategories for selected category in edit modal
      if (response.category_id) {
        $.ajax({
          type: 'POST',
          url: 'subcategory_fetch.php',
          data: {category_id: response.category_id},
          dataType: 'json',
          success: function(sub_response) {
            console.log('Edit subcategory response:', sub_response); // Debug
            $('#edit_subcategory').html('<option value="" selected>- Select -</option>' + sub_response);
            $('#edit_subcategory').val(response.subcategory_id || '');
          },
          error: function(xhr, status, error) {
            console.error('Error loading subcategories for edit:', status, error, xhr.responseText); // Debug
          }
        });
      }
    },
    error: function(xhr, status, error) {
      console.error('Error fetching product:', status, error, xhr.responseText); // Debug
    }
  });
}

function getCategory() {
  $.ajax({
    type: 'POST',
    url: 'category_fetch.php',
    dataType: 'json',
    success: function(response) {
      console.log('Category response:', response); // Debug
      $('#category').html('<option value="" selected>- Select -</option>' + response);
      $('#edit_category').html('<option value="" selected>- Select -</option>' + response);
    },
    error: function(xhr, status, error) {
      console.error('Error loading categories:', status, error, xhr.responseText); // Debug
      $('#category, #edit_category').html('<option value="">Error loading categories</option>');
    }
  });
}
</script>
</body>
</html>

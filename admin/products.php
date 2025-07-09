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
          <!-- Product List Table -->
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
                      echo "<tr><td colspan='6'>Error: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
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
  // Log jQuery and Bootstrap status
  console.log('jQuery loaded, version:', $.fn.jquery);
  if (typeof $.fn.modal === 'undefined') {
    console.error('Bootstrap modal not loaded');
  } else {
    console.log('Bootstrap modal loaded');
  }

  // Initialize DataTable
  $('#example1').DataTable();

  // Initialize CKEditor
  if (typeof CKEDITOR !== 'undefined') {
    console.log('CKEditor loaded');
    CKEDITOR.replace('editor1');
  } else {
    console.warn('CKEditor not loaded');
  }

  // Handle edit modal
  $(document).on('click', '.edit', function(e) {
    e.preventDefault();
    console.log('Edit clicked, ID:', $(this).data('id'));
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  // Handle delete modal
  $(document).on('click', '.delete', function(e) {
    e.preventDefault();
    console.log('Delete clicked, ID:', $(this).data('id'));
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  // Handle photo modal
  $(document).on('click', '.photo', function(e) {
    e.preventDefault();
    console.log('Photo clicked, ID:', $(this).data('id'));
    $('#edit_photo').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  // Handle description modal
  $(document).on('click', '.desc', function(e) {
    e.preventDefault();
    console.log('Description clicked, ID:', $(this).data('id'));
    $('#description').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  // Handle category filter
  $('#select_category').change(function() {
    var val = $(this).val();
    console.log('Category filter changed:', val);
    window.location = val == 0 ? 'products.php' : 'products.php?category=' + val;
  });

  // Handle add product button
  $('#addproduct').click(function(e) {
    e.preventDefault();
    console.log('Add product clicked');
    $('#addnew').modal('show');
  });

  // Load categories when modal shown
  $('#addnew').on('shown.bs.modal', function() {
    console.log('Addnew modal shown, filtering subcategories');
    filterSubcategories();
  });

  // Clear dropdowns on modal close
  $("#addnew, #edit").on("hidden.bs.modal", function() {
    console.log('Modal closed, resetting dropdowns');
    $('#subcategory').val('');
    $('#edit_subcategory').html('<option value="" selected>- Select -</option>');
  });

  // Filter subcategories on category change
  $(document).on('change', '#category', function() {
    var category_id = $(this).val();
    console.log('Category changed, ID:', category_id);
    filterSubcategories();
    if (category_id) {
      $.ajax({
        type: 'POST',
        url: 'subcategory_fetch.php',
        data: {category_id: category_id},
        dataType: 'json',
        beforeSend: function() {
          console.log('Sending subcategory AJAX request for category_id:', category_id);
          $('#subcategory').html('<option value="" selected>Loading...</option>');
        },
        success: function(response) {
          console.log('Subcategory response:', response);
          $('#subcategory').html('<option value="" selected>- Select -</option>' + response);
        },
        error: function(xhr, status, error) {
          console.error('Subcategory AJAX error:', {
            status: status,
            error: error,
            responseText: xhr.responseText,
            statusCode: xhr.status
          });
          $('#subcategory').html('<option value="" disabled>Error loading subcategories</option>');
        }
      });
    } else {
      $('#subcategory').html('<option value="" selected>- Select -</option>');
    }
  });

  // Filter subcategories for edit modal
  $(document).on('change', '#edit_category', function() {
    var category_id = $(this).val();
    console.log('Edit category changed, ID:', category_id);
    $('#edit_subcategory').html('<option value="" selected>Loading...</option>');
    if (category_id) {
      $.ajax({
        type: 'POST',
        url: 'subcategory_fetch.php',
        data: {category_id: category_id},
        dataType: 'json',
        beforeSend: function() {
          console.log('Sending edit subcategory AJAX request for category_id:', category_id);
        },
        success: function(response) {
          console.log('Edit subcategory response:', response);
          $('#edit_subcategory').html('<option value="" selected>- Select -</option>' + response);
        },
        error: function(xhr, status, error) {
          console.error('Edit subcategory AJAX error:', {
            status: status,
            error: error,
            responseText: xhr.responseText,
            statusCode: xhr.status
          });
          $('#edit_subcategory').html('<option value="" disabled>Error loading subcategories</option>');
        }
      });
    } else {
      $('#edit_subcategory').html('<option value="" selected>- Select -</option>');
    }
  });

  // Function to filter subcategories based on selected category
  function filterSubcategories() {
    var category_id = $('#category').val();
    console.log('Filtering subcategories for category_id:', category_id);
    $('#subcategory option').each(function() {
      var $option = $(this);
      var optionCategoryId = $option.data('category-id');
      if (category_id && optionCategoryId && optionCategoryId != category_id) {
        $option.hide();
      } else {
        $option.show();
      }
    });
    $('#subcategory').val(''); // Reset selection
  }
});

function getRow(id) {
  console.log('Fetching product row, ID:', id);
  $.ajax({
    type: 'POST',
    url: 'products_row.php',
    data: {id: id},
    dataType: 'json',
    beforeSend: function() {
      console.log('Sending product row AJAX request');
    },
    success: function(response) {
      console.log('Product row response:', response);
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
      if (response.category_id) {
        $.ajax({
          type: 'POST',
          url: 'subcategory_fetch.php',
          data: {category_id: response.category_id},
          dataType: 'json',
          beforeSend: function() {
            console.log('Sending edit subcategory AJAX request for category_id:', response.category_id);
          },
          success: function(sub_response) {
            console.log('Edit subcategory response:', sub_response);
            $('#edit_subcategory').html('<option value="" selected>- Select -</option>' + sub_response);
            $('#edit_subcategory').val(response.subcategory_id || '');
          },
          error: function(xhr, status, error) {
            console.error('Edit subcategory AJAX error:', {
              status: status,
              error: error,
              responseText: xhr.responseText,
              statusCode: xhr.status
            });
          }
        });
      }
    },
    error: function(xhr, status, error) {
      console.error('Product row AJAX error:', {
        status: status,
        error: error,
        responseText: xhr.responseText,
        statusCode: xhr.status
      });
    }
  });
}

function getCategory() {
  console.log('Fetching categories via AJAX');
  $.ajax({
    type: 'POST',
    url: 'category_fetch.php',
    dataType: 'json',
    beforeSend: function() {
      console.log('Sending category AJAX request to category_fetch.php');
    },
    success: function(response) {
      console.log('Category response:', response);
      $('#category').html('<option value="" selected>- Select -</option>' + response);
      $('#edit_category').html('<option value="" selected>- Select -</option>' + response);
      filterSubcategories();
    },
    error: function(xhr, status, error) {
      console.error('Category AJAX error:', {
        status: status,
        error: error,
        responseText: xhr.responseText,
        statusCode: xhr.status
      });
      $('#category, #edit_category').html('<option value="">Error loading categories</option>');
    }
  });
}
</script>
</body>
</html>

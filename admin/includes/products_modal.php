<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Add New Product</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Products</li>
        <li class="active">Add Product</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php
        if (isset($_SESSION['error'])) {
          echo "<div class='alert alert-danger alert-dismissible'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                  <h4><i class='icon fa fa-warning'></i> Error!</h4>
                  " . $_SESSION['error'] . "
                </div>";
          unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
          echo "<div class='alert alert-success alert-dismissible'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                  <h4><i class='icon fa fa-check'></i> Success!</h4>
                  " . $_SESSION['success'] . "
                </div>";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <!-- Description -->
              <div class="modal fade" id="description">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                      <h4 class="modal-title"><b><span class="name"></span></b></h4>
                    </div>
                    <div class="modal-body">
                      <p id="desc"></p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Add -->
              <div class="modal fade" id="addnew">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                      <h4 class="modal-title"><b>Add New Product</b></h4>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal" method="POST" action="products_add.php" enctype="multipart/form-data">
                        <div class="form-group">
                          <label for="name" class="col-sm-1 control-label">Name</label>
                          <div class="col-sm-5">
                            <input type="text" class="form-control" id="name" name="name" required>
                          </div>
                          <label for="category" class="col-sm-1 control-label">Category</label>
                          <div class="col-sm-5">
                            <select class="form-control" id="category" name="category_id" required>
                              <option value="" selected>- Select -</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="subcategory" class="col-sm-1 control-label">Subcategory</label>
                          <div class="col-sm-5">
                            <select class="form-control" id="subcategory" name="subcategory_id">
                              <option value="" selected>- Select -</option>
                            </select>
                          </div>
                          <label for="price" class="col-sm-1 control-label">Price</label>
                          <div class="col-sm-5">
                            <input type="text" class="form-control" id="price" name="price" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="photo" class="col-sm-1 control-label">Photo</label>
                          <div class="col-sm-5">
                            <input type="file" id="photo" name="photo">
                          </div>
                        </div>
                        <p><b>Description</b></p>
                        <div class="form-group">
                          <div class="col-sm-12">
                            <textarea id="editor1" name="description" rows="10" cols="80" required></textarea>
                          </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                      <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Update Photo -->
              <div class="modal fade" id="edit_photo">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                      <h4 class="modal-title"><b><span class="name"></span></b></h4>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal" method="POST" action="products_photo.php" enctype="multipart/form-data">
                        <input type="hidden" class="prodid" name="id">
                        <div class="form-group">
                          <label for="photo" class="col-sm-3 control-label">Photo</label>
                          <div class="col-sm-9">
                            <input type="file" id="photo" name="photo" required>
                          </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                      <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Update</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
$(document).ready(function() {
    // Initialize CKEditor
    CKEDITOR.replace('editor1');

    // Load categories
    $.ajax({
        type: 'POST',
        url: 'category_fetch.php',
        dataType: 'json',
        success: function(response) {
            $('#category').html('<option value="" selected>- Select -</option>' + response);
        },
        error: function(xhr, status, error) {
            console.error('Error loading categories:', status, error);
            $('#category').html('<option value="">Error loading categories</option>');
        }
    });

    // Load subcategories when category changes
    $('#category').change(function() {
        var category_id = $(this).val();
        $('#subcategory').html('<option value="" selected>- Select -</option>');
        if (category_id) {
            $.ajax({
                type: 'POST',
                url: 'subcategory_fetch.php',
                data: {category_id: category_id},
                dataType: 'json',
                success: function(response) {
                    $('#subcategory').html('<option value="" selected>- Select -</option>' + response);
                },
                error: function(xhr, status, error) {
                    console.error('Error loading subcategories:', status, error);
                    $('#subcategory').html('<option value="">Error loading subcategories</option>');
                }
            });
        }
    });

    // Open add modal
    $('#addnew').modal('show');
});
</script>
</body>
</html>
?>

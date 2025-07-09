<!-- Description -->
<div class="modal fade" id="description">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
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
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title"><b>Add New Product</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="products_add.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control input-sm" id="name" name="name" required>
                        </div>
                        <label for="category" class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-4">
                            <select class="form-control input-sm" id="category" name="category_id" required>
                                <option value="" selected>- Select -</option>
                                <?php
                                  $conn = $pdo->open();
                                  try {
                                    $stmt = $conn->prepare("SELECT id, name FROM category ORDER BY name");
                                    $stmt->execute();
                                    foreach ($stmt as $crow) {
                                        echo "<option value='" . $crow['id'] . "'>" . htmlspecialchars($crow['name']) . "</option>";
                                    }
                                  } catch (PDOException $e) {
                                    echo "<option value=''>Error: " . htmlspecialchars($e->getMessage()) . "</option>";
                                  }
                                  $pdo->close();
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="subcategory" class="col-sm-2 control-label">Subcategory</label>
                        <div class="col-sm-4">
                            <select class="form-control input-sm" id="subcategory" name="subcategory_id">
                                <option value="" selected>- Select -</option>
                                <?php
                                  $conn = $pdo->open();
                                  try {
                                    $stmt = $conn->prepare("SELECT id, name, category_id FROM subcategory ORDER BY name");
                                    $stmt->execute();
                                    foreach ($stmt as $srow) {
                                        echo "<option value='" . $srow['id'] . "' data-category-id='" . $srow['category_id'] . "'>" . htmlspecialchars($srow['name']) . "</option>";
                                    }
                                  } catch (PDOException $e) {
                                    echo "<option value=''>Error: " . htmlspecialchars($e->getMessage()) . "</option>";
                                  }
                                  $pdo->close();
                                ?>
                            </select>
                        </div>
                        <label for="price" class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control input-sm" id="price" name="price" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="photo" class="col-sm-2 control-label">Photo</label>
                        <div class="col-sm-4">
                            <input type="file" class="form-control input-sm" id="photo" name="photo">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10">
                            <textarea id="editor1" name="description" rows="10" class="form-control" required></textarea>
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
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title"><b><span class="name"></span></b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="products_photo.php" enctype="multipart/form-data">
                    <input type="hidden" class="prodid" name="id">
                    <div class="form-group">
                        <label for="photo" class="col-sm-2 control-label">Photo</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control input-sm" id="photo" name="photo" required>
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

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title"><b>Delete Product</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="products_delete.php">
                    <input type="hidden" class="prodid" name="id">
                    <p>Are you sure you want to delete <b><span class="name"></span></b>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

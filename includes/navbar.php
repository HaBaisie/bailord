<header class="main-header header" style="background: var(--blue-gradient);">
  <nav class="navbar navbar-static-top" style="background: transparent;">
    <div class="container">
      <div class="navbar-header header-left">
        <a href="index.php" class="navbar-brand">
          <img src="../images/logo.png" alt="Bailord Logo" style="height: 50px; display: inline-block;">
        </a>
        <button type="button" class="navbar-toggle collapsed mobile-menu-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
          <i class="fa fa-bars"></i>
        </button>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse pull-left header-center" id="navbar-collapse">
        <ul class="nav navbar-nav main-nav menu">
          <li><a href="index.php">HOME</a></li>
          <li><a href="about.php">ABOUT US</a></li>
          <li><a href="contact.php">CONTACT US</a></li>
          <li class="dropdown category-dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">CATEGORY <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <?php
                $conn = $pdo->open();
                try {
                  $stmt = $conn->prepare("SELECT * FROM category");
                  $stmt->execute();
                  foreach ($stmt as $row) {
                    echo "<li><a href='category.php?category=".htmlspecialchars($row['cat_slug'])."'>".htmlspecialchars($row['name'])."</a></li>";
                  }
                } catch (PDOException $e) {
                  echo "<li><a href='#'>Error: ".htmlspecialchars($e->getMessage())."</a></li>";
                }
                $pdo->close();
              ?>
            </ul>
          </li>
        </ul>
        <form method="POST" class="navbar-form navbar-left mobile-search" action="search.php">
          <div class="input-group">
            <input type="text" class="form-control" id="navbar-search-input" name="keyword" placeholder="Search for Product" required>
            <span class="input-group-btn">
              <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-search"></i></button>
            </span>
          </div>
        </form>
      </div>
      <!-- /.navbar-collapse -->

      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu header-right">
        <ul class="nav navbar-nav">
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-shopping-cart"></i>
              <span class="label label-success cart_count"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <span class="cart_count"></span> item(s) in cart</li>
              <li>
                <ul class="menu" id="cart_menu"></ul>
              </li>
              <li class="footer"><a href="cart_view.php">Go to Cart</a></li>
            </ul>
          </li>
          <?php
            if (isset($_SESSION['user'])) {
              $image = (!empty($user['photo'])) ? 'images/'.htmlspecialchars($user['photo']) : 'images/profile.jpg';
              echo '
                <li class="dropdown user user-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="'.$image.'" class="user-image" alt="User Image">
                    <span class="hidden-xs">'.htmlspecialchars($user['firstname']).' '.htmlspecialchars($user['lastname']).'</span>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="user-header">
                      <img src="'.$image.'" class="img-circle" alt="User Image">
                      <p>
                        '.htmlspecialchars($user['firstname']).' '.htmlspecialchars($user['lastname']).'
                        <small>Member since '.date('M. Y', strtotime($user['created_on'])).'</small>
                      </p>
                    </li>
                    <li class="user-footer">
                      <div class="pull-left">
                        <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                      </div>
                      <div class="pull-right">
                        <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                      </div>
                    </li>
                  </ul>
                </li>
              ';
            } else {
              echo '
                <li><a href="login.php" class="user-btn login-btn">LOGIN</a></li>
                <li><a href="signup.php" class="user-btn">SIGNUP</a></li>
              ';
            }
          ?>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Mobile Menu -->
  <div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
      <span class="mobile-menu-close"><i class="fa fa-times"></i></span>
      <ul class="mobile-menu mobile-nav">
        <li><a href="index.php">HOME</a></li>
        <li><a href="about.php">ABOUT US</a></li>
        <li><a href="contact.php">CONTACT US</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle">CATEGORY <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php
              $conn = $pdo->open();
              try {
                $stmt = $conn->prepare("SELECT * FROM category");
                $stmt->execute();
                foreach ($stmt as $row) {
                  echo "<li><a href='category.php?category=".htmlspecialchars($row['cat_slug'])."'>".htmlspecialchars($row['name'])."</a></li>";
                }
              } catch (PDOException $e) {
                echo "<li><a href='#'>Error: ".htmlspecialchars($e->getMessage())."</a></li>";
              }
              $pdo->close();
            ?>
          </ul>
        </li>
      </ul>
      <form method="POST" class="mobile-search" action="search.php">
        <div class="input-group">
          <input type="text" class="form-control" name="keyword" placeholder="Search for Product" required>
          <span class="input-group-btn">
            <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-search"></i></button>
          </span>
        </div>
      </form>
    </div>
  </div>
</header>

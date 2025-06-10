<?php
	include 'includes/conn.php';
	session_start();

	if(isset($_SESSION['admin'])){
		header('location: admin/home.php');
	}

	if(isset($_SESSION['user'])){
		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
			$stmt->execute(['id'=>$_SESSION['user']]);
			$user = $stmt->fetch();
		}
		catch(PDOException $e){
			echo "There is some problem in connection: " . $e->getMessage();
		}

		$pdo->close();
	}

	function renderCategoryBlocks($conn) {
	    $default_image = 'category-default.jpg';
	    $output = '';
	    try {
	        $stmt = $conn->prepare("SELECT * FROM category");
	        $stmt->execute();
	        foreach ($stmt->fetchAll() as $category) {
	            $slug = !empty($category['cat_slug']) ? $category['cat_slug'] : strtolower(str_replace(' ', '-', $category['name']));
	            $image_name = $slug . '.jpg';
	            $image_path = file_exists('images/' . $image_name) ? 'images/' . $image_name : 'images/' . $default_image;
	            $output .= '
	                <div class="col-6 col-sm-4 col-lg-2">
	                    <a href="category.php?category='.htmlspecialchars($slug).'" class="cat-block">
	                        <figure>
	                            <span>
	                                <img src="'.htmlspecialchars($image_path).'" alt="'.htmlspecialchars($category['name']).' Category" loading="lazy">
	                            </span>
	                        </figure>
	                        <h3 class="cat-block-title">'.htmlspecialchars($category['name']).'</h3>
	                    </a>
	                </div>';
	        }
	    } catch(PDOException $e) {
	        $output .= '<div class="col-12 text-center">Categories temporarily unavailable</div>';
	        error_log("Category blocks fetch failed: " . $e->getMessage());
	    }
	    return $output;
	}
?>

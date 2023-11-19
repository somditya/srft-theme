<?php

/*
Template Name: Production

 */

 
?>

<?php
get_header();

function get_category_ID( $cat_name ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
	$cat = get_term_by( 'name', $cat_name, 'category' );
	if ( $cat ) {
        
		return $cat->term_id;
	}

	return 0;
}

$category_name = 'production'; // Ensure this matches the exact category name.
$category_id = get_category_ID($category_name);
?>

<body ng-controller="StudentController">
    <main>
      <body>
      <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
        <div class="page-banner">
          <div class="page-banner-title"><?php echo __('Student Films', 'srft-theme' ); ?></div>
      </section>

      <section class="section-home">
            <div class="container" style="width: 1170px;">
                <h2 class="page-header-text" style="padding-left: 0; text-align: center;"><?php echo __('Students Films', 'srft-theme' ); ?></h2>
                <div ng-app="myApp" ng-controller="ProductionController" style="margin-top: 4.5rem;">
                    <!-- News grid without pagination -->
                    <div class="award-tree">
  <div ng-repeat="production in productionList.slice((currentPage - 1) * itemsPerPage, currentPage * itemsPerPage)" style="display: inline-block; margin-right: 10px;">
    <a href="{{production.link}}" style="display: flex; align-items: center; padding: 0px; margin-bottom: 10px;">
      <img src="<?php bloginfo('template_url'); ?>/images/leftleaf.png" height="150px;" alt="Left Leaf">
      <h3 style=" width: 100%; color: #161a1d;">{{ production.name }}</h3>
      <img src="<?php bloginfo('template_url'); ?>/images/rightleaf.png" height="150px;" alt="Right Leaf">
    </a>
  </div>
</div>

                </div>
            </div>
                    <!--<ul class="pagination">
  <li ng-class="{ 'disabled': currentPage === 1 }">
    <a href="#" ng-click="setPage(1)"><i class="fas fa-step-backward" style="color: #8b5b2b;"></i></a>
  </li>
  <li ng-class="{ 'disabled': currentPage === 1 }">
    <a href="#" ng-click="prevPage()"><i class="fas fa-chevron-left" style="color: #8b5b2b;"></i></a>
  </li>
  <li ng-repeat="page in getPages()" ng-class="{ 'active': currentPage === page }">
    <a href="#" ng-click="setPage(page)">{{ page }}</a>
  </li>
  <li ng-class="{ 'disabled': currentPage === totalPages }">
    <a href="#" ng-click="nextPage()"><i class="fas fa-chevron-right" style="color: #8b5b2b;"></i></a>
  </li>
  <li ng-class="{ 'disabled': currentPage === totalPages }">
    <a href="#" ng-click="setPage(totalPages)"><i class="fas fa-step-forward" style="color: #8b5b2b;"></i></a>
  </li>
</ul>-->
                </div>
            </div>
        </section>

        <script>
        var categoryID = <?php echo json_encode($category_id); ?>;
        var siteURL = '<?php echo esc_url(site_url('/')); ?>';

        angular.module('myApp', [])
        .controller('ProductionController', function($scope, $http) {
            $scope.currentPage = 1;
            $scope.itemsPerPage = 14; // Number of items per page

            $http.get(siteURL + 'wp-json/wp/v2/posts?categories=' + categoryID + '&per_page=100')
                .then(function(response) {
                    console.log('HTTP request success');
                    $scope.productionList = response.data.map(function(post) {
                        /*const postDate = new Date(post.date);
                        const day = String(postDate.getDate()).padStart(2, '0');
                        const month = String(postDate.getMonth() + 1).padStart(2, '0');
                        const year = postDate.getFullYear();
                        const formattedDate = `${day}-${month}-${year}`;*/
                        return {
                            name: post.title.rendered || '',
                            link: post.link,
                            featured_media: post.featured_media,
                            //formattedDate: formattedDate,
                        };
                    });

                    angular.forEach($scope.productionList, function(production) {
                        if (news.featured_media) {
                            $http.get(siteURL + 'wp-json/wp/v2/media/' + news.featured_media)
                                .then(function(imageResponse) {
                                    news.image = imageResponse.data.source_url;
                                    console.log('Image Loaded for:', news.name);
                                })
                                .catch(function(error) {
                                    console.error('Error fetching featured image:', error);
                                });
                        }
                    });

                    // Initialize the total pages
                    //$scope.totalPages = Math.ceil($scope.newsList.length / $scope.itemsPerPage);

                    // Function to filter and display news based on the current page
                    //$scope.getDisplayedNews = function() {
                      //  const startIndex = ($scope.currentPage - 1) * $scope.itemsPerPage;
                        //const endIndex = startIndex + $scope.itemsPerPage;
                        //return $scope.newsList.slice(startIndex, endIndex);
                    //};

                    console.log('Production List:', $scope.newsList);
                })
                .catch(function(error) {
                    console.error('Error fetching production data:', error);
                });

            // Previous page
            //$scope.prevPage = function() {
              //  if ($scope.currentPage > 1) {
                //    $scope.setPage($scope.currentPage - 1);
                //}
           // };

            // Next page
            //$scope.nextPage = function() {
              //  if ($scope.currentPage < $scope.totalPages) {
                //    $scope.setPage($scope.currentPage + 1);
                //}
            //};

            // Set the current page
            //$scope.setPage = function(pageNumber) {
              //  if (pageNumber >= 1 && pageNumber <= $scope.totalPages) {
                //    $scope.currentPage = pageNumber;
                //}
            //};

            // Function to generate an array of page numbers
            //$scope.getPages = function() {
              //  return new Array($scope.totalPages).fill().map((_, i) => i + 1);
            //};
        });
    </script>
          
    </main>

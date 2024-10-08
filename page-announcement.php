<?php

/*
Template Name: AnnouncementList

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

$category_name = 'bulletin'; // Ensure this matches the exact category name.
$category_id = get_category_ID($category_name);
?>

<body ng-controller="AnnouncementController">
    <main>
        <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
            <div class="page-banner">
                <div class="page-banner-title"><?php echo __('Announcement', 'srft-theme' ); ?></div>
        </section>

      <section class="section-home">
            <div class="container" style="width: 1170px;">
                <h2 class="page-header-text" style="padding-left: 0; text-align: center;"><?php echo __('Announcement', 'srft-theme' ); ?></h2>
                <div ng-app="myApp" ng-controller="AnnouncementController" style="margin-top: 4.5rem;">
                    <!-- News grid without pagination -->
                    <div class="news-grid">
                    <a class="news-card" ng-repeat="announcement in announcementList.slice((currentPage - 1) * itemsPerPage, currentPage * itemsPerPage)" href="{{announcement.link}}">
                            <div class="news-link-left">
                                <span class="news-link-left-date"> {{ announcement.formattedDate }}</span>
                                    <h3 class="news-link-left-title">{{ announcement.name }}</h3>
                                    <div class="news-link-left-text">
                                        <span>{{ announcement.designation }}</span>
                                    </div>
                                </span>
                            </div>
                            <div class="news-image-right">
                                <img ng-src="{{ announcement.image }}" alt="{{ announcement.name }}" class="faculty-image">
                            </div>
                        </a>
                    </div>
                    <ul class="pagination">
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
</ul>
                </div>
            </div>
        </section>

        <script>
        var categoryID = <?php echo json_encode($category_id); ?>;
        var siteURL = '<?php echo esc_url(site_url('/')); ?>';

        angular.module('myApp', [])
        .controller('AnnouncementController', function($scope, $http) {
            $scope.currentPage = 1;
            $scope.itemsPerPage = 8; // Number of items per page
         

            $http.get(siteURL + 'wp-json/wp/v2/bulletin?categories=' + categoryID + '&per_page=100')
                .then(function(response) {
                    console.log('HTTP request success');
                    $scope.announcementList = response.data.map(function(post) {
                        const postDate = new Date(post.date);
                        const day = String(postDate.getDate()).padStart(2, '0');
                        const month = String(postDate.getMonth() + 1).padStart(2, '0');
                        const year = postDate.getFullYear();
                        const formattedDate = `${day}-${month}-${year}`;
                        
                        return {
                            name: post.title.rendered || '',
                            link: post.link,
                            image: post.acf['Image'], // Assuming it returns a URL
                            //featured_media: post.featured_media,
                            formattedDate: formattedDate,
                        };
                    });

                    /*angular.forEach($scope.newsList, function(news) {
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
                    });*/

                    // Initialize the total pages
                    $scope.totalPages = Math.ceil($scope.announcementList.length / $scope.itemsPerPage);

                    // Function to filter and display news based on the current page
                    $scope.getDisplayedNews = function() {
                        const startIndex = ($scope.currentPage - 1) * $scope.itemsPerPage;
                        const endIndex = startIndex + $scope.itemsPerPage;
                        return $scope.announcementList.slice(startIndex, endIndex);
                    };

                    console.log('Announement List:', $scope.announcementList);
                })
                .catch(function(error) {
                    console.error('Error fetching announcement data:', error);
                });

            // Previous page
            $scope.prevPage = function() {
                if ($scope.currentPage > 1) {
                    $scope.setPage($scope.currentPage - 1);
                }
            };

            // Next page
            $scope.nextPage = function() {
                if ($scope.currentPage < $scope.totalPages) {
                    $scope.setPage($scope.currentPage + 1);
                }
            };

            // Set the current page
            $scope.setPage = function(pageNumber) {
                if (pageNumber >= 1 && pageNumber <= $scope.totalPages) {
                    $scope.currentPage = pageNumber;
                }
            };

            // Function to generate an array of page numbers
            $scope.getPages = function() {
                return new Array($scope.totalPages).fill().map((_, i) => i + 1);
            };
        });
    </script>
          
    </main>

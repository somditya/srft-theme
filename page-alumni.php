<?php

/*
Template Name: NewsList

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

$category_name = 'news'; // Ensure this matches the exact category name.
$category_id = get_category_ID($category_name);
echo "Hello";
?>

<body ng-controller="NewsController">
    <main>
      <body>
      <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
        <div class="page-banner">
          <div class="page-banner-title"><?php echo __('News', 'srft-theme' ); ?></div>
      </section>

      <section class="section-home">
            <div class="container" style="width: 1170px;">
                <h2 class="page-header-text" style="padding-left: 0; text-align: center;"><?php echo __('News', 'srft-theme' ); ?></h2>
                <div ng-app="myApp" ng-controller="NewsController" style="margin-top: 4.5rem;">
                    <!-- News grid without pagination -->
                    <div class="news-grid">
                        <a class="news-card" ng-repeat="news in newsList" href="{{news.link}}">
                            <div class="news-link-left">
                                <span class="news-link-left-date"> {{ news.formattedDate }}</span>
                                    <h3 class="news-link-left-title">{{ news.name }}</h3>
                                    <div class="news-link-left-text">
                                        <span>{{ news.designation }}</span>
                                    </div>
                                </span>
                            </div>
                            <div class="news-image-right">
                                <img ng-src="{{ news.image }}" alt="{{ news.name }}" class="faculty-image">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <script>
            var categoryID = <?php echo json_encode($category_id); ?>;
            var siteURL = '<?php echo esc_url(site_url('/')); ?>';

            angular.module('myApp', [])
    .controller('NewsController', function($scope, $http) {
        // Initialize the news data
        $http.get(siteURL + 'wp-json/wp/v2/posts?categories=' + categoryID + '&per_page=100')
            .then(function(response) {
                console.log('HTTP request success');
                $scope.newsList = response.data.map(function(post) {
                    const postDate = new Date(post.date);
                    const day = String(postDate.getDate()).padStart(2, '0');
                    const month = String(postDate.getMonth() + 1).padStart(2, '0');
                    const year = postDate.getFullYear();
                    const formattedDate = `${day}-${month}-${year}`;
                    return {
                        name: post.title.rendered || '',
                        link: post.link,
                        featured_media: post.featured_media,
                        formattedDate: formattedDate,
                    };
                });

                angular.forEach($scope.newsList, function(news) {
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

                // Pagination settings
                $scope.currentPage = 1;
                $scope.itemsPerPage = 10; // Number of items per page

                // Function to get the total number of pages
                $scope.getTotalPages = function() {
                    return Math.ceil($scope.newsList.length / $scope.itemsPerPage);
                };

                // Function to generate an array of page numbers
                $scope.getPages = function() {
                    const totalPages = $scope.getTotalPages();
                    return new Array(totalPages).fill().map((_, i) => i + 1);
                };

                // Function to set the current page
                $scope.setPage = function(pageNumber) {
                    $scope.currentPage = pageNumber;
                };

                // Function to filter and display news based on the current page
                $scope.getDisplayedNews = function() {
                    const startIndex = ($scope.currentPage - 1) * $scope.itemsPerPage;
                    const endIndex = startIndex + $scope.itemsPerPage;
                    return $scope.newsList.slice(startIndex, endIndex);
                };

                console.log('News List:', $scope.newsList);
            })
            .catch(function(error) {
                console.error('Error fetching news data:', error);
            });
    });
        </script>
          
    </main>

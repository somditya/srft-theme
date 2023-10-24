<?php

/*
Template Name: NewsList

 */

 
?>

<?php
get_header();

function get_category_ID( $cat_name ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
	$cat = get_term_by( 'name', $cat_name, 'category' );
    echo '<script type="text/javascript">alert("Category found: ' . $cat_name . '");</script>';
	if ( $cat ) {
        echo '<script type="text/javascript">alert("Category found: ' . $cat_name . '");</script>';
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
                        <a class="news-card" ng-repeat="news in newsList">
                            <div class="news-link-left">
                                <span class="news-link-left-date">
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
                    $http.get(siteURL + 'wp-json/wp/v2/posts?categories=' + categoryID + '&per_page=100') // Adjust 'per_page' as needed
                        .then(function(response) {
                            console.log('HTTP request success');
                            // Map the retrieved data to the format you want in $scope.newsList
                            $scope.newsList = response.data.map(function(post) {
                                return {
                                    name: post.title.rendered || '',
                                    link: post.link,
                                    featured_media: post.featured_media,
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

                            console.log('News List:', $scope.newsList);
                        })
                        .catch(function(error) {
                            console.error('Error fetching news data:', error);
                        });
                });
        </script>
          
    </main>

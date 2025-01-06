<?php
/*
Template Name: Production
*/

get_header();
$current_language = get_locale();

function get_category_ID($cat_name) {
    $cat = get_term_by('name', $cat_name, 'category');
    if ($cat) {
        return $cat->term_id;
    }

    return 0;
}

$category_name = 'production';
$category_id = get_category_ID($category_name);
?>

<body ng-controller="StudentController">
<div data-scroll-container>
    <main>
        <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
            <div class="page-banner">
                <div class="page-banner-title"><?php echo __('Students', 'srft-theme'); ?></div>
            </div>
        </section>

        <section class="cine-detail">
            <div class="leftnav">
                <div class="widget" style="line-height: 1.5; margin-top: 1rem;">
                    <h4><?php echo __('Student Association', 'srft-theme'); ?></h4>
                </div>
            </div>
            <div class="main-content">
                <div>     
                     <?php
                     if ( function_exists('yoast_breadcrumb') ) {
                     yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
                    }
                 ?>
                </div>
                <h2 class="page-header-text" style="padding-left: 0; text-align: center;"><?php echo __('Students', 'srft-theme'); ?></h2>
                <section style="width: 100%; padding: 2.8rem 0 2.8rem 0;">
                <section class="student owl-carousel">
                    <?php
                    $post_id = get_the_ID();
                    $post_content = apply_filters('the_content', $post->post_content);
                    if ($current_language === 'en_US') {
                      $catslug='studentnews-en'; 
                    }
                    else
                    {
                    $catslug='studentnews-hi';
                    }
                    $category_posts = new WP_Query(array(
                        'post_type' => 'news',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'category',
                                'field'    => 'slug',
                                'terms'    => $catslug,
                            ),
                        ),
                        'posts_per_page' => -1,
                    ));

                if ($category_posts->have_posts()) :
                  while ($category_posts->have_posts()) : $category_posts->the_post();
                ?>

<div class="news-item">
      <a href="<?php the_permalink(); ?>" target="_blank" role="link">
        <img typeof="foaf:Image" class="img-responsive lazyOwl" src="<?php echo get_field('News-Image');?> ?>" alt="<?php echo get_field('News-Image-Alternativetext'); ?>"  style="display: block;">
      <div class="news-item-title">
        <h3 href="#"><?php the_title(); ?></h3>
        <p><?php echo $post_content; ?></p>
        <!--<i class="fa-solid fa-play fa-xl" style="color: #161718;"></i>-->
        <!--<div class="primary__header-arrow">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.85 24.85" style="transform: translate(0px, 0px); opacity: 1;"><defs><style>.cls-1-arrow-external{fill:none;stroke:#000;stroke-miterlimit:10;}</style></defs><g id="Calque_1-2" data-name="Calque 1"><line class="cls-1-arrow-external" x1="0.35" y1="24.5" x2="24.35" y2="0.5"></line><polyline class="cls-1-arrow-external" points="24.35 24.4 24.35 0.5 0.46 0.5"></polyline></g></svg></div>-->
      </div>
      </a>
      </div>
      <?php
        endwhile;
        wp_reset_postdata(); // Reset the post data
    else :
        echo '<p>No posts found in this category.</p>';
    endif;
    ?>  
            </section>
                    <section class="section-home">
                        <div class="container" style="width: 100%;">
                            <h2 class="page-header-text" style="padding-left: 0; text-align: center;"><?php echo __('Students Films', 'srft-theme'); ?></h2>
                            <div ng-app="myApp" ng-controller="ProductionController" style="margin-top: 4.5rem;">
                                <div class="award-tree">
                                    <div ng-repeat="production in productionList.slice((currentPage - 1) * itemsPerPage, currentPage * itemsPerPage)" style="display: inline-block; margin-right: 10px;">
                                        <a href="#" style="display: flex; align-items: center; padding: 0px; margin-bottom: 10px;" ng-click="openModal(production.name, production.content)">
                                            <img src="<?php bloginfo('template_url'); ?>/images/leftleaf.png" height="100px;" alt="Left Leaf">
                                            <h3 style="font-size: 16px; width: 100%; white-space: nowrap; color: #161a1d;">{{ production.name }}</h3>
                                            <img src="<?php bloginfo('template_url'); ?>/images/rightleaf.png" height="100px;" alt="Right Leaf">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </section>
            </div>
        </section>
    </main>

    <div id="postModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle"></h2>
            <div id="modalContent"></div>
        </div>
    </div>

    <script>
    var categoryID = <?php echo json_encode($category_id); ?>;
    var siteURL = '<?php echo esc_url(site_url('/')); ?>';

    angular.module('myApp', [])
        .controller('ProductionController', function ($scope, $http) {
            $scope.currentPage = 1;
            $scope.itemsPerPage = 14;
            //let requestUrl = siteURL + 'wp-json/wp/v2/posts?categories=' + categoryID + '&per_page=100';

            // Display the URL in an alert
            //alert('The request URL is: ' + requestUrl);

            $http.get(siteURL + 'wp-json/wp/v2/posts?categories=' + categoryID + '&per_page=100')
                .then(function (response) {
                    console.log('HTTP request success');
                    $scope.productionList = response.data.map(function (post) {
                        return {
                            name: post.title.rendered || '',
                            content: post.content.rendered || '',
                            link: post.link,
                            featured_media: post.featured_media,
                        };
                    });

                    // Load featured images
                    angular.forEach($scope.productionList, function (production) {
                        if (production.featured_media) {
                            $http.get(siteURL + 'wp-json/wp/v2/media/' + production.featured_media)
                                .then(function (imageResponse) {
                                    production.image = imageResponse.data.source_url;
                                    console.log('Image Loaded for:', production.name);
                                })
                                .catch(function (error) {
                                    console.error('Error fetching featured image:', error);
                                });
                        }
                    });

                })
                .catch(function (error) {
                    console.error('Error fetching production data:', error);
                });

            $scope.openModal = function (title, content) {
                // Set modal content
                document.getElementById('modalTitle').innerHTML = title;
                document.getElementById('modalContent').innerHTML = content;

                // Show modal
                document.getElementById('postModal').style.display = 'block';
            };
        });

    function closeModal() {
        // Hide modal
        document.getElementById('postModal').style.display = 'none';
    }

    window.onclick = function (event) {
        var modal = document.getElementById('postModal');
        if (event.target == modal) {
            closeModal();
        }
    };
</script>


    <?php
    get_footer();
    ?>
</body>

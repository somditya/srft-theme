<?php
/*
Template Name: Production
*/

get_header();
$current_language = get_locale();

function get_category_ID($cat_name) {
    $cat = get_term_by('name', $cat_name, 'category');
    return $cat ? $cat->term_id : 0;
}

$category_name = 'production';
$category_id = get_category_ID($category_name);
?>

<div data-ng-controller="StudentController" data-scroll-container>
    <main>
        <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
            <div class="page-banner">
                <h1 class="page-banner-title"><?php echo __('Students', 'srft-theme'); ?></h1>
            </div>
        </section>

        <div class="container-aligned">
            <div class="breadcrumbs-wrapper">
                <?php
                if (function_exists('yoast_breadcrumb')) {
                    yoast_breadcrumb('<nav aria-label="breadcrumbs" id="breadcrumbs">', '</nav>');
                }
                ?>
            </div>
        </div>

        <section class="cine-detail">
            <div class="leftnav">
                <div class="widget" style="line-height: 1.5; margin-top: 1rem;">
                    <h4><?php echo __('Student Association', 'srft-theme'); ?> </h4>
            <?php 
                if ($current_language === 'en_US') {
                    $catslug = 'document-en'; 
                } else {
                    $catslug = 'document-hi';
                }

                $download_post = new WP_Query(array(
                    'post_type' => 'document',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field'    => 'slug',
                            'terms'    => $catslug,
                        ),
                    ),
                    'posts_per_page' => -1,       
                ));

                if ($download_post->have_posts()) {
                    echo '<ul style="list-style-type: none">';
                    while ($download_post->have_posts()) {
                        $download_post->the_post(); 
                        // ACF Fields
                        $document_file = get_field('document');
                        $document_category = get_field('document-category'); // Returns an array with URL and other data
                        $document_description = get_field('document_description');
                        if ($document_category === 'Students') {
                            if ($document_file) :
                                // Get the file URL, file size, and file type (mime type)
                                $file_url = $document_file['url'];
                                $file_id = $document_file['ID'];
                                $file_size = @filesize(get_attached_file($file_id)); // Suppress errors with @
                                $file_type_info = wp_check_filetype($file_url);
                                $file_type = isset($file_type_info['ext']) ? strtoupper($file_type_info['ext']) : 'Unknown';
                                $file_size_mb = ($file_size !== false) ? size_format($file_size, 2) : 'Unknown'; // Convert file size to MB with 2 decimal points
                                ?>
                                <li>
                                    <a href="<?php echo esc_url($file_url); ?>" target="_blank" rel="noopener" title="opens in a new tab">
                                        <?php echo esc_html(get_the_title()); ?> 
                                        (<?php echo esc_html($file_type); ?> - <?php echo esc_html($file_size_mb); ?>)
                                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pdf_icon_resized.png" alt="" style="vertical-align: middle;" />
                                    </a>
                                </li>
                            <?php endif; 
                        }
                    }
                    echo '</ul>';
                } else {
                    echo __('No posts found in the specified category.', 'srft-theme');
                }

                wp_reset_postdata(); // Reset after custom query
                ?> 
                </div>
            </div>
            <div class="main-content">
                <h2 class="page-header-text" style="padding-left: 0; text-align: center;"><?php echo __('Students’ Highlights', 'srft-theme'); ?></h2>

                <section style="width: 100%; padding: 2.8rem 0;" id="student-slider" role="region" aria-label="Student news carousel" aria-describedby="carousel-instructions">
                    <p id="carousel-instructions" class="sr-only">
    This is a carousel. Use the next and previous controls to navigate between student news items.
  </p>
                    <div class="frame">
                        <ul class="slider" style="height: 370px;">
                            <?php
                            $post_id = get_the_ID();
                            $post_content = apply_filters('the_content', $post->post_content);

                            $catslug = ($current_language === 'en_US') ? 'studentnews-en' : 'studentnews-hi';
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
                                    <li>
                                        <div class="news-item" style="background-color: #0b6b39;">
                                            <a href="<?php the_permalink(); ?>" target="_blank">
                                                <img typeof="foaf:Image" class="img-responsive lazyOwl" src="<?php echo get_field('News-Image'); ?>" alt="" style="display: block;">
                                                <div class="news-item-title">
                                                    <h3 style="color: white;"><?php the_title(); ?></h3>
                                                    <p style="color: white; flex: 1;"><?php echo $post_content; ?></p>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                            <?php
                                endwhile;
                                wp_reset_postdata();
                            else :
                                echo '<p>No posts found in this category.</p>';
                            endif;
                            ?>
                        </ul>
                    </div>

                    <section class="section-home">
                        <div class="container" style="width: 100%;">
                            <h2 class="page-header-text" style="padding-left: 0; text-align: center;"><?php echo __('Student Films', 'srft-theme'); ?></h2>
                            <div data-ng-app="myApp" data-ng-controller="ProductionController" style="margin-top: 4.5rem;">
                                <ul class="award-tree">
                                    <li data-ng-repeat="production in productionList.slice((currentPage - 1) * itemsPerPage, currentPage * itemsPerPage)">
                                        <button type="button" class="production-btn"
                                            data-ng-click="openModal(production.name, production.content, $event)" aria-label="View details of {{ production.name }} student film projects"
    aria-haspopup="dialog"
                                            style="display: flex; align-items: center; padding: 0; margin-bottom: 10px; background: white;">
                                            <img src="<?php bloginfo('template_url'); ?>/images/leftleaf.png" height="100" alt="">
                                            <h3 style="font-size: 16px; width: 100%; white-space: nowrap; color: #161a1d; margin: 0;">
                                                {{ production.name }}
                                            </h3>
                                            <img src="<?php bloginfo('template_url'); ?>/images/rightleaf.png" height="100" alt="">
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </section>
                </section>
            </div>
        </section>

        <!-- Modal -->
<div id="postModal" role="dialog" class="hidden modal-overlay" aria-hidden="true" aria-modal="true" aria-labelledby="modalTitle">
  <div class="modal-content">
    <button class="close" aria-label="Close modal">✕</button>
    <div id="modalTitle"></div>
    <div id="modalContent" class="modal-body"></div>
  </div>
</div>

<!--<div id="ariaLiveRegion" class="sr-only" aria-live="assertive" aria-atomic="true"></div>-->

        <script>
            var categoryID = <?php echo json_encode($category_id); ?>;
            var siteURL = '<?php echo esc_url(site_url('/')); ?>';

            angular.module('myApp', [])
                .controller('ProductionController', function ($scope, $http) {
                    $scope.currentPage = 1;
                    $scope.itemsPerPage = 14;

                    $http.get(siteURL + 'wp-json/wp/v2/posts?categories=' + categoryID + '&per_page=100')
                        .then(function (response) {
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

                    $scope.openModal = function (title, content, $event) {
    const modal = document.getElementById('postModal');
    const titleBox = document.getElementById('modalTitle');
    const contentBox = document.getElementById('modalContent');
    const closeBtn = modal.querySelector('.close');
    const liveRegion = document.getElementById('ariaLiveRegion');

    // Fill modal content
    titleBox.innerHTML = `<h2><?php echo __('Students Film Batch', 'srft-theme'); ?> ${title}</h2>`;
    contentBox.innerHTML = content;

    // Announce opening
    /*liveRegion.textContent = `Dialog opened. Students Film Batch ${title}. Press Tab to navigate inside.`;*/

    // Track the triggering button
    const triggerBtn = $event.currentTarget;

    // Show modal
    modal.classList.remove('hidden');
    modal.setAttribute('aria-hidden', 'false');

    // Move focus to close button
    closeBtn.focus();

    // Collect all focusable elements in modal
    const focusableSelectors =
      'a[href], button:not([disabled]), textarea, input, select, [tabindex]:not([tabindex="-1"])';
    const focusableEls = modal.querySelectorAll(focusableSelectors);
    const firstEl = focusableEls[0];
    const lastEl = focusableEls[focusableEls.length - 1];

    // Focus trap (only for Tab / Shift+Tab)
    function trapFocus(e) {
        if (e.key !== 'Tab') return; // allow arrows and everything else

        if (e.shiftKey) {
            // Shift + Tab
            if (document.activeElement === firstEl) {
                e.preventDefault();
                lastEl.focus();
            }
        } else {
            // Tab
            if (document.activeElement === lastEl) {
                e.preventDefault();
                firstEl.focus();
            }
        }
    }

    // Close modal
    function closeModal() {
        modal.classList.add('hidden');
        modal.setAttribute('aria-hidden', 'true');
        titleBox.innerHTML = '';
        contentBox.innerHTML = '';

        // Announce closing
        /*liveRegion.textContent = 'Dialog closed. Returning to main content.';*/

        // Restore focus to the trigger button
        triggerBtn.focus();

        // Cleanup listeners
        closeBtn.removeEventListener('click', closeModal);
        document.removeEventListener('keydown', escHandler);
        document.removeEventListener('keydown', trapFocus);
        modal.removeEventListener('click', outsideHandler);
    }

    // Escape closes
    function escHandler(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    }

    // Clicking outside closes
    function outsideHandler(e) {
        if (e.target === modal) {
            closeModal();
        }
    }

    // Attach listeners
    closeBtn.addEventListener('click', closeModal);
    document.addEventListener('keydown', escHandler);
    document.addEventListener('keydown', trapFocus);
    modal.addEventListener('click', outsideHandler);
};

                });
        </script>

<?php get_footer(); ?>

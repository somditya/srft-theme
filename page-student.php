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

<div data-scroll-container>
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
    echo '<ul style="list-style-type: none; padding-left: 0;">';
    while ($download_post->have_posts()) {
        $download_post->the_post(); 
        
        // Use get_post_meta instead of get_field
        $file_id = get_post_meta(get_the_ID(), 'document', true);
        $document_category = get_post_meta(get_the_ID(), 'document-category', true);
        $document_description = get_field('document_description');
        
        // Handle array format for document-category
        if (is_array($document_category)) {
            $document_category = $document_category['value'] ?? '';
        }
        
        // Check if category is Students and file exists
        if ($document_category === 'Students' && $file_id) {
            $file_url = wp_get_attachment_url((int)$file_id);
            
            if ($file_url) {
                $file_size = @filesize(get_attached_file($file_id));
                $file_type_info = wp_check_filetype($file_url);
                $file_type = isset($file_type_info['ext']) ? strtoupper($file_type_info['ext']) : 'Unknown';
                $file_size_mb = ($file_size !== false) ? size_format($file_size, 2) : 'Unknown';
                ?>
                <li style="margin-bottom: 1rem;">
                    <a href="<?php echo esc_url($file_url); ?>" target="_blank" rel="noopener" title="opens in a new tab">
                        <?php echo esc_html(get_the_title()); ?> 
                        (<?php echo esc_html($file_type); ?> - <?php echo esc_html($file_size_mb); ?>)
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pdf_icon_resized.png" alt="PDF icon" style="vertical-align: middle;" />
                    </a>
                </li>
                <?php
            }
        }
    }
    echo '</ul>';
} else {
    echo '<p>' . __('No posts found in the specified category.', 'srft-theme') . '</p>';
}

wp_reset_postdata();
?> 
                </div>
                <h2 style="margin-top: 2.5rem; border-bottom: 1px solid #6c4713; "> <?php echo __('Related Links:', 'srft-theme'); ?></a></li>
        </ul></h2>
                <div class="childnav-lists" role="complementary">
        <ul style="list-style-type: none; padding-left: 0;">
          <li><a class="item" href="<?php echo (function_exists('pll_current_language') && pll_current_language() === 'hi') 
         ? 'https://srfti.ac.in/hi/छात्र-शिकायत-निवारण-समित/' 
         : 'https://srfti.ac.in/student-grievance-redressal-committee/'; ?>"  target="_blank" title="Students Grievance Redressal Committee"><?php echo __('Student Grievance Redressal Committee', 'srft-theme'); ?></a></li>
        </ul>
        </div>
            </div>
            <div class="main-content">
                <h2 class="page-header-text" style="padding-left: 0; text-align: center;"><?php echo __('Students’ Highlights', 'srft-theme'); ?></h2>

                <section style="width: 100%; padding: 2.8rem 0;" id="student-slider" role="region" aria-label="Student news carousel" aria-describedby="carousel-instructions">
                    <!--<p id="carousel-instructions" class="sr-only">
    This is a carousel. Use the next and previous controls to navigate between student news items.
  </p>-->
                    <div class="frame" aria-label="Students' Highlights" aria-roledescription="carousel">
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
                                    <li role="group" aria-roledescription="slide">
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
                            <div id="production-app" style="margin-top: 4.5rem;">
                                <ul id="production-list" class="award-tree" aria-label="<?php echo esc_attr__('Student Films', 'srft-theme'); ?>"></ul>
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
        (function () {
            'use strict';

            const categoryID = <?php echo wp_json_encode(absint($category_id)); ?>;
            const siteURL = <?php echo wp_json_encode(esc_url_raw(site_url('/'))); ?>;

            const apiURL =
                siteURL +
                'wp-json/wp/v2/posts?categories=' +
                encodeURIComponent(categoryID) +
                '&per_page=100';

            const itemsPerPage = 14;

            const productionList = document.getElementById('production-list');
            const modal = document.getElementById('postModal');
            const titleBox = document.getElementById('modalTitle');
            const contentBox = document.getElementById('modalContent');
            const closeBtn = modal ? modal.querySelector('.close') : null;

            let productions = [];
            let currentPage = 1;
            let lastTriggerButton = null;

            /*
             * Decode WordPress REST API rendered title safely.
             * WordPress may return HTML entities such as &amp; in title.rendered.
             */
            function decodeHtml(value) {
                if (typeof value !== 'string') {
                    return '';
                }

                const parser = new DOMParser();
                const documentFragment = parser.parseFromString(value, 'text/html');
                return documentFragment.body.textContent || '';
            }

            /*
             * Validate URLs before assigning them to DOM properties.
             */
            function getSafeUrl(value) {
                if (!value || typeof value !== 'string') {
                    return '';
                }

                try {
                    const url = new URL(value, window.location.origin);

                    if (url.protocol === 'http:' || url.protocol === 'https:') {
                        return url.href;
                    }
                } catch (error) {
                    console.warn('Invalid URL:', value);
                }

                return '';
            }

            /*
             * Create a student-film button.
             */
            function createProductionButton(production) {
                const li = document.createElement('li');

                const button = document.createElement('button');
                button.type = 'button';
                button.className = 'production-btn';
                button.setAttribute(
                    'aria-label',
                    '<?php echo esc_js(__('View details of', 'srft-theme')); ?> ' +
                    production.name +
                    ' <?php echo esc_js(__('student film projects', 'srft-theme')); ?>'
                );
                button.setAttribute('aria-haspopup', 'dialog');
                button.style.display = 'flex';
                button.style.alignItems = 'center';
                button.style.padding = '0';
                button.style.marginBottom = '10px';
                button.style.background = 'white';

                const leftLeaf = document.createElement('img');
                leftLeaf.src = <?php echo wp_json_encode(esc_url(get_template_directory_uri() . '/images/leftleaf.png')); ?>;
                leftLeaf.height = 100;
                leftLeaf.alt = '';

                const heading = document.createElement('h3');
                heading.style.fontSize = '16px';
                heading.style.width = '100%';
                heading.style.whiteSpace = 'nowrap';
                heading.style.color = '#161a1d';
                heading.style.margin = '0';
                heading.textContent = production.name;

                const rightLeaf = document.createElement('img');
                rightLeaf.src = <?php echo wp_json_encode(esc_url(get_template_directory_uri() . '/images/rightleaf.png')); ?>;
                rightLeaf.height = 100;
                rightLeaf.alt = '';

                button.appendChild(leftLeaf);
                button.appendChild(heading);
                button.appendChild(rightLeaf);

                button.addEventListener('click', function () {
                    openModal(production.name, production.content, button);
                });

                li.appendChild(button);

                return li;
            }

            /*
             * Render the current page.
             */
            function renderProductions() {
                if (!productionList) {
                    return;
                }

                productionList.replaceChildren();

                const startIndex = (currentPage - 1) * itemsPerPage;
                const pageItems = productions.slice(
                    startIndex,
                    startIndex + itemsPerPage
                );

                pageItems.forEach(function (production) {
                    productionList.appendChild(
                        createProductionButton(production)
                    );
                });
            }

            /*
             * Open the student-film modal.
             */
            function openModal(title, content, triggerButton) {
                if (!modal || !titleBox || !contentBox || !closeBtn) {
                    return;
                }

                lastTriggerButton = triggerButton;

                /*
                 * The title is inserted as text, not HTML.
                 */
                titleBox.replaceChildren();

                const heading = document.createElement('h2');
                heading.textContent =
                    '<?php echo esc_js(__('Students Film Batch', 'srft-theme')); ?> ' +
                    title;

                titleBox.appendChild(heading);

                /*
                 * post.content.rendered is HTML generated by WordPress.
                 * Preserve the formatted WordPress content in the modal.
                 */
                contentBox.innerHTML = content || '';

                modal.classList.remove('hidden');
                modal.setAttribute('aria-hidden', 'false');

                closeBtn.focus();

                document.addEventListener('keydown', escHandler);
                document.addEventListener('keydown', trapFocus);
                modal.addEventListener('click', outsideHandler);
            }

            /*
             * Close the modal.
             */
            function closeModal() {
                if (!modal || !titleBox || !contentBox || !closeBtn) {
                    return;
                }

                modal.classList.add('hidden');
                modal.setAttribute('aria-hidden', 'true');

                titleBox.replaceChildren();
                contentBox.replaceChildren();

                closeBtn.removeEventListener('click', closeModal);
                document.removeEventListener('keydown', escHandler);
                document.removeEventListener('keydown', trapFocus);
                modal.removeEventListener('click', outsideHandler);

                if (
                    lastTriggerButton &&
                    document.contains(lastTriggerButton)
                ) {
                    lastTriggerButton.focus();
                }

                lastTriggerButton = null;
            }

            /*
             * Escape closes the modal.
             */
            function escHandler(event) {
                if (event.key === 'Escape') {
                    closeModal();
                }
            }

            /*
             * Close when clicking the overlay.
             */
            function outsideHandler(event) {
                if (event.target === modal) {
                    closeModal();
                }
            }

            /*
             * Keep keyboard focus inside the modal.
             */
            function trapFocus(event) {
                if (event.key !== 'Tab' || !modal) {
                    return;
                }

                const focusableSelectors =
                    'a[href], button:not([disabled]), textarea, input, select, [tabindex]:not([tabindex="-1"])';

                const focusableEls =
                    modal.querySelectorAll(focusableSelectors);

                if (!focusableEls.length) {
                    return;
                }

                const firstEl = focusableEls[0];
                const lastEl = focusableEls[focusableEls.length - 1];

                if (event.shiftKey) {
                    if (document.activeElement === firstEl) {
                        event.preventDefault();
                        lastEl.focus();
                    }
                } else {
                    if (document.activeElement === lastEl) {
                        event.preventDefault();
                        firstEl.focus();
                    }
                }
            }

            /*
             * Attach the close listener once.
             */
            if (closeBtn) {
                closeBtn.addEventListener('click', closeModal);
            }

            /*
             * Load student-film posts from the existing WordPress REST API.
             */
            fetch(apiURL, {
                method: 'GET',
                credentials: 'same-origin',
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(function (response) {
                if (!response.ok) {
                    throw new Error(
                        'HTTP error: ' + response.status
                    );
                }

                return response.json();
            })
            .then(function (data) {
                if (!Array.isArray(data)) {
                    throw new Error(
                        'Unexpected REST API response.'
                    );
                }

                productions = data.map(function (post) {
                    return {
                        name: decodeHtml(
                            post && post.title
                                ? post.title.rendered
                                : ''
                        ),

                        content:
                            post && post.content
                                ? post.content.rendered || ''
                                : '',

                        link: getSafeUrl(
                            post ? post.link : ''
                        ),

                        featured_media:
                            post && post.featured_media
                                ? parseInt(
                                    post.featured_media,
                                    10
                                )
                                : 0
                    };
                });

                currentPage = 1;
                renderProductions();
            })
            .catch(function (error) {
                console.error(
                    'Error fetching production data:',
                    error
                );

                productions = [];
                renderProductions();
            });

        })();
        </script>

<?php get_footer(); ?>
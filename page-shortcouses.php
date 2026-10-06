<?php
/*
Template Name: Short Courses
*/

get_header();

$post_id = get_the_ID();
$catslug = get_the_category($post_id);
$page_content = apply_filters('the_content', $post->post_content);
$current_language = get_locale();
?>

<div data-scroll-container>

    <main id="skip-to-content">

        <section
            class="cine-header"
            style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');"
        >
            <div class="page-banner">

                <div class="page-banner-title">
                    <?php echo __('Admission to short courses', 'srft-theme'); ?>
                </div>

            </div>
        </section>


        <section class="cine-detail">

            <div class="leftnav">

                <div class="childnavs">

                    <ul class="childnav-lists">

                        <?php

                        $current_language = get_locale();

                        $menu_name =
                            ($current_language === 'hi_IN')
                                ? 'hindi_shortadmission_menu'
                                : 'english_shortadmission_menu';

                        $current_page_title = get_the_title();


                        class Custom_Walker_Nav_Menu extends Walker_Nav_Menu
                        {
                            public function start_lvl(
                                &$output,
                                $depth = 0,
                                $args = null
                            ) {
                                $output .= '<ul class="submenu">';
                            }


                            public function start_el(
                                &$output,
                                $item,
                                $depth = 0,
                                $args = null,
                                $current_object_id = 0
                            ) {
                                $is_current =
                                    ($item->title === $GLOBALS['current_page_title'])
                                        ? 'active'
                                        : '';

                                $output .=
                                    '<li class="childnav-list-item ' .
                                    $is_current .
                                    '">';

                                $output .=
                                    '<a class="item" href="' .
                                    esc_url($item->url) .
                                    '">' .
                                    esc_html($item->title) .
                                    '</a>';
                            }


                            public function end_el(
                                &$output,
                                $item,
                                $depth = 0,
                                $args = null
                            ) {
                                $output .= '</li>';
                            }


                            public function end_lvl(
                                &$output,
                                $depth = 0,
                                $args = null
                            ) {
                                $output .= '</ul>';
                            }
                        }


                        wp_nav_menu(
                            array(
                                'menu'       => $menu_name,
                                'container'  => false,
                                'menu_class' => 'childnav-lists',
                                'walker'     => new Custom_Walker_Nav_Menu(),
                            )
                        );

                        ?>

                    </ul>

                </div>


                <div
                    class="widget"
                    style="line-height: 1.5"
                >

                    <h3>
                        Admission Notification
                    </h3>

                    <ul style="list-style-type: none;">
                    </ul>

                </div>

            </div>


            <div class="main-content">

                <section class="page-title">

                    <div>

                        <p class="page-header-text">
                            <?php the_title(); ?>
                        </p>

                    </div>

                </section>


                <section style="margin-bottom: 4rem;">

                    <div>
                        <?php the_content(); ?>
                    </div>


                    <div class="wrapper">

                        <div
                            class="Rtable Rtable--5cols Rtable--collapse"
                        >

                            <div class="Rtable-row Rtable-row--head">

                                <div
                                    class="Rtable-cell openmeeting-cell column-heading"
                                >
                                    <?php
                                    echo __(
                                        'Course',
                                        'srft-theme'
                                    );
                                    ?>
                                </div>


                                <div
                                    class="Rtable-cell openmeeting-cell column-heading"
                                >
                                    <?php
                                    echo __(
                                        'Category',
                                        'srft-theme'
                                    );
                                    ?>
                                </div>


                                <div
                                    class="Rtable-cell date-cell column-heading"
                                >
                                    <?php
                                    echo __(
                                        'Date+Length',
                                        'srft-theme'
                                    );
                                    ?>
                                </div>


                                <div
                                    class="Rtable-cell slno-cell column-heading"
                                >
                                    <?php
                                    echo __(
                                        'Location',
                                        'srft-theme'
                                    );
                                    ?>
                                </div>


                                <div
                                    class="Rtable-cell slno-cell column-heading"
                                >
                                    <?php
                                    echo __(
                                        'Fees',
                                        'srft-theme'
                                    );
                                    ?>
                                </div>


                                <div
                                    class="Rtable-cell slno-cell column-heading"
                                >
                                    <?php
                                    echo __(
                                        'Status',
                                        'srft-theme'
                                    );
                                    ?>
                                </div>

                            </div>


                            <?php

                            if ($current_language === 'en_US') {
                                $catslug = 'shortcourse-en';
                            } else {
                                $catslug = 'shortcourse-hi';
                            }


                            $category_posts = new WP_Query(
                                array(
                                    'category_name' => $catslug,
                                )
                            );


                            $count = 1;


                            if (
                                $category_posts->have_posts()
                            ) :

                                while (
                                    $category_posts->have_posts()
                                ) :

                                    $category_posts->the_post();

                                    ?>

                                    <div class="Rtable-row">

                                        <div
                                            class="Rtable-cell openmeeting-cell"
                                        >

                                            <div
                                                class="Rtable-cell--content"
                                            >
                                                <a
                                                    href="<?php the_permalink(); ?>"
                                                >
                                                    <?php the_title(); ?>
                                                </a>
                                            </div>

                                        </div>


                                        <div
                                            class="Rtable-cell openmeeting-cell"
                                        >

                                            <div
                                                class="Rtable-cell--content"
                                            >
                                                <?php
                                                echo get_post_meta(
                                                    get_the_ID(),
                                                    'ShortCourseCategory',
                                                    true
                                                );
                                                ?>
                                            </div>

                                        </div>


                                        <div
                                            class="Rtable-cell date-cell"
                                        >

                                            <div
                                                class="Rtable-cell--content"
                                            >
                                                <?php
                                                echo get_post_meta(
                                                    get_the_ID(),
                                                    'ShortCourseLength',
                                                    true
                                                );
                                                ?>
                                            </div>

                                        </div>


                                        <div
                                            class="Rtable-cell slno-cell"
                                        >

                                            <div
                                                class="Rtable-cell--content"
                                            >
                                                <?php
                                                echo get_post_meta(
                                                    get_the_ID(),
                                                    'ShortCourseLocation',
                                                    true
                                                );
                                                ?>
                                            </div>

                                        </div>


                                        <div
                                            class="Rtable-cell slno-cell"
                                        >

                                            <div
                                                class="Rtable-cell--content"
                                            >
                                                <?php
                                                echo get_post_meta(
                                                    get_the_ID(),
                                                    'ShortCourseFee',
                                                    true
                                                );
                                                ?>
                                            </div>

                                        </div>


                                        <div
                                            class="Rtable-cell slno-cell"
                                        >

                                            <div
                                                class="Rtable-cell--content"
                                            >
                                                <?php
                                                echo get_post_meta(
                                                    get_the_ID(),
                                                    'ShortCourseStatus',
                                                    true
                                                );
                                                ?>
                                            </div>

                                        </div>

                                    </div>

                                    <?php

                                    $count++;

                                endwhile;


                                wp_reset_postdata();


                            else :

                                echo '<p>No posts found in this category.</p>';

                            endif;

                            ?>

                        </div>

                    </div>

                </section>

            </div>

        </section>

    </main>

</div>

<?php
get_footer();
?>
<?php get_header(); ?>

<div class="search-container" style="margin: 15rem auto;  max-width: 1250px; padding: 20px; box-sizing: border-box;">
    <h1 style="margin-bottom: 4rem;">Search Results for: <span><?php echo esc_html(get_search_query()); ?></span></h1>

    <?php if (have_posts()) : ?>
        <div class="search-results-list" style="display: flex; flex-direction: column; gap: 20px;">
            <?php while (have_posts()) : the_post(); ?>
                <div class="search-result-item" style="padding: 20px; background-color: #fff; border: 1px solid #ddd; border-radius: 8px;">
                    <h2 style="font-size: 1.5rem; margin-bottom: 10px;">
                        <a href="<?php the_permalink(); ?>" style="text-decoration: none; "><?php the_title(); ?></a>
                    </h2>
                    <p style="color: #555;"><?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?></p>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Pagination -->
				<div class="pagination-container" style="margin-top: 2rem; text-align: center;">
    <ul class="pagination">
        <?php
        $pagination = paginate_links([
            'prev_text' => '&laquo; Previous',
            'next_text' => 'Next &raquo;',
            'type'      => 'array',
        ]);

        if ($pagination) {
            foreach ($pagination as $page) {
                echo '<li>' . $page . '</li>';
            }
        }
        ?>
    </ul>
</div>

    <?php else : ?>
        <div class="no-results" style="text-align: center; margin-top: 2rem;">
            <p style="font-size: 1.2rem; color: #333;">No results found. Please try a different search term.</p>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>

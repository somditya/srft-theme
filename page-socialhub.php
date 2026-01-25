<?php
/**
 * Template Name: Social Hub (Live Feeds)
 * Description: Accessible Social Media Hub with live API feeds (Instagram, Facebook, YouTube)
 */
get_header();
?>

<main id="primary" class="site-main social-hub">

  <!-- Page Header -->
  <header class="social-hub-header">
    <div class="hub-title">
      <h1><?php the_title(); ?></h1>
      <p class="hub-subtitle">SRFTI’s social presence</p>
    </div>
  </header>

  <!-- Filters (UI only – JS optional) -->
  <section class="social-hub-filters" aria-label="Social feed filters">
    <div class="filter-tabs" role="tablist">
      <button role="tab" aria-selected="true">All</button>
      <button role="tab">Instagram</button>
      <button role="tab">Facebook</button>
      <button role="tab">YouTube</button>
    </div>
  </section>

  <!-- Social Feed -->
  <section class="social-feed" aria-labelledby="social-feed-heading">
    <h2 id="social-feed-heading" class="sr-only">Latest social media updates</h2>

    <ul class="social-grid" role="list">

      <?php
      /* =====================
       * INSTAGRAM FEED
       * ===================== */
      $instagram = srft_fetch_social_feed('instagram');

      if (!empty($instagram['data'])) :
        foreach ($instagram['data'] as $item) :
      ?>
        <li class="social-card instagram" role="listitem">
          <article>
            <header class="card-header">
              <span class="platform-badge instagram" aria-label="Instagram"></span>
              <strong>Instagram</strong>
            </header>

            <?php if (!empty($item['media_url'])) : ?>
              <img src="<?php echo esc_url($item['media_url']); ?>"
                   alt="<?php echo esc_attr(wp_trim_words($item['caption'] ?? 'Instagram post', 12)); ?>"
                   loading="lazy">
            <?php endif; ?>

            <?php if (!empty($item['caption'])) : ?>
              <p><?php echo esc_html(wp_trim_words($item['caption'], 20)); ?></p>
            <?php endif; ?>

            <footer class="card-footer">
              <time datetime="<?php echo esc_attr($item['timestamp']); ?>">
                <?php echo esc_html(date_i18n(get_option('date_format'), strtotime($item['timestamp']))); ?>
              </time>
              <a href="<?php echo esc_url($item['permalink']); ?>" target="_blank" rel="noopener">
                View on Instagram
              </a>
            </footer>
          </article>
        </li>
      <?php endforeach; endif; ?>

      <?php
      /* =====================
       * FACEBOOK FEED
       * ===================== */
      $facebook = srft_fetch_social_feed('facebook');

      if (!empty($facebook['data'])) :
        foreach ($facebook['data'] as $post) :
      ?>
        <li class="social-card facebook" role="listitem">
          <article>
            <header class="card-header">
              <span class="platform-badge facebook" aria-label="Facebook"></span>
              <strong>Facebook</strong>
            </header>

            <?php if (!empty($post['message'])) : ?>
              <p><?php echo esc_html(wp_trim_words($post['message'], 25)); ?></p>
            <?php endif; ?>

            <footer class="card-footer">
              <time datetime="<?php echo esc_attr($post['created_time']); ?>">
                <?php echo esc_html(date_i18n(get_option('date_format'), strtotime($post['created_time']))); ?>
              </time>
              <a href="<?php echo esc_url($post['permalink_url']); ?>" target="_blank" rel="noopener">
                View on Facebook
              </a>
            </footer>
          </article>
        </li>
      <?php endforeach; endif; ?>

      <?php
      /* =====================
       * YOUTUBE FEED
       * ===================== */
      $youtube = srft_fetch_social_feed('youtube');

      if (!empty($youtube['items'])) :
        foreach ($youtube['items'] as $video) :
          $vid = $video['id']['videoId'] ?? '';
          if (!$vid) continue;
      ?>
        <li class="social-card youtube" role="listitem">
          <article>
            <header class="card-header">
              <span class="platform-badge youtube" aria-label="YouTube"></span>
              <strong>YouTube</strong>
            </header>

            <img src="<?php echo esc_url($video['snippet']['thumbnails']['medium']['url']); ?>"
                 alt="<?php echo esc_attr($video['snippet']['title']); ?>"
                 loading="lazy">

            <p><?php echo esc_html(wp_trim_words($video['snippet']['title'], 18)); ?></p>

            <footer class="card-footer">
              <time datetime="<?php echo esc_attr($video['snippet']['publishedAt']); ?>">
                <?php echo esc_html(date_i18n(get_option('date_format'), strtotime($video['snippet']['publishedAt']))); ?>
              </time>
              <a href="https://www.youtube.com/watch?v=<?php echo esc_attr($vid); ?>" target="_blank" rel="noopener">
                Watch on YouTube
              </a>
            </footer>
          </article>
        </li>
      <?php endforeach; endif; ?>

    </ul>
  </section>

</main>

<?php get_footer(); ?>
<?php
/*
Template Name: Home */

 get_header();
 $excerpt = get_the_excerpt();  
 $current_language = get_locale();

?>


<div id="smooth-wrapper">
    <div id="smooth-content">
      <section class="section-home" style="background-color: #161a1d; padding: 10px;">
       <div class="acme-news-ticker" style="display: flex; align-items: center; gap: 15px;">
        
        <!-- Label -->
   <h2 class="acme-news-ticker-label">
    <span class="announcement-text">
        <span class="announcement-label-text"><?php echo __('Announcements', 'srft-theme' ); ?></span>
        <svg xmlns="http://www.w3.org/2000/svg" height="24 " viewBox="0 -960 960 960" width="24" fill="#2d2d2d" aria-hidden="true" style="display: flex; justify-content: center;"><path d="M850-450h-90q-12.75 0-21.37-8.68-8.63-8.67-8.63-21.5 0-12.82 8.63-21.32 8.62-8.5 21.37-8.5h90q12.75 0 21.38 8.68 8.62 8.67 8.62 21.5 0 12.82-8.62 21.32-8.63 8.5-21.38 8.5ZM677-274q8-10 19.83-12 11.82-2 22.17 6l73 54q10 8 12 19.83 2 11.82-6 22.17-8 10-19.83 12-11.82 2-22.17-6l-73-54q-10-8-12-19.83-2-11.82 6-22.17Zm115-460-70 53q-10.35 8-22.17 6Q688-677 680-687q-8-10-6-22t12-20l70-53q10.35-8 22.17-6Q790-786 798-776q8 10 6 22t-12 20ZM210-360h-70q-24.75 0-42.37-17.63Q80-395.25 80-420v-120q0-24.75 17.63-42.38Q115.25-600 140-600h180l155-93q15-9 30-.06 15 8.93 15 26.06v374q0 17.13-15 26.06-15 8.94-30-.06l-155-93h-50v130q0 12.75-8.68 21.37-8.67 8.63-21.5 8.63-12.82 0-21.32-8.63-8.5-8.62-8.5-21.37v-130Zm250 14v-268l-124 74H140v120h196l124 74Zm100 0v-268q27 24 43.5 58.5T620-480q0 41-16.5 75.5T560-346ZM300-480Z" fill="#ffffff"/></svg>
    </span>
</h2>
        
        <!-- Scrolling Container -->
        <div class="acme-news-ticker-box" style="flex: 1; overflow: hidden; position: relative; height: 40px;">
    <?php
$locale = get_locale();
$current_language = function_exists('pll_current_language') ? pll_current_language('slug') : 'en';

$today = date('Ymd');

$args = array(
    'post_type'      => array('announcement', 'vacancy'),
    'posts_per_page' => -1,
    'meta_query'     => array(
        array(
            'key'     => 'highlight',
            'value'   => 'Yes',
            'compare' => '='
        ),
        array(
            'relation' => 'OR',
            array(
                'key'     => 'highlight_expiry_date',
                'compare' => 'NOT EXISTS'
            ),
            array(
                'key'     => 'highlight_expiry_date',
                'value'   => $today,
                'compare' => '>=',
                'type'    => 'DATE'
            )
        )
    ),
    'orderby' => 'date',
    'order'   => 'DESC'
);

$query = new WP_Query($args);
$filtered_posts = array();

if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();

        $highlight = get_field('highlight');
        $expiry    = get_field('highlight_expiry_date');

        if ($highlight == 'Yes') {
            if (empty($expiry) || $expiry >= $today) {
                $filtered_posts[] = get_post();
            }
        }

    endwhile;
endif;

wp_reset_postdata();

$post_count = count($filtered_posts);

// Wrapper
if ($post_count > 1) {
    echo '<ul class="news-ticker" style="display:flex; white-space:nowrap; margin:0; padding:0; list-style:none;">';
} else {
    echo '<div class="news-ticker" style="display:flex; white-space:nowrap; margin:0; padding:0;">';
}

if ($post_count > 0) :

    foreach ($filtered_posts as $post) :

        setup_postdata($post);

        $tag = ($post_count > 1) ? 'li' : 'span';

        echo '<' . $tag . ' style="padding:0 80px; display:inline-block;">';

        $post_type = get_post_type();

        $link   = get_permalink();
        $target = '_self';

        /**
         * Vacancy*/
        if ($post_type === 'vacancy') {

            $doc = get_field('Vacancy-Doc', get_the_ID());

            if (!empty($doc) && !empty($doc['url'])) {
                $link   = esc_url($doc['url']);
                $target = '_blank';
            }

        }

        /**
         * Announcement
         */
        elseif ($post_type === 'announcement') {

            $doc   = get_field('Announcement-Doc', get_the_ID());
            $image = get_field('Announcement-Image', get_the_ID());
            $text  = get_field('Announcement-Text', get_the_ID());

            // Remove HTML to check whether text is actually empty
            $plain_text = trim(wp_strip_all_tags($text));

            // Open PDF only if:
            // 1. Document exists
            // 2. No image
            // 3. No text
            if (
                !empty($doc) &&
                !empty($doc['url']) &&
                empty($image) &&
                empty($plain_text)
            ) {
                $link   = esc_url($doc['url']);
                $target = '_blank';
            }

        }
        ?>

        <a href="<?php echo esc_url($link); ?>"
           target="<?php echo esc_attr($target); ?>"
           style="color:white; text-decoration:none; line-height:40px;">

            <?php the_title(); ?>

        </a>

        <?php

        echo '</' . $tag . '>';

    endforeach;

    wp_reset_postdata();

else :

    echo '<span style="padding:0 80px; display:inline-block;">';
    echo '<span style="color:white; line-height:40px;">';
    echo __('No announcements at this time', 'srft-theme');
    echo '</span>';
    echo '</span>';

endif;

// Close wrapper
if ($post_count > 1) {
    echo '</ul>';
} else {
    echo '</div>';
}
?>
</div>
        
        <!-- Play/Pause Button at the end -->
        <button id="ticker-toggle" 
                type="button" 
                aria-label="Pause scrolling announcements"
                style="background: transparent; border: 1px solid white; color: white; 
                       padding: 8px 15px; cursor: pointer; border-radius: 4px; flex-shrink: 0;">
            <svg xmlns="http://www.w3.org/2000/svg" height="32 " viewBox="0 -960 960 960" width="32" fill="#2b2b2b" aria-hidden="true" style="display: flex; justify-content: center;"><path d="M533.85-220v-520H740v520H533.85ZM220-220v-520h206.54v520H220Zm359.23-45.39h115.38v-429.22H579.23v429.22Zm-313.84 0h115.76v-429.22H265.39v429.22Zm0-429.22v429.22-429.22Zm313.84 0v429.22-429.22Z" fill="#fff"/></svg>
        <span><!--<?php echo __('Pause', 'srft-theme'); ?>--></span>
        </button>
        <!-- ARIA Live Region -->
        <div id="ticker-announcement" class="sr-only" role="status" aria-live="polite" aria-atomic="true"></div>
        
    </div>
</section>
    </div>
</div>
        

<section class="section-news" style="background-color: #ffffff;" id="section-1">
    <h2 class="section-intro-header-text" style="display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px; flex-direction: row;">
        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48 " viewBox="0 0 64 64" fill="none" aria-hidden="true" style="display: flex; justify-content: center;">
<path d="M31.0039 2H33.0254L33.1426 2.05859L33.9629 2.26367L34.6953 2.55664L35.3691 2.9082L35.8672 3.25977L36.3945 3.66992L36.834 4.05078L37.127 4.28516L37.5078 4.60742L37.8301 4.87109L38.2109 5.19336L38.5332 5.45703L38.9141 5.7793L39.207 6.01367L39.5879 6.33594L39.998 6.6582L40.4375 7.03906L40.7598 7.30273L41.1406 7.625L41.4629 7.88867L41.9609 8.29883L42.3418 8.62109L42.9863 9.14844L43.3672 9.4707L43.6895 9.73438L44.0703 10.0566L44.1875 10.1445L54.2363 10.1738L54.9688 10.2324L55.4668 10.3496L55.9941 10.5547L56.4922 10.8184L56.873 11.1113L57.166 11.375L57.3711 11.5801L57.6641 11.9609L57.957 12.459L58.1914 13.0156L58.3379 13.6309L58.3672 13.8945L58.3965 14.5977V21.834L58.4258 21.9805L58.6895 22.1855L59.1875 22.5957L59.5684 22.918L60.2129 23.4453L60.5938 23.7676L61.2383 24.2949L61.5898 24.6172L61.8535 25.0273L62 25.3496V56.5801L61.9414 56.6094L61.7656 57.3418L61.5898 57.8691L61.3555 58.3965L61.1797 58.748L60.916 59.1582L60.6816 59.4805L60.418 59.8027L60.1543 60.0957L59.8906 60.3594L59.4805 60.6816L59.1582 60.916L58.7188 61.1797L58.2793 61.4141L57.6934 61.6484L57.0195 61.8535L56.4336 61.9707L56.375 62H7.6543L7.27344 61.9121L6.45312 61.707L5.92578 61.502L5.31055 61.209L4.8418 60.916L4.49023 60.6523L4.16797 60.3887L3.52344 59.7441L3.14258 59.2461L2.79102 58.6895L2.55664 58.2207L2.38086 57.8105L2.20508 57.2832L2.0293 56.5215L2 56.4629V25.3203H2.05859L2.08789 25.1445L2.29297 24.7637L2.55664 24.4707L2.84961 24.207L3.14258 23.9727L3.52344 23.6504L3.81641 23.416L4.22656 23.0645L4.51953 22.8301L4.90039 22.5078L5.19336 22.2734L5.54492 21.9805H5.60352V14.1875L5.66211 13.6016L5.7793 13.1035L5.95508 12.6348L6.24805 12.0781L6.51172 11.7266L6.77539 11.4336L7.06836 11.1406L7.50781 10.8184L8.03516 10.5254L8.50391 10.3496L9.00195 10.2324L9.73438 10.1738L19.8125 10.1445L20.1934 9.82227L20.5156 9.55859L20.8965 9.23633L21.2188 8.97266L21.5996 8.65039L21.9219 8.38672L22.4199 7.97656L22.8301 7.625L23.123 7.39062L23.5039 7.06836L23.8262 6.80469L24.207 6.48242L24.5293 6.21875L24.9102 5.89648L25.877 5.10547L26.2578 4.7832L26.5801 4.51953L26.9609 4.19727L27.2832 3.93359L27.6641 3.61133L28.1621 3.23047L28.4551 3.02539L28.8359 2.79102L29.627 2.41016L30.2422 2.20508L30.9746 2.0293L31.0039 2ZM31.8828 5.51562L31.2676 5.60352L30.8281 5.75L30.3594 6.01367L30.0371 6.27734L29.5684 6.6582L29.1582 7.00977L28.8652 7.24414L28.4844 7.56641L28.1621 7.83008L27.6641 8.24023L27.2832 8.5625L26.9609 8.82617L26.5801 9.14844L26.2578 9.41211L25.7598 9.82227L25.3496 10.1445V10.1738L30.9746 10.2031H33.4648L38.6211 10.1738V10.1152L38.3867 9.93945L37.9766 9.58789L37.6543 9.32422L37.2734 9.00195L36.9512 8.73828L36.5703 8.41602L36.2773 8.18164L35.8965 7.85938L35.6035 7.625L35.1934 7.27344L34.7832 6.95117L34.4902 6.6875L34.0801 6.36523L33.6406 6.01367L33.2891 5.80859L32.8203 5.63281L32.4102 5.54492L31.8828 5.51562ZM9.76367 13.7188L9.4707 13.7773L9.26562 13.9531L9.17773 14.1289L9.14844 15.5645V27.957L9.44141 28.2207L9.76367 28.4844L10.1445 28.8066L10.4668 29.0703L10.9648 29.4805L11.3457 29.8027L11.7559 30.125L12.0195 30.3594L12.3418 30.623L12.7227 30.9453L13.0449 31.209L13.4258 31.5312L13.7188 31.7656L14.0996 32.0879L14.7441 32.6152L15.125 32.9375L15.4473 33.2012L15.8281 33.5234L16.1211 33.7578L16.502 34.0801L16.8242 34.3438L17.3223 34.7539L17.7031 35.0762L18.0254 35.3398L18.4062 35.6621L18.7285 35.9258L19.2266 36.3359L19.6074 36.6582L19.9004 36.8926L20.2812 37.2148L20.6035 37.4785L20.9844 37.8008L21.6289 38.3281L22.0098 38.6504L22.332 38.9141L22.8301 39.3242L23.2109 39.6465L23.5332 39.9102L23.9141 40.2324L24.2363 40.4961L24.6172 40.8184L24.9102 41.0527L25.291 41.375L25.6133 41.6387L26.1113 42.0488L26.4922 42.3711L26.8145 42.6348L27.1953 42.957L27.4883 43.1914L27.8691 43.5137L28.1914 43.7773L28.5723 44.0996L28.9824 44.4219L29.2461 44.6562L29.5684 44.9199L29.9492 45.2422L30.3301 45.5352L30.7402 45.7695L31.0918 45.916L31.6484 46.0332H32.3516L32.8789 45.916L33.3184 45.7402L33.7871 45.4473L34.5488 44.8027L34.8418 44.5684L35.2227 44.2461L35.8672 43.7188L36.248 43.3965L36.8926 42.8691L37.2734 42.5469L37.5957 42.2832L37.9766 41.9609L38.2695 41.7266L38.6797 41.375L38.9727 41.1406L39.3535 40.8184L39.6758 40.5547L40.0566 40.2324L40.3496 39.998L40.7305 39.6758L41.0527 39.4121L41.4336 39.0898L41.7266 38.8555L42.1074 38.5332L42.4297 38.2695L42.8105 37.9473L43.1035 37.7129L43.4844 37.3906L43.8066 37.127L44.1875 36.8047L44.4805 36.5703L44.8906 36.2188L45.1836 35.9844L45.5645 35.6621L45.8574 35.4277L46.2383 35.1055L46.5605 34.8418L46.9414 34.5195L47.5859 33.9922L47.9668 33.6699L48.6113 33.1426L48.9922 32.8203L49.3145 32.5566L49.6953 32.2344L50.0176 31.9707L50.3984 31.6484L50.6914 31.4141L51.0723 31.0918L51.3652 30.8574L51.7461 30.5352L52.0684 30.2715L52.4492 29.9492L52.7715 29.6855L53.1523 29.3633L53.4453 29.1289L53.8262 28.8066L54.1191 28.5723L54.5 28.25L54.793 28.0156L54.8223 27.9863V14.1582L54.7051 13.9238L54.5293 13.7773L54.207 13.7188H9.76367ZM5.54492 29.5684L5.51562 30.4473V55.0566L5.54492 55.877L5.63281 56.4043L5.66211 56.4922L5.80859 56.4629L6.24805 56.1699L7.06836 55.6133L7.53711 55.291L8.09375 54.9102L8.76758 54.4414L9.11914 54.207L9.67578 53.8262L10.3496 53.3574L10.7012 53.123L11.375 52.6543L12.1953 52.0977L12.8691 51.6289L13.2207 51.3945L14.2461 50.6914L14.8027 50.3105L15.4766 49.8418L16.6777 49.0215L18.9043 47.498L19.5488 47.0586L20.2227 46.5898L20.5742 46.3555L21.043 46.0332L21.7168 45.5645L22.4199 45.0957L22.918 44.7441L23.3867 44.4219L23.3574 44.334L23.0352 44.0703L22.625 43.7188L22.332 43.4844L21.9219 43.1328L21.6289 42.8984L21.248 42.5762L20.8379 42.2539L20.5742 42.0195L20.252 41.7559L19.7539 41.3457L19.373 41.0234L19.0801 40.7891L18.6699 40.4375L18.377 40.2031L17.9668 39.8516L17.5566 39.5293L17.2637 39.2656L16.8535 38.9434L16.4434 38.5918L16.1211 38.3281L15.7402 38.0059L15.3301 37.6836L15.0664 37.4492L14.7441 37.1855L14.3633 36.8633L14.041 36.5996L13.5723 36.2188L13.1621 35.8672L12.8691 35.6328L12.459 35.2812L12.0488 34.959L11.7559 34.6953L11.3457 34.373L10.9062 33.9922L10.6133 33.7578L10.2324 33.4355L9.91016 33.1719L9.5293 32.8496L9.23633 32.6152L8.82617 32.2637L8.5332 32.0293L8.03516 31.6191L7.6543 31.2969L7.33203 31.0332L6.95117 30.7109L6.6582 30.4766L6.24805 30.125L5.83789 29.8027L5.57422 29.5684H5.54492ZM58.4258 29.5684L58.1035 29.8613L57.8105 30.0957L57.4883 30.3594L57.0781 30.7109L56.7559 30.9746L56.375 31.2969L55.9648 31.6191L55.6719 31.8828L55.3789 32.1172L54.998 32.4395L54.6758 32.7031L54.2949 33.0254L53.8848 33.3477L53.5918 33.6113L53.2988 33.8457L52.9766 34.1094L52.5664 34.4609L52.2734 34.6953L51.8926 35.0176L51.5996 35.252L51.1895 35.6035L50.8965 35.8379L50.5156 36.1602L50.1934 36.4238L49.6953 36.834L49.3145 37.1562L48.9922 37.4199L48.6113 37.7422L48.3184 37.9766L47.9082 38.3281L47.6152 38.5625L47.2344 38.8848L46.8242 39.207L46.5312 39.4707L46.1211 39.793L45.8281 40.0566L45.418 40.3789L45.0078 40.7305L44.6855 40.9941L44.3047 41.3164L43.8945 41.6387L43.4551 42.0195L42.8105 42.5469L42.4297 42.8691L42.1074 43.1328L41.7266 43.4551L41.4043 43.7188L41.0234 44.041L40.6426 44.334L40.584 44.3926L41.1113 44.7734L41.668 45.1543L42.3418 45.623L42.6934 45.8574L42.9863 46.0625L43.6895 46.5312L44.0117 46.7656L44.7441 47.2637L45.2129 47.5859L45.8574 48.0254L47.3516 49.0508L47.8203 49.373L48.4648 49.8125L49.5781 50.5742L51.0723 51.5996L51.541 51.9219L52.1855 52.3613L53.2109 53.0645L54.7051 54.0898L55.1738 54.4121L55.9062 54.9102L57.4004 55.9355L58.1328 56.4336L58.2207 56.4922H58.3086L58.3965 56.1992L58.4551 55.7891V29.5684H58.4258ZM37.7422 46.7656L37.6836 46.7949V46.8535L37.5371 46.9121L37.0977 47.293L36.7754 47.5566L36.3945 47.8789L35.9551 48.2305L35.3398 48.6406L34.7539 48.9629L34.0801 49.2266L33.4355 49.4023L32.791 49.5195L32.4688 49.5488H31.4434L30.7695 49.4609L30.1836 49.3145L29.5977 49.1094L29.1289 48.9043L28.6016 48.6113L28.1035 48.2598L27.6934 47.9375L27.2832 47.5859L26.9609 47.3223L26.5801 47L26.3164 46.7949H26.1699L25.7598 47.0879L25.3203 47.3809L24.7637 47.7617L24.1191 48.2012L23.6504 48.5234L23.0938 48.9043L22.4199 49.373L21.6875 49.8711L21.2188 50.1934L20.6621 50.5742L20.0176 51.0137L19.3438 51.4824L18.9922 51.7168L18.3184 52.1855L17.8789 52.4785L17.4102 52.8008L15.916 53.8262L14.8906 54.5293L14.1875 54.998L13.8652 55.2324L13.3086 55.6133L12.4004 56.2285L12.0195 56.4922L11.4629 56.873L10.7891 57.3418L10.2324 57.7227L9.32422 58.3379L9.17773 58.4551H54.793L54.6758 58.3379L54.4121 58.1621L53.5625 57.5762L53.0059 57.1953L52.5371 56.873L51.8926 56.4336L51.3359 56.0527L50.8672 55.7305L50.1934 55.2617L49.8418 55.0273L49.168 54.5586L48.8164 54.3242L48.1426 53.8555L47.791 53.6211L47.1172 53.1523L46.7656 52.918L45.6523 52.1562L44.1582 51.1309L42.5762 50.0469L42.1074 49.7246L41.4629 49.2852L40.4375 48.582L39.4121 47.8789L38.7383 47.4102L38.3867 47.1758L37.918 46.8535L37.8008 46.7656H37.7422Z" fill="#5d3e00"/>
<path d="M19.1094 26.5801H44.8613L45.3008 26.6387L45.6523 26.7852L45.9453 26.9902L46.1797 27.1953L46.4434 27.6055L46.5898 28.0449L46.6191 28.2207V28.4844L46.502 28.9824L46.2969 29.3633L46.0625 29.6562L45.7402 29.8906L45.5059 30.0078L45.2129 30.0957L44.9785 30.125H18.9336L18.5527 30.0371L18.2012 29.8613L17.8789 29.5977L17.6445 29.2754L17.4688 28.9238L17.3809 28.543V28.1914L17.498 27.7227L17.7031 27.3418L18.0254 26.9902L18.3477 26.7852L18.6992 26.6387L19.1094 26.5801Z" fill="#5d3e00"/>
<path d="M19.1094 19.5488H35.8086L36.2773 19.6074L36.6289 19.7539L36.9219 19.959L37.1562 20.1641L37.4199 20.5742L37.5664 21.0137L37.5957 21.1895V21.4531L37.4785 21.9512L37.2734 22.332L37.0391 22.625L36.7168 22.8594L36.3945 23.0059L35.9844 23.0938H18.9336L18.5527 23.0059L18.2012 22.8301L17.9082 22.5664L17.6738 22.3027L17.4688 21.8926L17.3809 21.5117V21.1602L17.498 20.6914L17.7031 20.3105L18.0254 19.959L18.3477 19.7539L18.6992 19.6074L19.1094 19.5488Z" fill="#5d3e00"/>
</svg><?php echo __('Featured News', 'srft-theme' ); ?>
    </h2>

       <div class="frame"  role="region" aria-label="Feature News" aria-roledescription="carousel" >
       <ul class="slider" >
            <?php
if (pll_current_language() === 'en') {
    $catslug = 'news-en';
} else {
    $catslug = 'news-hi';
}
wp_reset_postdata();
$category_posts = new WP_Query(array(
    'post_type' => 'news',
    'posts_per_page' => 10,
    'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $catslug,
        ),
    ),
));

if ($category_posts->have_posts()) :
    while ($category_posts->have_posts()) : $category_posts->the_post();
?>

<li aria-roledescription="slide">
    <div class="news-item">
            <img class="img-responsive lazyOwl"
                 src="<?php echo esc_url(get_field('News-Image')); ?>"
                 alt="<?php the_title_attribute(); ?>"
                 style="display:block;">

            <div class="news-item-title">

                <p><?php the_title(); ?></p>

            </div>
            <div class="view-more-button"><a href="<?php the_permalink(); ?>" target="_blank" class="d-flex view-more-link align-items-center text-decoration-none fw-semibold" aria-label="View more recent news"><?php _e('Read more', 'srft-theme'); ?> <span class="chevron-right-icon" aria-hidden="true">
    </span></a>
           </div>
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
        <!--<div class="link-div" style="align-items: center; margin-top: 10px;">
            <a class="link-text-big" href="<?php if ($current_language === 'en'){ echo esc_url(site_url('/news-list/')); } else 
{ echo esc_url(site_url('/समाचार-सूची/'));}
?>"  aria-label="Read more featured news">
                <span class="lbl"><?php echo __('Read More Here', 'srft-theme' ); ?></span>
                <span class="primary__header-arrow"> 
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.7 24.69" style="color:#f3f3f3;">
                        <defs><style>.cls-1-arrow{fill:none;stroke:#161a1d;stroke-miterlimit:10;}</style></defs>
                        <g id="Calque_1-3" data-name="Calque 1">
                            <path class="cls-1-arrow" d="M24,12.34H0m12-12,12,12-12,12"></path>
                            <line class="cls-1-arrow" x1="23.99" y1="12.34" y2="12.34"></line>
                            <polyline class="cls-1-arrow" style="stroke: #f5f5f5;" points="11.99 0.35 23.99 12.34 11.99 24.33"></polyline>
                        </g>
                    </svg>
                </span> 
            </a>
        </div>-->
 </div>       
</section>
 
<section class="section-home;" style="padding: 0;">
  <div style="display:flex; flex-wrap: wrap; background-color:var(--sub-intro-background-color);" class="frame1"  >
    <div class="abtimg-box">
    </div>
    <div class="text-box">
      <h2 class="section-intro-header-text" style="display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 12px; flex-direction: row;" ><!--<span aria-hidden="true">--><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48 " viewBox="0 0 64 64" fill="none" aria-hidden="true" style="display: flex; justify-content: center;">
<path d="M9.33398 29.3335V9.3335H29.334V29.3335H9.33398ZM9.33398 54.6668V34.6668H29.334V54.6668H9.33398ZM34.6673 29.3335V9.3335H54.6673V29.3335H34.6673ZM34.6673 54.6668V34.6668H54.6673V54.6668H34.6673ZM13.334 25.3335H25.334V13.3335H13.334V25.3335ZM38.6673 25.3335H50.6673V13.3335H38.6673V25.3335ZM38.6673 50.6668H50.6673V38.6668H38.6673V50.6668ZM13.334 50.6668H25.334V38.6668H13.334V50.6668Z" fill="#5d3e00"/>
</svg><?php echo __('The Institute', 'srft-theme' ); ?>
      </h2>
      <p style="padding-top: 20px; padding-right: 20px; padding-bottom: 20px; line-height: 1.5;" ><?php echo $excerpt ; ?>

      </p>
      <!--<div class="link-div">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
        <div class="link-div" style="align-items: center; margin-top: 0;">
          <a class="link-text-big" href="<?php if ($current_language === 'en') { echo esc_url(site_url('/about-the-institute/')); }
else 
{ echo esc_url(site_url('/संस्थान-के-बारे-में/'));}
?>"  aria-label="Read more about our Institute"><span> <?php echo __('Read More Here', 'srft-theme' ); ?></span><span class="primary__header-arrow"> 
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.7 24.69" style="color:#f3f3f3; translate(0px, 0px); opacity: 1;"><defs><style>.cls-1-arrow{fill:none;stroke:#161a1d;stroke-miterlimit:10;}</style></defs><g id="Calque_1-4" data-name="Calque 1"><path class="cls-1-arrow" d="M24,12.34H0m12-12,12,12-12,12"></path><line class="cls-1-arrow" x1="23.99" y1="12.34" y2="12.34"></line><polyline class="cls-1-arrow"  style="stroke: #f5f5f5;" points="11.99 0.35 23.99 12.34 11.99 24.33"></polyline></g></svg>
          </span>
        </a>
          
        </div>-->
                <div class="view-more-button"><a href="<?php
    if ($current_language === 'en') {
        echo esc_url(site_url('/about-the-institute/'));
    } else {
        echo esc_url(site_url('/संस्थान-के-बारे-में/'));
    }
?>"
class="view-more-link align-items-center text-decoration-none"
aria-label="<?php echo esc_attr__('Read more', 'srft-theme'); ?>">

    <?php echo esc_html__('Read more', 'srft-theme'); ?>
    
    <span class="chevron-right-icon" aria-hidden="true">
    </span>
</a></div>
    </div>
   
  </div>
</section>

<div class="section-home" style="background-color: black; margin:0; padding:0;">
  <div class="section-intro-header">
    <div class="section-into-text" style="padding:25px;">
      <p style="color:beige"><i><?php echo __('SRFTI is an active member of CILECT', 'srft-theme' ); ?>,<br>
      <?php echo __('an association that gathers the best film school in the world.', 'srft-theme' ); ?></i></p>
      <div class="">
          <a href="http://www.cilect.org/" target="_blank" >
            <img src="<?php bloginfo('template_url'); ?>/images/cilect.png"  alt="CILECT" >
          </a>
      </div>
    </div>
  </div>
</div>

<!--<section class="section-home"; style="padding: 0;">
  <div  style="display:flex; flex-wrap: wrap; background-color: #777777">
    <div class="text-box">
      <h2 class="section-intro-header-text" style="padding-left: 0; color:#f3f3f3; ">
      <?php echo __('The Institute', 'srft-theme' ); ?>
      </h2>
      <p style="color:white; font-family: 'Open Sans', 'Helvetica Neue', sans-serif;
    font-size: 1.8rem; line-height: 1.5;"><?php echo $excerpt ; ?>
      </p>
      <div class="link-div">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
        <div class="link-div" style="align-items: center; margin-top: 0;">
          <a class="link-text-big" href="<?php echo esc_url(site_url('/about-the-institute/')); ?>"><span> <?php echo __('Read More Here', 'srft-theme' ); ?></span><span class="primary__header-arrow"> 
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.7 24.69" style="color:#f3f3f3; translate(0px, 0px); opacity: 1;"><defs><style>.cls-1-arrow{fill:none;stroke:#161a1d;stroke-miterlimit:10;}</style></defs><g id="Calque_1-2" data-name="Calque 1"><path class="cls-1-arrow" d="M24,12.34H0m12-12,12,12-12,12"></path><line class="cls-1-arrow" x1="23.99" y1="12.34" y2="12.34"></line><polyline class="cls-1-arrow"  style="stroke: #f5f5f5;" points="11.99 0.35 23.99 12.34 11.99 24.33"></polyline></g></svg>
          </span>
        </a>
          
        </div>
      </div>
    </div>
    <div class="abtimg-box">
    </div>
  </div>
</section>-->
<!--<section class="section-home" style="background-color: #f0e9e9; ">
  <div class="accolades" style="display:flex">
  <div style="display:flex; flex-direction: column;">
    <h2><span class="counter">4 </span></h2>
  <div class="accolades-text">
    <p><?php echo __('Presence in Cannes', 'srft-theme' ); ?></p>
  </div>
  </div>
  <div style="display:flex; flex-direction: column;">
    <h2><span class="counter">36</span></h2>
  <div class="accolades-text">
    <p><?php echo __('National Awards', 'srft-theme' ); ?></p>
  </div>
  </div>
  <div style="display:flex; flex-direction: column;">
    <h2><span class="counter">65</span>+</h2>
  <div class="accolades-text">
    <p><?php echo __('National & Internal Festival Selections', 'srft-theme' ); ?></p>
  </div>
  </div>
  </div>
  <div class="link-div" style="align-items: center; margin-top: 0;">
    <a class="link-text-big" href="#"><span> <?php echo __('Read More Here', 'srft-theme' ); ?></span><span class="primary__header-arrow"> 
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.7 24.69" style="color:#f3f3f3; translate(0px, 0px); opacity: 1;"><defs><style>.cls-1-arrow{fill:none;stroke:#161a1d;stroke-miterlimit:10;}</style></defs><g id="Calque_1-2" data-name="Calque 1"><path class="cls-1-arrow" d="M24,12.34H0m12-12,12,12-12,12"></path><line class="cls-1-arrow" x1="23.99" y1="12.34" y2="12.34"></line><polyline class="cls-1-arrow"  style="stroke: #f5f5f5;" points="11.99 0.35 23.99 12.34 11.99 24.33"></polyline></g></svg>
    </span> </a>
    
  </div>

</section>-->

<section id="courses">
  <div class="container grid grid--2-cols">
    <div class="course-head">
      <h2 class="section-intro-header-text">
        <?php echo __('Study options', 'srft-theme'); ?>
      </h2>
    </div>
    <div class="course-text">
      <div class="course-highlight">
        <a class="button-link-course" href="<?php if ($current_language === 'en') { echo esc_url(site_url('/mfa-in-cinema/')); }
else 
{ echo esc_url(site_url('/सनम-म-सनतकततर-करयकरम/'));}
?>" >
          <div class="primary__header-arrow" style="display: inline-block; margin-right: 20px;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.85 24.85" aria-hidden="true" style="transform: translate(0px, 0px); opacity: 1;">
              <defs>
                <style>.cls-1-arrow-external{fill:none;stroke:#000;stroke-miterlimit:10;}</style>
              </defs>
              <g id="Calque_1-5" data-name="Calque 1">
                <line class="cls-1-arrow-external" x1="0.35" y1="24.5" x2="24.35" y2="0.5"></line>
                <polyline class="cls-1-arrow-external" points="24.35 24.4 24.35 0.5 0.46 0.5"></polyline>
              </g>
            </svg>
          </div>
          <?php echo __('Master of Fine Arts in Cinema', 'srft-theme'); ?> &nbsp;
        </a>
      </div>

      <div class="course-highlight">
        <a class="button-link-course" href="<?php if ($current_language === 'en') { echo esc_url(site_url('/mfa-in-edm/')); }
else 
{ echo esc_url(site_url('/ईडीएम-में-स्नातकोत्तर-का/'));}
?>" >
          <div class="primary__header-arrow" style="display: inline-block; margin-right: 20px;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.85 24.85" aria-hidden="true" style="transform: translate(0px, 0px); opacity: 1;">
              <defs>
                <style>.cls-1-arrow-external{fill:none;stroke:#000;stroke-miterlimit:10;}</style>
              </defs>
              <g id="Calque_1-6" data-name="Calque 1">
                <line class="cls-1-arrow-external" x1="0.35" y1="24.5" x2="24.35" y2="0.5"></line>
                <polyline class="cls-1-arrow-external" points="24.35 24.4 24.35 0.5 0.46 0.5"></polyline>
              </g>
            </svg>
          </div>
          <?php echo __('Master of Fine Arts in EDM', 'srft-theme'); ?> &nbsp;
        </a>
      </div>
    </div>
  </div>
</section>


<section class="section-home notable-alumni-section" style="background-color: #ebeaea;">
    <div style="margin-top: 3.2rem">

        <h2 class="section-intro-header-text" style="display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px; flex-direction: row;">
            
<svg xmlns="http://www.w3.org/2000/svg"
     width="48"
     height="48"
     viewBox="0 0 42 42"
     fill="none"
     aria-hidden="true"
     focusable="false"
     style="display: flex; justify-content: center;">

  <!-- Graduation Cap -->
  <path d="M2.5 12.5L21 4L39.5 12.5L21 21L2.5 12.5Z"
        stroke="#5d3e00"
        stroke-width="2.6"
        stroke-linejoin="round"/>

  <!-- Tassel -->
  <path d="M39.5 12.5V23"
        stroke="#5d3e00"
        stroke-width="2.6"
        stroke-linecap="round"/>

  <circle cx="39.5" cy="25.5" r="2.1"
          fill="#5d3e00"/>

  <!-- Alumni Face -->
  <circle cx="21" cy="26" r="4.5"
          stroke="#5d3e00"
          stroke-width="2.6"/>

  <!-- Alumni Bust -->
  <path d="M11 39C12.9 34.5 16.3 32.5 21 32.5C25.7 32.5 29.1 34.5 31 39"
        stroke="#5d3e00"
        stroke-width="2.6"
        stroke-linecap="round"/>

  <!-- Decorative Star -->
  <path d="M9.5 24L10.8 26.8L13.6 28L10.8 29.2L9.5 32L8.2 29.2L5.4 28L8.2 26.8L9.5 24Z"
        fill="#5d3e00"/>

</svg>
<?php echo esc_html__('Notable Alumni', 'srft-theme'); ?>
        </h2>

        <div
            class="alumni-carousel-wrapper"
            role="region"
            aria-label="<?php echo esc_attr__('Notable Alumni Carousel', 'srft-theme'); ?>"
        >

            <!-- Carousel controls -->
            <div class="alumni-carousel-controls">

                <button
    type="button"
    id="alumniPrev"
    class="alumni-carousel-button"
    aria-label="<?php echo esc_attr__('Previous alumni', 'srft-theme'); ?>"
> 
    <svg
        xmlns="http://www.w3.org/2000/svg"
        width="32"
        height="32"
        viewBox="0 0 64 64"
        fill="none"
        aria-hidden="true"
        focusable="false"
    >
        <path
            d="M28.8001 32L39.2001 42.4C39.689 42.8889 39.9335 43.5111 39.9335 44.2666C39.9335 45.0222 39.689 45.6444 39.2001 46.1333C38.7112 46.6222 38.089 46.8666 37.3335 46.8666C36.5779 46.8666 35.9557 46.6222 35.4668 46.1333L23.2001 33.8666C22.9335 33.6 22.7446 33.3111 22.6335 33C22.5224 32.6889 22.4668 32.3555 22.4668 32C22.4668 31.6444 22.5224 31.3111 22.6335 31C22.7446 30.6889 22.9335 30.4 23.2001 30.1333L35.4668 17.8666C35.9557 17.3777 36.5779 17.1333 37.3335 17.1333C38.089 17.1333 38.7112 17.3777 39.2001 17.8666C39.689 18.3555 39.9335 18.9777 39.9335 19.7333C39.9335 20.4889 39.689 21.1111 39.2001 21.6L28.8001 32Z"
            fill="currentColor"
        />
    </svg>
        <!--<?php esc_html_e('Previous', 'srft-theme'); ?>-->
</button>

                <button
                    type="button"
                    id="alumniToggle"
                    class="alumni-carousel-button alumni-play-button"
                    aria-label="<?php echo esc_attr__('Pause slideshow', 'srft-theme'); ?>"
                    aria-pressed="false"
                >
    <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32" fill="#2b2b2b" aria-hidden="true" style="display: flex; justify-content: center;"><path d="M533.85-220v-520H740v520H533.85ZM220-220v-520h206.54v520H220Zm359.23-45.39h115.38v-429.22H579.23v429.22Zm-313.84 0h115.76v-429.22H265.39v429.22Zm0-429.22v429.22-429.22Zm313.84 0v429.22-429.22Z" fill="currentColor"/></svg>

        <!--<?php esc_html_e('Pause', 'srft-theme'); ?>-->
                </button>

                <button
                    type="button"
                    id="alumniNext"
                    class="alumni-carousel-button"
                    aria-label="<?php echo esc_attr__('Next alumni', 'srft-theme'); ?>"
                >
    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 64 64" fill="none" aria-hidden="true" style="display: flex; justify-content: center;">
<path d="M33.6001 32L23.2001 21.6C22.7112 21.1111 22.4668 20.4889 22.4668 19.7333C22.4668 18.9777 22.7112 18.3555 23.2001 17.8666C23.689 17.3777 24.3112 17.1333 25.0668 17.1333C25.8224 17.1333 26.4446 17.3777 26.9335 17.8666L39.2001 30.1333C39.4668 30.4 39.6557 30.6889 39.7668 31C39.8779 31.3111 39.9335 31.6444 39.9335 32C39.9335 32.3555 39.8779 32.6889 39.7668 33C39.6557 33.3111 39.4668 33.6 39.2001 33.8666L26.9335 46.1333C26.4446 46.6222 25.8224 46.8666 25.0668 46.8666C24.3112 46.8666 23.689 46.6222 23.2001 46.1333C22.7112 45.6444 22.4668 45.0222 22.4668 44.2666C22.4668 43.5111 22.7112 42.8889 23.2001 42.4L33.6001 32Z" fill="currentColor"/>
</svg>

    <!--<span>  <?php esc_html_e('Next', 'srft-theme'); ?>-->   
                </button>

            </div>


            <!-- Carousel viewport -->
            <div class="alumni-carousel-viewport">

                <ul
                    id="alumniCarousel"
                    class="alumni-carousel-list"
                    aria-label="<?php echo esc_attr__('Notable Alumni, 11 items', 'srft-theme'); ?>"
                >

                    <!-- Amal Neerad -->
                    <li class="alumni-carousel-item">
                        <a
                            class="alumni-img"
                            href="#"
                            aria-label="<?php echo esc_attr__('Amal Neerad', 'srft-theme'); ?>"
                        >
                            <img
                                src="<?php echo esc_url(get_template_directory_uri() . '/images/Amal-Neerad.jpg'); ?>"
                                alt="<?php echo esc_attr__('Picture of Amal Neerad', 'srft-theme'); ?>"
                                loading="lazy"
                            >
                        </a>
                        <p><?php echo esc_html__('Amal Neerad', 'srft-theme'); ?></p>
                    </li>


                    <!-- Kanu Behl -->
                    <li class="alumni-carousel-item">
                        <a
                            class="alumni-img"
                            href="#"
                            aria-label="<?php echo esc_attr__('Kanu Behl', 'srft-theme'); ?>"
                        >
                            <img
                                src="<?php echo esc_url(get_template_directory_uri() . '/images/Kanu-Behl.jpg'); ?>"
                                alt="<?php echo esc_attr__('Picture of Kanu Behl', 'srft-theme'); ?>"
                                loading="lazy"
                            >
                        </a>
                        <p><?php echo esc_html__('Kanu Behl', 'srft-theme'); ?></p>
                    </li>


                    <!-- Namrata Rao -->
                    <li class="alumni-carousel-item">
                        <a
                            class="alumni-img"
                            href="#"
                            aria-label="<?php echo esc_attr__('Namrata Rao', 'srft-theme'); ?>"
                        >
                            <img
                                src="<?php echo esc_url(get_template_directory_uri() . '/images/namrata=rao.webp'); ?>"
                                alt="<?php echo esc_attr__('Picture of Namrata Rao', 'srft-theme'); ?>"
                                loading="lazy"
                            >
                        </a>
                        <p><?php echo esc_html__('Namrata Rao', 'srft-theme'); ?></p>
                    </li>


                    <!-- Haobam Paban Kumar -->
                    <li class="alumni-carousel-item">
                        <a
                            class="alumni-img"
                            href="#"
                            aria-label="<?php echo esc_attr__('Haobam Paban Kumar', 'srft-theme'); ?>"
                        >
                            <img
                                src="<?php echo esc_url(get_template_directory_uri() . '/images/paban-kumar.webp'); ?>"
                                alt="<?php echo esc_attr__('Picture of Haobam Paban Kumar', 'srft-theme'); ?>"
                                loading="lazy"
                            >
                        </a>
                        <p><?php echo esc_html__('Haobam Paban Kumar', 'srft-theme'); ?></p>
                    </li>


                    <!-- Pritha Chakraborty -->
                    <li class="alumni-carousel-item">
                        <a
                            class="alumni-img"
                            href="#"
                            aria-label="<?php echo esc_attr__('Pritha Chakraborty', 'srft-theme'); ?>"
                        >
                            <img
                                src="<?php echo esc_url(get_template_directory_uri() . '/images/pritha-chakraborty.png'); ?>"
                                alt="<?php echo esc_attr__('Picture of Pritha Chakraborty', 'srft-theme'); ?>"
                                loading="lazy"
                            >
                        </a>
                        <p><?php echo esc_html__('Pritha Chakraborty', 'srft-theme'); ?></p>
                    </li>


                    <!-- Madhura Palit -->
                    <li class="alumni-carousel-item">
                        <a
                            class="alumni-img"
                            href="#"
                            aria-label="<?php echo esc_attr__('Madhura Palit', 'srft-theme'); ?>"
                        >
                            <img
                                src="<?php echo esc_url(get_template_directory_uri() . '/images/Modhura-Palit.png'); ?>"
                                alt="<?php echo esc_attr__('Picture of Madhura Palit', 'srft-theme'); ?>"
                                loading="lazy"
                            >
                        </a>
                        <p><?php echo esc_html__('Madhura Palit', 'srft-theme'); ?></p>
                    </li>


                    <!-- Abhijit Sen -->
                    <li class="alumni-carousel-item">
                        <a
                            class="alumni-img"
                            href="#"
                            aria-label="<?php echo esc_attr__('Abhijit Sen', 'srft-theme'); ?>"
                        >
                            <img
                                src="<?php echo esc_url(get_template_directory_uri() . '/images/avijit-sen.png'); ?>"
                                alt="<?php echo esc_attr__('Picture of Abhijit Sen', 'srft-theme'); ?>"
                                loading="lazy"
                            >
                        </a>
                        <p><?php echo esc_html__('Abhijit Sen', 'srft-theme'); ?></p>
                    </li>


                    <!-- Sagar Ballary -->
                    <li class="alumni-carousel-item">
                        <a
                            class="alumni-img"
                            href="#"
                            aria-label="<?php echo esc_attr__('Sagar Ballary', 'srft-theme'); ?>"
                        >
                            <img
                                src="<?php echo esc_url(get_template_directory_uri() . '/images/sagar-ballari.png'); ?>"
                                alt="<?php echo esc_attr__('Picture of Sagar Ballary', 'srft-theme'); ?>"
                                loading="lazy"
                            >
                        </a>
                        <p><?php echo esc_html__('Sagar Ballary', 'srft-theme'); ?></p>
                    </li>


                    <!-- Pritam Das -->
                    <li class="alumni-carousel-item">
                        <a
                            class="alumni-img"
                            href="#"
                            aria-label="<?php echo esc_attr__('Pritam Das', 'srft-theme'); ?>"
                        >
                            <img
                                src="<?php echo esc_url(get_template_directory_uri() . '/images/Pritam-Das.png'); ?>"
                                alt="<?php echo esc_attr__('Picture of Pritam Das', 'srft-theme'); ?>"
                                loading="lazy"
                            >
                        </a>
                        <p><?php echo esc_html__('Pritam Das', 'srft-theme'); ?></p>
                    </li>


                    <!-- Sourav Rai -->
                    <li class="alumni-carousel-item">
                        <a
                            class="alumni-img"
                            href="#"
                            aria-label="<?php echo esc_attr__('Sourav Rai', 'srft-theme'); ?>"
                        >
                            <img
                                src="<?php echo esc_url(get_template_directory_uri() . '/images/Saurav-Rai.png'); ?>"
                                alt="<?php echo esc_attr__('Picture of Sourav Rai', 'srft-theme'); ?>"
                                loading="lazy"
                            >
                        </a>
                        <p><?php echo esc_html__('Sourav Rai', 'srft-theme'); ?></p>
                    </li>


                    <!-- Dominic Sangma -->
                    <li class="alumni-carousel-item">
                        <a
                            class="alumni-img"
                            href="#"
                            aria-label="<?php echo esc_attr__('Dominic Sangma', 'srft-theme'); ?>"
                        >
                            <img
                                src="<?php echo esc_url(get_template_directory_uri() . '/images/Dominic-Sangma.png'); ?>"
                                alt="<?php echo esc_attr__('Picture of Dominic Sangma', 'srft-theme'); ?>"
                                loading="lazy"
                            >
                        </a>
                        <p><?php echo esc_html__('Dominic Sangma', 'srft-theme'); ?></p>
                    </li>

                </ul>

            </div>


            <!-- Screen reader announcement -->
            <div
                id="alumniAriaLive"
                class="visually-hidden"
                aria-live="polite"
                aria-atomic="true"
            ></div>

        </div>

    </div>
</section>



  <!--<section class="section-home" style="background-color: rgb(228, 118, 15);
  background-image: url(<?php bloginfo('template_url'); ?>/images/Workshop002.png); background-blend-mode: multiply;">-->
    <!--<div class="section-intro-header-text" style="color: white;">News</div>-->
    <section class="section-home">
    <h2 class="section-intro-header-text" style="display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px; flex-direction: row;"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48 " viewBox="0 0 60 60" fill="none" aria-hidden="true" style="display: flex; justify-content: center;">
<g clip-path="url(#clip0_22_91)">
<path d="M46.6683 33.9406C47.0354 33.8874 47.3529 33.6566 47.517 33.3239L48.3253 31.6863L49.1334 33.3239L49.1335 33.3239C49.2977 33.6566 49.6149 33.8872 49.982 33.9406L49.982 33.9406L51.7893 34.2032L50.4815 35.478C50.2158 35.737 50.0946 36.1101 50.1574 36.4757C50.1574 36.4758 50.1575 36.4758 50.1575 36.4758L50.4661 38.2755L48.8498 37.4258L48.8498 37.4257C48.6856 37.3395 48.5055 37.2964 48.3253 37.2964C48.1453 37.2964 47.9651 37.3395 47.8009 37.4257L47.8008 37.4258L46.1844 38.2755L46.4932 36.4759C46.4932 36.4759 46.4932 36.4759 46.4932 36.4759C46.556 36.11 46.4347 35.737 46.1692 35.478L46.1691 35.4779L44.8614 34.2032L46.6683 33.9406ZM46.6683 33.9406L46.6324 33.6932M46.6683 33.9406L46.6684 33.9406L46.6324 33.6932M46.6324 33.6932C46.918 33.6518 47.1651 33.4722 47.2928 33.2133L46.6324 33.6932ZM45.2117 41.3338L45.2117 41.3338L48.3253 39.697L51.4387 41.3338L51.4387 41.3338C51.6037 41.4206 51.7838 41.4632 51.9631 41.4632C52.1968 41.4632 52.4294 41.3907 52.6258 41.2478C52.9729 40.9956 53.1468 40.5683 53.074 40.1453L52.4795 36.6787L54.9983 34.2233C55.3056 33.9239 55.416 33.4758 55.2835 33.0678C55.1509 32.6598 54.7982 32.3624 54.3736 32.3007C54.3736 32.3007 54.3736 32.3007 54.3735 32.3007L50.8927 31.7948L49.3359 28.6406L49.3359 28.6406C49.146 28.2559 48.7542 28.0123 48.3251 28.0123C47.896 28.0123 47.5042 28.2559 47.3142 28.6406L47.3142 28.6406L45.7573 31.7948L42.2765 32.3007C42.2765 32.3007 42.2765 32.3007 42.2765 32.3007C41.8519 32.3624 41.4991 32.6599 41.3666 33.0678C41.234 33.4758 41.3446 33.9238 41.6516 34.2232L41.6517 34.2233L44.1711 36.6788L43.5763 40.1454C43.5763 40.1454 43.5763 40.1454 43.5763 40.1455C43.5038 40.5684 43.6777 40.9958 44.0247 41.248C44.3717 41.5002 44.8317 41.5335 45.2117 41.3338Z" fill="#5d3e00" stroke="#5d3e00" stroke-width="0.5"/>
<path d="M14.4794 32.5439L14.4794 32.544C14.6444 32.6307 14.8246 32.6734 15.0038 32.6734C15.2375 32.6734 15.4701 32.6008 15.6664 32.458C16.0135 32.2059 16.1875 31.7786 16.1148 31.3556C16.1148 31.3555 16.1148 31.3555 16.1148 31.3555L15.5203 27.8888L18.0391 25.4334C18.3463 25.134 18.4568 24.6859 18.3242 24.278C18.1917 23.8699 17.8389 23.5724 17.4143 23.5108L13.9334 23.005L12.3767 19.8508L12.3767 19.8507C12.1867 19.466 11.7949 19.2224 11.3658 19.2224C10.9367 19.2224 10.5449 19.466 10.355 19.8507L10.355 19.8507L8.798 23.0049L5.31723 23.5108C5.31722 23.5108 5.31721 23.5108 5.31719 23.5108C4.89269 23.5725 4.53986 23.87 4.4073 24.2779C4.27472 24.6859 4.38537 25.1339 4.69237 25.4334L4.69245 25.4334L7.21183 27.8889L6.61708 31.3555C6.61708 31.3555 6.61708 31.3556 6.61708 31.3556C6.54449 31.7785 6.71839 32.2059 7.06541 32.4581C7.41238 32.7103 7.87247 32.7438 8.25247 32.5439C8.2525 32.5439 8.25252 32.5439 8.25255 32.5439L11.366 30.9072L14.4794 32.5439ZM11.366 22.8965L12.1742 24.5341L12.1742 24.5342C12.3384 24.8668 12.6557 25.0974 13.0228 25.1508L13.0228 25.1508L14.83 25.4134L13.5223 26.6883C13.5223 26.6883 13.5223 26.6883 13.5222 26.6883C13.2565 26.9473 13.1354 27.3203 13.1982 27.686C13.1982 27.686 13.1982 27.686 13.1982 27.686L13.5068 29.4857L11.8906 28.636L11.8905 28.636C11.7263 28.5497 11.5462 28.5066 11.3661 28.5066C11.186 28.5066 11.0058 28.5497 10.8416 28.636L10.8415 28.636L9.22518 29.4857L9.53391 27.6861C9.53392 27.6861 9.53392 27.6861 9.53392 27.6861C9.59673 27.3203 9.47542 26.9472 9.20988 26.6883L9.20986 26.6883L7.9021 25.4134L9.70901 25.1508C10.0762 25.0976 10.3936 24.8669 10.5577 24.5342C10.5577 24.5341 10.5577 24.5341 10.5577 24.5341L11.366 22.8965Z" fill="#000" stroke="#5d3e00" stroke-width="0.5"/>
<path d="M37.9587 4.62903L37.9586 4.62905C37.3136 5.37653 36.4388 5.83994 35.3675 6.02466V6.88555C35.3675 9.44031 33.5622 11.5789 31.1611 12.0976V14.1664C33.1993 14.6237 34.8025 16.2401 35.2405 18.2854H36.298C36.6516 18.2854 36.9337 18.4253 37.1239 18.6466C37.3097 18.8626 37.3965 19.1423 37.3965 19.4127C37.3965 19.683 37.3097 19.9627 37.1239 20.1787C36.9337 20.4 36.6516 20.5399 36.298 20.5399H23.704C23.3503 20.5399 23.0683 20.4 22.878 20.1787C22.6923 19.9627 22.6055 19.683 22.6055 19.4127C22.6055 19.1423 22.6923 18.8626 22.878 18.6466C23.0683 18.4253 23.3503 18.2854 23.704 18.2854H24.7255C25.1708 16.2062 26.82 14.5699 28.9065 14.1441V12.0977C26.5054 11.5789 24.7001 9.44044 24.7001 6.88567V6.0364C23.5986 5.85957 22.7015 5.39207 22.0434 4.62903H37.9587ZM37.9587 4.62903C38.6522 3.82516 38.9141 2.86392 39.0039 2.10563C39.0939 1.34607 39.0137 0.76938 39.0052 0.712139L39.0052 0.711955M37.9587 4.62903L39.0052 0.711955M39.0052 0.711955C38.9232 0.159422 38.4489 -0.25 37.8901 -0.25H34.2402H34.198H25.8274C25.823 -0.25 25.8191 -0.249899 25.8157 -0.249768C25.8124 -0.249899 25.8084 -0.25 25.804 -0.25H22.1119C21.5531 -0.25 21.0788 0.15942 20.9969 0.71202L20.9968 0.712189M39.0052 0.711955L20.9968 0.712189M20.9968 0.712189C20.9884 0.769432 20.9082 1.34612 20.9982 2.10567M20.9968 0.712189L20.9982 2.10567M20.9982 2.10567C21.088 2.86394 21.3499 3.82514 22.0434 4.62901L20.9982 2.10567ZM25.8274 -0.249084L25.8269 -0.24911C25.8271 -0.249099 25.8272 -0.249088 25.8274 -0.249077C25.829 -0.248985 25.83 -0.248902 25.8288 -0.248993L25.8274 -0.249084ZM23.7557 3.1626C23.4644 2.82841 23.3219 2.39917 23.2571 2.00443H24.7001V3.72948C24.2913 3.61191 23.9797 3.4197 23.7558 3.16266L23.7557 3.1626ZM29.9831 16.2894C31.3073 16.2894 32.4428 17.1185 32.896 18.2856H27.0699C27.5232 17.1186 28.6587 16.2894 29.9831 16.2894ZM36.2515 3.15643C36.0389 3.4028 35.747 3.59016 35.3674 3.71007V2.00443H36.745C36.6806 2.39647 36.5393 2.82277 36.2515 3.15643ZM26.9545 2.00443H33.1129V4.87484C33.1092 4.91062 33.1065 4.94943 33.1065 4.99054C33.1065 5.03125 33.109 5.06994 33.1129 5.10652V6.88567C33.1129 8.5832 31.7314 9.96476 30.0337 9.96476C28.3361 9.96476 26.9545 8.5832 26.9545 6.88567V2.00443Z" fill="#5d3e00" stroke="#5d3e00" stroke-width="0.5"/>
<path d="M19.889 37.5859V57.9952H4.29498V44.4436V37.5859C4.29498 37.448 4.40758 37.3354 4.54534 37.3354H19.6388C19.7764 37.3354 19.889 37.4479 19.889 37.5859ZM2.04055 57.9952H0.935778C0.313133 57.9952 -0.191437 58.4997 -0.191437 59.1224C-0.191437 59.745 0.313133 60.2496 0.935778 60.2496H59.0659C59.6886 60.2496 60.1931 59.745 60.1931 59.1224C60.1931 58.4997 59.6884 57.9952 59.0659 57.9952H57.9611V46.7511C57.9611 45.3694 56.8378 44.2457 55.4563 44.2457H40.3626C40.236 44.2457 40.1121 44.2557 39.9912 44.2742V26.0646C39.9912 24.683 38.8681 23.5592 37.4869 23.5592H22.3933C21.0121 23.5592 19.8891 24.683 19.8891 26.0646V35.0942C19.8071 35.0856 19.7237 35.081 19.6389 35.081H4.54534C3.16396 35.081 2.04055 36.2044 2.04055 37.5859V44.4436V57.9952ZM22.1434 57.9952V37.5859V26.0646C22.1434 25.9259 22.2562 25.8136 22.3932 25.8136H37.4869C37.6239 25.8136 37.7368 25.926 37.7368 26.0646V57.9953L22.1434 57.9952ZM40.1126 57.9952V46.7511C40.1126 46.6125 40.2255 46.5001 40.3626 46.5001H55.4562C55.5938 46.5001 55.7066 46.6127 55.7066 46.7511V57.9952H40.1126Z" fill="#5D3E00" stroke="#2D2D2D" stroke-width="0.5"/>
</g>
<defs>
<clipPath id="clip0_22_91">
<rect width="60" height="60" fill="white"/>
</clipPath>
</defs>
</svg><?php echo __('Award Winning Student Films', 'srft-theme' ); ?></h2>
    <!--<p id="carousel-instructions" class="sr-only">
    This is a carousel. Use the next and previous controls to navigate between award items.
  </p>-->
    <div class="frame" role="region" aria-label="Award Winnng Student Films" aria-roledescription="carousel">
      <ul class="slider" >
        <?php
        $post_id = get_the_ID();
        $post_content = apply_filters('the_content', $post->post_content);
    
        if ($current_language === 'en_US') {
        $catslug='award-en'; 
        }
        else
        {
        $catslug='award-hi';
        }
        $category_posts = new WP_Query(array(
        'post_type' => 'award',
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
        <li aria-roledescription="slide">
          
        <div class="news-item">
          <img typeof="foaf:Image" class="img-responsive lazyOwl" src="<?php echo get_field('film_still');?>" alt=""  style="display: block;">
          <div class="news-item-title">
          <h3><?php echo get_field('Film-Name');?></h3>
          <p><?php echo get_field('award_received');?></p>  
        </div>
        <div class="view-more-button"><a href="<?php the_permalink(); ?>" target="_blank" class="d-flex view-more-link align-items-center text-decoration-none fw-semibold" aria-label="View more recent news" ><?php _e('Read more', 'srft-theme'); ?> <span class="chevron-right-icon" aria-hidden="true">
    </span></a></div>

    </div>
        </li>  
      <?php
        endwhile;
        wp_reset_postdata(); // Reset the post data
    else :
        echo '<p>No posts found in this category.</p>';
    endif;
    ?>    
  </ul>
  <!--<div class="link-div" style="align-items: center; margin-top:0;">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
    <a class="link-text-big" href="#" >Read More Here</a>
    </div>-->
  </div>
  </section>

  <section class="section-home" style="background-color: #ebeaea;">
    <?php
echo '<!-- Current Language: ' . $current_language . ' -->';
?>
    <div class="section-intro-header">
        <h2 class="section-intro-header-text" style="display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 12px; flex-direction: row;"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 60 60" fill="none" aria-hidden="true" style="display: flex; justify-content: center;">
<g clip-path="url(#clip0_22_86)">
<path d="M54.6429 0H14.1216C12.7013 0.00166732 11.3397 0.566615 10.3354 1.57091C9.33109 2.57521 8.76614 3.93685 8.76448 5.35714V8.76604H5.35714C3.93685 8.76771 2.57521 9.33266 1.57091 10.337C0.566615 11.3413 0.00166732 12.7029 0 14.1232V54.6429C0.00166732 56.0631 0.566615 57.4248 1.57091 58.4291C2.57521 59.4334 3.93685 59.9983 5.35714 60H45.8768C47.2971 59.9983 48.6587 59.4334 49.663 58.4291C50.6673 57.4248 51.2323 56.0631 51.234 54.6429V51.2355H54.6429C56.0631 51.2339 57.4248 50.6689 58.4291 49.6646C59.4334 48.6603 59.9983 47.2987 60 45.8784V37.5C59.995 37.2192 59.8799 42.3087 59.6795 42.1118C59.4791 41.915 59.2809 37 59 37C58.7191 37 58.378 41.915 58.1776 42.1119C57.9772 42.3087 57.8622 37.2192 57.8571 37.5V45.8784C57.8562 46.7306 57.5173 47.5476 56.9147 48.1502C56.3121 48.7528 55.4951 49.0917 54.6429 49.0927H51.234V14.1232C51.2323 12.7029 50.6673 11.3413 49.663 10.337C48.6587 9.33266 47.2971 8.76771 45.8768 8.76604H20.3571C20.0766 8.77152 19.8094 8.88682 19.6129 9.08716C19.4165 9.2875 19.3064 9.55691 19.3064 9.83751C19.3064 10.1181 19.4165 10.3875 19.613 10.5878C19.8095 10.7882 20.0767 10.9034 20.3572 10.9089H45.8768C46.729 10.9098 47.546 11.2488 48.1486 11.8514C48.7512 12.454 49.0902 13.271 49.0911 14.1232V37.4656L43.2145 30.1198C42.7832 29.5884 42.2388 29.1599 41.6209 28.8656C41.003 28.5713 40.3272 28.4186 39.6428 28.4186C38.9584 28.4186 38.2827 28.5713 37.6648 28.8656C37.0469 29.16 36.5025 29.5884 36.0712 30.1199L25.2663 43.6264L18.6721 35.3833C18.2432 34.8472 17.6992 34.4144 17.0804 34.117C16.4616 33.8196 15.7839 33.6652 15.0973 33.6652C14.4108 33.6652 13.733 33.8196 13.1142 34.117C12.4954 34.4144 11.9515 34.8472 11.5226 35.3833L2.14286 47.1084V14.1232C2.14379 13.271 2.48273 12.454 3.08533 11.8514C3.68792 11.2488 4.50495 10.9098 5.35714 10.9089L20.302 10.9064C20.5825 10.9009 15.5477 10.7881 15.7442 10.5878C15.9407 10.3874 21.5 9.7806 21.5 9.5C21.5 9.2194 15.9406 9.28744 15.7442 9.08711C15.5477 8.88678 20.6377 8.7715 20.3571 8.76604H10.9073V5.35714C10.9083 4.50495 11.2472 3.68792 11.8498 3.08533C12.4524 2.48273 13.2694 2.14379 14.1216 2.14286H54.6429C55.4951 2.14379 56.3121 2.48273 56.9147 3.08533C57.5173 3.68792 57.8562 4.50495 57.8571 5.35714V37.5C57.8619 37.7811 57.9768 38.049 58.1772 38.2461C58.3777 38.4432 58.6475 38.5536 58.9286 38.5536C59.2097 38.5536 59.4795 38.4431 59.6799 38.246C59.8804 38.0489 59.9953 37.7811 60 37.5V5.35714C59.9983 3.93685 59.4334 2.57521 58.4291 1.57091C57.4248 0.566615 56.0631 0.00166732 54.6429 0ZM13.1956 36.7221C13.4253 36.4392 13.7152 36.2111 14.0441 36.0545C14.3731 35.8978 14.7328 35.8165 15.0972 35.8165C15.4615 35.8164 15.8213 35.8976 16.1503 36.0542C16.4793 36.2108 16.7692 36.4388 16.999 36.7216L28.2867 50.8316C28.4662 51.0471 28.723 51.1836 29.0021 51.2117C29.2811 51.2399 29.56 51.1576 29.779 50.9824C29.998 50.8072 30.1396 50.5532 30.1734 50.2748C30.2072 49.9964 30.1304 49.7158 29.9597 49.4934L26.6381 45.3413L37.7443 31.458C37.9797 31.1852 38.2711 30.9663 38.5987 30.8163C38.9264 30.6662 39.2825 30.5886 39.6428 30.5886C40.0032 30.5886 40.3593 30.6662 40.6869 30.8163C41.0145 30.9663 41.306 31.1852 41.5414 31.458L49.0911 40.8952V54.6429C49.0901 55.4951 48.7512 56.3121 48.1486 56.9147C47.546 57.5173 46.729 57.8562 45.8768 57.8571H5.35714C4.50495 57.8562 3.68792 57.5173 3.08533 56.9147C2.48273 56.3121 2.14379 55.4951 2.14286 54.6429V50.538L13.1956 36.7221Z" fill="#5d3e00"/>
<path d="M60 37.5V45.8784C59.9983 47.2987 59.4334 48.6603 58.4291 49.6646C57.4248 50.6689 56.0631 51.2339 54.6429 51.2355H51.234V54.6429C51.2323 56.0631 50.6673 57.4248 49.663 58.4291C48.6587 59.4334 47.2971 59.9983 45.8768 60H5.35714C3.93685 59.9983 2.57521 59.4334 1.57091 58.4291C0.566615 57.4248 0.00166732 56.0631 0 54.6429V14.1232C0.00166732 12.7029 0.566615 11.3413 1.57091 10.337C2.57521 9.33266 3.93685 8.76771 5.35714 8.76604H8.76448V5.35714C8.76615 3.93685 9.33109 2.57521 10.3354 1.57091C11.3397 0.566615 12.7013 0.00166732 14.1216 0H54.6429C56.0631 0.00166732 57.4248 0.566615 58.4291 1.57091C59.4334 2.57521 59.9983 3.93685 60 5.35714V37.5ZM60 37.5C59.995 37.2192 59.8799 42.3087 59.6795 42.1118C59.4791 41.915 59.2809 37 59 37C58.7191 37 58.378 41.915 58.1776 42.1119C57.9772 42.3087 57.8622 37.2192 57.8571 37.5M60 37.5C59.9953 37.7811 59.8804 38.0489 59.6799 38.246C59.4795 38.4431 59.2097 38.5536 58.9286 38.5536C58.6475 38.5536 58.3777 38.4432 58.1772 38.2461C57.9768 38.049 57.8619 37.7811 57.8571 37.5M57.8571 37.5V45.8784C57.8562 46.7306 57.5173 47.5476 56.9147 48.1502C56.3121 48.7528 55.4951 49.0917 54.6429 49.0927H51.234V14.1232C51.2323 12.7029 50.6673 11.3413 49.663 10.337C48.6587 9.33266 47.2971 8.76771 45.8768 8.76604H20.3571M57.8571 37.5V5.35714C57.8562 4.50495 57.5173 3.68792 56.9147 3.08533C56.3121 2.48273 55.4951 2.14379 54.6429 2.14286H14.1216C13.2694 2.14379 12.4524 2.48273 11.8498 3.08533C11.2472 3.68792 10.9083 4.50495 10.9073 5.35714V8.76604H20.3571M20.3571 8.76604C20.0766 8.77152 19.8094 8.88682 19.6129 9.08716C19.4165 9.2875 19.3064 9.55691 19.3064 9.83751C19.3064 10.1181 19.4165 10.3875 19.613 10.5878C19.8095 10.7882 20.0767 10.9034 20.3572 10.9089H45.8768C46.729 10.9098 47.546 11.2488 48.1486 11.8514C48.7512 12.454 49.0902 13.271 49.0911 14.1232V37.4656L43.2145 30.1198C42.7832 29.5884 42.2388 29.1599 41.6209 28.8656C41.003 28.5713 40.3272 28.4186 39.6428 28.4186C38.9584 28.4186 38.2827 28.5713 37.6648 28.8656C37.0469 29.16 36.5025 29.5885 36.0712 30.1199L25.2663 43.6264L18.6721 35.3833C18.2432 34.8472 17.6992 34.4144 17.0804 34.117C16.4616 33.8196 15.7839 33.6652 15.0973 33.6652C14.4108 33.6652 13.733 33.8196 13.1142 34.117C12.4954 34.4144 11.9515 34.8472 11.5226 35.3833L2.14286 47.1084V14.1232C2.14379 13.271 2.48273 12.454 3.08533 11.8514C3.68792 11.2488 4.50495 10.9098 5.35714 10.9089L20.302 10.9064C20.5825 10.9009 15.5477 10.7881 15.7442 10.5878C15.9407 10.3874 21.5 9.7806 21.5 9.5C21.5 9.2194 15.9406 9.28744 15.7442 9.08711C15.5477 8.88678 20.6377 8.7715 20.3571 8.76604ZM13.1956 36.7221C13.4253 36.4392 13.7152 36.2111 14.0441 36.0545C14.3731 35.8978 14.7328 35.8165 15.0972 35.8165C15.4615 35.8164 15.8213 35.8976 16.1503 36.0542C16.4793 36.2108 16.7692 36.4388 16.999 36.7216L28.2867 50.8316C28.4662 51.0471 28.723 51.1836 29.0021 51.2117C29.2811 51.2399 29.56 51.1576 29.779 50.9824C29.998 50.8072 30.1396 50.5532 30.1734 50.2748C30.2072 49.9964 30.1304 49.7158 29.9597 49.4934L26.6381 45.3413L37.7443 31.458C37.9797 31.1852 38.2711 30.9663 38.5987 30.8163C38.9264 30.6662 39.2825 30.5886 39.6428 30.5886C40.0032 30.5886 40.3593 30.6662 40.6869 30.8163C41.0145 30.9663 41.306 31.1852 41.5414 31.458L49.0911 40.8952V54.6429C49.0901 55.4951 48.7512 56.3121 48.1486 56.9147C47.546 57.5173 46.729 57.8562 45.8768 57.8571H5.35714C4.50495 57.8562 3.68792 57.5173 3.08533 56.9147C2.48273 56.3121 2.14379 55.4951 2.14286 54.6429V50.538L13.1956 36.7221Z" stroke="#5d3e00" fill=""/>
<path d="M7.89001 22.1104C8.1191 29.3189 18.5712 29.3168 18.7994 22.1102C18.5701 14.9022 8.11803 14.9035 7.89001 22.1104ZM16.6566 22.1104C16.6468 22.9823 16.2935 23.8151 15.6735 24.4282C15.0534 25.0413 14.2166 25.3852 13.3447 25.3852C12.4727 25.3852 11.6359 25.0413 11.0159 24.4282C10.3959 23.8151 10.0427 22.9822 10.0329 22.1103C10.0427 21.2383 10.3959 20.4055 11.016 19.7924C11.636 19.1793 12.4728 18.8354 13.3448 18.8354C14.2167 18.8355 15.0535 19.1793 15.6736 19.7924C16.2936 20.4056 16.6468 21.2384 16.6566 22.1104Z" fill="" stroke="#5d3e00"/>
</g>
<defs>
<clipPath id="clip0_22_86">
<rect width="60" height="60" fill="white"/>
</clipPath>
</defs>
</svg>
            <?php echo __('Media Gallery', 'srft-theme'); ?>
        </h2>
    </div>
    
    <div class="container" style="display: flex; padding: 24px; max-width: 1450px;">
        
        <div class="img_card">
        <a href="<?php if ($current_language === 'en') { echo esc_url(site_url('/photo-gallery/?tab=1')); }
else 
{ echo esc_url(site_url('/फोटो-गैलरी/?tab=1'));}
?>">
                <img alt="" width="302" height="416" class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/convocation.jpg">
                <div class="img_caption">
                    <p class="img-caption-text"><?php echo __('Events & Festivals', 'srft-theme'); ?></p>
                </div>
            </a>
        </div>

        <div class="img_card">
        <a href="<?php if ($current_language === 'en') { echo esc_url(site_url('/photo-gallery/?tab=2')); }
else 
{ echo esc_url(site_url('/फोटो-गैलरी/?tab=2'));}
?>">
                <img alt="" width="302" height="416" class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/workshop001.png">
                <div class="img_caption">
                    <p class="img-caption-text"><?php echo __('Master Classes & Workshops', 'srft-theme'); ?></p>
                </div>
            </a>
        </div>

        <div class="img_card">
        <a href="<?php if ($current_language === 'en') { echo esc_url(site_url('/photo-gallery/?tab=3')); }
else 
{ echo esc_url(site_url('/फोटो-गैलरी/?tab=3'));}
?>">
                <img alt="" width="302" height="416" class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/studentsfilmstill.jpg">
                <div class="img_caption">
                    <p class="img-caption-text"><?php echo __('Beyond the Frame', 'srft-theme'); ?></p>
                </div>
            </a>
        </div>

        <div class="img_card">
        <a href="<?php if ($current_language === 'en') { echo esc_url(site_url('/photo-gallery/?tab=4')); }
else 
{ echo esc_url(site_url('/फोटो-गैलरी/?tab=4'));}
?>">
                <img alt="" width="302" height="416" class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/Gothar-Retro.JPG">
                <div class="img_caption">
                    <p class="img-caption-text"><?php echo __('Campus Moments', 'srft-theme'); ?></p>
                </div>
            </a>
        </div>

        <div class="img_card">
        <a href="<?php if ($current_language === 'en') { echo esc_url(site_url('/photo-gallery/?tab=5')); }
else 
{ echo esc_url(site_url('/फोटो-गैलरी/?tab=5'));}
?>">
                <img alt="" width="302" height="416" class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/Alumni_News_KanuBehl.jpg">
                <div class="img_caption">
                    <p class="img-caption-text"><?php echo __('SRFTI in News', 'srft-theme'); ?></p>
                </div>
            </a>
        </div>

    </div>
</section>



<section class="section-home" style="background-color: #fff;">
<div class="section-intro-header">
    <h2 class="section-intro-header-text" style="display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 12px; flex-direction: row;">
    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48 " viewBox="0 0 64 64" fill="none" aria-hidden="true">
<path d="M28.2054 58.6087C29.233 55.9827 37.1617 37.0426 53.2729 33.4144C53.3032 33.4144 53.3322 33.4024 53.3536 33.3809C53.375 33.3595 53.3871 33.3305 53.3871 33.3002C53.3871 33.2699 53.375 33.2409 53.3536 33.2195C53.3322 33.1981 53.3032 33.186 53.2729 33.186C50.5581 32.095 33.9649 24.8514 28.6875 7.48432C28.6875 7.45404 28.6755 7.425 28.6541 7.40359C28.6327 7.38218 28.6036 7.37015 28.5733 7.37015C28.5431 7.37015 28.514 7.38218 28.4926 7.40359C28.4712 7.425 28.4592 7.45404 28.4592 7.48432C27.8122 10.364 23.4609 25.7901 3.08725 32.8562C3.06187 32.8645 3.03977 32.8807 3.0241 32.9023C3.00844 32.924 3 32.95 3 32.9767C3 33.0034 3.00844 33.0295 3.0241 33.0511C3.03977 33.0728 3.06187 33.0889 3.08725 33.0972C5.9289 33.5793 20.1879 37.0806 27.9771 58.6594C27.9915 58.6798 28.0117 58.6955 28.035 58.7044C28.0583 58.7134 28.0837 58.7153 28.1081 58.7099C28.1325 58.7045 28.1548 58.692 28.1721 58.674C28.1894 58.656 28.201 58.6332 28.2054 58.6087Z" stroke="#5d3e00" stroke-width="2.73204" fill=""/>
<path d="M52.0432 24.2551C52.4111 23.3163 55.24 16.5547 60.9995 15.2607V15.1719C60.0353 14.7914 54.111 12.2034 52.2208 6H52.132C51.9036 7.04025 50.356 12.5459 43.0742 15.0451V15.1339C44.0891 15.3115 49.1762 16.5547 51.9544 24.2678L52.0432 24.2551Z" stroke="#5d3e00" stroke-width="2.73204" fill=""/>
</svg>
    <?php echo esc_html__("What's New", "srft-theme"); ?></h2>
  </div>  
<div class="updates-container" style="max-width: 1450px; margin: 40px auto; padding: 0 20px;">
  
<div class="box-container social-feeds" style="display:flex;">
    <?php 
    $sections = [
        'event' => __('Event', 'srft-theme'),
        'announcement' => __('Circular & Notices', 'srft-theme'),
        'tender' => __('Tender', 'srft-theme'),
        'vacancy' => __('Vacancy', 'srft-theme')
    ];

    foreach ($sections as $post_type => $title) :
        $catslug = ($current_language === 'en_US') ? $post_type : $post_type . '-hi';
        $category_posts = new WP_Query([
          'post_type'      => $post_type,
          'posts_per_page' => 5,
      ]);
    ?>
    <div class="cell social-card">
        <h3 class="update-title"><?php echo $title; ?></h3>
         <div class="social-embed">
        <?php if ($category_posts->have_posts()) :
    while ($category_posts->have_posts()) : $category_posts->the_post();

        // ----- DOC FIELD (old + new support) -----
        $doc_field_old = ucfirst($post_type) . '-Doc';
        $doc_field_new = strtolower($post_type) . '-doc';
        $doc = get_field($doc_field_old) ?: get_field($doc_field_new);

        $link = $doc && isset($doc['url']) ? esc_url($doc['url']) : get_permalink();
        $file_size_mb = 'N/A';

        if ($doc && isset($doc['url'])) {
            $file_path = urldecode(str_replace(site_url('/'), ABSPATH, $doc['url']));
            if (file_exists($file_path)) {
                $file_size = filesize($file_path);
                $file_size_mb = round($file_size / (1024 * 1024), 2);
            }
        }

        // ----- DATE FIELD (old + new support) -----
        $date_field_old = ucfirst($post_type) . '-Publish-Date';
        $date_field_new = strtolower($post_type) . '-publish-date';
        $post_date = get_field($date_field_old) ?: get_field($date_field_new);

        $formatted_date = !empty($post_date) ? DateTime::createFromFormat('d/m/Y', $post_date) : null;
?>
    <h4 style="margin-bottom: 6px; display: flex; align-items: center; gap: 8px;">
    <!-- Removed flex styles from the SVG, they belong on the parent h4 -->
    <span style="display: flex;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 61 68" fill="none" aria-hidden="true">
            <path d="M8.05255 66C6.36119 66 4.9296 65.4141 3.75776 64.2422C2.58592 63.0704 2 61.6388 2 59.9474V15.1346C2 13.4433 2.58592 12.0117 3.75776 10.8399C4.9296 9.66801 6.36119 9.08209 8.05255 9.08209H12.688V2H17.8391V9.08209H43.2077V2H48.2299V9.08209H52.8654C54.5567 9.08209 55.9883 9.66801 57.1601 10.8399C58.332 12.0117 58.9179 13.4433 58.9179 15.1346V59.9474C58.9179 61.6388 58.332 63.0704 57.1601 64.2422C55.9883 65.4141 54.5567 66 52.8654 66H8.05255ZM8.05255 60.9778H52.8654C53.1232 60.9778 53.3592 60.8704 53.5735 60.6556C53.7883 60.4413 53.8957 60.2053 53.8957 59.9474V28.5271H7.02217V59.9474C7.02217 60.2053 7.12959 60.4413 7.34442 60.6556C7.5587 60.8704 7.79474 60.9778 8.05255 60.9778ZM7.02217 23.5049H53.8957V15.1346C53.8957 14.8768 53.7883 14.6408 53.5735 14.4265C53.3592 14.2117 53.1232 14.1043 52.8654 14.1043H8.05255C7.79474 14.1043 7.5587 14.2117 7.34442 14.4265C7.12959 14.6408 7.02217 14.8768 7.02217 15.1346V23.5049Z" fill="#5D3E00"/>
        </svg>
    </span>
    <?php echo $formatted_date ? esc_html($formatted_date->format('d M, Y')) : __('No date available', 'srft-theme'); ?>
</h4>

    <p><a href="<?php echo $link; ?>">
        <?php the_title(); ?> </a> &nbsp;
        <?php if ($doc): ?>
         <a
    href="<?php echo esc_url($file_url); ?>"
    target="_blank"
    rel="noopener"
    aria-label="<?php echo esc_attr( 'Download PDF, ' . $file_size_mb . ' MB' ); ?>"
>
    <!-- PDF Icon -->
    <span class="tooltip-box">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 68 68"
            fill="none"
            aria-hidden="true"
            focusable="false"
        >
            <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M15.13 47.8714C12.7254 46.6379 9.88617 46.145 7.0975 46.4771H0V67.9281H5.6525V59.741H8.075C10.5846 59.9579 13.1063 59.4402 15.215 58.2752C17.0049 56.9837 17.9917 55.0731 17.8925 53.0912C18.025 51.0785 16.9966 49.1354 15.13 47.8714ZM10.5825 55.701C9.51486 56.0964 8.34103 56.2445 7.1825 56.1301H5.525V50.0523H7.1825C8.38607 49.9447 9.6003 50.144 10.6675 50.6243C11.6614 51.2066 12.2246 52.1813 12.155 53.1984C12.2838 54.2239 11.6623 55.213 10.5825 55.701ZM30.0475 46.4771H22.9925V67.9281H29.75C33.1938 68.2116 36.6618 67.653 39.7375 66.3193C43.1218 64.1975 44.9299 60.7346 44.4975 57.2026C44.7508 54.1767 43.4692 51.2021 40.97 49.0155C37.8829 46.9686 33.9459 46.0537 30.0475 46.4771ZM35.6575 63.0659C33.8869 63.9031 31.8595 64.2766 29.835 64.1384H28.73V50.2668H29.75C33.32 50.2668 34.7225 50.5528 36.125 51.6254C37.8271 53.1161 38.7062 55.1399 38.5475 57.2026C38.7661 59.4349 37.6898 61.6187 35.6575 63.0659ZM50.7025 67.9281H56.44V58.9544H68V55.1648H56.44V50.2668H68V46.4771H50.7025V67.9281ZM46.75 0H0V39.3268H8.5V32.1765V28.4226V7.15033H43.2225L59.5 20.8432V28.4226V32.1765V39.3268H68V17.8758L46.75 0Z"
                fill="#5d3e00"
            />
        </svg>

        <span class="tooltip-text">
            <?php echo esc_html__( 'PDF', 'srft-theme' ); ?>
        </span>
    </span>


    <!-- File Size -->
    <span aria-hidden="true">
        <?php echo esc_html($file_size_mb); ?> MB
    </span>


    <!-- Download Icon -->
    <span class="tooltip-box">
        <svg
            width="24"
            height="24"
            viewBox="0 0 64 64"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            aria-hidden="true"
            focusable="false"
        >
            <path
                d="M32.0003 41.5333C31.6448 41.5333 31.3114 41.4777 31.0003 41.3666C30.6892 41.2555 30.4003 41.0666 30.1337 40.8L20.5337 31.2C20.0003 30.6666 19.7448 30.0444 19.767 29.3333C19.7892 28.6222 20.0448 28 20.5337 27.4666C21.067 26.9333 21.7003 26.6555 22.4337 26.6333C23.167 26.6111 23.8003 26.8666 24.3337 27.4L29.3337 32.4V13.3333C29.3337 12.5777 29.5892 11.9444 30.1003 11.4333C30.6114 10.9222 31.2448 10.6666 32.0003 10.6666C32.7559 10.6666 33.3892 10.9222 33.9003 11.4333C34.4114 11.9444 34.667 12.5777 34.667 13.3333V32.4L39.667 27.4C40.2003 26.8666 40.8337 26.6111 41.567 26.6333C42.3003 26.6555 42.9337 26.9333 43.467 27.4666C43.9559 28 44.2114 28.6222 44.2337 29.3333C44.2559 30.0444 44.0003 30.6666 43.467 31.2L33.867 40.8C33.6003 41.0666 33.3114 41.2555 33.0003 41.3666C32.6892 41.4777 32.3559 41.5333 32.0003 41.5333ZM16.0003 53.3333C14.5337 53.3333 13.2781 52.8111 12.2337 51.7666C11.1892 50.7222 10.667 49.4666 10.667 48V42.6666C10.667 41.9111 10.9225 41.2777 11.4337 40.7666C11.9448 40.2555 12.5781 40 13.3337 40C14.0892 40 14.7225 40.2555 15.2337 40.7666C15.7448 41.2777 16.0003 41.9111 16.0003 42.6666V48H48.0003V42.6666C48.0003 41.9111 48.2559 41.2777 48.767 40.7666C49.2781 40.2555 49.9114 40 50.667 40C51.4226 40 52.0559 40.2555 52.567 40.7666C53.0781 41.2777 53.3337 41.9111 53.3337 42.6666V48C53.3337 49.4666 52.8114 50.7222 51.767 51.7666C50.7225 52.8111 49.467 53.3333 48.0003 53.3333H16.0003Z"
                fill="#5d3e00"
            />
        </svg>

        <span class="tooltip-text">
            <?php echo esc_html__( 'Download', 'srft-theme' ); ?>
        </span>
    </span>

</a>  
        <?php endif; ?>
    <?php if ($post_type === 'announcement') : ?>
    <?php
    $announcement_cat = get_field('announcement_category');
    if ($announcement_cat) : ?>
        <span class="announcement-category">
            <!--<?php echo esc_html($announcement_cat); ?>-->
        </span>
    <?php endif; ?>
<?php endif; ?>
  <?php if ($post_type === 'tender') : 
      $all_fields = get_fields();
    echo '<!-- All ACF fields: ';
    print_r(array_keys($all_fields));
    echo ' -->';?>
   <?php $is_tender = ($post_type === 'tender');
$tender_language = get_field('language'); // ACF field value: Hindi / Both / English
$tender_id = get_field('Tender-ID');
$is_gem = (stripos($tender_id, 'GEM') === 0);
?>
<?php if ($is_gem): ?>
      <span class="doc-lang">
        &nbsp; | &nbsp; (
        <abbr lang="en" title="English">EN</abbr>,
        <abbr lang="hi" title="Hindi">HI</abbr>)
        <span class="sr-only">
        <?php echo esc_attr__('Document available in English and Hindi', 'srft-theme'); ?>
       </span>
      </span>
    <?php elseif ($tender_language === 'Hindi'): ?>
      <span class="doc-lang">
        &nbsp;(
        <abbr lang="hi" title="Hindi">HI</abbr>
        )
        <span class="sr-only">
        <?php echo esc_attr__('Document available in Hindi', 'srft-theme'); ?>
       </span>
      </span>
    <?php endif; ?>
  <?php endif; ?>
     
  </p>

     <?php if ($post_type === 'event') : 
     $event_date = get_field('event_date');
     $event_time = get_field('event_time');
     $event_venue = get_field('event_venue');
       if (!empty($event_date)){
         $event_date = DateTime::createFromFormat('d/m/Y', $event_date);
       }
      ?>
        <p class="event-meta" style="margin: 4px 0; display: flex; align-items: center; flex-wrap: wrap; gap: 8px;">
    
    <!-- Venue Group -->
    <span style="display: flex; align-items: center; gap: 4px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 55 68" fill="none" aria-hidden="true">
            <path d="M27.418 33.5303C29.093 33.5303 30.525 32.9339 31.714 31.7409C32.9036 30.548 33.4984 29.114 33.4984 27.4391C33.4984 25.7641 32.9019 24.3319 31.7089 23.1423C30.516 21.9533 29.0818 21.3587 27.4062 21.3587C25.7313 21.3587 24.2993 21.9552 23.1103 23.1482C21.9207 24.3411 21.3259 25.7753 21.3259 27.4509C21.3259 29.1258 21.9224 30.5578 23.1153 31.7468C24.3083 32.9358 25.7425 33.5303 27.418 33.5303ZM27.4121 59.28C33.9986 53.3837 39.0389 47.7282 42.533 42.3133C46.0271 36.8985 47.7742 32.1559 47.7742 28.0855C47.7742 21.9479 45.8243 16.9023 41.9245 12.9486C38.0247 8.99496 33.1872 7.01812 27.4121 7.01812C21.6371 7.01812 16.7996 8.99496 12.8998 12.9486C9.00001 16.9023 7.05011 21.9479 7.05011 28.0855C7.05011 32.1559 8.79716 36.8985 12.2913 42.3133C15.7854 47.7282 20.8257 53.3837 27.4121 59.28ZM27.4121 66C18.9392 58.6583 12.5856 51.8258 8.35135 45.5025C4.11712 39.1786 2 33.3729 2 28.0855C2 20.3162 4.51299 14.0263 9.53897 9.21576C14.5655 4.40525 20.5232 2 27.4121 2C34.301 2 40.2588 4.40525 45.2853 9.21576C50.3113 14.0263 52.8243 20.3162 52.8243 28.0855C52.8243 33.3729 50.7072 39.1786 46.4729 45.5025C42.2387 51.8258 35.8851 58.6583 27.4121 66Z" fill="#5D3E00"/>
        </svg>
        <?php echo esc_html($event_venue); ?>
    </span>

    <?php if (!empty($event_time)): ?>
        
        <!-- Divider -->
        <span>|</span>
        
        <!-- Time Group -->
        <span style="display: flex; align-items: center; gap: 4px;">
            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" fill="#2d2d2d" aria-hidden="true">
                <path d="M513-492v-171q0-13-8.5-21.5T483-693q-13 0-21.5 8.5T453-663v183q0 6 2 11t6 10l144 149q9 10 22.5 9.5T650-310q9-9 9-22t-9-22L513-492ZM480-80q-82 0-155-31.5t-127.5-86Q143-252 111.5-325T80-480q0-82 31.5-155t86-127.5Q252-817 325-848.5T480-880q82 0 155 31.5t127.5 86Q817-708 848.5-635T880-480q0 82-31.5 155t-86 127.5Q708-143 635-111.5T480-80Zm0-400Zm0 340q140 0 240-100t100-240q0-140-100-240T480-820q-140 0-240 100T140-480q0 140 100 240t240 100Z" fill="#5D3E00"/>
            </svg> 
            <?php echo esc_html($event_time); ?>
        </span>
        
    <?php endif; ?>
</p>
    <?php endif; ?>

    <br>

<?php endwhile; wp_reset_postdata(); else : ?>
    <p><?php echo __('No posts found in this category.', 'srft-theme'); ?></p>
<?php endif; ?>
</div>
           <?php
// Language-aware slug mapping
$slug_map = [
    'en_US' => [
        'event' => 'event',
        'announcement' => 'announcement',
        'tender'       => 'tender',
        'vacancy'      => 'vacancy',
    ],
    'hi_IN' => [
        'event' => 'कार्यक्रम',
        'announcement' => 'घोषणा-सूची',
        'tender'       => 'निविदा',
        'vacancy'      => 'रिक्ति',
    ]
];

$slug = $slug_map[$current_language][$post_type] ?? $post_type;
$final_url = site_url("/$slug/");
?>
 <?php if ($post_type != 'event') : ?>
        <div class="view-more-button" style="margin-top: 3rem;">
    <a href="<?php echo esc_url($final_url); ?>" 
       class="d-flex view-more-link align-items-center text-decoration-none fw-semibold" style="margin-top: 15px;"
       aria-label="Read more about latest <?php echo esc_attr(strtolower($title)); ?>">
       <?php _e('Read more', 'srft-theme'); ?> <span class="chevron-right-icon" aria-hidden="true"></span>
    </a>
</div>
<?php endif; ?>

        </div>
    
    <?php endforeach; ?>
</div>
</div>
</section>

<section class="section-home" style="background-color: #ebeaea; padding: 60px 0;">
    <div class="section-intro-header">
        <h2 class="section-intro-header-text"  style="display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 12px; flex-direction: row;">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48 " viewBox="0 0 64 64" fill="none" aria-hidden="true" style="display: flex; justify-content: center;">
<path opacity="0.946" fill-rule="evenodd" clip-rule="evenodd" d="M24.3828 2C26.1406 2 27.8984 2 29.6562 2C39.4831 3.44595 46.3777 8.71941 50.3398 17.8203C51.3333 20.4249 51.8998 23.1201 52.0391 25.9062C54.7004 25.8538 57.3568 25.9124 60.0078 26.0821C61.0033 26.4579 61.6674 27.1413 62 28.1328C62 38.7187 62 49.3047 62 59.8906C61.5702 60.8671 60.8671 61.5702 59.8906 62C47.3126 62 34.7343 62 22.1562 62C20.9619 61.6057 20.2391 60.7855 19.9884 59.5391C19.9297 56.6878 19.9101 53.8363 19.9297 50.9844C11.2961 48.2296 5.61248 42.5264 2.87891 33.875C2.49545 32.3917 2.20248 30.9073 2 29.4219C2 27.7812 2 26.1406 2 24.5C3.26415 15.1524 8.1079 8.37495 16.5312 4.16797C19.0602 3.07023 21.6774 2.34758 24.3828 2ZM25.5547 4.22657C25.6719 4.22657 25.7891 4.22657 25.9062 4.22657C25.9062 7.46876 25.9062 10.7109 25.9062 13.9531C23.2655 14.0023 20.6484 14.2757 18.0547 14.7734C18.7104 11.4143 20.2728 8.46506 22.7422 5.92578C23.5974 5.20596 24.535 4.63954 25.5547 4.22657ZM28.0156 4.22657C28.7259 4.34685 29.39 4.60076 30.0078 4.98828C31.7351 6.20722 33.0827 7.75019 34.0509 9.6172C34.9109 11.2609 35.6337 12.9601 36.2188 14.7148C33.5047 14.299 30.7704 14.045 28.0156 13.9531C28.0156 10.7109 28.0156 7.46876 28.0156 4.22657ZM20.1641 5.04687C20.2873 5.02935 20.4046 5.04889 20.5156 5.10547C18.0594 8.08452 16.3601 11.4634 15.418 15.2422C12.2637 16.1375 9.31446 17.4853 6.57032 19.2851C6.08202 19.6953 5.59376 20.1055 5.10547 20.5156C7.16325 13.7294 11.4406 8.86618 17.9375 5.92578C18.7053 5.66406 19.4474 5.37108 20.1641 5.04687ZM33.5234 5.04687C41.2447 7.57274 46.4009 12.6899 48.9922 20.3984C48.9335 20.5181 48.8553 20.5376 48.7578 20.4571C47.189 19.0471 45.4312 17.9143 43.4844 17.0586C41.9126 16.4109 40.3109 15.8446 38.6797 15.3594C37.7001 11.5251 35.9814 8.08761 33.5234 5.04687ZM24.6172 16.0625C25.0469 16.0625 25.4765 16.0625 25.9062 16.0625C25.9062 19.3438 25.9062 22.625 25.9062 25.9062C22.625 25.9062 19.3438 25.9062 16.0625 25.9062C16.1737 22.9466 16.5253 20.0169 17.1172 17.1172C19.6145 16.6319 22.1146 16.2805 24.6172 16.0625ZM28.0156 16.0625C30.9936 16.1173 33.9234 16.508 36.8047 17.2344C37.469 20.0493 37.8596 22.901 37.9766 25.7891C34.6572 25.9062 31.3368 25.9453 28.0156 25.9062C28.0156 22.625 28.0156 19.3438 28.0156 16.0625ZM14.5391 17.8203C14.6664 17.8344 14.7445 17.9126 14.7734 18.0547C14.2757 20.6484 14.0023 23.2655 13.9531 25.9062C10.7109 25.9062 7.46876 25.9062 4.22657 25.9062C4.40674 24.9991 4.77782 24.1788 5.33984 23.4453C6.67062 21.9497 8.21359 20.7193 9.96874 19.7538C11.4705 19.0265 12.994 18.382 14.5391 17.8203ZM39.1484 17.9375C42.7573 18.7569 45.8627 20.5147 48.4648 23.2109C49.067 23.9853 49.5161 24.8446 49.8125 25.7891C46.5712 25.9062 43.3291 25.9453 40.0859 25.9062C40.0176 23.2053 39.7052 20.5491 39.1484 17.9375ZM4.22657 28.0156C7.46876 28.0156 10.7109 28.0156 13.9531 28.0156C13.9728 29.1111 14.0314 30.2049 14.1289 31.2969C14.3142 32.9446 14.5095 34.5852 14.7148 36.2188C12.17 35.4247 9.80674 34.2725 7.62499 32.7617C6.28833 31.7773 5.25318 30.5469 4.51953 29.0703C4.38537 28.7267 4.28771 28.3751 4.22657 28.0156ZM16.0625 28.0156C17.3906 28.0156 18.7188 28.0156 20.0469 28.0156C19.9728 31.1386 19.8948 34.2637 19.8125 37.3906C18.9258 37.2172 18.047 37.0218 17.1759 36.8047C16.5067 33.9131 16.1356 30.9834 16.0625 28.0156ZM22.8594 28.0156C34.9687 27.9961 47.0782 28.0156 59.1875 28.0742C59.4871 28.1545 59.7021 28.3302 59.8321 28.6016C59.8906 35.711 59.9102 42.8201 59.8906 49.9297C47.2734 49.9297 34.6563 49.9297 22.0391 49.9297C22.0195 42.8983 22.0391 35.8671 22.0976 28.8359C22.217 28.424 22.4709 28.1506 22.8594 28.0156ZM37.7422 33.0547C38.0849 33.05 38.3975 33.1476 38.6797 33.3476C41.4243 35.0421 44.1392 36.7803 46.8242 38.5625C46.9857 39.0778 46.8491 39.4881 46.4141 39.793C43.7771 41.4043 41.1599 43.045 38.5625 44.7148C37.9273 45.0494 37.439 44.9127 37.0976 44.3047C37.0195 40.7891 37.0195 37.2734 37.0976 33.7578C37.2172 33.4239 37.4321 33.1893 37.7422 33.0547ZM5.04687 33.4062C8.08407 35.9017 11.5216 37.6593 15.3594 38.6797C16.2082 42.1349 17.7122 45.26 19.8711 48.0547C19.9659 48.2983 19.9462 48.5327 19.8125 48.7578C12.3385 46.0886 7.41663 40.9713 5.04687 33.4062ZM17.8203 39.1484C18.5139 39.3161 19.217 39.4333 19.9297 39.5C19.9492 41.0628 19.9297 42.6254 19.8711 44.1875C18.9926 42.5876 18.3091 40.9078 17.8203 39.1484ZM22.0391 52.0391C34.6563 52.0391 47.2734 52.0391 59.8906 52.0391C59.9102 54.5004 59.8906 56.9613 59.8321 59.4219C59.6952 59.5586 59.5586 59.6952 59.4219 59.8321C47.1562 59.9102 34.8907 59.9102 22.625 59.8321C22.3201 59.7224 22.1443 59.5078 22.0976 59.1875C22.0391 56.8049 22.0195 54.4222 22.0391 52.0391Z" fill="#5d3e00"/>
<path opacity="0.913" fill-rule="evenodd" clip-rule="evenodd" d="M24.7339 53.9143C25.2554 53.8723 25.6656 54.0676 25.9643 54.5003C26.0426 55.4768 26.0426 56.4534 25.9643 57.4299C25.6249 57.9755 25.1367 58.1512 24.4995 57.9572C24.2387 57.8135 24.0629 57.5986 23.9722 57.3128C23.8662 56.327 23.9052 55.3505 24.0893 54.383C24.2652 54.1524 24.4799 53.996 24.7339 53.9143Z" fill="#5d3e00"/>
<path opacity="0.916" fill-rule="evenodd" clip-rule="evenodd" d="M28.7187 53.9142C29.2488 53.8767 29.659 54.0719 29.9492 54.5001C30.0273 55.5157 30.0273 56.5312 29.9492 57.547C29.5512 57.9809 29.0629 58.1176 28.4843 57.9572C28.2137 57.7653 28.0379 57.5114 27.9569 57.1955C27.8789 56.4141 27.8789 55.6329 27.9569 54.8517C28.0253 54.3745 28.2793 54.062 28.7187 53.9142Z" fill="#5d3e00"/>
<path opacity="0.942" fill-rule="evenodd" clip-rule="evenodd" d="M39.7339 53.914C40.4872 53.8871 40.917 54.2388 41.023 54.9687C46.4919 54.9491 51.9607 54.9687 57.4293 55.0274C57.9748 55.3668 58.1505 55.855 57.9565 56.4922C57.8128 56.753 57.5979 56.9288 57.312 57.0195C51.8826 57.0781 46.4529 57.0976 41.023 57.0781C40.9684 57.7184 40.6168 58.0309 39.9682 58.0156C39.426 57.9974 39.0744 57.7238 38.9136 57.1953C37.1571 57.0976 35.3992 57.039 33.6401 57.0195C32.7506 56.4083 32.7116 55.7442 33.523 55.0274C35.3211 55.0077 37.118 54.9491 38.9136 54.8515C39.0291 54.3854 39.3024 54.073 39.7339 53.914Z" fill="#5D3E00"/>
</svg><?php echo __('Trending Social Media', 'srft-theme'); ?>
        </h2>
        <p style="font-size: 16px; color: #000; margin-top: 10px;">
            <?php echo __('Join Our Social Hub to stay up to date', 'srft-theme'); ?>
        </p>
    </div>

    <div class="social-feed-container" style="max-width: 1450px; margin: 40px auto; padding: 0 20px;">
        <div class="box-container" style="display:flex; gap:1rem;">
            <?php
            // Language detection
            //$category_slug = ($current_language === 'hi_IN') ? 'social-hi' : 'social-en';

            $social_query = new WP_Query([
                'post_type'      => 'social',
                'posts_per_page' => 4,
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
            ]);
            ?>

            <div class="box-container social-feeds">

                <?php if ($social_query->have_posts()) :
                    while ($social_query->have_posts()) : $social_query->the_post();

                       $platform = function_exists('pll_current_language') && pll_current_language() === 'hi' ? get_field('social_platform_hindi') : get_field('social_platform');
$raw_embed_code = get_field('embed_code');
$social_handle = get_field('social_handle'); 

$embed_code = $raw_embed_code;

// ACCESSIBILITY FIX: Use DOMDocument to safely parse and inject missing alt tags
if (!empty($embed_code)) {
    $dom = new DOMDocument();
    
    // Suppress warnings because Instagram's raw HTML often has minor validation errors
    libxml_use_internal_errors(true); 
    
    // Load the HTML safely with correct UTF-8 encoding
    $dom->loadHTML(mb_convert_encoding($embed_code, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    
    // Find EVERY image tag in the Instagram embed
    $images = $dom->getElementsByTagName('img');
    foreach ($images as $img) {
        // If it doesn't have an alt tag, or if the alt tag is empty, force one in.
        if (!$img->hasAttribute('alt') || trim($img->getAttribute('alt')) === '') {
            $img->setAttribute('alt', 'Instagram social feed image');
        }
    }
    
    // Save the corrected HTML back to our variable
    $embed_code = $dom->saveHTML();
    
    // Clear the memory
    libxml_clear_errors();
}
                        
                        // Normalize platform to lowercase for comparison
                        $platform_lower = strtolower($platform);
                        
                        // Default social media URLs if no custom handle provided
                        $platform_urls = [
                            'linkedin' => 'https://www.linkedin.com/school/satyajit-ray-film-and-television-institute-srfti/',
                            'facebook' => 'https://www.facebook.com/srftikol',
                            'youtube' => 'https://www.youtube.com/@your-channel',
                            'twitter' => 'https://x.com/srfti_official',
                            'instagram' => 'https://www.instagram.com/srfti_official/',
                            'vimeo' => 'https://vimeo.com/your-account',
                            'लिंक्डइन' => 'https://www.linkedin.com/school/satyajit-ray-film-and-television-institute-srfti/',
                            'फेसबुक' => 'https://www.facebook.com/srftikol',
                            'यूट्यूब' => 'https://www.youtube.com/@your-channel',
                            'ट्विटर' => 'https://x.com/srfti_official',
                            'इंस्टाग्राम' => 'https://www.instagram.com/srfti_official/',
                            'विमियो' => 'https://vimeo.com/your-account'

                        ];
                        
                        // Use custom handle if provided, otherwise use default
                        $social_url = $platform_urls[$platform_lower];
                ?>

                    <article class="cell social-card social-<?php echo esc_attr($platform_lower); ?>" aria-label="<?php echo esc_attr(ucfirst($platform_lower)); ?> feed">

                        <h3 class="update-title" style="display: flex; align-items: center; gap: 10px;">
                            
                          <?php if (in_array($platform_lower, ['linkedin', 'लिंक्डइन'], true)): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 22" width="24" height="24" fill="#007AB9" style="flex-shrink: 0;" aria-hidden="true">
                                    <path d="M20.9302 12.2503V19.99H16.443V12.7689C16.443 10.9553 15.7939 9.71725 14.171 9.71725C13.6626 9.72116 13.1679 9.88297 12.7555 10.1803C12.343 10.4776 12.0332 10.8958 11.8688 11.3769C11.7533 11.7285 11.7023 12.0981 11.7183 12.4678V19.99H7.23105C7.23105 19.99 7.29128 7.75975 7.23105 6.4949H11.7183V8.40555C11.7183 8.42229 11.6982 8.43567 11.6915 8.4524H11.7183V8.40555C12.1253 7.7005 12.7173 7.12018 13.4304 6.72738C14.1434 6.33457 14.9503 6.14426 15.7638 6.17701C18.7151 6.17701 20.9302 8.10775 20.9302 12.2503ZM2.53974 0C1.00385 0 0 1.00385 0 2.34231C0 3.68078 0.973733 4.68462 2.4795 4.68462H2.50962C4.07228 4.68462 5.04601 3.64731 5.04601 2.34231C5.04601 1.03731 4.07228 0 2.53974 0ZM0.264347 20H4.75155V6.4949H0.264347V20Z"/>
                                </svg>
                                
                           <?php elseif (in_array($platform_lower, ['facebook', 'फेसबुक'], true)): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="24" height="24" fill="#1877F2" style="flex-shrink: 0;" aria-hidden="true">
                                    <path d="M10,0C4.5,0,0,4.5,0,10c0,5,3.7,9.1,8.4,9.9v-7H5.9v-2.9h2.5V7.8c0-2.5,1.5-3.9,3.8-3.9c1.1,0,2.2,0.2,2.2,0.2v2.5h-1.3 c-1.2,0-1.6,0.8-1.6,1.6v1.9h2.8L13.9,13h-2.3v7C16.3,19.1,20,15,20,10C20,4.5,15.5,0,10,0z"/>
                                </svg>
                                
                            <?php elseif ($platform_lower === 'youtube'): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="24" height="24" fill="#FF0000" style="flex-shrink: 0;" aria-hidden="true">
                                    <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
                                </svg>
                                
                         <?php elseif (in_array($platform_lower, ['twitter', 'ट्विटर', 'x', 'एक्स'], true)): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="#000000" style="flex-shrink: 0;" aria-hidden="true">
                                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                </svg>
                                
                            <?php elseif (in_array($platform_lower, ['instagram', 'इंस्टाग्राम'], true)): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="24" height="24" fill="#E4405F" style="flex-shrink: 0;" aria-hidden="true">
                                    <path d="M10 0C7.284 0 6.944.012 5.877.06 2.246.227.498 1.986.332 5.617.285 6.684.273 7.024.273 9.74c0 2.715.012 3.056.06 4.123.165 3.628 1.924 5.386 5.555 5.554 1.066.047 1.405.059 4.122.059 2.716 0 3.056-.012 4.122-.06 3.626-.167 5.39-1.925 5.555-5.555.047-1.066.06-1.406.06-4.122 0-2.717-.013-3.056-.06-4.123C19.521 1.987 17.762.228 14.133.06 13.067.013 12.727 0 10.01 0h-.01zm-.898 1.802h.898c2.671 0 2.987.01 4.041.058 2.71.123 3.793 1.224 3.916 3.916.048 1.054.058 1.37.058 4.041 0 2.672-.01 2.988-.058 4.042-.123 2.69-1.205 3.793-3.916 3.916-1.054.048-1.37.058-4.041.058-2.67 0-2.987-.01-4.04-.058-2.713-.123-3.794-1.227-3.917-3.916-.047-1.054-.057-1.37-.057-4.041 0-2.67.01-2.987.057-4.041.124-2.692 1.207-3.794 3.917-3.917 1.054-.047 1.37-.057 4.041-.057l.001-.001zm7.757 1.658a1.2 1.2 0 1 0 0 2.4 1.2 1.2 0 0 0 0-2.4zM10 4.865a5.135 5.135 0 1 0 0 10.27 5.135 5.135 0 0 0 0-10.27zm0 1.802a3.333 3.333 0 1 1 0 6.666 3.333 3.333 0 0 1 0-6.666z"/>
                                </svg>
                                
                            <?php elseif ($platform_lower === 'vimeo'): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="24" height="24" fill="#1AB7EA" style="flex-shrink: 0;" aria-hidden="true">
                                    <path d="M19.98 5.347c-.105 2.338-1.739 5.543-4.894 9.609-3.268 4.247-6.026 6.37-8.29 6.37-1.409 0-2.578-1.294-3.553-3.881L1.325 10.33C.603 7.747-.166 6.453-.99 6.453c-.179 0-.806.378-1.881 1.132L-4 6.128a315.065 315.065 0 0 0 3.501-3.128C1.08 1.632 2.266.915 3.055.84c1.867-.18 3.016 1.1 3.447 3.838.465 2.953.789 4.789.971 5.507.539 2.45 1.131 3.674 1.776 3.674.502 0 1.256-.796 2.265-2.385 1.004-1.589 1.54-2.797 1.612-3.628.144-1.371-.395-2.061-1.614-2.061-.574 0-1.167.121-1.777.391 1.186-3.868 3.434-5.757 6.762-5.637 2.473.06 3.628 1.664 3.493 4.797l-.013.01z"/>
                                </svg>
                                
                            <?php endif; ?>
                            
                            <span style="line-height: 1;"><?php echo esc_html(ucfirst($platform_lower)); ?></span>
                        </h3>

                        <div class="social-embed" tabindex="0"  role="region"
     aria-label="social media posts from SRFTI official page">
                            <?php echo $embed_code; ?>
                        </div>

                    <div class="view-more-button" style="margin-top: 3rem;">
    <a href="<?php echo esc_url($social_url); ?>" 
       class="d-flex view-more-link align-items-center text-decoration-none fw-semibold" 
       aria-label="Read more about latest <?php echo esc_attr(strtolower($title)); ?>">
        <?php _e('Read more', 'srft-theme'); ?><span class="chevron-right-icon"></span>
    </a>
</div>

                    </article>

                <?php
                    endwhile;
                    wp_reset_postdata();
                else : ?>
                    <p><?php _e('No social feeds available', 'srft-theme'); ?></p>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>

</main>
<?php
get_footer(); 
?>
  <!--</div>
  </div>
  </main>

-->
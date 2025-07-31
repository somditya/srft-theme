<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <meta name="description" content="Welcome to the official site of Satyajit Ray Film & Television Institute – India's premier film and television training institute.">
    <?php wp_head(); ?>
    <style>
      html, body {
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: black;
      }

      #intro-video {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        object-fit: contain;
        background-color: black;
        z-index: 9999;
      }

      #skip-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 10000;
        background: rgba(0, 0, 0, 0.7);
        color: #fff;
        border: none;
        padding: 10px 16px;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
      }

      #skip-button:hover {
        background: rgba(255, 255, 255, 0.2);
      }

      #video-loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: black;
        z-index: 9998;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .spinner {
        border: 8px solid rgba(255, 255, 255, 0.2);
        border-top: 8px solid white;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        animation: spin 1s linear infinite;
      }

      @keyframes spin {
        to {
          transform: rotate(360deg);
        }
      }
    </style>
</head>
<body <?php body_class(); ?>>

<video id="intro-video" playsinline muted preload="auto" autoplay>
  <source id="video-source" src="" type="video/mp4">
  Your browser does not support the video tag.
</video>

<button id="skip-button">Skip to Home</button>

<div id="video-loader">
  <div class="spinner"></div>
</div>

<script>
  const video = document.getElementById('intro-video');
  const videoSource = document.getElementById('video-source');
  const skipBtn = document.getElementById('skip-button');
  const loader = document.getElementById('video-loader');
  let redirected = false;
  let fallbackTimerStarted = false;

  function goToHome() {
    if (!redirected) {
      redirected = true;
      window.location.href = "<?php echo home_url('/home'); ?>";
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    const videos = [
      "<?php echo get_template_directory_uri(); ?>/videos/Promo_1_16-9_Final4.mp4",
      "<?php echo get_template_directory_uri(); ?>/videos/Promo_2_16-9_Final4.mp4"
    ];

    const randomVideo = videos[Math.floor(Math.random() * videos.length)];
    videoSource.src = randomVideo;
    video.load();

    video.play().catch(() => {
      video.setAttribute('controls', true);
    });
  });

  video.addEventListener('playing', () => {
    if (loader) loader.style.display = 'none';

    if (!fallbackTimerStarted) {
      fallbackTimerStarted = true;
      setTimeout(goToHome, 30000); // fallback after 30 sec
    }
  });

  video.addEventListener('ended', goToHome);
  skipBtn.addEventListener('click', goToHome);
</script>

<?php wp_footer(); ?>
</body>
</html>




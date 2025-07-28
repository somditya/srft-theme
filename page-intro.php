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
</style>
</head>
<body>

<video id="intro-video" playsinline muted preload="auto" autoplay>
  <source id="video-source" src="" type="video/mp4">
  Your browser does not support the video tag.
</video>

<button id="skip-button">Skip to Home</button>

<script>
  const video = document.getElementById('intro-video');
  const videoSource = document.getElementById('video-source');
  const skipBtn = document.getElementById('skip-button');
  let redirected = false;

  function goToHome() {
    if (!redirected) {
      redirected = true;
      window.location.href = "<?php echo home_url('/home'); ?>";
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    // Array of video filenames
    const videos = [
      "<?php echo get_template_directory_uri(); ?>/videos/Promo_1_16-9_Final4.mp4",
      "<?php echo get_template_directory_uri(); ?>/videos/Promo_2_16-9_Final4.mp4"
    ];

    // Pick one at random
    const randomVideo = videos[Math.floor(Math.random() * videos.length)];
    videoSource.src = randomVideo;
    video.load();

    // Attempt autoplay
    video.play().catch(() => {
      video.setAttribute('controls', true);
    });
  });

  video.addEventListener('ended', goToHome);
  skipBtn.addEventListener('click', goToHome);

  // Fallback timeout
  setTimeout(goToHome, 30000); // 30 seconds
</script>

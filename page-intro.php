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
  <source src="<?php echo get_template_directory_uri(); ?>/videos/Promo_2_16-9_Final4.mp4" type="video/mp4">
  Your browser does not support the video tag.
</video>

<button id="skip-button">Skip to Home</button>

<script>
  const video = document.getElementById('intro-video');
  const skipBtn = document.getElementById('skip-button');
  let redirected = false;

  function goToHome() {
    if (!redirected) {
      redirected = true;
      window.location.href = "<?php echo home_url('/home'); ?>";
    }
  }

  // Autoplay or wait for user interaction
  document.addEventListener('DOMContentLoaded', () => {
    video.play().catch(() => {
      video.setAttribute('controls', true);
    });
  });

  video.addEventListener('ended', goToHome);
  skipBtn.addEventListener('click', goToHome);

  // Optional fallback redirect
  setTimeout(goToHome, 30000); // 30s fallback
</script>

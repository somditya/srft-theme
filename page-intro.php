<?php
/*
Template Name: Video Intro
*/
get_header();
?>

<style>
  html, body {
    margin: 0;
    padding: 0;
    overflow: hidden;
  }
  #intro-video {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    width: 100vw;
    object-fit: cover;
    z-index: 9999;
  }
</style>

<video id="intro-video" autoplay muted playsinline>
  <source src="<?php echo get_template_directory_uri(); ?>/videos/intro.mp4" type="video/mp4">
  Your browser does not support the video tag.
</video>

<script>
  const video = document.getElementById('intro-video');
  video.addEventListener('ended', () => {
    window.location.href = "<?php echo home_url(); ?>";
  });

  // Optional fallback
  setTimeout(() => {
    window.location.href = "<?php echo home_url(); ?>";
  }, 15000); // 15 seconds fallback
</script>

<?php get_footer(); ?>

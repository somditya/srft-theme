<?php
/*
Template Name: Contact
*/
?>

<?php get_header(); ?>

<main>
      <body>
      <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
      <div class="page-banner">
        <div class="page-banner-title"><?php echo __('Connect With Us', 'srft-theme' ); ?></div>
      </div>
     </section>

<section class="cine-detail">

<div class="leftnav">
  <div class="widget">
  <strong>Satyajit Ray Film &amp; Television Institute</strong>
E.M.Byepass Road, P.O. Panchasayar,
Kolkata-700094

Phone-(033)2432 8355/8356/9300
Fax - (033)2432-0723/9436
</div>
        </div>

<div class="main-content">
  <div><?php 
  wp_reset_postdata();
  if(function_exists('bcn_display'))
{
bcn_display();
}?></div>

  <section class="page-title">
          <div>
            </p>
            <?php echo '<p class="page-header-text">' . esc_html($post->post_title) . '</p>';?>
          </div>
  </section>
  <section class="one-flex" style="margin-top: 10rem; margin-bottom: 10rem;">
        <div class="accordian">
          <ul>
            <li>
              <input type="checkbox" checked>
              <i></i>
              <h2><?php echo __('Contact a Section', 'srft-theme' ); ?></h2>
              
            </li>
          </ul>
            <ul>
              <li>
                <input type="checkbox" checked>
                <i></i>
                <h2><?php echo __('Directories and Listings', 'srft-theme' ); ?></h2>
                <p>
              <p> 1.  Shri. Himansu Sekhar Khatua	from 04.08.2022 </p>
              <p> 2.	Shri. Samiran Datta Additional Charge [ 04.02.2022 ]</p>
              <p> 3.	Shri. Debasish Ghoshal Additional Charge	01.06.2021</p>
              <p> 4.	Shri. Amaresh Chakrabarti Additional Charge	05.02.2020</p>
              <p> 5.	Dr. Debamitra Mitra	27.01.2017
              <p> 6.	Shri Amaresh Chakrabarti Additional Charge	03.06.2016</p>
              <p> 7.	Shri Debanjan Chakrabarti Additional Charge	24.03.2016 </p>
              <p> 8.	Shri Sanjaya Pattanayak	27.03.2012 </p>
              <p> 9.	Shri Shankar Mohan Additional Charge	19.06.2010 </p>
              <p>10.	Shri Swapan Mullick	19.06.2006 </p>
              <p>11.	Shri Abhay Shrivastava	03.01.2005 </p>
              <p>12.	Shri Jatin Sarkar	24.12.2001 </p>
              <p>13.	Dr. Debasish Majumdar	29.08.1997</p> 
            </p>
                </table>
              </li>
              <ul>
                <li>
                  <input type="checkbox" checked>
                  <i></i>
                  <h2><?php echo __('Previous Registrars', 'srft-theme' ); ?></h2>
                  <p>
                    <tbody>
                      <th>Name</th>
                      <th>Tenure</th>
                    </tbody> </p>
                  </table>
                </li>
              </ul>
            </ul>
          </div>
          </section>

<section style="margin-bottom: 4rem;">
    <div><?php  echo wp_kses_post($post->post_content); ?></div>   
</section>

<div class="contaactus_map"><iframe title="Map to Satyajit Ray Film &amp; Television Institute" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=SRFTI,+Pancha+Sayar,+Kolkata,+West+Bengal,+India&amp;aq=0&amp;oq=srfti+kolkata&amp;sll=37.0625,-95.677068&amp;sspn=37.462243,86.572266&amp;ie=UTF8&amp;hq=SRFTI,&amp;hnear=Pancha+Sayar,+Kolkata,+West+Bengal,+India&amp;t=m&amp;ll=22.486017,88.394934&amp;spn=0.008074,0.012007&amp;output=embed" width="100%" height="750" frameborder="0" marginwidth="0" marginheight="0" scrolling="no"></iframe>
<small><a style="color: #0000ff; text-align: left;" href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=SRFTI,+Pancha+Sayar,+Kolkata,+West+Bengal,+India&amp;aq=0&amp;oq=srfti+kolkata&amp;sll=37.0625,-95.677068&amp;sspn=37.462243,86.572266&amp;ie=UTF8&amp;hq=SRFTI,&amp;hnear=Pancha+Sayar,+Kolkata,+West+Bengal,+India&amp;t=m&amp;ll=22.486017,88.394934&amp;spn=0.008074,0.012007">View Larger Map</a></small></div>

</div>
        
</main>

<?php get_footer(); ?>
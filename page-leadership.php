<?php

/*
Template Name: Leadership

 */
get_header();
?>
<main>
      <body>
      <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
        <div class="page-banner">
          <div class="page-banner-title"><?php echo __('About SRFTI', 'srft-theme'); ?></div>
      </section>

      <section class="cine-detail">
      <div class="leftnav">
          <!--<div>
          <p class="office-header-text">Management</p>-->
          <!--<div class="ftest">Satyajit Ray Film & Television Institute</div>-
        </div>-->
        <div class="childnavs">
    <ul class="childnav-lists">
        <?php
        $current_language = get_locale(); // Get the current language/locale.

        $menu_name = ($current_language === 'hi_IN') ? 'hindi_admin_menu' : 'english_admin_menu'; // Define menu name based on language.

        // Get the current page title
        $current_page_title = get_the_title();

        // Define a custom menu walker to modify the menu output.
        class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
            public function start_lvl(&$output, $depth = 0, $args = null) {
                // Customize the submenu opening tag as needed.
                $output .= '<ul class="submenu">';
            }

            public function start_el(&$output, $item, $depth = 0, $args = null, $current_object_id = 0) {
                // Check if the current page title matches the menu item title.
                $is_current = ($item->title === $GLOBALS['current_page_title']) ? 'active' : '';

                // Customize the menu item HTML structure as needed.
                $output .= '<li class="childnav-list-item ' . $is_current . '">';
                $output .= '<a class="item" href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
            }

            public function end_el(&$output, $item, $depth = 0, $args = null) {
                // Close the menu item tag.
                $output .= '</li>';
            }

            public function end_lvl(&$output, $depth = 0, $args = null) {
                // Customize the submenu closing tag as needed.
                $output .= '</ul>';
            }
        }

        // Display the menu based on the language and custom walker.
        wp_nav_menu(array(
            'menu' => $menu_name,
            'container' => false, // No container element.
            'menu_class' => 'childnav-lists', // You can customize this class as needed.
            'walker' => new Custom_Walker_Nav_Menu(),
        ));
        ?>
    </ul>
</div>
        <!--<div class="widget">
         
        </div> --->
        </div>

        <div class="main-content">
        <div><?php if(function_exists('bcn_display'))
{
bcn_display();
}?></div>
          <section class="page-title">
            <div>
              <p class="page-header-text">Under their leadership</p>
            </div>
          </section>
          <section class="profile">
        <div class="two-flex">
          <div class="col-left">
            <div class="profile-container">
              <img src="<?php bloginfo('template_url'); ?>/images/H.S.Khatua.jpg" class="img-responsive" target="_blanK" alt="Vipin Vijay">
         
              <div class="profile-text">
                <div class="profile-name">Himansu Sekhar Khatua</div>
                <div class="profile-desg">Director</div>
              </div>   </div>
          
          </div>

          <div class="col-right"><div class="profile-desc">
            Himansu Sekhar Khatua is an Indian filmmaker, educationalist and journalist. He directed the national film award-winning movies Sunya Swarupa and Kathantara in 1996 and 2005, respectively. He served as the managing director of Kalinga Media and Entertainment Private Limited (KMEPL) as well as the CMD of Kalinga TV, a news channel, and KNews Odisha, a digital platform.

After receiving his professional training in cinema from the Film and Television Institute of India, award-winning filmmaker Himanshu Sekhar Khatua delved deeply into the domain of filmmaking. He relocated to Mumbai in the 1990s to work as a professional Sound Recordist, but after a year he made the decision to return to his native Odisha to do something for his own State. He did the sound design for Indradhanura Chhai (Shadows of the Rainbow).

His debut film, Shunya Swarupa (Contours of the Void), took him to international film festivals including Rotterdam (Netherlands), Kinotavr (Russia), Pesan(Italy). Gothenburg (Sweden)and Valencia (Spain). The film won many state and national awards, including Best Regional Film in Oriya. His second film, Kathantara (Another Story), about the 1999 Odisha storm, won eight state awards. The film won best feature at the 53rd National Film Awards in 2006. His third feature film, “Matira Bandhana'(The Inheritance) based on ‘Trunk of Ganesha’ by Padma Shri Jayanta Mahapatra is a one of its kind movie which garnered huge appreciation in film festivals. His fourth feature Krantidhara (Coup de Grace), received the Asian Excellence Awards in South Korea. It got rave reviews for portraying issues of women’s empowerment.

He has been a writer, film festival jury member, and film festival organizer. His academic and administrative journey started from the State Government Institute BPFTIO. Odisha as a senior faculty. He shifted to KIIT University as a senior member (Board of Directors) to establish three schools, School of Film, School of Fashion and School of Mass Communication. He played a vital role in introducing Filmmaking education at University level. He has simultaneously displayed commendable excellence in filmmaking, excellent leadership in the media sector, and the development of new talent for the film industry.

He has taken charge as the Director of the Satyajit Ray Film and Television Institute, a premier film institute in South Asia under the Ministry of Information and Broadcasting, Government of India.

<p style="color:#8b5b2b; margin-top: 1rem;">email: director@srfti.ac.in</p></div>
        </div>
          </div>
          </section>
<section class="profile"> 
          <div class="two-flex">
            <div class="col-left">
              <div class="profile-container">
                <img src="<?php bloginfo('template_url'); ?>/images/Vipin-Vijay-small.jpg" class="img-responsive" target="_blanK" alt="Vipin Vijay">
           
                <div class="profile-text">
                  <div class="profile-name">Vipin Vijay</div>
                  <div class="profile-desg">Dean</div>
                </div>   </div>
            
            </div>
  
            <div class="col-right">
              <div class="profile-desc">
              Vipin Vijay, multiple award-winning filmmaker is an alumnus of SRFTI. He has been engaged in his search for new cinematic forms since 2000 working in the domain of creative documentary , film essay, feature film and video art. He has participated in seminars, confreneces, and workshops on various themes related to cinema, visual culture,pedagogy of cinema, and has taught extensively at national film schools across the country. Also served as Academic committee member, Board of Studies, University of Calicut, Syllabus Committee Member FTIl Pune, and was a Jury member on several occasions in national and international film festivals.

He has made several nationally and internationally acclaimed and awarded non-fiction and fiction works which were exhibited in film festivals of Rotterdam, Karlovy Vary, Oberhausen, São Paulo, Nantes,
Montreal, Japan, Vladivostok, IFFL, IFFK etc. Recipient of film grants from Rotterdam, Gothenburg, Global Film Initiative, PSBT, IGNCA, IFA, etc, his works have also been shown under curatorial program in art museums like Serpentine Gallery, London, Alserkal Arts Foundation, Dubai, Ullens Centre for Contemporary art (UGCA) Beijing, He has receivedvInternational awards, several National Awards, Kerala State Awards, Sanskriti Award for his works. The prestigious Oberhausen International Film Festival, Germany 2015 honored him with a specially curated retrospective of his works. He was the ‘Film Maker in Focus’ at the IDSFFK, 2017.

<p style="color:#8b5b2b; margin-top: 1rem;">email: dean@srfti.ac.in</p></div>
          </div>
            </div>
</section>

        <section class="one-flex" style="margin-top: 10rem; margin-bottom: 10rem;">
        <div class="accordian">
          <ul>
            <li>
              <input type="checkbox" checked>
              <i></i>
              <h2><?php echo __('Previous Chairmans', 'srft-theme' ); ?></h2>
              
            </li>
          </ul>
            <ul>
              <li>
                <input type="checkbox" checked>
                <i></i>
                <h2><?php echo __('Previous Directors', 'srft-theme' ); ?></h2>
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
    </main>

    <?php
get_footer(); 
?>


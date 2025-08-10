<div class="menu-btn">
          <div class="nav-links">
            <ul class="menubar-navigation" role="menubar" style="display: flex; align-items: center; justify-content: center;">
              <li role="none" class="nav-link" style="--i: 0.6s" >
                <a role="menuitem" href="<?php  if ($current_language === 'en_US') { echo esc_url(site_url('/home/'));} 
                    else 
                    { echo esc_url(site_url('/घर/'));}
                    ?>" aria-label="Home" ><i class="fa fa-home" aria-hidden="true"></i><span class="sr-only">Home</span></a>
              </li>
              <li role="none" class="nav-link" style="--i: 1.1s">
                <a role="menuitem" href="#" id="aboutMenuButton" aria-haspopup="true" role="menuitem" aria-expanded="false"><?php echo __('About Us', 'srft-theme' ); ?><i class="fa fa-chevron-down" style="margin-left:10px;"></i></a>
                  <ul role="menu" class="dropdown">
                    <li role="none" class="dropdown-link">
                    <a role="menuitem" href="<?php  if ($current_language === 'en_US') { echo esc_url(site_url('/about-the-institute/'));} 
                    else 
                    { echo esc_url(site_url('/संस्थान के बारे में/'));}
                    ?>"><?php echo __('About the Institute', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                    <a role="menuitem" href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/leadership/')); }
                    else  { echo esc_url(site_url('/नेतृत्व//'));}
                    ?>"><?php echo __('Leadership', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                    <a role="menuitem" href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/management/'));}
                    else  { echo esc_url(site_url('/प्रबंध/'));}
                    ?>"><?php echo __('Management', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                    <a role="menuitem" href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/organization-chart/'));} 
                     else { echo esc_url(site_url('/संगठन-संरचना/'));}
                      ?>">
                    <?php echo __('Organization Structure', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                    <a role="menuitem" href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/important-committees/'));}
                    else { echo esc_url(site_url('/महत्वपूर्ण-समितियाँ/'));}
                    ?>"><?php echo __('Important Committees', 'srft-theme' ); ?></a>
                    </li>
                   
                    <li role="none" class="dropdown-link">
                    <a role="menuitem" href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/annual-reports/'));}
                    else { echo esc_url(site_url('/वार्षिक-रिपोर्ट्स/'));}
                    ?>"><?php echo __('Annual Reports', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                    <a role="menuitem" href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/directory/'));}
                    else { echo esc_url(site_url('/निर्देशिका/'));}
                    ?>"><?php echo __('Directory', 'srft-theme' ); ?></a>
                    </li>
                    <!--<div class="arrow"></div>-->
                  </ul>
              </li>
              <li role="none" class="nav-link" style="--i: 1.1s">
                <a role="menuitem" href="#" aria-haspopup="true" aria-expanded="false"><?php echo __('Academics', 'srft-theme' ); ?><i class="fa fa-chevron-down" style="margin-left:10px;"></i></a>
                  <ul  role="menu" class="dropdown" aria-label="Academics">
                    <li role="none" class="dropdown-link">
                    <a role="menuitem" href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/mfa-in-cinema/'));}
                    else  { echo esc_url(site_url('/सनम-म-सनतकततर-करयकरम/'));}                   
                      ?>"><?php echo __('Master of Fine Arts in Cinema', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                      <a role="menuitem" href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/mfa-in-edm/'));}
                      else  { echo esc_url(site_url('/ईडीएम-में-स्नातकोत्तर-का/'));} ?>"><?php echo __('Master of Fine Arts in EDM', 'srft-theme' ); ?></a>
                    </li>
                    <!--<li class="dropdown-link">
                      <a href="#"><?php echo __('Certficate Programmes', 'srft-theme' ); ?></a>
                    </li>-->
                   
                    <li role="none" class="dropdown-link">
                      <a role="menuitem" href="<?php  if ($current_language === 'en_US') { echo esc_url(site_url('/faculty/'));} 
                    else 
                    { echo esc_url(site_url('/संकाय/'));}
                    ?>"><?php echo __('Faculty', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                      <a role="menuitem" href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/research/'));}
                      else { echo esc_url(site_url('/गवेषणा/'));}?>"><?php echo __('Research', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                      <a role="menuitem" href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/scholarship/'));}
                      else { echo esc_url(site_url('/छात्रवृत्ति/'));}?>"><?php echo __('Scholarship Schemes', 'srft-theme' ); ?></a>
                    </li>
                    <!--<div class="arrow"></div>-->
                  </ul>
              </li>
              <li role="none" class="nav-link" style="--i: 1.35s">
                <a role="menuitem" href="#" aria-haspopup="true"  aria-expanded="false"><?php echo __('Admission', 'srft-theme' ); ?><i class="fa fa-chevron-down" style="margin-left:10px;"></i></a>
                  <ul role="menu" class="dropdown" aria-label="Admission">
                    <li role="none" class="dropdown-link">
                      <a role="menuitem" href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/course-overview/')); }
                      else { echo esc_url(site_url('/पाठ्यक्रम-का-अवलोकन/'));}
                      ?>"><?php echo __('Master of Fine Arts', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                      <a role="menuitem" href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/post-graduate-programmes-at-fti-ar/')); } else  { echo esc_url(site_url('/फलम-और-टलवजन-ससथ-ए-आर/'));}?>"><?php echo __('Postgraduate programmes in IFTI AR', 'srft-theme' ); ?></a>
                    </li>
                  </ul>      
              </li>
              
              <li role="none" class="nav-link" style="--i: 1.35s">
                <a role="menuitem" href="#" aria-haspopup="true" aria-expanded="false"><?php echo __('Facilities', 'srft-theme' ); ?><i class="fa fa-chevron-down" style="margin-left:10px;"></i></a>
                  <ul role="menu" class="dropdown" aria-label="Facilities">
                    <li role="none" class="dropdown-link">
                    <a role="menuitem" href="<?php  if ($current_language === 'en_US') { echo esc_url(site_url('/library/'));} 
                    else 
                    { echo esc_url(site_url('/पुस्तकालय/'));}
                    ?>"><?php echo __('Library', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                    <a role="menuitem" href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/screening-room/'));}
                    else   { echo esc_url(site_url('/स्क्रीनिंग-सुविधाएँ/'));}?>"><?php echo __('Screening facilities', 'srft-theme' ); ?></a>
                    </li>
                   
                    <!--<li class="dropdown-link">
                    <a href="<?php echo esc_url(site_url('/accommodation/')); ?>"><?php echo __('IT Infrastrure', 'srft-theme' ); ?></a>
                    </li>-->
                    <li role="none" class="dropdown-link">
                    <a role="menuitem" href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/accommodation/'));}
                    else  { echo esc_url(site_url('/निवास/'));} ?>"><?php echo __('Accomodation', 'srft-theme' ); ?></a>
                    </li>
                    <!--<div class="arrow"></div>-->
                  </ul>
              
              </li>
              
              <li role="none" class="nav-link" style="--i: 1.35s">
                <a role="menuitem" href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/students/')); }
                else  { echo esc_url(site_url('/छात्र/'));}?>"><?php echo __('Students', 'srft-theme' ); ?><!--<i class="fas fa-chevron-down" style="margin-left:10px;"></i>--></a>
              </li>
             
              <li role="none" class="nav-link" style="--i: 1.35s">
                <a role="menuitem" href="#" aria-haspopup="true" aria-expanded="false"><?php echo __('Resources', 'srft-theme' ); ?><i class="fa fa-chevron-down" style="margin-left:10px;"></i></a>
                  <ul role="menu" class="dropdown" aria-label="Resources">
                    <li role="none" class="dropdown-link">
                      <a role="menuitem" href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/Vacancy/'));}
                      else  { echo esc_url(site_url('/रिक्ति/'));} ?>"><?php echo __('Recruitment Notices', 'srft-theme' ); ?></a>
                    </li>
                   
                    <li role="none" class="dropdown-link">
                    <a role="menuitem" href="<?php 
if ($current_language === 'en_US') {
    echo esc_url(site_url('/tender/'));
} else {
    echo esc_url(site_url('/hi/निविदा/'));
}
?>"><?php echo __('Tenders', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                      <a role="menuitem" href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/rti/')); }
                      else  { echo esc_url(site_url('/सूचना-का-अधिकार/'));} ?>"><?php echo __('RTI', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                      <a role="menuitem" href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/citizen-charter/'));} else
                       { echo esc_url(site_url('/नगरक-अधकर-पतर/'));} ?>"><?php echo __('Citizen Charter', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                      <a role="menuitem" href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/announcement/'));} else
                       { echo esc_url(site_url('/घोषणा-सूची/'));} ?>"><?php echo __('Circular & Notices', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                      <a role="menuitem" href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/news/'));} else
                       { echo esc_url(site_url('/समाचार-सूची/'));} ?>"><?php echo __('News', 'srft-theme' ); ?></a>
                    </li>
                    <!--<div class="arrow"></div>-->
                  </ul>
              </li>
              <li role="none" class="nav-link" style="--i: 1.35s">
                <a role="menuitem" href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/contact-us/')); }
                else  { echo esc_url(site_url('/हमसे-संपर्क-करें/'));}?>"><?php echo __('Contact Us', 'srft-theme' ); ?><!--<i class="fas fa-chevron-down" style="margin-left:10px;"></i>--></a>
              </li>
            </ul> 
          </div>

        </div>
        
        <div class="hamburger-menu-container"> 
          <div class="hamburger-menu">
            <div></div>
          </div>
        </div>
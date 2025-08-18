<?php
/*
Template Name: Vacancy
 */


get_header(); 

function get_category_ID( $cat_name ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
	$cat = get_term_by( 'name', $cat_name, 'category' );

	if ( $cat ) {
		return $cat->term_id;
	}

	return 0;
}
$page_content = apply_filters('the_content', $post->post_content);
$category_name = 'vacancy'; // Ensure this matches the exact category name.
$category_id = get_category_ID($category_name);
?>



  <main>
    <section class="cine-header"  style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
      <div class="page-banner">
        <h2 class="page-banner-title" style="margin-top: 10px;"><?php echo __('Recruitment Notices', 'srft-theme' ); ?></h2>
      </div>
    </section>

    <div class="container-aligned">
    <div class="breadcrumbs-wrapper">
    <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<nav aria-label="breadcrumbs" id="breadcrumbs">','</nav>' );
            }
    ?>
   </div>
   </div>
    <section id="skip-to-content" class="section-home">
      <div class="container" style="padding: 0 3.2rem
32px;">
      
        <h2 class="page-header-text" style="padding-bottom: 20px; text-align: center;"><?php echo __('Recruitment Notices', 'srft-theme' ); ?></h2>
        <div data-ng-app="myApp">
          <div data-ng-controller="VacancyController">
            <div class="filter-bar">
            <label for="fromDate"><?php echo __('From date: ', 'srft-theme' ); ?></label><input type="date" id="fromDate" data-ng-model="fromDate" data-ng-change="applyFilters()">
            <label for="toDate"><?php echo __('To date: ', 'srft-theme' ); ?></label><input type="date" id="toDate" data-ng-model="toDate" data-ng-change="applyFilters()">
            <label for="filterField"><?php echo __('Search:', 'srft-theme'); ?></label><input type="text" id="filterField" data-ng-model="filterField" placeholder= "<?php echo __('Search by keyword', 'srft-theme' ); ?>" data-ng-change="applyFilters()">
              <!-- Add a Reset button to clear filters -->
            <button type="button" data-ng-click="resetFilters()" >
            <?php echo __('Reset', 'srft-theme' ); ?>
            </button>
            </div>
            <div class="wrapper" style="padding: 0 3.2rem;">
              <div class="Rtable Rtable--5cols Rtable--collapse">
               <table>
                <caption class="sr-only"> Table shows lists of notifications for recruitments </caption>
                <thead>
                <tr class="Rtable-row Rtable-row--head">
                  <th class="Rtable-cell slno-cell column-heading"><?php echo __('SL.No.', 'srft-theme' ); ?></th>
                  <!--<div class="Rtable-cell id-cell column-heading"><?php echo __('Recruitment ID', 'srft-theme' ); ?></div>-->
                  <th class="Rtable-cell topic-cell column-heading"><?php echo __('Recruitment for', 'srft-theme' ); ?></th>
                  <th class="Rtable-cell date-cell column-heading"><?php echo __('Publish Date', 'srft-theme' ); ?></th>
                  <th class="Rtable-cell date-cell column-heading"><?php echo __('Submission Date', 'srft-theme' ); ?></th>
                  <th class="Rtable-cell date-cell column-heading"><?php echo __('Extended Submission Date', 'srft-theme' ); ?></th>
                  <th class="Rtable-cell access-link-cell column-heading"><?php echo __('Access Link', 'srft-theme' ); ?></th>
                </tr>
                </thead>
                <tbody>
                <tr class="Rtable-row" data-ng-repeat="vacancy in pagedVacancy">
                  <td class="Rtable-cell slno-cell">
                    <div class="Rtable-cell--content date-content"><span class="webinar-date">{{$index+1 }}</span></div>
                  </td>
                  
                  <td class="Rtable-cell topic-cell">
                    <div class="Rtable-cell--content title-content">{{ vacancy.title }}</div>
                  </td>
                  <td class="Rtable-cell date-cell">
                    <div class="Rtable-cell--content date-content"><span class="webinar-date">{{vacancy.pubdate | date:'dd-MM-yyyy' }}</span></div>
                  </td>
                  <td class="Rtable-cell date-cell">
                    <div class="Rtable-cell--content date-content"><span class="webinar-date">{{vacancy.subdate | date:'dd-MM-yyyy' }}</span></div>
                  </td>
                  <td class="Rtable-cell date-cell">
                    <div class="Rtable-cell--content date-content"><span class="webinar-date">{{vacancy.extsubdate | date:'dd-MM-yyyy' }}</span></div>
                  </td>
                  <td class="Rtable-cell access-link-cell">
                    <div class="Rtable-cell--content access-link-content"><a data-ng-href="{{vacancy.file.url}}"><!--<?php echo __('View', 'srft-theme' ); ?>--><img alt="pdf" style="vertical-align: middle;" class="pdf_icon" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pdf_icon_resized.png">&nbsp;(<?php echo __('Download', 'srft-theme'); ?> - {{vacancy.file.size}} MB)</a></div>
                  </td>
                </tr>
          </tbody>
          </table>
              </div>
              <!-- Use a CSS grid for layout -->
            </div>

            <!-- Pagination -->
             <nav aria-label="Pagination">
            <ul class="pagination">
  <li data-ng-class="{ 'disabled': currentPage === 1 }">
    <a href="#" aria-label="<?php echo __('First Page', 'srft-theme'); ?>" data-ng-click="firstPage()"><i class="fa fa-step-backward"  style="color: #8b5b2b;"></i></a>
  </li>
  <li data-ng-class="{ 'disabled': currentPage === 1 }">
    <a href="#" aria-label="<?php echo __('Previuos Page', 'srft-theme'); ?>" data-ng-click="prevPage()"><i class="fa fa-chevron-left"  style="color: #8b5b2b;"></i></a>
  </li>
  <li data-ng-repeat="page in getPageNumbers()" data-ng-class="{ 'active': currentPage === page }">
    <a href="#" data-ng-click="setPage(page)">{{ page }}</a>
  </li>
  <li data-ng-class="{ 'disabled': currentPage === totalPages }">
    <a href="#" aria-label="<?php echo __('Next Page', 'srft-theme'); ?>" data-ng-click="nextPage()"><i class="fa fa-chevron-right"  style="color: #8b5b2b;"></i></a>
  </li>
  <li data-ng-class="{ 'disabled': currentPage === totalPages }">
    <a href="#" aria-label="<?php echo __('Last Page', 'srft-theme'); ?>" data-ng-click="lastPage()"><i class="fa fa-step-forward"  style="color: #8b5b2b;"></i></a>
  </li>
</ul>
          </nav>
          </div>
        </div>
      </div>
    </section>
         
  <script>
    var categoryID = <?php echo json_encode($category_id); ?>;
     var siteURL = '<?php echo esc_url(site_url('/')); ?>';
    angular.module('myApp', [])
      .controller('VacancyController', function ($scope, $http, $filter) {
        // Initialize the tenderList
        $scope.vacancyList = [];
        $scope.filteredVacancy = [];
        $scope.pagedVacancy = [];
        $scope.filterField = '';
        $scope.fromDate = '';
        $scope.toDate = '';
        $scope.itemsPerPage = 10;
        $scope.currentPage = 1;
        
        function bytesToMB(bytes) {
       return (bytes / 1048576).toFixed(2); // Convert bytes to MB and format to 2 decimal places
       }
        var url = siteURL + 'wp-json/wp/v2/vacancy?categories=' + categoryID + '&per_page=100';
        //alert('Fetching data from URL:\n' + url); // Alert the URL before making the request


        // Fetch the data
        //$http.get(siteURL + 'wp-json/wp/v2/tender?categories='+categoryID+'&per_page=100')
        $http.get(url)
          .then(function (response) {
            $scope.vacancyList = response.data.map(function (post) {
              //console.log('Vacancy-Submission-Date:', Vacancy-LastDatee);
              var submissionDate = post.acf['Vacancy-LastDate'];
              var file = post.acf['Vacancy-Doc'];
              var postLink = post.link;
// Append the background image URL as a query parameter to the post link
              var backgroundImageUrl = '<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>';
              var linkWithImage = postLink + '?bg_image=' + encodeURIComponent(backgroundImageUrl);
      
              var pubdate= post.acf['Vacancy-Publish-Date'];
               console.log('Vacancy-Submission-Date:',submissionDate );
               console.log('Vacancy-Last Date:',submissionDate );
              //var submissionDate = submissionDateStr ? new Date(submissionDateStr.replace(/(\d+)\/(\d+)\/(\d+)/, '$2/$1/$3')) : null;
       
              //console.log('Vacancy-Publish-Date:', isSubmissionOpen);
              return {
                title: post.title.rendered || '',
                link: linkWithImage,
                ID: post.acf['Vacancy-ID'],
                subdate: post.acf['Vacancy-LastDate'],
                pubdate: post.acf['Vacancy-Publish-Date'],
                file: {
                url: post.acf['Vacancy-Doc']['url'],
                title: post.acf['Vacancy-Doc']['title'],
                size: bytesToMB(post.acf['Vacancy-Doc']['filesize']),
                type: post.acf['Vacancy-Doc']['subtype']
                    },
                extsubdate: post.acf['Vacancy-LastDateExtended'],
              };
            });
          // Sort the tenderList by publish date (newest to oldest)
      $scope.vacancyList.sort(function (a, b) {
      return new Date(b.pubdate) - new Date(a.pubdate);
    });

            // Apply initial filters and pagination
            updateFilteredVacancy();
          })
          .catch(function (error) {
            console.error('Error fetching tender data:', error);
          });

        // Function to update filtered tender based on filters
        function updateFilteredVacancy() {
          $scope.filteredVacancy = $scope.vacancyList.filter(function (vacancy) {
            const titleMatch = !$scope.filterField || vacancy.title.toLowerCase().includes($scope.filterField.toLowerCase());
            const fromDate = $scope.fromDate ? new Date($scope.fromDate) : null;
            const toDate = $scope.toDate ? new Date($scope.toDate) : null;
            const subdate = new Date(vacancy.subdate); // Convert to JavaScript Date object

            if (fromDate && toDate) {
              // Check if the subdate is within the selected date range
              return titleMatch && subdate >= fromDate && subdate <= toDate;
            } else {
              // No date range selected, only check title
              return titleMatch;
            }
          });

          // Reset pagination to the first page
          $scope.currentPage = 1;

          // Update pagedTender based on currentPage and itemsPerPage
          $scope.updatePagedVacancy();
        }

        // Function to apply filters when input changes
        $scope.applyFilters = function () {
          updateFilteredVacancy();
        };

        // Function to reset filters
        $scope.resetFilters = function () {
          // Clear all filter fields and apply filters again to show all posts
          $scope.filterField = '';
          $scope.fromDate = '';
          $scope.toDate = '';
          updateFilteredVacancy();
        };

        // Function to update pagedTender based on currentPage and itemsPerPage
        $scope.updatePagedVacancy = function () {
          const startIndex = ($scope.currentPage - 1) * $scope.itemsPerPage;
          const endIndex = startIndex + $scope.itemsPerPage;
          $scope.pagedVacancy = $scope.filteredVacancy.slice(startIndex, endIndex);
        };

        // Function to get the total number of pages
        $scope.getTotalPages = function () {
          return Math.ceil($scope.filteredVacancy.length / $scope.itemsPerPage);
        };

        // Function to generate an array of page numbers for pagination
        $scope.getPageNumbers = function () {
          const pageCount = $scope.getTotalPages();
          return new Array(pageCount).fill().map((_, i) => i + 1);
        };

        // Function to set the current page
        $scope.setPage = function (page) {
          if (page >= 1 && page <= $scope.getTotalPages()) {
            $scope.currentPage = page;
            $scope.updatePagedVacancy();
          }
        };

        // Function to go to the previous page
        $scope.prevPage = function () {
          if ($scope.currentPage > 1) {
            $scope.currentPage--;
            $scope.updatePagedVacancy();
          }
        };

        // Function to go to the next page
        $scope.nextPage = function () {
          if ($scope.currentPage < $scope.getTotalPages()) {
            $scope.currentPage++;
            $scope.updatePagedVacancy();
          }
        };

        $scope.firstPage = function () {
  $scope.currentPage = 1;
  $scope.updatePagedVacancy();
};

$scope.lastPage = function () {
  $scope.currentPage = $scope.getTotalPages();
  $scope.updatePagedVacancy();
};
        // Initialize pagedTender
        
      });
  </script>
  
<?php get_footer(); ?>
    
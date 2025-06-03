<?php
/*
Template Name: Tender

 */

get_header(); 

function get_category_ID( $cat_name ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
	$cat = get_term_by( 'name', $cat_name, 'category' );

	if ( $cat ) {
		return $cat->term_id;
	}

	return 0;
}

$category_name = 'tender'; // Ensure this matches the exact category name.
$category_id = get_category_ID($category_name);
?>




  <main>
<section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
    <div class="page-banner">
        <h2 class="page-banner-title"><?php echo __('Tender', 'srft-theme' ); ?></h2>
    </div>
</section>

    
    <section id="skip-to-content" class="section-home">
      <div class="container" style="padding: 0 3.2rem
32px;">
      <div style="padding: 0 3.2rem;">      
        <?php
            if ( function_exists('yoast_breadcrumb') ) {
          yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
        }
        ?>
    </div>      
        <h2 class="page-header-text" style="padding-bottom: 20px; text-align: center;"><?php echo __('Tender List', 'srft-theme' ); ?></h2>
        <div data-ng-app="myApp">
          <div data-ng-controller="TenderController">
            <p style="padding: 0 3.2rem;">
            <label for="fromDate"><?php echo __('From date: ', 'srft-theme' ); ?></label> <input type="date" id="fromDate" data-ng-model="fromDate" data-ng-change="applyFilters()">
            <label for="toDate"><?php echo __('To date: ', 'srft-theme' ); ?></label> <input type="date" id="toDate" data-ng-model="toDate" data-ng-change="applyFilters()">
            <label for="filterField"><?php echo __('Search:', 'srft-theme'); ?></label><input type="text" id="filterField" data-ng-model="filterField" placeholder="<?php echo __('Search by keyword', 'srft-theme'); ?>" data-ng-change="applyFilters()">
              <!-- Add a Reset button to clear filters -->
              <button data-ng-click="resetFilters()"><?php echo __('Reset', 'srft-theme' ); ?></button>
            </p>
            
            <div class="wrapper" style="padding: 0 3.2rem;">
              <div class="Rtable Rtable--7cols Rtable--collapse">
                <div class="Rtable-row Rtable-row--head">
                  <div class="Rtable-cell location-cell column-heading"><?php echo __('SL.No.', 'srft-theme' ); ?></div>
                  <div class="Rtable-cell id-cell column-heading"><?php echo __('Tender ID', 'srft-theme' ); ?></div>
                  <div class="Rtable-cell name-cell column-heading"><?php echo __('Tender Title', 'srft-theme' ); ?></div>
                  <div class="Rtable-cell tenure-cell column-heading"><?php echo __('Publish Date', 'srft-theme' ); ?></div>
                  <div class="Rtable-cell tenure-cell column-heading"><?php echo __('Due Date', 'srft-theme' ); ?></div>
                  <div class="Rtable-cell access-link-cell column-heading"><?php echo __('Access Link', 'srft-theme' ); ?></div>
                  <div class="Rtable-cell location-cell column-heading"><?php echo __('Tender Status', 'srft-theme' ); ?></div>
                </div>

                <div class="Rtable-row" data-ng-repeat="tender in pagedTender">
                  <div class="Rtable-cell location-cell">
                    <div class="Rtable-cell--content date-content"><span class="SL">{{$index+1 }}</span></div>
                  </div>
                  <div class="Rtable-cell id-cell">
                    <div class="Rtable-cell--content">{{ tender.ID }}</div>
                  </div>
                  <div class="Rtable-cell name-cell">
                    
                    <div class="Rtable-cell--content">{{ tender.title }}</div>
                  </div>
                  <div class="Rtable-cell tenure-cell">
                    <div class="Rtable-cell--content "><span class="webinar-date">{{tender.pubdate }}</span></div>
                  </div>
                  <div class="Rtable-cell tenure-cell">
                    <div class="Rtable-cell--content "><span class="webinar-date">{{tender.subdate }}</span></div>
                  </div>
                  <div class="Rtable-cell access-link-cell">
                    
                    <div class="Rtable-cell--content access-link-content"><a data-ng-href="{{tender.file.url}}"><!--<?php echo __('View', 'srft-theme' ); ?>--><img alt="pdf" style="vertical-align: middle;" class="pdf_icon" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pdf_icon_resized.png">&nbsp; (<span><?php echo __('Download', 'srft-theme'); ?> - {{tender.file.size}} MB)</span></a></div>
                  </div>
                  <div class="Rtable-cell location-cell">
                  <div class="Rtable-cell--content access-link-content">
                  <p data-ng-if="tender.isSubmissionOpen"><?php echo __('Open', 'srft-theme' ); ?></p>
  <p data-ng-if="!tender.isSubmissionOpen"><?php echo __('Closed', 'srft-theme' ); ?></p>
                    
                  <div>
  
</div>
</div>
                  </div>
                </div>
              </div>
              <!-- Use a CSS grid for layout -->
            </div>

            <!-- Pagination -->
            <ul class="pagination">
  <li data-ng-class="{ 'disabled': currentPage === 1 }">
    <a href="#" data-ng-click="firstPage()" aria-label="<?php echo __('First Page', 'srft-theme'); ?>"><i class="fa fa-step-backward" style="color: #8b5b2b;"></i></a>
  </li>
  <li data-ng-class="{ 'disabled': currentPage === 1 }">
    <a href="#" data-ng-click="prevPage()" aria-label="<?php echo __('Previous Page', 'srft-theme'); ?>"><i class="fa fa-chevron-left" style="color: #8b5b2b;"></i></a>
  </li>
  <li data-ng-repeat="page in getPageNumbers()" data-ng-class="{ 'active': currentPage === page }">
    <a href="#" data-ng-click="setPage(page)">{{ page }}</a>
  </li>
  <li data-ng-class="{ 'disabled': currentPage === totalPages }">
    <a href="#" data-ng-click="nextPage()" aria-label="<?php echo __('Next Page', 'srft-theme'); ?>"><i class="fa fa-chevron-right" style="color: #8b5b2b;"></i></a>
  </li>
  <li data-ng-class="{ 'disabled': currentPage === totalPages }">
    <a href="#" data-ng-click="lastPage()" aria-label="<?php echo __('Last Page', 'srft-theme'); ?>"><i class="fa fa-step-forward" style="color: #8b5b2b;"></i></a>
  </li>
</ul>

          </div>
        </div>
      </div>
    </section>
  
  <script>
     var categoryID = <?php echo json_encode($category_id); ?>;
     var siteURL = '<?php echo esc_url(site_url('/')); ?>';
      angular.module('myApp', [])
      .controller('TenderController', function ($scope, $http, $filter) {
        // Initialize the tenderList
        $scope.tenderList = [];
        $scope.filteredTender = [];
        $scope.pagedTender = [];
        $scope.filterField = '';
        $scope.fromDate = '';
        $scope.toDate = '';
        $scope.itemsPerPage = 20;
        $scope.currentPage = 1;
        $scope.currentDate = new Date();
         // Function to convert bytes to megabytes
    function bytesToMB(bytes) {
      return (bytes / 1048576).toFixed(2); // Convert bytes to MB and format to 2 decimal places
    }
    
         // Function to parse dd/mm/yyyy date format
       function parseDate(dateString) {
      var parts = dateString.split('/');
      // Note: JavaScript months are 0-based, so subtract 1 from the month.
      return new Date(parts[2], parts[1] - 1, parts[0]);
    }
        
        // Fetch the data
        $http.get(siteURL + 'wp-json/wp/v2/tender?categories=' + categoryID + '&per_page=100')
  .then(function (response) {
    // Sort the data by publish date (newest to oldest)
  // Sort the data by ACF publish date (newest to oldest)
  var sortedData = response.data.sort(function (a, b) {
          return parseDate(b.acf['Tender-Publish-Date']) - parseDate(a.acf['Tender-Publish-Date']);
        });

    $scope.tenderList =  sortedData.map(function (post) {
      var publishDate= post.acf['Tender-Publish-Date'];
      var submissionDate = post.acf['Tender-Submission-Date'];
      var isSubmissionOpen = parseDate(submissionDate) > $scope.currentDate;
      var postLink = post.link;
// Append the background image URL as a query parameter to the post link
      var backgroundImageUrl = '<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>';
      var linkWithImage = postLink + '?bg_image=' + encodeURIComponent(backgroundImageUrl);
      console.log('Publish Date', publishDate, 'Submission Date:', submissionDate, 'Current Date:', $scope.currentDate, 'Is Submission Open:', isSubmissionOpen);
      return {
        title: post.title.rendered || '',
        link: linkWithImage,
        ID: post.acf['Tender-ID'],
        subdate: submissionDate, // Use the parsed submission date
        isSubmissionOpen: isSubmissionOpen,
        //file: post.acf['Tender-Doc'],
        file: {
            url: post.acf['Tender-Doc']['url'],
            title: post.acf['Tender-Doc']['title'],
            size: bytesToMB(post.acf['Tender-Doc']['filesize']),
            type: post.acf['Tender-Doc']['subtype']
          },
        pubdate: post.acf['Tender-Publish-Date'],
      };
    });
 
    // Apply initial filters and pagination
    updateFilteredTender();
  })
  .catch(function (error) {
    console.error('Error fetching tender data:', error);
  });

        // Function to update filtered tender based on filters
        function updateFilteredTender() {
          $scope.filteredTender = $scope.tenderList.filter(function (tender) {
            const titleMatch = !$scope.filterField || tender.title.toLowerCase().includes($scope.filterField.toLowerCase());
            const fromDate = $scope.fromDate ? new Date($scope.fromDate) : null;
            const toDate = $scope.toDate ? new Date($scope.toDate) : null;
            const subdate = new Date(tender.subdate); // Convert to JavaScript Date object

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
          $scope.updatePagedTender();
        }

        // Function to apply filters when input changes
        $scope.applyFilters = function () {
          updateFilteredTender();
        };

        // Function to reset filters
        $scope.resetFilters = function () {
          // Clear all filter fields and apply filters again to show all posts
          $scope.filterField = '';
          $scope.fromDate = '';
          $scope.toDate = '';
          updateFilteredTender();
        };

        // Function to update pagedTender based on currentPage and itemsPerPage
        $scope.updatePagedTender = function () {
          const startIndex = ($scope.currentPage - 1) * $scope.itemsPerPage;
          const endIndex = startIndex + $scope.itemsPerPage;
          $scope.pagedTender = $scope.filteredTender.slice(startIndex, endIndex);
        };

        // Function to get the total number of pages
        $scope.getTotalPages = function () {
          return Math.ceil($scope.filteredTender.length / $scope.itemsPerPage);
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
            $scope.updatePagedTender();
          }
        };

        // Function to go to the previous page
        $scope.prevPage = function () {
          if ($scope.currentPage > 1) {
            $scope.currentPage--;
            $scope.updatePagedTender();
          }
        };

        // Function to go to the next page
        $scope.nextPage = function () {
          if ($scope.currentPage < $scope.getTotalPages()) {
            $scope.currentPage++;
            $scope.updatePagedTender();
          }
        };

        $scope.firstPage = function () {
  $scope.currentPage = 1;
  $scope.updatePagedTender();
};

$scope.lastPage = function () {
  $scope.currentPage = $scope.getTotalPages();
  $scope.updatePagedTender();
};
        // Initialize pagedTender
        
      });
  </script>
<?php get_footer(); ?>
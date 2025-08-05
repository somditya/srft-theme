<?php 
/*
Template Name: Announcement List
*/
get_header(); 

function get_category_ID( $cat_name ) { 
    $cat = get_term_by( 'name', $cat_name, 'category' );

    if ( $cat ) {
        return $cat->term_id;
    }

    return 0;
}

$category_name = 'announcement'; // Ensure this matches the exact category name.
$category_id = get_category_ID($category_name);
?>



  <main>
    <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
      <div class="page-banner">
        <h2 class="page-banner-title"><?php echo __('Circular & Notices', 'srft-theme'); ?></h2>
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
      <div class="container" style="width: 1170px;">
        <h2 class="page-header-text" style="padding-left: 0; text-align: center;"><?php echo __('Circular & Notices', 'srft-theme'); ?></h2>

        <div data-ng-app="myApp">
          <div data-ng-controller="AnnouncementController">
            <p style="padding: 15px;">
              <label for="fromDate"><?php echo __('From date: ', 'srft-theme'); ?></label>
              <input type="date" id="fromDate" data-ng-model="fromDate" data-ng-change="applyFilters()">
              
              <label for="toDate"><?php echo __('To date: ', 'srft-theme'); ?></label>
              <input type="date" id="toDate" data-ng-model="toDate" data-ng-change="applyFilters()">
              
              <label for="filterField"><?php echo __('Search:', 'srft-theme'); ?></label>
              <input type="text" id="filterField" data-ng-model="filterField" placeholder="<?php echo __('Search by keyword', 'srft-theme'); ?>" data-ng-change="applyFilters()">
              
              <!-- Add a Reset button to clear filters -->
              <button data-ng-click="resetFilters()"><?php echo __('Reset', 'srft-theme'); ?></button>
            </p>

            <div class="wrapper">
              <div class="Rtable Rtable--7cols Rtable--collapse">
                <div class="Rtable-row Rtable-row--head">
                  <div class="Rtable-cell location-cell column-heading"><?php echo __('SL.No.', 'srft-theme'); ?></div>
                  <div class="Rtable-cell name-cell column-heading"><?php echo __('Title', 'srft-theme'); ?></div>
                  <div class="Rtable-cell tenure-cell column-heading"><?php echo __('Publish Date', 'srft-theme'); ?></div>
                  <div class="Rtable-cell access-link-cell column-heading"><?php echo __('Access Link', 'srft-theme'); ?></div>
                </div>

                <div class="Rtable-row" data-ng-repeat="announcement in pagedAnnouncement">
                  <div class="Rtable-cell location-cell">
                    <div class="Rtable-cell--content date-content"><span class="SL">{{$index + 1}}</span></div>
                  </div>
                  <div class="Rtable-cell name-cell">
                    <div class="Rtable-cell--content">{{ announcement.title }}</div>
                  </div>
                  <div class="Rtable-cell tenure-cell">
                    <div class="Rtable-cell--content "><span class="webinar-date">{{ announcement.pubdate }}</span></div>
                  </div>
                  <div class="Rtable-cell access-link-cell">
                    <div class="Rtable-cell--content access-link-content" data-ng-if="announcement.file.url">
                      <!-- Show the PDF image and link when the file exists -->
                      <a data-ng-href="{{announcement.file.url}}">
                        <img alt="pdf" class="pdf_icon" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pdf_icon_resized.png" style="vertical-align: middle;">
                        <span>(<?php echo __('Download', 'srft-theme'); ?> - {{ announcement.file.size }} MB)</span>
                      </a>
                    </div>
                    <div data-ng-if="!announcement.file.url">
                      <!-- Show only the link to the post when no PDF file exists -->
                      <a data-ng-href="{{announcement.link}}"><?php echo __('View', 'srft-theme'); ?></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pagination -->
            <ul class="pagination">
              <li data-ng-class="{ 'disabled': currentPage === 1 }">
                <a href="#" data-ng-click="firstPage()" aria-label="<?php echo __('First Page', 'srft-theme'); ?>">
                  <i class="fa fa-step-backward" style="color: #8b5b2b;"></i>
                </a>
              </li>
              <li data-ng-class="{ 'disabled': currentPage === 1 }">
                <a href="#" data-ng-click="prevPage()" aria-label="<?php echo __('Previous Page', 'srft-theme'); ?>">
                  <i class="fa fa-chevron-left" style="color: #8b5b2b;"></i>
                </a>
              </li>
              <li data-ng-repeat="page in pageNumbers" data-ng-class="{ 'active': currentPage === page }">
                <a href="#" data-ng-click="setPage(page)">{{ page }}</a>
              </li>
              <li data-ng-class="{ 'disabled': currentPage === totalPages }">
                <a data-ng-href="#" data-ng-click="nextPage()" aria-label="<?php echo __('Next Page', 'srft-theme'); ?>">
                  <i class="fa fa-chevron-right" style="color: #8b5b2b;"></i>
                </a>
              </li>
              <li data-ng-class="{ 'disabled': currentPage === totalPages }">
                <a href="#" data-ng-click="lastPage()" aria-label="<?php echo __('Last Page', 'srft-theme'); ?>">
                  <i class="fa fa-step-forward" style="color: #8b5b2b;"></i>
                </a>
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
      .controller('AnnouncementController', function ($scope, $http, $filter) {
        // Initialize the announcement list
        $scope.announcementList = [];
        $scope.filteredAnnouncement = [];
        $scope.pagedAnnouncement = [];
        $scope.filterField = '';
        $scope.fromDate = '';
        $scope.toDate = '';
        $scope.itemsPerPage = 20;
        $scope.currentPage = 1;
        $scope.currentDate = new Date();

        // Function to convert bytes to megabytes
        function bytesToMB(bytes) {
          return (bytes / 1048576).toFixed(2);
        }

        // Function to parse dd/mm/yyyy date format
        function parseDate(dateString) {
          var parts = dateString.split('/');
          return new Date(parts[2], parts[1] - 1, parts[0]);
        }

        // Fetch the data
        $http.get(siteURL + 'wp-json/wp/v2/announcement?categories=' + categoryID + '&per_page=100')
          .then(function (response) {
            console.log('API Response:', response.data);
            var sortedData = response.data.sort(function (a, b) {
              return parseDate(b.acf['Announcement-Publish-Date']) - parseDate(a.acf['Announcement-Publish-Date']);
            });

            $scope.announcementList = sortedData.map(function (post) {
              var publishDate = post.acf['Announcement-Publish-Date'];
              var linkWithImage = post.link + '?bg_image=' + encodeURIComponent('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');

              return {
                title: post.title.rendered || '',
                link: linkWithImage,
                file: {
                  url: post.acf['Announcement-Doc']['url'],
                  title: post.acf['Announcement-Doc']['title'],
                  size: bytesToMB(post.acf['Announcement-Doc']['filesize']),
                  type: post.acf['Announcement-Doc']['subtype']
                },
                pubdate: post.acf['Announcement-Publish-Date'],
              };
            });

            // Apply initial filters and pagination
            console.log('Announcement List:', $scope.announcementList);
            updateFilteredAnnouncement();
          })
          .catch(function (error) {
            console.error('Error fetching announcement data:', error);
          });

        // Function to update filtered announcements
        function updateFilteredAnnouncement() {
          $scope.filteredAnnouncement = $scope.announcementList.filter(function (announcement) {
            const titleMatch = !$scope.filterField || announcement.title.toLowerCase().includes($scope.filterField.toLowerCase());
            const fromDate = $scope.fromDate ? new Date($scope.fromDate) : null;
            const toDate = $scope.toDate ? new Date($scope.toDate) : null;
            const subdate = new Date(announcement.pubdate);

            if (fromDate && toDate) {
              return titleMatch && subdate >= fromDate && subdate <= toDate;
            } else {
              return titleMatch;
            }
          });

          // Reset pagination
          $scope.currentPage = 1;
          $scope.pageNumbers = getPageNumbers();
          $scope.updatePagedAnnouncement();
        }

        // Function to update paged announcement list
        $scope.updatePagedAnnouncement = function () {
          var start = ($scope.currentPage - 1) * $scope.itemsPerPage;
          var end = $scope.currentPage * $scope.itemsPerPage;
          $scope.pagedAnnouncement = $scope.filteredAnnouncement.slice(start, end);
        };

        // Function to get the page numbers for pagination
        $scope.getPageNumbers = function () {
          var pageNumbers = [];
          var totalPages = Math.ceil($scope.filteredAnnouncement.length / $scope.itemsPerPage);
          for (var i = 1; i <= totalPages; i++) {
            pageNumbers.push(i);
          }
          return pageNumbers;
        };

        // Watch for changes in the filtered announcement length
        $scope.$watch('filteredAnnouncement.length', function () {
          $scope.totalPages = Math.ceil($scope.filteredAnnouncement.length / $scope.itemsPerPage);
          $scope.updatePagedAnnouncement();
          $scope.pageNumbers = $scope.getPageNumbers();
        });

        // Set the current page to a specific page
        $scope.setPage = function (page) {
          $scope.currentPage = page;
          $scope.updatePagedAnnouncement();
        };

        // Previous and next page
        $scope.prevPage = function () {
          if ($scope.currentPage > 1) {
            $scope.currentPage--;
            $scope.updatePagedAnnouncement();
          }
        };

        $scope.nextPage = function () {
          if ($scope.currentPage < $scope.totalPages) {
            $scope.currentPage++;
            $scope.updatePagedAnnouncement();
          }
        };

        // First and last page
        $scope.firstPage = function () {
          $scope.currentPage = 1;
          $scope.updatePagedAnnouncement();
        };

        $scope.lastPage = function () {
          $scope.currentPage = $scope.totalPages;
          $scope.updatePagedAnnouncement();
        };

        // Apply the filters
        $scope.applyFilters = function () {
          updateFilteredAnnouncement();
        };

        // Reset the filters
        $scope.resetFilters = function () {
          $scope.filterField = '';
          $scope.fromDate = '';
          $scope.toDate = '';
          updateFilteredAnnouncement();
        };
      });
  </script>
  <?php get_footer(); ?>


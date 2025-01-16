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

<body ng-controller="AnnouncementController">

  <main>
    <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
      <div class="page-banner">
        <div class="page-banner-title"><?php echo __('Announcements', 'srft-theme'); ?></div>
      </div>
    </section>

    <section id="skip-to-content" class="section-home">
      <div class="container" style="width: 1170px;">
        <div>
          <?php
            if ( function_exists('yoast_breadcrumb') ) {
              yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
            }
          ?>
        </div>

        <h2 class="page-header-text" style="padding-left: 0; text-align: center;"><?php echo __('Announcement List', 'srft-theme'); ?></h2>

        <div ng-app="myApp">
          <div ng-controller="AnnouncementController">
            <p style="padding: 15px;">
              <label for="fromDate"><?php echo __('From date: ', 'srft-theme'); ?></label>
              <input type="date" id="fromDate" ng-model="fromDate" ng-change="applyFilters()">
              
              <label for="toDate"><?php echo __('To date: ', 'srft-theme'); ?></label>
              <input type="date" id="toDate" ng-model="toDate" ng-change="applyFilters()">
              
              <label for="filterField">
                <input type="text" id="filterField" ng-model="filterField" placeholder="Search by keyword" ng-change="applyFilters()">
              </label>
              
              <!-- Add a Reset button to clear filters -->
              <button ng-click="resetFilters()"><?php echo __('Reset: ', 'srft-theme'); ?></button>
            </p>

            <div class="wrapper">
              <div class="Rtable Rtable--7cols Rtable--collapse">
                <div class="Rtable-row Rtable-row--head">
                  <div class="Rtable-cell location-cell column-heading"><?php echo __('SL.No.', 'srft-theme'); ?></div>
                  <div class="Rtable-cell name-cell column-heading"><?php echo __('Announcement Title', 'srft-theme'); ?></div>
                  <div class="Rtable-cell tenure-cell column-heading"><?php echo __('Publish Date', 'srft-theme'); ?></div>
                  <div class="Rtable-cell access-link-cell column-heading"><?php echo __('Access Link', 'srft-theme'); ?></div>
                </div>

                <div class="Rtable-row" ng-repeat="announcement in pagedAnnouncement">
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
  <div class="Rtable-cell--content access-link-content" ng-if="announcement.file.url">
    <!-- Show the PDF image and link when the file exists -->
    <a href="{{announcement.file.url}}">
      <img alt="pdf" class="pdf_icon" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pdf_icon_resized.png">
      <span>(<?php echo __('Download', 'srft-theme'); ?> - {{ announcement.file.size }} MB)</span>
    </a>
  </div>
  <div ng-if="!announcement.file.url">
    <!-- Show only the link to the post when no PDF file exists -->
    <a href="{{announcement.link}}"><?php echo __('View', 'srft-theme'); ?></a>
  </div>
</div>

                  </div>
                </div>
              </div>
            </div>

            <!-- Pagination -->
            <ul class="pagination">
              <li ng-class="{ 'disabled': currentPage === 1 }">
                <a href="#" ng-click="firstPage()" aria-label="<?php echo __('First Page', 'srft-theme'); ?>">
                  <i class="fa fa-step-backward" style="color: #8b5b2b;"></i>
                </a>
              </li>
              <li ng-class="{ 'disabled': currentPage === 1 }">
                <a href="#" ng-click="prevPage()" aria-label="<?php echo __('Previous Page', 'srft-theme'); ?>">
                  <i class="fa fa-chevron-left" style="color: #8b5b2b;"></i>
                </a>
              </li>
              <li ng-repeat="page in getPageNumbers()" ng-class="{ 'active': currentPage === page }">
                <a href="#" ng-click="setPage(page)">{{ page }}</a>
              </li>
              <li ng-class="{ 'disabled': currentPage === totalPages }">
                <a href="#" ng-click="nextPage()" aria-label="<?php echo __('Next Page', 'srft-theme'); ?>">
                  <i class="fa fa-chevron-right" style="color: #8b5b2b;"></i>
                </a>
              </li>
              <li ng-class="{ 'disabled': currentPage === totalPages }">
                <a href="#" ng-click="lastPage()" aria-label="<?php echo __('Last Page', 'srft-theme'); ?>">
                  <i class="fa fa-step-forward" style="color: #8b5b2b;"></i>
                </a>
              </li>
            </ul>

          </div>
        </div>
      </div>
    </section>
  </main>

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
          $scope.updatePagedAnnouncement();
        }

        // Function to apply filters when input changes
        $scope.applyFilters = function () {
          updateFilteredAnnouncement();
        };

        // Function to reset filters
        $scope.resetFilters = function () {
          $scope.filterField = '';
          $scope.fromDate = '';
          $scope.toDate = '';
          updateFilteredAnnouncement();
        };

        // Function to update paged announcements
        $scope.updatePagedAnnouncement = function () {
          const startIndex = ($scope.currentPage - 1) * $scope.itemsPerPage;
          $scope.pagedAnnouncement = $scope.filteredAnnouncement.slice(startIndex, startIndex + $scope.itemsPerPage);
        };

        // Pagination methods
        $scope.setPage = function (page) {
          $scope.currentPage = page;
          $scope.updatePagedAnnouncement();
        };

        $scope.firstPage = function () {
          $scope.currentPage = 1;
          $scope.updatePagedAnnouncement();
        };

        $scope.lastPage = function () {
          $scope.currentPage = $scope.totalPages;
          $scope.updatePagedAnnouncement();
        };

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

        // Function to get pagination numbers
        $scope.getPageNumbers = function () {
          var totalPages = Math.ceil($scope.filteredAnnouncement.length / $scope.itemsPerPage);
          var pageNumbers = [];
          for (var i = 1; i <= totalPages; i++) {
            pageNumbers.push(i);
          }
          return pageNumbers;
        };

        // Watch for changes in filtered announcements and update pagination
        $scope.$watch('filteredAnnouncement.length', function () {
          $scope.totalPages = Math.ceil($scope.filteredAnnouncement.length / $scope.itemsPerPage);
          $scope.updatePagedAnnouncement();
        });

      });
  </script>
</body>

<?php get_footer(); ?>

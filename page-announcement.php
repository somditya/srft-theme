<?php
/*
Template Name: Announcement List
*/
get_header();

/*
 * Get category ID
 */
function get_category_ID( $cat_name ) {
    $cat = get_term_by( 'name', $cat_name, 'category' );
    return $cat ? $cat->term_id : 0;
}

$category_name = 'announcement';
$category_id   = get_category_ID( $category_name );
?>

<main>

  <!-- Page Banner -->
  <section
    class="cine-header"
    style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'large' ) ); ?>');"
  >
    <div class="page-banner">
      <h1 class="page-banner-title" style="margin-top:10px;">
        <?php echo esc_html__( 'Circular & Notices', 'srft-theme' ); ?>
      </h1>
    </div>
  </section>

  <!-- Breadcrumb -->
  <div class="container-aligned">
    <div class="breadcrumbs-wrapper">
      <?php
      if ( function_exists( 'yoast_breadcrumb' ) ) {
          yoast_breadcrumb(
              '<nav aria-label="breadcrumbs" id="breadcrumbs">',
              '</nav>'
          );
      }
      ?>
    </div>
  </div>

  <!-- Main Content -->
  <section id="skip-to-content" class="section-home">

    <div class="container" style="padding: 0 3.2rem 32px;">

      <h2
        class="page-header-text"
        style="padding-bottom:20px; text-align:center;"
      >
        <?php echo esc_html__( 'List of Circular & Notices', 'srft-theme' ); ?>
      </h2>

      <!-- AngularJS Application -->
      <div data-ng-app="myApp">

        <div data-ng-controller="AnnouncementController">

          <!-- Filter Bar -->
          <div class="filter-bar">

            <label for="fromDate">
              <?php echo esc_html__( 'From date: ', 'srft-theme' ); ?>
            </label>

            <input
              type="date"
              id="fromDate"
              data-ng-model="fromDate"
              data-ng-change="applyFilters()"
            >

            <label for="toDate">
              <?php echo esc_html__( 'To date: ', 'srft-theme' ); ?>
            </label>

            <input
              type="date"
              id="toDate"
              data-ng-model="toDate"
              data-ng-change="applyFilters()"
            >

            <label for="filterField">
              <?php echo esc_html__( 'Search:', 'srft-theme' ); ?>
            </label>

            <input
              type="text"
              id="filterField"
              aria-describedby="searchInstruction"
              data-ng-model="filterField"
              placeholder="<?php echo esc_attr__( 'Search by keyword', 'srft-theme' ); ?>"
              data-ng-change="applyFilters()"
            >

            <button
              type="button"
              data-ng-click="resetFilters()"
            >
              <?php echo esc_html__( 'Reset', 'srft-theme' ); ?>
            </button>

          </div>

          <!-- Search instruction -->
          <p id="searchInstruction" class="sr-only">
            <?php
            echo esc_html__(
                'Results update automatically as you type.',
                'srft-theme'
            );
            ?>
          </p>

          <!-- Live search status -->
          <div
            class="sr-only"
            aria-live="polite"
            aria-atomic="true"
            role="status"
            id="searchStatus"
          ></div>

          <!-- Loading -->
          <p data-ng-if="isLoading">
            <?php echo esc_html__( 'Loading circulars and notices…', 'srft-theme' ); ?>
          </p>

          <!-- Error -->
          <p
            data-ng-if="loadError"
            style="color:#b00020;"
          >
            <?php
            echo esc_html__(
                'Failed to load circulars and notices. Please try again later.',
                'srft-theme'
            );
            ?>
          </p>

          <!-- Results -->
          <div
            class="wrapper"
            style="padding: 0 3.2rem;"
            data-ng-if="!isLoading && !loadError"
          >

            <div class="table-container">

              <table>

                <caption class="sr-only">
                  <?php
                  echo esc_html__(
                      'Table showing list of circulars and notices',
                      'srft-theme'
                  );
                  ?>
                </caption>

                <thead>

                  <tr class="Rtable-row Rtable-row--head">

                    <th
                      class="Rtable-cell cell-width-10-percent column-heading"
                      scope="col"
                    >
                      <?php echo esc_html__( 'SL.No.', 'srft-theme' ); ?>
                    </th>

                    <th
                      class="Rtable-cell cell-width-40-percent column-heading"
                      scope="col"
                    >
                      <?php echo esc_html__( 'Title', 'srft-theme' ); ?>
                    </th>

                    <th
                      class="Rtable-cell cell-width-20-percent column-heading"
                      scope="col"
                    >
                      <?php echo esc_html__( 'Publish Date', 'srft-theme' ); ?>
                    </th>

                    <th
                      class="Rtable-cell cell-width-30-percent column-heading"
                      scope="col"
                    >
                      <?php echo esc_html__( 'Access Link', 'srft-theme' ); ?>
                    </th>

                  </tr>

                </thead>

                <tbody>

                  <tr
                    class="Rtable-row"
                    data-ng-repeat="announcement in pagedAnnouncement track by $index"
                  >

                    <!-- Serial Number -->
                    <td class="Rtable-cell cell-width-10-percent">

                      <div class="Rtable-cell--content">

                        <span class="webinar-date">
                          {{ (($parent.currentPage - 1) * itemsPerPage) + $index + 1 }}
                        </span>

                      </div>

                    </td>

                    <!-- Title -->
                    <th
                      class="Rtable-cell cell-width-40-percent"
                      scope="row"
                    >

                      <div class="Rtable-cell--content">
                        {{ announcement.title }}
                      </div>

                    </th>

                    <!-- Publish Date -->
                    <td class="Rtable-cell cell-width-20-percent">

                      <div class="Rtable-cell--content">

                        <span class="webinar-date">

                          <time
                            datetime="{{ announcement.pubdate | date:'yyyy-MM-dd' }}"
                            data-ng-if="announcement.pubdate"
                          >
                            {{ announcement.pubdate | date:'dd/MM/yyyy' }}
                          </time>

                          <span data-ng-if="!announcement.pubdate">
                            —
                          </span>

                        </span>

                      </div>

                    </td>

                    <!-- Access Link -->
                    <td class="Rtable-cell cell-width-30-percent">

                      <!-- PDF available -->
                      <div
                        class="Rtable-cell--content access-link-content"
                        data-ng-if="announcement.file && announcement.file.url"                       >

                       <a
    data-ng-href="{{ announcement.file.url }}"
    target="_blank"
    rel="noopener"
    aria-label="<?php echo esc_attr__( 'Download document', 'srft-theme' ); ?>"
>
   <span class="tooltip-box">
    <svg
        xmlns="http://www.w3.org/2000/svg"
        width="18"
        height="18"
        viewBox="0 0 68 68"
        fill="none"
        aria-hidden="true"
        focusable="false"
    >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M15.13 47.8714C12.7254 46.6379 9.88617 46.145 7.0975 46.4771H0V67.9281H5.6525V59.741H8.075C10.5846 59.9579 13.1063 59.4402 15.215 58.2752C17.0049 56.9837 17.9917 55.0731 17.8925 53.0912C18.025 51.0785 16.9966 49.1354 15.13 47.8714ZM10.5825 55.701C9.51486 56.0964 8.34103 56.2445 7.1825 56.1301H5.525V50.0523H7.1825C8.38607 49.9447 9.6003 50.144 10.6675 50.6243C11.6614 51.2066 12.2246 52.1813 12.155 53.1984C12.2838 54.2239 11.6623 55.213 10.5825 55.701ZM30.0475 46.4771H22.9925V67.9281H29.75C33.1938 68.2116 36.6618 67.653 39.7375 66.3193C43.1218 64.1975 44.9299 60.7346 44.4975 57.2026C44.7508 54.1767 43.4692 51.2021 40.97 49.0155C37.8829 46.9686 33.9459 46.0537 30.0475 46.4771ZM35.6575 63.0659C33.8869 63.9031 31.8595 64.2766 29.835 64.1384H28.73V50.2668H29.75C33.32 50.2668 34.7225 50.5528 36.125 51.6254C37.8271 53.1161 38.7062 55.1399 38.5475 57.2026C38.7661 59.4349 37.6898 61.6187 35.6575 63.0659ZM50.7025 67.9281H56.44V58.9544H68V55.1648H56.44V50.2668H68V46.4771H50.7025V67.9281ZM46.75 0H0V39.3268H8.5V32.1765V28.4226V7.15033H43.2225L59.5 20.8432V28.4226V32.1765V39.3268H68V17.8758L46.75 0Z"
            fill="#5d3e00"
        />
    </svg>
    <span class="tooltip-text">
            <?php echo esc_html__( 'PDF', 'srft-theme' ); ?>
  </span>
</span>
<span aria-hidden="true">{{ announcement.file.size }} MB </span>
<span class="tooltip-box"><svg width="24" height="24" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M32.0003 41.5333C31.6448 41.5333 31.3114 41.4777 31.0003 41.3666C30.6892 41.2555 30.4003 41.0666 30.1337 40.8L20.5337 31.2C20.0003 30.6666 19.7448 30.0444 19.767 29.3333C19.7892 28.6222 20.0448 28 20.5337 27.4666C21.067 26.9333 21.7003 26.6555 22.4337 26.6333C23.167 26.6111 23.8003 26.8666 24.3337 27.4L29.3337 32.4V13.3333C29.3337 12.5777 29.5892 11.9444 30.1003 11.4333C30.6114 10.9222 31.2448 10.6666 32.0003 10.6666C32.7559 10.6666 33.3892 10.9222 33.9003 11.4333C34.4114 11.9444 34.667 12.5777 34.667 13.3333V32.4L39.667 27.4C40.2003 26.8666 40.8337 26.6111 41.567 26.6333C42.3003 26.6555 42.9337 26.9333 43.467 27.4666C43.9559 28 44.2114 28.6222 44.2337 29.3333C44.2559 30.0444 44.0003 30.6666 43.467 31.2L33.867 40.8C33.6003 41.0666 33.3114 41.2555 33.0003 41.3666C32.6892 41.4777 32.3559 41.5333 32.0003 41.5333ZM16.0003 53.3333C14.5337 53.3333 13.2781 52.8111 12.2337 51.7666C11.1892 50.7222 10.667 49.4666 10.667 48V42.6666C10.667 41.9111 10.9225 41.2777 11.4337 40.7666C11.9448 40.2555 12.5781 40 13.3337 40C14.0892 40 14.7225 40.2555 15.2337 40.7666C15.7448 41.2777 16.0003 41.9111 16.0003 42.6666V48H48.0003V42.6666C48.0003 41.9111 48.2559 41.2777 48.767 40.7666C49.2781 40.2555 49.9114 40 50.667 40C51.4226 40 52.0559 40.2555 52.567 40.7666C53.0781 41.2777 53.3337 41.9111 53.3337 42.6666V48C53.3337 49.4666 52.8114 50.7222 51.767 51.7666C50.7225 52.8111 49.467 53.3333 48.0003 53.3333H16.0003Z" fill="#5d3e00" aria-hidden="true"/>
</svg> 
<span class="tooltip-text">
            <?php echo esc_html__( 'Download', 'srft-theme' ); ?>
  </span></span>
</a>

                      </div>

                      <!-- No PDF -->
                      <div
                        class="Rtable-cell--content"
                        data-ng-if="!announcement.file || !announcement.file.url"
                      >

                       <a
    data-ng-href="{{ announcement.link }}"
    target="_blank"
    rel="noopener"
    aria-label="View announcement"
    title="View"
>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        width="24"
        height="24"
        viewBox="0 0 64 64"
        fill="none"
        aria-hidden="true"
        focusable="false"
    >
        <path
            d="M32.0003 17.3333C42.107 17.3333 51.1203 23.0133 55.5203 32C51.1203 40.9867 42.107 46.6667 32.0003 46.6667C21.8937 46.6667 12.8803 40.9867 8.48033 32C12.8803 23.0133 21.8937 17.3333 32.0003 17.3333ZM32.0003 12C18.667 12 7.28033 20.2933 2.66699 32C7.28033 43.7067 18.667 52 32.0003 52C45.3337 52 56.7203 43.7067 61.3337 32C56.7203 20.2933 45.3337 12 32.0003 12ZM32.0003 25.3333C35.6803 25.3333 38.667 28.32 38.667 32C38.667 35.68 35.6803 38.6667 32.0003 38.6667C28.3203 38.6667 25.3337 35.68 25.3337 32C25.3337 28.32 28.3203 25.3333 32.0003 25.3333ZM32.0003 20C25.387 20 20.0003 25.3867 20.0003 32C20.0003 38.6133 25.387 44 32.0003 44C38.6137 44 44.0003 38.6133 44.0003 32C44.0003 25.3867 38.6137 20 32.0003 20Z"
            fill="#5D3E00"
        />
    </svg>
</a>

                      </div>

                    </td>

                  </tr>

                </tbody>

              </table>

            </div>

          </div>

          <!-- Pagination -->
          <nav
            aria-label="<?php echo esc_attr__( 'Pagination', 'srft-theme' ); ?>"
            data-ng-if="totalPages > 1 && !isLoading && !loadError"
          >

            <ul class="pagination">

              <!-- First -->
              <li data-ng-class="{ 'disabled': currentPage === 1 }">

                <a
                  href="#"
                  aria-label="<?php echo esc_attr__( 'First Page', 'srft-theme' ); ?>"
                  data-ng-click="firstPage($event)"
                >
                  <i
                    class="fa fa-step-backward"
                    aria-hidden="true"
                    style="color:#8b5b2b;"
                  ></i>
                </a>

              </li>

              <!-- Previous -->
              <li data-ng-class="{ 'disabled': currentPage === 1 }">

                <a
                  href="#"
                  aria-label="<?php echo esc_attr__( 'Previous Page', 'srft-theme' ); ?>"
                  data-ng-click="prevPage($event)"
                >
                  <i
                    class="fa fa-chevron-left"
                    aria-hidden="true"
                    style="color:#8b5b2b;"
                  ></i>
                </a>

              </li>

              <!-- Page Numbers -->
              <li
                data-ng-repeat="page in getPageNumbers()"
                data-ng-class="{ 'active': currentPage === page }"
              >

                <a
                  href="#"
                  data-ng-click="setPage(page, $event)"
                  data-ng-attr-aria-current="{{ currentPage === page ? 'page' : undefined }}"
                >
                  {{ page }}
                </a>

              </li>

              <!-- Next -->
              <li data-ng-class="{ 'disabled': currentPage === totalPages }">

                <a
                  href="#"
                  aria-label="<?php echo esc_attr__( 'Next Page', 'srft-theme' ); ?>"
                  data-ng-click="nextPage($event)"
                >
                  <i
                    class="fa fa-chevron-right"
                    aria-hidden="true"
                    style="color:#8b5b2b;"
                  ></i>
                </a>

              </li>

              <!-- Last -->
              <li data-ng-class="{ 'disabled': currentPage === totalPages }">

                <a
                  href="#"
                  aria-label="<?php echo esc_attr__( 'Last Page', 'srft-theme' ); ?>"
                  data-ng-click="lastPage($event)"
                >
                  <i
                    class="fa fa-step-forward"
                    aria-hidden="true"
                    style="color:#8b5b2b;"
                  ></i>
                </a>

              </li>

            </ul>

          </nav>

        </div>
      </div>

    </div>

  </section>

  <!-- AngularJS -->
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.3/angular.min.js"></script>

  <script>
    (function () {

      'use strict';

      var categoryID = <?php echo wp_json_encode( $category_id ); ?>;

      var siteURL = <?php echo wp_json_encode( trailingslashit( site_url( '/' ) ) ); ?>;

      angular.module('myApp', [])

      .controller('AnnouncementController', function ($scope, $http) {

        /*
         * ---------------------------------------------------------
         * State
         * ---------------------------------------------------------
         */

        $scope.isLoading = true;
        $scope.loadError = false;

        $scope.announcementList = [];
        $scope.filteredAnnouncement = [];
        $scope.pagedAnnouncement = [];

        $scope.filterField = '';
        $scope.fromDate = '';
        $scope.toDate = '';

        $scope.itemsPerPage = 20;
        $scope.currentPage = 1;
        $scope.totalPages = 1;


        /*
         * ---------------------------------------------------------
         * Helpers
         * ---------------------------------------------------------
         */

        function bytesToMB(bytes) {

          if (!bytes) {
            return '0.00';
          }

          return (parseInt(bytes, 10) / 1048576).toFixed(2);
        }


        /*
         * Decode HTML entities from WordPress REST API
         *
         * Example:
         * &amp; -> &
         * &#8211; -> –
         */

        function decodeHTMLEntities(text) {

          if (!text) {
            return '';
          }

          var textarea = document.createElement('textarea');

          textarea.innerHTML = text;

          return textarea.value;
        }


        /*
         * Remove HTML tags from REST API title
         */

        function cleanTitle(title) {

          if (!title) {
            return '';
          }

          var temp = document.createElement('div');

          temp.innerHTML = title;

          return (temp.textContent || temp.innerText || '')
            .replace(/\s+/g, ' ')
            .trim();
        }


        /*
         * Convert ACF date into JavaScript Date
         *
         * Supports:
         * dd/mm/yyyy
         * yyyy-mm-dd
         * ISO dates
         */

        function normalizeDate(value) {

          if (!value) {
            return null;
          }

          if (value instanceof Date) {
            return value;
          }

          value = String(value).trim();

          /*
           * dd/mm/yyyy
           */
          if (value.indexOf('/') !== -1) {

            var parts = value.split('/');

            if (parts.length === 3) {

              var day   = parseInt(parts[0], 10);
              var month = parseInt(parts[1], 10) - 1;
              var year  = parseInt(parts[2], 10);

              var d = new Date(year, month, day);

              if (!isNaN(d.getTime())) {
                return d;
              }
            }
          }

          /*
           * yyyy-mm-dd
           */
          if (/^\d{4}-\d{2}-\d{2}$/.test(value)) {

            var isoParts = value.split('-');

            var isoDate = new Date(
              parseInt(isoParts[0], 10),
              parseInt(isoParts[1], 10) - 1,
              parseInt(isoParts[2], 10)
            );

            if (!isNaN(isoDate.getTime())) {
              return isoDate;
            }
          }

          /*
           * General date
           */
          var date = new Date(value);

          return isNaN(date.getTime()) ? null : date;
        }


        /*
         * ---------------------------------------------------------
         * Fetch ALL announcement posts
         * ---------------------------------------------------------
         */

        function fetchAnnouncements(page, accumulated) {

          page = page || 1;
          accumulated = accumulated || [];

          var url =
            siteURL +
            'wp-json/wp/v2/announcement' +
            '?categories=' + encodeURIComponent(categoryID) +
            '&per_page=100' +
            '&page=' + page;

          $http.get(url)

          .then(function (response) {

            accumulated = accumulated.concat(response.data || []);

            var totalPagesHeader =
              response.headers('X-WP-TotalPages');

            var totalPages = totalPagesHeader
              ? parseInt(totalPagesHeader, 10)
              : 1;


            /*
             * If more REST pages exist,
             * fetch the next page.
             */

            if (page < totalPages) {

              fetchAnnouncements(
                page + 1,
                accumulated
              );

              return;
            }


            /*
             * -----------------------------------------------------
             * Convert REST data into our view model
             * -----------------------------------------------------
             */

            $scope.announcementList = accumulated.map(function (post) {

              var acf = post.acf || {};

              var doc = acf['Announcement-Doc']
                ? acf['Announcement-Doc']
                : null;

              var publishDate =
                normalizeDate(
                  acf['Announcement-Publish-Date']
                );


              /*
               * Post link
               */

              var postLink = post.link || '#';


              /*
               * Optional background image parameter
               * retained from your original Announcement template
               */

              var bgUrl =
                <?php echo wp_json_encode(
                  get_the_post_thumbnail_url(
                    get_the_ID(),
                    'large'
                  )
                ); ?>;


              var linkWithImage = postLink;

              if (postLink !== '#' && bgUrl) {

                linkWithImage =
                  postLink +
                  '?bg_image=' +
                  encodeURIComponent(bgUrl);

              }


              return {

                /*
                 * Title
                 */
                title: cleanTitle(
                  post.title
                    ? post.title.rendered
                    : ''
                ),

                /*
                 * Detail page
                 */
                link: linkWithImage,

                /*
                 * Publish date
                 */
                pubdate: publishDate,

                /*
                 * PDF/document
                 */
                file: doc
                  ? {
                      url: doc.url || '',
                      title: doc.title || '',
                      size: bytesToMB(doc.filesize),
                      type: doc.subtype || ''
                    }
                  : null

              };

            });


            /*
             * -----------------------------------------------------
             * Sort newest first
             * -----------------------------------------------------
             */

            $scope.announcementList.sort(function (a, b) {

              var dateA = a.pubdate
                ? a.pubdate.getTime()
                : 0;

              var dateB = b.pubdate
                ? b.pubdate.getTime()
                : 0;

              return dateB - dateA;

            });


            /*
             * Initial filtering
             */

            updateFilteredAnnouncement();

            $scope.isLoading = false;

          })

          .catch(function (error) {

            console.error(
              'Error fetching announcement data:',
              error
            );

            $scope.isLoading = false;
            $scope.loadError = true;

          });

        }


        /*
         * ---------------------------------------------------------
         * Status message for screen readers
         * ---------------------------------------------------------
         */

        function setStatusMessage() {

          var statusEl =
            document.getElementById('searchStatus');

          if (!statusEl) {
            return;
          }

          if ($scope.filteredAnnouncement.length > 0) {

            statusEl.textContent =
              $scope.filteredAnnouncement.length +
              ' <?php echo esc_js(
                __( 'circulars/notices found.', 'srft-theme' )
              ); ?>';

          } else {

            statusEl.textContent =
              '<?php echo esc_js(
                __( 'No circulars/notices found.', 'srft-theme' )
              ); ?>';

          }

        }


        /*
         * ---------------------------------------------------------
         * Date comparison helpers
         * ---------------------------------------------------------
         */

        function startOfDay(date) {

          var d = new Date(date);

          d.setHours(0, 0, 0, 0);

          return d;

        }


        function endOfDay(date) {

          var d = new Date(date);

          d.setHours(23, 59, 59, 999);

          return d;

        }


        /*
         * ---------------------------------------------------------
         * Filter announcements
         * ---------------------------------------------------------
         */

        function updateFilteredAnnouncement() {

          var searchTerm =
            ($scope.filterField || '')
              .toLowerCase()
              .trim();


          var fromDate =
            $scope.fromDate
              ? startOfDay(
                  normalizeDate($scope.fromDate)
                )
              : null;


          var toDate =
            $scope.toDate
              ? endOfDay(
                  normalizeDate($scope.toDate)
                )
              : null;


          $scope.filteredAnnouncement =
            $scope.announcementList.filter(function (announcement) {

              /*
               * Search
               */

              var title =
                (announcement.title || '')
                  .toLowerCase();

              var titleMatch =
                !searchTerm ||
                title.indexOf(searchTerm) !== -1;


              /*
               * Date
               */

              var announcementDate =
                announcement.pubdate
                  ? announcement.pubdate
                  : null;


              /*
               * If no date is available,
               * exclude it when date filtering is active.
               */

              if ((fromDate || toDate) && !announcementDate) {
                return false;
              }


              /*
               * From date
               */

              if (
                fromDate &&
                announcementDate < fromDate
              ) {
                return false;
              }


              /*
               * To date
               */

              if (
                toDate &&
                announcementDate > toDate
              ) {
                return false;
              }


              return titleMatch;

            });


          /*
           * Reset pagination after filtering
           */

          $scope.currentPage = 1;

          recalculatePagination();

          setStatusMessage();

        }


        /*
         * ---------------------------------------------------------
         * Pagination
         * ---------------------------------------------------------
         */

        function recalculatePagination() {

          $scope.totalPages =
            Math.max(
              1,
              Math.ceil(
                $scope.filteredAnnouncement.length /
                $scope.itemsPerPage
              )
            );


          updatePagedAnnouncement();

        }


        function updatePagedAnnouncement() {

          var start =
            ($scope.currentPage - 1) *
            $scope.itemsPerPage;

          var end =
            start +
            $scope.itemsPerPage;


          $scope.pagedAnnouncement =
            $scope.filteredAnnouncement.slice(
              start,
              end
            );

        }


        /*
         * Page numbers
         */

        $scope.getPageNumbers = function () {

          var pages = [];

          for (
            var i = 1;
            i <= $scope.totalPages;
            i++
          ) {

            pages.push(i);

          }

          return pages;

        };


        /*
         * Set page
         */

        $scope.setPage = function (page, event) {

          if (event) {
            event.preventDefault();
          }

          if (
            page >= 1 &&
            page <= $scope.totalPages
          ) {

            $scope.currentPage = page;

            updatePagedAnnouncement();

          }

        };


        /*
         * Previous
         */

        $scope.prevPage = function (event) {

          if (event) {
            event.preventDefault();
          }

          if ($scope.currentPage > 1) {

            $scope.currentPage--;

            updatePagedAnnouncement();

          }

        };


        /*
         * Next
         */

        $scope.nextPage = function (event) {

          if (event) {
            event.preventDefault();
          }

          if (
            $scope.currentPage <
            $scope.totalPages
          ) {

            $scope.currentPage++;

            updatePagedAnnouncement();

          }

        };


        /*
         * First
         */

        $scope.firstPage = function (event) {

          if (event) {
            event.preventDefault();
          }

          $scope.currentPage = 1;

          updatePagedAnnouncement();

        };


        /*
         * Last
         */

        $scope.lastPage = function (event) {

          if (event) {
            event.preventDefault();
          }

          $scope.currentPage =
            $scope.totalPages;

          updatePagedAnnouncement();

        };


        /*
         * ---------------------------------------------------------
         * Filters
         * ---------------------------------------------------------
         */

        $scope.applyFilters =
          updateFilteredAnnouncement;


        /*
         * Reset
         */

        $scope.resetFilters = function () {

          $scope.filterField = '';
          $scope.fromDate = '';
          $scope.toDate = '';

          updateFilteredAnnouncement();

        };


        /*
         * ---------------------------------------------------------
         * Initial load
         * ---------------------------------------------------------
         */

        fetchAnnouncements(1, []);

      });

    })();
  </script>

</main>

<?php get_footer(); ?>


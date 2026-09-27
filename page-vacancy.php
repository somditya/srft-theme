<?php
/*
Template Name: Vacancy
*/
get_header();

function get_category_ID( $cat_name ) { // keep your helper
  $cat = get_term_by( 'name', $cat_name, 'category' );
  return $cat ? $cat->term_id : 0;
}

$page_content  = apply_filters('the_content', $post->post_content ?? '');
$category_name = 'vacancy';
$category_id   = get_category_ID($category_name);
?>

<main>
  <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
    <div class="page-banner">
      <h1 class="page-banner-title" style="margin-top:10px;"><?php echo esc_html__('Recruitment Notices', 'srft-theme'); ?></h1>
    </div>
  </section>

  <div class="container-aligned">
    <div class="breadcrumbs-wrapper">
      <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<nav aria-label="breadcrumbs" id="breadcrumbs">','</nav>'); } ?>
    </div>
  </div>

  <section id="skip-to-content" class="section-home">
    <div class="container" style="padding: 0 3.2rem 32px;">
      <h2 class="page-header-text" style="padding-bottom:20px; text-align:center;"><?php echo esc_html__('List of Recruitment Notices', 'srft-theme'); ?></h2>

      <div data-ng-app="myApp">
        <div data-ng-controller="VacancyController">
          <div class="filter-bar">
            <label for="fromDate"><?php echo esc_html__('From date: ', 'srft-theme'); ?></label>
            <input type="date" id="fromDate" data-ng-model="fromDate" data-ng-change="applyFilters()">
            <label for="toDate"><?php echo esc_html__('To date: ', 'srft-theme'); ?></label>
            <input type="date" id="toDate" data-ng-model="toDate" data-ng-change="applyFilters()">
            <label for="filterField"><?php echo esc_html__('Search:', 'srft-theme'); ?></label>
            <input type="text" id="filterField" aria-describedby="searchInstruction" data-ng-model="filterField" placeholder="<?php echo esc_attr__('Search by keyword', 'srft-theme'); ?>" data-ng-change="applyFilters()">
            <button type="button" data-ng-click="resetFilters()"><?php echo esc_html__('Reset', 'srft-theme'); ?></button>
          </div>

          <!-- Live status messages -->
          <div class="sr-only" aria-live="polite" role="status" id="searchStatus"></div>
           <p id="searchInstruction" class="sr-only">
            <?php echo esc_html__( 'Results update automatically as you type.', 'srft-theme' ); ?>
          </p>
          <!-- Loading / Error -->
          <p data-ng-if="isLoading"><?php echo esc_html__('Loading vacancies…', 'srft-theme'); ?></p>
          <p data-ng-if="loadError" style="color:#b00020;"><?php echo esc_html__('Failed to load vacancies. Please try again later.', 'srft-theme'); ?></p>

          <div class="wrapper" style="padding: 0 3.2rem;" data-ng-if="!isLoading && !loadError">
            <div class="table-container">
                <table>
                  <caption class="sr-only"><?php echo esc_html__('Table shows lists of notifications for recruitments', 'srft-theme'); ?></caption>
                  <thead>
                    <tr class="Rtable-row Rtable-row--head">
                      <th class="Rtable-cell cell-width-10-percent column-heading" scope="column"><?php echo esc_html__('SL.No.', 'srft-theme'); ?></th>
                      <th class="Rtable-cell cell-width-40-percent column-heading" scope="column"><?php echo esc_html__('Recruitment for', 'srft-theme'); ?></th>
                      <th class="Rtable-cell cell-width-10-percent column-heading" scope="column"><?php echo esc_html__('Publish Date', 'srft-theme'); ?></th>
                      <th class="Rtable-cell cell-width-10-percent column-heading" scope="column"><?php echo esc_html__('Submission Date', 'srft-theme'); ?></th>
                      <th class="Rtable-cell cell-width-10-percent column-heading" scope="column"><?php echo esc_html__('Extended Submission Date', 'srft-theme'); ?></th>
                      <th class="Rtable-cell cell-width-20-percent column-heading" scope="column"><?php echo esc_html__('Access Link', 'srft-theme'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="Rtable-row" data-ng-repeat="vacancy in pagedVacancy track by $index">
                      <td class="Rtable-cell cell-width-10-percent">
                        <div class="Rtable-cell--content">
                          <span class="webinar-date">{{ (($parent.currentPage-1)*itemsPerPage) + $index + 1 }}</span>
                        </div>
                      </td>
                      <th class="Rtable-cell cell-width-40-percent" scope="row">
                        <div class="Rtable-cell--content">{{ vacancy.title }}</div>
                      </th>
                      <td class="Rtable-cell cell-width-10-percent">
                        <div class="Rtable-cell--content"><span class="webinar-date"><time datetime="{{ vacancy.pubdate | date:'yyyy-MM-dd' }}" data-ng-if="vacancy.pubdate">
    {{ vacancy.pubdate | date:'dd/MM/yyyy' }}
  </time></span></div>
                      </td>
                      <td class="Rtable-cell cell-width-10-percent">
                        <div class="Rtable-cell--content"><span class="webinar-date"><time datetime="{{ vacancy.subdate | date:'yyyy-MM-dd' }}" data-ng-if="vacancy.subdate">
    {{ vacancy.subdate | date:'dd/MM/yyyy' }}
  </time></span></div>
                      </td>
                      <td class="Rtable-cell cell-width-10-percent">
                        <div class="Rtable-cell--content"><span class="webinar-date" data-ng-if="vacancy.extsubdate">{{ vacancy.extsubdate | date:'dd-MM-yyyy' }}</span><span data-ng-if="!vacancy.extsubdate">—</span></div>
                      </td>
                      <td class="Rtable-cell cell-width-20-percent">
                        <div class="Rtable-cell--content access-link-content" data-ng-if="vacancy.file && vacancy.file.url">
                          <a data-ng-href="{{ vacancy.file.url }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 68 68" fill="none" title="PDF icon"><path fill-rule="evenodd" clip-rule="evenodd" d="M15.13 47.8714C12.7254 46.6379 9.88617 46.145 7.0975 46.4771H0V67.9281H5.6525V59.741H8.075C10.5846 59.9579 13.1063 59.4402 15.215 58.2752C17.0049 56.9837 17.9917 55.0731 17.8925 53.0912C18.025 51.0785 16.9966 49.1354 15.13 47.8714ZM10.5825 55.701C9.51486 56.0964 8.34103 56.2445 7.1825 56.1301H5.525V50.0523H7.1825C8.38607 49.9447 9.6003 50.144 10.6675 50.6243C11.6614 51.2066 12.2246 52.1813 12.155 53.1984C12.2838 54.2239 11.6623 55.213 10.5825 55.701ZM30.0475 46.4771H22.9925V67.9281H29.75C33.1938 68.2116 36.6618 67.653 39.7375 66.3193C43.1218 64.1975 44.9299 60.7346 44.4975 57.2026C44.7508 54.1767 43.4692 51.2021 40.97 49.0155C37.8829 46.9686 33.9459 46.0537 30.0475 46.4771ZM35.6575 63.0659C33.8869 63.9031 31.8595 64.2766 29.835 64.1384H28.73V50.2668H29.75C33.32 50.2668 34.7225 50.5528 36.125 51.6254C37.8271 53.1161 38.7062 55.1399 38.5475 57.2026C38.7661 59.4349 37.6898 61.6187 35.6575 63.0659ZM50.7025 67.9281H56.44V58.9544H68V55.1648H56.44V50.2668H68V46.4771H50.7025V67.9281ZM46.75 0H0V39.3268H8.5V32.1765V28.4226V7.15033H43.2225L59.5 20.8432V28.4226V32.1765V39.3268H68V17.8758L46.75 0Z" fill="#5d3e00"></path></svg>
                            <span>{{ vacancy.file.size }} MB</span>
                            <svg width="24" height="24" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M32.0003 41.5333C31.6448 41.5333 31.3114 41.4777 31.0003 41.3666C30.6892 41.2555 30.4003 41.0666 30.1337 40.8L20.5337 31.2C20.0003 30.6666 19.7448 30.0444 19.767 29.3333C19.7892 28.6222 20.0448 28 20.5337 27.4666C21.067 26.9333 21.7003 26.6555 22.4337 26.6333C23.167 26.6111 23.8003 26.8666 24.3337 27.4L29.3337 32.4V13.3333C29.3337 12.5777 29.5892 11.9444 30.1003 11.4333C30.6114 10.9222 31.2448 10.6666 32.0003 10.6666C32.7559 10.6666 33.3892 10.9222 33.9003 11.4333C34.4114 11.9444 34.667 12.5777 34.667 13.3333V32.4L39.667 27.4C40.2003 26.8666 40.8337 26.6111 41.567 26.6333C42.3003 26.6555 42.9337 26.9333 43.467 27.4666C43.9559 28 44.2114 28.6222 44.2337 29.3333C44.2559 30.0444 44.0003 30.6666 43.467 31.2L33.867 40.8C33.6003 41.0666 33.3114 41.2555 33.0003 41.3666C32.6892 41.4777 32.3559 41.5333 32.0003 41.5333ZM16.0003 53.3333C14.5337 53.3333 13.2781 52.8111 12.2337 51.7666C11.1892 50.7222 10.667 49.4666 10.667 48V42.6666C10.667 41.9111 10.9225 41.2777 11.4337 40.7666C11.9448 40.2555 12.5781 40 13.3337 40C14.0892 40 14.7225 40.2555 15.2337 40.7666C15.7448 41.2777 16.0003 41.9111 16.0003 42.6666V48H48.0003V42.6666C48.0003 41.9111 48.2559 41.2777 48.767 40.7666C49.2781 40.2555 49.9114 40 50.667 40C51.4226 40 52.0559 40.2555 52.567 40.7666C53.0781 41.2777 53.3337 41.9111 53.3337 42.6666V48C53.3337 49.4666 52.8114 50.7222 51.767 51.7666C50.7225 52.8111 49.467 53.3333 48.0003 53.3333H16.0003Z" fill="#5d3e00" aria-hidden="true"/>
</svg>
                          </a>
                        </div>
                        <div class="Rtable-cell--content" data-ng-if="!vacancy.file || !vacancy.file.url">—</div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Pagination -->
            <nav aria-label="Pagination" data-ng-if="totalPages > 1">
              <ul class="pagination">
                <li data-ng-class="{ 'disabled': currentPage === 1 }">
                  <a href="#" aria-label="<?php echo esc_attr__('First Page', 'srft-theme'); ?>" data-ng-click="firstPage()"><i class="fa fa-step-backward" style="color:#8b5b2b;"></i></a>
                </li>
                <li data-ng-class="{ 'disabled': currentPage === 1 }">
                  <a href="#" aria-label="<?php echo esc_attr__('Previous Page', 'srft-theme'); ?>" data-ng-click="prevPage()"><i class="fa fa-chevron-left" style="color:#8b5b2b;"></i></a>
                </li>
                <li data-ng-repeat="page in getPageNumbers()" data-ng-class="{ 'active': currentPage === page }">
                  <a href="#" data-ng-click="setPage(page)" ng-attr-aria-current="{{ currentPage === page ? 'page' : undefined }}">{{ page }}</a>
                </li>
                <li data-ng-class="{ 'disabled': currentPage === totalPages }">
                  <a href="#" aria-label="<?php echo esc_attr__('Next Page', 'srft-theme'); ?>" data-ng-click="nextPage()"><i class="fa fa-chevron-right" style="color:#8b5b2b;"></i></a>
                </li>
                <li data-ng-class="{ 'disabled': currentPage === totalPages }">
                  <a href="#" aria-label="<?php echo esc_attr__('Last Page', 'srft-theme'); ?>" data-ng-click="lastPage()"><i class="fa fa-step-forward" style="color:#8b5b2b;"></i></a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- AngularJS (include once on the page/app) -->
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.3/angular.min.js"></script>

  <script>
    (function(){
      var categoryID = <?php echo json_encode($category_id); ?>;
      var siteURL = '<?php echo esc_url(site_url('/')); ?>';

      angular.module('myApp', [])
      .controller('VacancyController', function ($scope, $http) {

        // State
        $scope.isLoading = true;
        $scope.loadError = false;

        $scope.vacancyList = [];
        $scope.filteredVacancy = [];
        $scope.pagedVacancy = [];

        $scope.filterField = '';
        $scope.fromDate = '';
        $scope.toDate = '';

        $scope.itemsPerPage = 10;
        $scope.currentPage = 1;
        $scope.totalPages = 1;

        // Helpers
        function bytesToMB(bytes) {
          return bytes ? (bytes / 1048576).toFixed(2) : '0.00';
        }

        function normalizeDate(val) {
          if (!val) return null;
          // Accepts ISO (yyyy-mm-dd) or dd/mm/yyyy strings from ACF
          if (typeof val === 'string' && val.indexOf('/') > -1) {
            var p = val.split('/');
            // dd/mm/yyyy -> yyyy-mm-dd
            return new Date(p[2], p[1]-1, p[0]);
          }
          return new Date(val);
        }

        // Fetch ALL pages from WP REST
        function fetchVacancies(page, acc) {
          page = page || 1;
          acc  = acc  || [];

          var url = siteURL + 'wp-json/wp/v2/vacancy?categories=' + categoryID + '&per_page=100&page=' + page;

          $http.get(url).then(function (response) {
            acc = acc.concat(response.data || []);

            var totalPagesHeader = response.headers('X-WP-TotalPages');
            var totalPages = totalPagesHeader ? parseInt(totalPagesHeader, 10) : 1;

            if (page < totalPages) {
              fetchVacancies(page + 1, acc);
              return;
            }

            // Map to view model
            $scope.vacancyList = acc.map(function (post) {
              var doc = (post.acf && post.acf['Vacancy-Doc']) ? post.acf['Vacancy-Doc'] : null;
              var title = (post.title && post.title.rendered) ? post.title.rendered.replace(/<[^>]+>/g,'').trim() : '';

              // Optional: add hero bg as param on detail link (kept from your code)
              var postLink = post.link || '';
              var bgUrl = '<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>';
              var linkWithImage = postLink ? (postLink + '?bg_image=' + encodeURIComponent(bgUrl)) : '#';

              return {
                title: title,
                link: linkWithImage,
                ID: post.acf ? post.acf['Vacancy-ID'] : '',
                pubdate: normalizeDate(post.acf ? post.acf['Vacancy-Publish-Date'] : null),
                subdate: normalizeDate(post.acf ? post.acf['Vacancy-LastDate'] : null),
                extsubdate: normalizeDate(post.acf ? post.acf['Vacancy-LastDateExtended'] : null),
                file: doc ? {
                  url: doc.url || '',
                  title: doc.title || '',
                  size: bytesToMB(doc.filesize),
                  type: doc.subtype || ''
                } : null
              };
            });

            // Sort by publish date desc
            $scope.vacancyList.sort(function(a,b){
              var ad = a.pubdate ? new Date(a.pubdate).getTime() : 0;
              var bd = b.pubdate ? new Date(b.pubdate).getTime() : 0;
              return bd - ad;
            });

            // Initial filter + paginate
            updateFilteredVacancy();

            $scope.isLoading = false;
          }).catch(function (error) {
            console.error('Error fetching vacancy data:', error);
            $scope.isLoading = false;
            $scope.loadError = true;
          });
        }

        function setStatusMessage() {
          var statusEl = document.getElementById('searchStatus');
          if (!statusEl) return;
          if ($scope.filteredVacancy.length > 0) {
            statusEl.textContent = $scope.filteredVacancy.length + " <?php echo esc_js(__('vacancies found.', 'srft-theme')); ?>";
          } else {
            statusEl.textContent = "<?php echo esc_js(__('No vacancies found.', 'srft-theme')); ?>";
          }
        }

        function updatePagedVacancy() {
          var startIndex = ($scope.currentPage - 1) * $scope.itemsPerPage;
          var endIndex   = startIndex + $scope.itemsPerPage;
          $scope.pagedVacancy = $scope.filteredVacancy.slice(startIndex, endIndex);
        }

        function recalcTotalPages() {
          $scope.totalPages = Math.max(1, Math.ceil($scope.filteredVacancy.length / $scope.itemsPerPage));
        }

        function updateFilteredVacancy() {
          var searchTerm = ($scope.filterField || '').toLowerCase().trim();
          var fromDate = $scope.fromDate ? new Date($scope.fromDate) : null;
          var toDate   = $scope.toDate ? new Date($scope.toDate) : null;

          $scope.filteredVacancy = $scope.vacancyList.filter(function (v) {
            var title = (v.title || '').toLowerCase();
            var titleMatch = !searchTerm || title.indexOf(searchTerm) !== -1;

            if (fromDate && toDate && v.subdate) {
              var sub = new Date(v.subdate);
              return titleMatch && sub >= fromDate && sub <= toDate;
            }
            return titleMatch;
          });

          // Reset to page 1 on each filter change
          $scope.currentPage = 1;
          recalcTotalPages();
          updatePagedVacancy();
          setStatusMessage();
        }

        // Expose to scope
        $scope.applyFilters = updateFilteredVacancy;
        $scope.resetFilters = function () {
          $scope.filterField = '';
          $scope.fromDate = '';
          $scope.toDate = '';
          updateFilteredVacancy();
        };

        $scope.getTotalPages = function () { return $scope.totalPages; };
        $scope.getPageNumbers = function () {
          var pages = [];
          for (var i = 1; i <= $scope.totalPages; i++) pages.push(i);
          return pages;
        };
        $scope.setPage = function (page) {
          if (page >= 1 && page <= $scope.totalPages) {
            $scope.currentPage = page;
            updatePagedVacancy();
          }
        };
        $scope.prevPage = function () { if ($scope.currentPage > 1) { $scope.currentPage--; updatePagedVacancy(); } };
        $scope.nextPage = function () { if ($scope.currentPage < $scope.totalPages) { $scope.currentPage++; updatePagedVacancy(); } };
        $scope.firstPage = function () { $scope.currentPage = 1; updatePagedVacancy(); };
        $scope.lastPage  = function () { $scope.currentPage = $scope.totalPages; updatePagedVacancy(); };

        // Initial load
        fetchVacancies(1, []);
      });
    })();
  </script>
</main>

<?php get_footer(); ?>

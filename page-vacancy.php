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
                        <div class="Rtable-cell--content" data-ng-if="vacancy.file && vacancy.file.url">
                          <a data-ng-href="{{ vacancy.file.url }}">
                            <img alt="pdf" style="vertical-align:middle;" class="pdf_icon" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pdf_icon_resized.png">
                            &nbsp;(<?php echo esc_html__('Download', 'srft-theme'); ?> - {{ vacancy.file.size }} MB)
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

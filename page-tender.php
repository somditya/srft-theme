<?php
/*
Template Name: Tender
*/
get_header();

function get_category_ID( $cat_name ) {
    $cat = get_term_by( 'name', $cat_name, 'category' );
    return $cat ? $cat->term_id : 0;
}

$category_name = 'tender';
$category_id = get_category_ID( $category_name );
?>

<main>
  <section class="cine-header" style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'large' ) ); ?>');">
    <div class="page-banner">
      <h1 class="page-banner-title"><?php echo esc_html__( 'Tender', 'srft-theme' ); ?></h1>
    </div>
  </section>

  <div class="container-aligned">
    <div class="breadcrumbs-wrapper">
      <?php if ( function_exists( 'yoast_breadcrumb' ) ) { yoast_breadcrumb( '<nav aria-label="breadcrumbs" id="breadcrumbs">','</nav>' ); } ?>
    </div>
  </div>

  <section id="skip-to-content" class="section-home">
    <div class="container" style="padding: 0 3.2rem;">
      <h2 class="page-header-text" style="padding-bottom: 20px; text-align: center;"><?php echo esc_html__( 'Tender List', 'srft-theme' ); ?></h2>

      <div data-ng-app="myApp">
        <div data-ng-controller="TenderController">
          <div class="filter-bar">
            <label for="fromDate"><?php echo esc_html__( 'From date: ', 'srft-theme' ); ?></label>
            <input type="date" id="fromDate" data-ng-model="fromDate" data-ng-change="applyFilters()">

            <label for="toDate"><?php echo esc_html__( 'To date: ', 'srft-theme' ); ?></label>
            <input type="date" id="toDate" data-ng-model="toDate" data-ng-change="applyFilters()">

            <label for="filterField"><?php echo esc_html__( 'Search:', 'srft-theme' ); ?></label>
            <input type="text" id="filterField" data-ng-model="filterField" placeholder="<?php echo esc_attr__( 'Search by keyword', 'srft-theme' ); ?>" data-ng-change="applyFilters()">

            <button type="button" data-ng-click="resetFilters()"><?php echo esc_html__( 'Reset', 'srft-theme' ); ?></button>
          </div>

          <div class="sr-only" aria-live="polite" role="status" id="searchStatus"></div>

          <!-- Loading & error -->
          <p data-ng-if="isLoading"><?php echo esc_html__( 'Loading tenders…', 'srft-theme' ); ?></p>
          <p data-ng-if="loadError" style="color:#b00020;"><?php echo esc_html__( 'Failed to load tenders. Please try again later.', 'srft-theme' ); ?></p>

          <div class="wrapper" data-ng-if="!isLoading && !loadError">
            <div class="table-container">
              <table>
                <caption class="sr-only"><?php echo esc_html__( 'table showing list of tender documents', 'srft-theme' ); ?></caption>
                <thead>
                  <tr class="Rtable-row Rtable-row--head">
                    <th class="Rtable-cell cell-width-10-percent column-heading" scope="row"><?php echo esc_html__( 'SL.No.', 'srft-theme' ); ?></th>
                    <th class="Rtable-cell cell-width-15-percent column-heading" scope="row"><?php echo esc_html__( 'Tender ID', 'srft-theme' ); ?></th>
                    <th class="Rtable-cell cell-width-25-percent column-heading" scope="row"><?php echo esc_html__( 'Tender Title', 'srft-theme' ); ?></th>
                    <th class="Rtable-cell cell-width-10-percent column-heading" scope="row"><?php echo esc_html__( 'Publish Date', 'srft-theme' ); ?></th>
                    <th class="Rtable-cell cell-width-10-percent column-heading" scope="row"><?php echo esc_html__( 'Due Date', 'srft-theme' ); ?></th>
                    <th class="Rtable-cell cell-width-20-percent column-heading" scope="row"><?php echo esc_html__( 'Access Link', 'srft-theme' ); ?></th>
                    <th class="Rtable-cell cell-width-10-percent column-heading" scope="row"><?php echo esc_html__( 'Tender Status', 'srft-theme' ); ?></th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="Rtable-row" data-ng-repeat="tender in pagedTender track by $index">
                    <td class="Rtable-cell cell-width-10-percent">
                      <div class="Rtable-cell--content date-content"><span class="SL">{{ (($parent.currentPage-1)*itemsPerPage) + $index + 1 }}</span></div>
                    </td>

                    <td class="Rtable-cell cell-width-15-percent">
                      <div class="Rtable-cell--content">{{ tender.ID }}</div>
                    </td>

                    <th class="Rtable-cell cell-width-25-percent" scope="row">
                      <div class="Rtable-cell--content">{{ tender.title }}</div>
                    </th>

                    <td class="Rtable-cell cell-width-10-percent">
                      <div class="Rtable-cell--content"><span class="webinar-date"><time datetime="{{ tender.pubdate | date:'yyyy-MM-dd' }}">
    {{ tender.pubdate | date:'dd/MM/yyyy' }}
  </time></span></div>
                    </td>

                    <td class="Rtable-cell cell-width-10-percent">
                      <div class="Rtable-cell--content"><span class="webinar-date" data-ng-if="tender.subdate"><time datetime="{{ tender.subdate | date:'yyyy-MM-dd' }}" data-ng-if="tender.subdate">
    {{ tender.subdate | date:'dd/MM/yyyy' }}
  </time></span><span data-ng-if="!tender.subdate">—</span></div>
                    </td>

                    <td class="Rtable-cell cell-width-20-percent">
                      <div class="Rtable-cell--content access-link-content" data-ng-if="tender.file && tender.file.url">
                        <a data-ng-href="{{ tender.file.url }}" target="_blank" rel="noopener">
                          <img alt="pdf" style="vertical-align: middle;" class="pdf_icon" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/pdf_icon_resized.png">
                          &nbsp; (<span><?php echo esc_html__( 'Download', 'srft-theme' ); ?> - {{ tender.file.size }} MB)</span>
                        </a>
                      </div>
                      <div class="Rtable-cell--content" data-ng-if="!tender.file || !tender.file.url">—</div>
                    </td>

                    <td class="Rtable-cell cell-width-10-percent">
                      <div class="Rtable-cell--content access-link-content">
                        <p data-ng-if="tender.isSubmissionOpen"><?php echo esc_html__( 'Open', 'srft-theme' ); ?></p>
                        <p data-ng-if="!tender.isSubmissionOpen"><?php echo esc_html__( 'Closed', 'srft-theme' ); ?></p>
                      </div>
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
  </section>
</main>

<!-- Include AngularJS (only once on the page) -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.3/angular.min.js"></script>

<script>
(function () {
  angular.module('myApp', [])
    .controller('TenderController', function ($scope, $http) {
      var categoryID = <?php echo json_encode( $category_id ); ?>;
      var siteURL = '<?php echo esc_url( site_url( '/' ) ); ?>';

      // State
      $scope.isLoading = true;
      $scope.loadError = false;

      $scope.tenderList = [];
      $scope.filteredTender = [];
      $scope.pagedTender = [];

      $scope.filterField = '';
      $scope.fromDate = '';
      $scope.toDate = '';

      $scope.itemsPerPage = 20;
      $scope.currentPage = 1;
      $scope.totalPages = 1;
      $scope.currentDate = new Date();

      // Helpers
      function bytesToMB(bytes) {
        return bytes ? (bytes / 1048576).toFixed(2) : '0.00';
      }

      // parse date accepts ISO (yyyy-mm-dd) or dd/mm/yyyy
      function parseDate(val) {
        if (!val) return null;
        if (typeof val !== 'string') return new Date(val);
        if (val.indexOf('/') !== -1) { // dd/mm/yyyy
          var p = val.split('/');
          if (p.length === 3) return new Date(p[2], p[1] - 1, p[0]);
        }
        // fallback to Date constructor for ISO or other formats
        return new Date(val);
      }

      // Fetch ALL pages (handle WP REST pagination)
      function fetchTenders(page, acc) {
        page = page || 1;
        acc = acc || [];

        var url = siteURL + 'wp-json/wp/v2/tender?categories=' + categoryID + '&per_page=100&page=' + page;

        $http.get(url).then(function (response) {
          acc = acc.concat(response.data || []);
          var totalPagesHeader = response.headers('X-WP-TotalPages');
          var totalPages = totalPagesHeader ? parseInt(totalPagesHeader, 10) : 1;

          if (page < totalPages) {
            fetchTenders(page + 1, acc);
            return;
          }

          processTenders(acc);
        }).catch(function (err) {
          console.error('Error fetching tender data:', err);
          $scope.isLoading = false;
          $scope.loadError = true;
        });
      }

      function processTenders(allPosts) {
        // Sort by ACF publish date (account for dd/mm/yyyy)
        allPosts.sort(function (a, b) {
          var da = parseDate( (a.acf && a.acf['Tender-Publish-Date']) ? a.acf['Tender-Publish-Date'] : null );
          var db = parseDate( (b.acf && b.acf['Tender-Publish-Date']) ? b.acf['Tender-Publish-Date'] : null );
          return (db && da) ? db - da : (db ? 1 : -1);
        });

        $scope.tenderList = allPosts.map(function (post) {
          var acf = post.acf || {};
          var doc = acf['Tender-Doc'] || null;

          var cleanTitle = (post.title && post.title.rendered) ? post.title.rendered.replace(/<[^>]+>/g, '').trim() : '';

          var pub = parseDate(acf['Tender-Publish-Date']);
          var sub = parseDate(acf['Tender-Submission-Date']);

          return {
            title: cleanTitle,
            link: post.link || '',
            ID: acf['Tender-ID'] || '',
            pubdate: pub,
            subdate: sub,
            isSubmissionOpen: sub ? (sub >= $scope.currentDate) : false,
            file: doc ? {
              url: doc.url || '',
              title: doc.title || '',
              size: bytesToMB(doc.filesize),
              type: doc.subtype || ''
            } : null
          };
        });

        $scope.isLoading = false;
        updateFilteredTender();
      }

      function setStatusMessage() {
        var statusEl = document.getElementById('searchStatus');
        if (!statusEl) return;
        if ($scope.filteredTender.length > 0) {
          statusEl.textContent = $scope.filteredTender.length + " <?php echo esc_js( __( 'tenders found.', 'srft-theme' ) ); ?>";
        } else {
          statusEl.textContent = "<?php echo esc_js( __( 'No tenders found.', 'srft-theme' ) ); ?>";
        }
      }

      function recalcTotalPages() {
        $scope.totalPages = Math.max(1, Math.ceil($scope.filteredTender.length / $scope.itemsPerPage));
      }

      function updatePagedTender() {
        var startIndex = ($scope.currentPage - 1) * $scope.itemsPerPage;
        $scope.pagedTender = $scope.filteredTender.slice(startIndex, startIndex + $scope.itemsPerPage);
      }

      // Main filter function
      function updateFilteredTender() {
        var keyword = ($scope.filterField || '').trim().toLowerCase();
        var fromDate = $scope.fromDate ? new Date($scope.fromDate) : null;
        var toDate = $scope.toDate ? new Date($scope.toDate) : null;

        $scope.filteredTender = $scope.tenderList.filter(function (t) {
          var titleMatch = !keyword || (t.title && t.title.toLowerCase().indexOf(keyword) !== -1);
          var idMatch = !keyword || (t.ID && (t.ID + '').toLowerCase().indexOf(keyword) !== -1);
          var matchText = titleMatch || idMatch;

          if (fromDate && toDate && t.subdate) {
            var sub = new Date(t.subdate);
            return matchText && sub >= fromDate && sub <= toDate;
          }
          return matchText;
        });

        // Reset to first page
        $scope.currentPage = 1;
        recalcTotalPages();
        updatePagedTender();
        setStatusMessage();
      }

      // Scope bindings
      $scope.applyFilters = updateFilteredTender;
      $scope.resetFilters = function () {
        $scope.filterField = '';
        $scope.fromDate = '';
        $scope.toDate = '';
        updateFilteredTender();
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
          updatePagedTender();
        }
      };

      $scope.prevPage = function () { if ($scope.currentPage > 1) { $scope.currentPage--; updatePagedTender(); } };
      $scope.nextPage = function () { if ($scope.currentPage < $scope.totalPages) { $scope.currentPage++; updatePagedTender(); } };
      $scope.firstPage = function () { $scope.currentPage = 1; updatePagedTender(); };
      $scope.lastPage = function () { $scope.currentPage = $scope.totalPages; updatePagedTender(); };

      // Start fetch
      fetchTenders(1, []);
    });
})();
</script>

<?php get_footer(); ?>

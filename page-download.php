<?php
/*
Template Name: Downloads
*/

get_header(); 

function get_category_ID( $cat_name ) { 
    $cat = get_term_by( 'name', $cat_name, 'category' );

    if ( $cat ) {
        return $cat->term_id;
    }

    return 0;
}

$category_name = 'document'; // Ensure this matches the exact category name.
$category_id = get_category_ID($category_name);
?>

<body ng-controller="DocumentController">
  <main>
    <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
      <div class="page-banner">
        <h1 class="page-banner-title"><?php echo __('Download', 'srft-theme'); ?></h1>
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
      <div class="container">
        <h2 class="page-header-text" style="padding-left: 0; text-align: center;"><?php echo __('Document List', 'srft-theme'); ?></h2>

        <div ng-app="myApp">
          <div ng-controller="DocumentController">
            <div class="filter-bar">
             <label for="filterField"><?php echo esc_html__( 'Search:', 'srft-theme' ); ?></label>
                <input type="text" id="filterField" ng-model="filterField" placeholder="Search by keyword" ng-change="applyFilters()">
          </div>
            <p id="searchInstruction" class="sr-only">
            <?php echo esc_html__( 'Results update automatically as you type.', 'srft-theme' ); ?>
           </p>
          <div class="sr-only" aria-live="polite" role="status" id="searchStatus"> {{ statusMessage }}</div>
            <div class="wrapper" style="padding: 0 3.2rem;">
              <div class="table-container">
                <table>
                <caption class="sr-only"><?php echo esc_html__( 'table showing list of tender documents', 'srft-theme' ); ?></caption>
                <thead>
                <tr class="Rtable-row Rtable-row--head">
                  <th class="Rtable-cell location-cell column-heading" scope="col"><?php echo __('SL.No.', 'srft-theme'); ?></th>
                  <th class="Rtable-cell name-cell column-heading" scope="col"><?php esc_html__('Title', 'srft-theme'); ?></th>
                  <th class="Rtable-cell tenure-cell column-heading" scope="col"><?php echo __('Category', 'srft-theme'); ?></th>
                  <th class="Rtable-cell access-link-cell column-heading" scope="col"><?php echo __('Document', 'srft-theme'); ?></th>
                </tr>
               </thead>
               <tbody>
                <tr class="Rtable-row" ng-repeat="document in pagedDocument">
                  <td class="Rtable-cell location-cell">
                    <div class="Rtable-cell--content"><span class="SL">{{$index + 1}}</span></div>
                  </td>
                  <th class="Rtable-cell name-cell" scope="row">
                    <div class="Rtable-cell--content">{{ document.title }}</div>
                  </th>
                  <td class="Rtable-cell tenure-cell">
                    <div class="Rtable-cell--content"><span>{{ getLocalizedCategory(document.category) }}</span></div>
                  </td>
                  <td class="Rtable-cell access-link-cell">
                    <div class="Rtable-cell--content" ng-if="document.file && document.file.url">
                      <a href="{{document.file.url}}">
                        <img alt="pdf" class="pdf_icon" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pdf_icon_resized.png">
                        <span>(<?php echo __('Download', 'srft-theme'); ?> - {{ document.file.size }} MB)</span>
                      </a>
                    </div>
                    <div ng-if="!document.file || !document.file.url">
                      <a href="{{document.link}}"><?php echo __('View', 'srft-theme'); ?></a>
                    </div>
                  </td>
                </tr>
              </tbody>
              </table>      
              </div>
            </div>

            <!-- Pagination -->
            <nav aria-label="pagination">
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

  <script>
    var categoryID = <?php echo json_encode($category_id); ?>;
    var siteURL = '<?php echo esc_url(site_url('/')); ?>';

    angular.module('myApp', [])
      .controller('DocumentController', function ($scope, $http) {
        // Initialize scope variables
        $scope.documentList = [];
        $scope.filteredDocument = [];
        $scope.pagedDocument = [];
        $scope.filterField = '';
        $scope.itemsPerPage = 20;
        $scope.currentPage = 1;

        function bytesToMB(bytes) {
          return (bytes / 1048576).toFixed(2);
        }

        // 🔹 Helper to decode HTML entities
        function decodeHTMLEntities(text) {
          var textarea = document.createElement('textarea');
          textarea.innerHTML = text;
          return textarea.value;
        }

        // Fetch data
        var apiUrl = siteURL + 'wp-json/wp/v2/document?categories=' + categoryID + '&per_page=100';
        console.log('Fetching data from JSON URL:', apiUrl);

        $http.get(apiUrl)
          .then(function (response) {
            console.log('API Response:', response.data);
            $scope.documentList = response.data.filter(function (post) {
              // Filter for specific categories
              return post.acf['document-category'] && 
                     (post.acf['document-category'] === 'Employees' || post.acf['document-category'] === 'Students' || post.acf['document-category'] === 'कर्मचारी' || post.acf['document-category'] === 'छात्र' );
            }).map(function (post) {
              return {
                title: (post.title && post.title.rendered) 
                  ? decodeHTMLEntities(post.title.rendered.replace(/<[^>]+>/g, '').trim()) 
                  : '',
                file: {
                  url: post.acf['document']['url'],  
                  title: post.acf['document']['title'],
                  size: bytesToMB(post.acf['document']['filesize']),
                  type: post.acf['document']['subtype']
                },
                category: post.acf['document-category'] ? decodeHTMLEntities(post.acf['document-category']) : ''
              };
            });
            console.log('Document List:', $scope.documentList);
            $scope.updateFilteredDocument();
          });

        // Update filtered document for pagination
        $scope.updateFilteredDocument = function () {
          $scope.filteredDocument = $scope.documentList.filter(function (document) {
            return !$scope.filterField || document.title.toLowerCase().includes($scope.filterField.toLowerCase());
          });

          const startIndex = ($scope.currentPage - 1) * $scope.itemsPerPage;
          $scope.pagedDocument = $scope.filteredDocument.slice(startIndex, startIndex + $scope.itemsPerPage);
          setStatusMessage();
          console.log('Filtered Documents:', $scope.filteredDocument);
          console.log('Paged Documents:', $scope.pagedDocument);
        };

        $scope.getLocalizedCategory = function (category) {
          const localizedCategories = {
              "Students": "<?php echo __('For Students', 'srft-theme'); ?>",
              "Employees": "<?php echo __('For Employees', 'srft-theme'); ?>"
          };
          return localizedCategories[category] || category;
        };

        function setStatusMessage() {
          if ($scope.filteredDocument.length > 0) {
            $scope.statusMessage = $scope.filteredDocument.length + " <?php echo esc_js( __( 'documents found.', 'srft-theme' ) ); ?>";
          } else {
            $scope.statusMessage = "<?php echo esc_js( __( 'No documents found.', 'srft-theme' ) ); ?>";
          }
        }

        $scope.applyFilters = function () {
          $scope.updateFilteredDocument();
        };

        $scope.updatePagedDocument = function () {
          const start = ($scope.currentPage - 1) * $scope.itemsPerPage;
          $scope.pagedDocument = $scope.filteredDocument.slice(start, start + $scope.itemsPerPage);
        };

        $scope.setPage = function (page) {
          $scope.currentPage = page;
          $scope.updatePagedDocument();
        };

        $scope.prevPage = function () {
          if ($scope.currentPage > 1) {
            $scope.currentPage--;
            $scope.updatePagedDocument();
          }
        };

        $scope.nextPage = function () {
          if ($scope.currentPage < Math.ceil($scope.filteredDocument.length / $scope.itemsPerPage)) {
            $scope.currentPage++;
            $scope.updatePagedDocument();
          }
        };

        $scope.getPageNumbers = function () {
          return Array.from({ length: Math.ceil($scope.filteredDocument.length / $scope.itemsPerPage) }, (_, i) => i + 1);
        };
      });
  </script>

</body>

<?php get_footer(); ?>

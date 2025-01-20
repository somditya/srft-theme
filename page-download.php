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
        <div class="page-banner-title"><?php echo __('Download', 'srft-theme'); ?></div>
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

        <h2 class="page-header-text" style="padding-left: 0; text-align: center;"><?php echo __('Document List', 'srft-theme'); ?></h2>

        <div ng-app="myApp">
          <div ng-controller="DocumentController">
            <p style="padding: 15px;">
              <label for="filterField">
                <input type="text" id="filterField" ng-model="filterField" placeholder="Search by keyword" ng-change="applyFilters()">
              </label>
            </p>

            <div class="wrapper">
              <div class="Rtable Rtable--7cols Rtable--collapse">
                <div class="Rtable-row Rtable-row--head">
                  <div class="Rtable-cell location-cell column-heading"><?php echo __('SL.No.', 'srft-theme'); ?></div>
                  <div class="Rtable-cell name-cell column-heading"><?php echo __('Title', 'srft-theme'); ?></div>
                  <div class="Rtable-cell tenure-cell column-heading"><?php echo __('Category', 'srft-theme'); ?></div>
                  <div class="Rtable-cell access-link-cell column-heading"><?php echo __('Document', 'srft-theme'); ?></div>
                </div>

                <div class="Rtable-row" ng-repeat="document in pagedDocument">
                  <div class="Rtable-cell location-cell">
                    <div class="Rtable-cell--content"><span class="SL">{{$index + 1}}</span></div>
                  </div>
                  <div class="Rtable-cell name-cell">
                    <div class="Rtable-cell--content">{{ document.title }}</div>
                  </div>
                  <div class="Rtable-cell tenure-cell">
                    <div class="Rtable-cell--content"><span>{{ getLocalizedCategory(document.category) }}</span></div>
                  </div>
                  <div class="Rtable-cell access-link-cell">
  <div class="Rtable-cell--content" ng-if="document.file && document.file.url">
    <a href="{{document.file.url}}">
      <img alt="pdf" class="pdf_icon" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pdf_icon_resized.png">
      <span>(<?php echo __('Download', 'srft-theme'); ?> - {{ document.file.size }} MB)</span>
    </a>
  </div>
  <div ng-if="!document.file || !document.file.url">
    <a href="{{document.link}}"><?php echo __('View', 'srft-theme'); ?></a>
  </div>
</div>

                </div>
              </div>
            </div>

            <!-- Pagination -->
            <ul class="pagination">
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

        // Fetch data
        var apiUrl = siteURL + 'wp-json/wp/v2/document?categories=' + categoryID + '&per_page=100';
        console.log('Fetching data from JSON URL:', apiUrl);

        $http.get(apiUrl)
  .then(function (response) {
    console.log('API Response:', response.data);
    $scope.documentList = response.data.filter(function (post) {
    // Filter for specific categories
    return post.acf['document-category'] && 
           (post.acf['document-category'] === 'Employees' || post.acf['document-category'] === 'Students');
  }).map(function (post) {
      return {
        title: post.title.rendered || '',
        file: 
        {
        url: post.acf['document']['url'],  
        title: post.acf['document']['title'],
        size: bytesToMB(post.acf['document']['filesize']),
        type: post.acf['document']['subtype']// Check if 'document' exists and store the file object
        
        },
        
        category: post.acf['document-category'] ? post.acf['document-category'] : ''
      };
    });
    console.log('Document List:', $scope.documentList);
    $scope.updateFilteredDocument();
  });


        // Update filtered document for pagination
        $scope.updateFilteredDocument = function () {
          // Apply filters if needed
          $scope.filteredDocument = $scope.documentList.filter(function (document) {
            return !$scope.filterField || document.title.toLowerCase().includes($scope.filterField.toLowerCase());
          });

          const startIndex = ($scope.currentPage - 1) * $scope.itemsPerPage;
          $scope.pagedDocument = $scope.filteredDocument.slice(startIndex, startIndex + $scope.itemsPerPage);

          console.log('Filtered Documents:', $scope.filteredDocument);
          console.log('Paged Documents:', $scope.pagedDocument);
        };

        $scope.getLocalizedCategory = function (category) {
    const localizedCategories = {
        "Students": "<?php echo __('For Students', 'srft-theme'); ?>",
        "Employees": "<?php echo __('For Employees', 'srft-theme'); ?>",
        // Add more categories as needed
    };

    return localizedCategories[category] || category; // Return the translated category or default to the original
};

        // Apply filters when search field changes
        $scope.applyFilters = function () {
          $scope.updateFilteredDocument();
        };

        // Update the paged document on page change
        $scope.updatePagedDocument = function () {
          const start = ($scope.currentPage - 1) * $scope.itemsPerPage;
          $scope.pagedDocument = $scope.filteredDocument.slice(start, start + $scope.itemsPerPage);
        };

        // Set the current page
        $scope.setPage = function (page) {
          console.log('Setting page:', page);
          $scope.currentPage = page;
          $scope.updatePagedDocument();
        };

        // Previous page
        $scope.prevPage = function () {
          if ($scope.currentPage > 1) {
            $scope.currentPage--;
            $scope.updatePagedDocument();
          }
        };

        // Next page
        $scope.nextPage = function () {
          if ($scope.currentPage < Math.ceil($scope.filteredDocument.length / $scope.itemsPerPage)) {
            $scope.currentPage++;
            $scope.updatePagedDocument();
          }
        };

        // Get page numbers for pagination
        $scope.getPageNumbers = function () {
          return Array.from({ length: Math.ceil($scope.filteredDocument.length / $scope.itemsPerPage) }, (_, i) => i + 1);
        };
      });
</script>

</body>

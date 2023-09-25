<?php
/*
Template Name: Vacancy
 */


?>

<?php
get_header(); 

function get_category_ID( $cat_name ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
	$cat = get_term_by( 'name', $cat_name, 'category' );

	if ( $cat ) {
		return $cat->term_id;
	}

	return 0;
}

$category_name = 'vacancy'; // Ensure this matches the exact category name.
$category_id = get_category_ID($category_name);
?>



<body ng-controller="VacancyController">
  <main>
    <section class="cine-header">
      <div class="page-banner">
        <div class="page-banner-title"><?php echo __('Vacancy', 'srft-theme' ); ?></div>
      </div>
    </section>

    <section class="section-home">
      <div class="container" style="width: 1170px;">
        <h2 class="page-header-text" style="padding-left: 0; text-align: center;"><?php echo __('Vacancy List', 'srft-theme' ); ?></h2>
        <div ng-app="myApp">
          <div ng-controller="VacancyController">
            <p style="padding: 15px;">
              From date: <input type="date" ng-model="fromDate" ng-change="applyFilters()">
              To date: <input type="date" ng-model="toDate" ng-change="applyFilters()">
              <input type="text" ng-model="filterField" placeholder="Search by keyword" ng-change="applyFilters()">
              <!-- Add a Reset button to clear filters -->
              <button ng-click="resetFilters()"><?php echo __('Reset', 'srft-theme' ); ?></button>
            </p>
            <div class="wrapper">
              <div class="Rtable Rtable--5cols Rtable--collapse">
                <div class="Rtable-row Rtable-row--head">
                  <div class="Rtable-cell slno-cell column-heading"><?php echo __('SL.No.', 'srft-theme' ); ?></div>
                  <div class="Rtable-cell id-cell column-heading"><?php echo __('Recruitment ID', 'srft-theme' ); ?></div>
                  <div class="Rtable-cell topic-cell column-heading"><?php echo __('Recruitment for', 'srft-theme' ); ?></div>
                  <div class="Rtable-cell date-cell column-heading"><?php echo __('Publish Date', 'srft-theme' ); ?></div>
                  <div class="Rtable-cell access-link-cell column-heading"><?php echo __('Access Link', 'srft-theme' ); ?></div>
                </div>

                <div class="Rtable-row" ng-repeat="vacancy in pagedVacancy">
                  <div class="Rtable-cell slno-cell">
                    <div class="Rtable-cell--content date-content"><span class="webinar-date">{{$index+1 }}</span></div>
                  </div>
                  <div class="Rtable-cell id-cell">
                    <div class="Rtable-cell--content title-content">{{ vacancy.ID }}</div>
                  </div>
                  <div class="Rtable-cell topic-cell">
                    <div class="Rtable-cell--content title-content">{{ vacancy.title }}</div>
                  </div>
                  <div class="Rtable-cell date-cell">
                    <div class="Rtable-cell--content date-content"><span class="webinar-date">{{ vacancy.subdate | date:'dd-MM-yyyy' }}</span></div>
                  </div>
                  <div class="Rtable-cell access-link-cell">
                    <div class="Rtable-cell--content access-link-content"><a href="{{vacancy.link}}"><i class="ion-link"></i> Visit</a></div>
                  </div>
                </div>
              </div>
              <!-- Use a CSS grid for layout -->
            </div>

            <!-- Pagination -->
            <ul class="pagination">
  <li ng-class="{ 'disabled': currentPage === 1 }">
    <a href="#" ng-click="firstPage()"><i class="fas fa-step-backward"  style="color: #8b5b2b;"></i></a>
  </li>
  <li ng-class="{ 'disabled': currentPage === 1 }">
    <a href="#" ng-click="prevPage()"><i class="fas fa-chevron-left"  style="color: #8b5b2b;"></i></a>
  </li>
  <li ng-repeat="page in getPageNumbers()" ng-class="{ 'active': currentPage === page }">
    <a href="#" ng-click="setPage(page)">{{ page }}</a>
  </li>
  <li ng-class="{ 'disabled': currentPage === totalPages }">
    <a href="#" ng-click="nextPage()"><i class="fas fa-chevron-right"  style="color: #8b5b2b;"></i></a>
  </li>
  <li ng-class="{ 'disabled': currentPage === totalPages }">
    <a href="#" ng-click="lastPage()"><i class="fas fa-step-forward"  style="color: #8b5b2b;"></i></a>
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
      .controller('VacancyController', function ($scope, $http, $filter) {
        // Initialize the tenderList
        $scope.vacancyList = [];
        $scope.filteredVacancy = [];
        $scope.pagedVacancy = [];
        $scope.filterField = '';
        $scope.fromDate = '';
        $scope.toDate = '';
        $scope.itemsPerPage = 2;
        $scope.currentPage = 1;

        // Fetch the data
        $http.get(siteURL+'wp-json/wp/v2/posts?categories='+ categoryID)
          .then(function (response) {
            $scope.vacancyList = response.data.map(function (post) {
              return {
                title: post.title.rendered || '',
                link: post.link,
                ID: post.id,
                subdate: post.date // Keep it as is
              };
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
</body>
</html>
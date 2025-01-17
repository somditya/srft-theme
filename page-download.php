<?php
/*
Template Name: Downloads

 */

get_header(); 

function get_category_ID( $cat_name ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
	$cat = get_term_by( 'name', $cat_name, 'category' );

	if ( $cat ) {
		return $cat->term_id;
	}

	return 0;
}

$category_name = 'document'; // Ensure this matches the exact category name.
$category_id = get_category_ID($category_name);
?>


<?php
/**
 * Template Name: Document Filter Page
 */
get_header();
?>

<div ng-app="myApp" ng-controller="DocumentController">
    <div style="padding: 15px;">
        <label for="filterField"><?php echo __('Search by keyword: ', 'srft-theme'); ?></label>
        <input 
            type="text" 
            id="filterField" 
            ng-model="filterField" 
            placeholder="<?php echo __('Search by keyword', 'srft-theme'); ?>" 
            ng-change="applyFilters()">
        
        <label for="categoryFilter"><?php echo __('Select Category: ', 'srft-theme'); ?></label>
        <select 
            id="categoryFilter" 
            ng-model="selectedCategory" 
            ng-change="applyFilters()">
            <option value=""><?php echo __('All Categories', 'srft-theme'); ?></option>
            <option ng-repeat="category in categoryList" value="{{category.id}}">
                {{category.name}}
            </option>
        </select>
        
        <button ng-click="resetFilters()"><?php echo __('Reset', 'srft-theme'); ?></button>
    </div>

    <div>
        <ul>
            <li ng-repeat="doc in pagedDocuments">
                <h3>{{ doc.title }}</h3>
                <p><?php echo __('Category: ', 'srft-theme'); ?> {{ doc.category }}</p>
                <p>
                    <a ng-href="{{ doc.file.url }}" target="_blank">
                        <?php echo __('Download: ', 'srft-theme'); ?> {{ doc.file.title }} ({{ doc.file.size }} MB)
                    </a>
                </p>
            </li>
        </ul>
    </div>

    <div class="pagination" style="padding: 10px;">
        <button ng-disabled="currentPage === 1" ng-click="setPage(currentPage - 1)">
            <?php echo __('Previous', 'srft-theme'); ?>
        </button>
        <button 
            ng-repeat="page in getPageNumbers()" 
            ng-class="{active: currentPage === page}" 
            ng-click="setPage(page)">
            {{ page }}
        </button>
        <button ng-disabled="currentPage === getTotalPages()" ng-click="setPage(currentPage + 1)">
            <?php echo __('Next', 'srft-theme'); ?>
        </button>
    </div>
</div>

<script>
angular.module('myApp', [])
    .controller('DocumentController', function ($scope, $http) {
        $scope.documentList = [];
        $scope.filteredDocuments = [];
        $scope.pagedDocuments = [];
        $scope.categoryList = [];
        $scope.selectedCategory = '';
        $scope.filterField = '';
        $scope.itemsPerPage = 10;
        $scope.currentPage = 1;

        const siteURL = '<?php echo site_url(); ?>';

        // Fetch documents
        $http.get(siteURL + 'wp-json/wp/v2/document?per_page=100')
            .then(function (response) {
                $scope.documentList = response.data.map(function (doc) {
                    return {
                        title: doc.title.rendered,
                        category: doc.category,
                        category_id: doc.categories[0],
                        file: {
                            url: doc.acf['document'].url,
                            title: doc.acf['document'].title,
                            size: (doc.acf['document'].filesize / 1048576).toFixed(2)
                        }
                    };
                });
                $scope.updateFilteredDocuments();
            });

        // Fetch categories
        $http.get(siteURL + 'wp-json/wp/v2/categories')
            .then(function (response) {
                $scope.categoryList = response.data.map(function (cat) {
                    return { id: cat.id, name: cat.name };
                });
            });

        // Update filtered documents
        $scope.updateFilteredDocuments = function () {
            $scope.filteredDocuments = $scope.documentList.filter(function (doc) {
                return (!$scope.filterField || doc.title.toLowerCase().includes($scope.filterField.toLowerCase())) &&
                    (!$scope.selectedCategory || doc.category_id == $scope.selectedCategory);
            });
            $scope.updatePagedDocuments();
        };

        // Update paged documents
        $scope.updatePagedDocuments = function () {
            const start = ($scope.currentPage - 1) * $scope.itemsPerPage;
            $scope.pagedDocuments = $scope.filteredDocuments.slice(start, start + $scope.itemsPerPage);
        };

        // Set page
        $scope.setPage = function (page) {
            if (page >= 1 && page <= $scope.getTotalPages()) {
                $scope.currentPage = page;
                $scope.updatePagedDocuments();
            }
        };

        // Get total pages
        $scope.getTotalPages = function () {
            return Math.ceil($scope.filteredDocuments.length / $scope.itemsPerPage);
        };

        // Get page numbers
        $scope.getPageNumbers = function () {
            const pages = [];
            for (let i = 1; i <= $scope.getTotalPages(); i++) {
                pages.push(i);
            }
            return pages;
        };

        // Reset filters
        $scope.resetFilters = function () {
            $scope.filterField = '';
            $scope.selectedCategory = '';
            $scope.updateFilteredDocuments();
        };
    });
</script>

<?php get_footer(); ?>

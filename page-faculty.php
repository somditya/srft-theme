<?php
/*
Template Name: Faculty

 */


?>

<?php
get_header(); 
$current_language = get_locale();

function get_category_ID( $cat_name ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
	$cat = get_term_by( 'name', $cat_name, 'category' );

	if ( $cat ) {
		return $cat->term_id;
	}

	return 0;
}

$category_name = 'faculty'; // Ensure this matches the exact category name.
$category_id = get_category_ID($category_name);
?>
<div data-scroll-container>
<body ng-controller="FacultyController">
    <main>
      <body>
      <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
        <div class="page-banner">
          <div class="page-banner-title"><?php echo __('Faculty', 'srft-theme' ); ?></div>
      </section>

      <section class="section-home">
        <div class="container">
        <div>      
        <?php
            if ( function_exists('yoast_breadcrumb') ) {
          yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
        }
        ?>
    </div>
          <h2 id="skip-to-content" class="page-header-text" style="padding-left: 0; text-align: center; margin-top: 20px;"><?php echo __('Meet our Faculty & Academic Support Staff', 'srft-theme' ); ?></h2>
          <div ng-app="myApp" ng-controller="FacultyController" style="margin-top: 4.5rem;">
            <!-- Filter options -->
            <label for="filter"><?php echo __('Programmes:', 'srft-theme' ); ?></label>
            <select class="filter" ng-model="filterField">
                <option value=""><?php echo __('All', 'srft-theme' ); ?></option>
                <option value="<?php echo __('Animation Cinema', 'srft-theme' ); ?>"><?php echo __('Animation Cinema', 'srft-theme' ); ?></option>
                <option value="<?php echo __('Cinematography', 'srft-theme' ); ?>"><?php echo __('Cinematography', 'srft-theme' ); ?></option>
                <option value="<?php echo __('Direction & Screenplay Writing', 'srft-theme' ); ?>"><?php echo __('Direction & Screenplay Writing', 'srft-theme' ); ?></option>
                <option value="<?php echo __('Editing', 'srft-theme' ); ?>"><?php echo __('Editing', 'srft-theme' ); ?></option>
                <option value="<?php echo __('Producing for Film & Television', 'srft-theme' ); ?>"><?php echo __('Producing for Film & Television', 'srft-theme' ); ?></option>
                <option value="<?php echo __('Sound Recording & Design', 'srft-theme' ); ?>"><?php echo __('Sound Recording & Design', 'srft-theme' ); ?></option>
                <option value="<?php echo __('EDM Management', 'srft-theme' ); ?>"><?php echo __('EDM Management', 'srft-theme' ); ?></option>
                <option value="<?php echo __('Cinematography for EDM', 'srft-theme' ); ?>"><?php echo __('Cinematography for EDM', 'srft-theme' ); ?></option>
                <option value="<?php echo __('Direction & Producing for EDM', 'srft-theme' ); ?>"><?php echo __('Direction & Producing for EDM', 'srft-theme' ); ?></option>
                <option value="<?php echo __('Editing for EDM', 'srft-theme' ); ?>"><?php echo __('Editing for EDM', 'srft-theme' ); ?></option>
                <option value="<?php echo __('Sound for EDM', 'srft-theme' ); ?>"><?php echo __('Sound for EDM', 'srft-theme' ); ?></option>
                <option value="<?php echo __('Writing for EDM', 'srft-theme' ); ?>"><?php echo __('Writing for EDM', 'srft-theme' ); ?></option>
            </select>
        
            <!--<ul class="alphabet">
              <li ng-class="{ 'active': !currentLetter }" ng-click="filterByLetter('')">
                <a href="" ng-class="{ 'all-option': true }">All</a>
            </li>
              <li ng-repeat="letter in alphabet" ng-class="{ 'active': letter === currentLetter }" ng-click="filterByLetter(letter)">
                  <a href="">{{ letter }}</a>
              </li>
              
          </ul>-->
      
            <!-- Faculty grid using Flexbox -->
            <div class="faculty-grid">
            <div class="loading-overlay" ng-show="isLoading">
            <div class="spinner"></div>
            </div>
            <div class="faculty-card" ng-repeat="faculty in filteredFaculty.slice((currentPage - 1) * itemsPerPage, currentPage * itemsPerPage)">
                <img ng-src="{{ faculty.image }}" alt="{{ faculty.name }}" style="filter: grayscale(100%);" class="faculty-image">
                <h2><a href="{{ faculty.link }}">{{faculty.name }}</a></h2>
                <p>{{faculty.designation }}</p>
                <p>{{faculty.department}}</p>
            </div>
            
          </div>
          
            <!-- Pagination -->
            <!-- Pagination -->
<ul class="pagination">
  <li ng-class="{ 'disabled': currentPage === 1 }">
    <a href="#" ng-click="firstPage()" aria-label="<?php echo __('First Page', 'srft-theme'); ?>">
      <i class="fas fa-step-backward" style="color: #8b5b2b;"></i>
    </a>
  </li>
  <li ng-class="{ 'disabled': currentPage === 1 }">
    <a href="#" ng-click="prevPage()" aria-label="<?php echo __('Previous Page', 'srft-theme'); ?>">
      <i class="fas fa-chevron-left" style="color: #8b5b2b;"></i>
    </a>
  </li>
  <li ng-repeat="page in getPageNumbers()" ng-class="{ 'active': currentPage === page }">
    <a href="#" ng-click="setPage(page)">{{ page }}</a>
  </li>
  <li ng-class="{ 'disabled': currentPage === totalPages }">
    <a href="#" ng-click="nextPage()" aria-label="<?php echo __('Next Page', 'srft-theme'); ?>">
      <i class="fas fa-chevron-right" style="color: #8b5b2b;"></i>
    </a>
  </li>
  <li ng-class="{ 'disabled': currentPage === totalPages }">
    <a href="#" ng-click="lastPage()" aria-label="<?php echo __('Last Page', 'srft-theme'); ?>">
      <i class="fas fa-step-forward" style="color: #8b5b2b;"></i>
    </a>
  </li>
</ul>

        </div>
        </div>
  
       
        <script>
             var categoryID = <?php echo json_encode($category_id); ?>;
             var siteURL = '<?php echo esc_url(site_url('/')); ?>';
             
              var language = '<?php echo $current_language; ?>';
              var alphabet;

              if (language === 'en_US') {
                alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('');
              } else if (language === 'hi_IN') {
                alphabet = 'अआइईउऊऋएऐओऔकखगघङचछजझञटठडढणतथदधनपफबभमयरलवशषसह'.split('');
              } else {
              alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split(''); // Fallback to English
              } 
             
    angular.module('myApp', [])
.controller('FacultyController', function($scope, $http) {
  $scope.isLoading = true; 
    // Initialize the faculty data (replace this with your actual data)
    //$http.get(siteURL+'wp-json/wp/v2/posts?categories='+ categoryID + '&per_page=100') // Adjust 'per_page' as needed
    $http.get(siteURL+'wp-json/wp/v2/faculty?categories='+ categoryID + '&per_page=100') // Adjust 'per_page' as needed
    .then(function (response) {
        console.log('HTTP request success');
        // Map the retrieved data to the format you want in $scope.facultyList
        $scope.facultyList = response.data.map(function (post) {
            var postLink = post.link;
// Append the background image URL as a query parameter to the post link
      var backgroundImageUrl = '<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>';
      var linkWithImage = postLink + '?bg_image=' + encodeURIComponent(backgroundImageUrl);
            return {
                name: post.title.rendered || '',
                //link: linkWithImage,
                //featured_media: post.featured_media,
                link: postLink,
                image: post.acf['Faculty-Image'],
                //designation: post.Designation,
                designation: post.acf['Faculty-Designation'],
                //department: post.Department
                //department: post.acf['Department']
                department: post.acf['Faculty-Department'],
                category: post.acf['Faculty-Category'] ? parseInt(post.acf['Faculty-Category']) : 9999
            };
        });

        /*angular.forEach($scope.facultyList, function(faculty) {
            if (faculty.featured_media) {
                $http.get(siteURL+'wp-json/wp/v2/media/' + faculty.featured_media)
                    .then(function(imageResponse) {
                        faculty.image = imageResponse.data.source_url;
                        console.log('Image Loaded for:', faculty.name);
                    })
                    .catch(function(error) {
                        console.error('Error fetching featured image:', error);
                    });
            }
        });*/

        console.log('Faculty List:', $scope.facultyList);
  // Initialize $scope.filteredFaculty as an empty array here
  $scope.filteredFaculty = [];
        // Call the updateFilteredFaculty function after loading faculty data
        $scope.$watchGroup(['filterField', 'currentLetter'], function() {
    console.log('Filter changed:', $scope.filterField, $scope.currentLetter);
    $scope.currentPage = 1; // Reset to the first page when the filter changes
    updateFilteredFaculty();
    $scope.isLoading = false;
});
        
    })
    .catch(function (error) {
        console.error('Error fetching faculty data:', error);
    });

    // Pagination settings
    $scope.currentPage = 1;
    $scope.itemsPerPage = 12;  // Adjust as needed

    // Filter options
    $scope.filterField = '';
    $scope.currentLetter = '';

    $scope.setPage = function(pageNumber) {
        $scope.currentPage = pageNumber;
    };

    // Function to filter faculty based on department
    $scope.filterFaculty = function(faculty) {
    const departmentMatch = !$scope.filterField || faculty.department === $scope.filterField;
    const letterMatch = !$scope.currentLetter || faculty.name.charAt(0).toUpperCase() === $scope.currentLetter;

    console.log('Field Match:', departmentMatch);
    console.log('Letter Match:', letterMatch);

    return departmentMatch && letterMatch;
};

    // Initialize $scope.filteredFaculty as an empty array
    $scope.filteredFaculty = [];

    // Function to get the total number of pages
    $scope.getTotalPages = function() {
    // Ensure $scope.filteredFaculty is defined before accessing its length
    if ($scope.filteredFaculty) {
        return Math.ceil($scope.filteredFaculty.length / $scope.itemsPerPage);
    }
    return 0; // Default to 0 if filteredFaculty is undefined
};

    // Function to generate an array of page numbers for pagination
    $scope.getPageNumbers = function() {
        const pageCount = $scope.getTotalPages();
        return new Array(pageCount).fill().map((_, i) => i + 1);
    };

    // Alphabet links data
    //$scope.alphabet = ('ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split(''));

    // Function to filter faculty by starting letter
    $scope.filterByLetter = function(letter) {
            $scope.currentLetter = letter;
        };


    // Function to set the current page
    $scope.setPage = function (page) {
          if (page >= 1 && page <= $scope.getTotalPages()) {
            $scope.currentPage = page;
            $scope.updateilteredFaculty();
          }
        };

        // Function to go to the previous page
        $scope.prevPage = function () {
          if ($scope.currentPage > 1) {
            $scope.currentPage--;
            $scope.updateilteredFaculty();
          }
        };

        // Function to go to the next page
        $scope.nextPage = function () {
          if ($scope.currentPage < $scope.getTotalPages()) {
            $scope.currentPage++;
            $scope.updateilteredFaculty();
          }
        };

        $scope.firstPage = function () {
  $scope.currentPage = 1;
  $scope.updateilteredFaculty();
};

$scope.lastPage = function () {
  $scope.currentPage = $scope.getTotalPages();
  $scope.updateilteredFaculty();
};
        // Initialize pagedTender    
    // Helper function to update the filtered faculty data based on pagination and filtering
    function updateFilteredFaculty() {
    $scope.filteredFaculty = $scope.facultyList.filter($scope.filterFaculty);

    if ($scope.filterField) {
        // Sort by Faculty-Category when a department is selected
        console.log('Sorting by Category');
        $scope.filteredFaculty.sort((a, b) => (a.category || 9999) - (b.category || 9999));
    } else {
        // Default sorting: Alphabetical
        console.log('Sorting Alphabetically');
        $scope.filteredFaculty.sort((a, b) => a.name.localeCompare(b.name));
    }

    // Reset pagination to first page when filtering changes
    $scope.currentPage = 1;
}

});

</script>
          
    </main>

    <?php get_footer();  ?>
</body>
</html>
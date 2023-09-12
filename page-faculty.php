<?php
/*
Template Name: Faculty

 */


?>

<?php
get_header(); 
?>

<body ng-controller="FacultyController">
    
    <main>
      <body>
      <section class="cine-header">
        <div class="page-banner">
          <div class="page-banner-title">Faculty</div>
      </section>

      <section class="section-home">
        <div class="container" style="width: 1170px;">
          <h2 class="section-intro-header-text" style="padding-left: 0; ">Meet our Faculty</h2>
          <div ng-app="myApp" ng-controller="FacultyController">
            <!-- Filter options -->
            <label for="filter">Programmes:</label>
            <select class="filter" ng-model="filterField">
                <option value="">All</option>
                <option value="Animation Cinema">Animation Cinema</option>
                <option value="Cinematography">Cinematography</option>
                <option value="DirSPW">Direction & Screenplay Writing</option>
                <option value="Editing">Editing</option>
                <option value="PFT">Producing for Film & Television</option>
                <option value="SRD">Sound Recording & Design</option>
            </select>
        
            <ul class="alphabet">
              <li ng-class="{ 'active': !currentLetter }" ng-click="filterByLetter('')">
                <a href="" ng-class="{ 'all-option': true }">All</a>
            </li>
              <li ng-repeat="letter in alphabet" ng-class="{ 'active': letter === currentLetter }" ng-click="filterByLetter(letter)">
                  <a href="">{{ letter }}</a>
              </li>
              
          </ul>
      
            <!-- Faculty grid using Flexbox -->
            <div class="faculty-grid">
            <div class="faculty-card" ng-repeat="faculty in filteredFaculty">
                <img ng-src="{{ faculty.image }}" alt="{{ faculty.name }}" class="faculty-image">
                <h2><a href="{{ faculty.link }}">{{faculty.name }}</a></h2>
                <p>{{faculty.designation }}</p>
            </div>
            
          </div>
          
            <!-- Pagination -->
            <ul class="pagination">
              <li ng-repeat="page in getPageNumbers()" ng-class="{ 'active': page === currentPage }" ng-click="setPage(page)">
                  <a href="">{{ page }}</a>
              </li>
             
          </ul>
        </div>
        </div>
  
       
        <script>
    angular.module('myApp', [])
.controller('FacultyController', function($scope, $http) {
    // Initialize the faculty data (replace this with your actual data)
    $http.get('http://localhost/wordpress/wp-json/wp/v2/posts?categories=5')
    .then(function (response) {
        // Map the retrieved data to the format you want in $scope.facultyList
        $scope.facultyList = response.data.map(function (post) {
            return {
                name: post.title.rendered || '',
                link: post.link,
                featured_media: post.featured_media,
                designation: post.Designation,
                department: post.Department
            };
        });

        angular.forEach($scope.facultyList, function(faculty) {
            if (faculty.featured_media) {
                $http.get('http://localhost/wordpress/wp-json/wp/v2/media/' + faculty.featured_media)
                    .then(function(imageResponse) {
                        faculty.image = imageResponse.data.source_url;
                        console.log('Image Loaded for:', faculty.name);
                    })
                    .catch(function(error) {
                        console.error('Error fetching featured image:', error);
                    });
            }
        });

        console.log('Faculty List:', $scope.facultyList);
  // Initialize $scope.filteredFaculty as an empty array here
  $scope.filteredFaculty = [];
        // Call the updateFilteredFaculty function after loading faculty data
        $scope.$watchGroup(['filterField', 'currentLetter'], function() {
    console.log('Filter changed:', $scope.filterField, $scope.currentLetter);
    $scope.currentPage = 1; // Reset to the first page when the filter changes
    updateFilteredFaculty();
});
        
    })
    .catch(function (error) {
        console.error('Error fetching faculty data:', error);
    });

    // Pagination settings
    $scope.currentPage = 1;
    $scope.itemsPerPage = 16;

    // Filter options
    $scope.filterField = '';
    $scope.currentLetter = '';

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
    $scope.alphabet = ('ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split(''));

    // Function to filter faculty by starting letter
    $scope.filterByLetter = function(letter) {
            $scope.currentLetter = letter;
        };


    // Helper function to update the filtered faculty data based on pagination and filtering
    function updateFilteredFaculty() {
    $scope.filteredFaculty = $scope.facultyList.filter($scope.filterFaculty);

    // Sort the filtered faculty alphabetically by name
    $scope.filteredFaculty.sort(function (a, b) {
        return a.name.localeCompare(b.name);
    });

    // Update the currentPage to 1 when filtering changes
    $scope.currentPage = 1;
}
});


</script>
          
    </main>


        <?php
get_footer(); 
?>
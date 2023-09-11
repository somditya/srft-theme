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
            <div class="faculty-card" ng-repeat="faculty in facultyList | filter:filterFaculty | limitTo: itemsPerPage : (currentPage - 1) * itemsPerPage">
                <img ng-src="{{ faculty.image }}" alt="{{ faculty.name }}" class="faculty-image">
                <h2><a href="#">{{faculty.name }}</a></h2>
                <p>{{ faculty.designation }}</p>
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
              $http.get('http://localhost/wordpress/wp-json/faculty/v2/posts?categories='+5) // Replace with your API endpoint
            .then(function (response) {
                // Map the retrieved data to the format you want in $scope.facultyList
                $scope.facultyList = response.data.map(function (post) {
                    return {
                        name: post.title.rendered,
                        description: post.acf.description, // Replace with the actual field name for description
                        field: post.acf.field, // Replace with the actual field name for field
                        image: post.acf.image.url, // Replace with the actual field name for image
                        designation: post.Designation // Replace with the actual field name for Designation
                    };
                });
            })
            .catch(function (error) {
                console.error('Error fetching faculty data:', error);
            })
          
              // Pagination settings
    $scope.currentPage = 1;
    $scope.itemsPerPage = 16; // You can adjust the number of items per page

    // Filter options
    $scope.filterField = '';
    $scope.currentLetter = '';
    // Function to set the current page
    $scope.setPage = function(pageNumber) {
        $scope.currentPage = pageNumber;
    };

    // Function to filter faculty based on field
    $scope.filterFaculty = function(faculty) {
                return (!$scope.filterField || faculty.field === $scope.filterField) &&
                       (!$scope.currentLetter || faculty.name.charAt(0).toUpperCase() === $scope.currentLetter);
            };

    // Helper function to get the filtered and paginated faculty data
    $scope.getPaginatedFaculty = function() {
        return $scope.filteredFaculty.slice(($scope.currentPage - 1) * $scope.itemsPerPage, $scope.currentPage * $scope.itemsPerPage);
    };

    // Function to update the filtered faculty data based on pagination and filtering
    function updateFilteredFaculty() {
        $scope.filteredFaculty = $scope.facultyList.filter($scope.filterFaculty);
    }

    // Function to update the filtered faculty data when filterField changes
    $scope.$watchGroup(['filterField', 'currentLetter'], function() {
                $scope.currentPage = 1; // Reset to the first page when the filter changes
                updateFilteredFaculty();
            });

    // Function to get the total number of pages
    $scope.getTotalPages = function() {
        return Math.ceil($scope.filteredFaculty.length / $scope.itemsPerPage);
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
    $scope.currentLetter = letter === 'All' ? '' : letter;
}; 

    // Function to update the filtered faculty data on page load
    updateFilteredFaculty();
});
          </script>
          
    </main>


        <?php
get_footer(); 
?>
<?php
/*
Template Name: Tender

 */


?>

<?php
get_header(); 
?>
<head>
<style>
        /* Define a CSS grid layout */
        .tender-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* Four columns for each field */
            grid-gap: 20px; /* Gap between grid items */
        }

        /* Style labels */
        .label {
            font-weight: bold;
        }

        /* Style grid items */
        .tender-item {
            border: 1px solid #ccc;
            padding: 10px;
        }
    </style>
</head>

<body ng-controller="TenderController">
<main>


<section class="cine-header">
        <div class="page-banner">
            <div class="page-banner-title">Tender</div>
        </div>
    </section>

    <section class="section-home">
        <div class="container" style="width: 1170px;">
            <h2 class="section-intro-header-text" style="padding-left: 0;">Tender List</h2>

            <div ng-app="myApp">
                <div ng-controller="TenderController">

                    <!-- Use a CSS grid for layout -->
                    <div class="tender-grid">
                       
                        <div ng-repeat="tender in tenderList" class="tender-item">{{ tender.title }}</div>

                        
                        <div ng-repeat="tender in tenderList" class="tender-item">{{ tender.ID }}</div>

                       
                        <div ng-repeat="tender in tenderList" class="tender-item">{{ tender.subdate }}</div>

                       
                        <div ng-repeat="tender in tenderList" class="tender-item"><a href="{{ tender.link }}">Visit</a></div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script>
        angular.module('myApp', [])
            .controller('TenderController', function($scope, $http) {
                // Initialize the tenderList
                $scope.tenderList = [];

                $http.get('http://localhost/wordpress/wp-json/wp/v2/posts?categories=45')
                    .then(function(response) {
                        $scope.tenderList = response.data.map(function(post) {
                            return {
                                title: post.title.rendered || '',
                                link: post.link,
                                ID: post.id,
                                subdate: post.date
                            };
                        });
                    })
                    .catch(function(error) {
                        console.error('Error fetching tender data:', error);
                    });
            });
    </script>
</body>
</html>
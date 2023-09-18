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
                <div class="wrapper">
  <div class="Rtable Rtable--5cols Rtable--collapse">
    <div class="Rtable-row Rtable-row--head">
      <div class="Rtable-cell date-cell column-heading">SL.No.</div>
      <div class="Rtable-cell topic-cell column-heading">Tender ID</div>
      <div class="Rtable-cell access-link-cell column-heading">Access Link</div>
      <div class="Rtable-cell replay-link-cell column-heading">Replay</div>
      <div class="Rtable-cell pdf-cell column-heading">Checklist</div>
    </div>

    <div class="Rtable-row" ng-repeat="tender in tenderList">
      <div class="Rtable-cell date-cell">
       
        <div class="Rtable-cell--content date-content"><span class="webinar-date">August 2nd, 2016</span><br />6:00 pm (CDT)</div>
      </div>
      <div class="Rtable-cell topic-cell">
        <div class="Rtable-cell--content title-content">{{ tender.title }}</div>
      </div>
      <div class="Rtable-cell access-link-cell">
        <div class="Rtable-cell--content access-link-content"><a href="#0"><i class="ion-link"></i></a></div>
      </div>
      <div class="Rtable-cell replay-link-cell">
        
        <div class="Rtable-cell--content replay-link-content"><a href="#0"><i class="ion-ios-videocam"></i></a></div>
      </div>
      <div class="Rtable-cell Rtable-cell--foot pdf-cell">
        <div class="Rtable-cell--content pdf-content"><a href="#0"><i class="ion-document-text"></i></a></div>
      </div>
    </div>    
  </div>
                    <!-- Use a CSS grid for layout -->
                   

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
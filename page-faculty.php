<?php
/*
 * Template Name: Faculty
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

$category_name = 'faculty';
$category_id   = get_category_ID( $category_name );

/*
 * Get the page banner image safely.
 */
$banner_image = get_the_post_thumbnail_url( get_the_ID(), 'large' );
?>

<div>

```
<main>

	<section
		class="cine-header"
		style="background-image: url('<?php echo esc_url( $banner_image ); ?>');"
	>
		<div class="page-banner">
			<h1 class="page-banner-title">
				<?php echo esc_html__( 'Faculty', 'srft-theme' ); ?>
			</h1>
		</div>
	</section>

	<section class="section-home">

		<div class="container" style="padding: 0 3.2rem;">

			<div class="container-aligned">

				<div class="breadcrumbs-wrapper">

					<?php
					if ( function_exists( 'yoast_breadcrumb' ) ) {
						yoast_breadcrumb(
							'<nav aria-label="breadcrumbs" id="breadcrumbs">',
							'</nav>'
						);
					}
					?>

				</div>

			</div>

			<h2
				id="skip-to-content"
				class="page-header-text"
				style="padding-left: 0; text-align: center; margin-top: 20px;"
			>
				<?php
				echo esc_html__(
					'Meet our Faculty & Academic Support Staff',
					'srft-theme'
				);
				?>
			</h2>

			<div
				id="faculty-app"
				style="margin-top: 4.5rem;"
			>

				<!-- Filter options -->
				<label for="faculty-filter">
					<?php echo esc_html__( 'Programmes:', 'srft-theme' ); ?>
				</label>

				<select
					id="faculty-filter"
					class="filter"
				>
					<option value="">
						<?php echo esc_html__( 'All', 'srft-theme' ); ?>
					</option>

					<option value="<?php echo esc_attr__( 'Animation Cinema', 'srft-theme' ); ?>">
						<?php echo esc_html__( 'Animation Cinema', 'srft-theme' ); ?>
					</option>

					<option value="<?php echo esc_attr__( 'Cinematography', 'srft-theme' ); ?>">
						<?php echo esc_html__( 'Cinematography', 'srft-theme' ); ?>
					</option>

					<option value="<?php echo esc_attr__( 'Direction & Screenplay Writing', 'srft-theme' ); ?>">
						<?php echo esc_html__( 'Direction & Screenplay Writing', 'srft-theme' ); ?>
					</option>

					<option value="<?php echo esc_attr__( 'Editing', 'srft-theme' ); ?>">
						<?php echo esc_html__( 'Editing', 'srft-theme' ); ?>
					</option>

					<option value="<?php echo esc_attr__( 'Producing for Film & Television', 'srft-theme' ); ?>">
						<?php echo esc_html__( 'Producing for Film & Television', 'srft-theme' ); ?>
					</option>

					<option value="<?php echo esc_attr__( 'Sound Recording & Design', 'srft-theme' ); ?>">
						<?php echo esc_html__( 'Sound Recording & Design', 'srft-theme' ); ?>
					</option>

					<option value="<?php echo esc_attr__( 'EDM Management', 'srft-theme' ); ?>">
						<?php echo esc_html__( 'EDM Management', 'srft-theme' ); ?>
					</option>

					<option value="<?php echo esc_attr__( 'Cinematography for EDM', 'srft-theme' ); ?>">
						<?php echo esc_html__( 'Cinematography for EDM', 'srft-theme' ); ?>
					</option>

					<option value="<?php echo esc_attr__( 'Direction & Producing for EDM', 'srft-theme' ); ?>">
						<?php echo esc_html__( 'Direction & Producing for EDM', 'srft-theme' ); ?>
					</option>

					<option value="<?php echo esc_attr__( 'Editing for EDM', 'srft-theme' ); ?>">
						<?php echo esc_html__( 'Editing for EDM', 'srft-theme' ); ?>
					</option>

					<option value="<?php echo esc_attr__( 'Sound for EDM', 'srft-theme' ); ?>">
						<?php echo esc_html__( 'Sound for EDM', 'srft-theme' ); ?>
					</option>

					<option value="<?php echo esc_attr__( 'Writing for EDM', 'srft-theme' ); ?>">
						<?php echo esc_html__( 'Writing for EDM', 'srft-theme' ); ?>
					</option>
				</select>

				<!-- Faculty grid -->
				<ul
					id="faculty-grid"
					class="faculty-grid"
					role="list"
					aria-label="<?php echo esc_attr__( 'Faculty profiles', 'srft-theme' ); ?>"
				>

					<!-- Loading overlay -->
					<div
						id="faculty-loading"
						class="loading-overlay"
						aria-live="polite"
						aria-label="<?php echo esc_attr__( 'Loading faculty', 'srft-theme' ); ?>"
					>
						<div
							class="spinner"
							aria-hidden="true"
						></div>
					</div>

				</ul>

				<!-- No results message -->
				<p
					id="faculty-no-results"
					class="faculty-no-results"
					style="display: none;"
				>
					<?php echo esc_html__( 'No faculty members found.', 'srft-theme' ); ?>
				</p>

				<!-- Pagination -->
				<nav
					id="faculty-pagination"
					aria-label="<?php echo esc_attr__( 'Pagination', 'srft-theme' ); ?>"
				>

					<ul class="pagination">

						<!-- First Page -->
						<li id="faculty-first-page">
							<a
								href="#"
								data-page-action="first"
								aria-label="<?php echo esc_attr__( 'Go to first page', 'srft-theme' ); ?>"
							>
								<span class="sr-only">
									<?php echo esc_html__( 'First Page', 'srft-theme' ); ?>
								</span>

								<i
									class="fas fa-step-backward"
									aria-hidden="true"
									style="color: #8b5b2b;"
								></i>
							</a>
						</li>

						<!-- Previous Page -->
						<li id="faculty-prev-page">
							<a
								href="#"
								data-page-action="previous"
								aria-label="<?php echo esc_attr__( 'Go to previous page', 'srft-theme' ); ?>"
							>
								<span class="sr-only">
									<?php echo esc_html__( 'Previous Page', 'srft-theme' ); ?>
								</span>

								<i
									class="fas fa-chevron-left"
									aria-hidden="true"
									style="color: #8b5b2b;"
								></i>
							</a>
						</li>

						<!-- Page numbers -->
						<li id="faculty-page-numbers"></li>

						<!-- Next Page -->
						<li id="faculty-next-page">
							<a
								href="#"
								data-page-action="next"
								aria-label="<?php echo esc_attr__( 'Go to next page', 'srft-theme' ); ?>"
							>
								<span class="sr-only">
									<?php echo esc_html__( 'Next Page', 'srft-theme' ); ?>
								</span>

								<i
									class="fas fa-chevron-right"
									aria-hidden="true"
									style="color: #8b5b2b;"
								></i>
							</a>
						</li>

						<!-- Last Page -->
						<li id="faculty-last-page">
							<a
								href="#"
								data-page-action="last"
								aria-label="<?php echo esc_attr__( 'Go to last page', 'srft-theme' ); ?>"
							>
								<span class="sr-only">
									<?php echo esc_html__( 'Last Page', 'srft-theme' ); ?>
								</span>

								<i
									class="fas fa-step-forward"
									aria-hidden="true"
									style="color: #8b5b2b;"
								></i>
							</a>
						</li>

					</ul>

				</nav>

			</div>

		</div>

	</section>

</main>
```

</div>

<script>
(function () {
	'use strict';

	/*
	 * WordPress REST API configuration.
	 */
	const siteURL = <?php echo wp_json_encode( esc_url_raw( site_url( '/' ) ) ); ?>;
	const categoryID = <?php echo wp_json_encode( absint( $category_id ) ); ?>;
	const language = <?php echo wp_json_encode( $current_language ); ?>;

	const apiURL =
		siteURL +
		'wp-json/wp/v2/faculty?categories=' +
		encodeURIComponent(categoryID) +
		'&per_page=100';

	/*
	 * Configuration.
	 */
	const itemsPerPage = 15;

	/*
	 * DOM elements.
	 */
	const facultyGrid = document.getElementById('faculty-grid');
	const loadingOverlay = document.getElementById('faculty-loading');
	const filterSelect = document.getElementById('faculty-filter');
	const pagination = document.getElementById('faculty-pagination');
	const pageNumbers = document.getElementById('faculty-page-numbers');
	const noResults = document.getElementById('faculty-no-results');

	const firstPage = document.getElementById('faculty-first-page');
	const previousPage = document.getElementById('faculty-prev-page');
	const nextPage = document.getElementById('faculty-next-page');
	const lastPage = document.getElementById('faculty-last-page');

	/*
	 * Application state.
	 */
	let facultyList = [];
	let filteredFaculty = [];
	let currentPage = 1;
	let currentLetter = '';

	/*
	 * Alphabet.
	 *
	 * Kept here for future use if the alphabetical filter
	 * is enabled again.
	 */
	let alphabet;

	if (language === 'en_US') {

		alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('');

	} else if (language === 'hi_IN') {

		alphabet = 'अआइईउऊऋएऐओऔकखगघङचछजझञटठडढणतथदधनपफबभमयरलवशषसह'.split('');

	} else {

		alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('');

	}


	/*
	 * Escape HTML special characters.
	 *
	 * We use DOM text nodes instead of inserting API
	 * values through innerHTML.
	 */
	function createSafeText(text) {

		const node = document.createTextNode(
			text === null || text === undefined
				? ''
				: String(text)
		);

		return node;

	}


	/*
	 * Validate URL before using it in href/src.
	 *
	 * Only http and https URLs are accepted.
	 */
	function getSafeURL(value) {

		if (!value) {
			return '';
		}

		try {

			const url = new URL(value, window.location.origin);

			if (
				url.protocol === 'http:' ||
				url.protocol === 'https:'
			) {
				return url.href;
			}

		} catch (error) {

			console.warn('Invalid URL:', value);

		}

		return '';

	}


	/*
	 * Create a faculty card.
	 */
	function createFacultyCard(faculty) {

		const li = document.createElement('li');

		li.className = 'faculty-card';
		li.setAttribute('role', 'listitem');


		/*
		 * Faculty image.
		 */
		const imageURL = getSafeURL(faculty.image);

		if (imageURL) {

			const image = document.createElement('img');

			image.src = imageURL;
			image.alt = faculty.name || '';
			image.className = 'faculty-image';

			image.style.filter = 'grayscale(100%)';

			image.loading = 'lazy';

			li.appendChild(image);

		}


		/*
		 * Faculty name and link.
		 */
		const heading = document.createElement('h3');

		const linkURL = getSafeURL(faculty.link);

		if (linkURL) {

			const link = document.createElement('a');

			link.href = linkURL;
			link.appendChild(createSafeText(faculty.name));

			heading.appendChild(link);

		} else {

			heading.appendChild(
				createSafeText(faculty.name)
			);

		}

		li.appendChild(heading);


		/*
		 * Designation.
		 */
		const designation = document.createElement('p');

		designation.appendChild(
			createSafeText(faculty.designation)
		);

		li.appendChild(designation);


		/*
		 * Department.
		 */
		const department = document.createElement('p');

		department.appendChild(
			createSafeText(faculty.department)
		);

		li.appendChild(department);


		return li;

	}


	/*
	 * Render faculty cards for current page.
	 */
	function renderFaculty() {

		/*
		 * Remove existing faculty cards.
		 *
		 * Keep the loading overlay intact.
		 */
		const existingCards =
			facultyGrid.querySelectorAll('.faculty-card');

		existingCards.forEach(function (card) {
			card.remove();
		});


		const startIndex =
			(currentPage - 1) * itemsPerPage;

		const endIndex =
			startIndex + itemsPerPage;

		const currentFaculty =
			filteredFaculty.slice(startIndex, endIndex);


		/*
		 * No results.
		 */
		if (currentFaculty.length === 0) {

			noResults.style.display = 'block';

		} else {

			noResults.style.display = 'none';

		}


		/*
		 * Add faculty cards.
		 */
		currentFaculty.forEach(function (faculty) {

			const card = createFacultyCard(faculty);

			/*
			 * Insert before loading overlay.
			 */
			facultyGrid.insertBefore(
				card,
				loadingOverlay
			);

		});


		updatePagination();

	}


	/*
	 * Filter faculty.
	 */
	function updateFilteredFaculty() {

		const selectedDepartment =
			filterSelect.value;


		filteredFaculty =
			facultyList.filter(function (faculty) {

				const departmentMatch =
					!selectedDepartment ||
					faculty.department === selectedDepartment;


				const name =
					faculty.name || '';


				const letterMatch =
					!currentLetter ||
					name.charAt(0).toUpperCase() ===
					currentLetter;


				return departmentMatch && letterMatch;

			});


		/*
		 * Sort by Faculty Category when a programme
		 * is selected.
		 *
		 * Otherwise sort alphabetically.
		 */
		if (selectedDepartment) {

			filteredFaculty.sort(function (a, b) {

				return (
					(a.category || 9999) -
					(b.category || 9999)
				);

			});

		} else {

			filteredFaculty.sort(function (a, b) {

				return (a.name || '').localeCompare(
					b.name || '',
					undefined,
					{
						sensitivity: 'base'
					}
				);

			});

		}


		/*
		 * Always return to page 1 when filtering.
		 */
		currentPage = 1;

		renderFaculty();

	}


	/*
	 * Calculate total pages.
	 */
	function getTotalPages() {

		return Math.ceil(
			filteredFaculty.length / itemsPerPage
		);

	}


	/*
	 * Create pagination.
	 */
	function updatePagination() {

		const totalPages = getTotalPages();


		/*
		 * Hide pagination if only one page or no results.
		 */
		if (totalPages <= 1) {

			pagination.style.display = 'none';

			return;

		}


		pagination.style.display = 'block';


		/*
		 * Clear existing page numbers.
		 */
		pageNumbers.innerHTML = '';


		/*
		 * Generate page numbers.
		 */
		for (
			let page = 1;
			page <= totalPages;
			page++
		) {

			const li = document.createElement('li');

			if (currentPage === page) {
				li.classList.add('active');
			}


			const link = document.createElement('a');

			link.href = '#';

			link.dataset.page = page;

			link.setAttribute(
				'aria-label',
				'<?php echo esc_js( __( 'Go to page', 'srft-theme' ) ); ?> ' + page
			);


			if (currentPage === page) {

				link.setAttribute(
					'aria-current',
					'page'
				);

			}


			link.appendChild(
				createSafeText(page)
			);


			li.appendChild(link);

			pageNumbers.appendChild(li);

		}


		/*
		 * Update disabled state.
		 */
		setPaginationState(
			firstPage,
			currentPage === 1
		);

		setPaginationState(
			previousPage,
			currentPage === 1
		);

		setPaginationState(
			nextPage,
			currentPage === totalPages
		);

		setPaginationState(
			lastPage,
			currentPage === totalPages
		);

	}


	/*
	 * Enable/disable pagination controls.
	 */
	function setPaginationState(element, disabled) {

		if (disabled) {

			element.classList.add('disabled');

			const link = element.querySelector('a');

			if (link) {
				link.setAttribute(
					'aria-disabled',
					'true'
				);
			}

		} else {

			element.classList.remove('disabled');

			const link = element.querySelector('a');

			if (link) {
				link.removeAttribute(
					'aria-disabled'
				);
			}

		}

	}


	/*
	 * Change page.
	 */
	function setPage(page) {

		const totalPages = getTotalPages();

		if (
			page < 1 ||
			page > totalPages
		) {
			return;
		}

		currentPage = page;

		renderFaculty();

		/*
		 * Keep the current scroll position close to
		 * the faculty section.
		 */
		const appTop =
			document.getElementById('faculty-app')
				.getBoundingClientRect().top +
			window.scrollY -
			100;

		window.scrollTo({
			top: appTop,
			behavior: 'smooth'
		});

	}


	/*
	 * Pagination button events.
	 */
	firstPage
		.querySelector('a')
		.addEventListener('click', function (event) {

			event.preventDefault();

			if (currentPage > 1) {
				setPage(1);
			}

		});


	previousPage
		.querySelector('a')
		.addEventListener('click', function (event) {

			event.preventDefault();

			if (currentPage > 1) {
				setPage(currentPage - 1);
			}

		});


	nextPage
		.querySelector('a')
		.addEventListener('click', function (event) {

			event.preventDefault();

			const totalPages = getTotalPages();

			if (currentPage < totalPages) {
				setPage(currentPage + 1);
			}

		});


	lastPage
		.querySelector('a')
		.addEventListener('click', function (event) {

			event.preventDefault();

			const totalPages = getTotalPages();

			if (currentPage < totalPages) {
				setPage(totalPages);
			}

		});


	/*
	 * Page-number event delegation.
	 */
	pageNumbers.addEventListener(
		'click',
		function (event) {

			const link =
				event.target.closest('a[data-page]');

			if (!link) {
				return;
			}

			event.preventDefault();

			const page =
				parseInt(link.dataset.page, 10);

			if (!Number.isNaN(page)) {
				setPage(page);
			}

		}
	);


	/*
	 * Programme filter.
	 */
	filterSelect.addEventListener(
		'change',
		function () {

			updateFilteredFaculty();

		}
	);


	/*
	 * Load faculty data from WordPress REST API.
	 */
	function loadFaculty() {

		loadingOverlay.style.display = 'flex';

		fetch(apiURL, {
			method: 'GET',
			credentials: 'same-origin',
			headers: {
				'Accept': 'application/json'
			}
		})
		.then(function (response) {

			if (!response.ok) {

				throw new Error(
					'HTTP error: ' + response.status
				);

			}

			return response.json();

		})
		.then(function (data) {

			/*
			 * Ensure API response is an array.
			 */
			if (!Array.isArray(data)) {

				throw new Error(
					'Unexpected REST API response.'
				);

			}


			/*
			 * Map REST API data to our internal structure.
			 */
			facultyList = data.map(function (post) {

				const acf =
					post.acf || {};


				return {

					name:
						post.title &&
						typeof post.title.rendered === 'string'
							? post.title.rendered
							: '',


					link:
						typeof post.link === 'string'
							? post.link
							: '',


					image:
						typeof acf['Faculty-Image'] === 'string'
							? acf['Faculty-Image']
							: '',


					designation:
						typeof acf['Faculty-Designation'] === 'string'
							? acf['Faculty-Designation']
							: '',


					department:
						typeof acf['Faculty-Department'] === 'string'
							? acf['Faculty-Department']
							: '',


					category:
						acf['Faculty-Category']
							? parseInt(
								acf['Faculty-Category'],
								10
							)
							: 9999

				};

			});


			/*
			 * Initial rendering.
			 */
			updateFilteredFaculty();

		})
		.catch(function (error) {

			console.error(
				'Error fetching faculty data:',
				error
			);


			facultyList = [];
			filteredFaculty = [];


			noResults.textContent =
				'<?php echo esc_js( __( 'Unable to load faculty data. Please try again later.', 'srft-theme' ) ); ?>';

			noResults.style.display = 'block';

			pagination.style.display = 'none';

		})
		.finally(function () {

			loadingOverlay.style.display = 'none';

		});

	}


	/*
	 * Start application.
	 */
	loadFaculty();

})();
</script>

<?php get_footer(); ?>

</body>
</html>

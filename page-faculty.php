<?php
/*
 * Template Name: Faculty
 */

get_header();

$current_language = get_locale();

/**
 * Get category ID from category name.
 *
 * @param string $cat_name Category name.
 *
 * @return int
 */
function get_category_ID( $cat_name ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid

	$cat = get_term_by(
		'name',
		$cat_name,
		'category'
	);

	if ( $cat ) {
		return (int) $cat->term_id;
	}

	return 0;
}


/*
 * Keep the existing working Faculty category.
 */
$category_name = 'faculty';
$category_id   = get_category_ID( $category_name );


/*
 * Page banner image.
 */
$banner_image = get_the_post_thumbnail_url(
	get_the_ID(),
	'large'
);
?>

<main>

	<section
		class="cine-header"
		style="background-image: url('<?php echo esc_url( $banner_image ); ?>');"
	>

		<div class="page-banner">

			<h1 class="page-banner-title">
				<?php
				echo esc_html__(
					'Faculty',
					'srft-theme'
				);
				?>
			</h1>

		</div>

	</section>


	<section class="section-home">

		<div
			class="container"
			style="padding: 0 3.2rem;"
		>

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
				style="
					padding-left: 0;
					text-align: center;
					margin-top: 20px;
				"
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


				<!-- Programme filter -->
				<label for="faculty-filter">
					<?php
					echo esc_html__(
						'Programmes:',
						'srft-theme'
					);
					?>
				</label>


				<select
					id="faculty-filter"
					class="filter"
				>

					<option value="">
						<?php
						echo esc_html__(
							'All',
							'srft-theme'
						);
						?>
					</option>


					<option
						value="<?php echo esc_attr__( 'Animation Cinema', 'srft-theme' ); ?>"
					>
						<?php
						echo esc_html__(
							'Animation Cinema',
							'srft-theme'
						);
						?>
					</option>


					<option
						value="<?php echo esc_attr__( 'Cinematography', 'srft-theme' ); ?>"
					>
						<?php
						echo esc_html__(
							'Cinematography',
							'srft-theme'
						);
						?>
					</option>


					<option
						value="<?php echo esc_attr__( 'Direction & Screenplay Writing', 'srft-theme' ); ?>"
					>
						<?php
						echo esc_html__(
							'Direction & Screenplay Writing',
							'srft-theme'
						);
						?>
					</option>


					<option
						value="<?php echo esc_attr__( 'Editing', 'srft-theme' ); ?>"
					>
						<?php
						echo esc_html__(
							'Editing',
							'srft-theme'
						);
						?>
					</option>


					<option
						value="<?php echo esc_attr__( 'Producing for Film & Television', 'srft-theme' ); ?>"
					>
						<?php
						echo esc_html__(
							'Producing for Film & Television',
							'srft-theme'
						);
						?>
					</option>


					<option
						value="<?php echo esc_attr__( 'Sound Recording & Design', 'srft-theme' ); ?>"
					>
						<?php
						echo esc_html__(
							'Sound Recording & Design',
							'srft-theme'
						);
						?>
					</option>


					<option
						value="<?php echo esc_attr__( 'EDM Management', 'srft-theme' ); ?>"
					>
						<?php
						echo esc_html__(
							'EDM Management',
							'srft-theme'
						);
						?>
					</option>


					<option
						value="<?php echo esc_attr__( 'Cinematography for EDM', 'srft-theme' ); ?>"
					>
						<?php
						echo esc_html__(
							'Cinematography for EDM',
							'srft-theme'
						);
						?>
					</option>


					<option
						value="<?php echo esc_attr__( 'Direction & Producing for EDM', 'srft-theme' ); ?>"
					>
						<?php
						echo esc_html__(
							'Direction & Producing for EDM',
							'srft-theme'
						);
						?>
					</option>


					<option
						value="<?php echo esc_attr__( 'Editing for EDM', 'srft-theme' ); ?>"
					>
						<?php
						echo esc_html__(
							'Editing for EDM',
							'srft-theme'
						);
						?>
					</option>


					<option
						value="<?php echo esc_attr__( 'Sound for EDM', 'srft-theme' ); ?>"
					>
						<?php
						echo esc_html__(
							'Sound for EDM',
							'srft-theme'
						);
						?>
					</option>


					<option
						value="<?php echo esc_attr__( 'Writing for EDM', 'srft-theme' ); ?>"
					>
						<?php
						echo esc_html__(
							'Writing for EDM',
							'srft-theme'
						);
						?>
					</option>

				</select>



				<!-- Faculty grid -->
				<ul
					id="faculty-grid"
					class="faculty-grid"
					aria-label="<?php echo esc_attr__( 'Faculty profiles', 'srft-theme' ); ?>"
				>
				</ul>



				<!-- Loading status -->
				<div
					id="faculty-loading"
					class="loading-overlay"
					role="status"
					aria-live="polite"
				>

					<span class="sr-only">
						<?php
						echo esc_html__(
							'Loading faculty',
							'srft-theme'
						);
						?>
					</span>

					<div
						class="spinner"
						aria-hidden="true"
					></div>

				</div>



				<!-- No results -->
				<p
					id="faculty-no-results"
					class="faculty-no-results"
					style="display: none;"
				>
					<?php
					echo esc_html__(
						'No faculty members found.',
						'srft-theme'
					);
					?>
				</p>



				<!-- Pagination -->
				<nav
					id="faculty-pagination"
					aria-label="<?php echo esc_attr__( 'Pagination', 'srft-theme' ); ?>"
				>

					<ul
						class="pagination"
						id="faculty-pagination-list"
					>


						<!-- First page -->
						<li id="faculty-first-page">

							<a
								href="#"
								data-page-action="first"
								aria-label="<?php echo esc_attr__( 'Go to first page', 'srft-theme' ); ?>"
							>

								<span class="sr-only">
									<?php
									echo esc_html__(
										'First Page',
										'srft-theme'
									);
									?>
								</span>

								<i
									class="fas fa-step-backward"
									aria-hidden="true"
									style="color: #8b5b2b;"
								></i>

							</a>

						</li>



						<!-- Previous page -->
						<li id="faculty-prev-page">

							<a
								href="#"
								data-page-action="previous"
								aria-label="<?php echo esc_attr__( 'Go to previous page', 'srft-theme' ); ?>"
							>

								<span class="sr-only">
									<?php
									echo esc_html__(
										'Previous Page',
										'srft-theme'
									);
									?>
								</span>

								<i
									class="fas fa-chevron-left"
									aria-hidden="true"
									style="color: #8b5b2b;"
								></i>

							</a>

						</li>



						<!-- Page numbers inserted by JavaScript -->


						<!-- Next page -->
						<li id="faculty-next-page">

							<a
								href="#"
								data-page-action="next"
								aria-label="<?php echo esc_attr__( 'Go to next page', 'srft-theme' ); ?>"
							>

								<span class="sr-only">
									<?php
									echo esc_html__(
										'Next Page',
										'srft-theme'
									);
									?>
								</span>

								<i
									class="fas fa-chevron-right"
									aria-hidden="true"
									style="color: #8b5b2b;"
								></i>

							</a>

						</li>



						<!-- Last page -->
						<li id="faculty-last-page">

							<a
								href="#"
								data-page-action="last"
								aria-label="<?php echo esc_attr__( 'Go to last page', 'srft-theme' ); ?>"
							>

								<span class="sr-only">
									<?php
									echo esc_html__(
										'Last Page',
										'srft-theme'
									);
									?>
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



<script>
(function () {

	'use strict';


	/*
	 * WordPress REST API configuration.
	 */
	const siteURL =
		<?php
		echo wp_json_encode(
			esc_url_raw(
				site_url( '/' )
			)
		);
		?>;


	const categoryID =
		<?php
		echo wp_json_encode(
			absint( $category_id )
		);
		?>;


	const language =
		<?php
		echo wp_json_encode(
			$current_language
		);
		?>;


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
	const facultyGrid =
		document.getElementById(
			'faculty-grid'
		);

	const loadingOverlay =
		document.getElementById(
			'faculty-loading'
		);

	const filterSelect =
		document.getElementById(
			'faculty-filter'
		);

	const pagination =
		document.getElementById(
			'faculty-pagination'
		);

	const paginationList =
		document.getElementById(
			'faculty-pagination-list'
		);

	const noResults =
		document.getElementById(
			'faculty-no-results'
		);

	const firstPage =
		document.getElementById(
			'faculty-first-page'
		);

	const previousPage =
		document.getElementById(
			'faculty-prev-page'
		);

	const nextPage =
		document.getElementById(
			'faculty-next-page'
		);

	const lastPage =
		document.getElementById(
			'faculty-last-page'
		);



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
	 * Currently not displayed but kept for
	 * future alphabetical filtering.
	 */
	let alphabet;


	if (language === 'en_US') {

		alphabet =
			'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('');

	} else if (language === 'hi_IN') {

		alphabet =
			'अआइईउऊऋएऐओऔकखगघङचछजझञटठडढणतथदधनपफबभमयरलवशषसह'
				.split('');

	} else {

		alphabet =
			'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('');

	}



	/*
	 * Create a safe text node.
	 */
	function createSafeText(text) {

		return document.createTextNode(
			text === null ||
			text === undefined
				? ''
				: String(text)
		);

	}



	/*
	 * Validate URLs used in href/src.
	 */
	function getSafeURL(value) {

		if (!value) {
			return '';
		}


		try {

			const url =
				new URL(
					value,
					window.location.origin
				);


			if (
				url.protocol === 'http:' ||
				url.protocol === 'https:'
			) {

				return url.href;

			}

		} catch (error) {

			console.warn(
				'Invalid URL:',
				value
			);

		}


		return '';

	}



	/*
	 * Create one faculty card.
	 */
	function createFacultyCard(faculty) {

		const li =
			document.createElement('li');

		li.className =
			'faculty-card';



		/*
		 * Faculty image.
		 */
		const imageURL =
			getSafeURL(
				faculty.image
			);


		if (imageURL) {

			const image =
				document.createElement(
					'img'
				);

			image.src =
				imageURL;

			image.alt =
				faculty.name || '';

			image.className =
				'faculty-image';

			image.style.filter =
				'grayscale(100%)';

			image.loading =
				'lazy';

			li.appendChild(
				image
			);

		}



		/*
		 * Faculty name.
		 */
		const heading =
			document.createElement(
				'h3'
			);


		const linkURL =
			getSafeURL(
				faculty.link
			);


		if (linkURL) {

			const link =
				document.createElement(
					'a'
				);

			link.href =
				linkURL;

			link.appendChild(
				createSafeText(
					faculty.name
				)
			);

			heading.appendChild(
				link
			);

		} else {

			heading.appendChild(
				createSafeText(
					faculty.name
				)
			);

		}


		li.appendChild(
			heading
		);



		/*
		 * Designation.
		 */
		if (faculty.designation) {

			const designation =
				document.createElement(
					'p'
				);

			designation.appendChild(
				createSafeText(
					faculty.designation
				)
			);

			li.appendChild(
				designation
			);

		}



		/*
		 * Department.
		 */
		if (faculty.department) {

			const department =
				document.createElement(
					'p'
				);

			department.appendChild(
				createSafeText(
					faculty.department
				)
			);

			li.appendChild(
				department
			);

		}


		return li;

	}



	/*
	 * Render the current page.
	 */
	function renderFaculty() {

		/*
		 * Remove existing dynamically generated cards.
		 */
		const existingCards =
			facultyGrid.querySelectorAll(
				'.faculty-card'
			);


		existingCards.forEach(
			function (card) {

				card.remove();

			}
		);



		const startIndex =
			(currentPage - 1) *
			itemsPerPage;


		const endIndex =
			startIndex +
			itemsPerPage;


		const currentFaculty =
			filteredFaculty.slice(
				startIndex,
				endIndex
			);



		/*
		 * No results.
		 */
		if (
			currentFaculty.length === 0
		) {

			noResults.style.display =
				'block';

		} else {

			noResults.style.display =
				'none';

		}



		/*
		 * Add faculty cards.
		 *
		 * Loading overlay is outside the UL,
		 * therefore simply append LI elements.
		 */
		currentFaculty.forEach(
			function (faculty) {

				const card =
					createFacultyCard(
						faculty
					);

				facultyGrid.appendChild(
					card
				);

			}
		);


		updatePagination();

	}



	/*
	 * Filter and sort.
	 */
	function updateFilteredFaculty() {

		const selectedDepartment =
			filterSelect.value;


		filteredFaculty =
			facultyList.filter(
				function (faculty) {

					const departmentMatch =
						!selectedDepartment ||
						faculty.department ===
							selectedDepartment;


					const name =
						faculty.name || '';


					const letterMatch =
						!currentLetter ||
						name
							.charAt(0)
							.toUpperCase() ===
							currentLetter;


					return (
						departmentMatch &&
						letterMatch
					);

				}
			);



		/*
		 * Sort by Faculty Category
		 * when department is selected.
		 */
		if (selectedDepartment) {

			filteredFaculty.sort(
				function (a, b) {

					const aCategory =
						Number.isFinite(
							a.category
						)
							? a.category
							: 9999;


					const bCategory =
						Number.isFinite(
							b.category
						)
							? b.category
							: 9999;


					return (
						aCategory -
						bCategory
					);

				}
			);

		} else {

			/*
			 * Otherwise alphabetical.
			 */
			filteredFaculty.sort(
				function (a, b) {

					return (
						(a.name || '')
							.localeCompare(
								b.name || '',
								undefined,
								{
									sensitivity:
										'base'
								}
							)
					);

				}
			);

		}



		/*
		 * Return to page 1.
		 */
		currentPage = 1;

		renderFaculty();

	}



	/*
	 * Number of pages.
	 */
	function getTotalPages() {

		return Math.ceil(
			filteredFaculty.length /
			itemsPerPage
		);

	}



	/*
	 * Enable / disable pagination control.
	 */
	function setPaginationState(
		element,
		disabled
	) {

		const link =
			element.querySelector('a');


		if (disabled) {

			element.classList.add(
				'disabled'
			);


			if (link) {

				link.setAttribute(
					'aria-disabled',
					'true'
				);

				link.setAttribute(
					'tabindex',
					'-1'
				);

			}

		} else {

			element.classList.remove(
				'disabled'
			);


			if (link) {

				link.removeAttribute(
					'aria-disabled'
				);

				link.removeAttribute(
					'tabindex'
				);

			}

		}

	}



	/*
	 * Build pagination.
	 */
	function updatePagination() {

		const totalPages =
			getTotalPages();



		/*
		 * Remove existing page numbers first.
		 */
		paginationList
			.querySelectorAll(
				'.faculty-page-number'
			)
			.forEach(
				function (item) {

					item.remove();

				}
			);



		/*
		 * Hide pagination for
		 * zero or one page.
		 */
		if (totalPages <= 1) {

			pagination.style.display =
				'none';

			return;

		}


		pagination.style.display =
			'block';



		/*
		 * Generate page links.
		 */
		for (
			let page = 1;
			page <= totalPages;
			page++
		) {

			const li =
				document.createElement(
					'li'
				);

			li.className =
				'faculty-page-number';


			if (
				currentPage === page
			) {

				li.classList.add(
					'active'
				);

			}


			const link =
				document.createElement(
					'a'
				);

			link.href =
				'#';

			link.dataset.page =
				String(page);


			link.setAttribute(
				'aria-label',
				'<?php echo esc_js( __( 'Go to page', 'srft-theme' ) ); ?> ' +
				page
			);


			if (
				currentPage === page
			) {

				link.setAttribute(
					'aria-current',
					'page'
				);

			}


			link.appendChild(
				createSafeText(
					page
				)
			);


			li.appendChild(
				link
			);


			/*
			 * Insert immediately before Next.
			 */
			paginationList.insertBefore(
				li,
				nextPage
			);

		}



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
			currentPage ===
				totalPages
		);


		setPaginationState(
			lastPage,
			currentPage ===
				totalPages
		);

	}



	/*
	 * Change page.
	 */
	function setPage(page) {

		const totalPages =
			getTotalPages();


		if (
			page < 1 ||
			page > totalPages
		) {

			return;

		}


		currentPage =
			page;


		renderFaculty();



		const facultyApp =
			document.getElementById(
				'faculty-app'
			);


		if (facultyApp) {

			const appTop =
				facultyApp
					.getBoundingClientRect()
					.top +
				window.scrollY -
				100;


			window.scrollTo({
				top: appTop,
				behavior: 'smooth'
			});

		}

	}



	/*
	 * First page.
	 */
	firstPage
		.querySelector('a')
		.addEventListener(
			'click',
			function (event) {

				event.preventDefault();


				if (
					currentPage > 1
				) {

					setPage(1);

				}

			}
		);



	/*
	 * Previous page.
	 */
	previousPage
		.querySelector('a')
		.addEventListener(
			'click',
			function (event) {

				event.preventDefault();


				if (
					currentPage > 1
				) {

					setPage(
						currentPage - 1
					);

				}

			}
		);



	/*
	 * Next page.
	 */
	nextPage
		.querySelector('a')
		.addEventListener(
			'click',
			function (event) {

				event.preventDefault();


				const totalPages =
					getTotalPages();


				if (
					currentPage <
					totalPages
				) {

					setPage(
						currentPage + 1
					);

				}

			}
		);



	/*
	 * Last page.
	 */
	lastPage
		.querySelector('a')
		.addEventListener(
			'click',
			function (event) {

				event.preventDefault();


				const totalPages =
					getTotalPages();


				if (
					currentPage <
					totalPages
				) {

					setPage(
						totalPages
					);

				}

			}
		);



	/*
	 * Dynamically generated
	 * page-number links.
	 */
	paginationList.addEventListener(
		'click',
		function (event) {

			const link =
				event.target.closest(
					'a[data-page]'
				);


			if (!link) {
				return;
			}


			event.preventDefault();


			const page =
				parseInt(
					link.dataset.page,
					10
				);


			if (
				!Number.isNaN(page)
			) {

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
	 * Fetch Faculty data.
	 */
	function loadFaculty() {

		loadingOverlay.style.display =
			'flex';


		fetch(
			apiURL,
			{
				method: 'GET',
				credentials:
					'same-origin',

				headers: {
					'Accept':
						'application/json'
				}
			}
		)

		.then(
			function (response) {

				if (!response.ok) {

					throw new Error(
						'HTTP error: ' +
						response.status
					);

				}


				return response.json();

			}
		)

		.then(
			function (data) {

				if (
					!Array.isArray(data)
				) {

					throw new Error(
						'Unexpected REST API response.'
					);

				}



				facultyList =
					data.map(
						function (post) {

							const acf =
								post.acf || {};


							const categoryValue =
								parseInt(
									acf[
										'Faculty-Category'
									],
									10
								);


							return {

								name:
									post.title &&
									typeof post.title.rendered ===
										'string'
										? post.title.rendered
										: '',


								link:
									typeof post.link ===
										'string'
										? post.link
										: '',


								image:
									typeof acf[
										'Faculty-Image'
									] ===
										'string'
										? acf[
											'Faculty-Image'
										]
										: '',


								designation:
									typeof acf[
										'Faculty-Designation'
									] ===
										'string'
										? acf[
											'Faculty-Designation'
										]
										: '',


								department:
									typeof acf[
										'Faculty-Department'
									] ===
										'string'
										? acf[
											'Faculty-Department'
										]
										: '',


								category:
									Number.isNaN(
										categoryValue
									)
										? 9999
										: categoryValue

							};

						}
					);



				updateFilteredFaculty();

			}
		)

		.catch(
			function (error) {

				console.error(
					'Error fetching faculty data:',
					error
				);


				facultyList = [];
				filteredFaculty = [];


				noResults.textContent =
					'<?php echo esc_js( __( 'Unable to load faculty data. Please try again later.', 'srft-theme' ) ); ?>';


				noResults.style.display =
					'block';


				pagination.style.display =
					'none';

			}
		)

		.finally(
			function () {

				loadingOverlay.style.display =
					'none';

			}
		);

	}



	/*
	 * Start.
	 */
	loadFaculty();

})();
</script>

<?php get_footer(); ?>
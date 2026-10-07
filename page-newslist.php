
<?php
/**
 * Template Name: NewsList
 */

get_header();

/*
 * Get category ID safely.
 */
function srfti_get_category_id( $cat_name ) {
	$cat = get_term_by( 'name', $cat_name, 'category' );

	if ( $cat ) {
		return absint( $cat->term_id );
	}

	return 0;
}

$category_name = 'news';
$category_id   = srfti_get_category_id( $category_name );

/*
 * Get page banner image safely.
 */
$banner_image = get_the_post_thumbnail_url(
	get_the_ID(),
	'large'
);
?>

<main>

	<!-- Page Banner -->
	<section
		class="cine-header"
		style="background-image: url('<?php echo esc_url( $banner_image ); ?>');"
	>
		<div class="page-banner">
			<h1 class="page-banner-title">
				<?php echo esc_html__( 'News', 'srft-theme' ); ?>
			</h1>
		</div>
	</section>


	<!-- Breadcrumbs -->
	<div class="container-aligned">
		<div class="breadcrumbs-wrapper">

			<?php
			if ( function_exists( 'yoast_breadcrumb' ) ) {
				yoast_breadcrumb(
					'<nav aria-label="' .
					esc_attr__( 'Breadcrumbs', 'srft-theme' ) .
					'" id="breadcrumbs">',
					'</nav>'
				);
			}
			?>

		</div>
	</div>


	<!-- News Section -->
	<section
		class="section-home"
		id="skip-to-content"
	>
		<div class="container">

			<h2
				class="page-header-text"
				style="padding-left: 0; text-align: center;"
			>
				<?php echo esc_html__( 'Recent Updates', 'srft-theme' ); ?>
			</h2>


			<div
				id="news-app"
				style="margin-top: 4.5rem;"
			>

				<!-- Loading message -->
				<p
					id="news-loading"
					class="news-loading"
					aria-live="polite"
				>
					<?php echo esc_html__( 'Loading news...', 'srft-theme' ); ?>
				</p>


				<!-- News Grid -->
				<ul
					id="news-grid"
					class="news-grid"
					role="list"
					aria-label="<?php echo esc_attr__( 'News updates', 'srft-theme' ); ?>"
				>
					<!-- News cards are inserted here by JavaScript. -->
				</ul>


				<!-- No Results -->
				<p
					id="news-no-results"
					class="news-no-results"
					style="display: none;"
					role="status"
					aria-live="polite"
				>
					<?php echo esc_html__( 'No news updates found.', 'srft-theme' ); ?>
				</p>


				<!-- Pagination -->
				<nav
					id="news-pagination"
					aria-label="<?php echo esc_attr__( 'News pagination', 'srft-theme' ); ?>"
					style="display: none;"
				>

					<ul
						class="pagination"
						id="news-pagination-list"
					>

						<!-- First Page -->
						<li id="news-first-page">

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
						<li id="news-prev-page">

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


						<!-- Page numbers are inserted here dynamically. -->


						<!-- Next Page -->
						<li id="news-next-page">

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
						<li id="news-last-page">

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


<style>

/*
 * News pagination.
 */
#news-pagination-list {
	display: flex;
	align-items: center;
	justify-content: center;
	flex-wrap: wrap;
	gap: 0.5rem;
	list-style: none;
	margin: 0;
	padding: 0;
}

#news-pagination-list > li {
	display: inline-flex;
	margin: 0;
	padding: 0;
}

#news-pagination-list > li > a {
	display: flex;
	align-items: center;
	justify-content: center;
	min-width: 40px;
	height: 36px;
	padding: 0 10px;
	box-sizing: border-box;
}

#news-pagination-list > li.active > a {
	background: #8b5b2b;
	color: #fff;
}

#news-pagination-list > li.disabled > a {
	pointer-events: none;
	opacity: 0.5;
}


/*
 * Loading message.
 */
.news-loading {
	text-align: center;
	margin: 2rem 0;
}


/*
 * No results message.
 */
.news-no-results {
	text-align: center;
	margin: 2rem 0;
}

</style>


<script>

(function () {

	'use strict';


	/*
	 * WordPress REST API configuration.
	 */
	const siteURL = <?php echo wp_json_encode( esc_url_raw( site_url( '/' ) ) ); ?>;

	const categoryID = <?php echo wp_json_encode( absint( $category_id ) ); ?>;


	/*
	 * REST API URL.
	 *
	 * per_page=100 is retained from the previous
	 * AngularJS implementation.
	 */
	const apiURL =
		siteURL +
		'wp-json/wp/v2/news?categories=' +
		encodeURIComponent(categoryID) +
		'&per_page=100';


	/*
	 * Configuration.
	 */
	const itemsPerPage = 8;


	/*
	 * DOM elements.
	 */
	const newsGrid =
		document.getElementById('news-grid');

	const newsLoading =
		document.getElementById('news-loading');

	const newsPagination =
		document.getElementById('news-pagination');

	const paginationList =
		document.getElementById('news-pagination-list');

	const noResults =
		document.getElementById('news-no-results');

	const firstPage =
		document.getElementById('news-first-page');

	const previousPage =
		document.getElementById('news-prev-page');

	const nextPage =
		document.getElementById('news-next-page');

	const lastPage =
		document.getElementById('news-last-page');


	/*
	 * Application state.
	 */
	let newsList = [];

	let currentPage = 1;


	/*
	 * Create safe text node.
	 *
	 * This prevents API content from being interpreted
	 * as HTML.
	 */
	function createSafeText(text) {

		return document.createTextNode(
			text === null || text === undefined
				? ''
				: String(text)
		);

	}


	/*
	 * Validate URL before using it in href/src.
	 *
	 * Only HTTP and HTTPS URLs are accepted.
	 */
	function getSafeURL(value) {

		if (!value) {
			return '';
		}

		try {

			const url = new URL(
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
	 * Convert WordPress title HTML to plain text.
	 *
	 * WordPress REST API normally returns:
	 *
	 * post.title.rendered
	 *
	 * which can contain HTML entities.
	 */
	function decodeHTML(value) {

		if (!value) {
			return '';
		}

		const tempDiv =
			document.createElement('div');

		tempDiv.innerHTML = value;

		return (
			tempDiv.textContent ||
			tempDiv.innerText ||
			''
		);

	}


	/*
	 * Format WordPress date.
	 *
	 * Output:
	 * DD-MM-YYYY
	 */
	function formatDate(dateValue) {

		if (!dateValue) {
			return '';
		}

		const postDate =
			new Date(dateValue);

		if (Number.isNaN(postDate.getTime())) {
			return '';
		}

		const day =
			String(
				postDate.getDate()
			).padStart(2, '0');

		const month =
			String(
				postDate.getMonth() + 1
			).padStart(2, '0');

		const year =
			postDate.getFullYear();

		return (
			day +
			'-' +
			month +
			'-' +
			year
		);

	}


	/*
	 * Create a single news card.
	 */
	function createNewsCard(news) {

		const li =
			document.createElement('li');

		li.className = 'news-card';

		li.setAttribute(
			'role',
			'listitem'
		);


		/*
		 * Left side of news card.
		 */
		const left =
			document.createElement('div');

		left.className =
			'news-link-left';


		/*
		 * News date.
		 */
		const date =
			document.createElement('span');

		date.className =
			'news-link-left-date';

		date.appendChild(
			createSafeText(
				news.formattedDate
			)
		);

		left.appendChild(date);


		/*
		 * News title and link.
		 */
		const heading =
			document.createElement('h3');

		heading.className =
			'news-link-left-title';


		const linkURL =
			getSafeURL(news.link);


		if (linkURL) {

			const link =
				document.createElement('a');

			link.href = linkURL;

			link.appendChild(
				createSafeText(news.name)
			);

			heading.appendChild(link);

		} else {

			heading.appendChild(
				createSafeText(news.name)
			);

		}


		left.appendChild(heading);


		/*
		 * News description/designation.
		 *
		 * Kept for compatibility with the
		 * previous AngularJS structure.
		 */
		const text =
			document.createElement('div');

		text.className =
			'news-link-left-text';


		if (news.designation) {

			const designation =
				document.createElement('span');

			designation.appendChild(
				createSafeText(
					news.designation
				)
			);

			text.appendChild(
				designation
			);

		}


		left.appendChild(text);


		/*
		 * Right side image.
		 */
		const imageContainer =
			document.createElement('div');

		imageContainer.className =
			'news-image-right';


		const imageURL =
			getSafeURL(news.image);


		if (imageURL) {

			const image =
				document.createElement('img');

			image.src = imageURL;

			image.alt =
				news.name || '';

			image.className =
				'faculty-image';

			image.loading =
				'lazy';

			image.decoding =
				'async';

			imageContainer.appendChild(
				image
			);

		}


		/*
		 * Assemble card.
		 */
		li.appendChild(left);

		li.appendChild(
			imageContainer
		);


		return li;

	}


	/*
	 * Render news cards for current page.
	 */
	function renderNews() {

		/*
		 * Remove existing cards.
		 */
		newsGrid
			.querySelectorAll('.news-card')
			.forEach(function (card) {

				card.remove();

			});


		/*
		 * Calculate page range.
		 */
		const startIndex =
			(currentPage - 1) *
			itemsPerPage;

		const endIndex =
			startIndex +
			itemsPerPage;


		const currentNews =
			newsList.slice(
				startIndex,
				endIndex
			);


		/*
		 * No results.
		 */
		if (currentNews.length === 0) {

			noResults.style.display =
				'block';

		} else {

			noResults.style.display =
				'none';

		}


		/*
		 * Create cards.
		 */
		currentNews.forEach(function (news) {

			const card =
				createNewsCard(news);

			newsGrid.appendChild(card);

		});


		/*
		 * Update pagination.
		 */
		updatePagination();

	}


	/*
	 * Calculate total pages.
	 */
	function getTotalPages() {

		return Math.ceil(
			newsList.length /
			itemsPerPage
		);

	}


	/*
	 * Update pagination.
	 */
	function updatePagination() {

		const totalPages =
			getTotalPages();


		/*
		 * Hide pagination if only one page
		 * or there are no results.
		 */
		if (totalPages <= 1) {

			newsPagination.style.display =
				'none';

			return;

		}


		newsPagination.style.display =
			'block';


		/*
		 * Remove existing page numbers.
		 */
		paginationList
			.querySelectorAll('.news-page-number')
			.forEach(function (item) {

				item.remove();

			});


		/*
		 * Create page numbers.
		 *
		 * Insert before Next button so that
		 * all page numbers remain direct
		 * children of the UL.
		 */
		for (
			let page = 1;
			page <= totalPages;
			page++
		) {

			const li =
				document.createElement('li');

			li.className =
				'news-page-number';


			if (currentPage === page) {

				li.classList.add(
					'active'
				);

			}


			const link =
				document.createElement('a');

			link.href = '#';

			link.dataset.page =
				page;


			link.setAttribute(
				'aria-label',
				'<?php echo esc_js( __( 'Go to page', 'srft-theme' ) ); ?> ' +
				page
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


			paginationList.insertBefore(
				li,
				nextPage
			);

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

			}

		} else {

			element.classList.remove(
				'disabled'
			);

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


		renderNews();


		/*
		 * Scroll back near the News section.
		 */
		const app =
			document.getElementById(
				'news-app'
			);


		if (app) {

			const appTop =
				app.getBoundingClientRect().top +
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

				if (currentPage > 1) {

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

				if (currentPage > 1) {

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

					setPage(totalPages);

				}

			}
		);


	/*
	 * Page-number event delegation.
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


			if (!Number.isNaN(page)) {

				setPage(page);

			}

		}
	);


	/*
	 * Load news data from WordPress
	 * REST API.
	 */
	function loadNews() {

		newsLoading.style.display =
			'block';


		fetch(
			apiURL,
			{
				method: 'GET',

				credentials: 'same-origin',

				headers: {
					'Accept':
						'application/json'
				}
			}
		)

		.then(function (response) {

			if (!response.ok) {

				throw new Error(
					'HTTP error: ' +
					response.status
				);

			}


			return response.json();

		})


		.then(function (data) {

			/*
			 * Make sure the API returned
			 * an array.
			 */
			if (!Array.isArray(data)) {

				throw new Error(
					'Unexpected REST API response.'
				);

			}


			/*
			 * Convert REST API response
			 * into our internal structure.
			 */
			newsList =
				data.map(function (post) {

					const acf =
						post.acf || {};


					return {

						name:
							post.title &&
							typeof post.title.rendered ===
							'string'
								? decodeHTML(
									post.title.rendered
								)
								: '',


						link:
							typeof post.link ===
							'string'
								? post.link
								: '',


						image:
							typeof acf['News-Image'] ===
							'string'
								? acf['News-Image']
								: '',


						formattedDate:
							formatDate(
								post.date
							),


						/*
						 * Retained in case the
						 * existing site uses this
						 * field in the future.
						 */
						designation:
							typeof acf['News-Designation'] ===
							'string'
								? acf['News-Designation']
								: ''

					};

				});


			/*
			 * Initial rendering.
			 */
			currentPage = 1;

			renderNews();


			/*
			 * News loaded successfully.
			 */
			newsLoading.style.display =
				'none';

		})


		.catch(function (error) {

			console.error(
				'Error fetching news data:',
				error
			);


			newsList = [];


			newsLoading.style.display =
				'none';


			noResults.textContent =
				'<?php echo esc_js( __( 'Unable to load news data. Please try again later.', 'srft-theme' ) ); ?>';


			noResults.style.display =
				'block';


			newsPagination.style.display =
				'none';

		});

	}


	/*
	 * Start application.
	 */
	loadNews();

})();

</script>


<?php get_footer(); ?>

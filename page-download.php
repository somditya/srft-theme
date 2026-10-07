<?php
/**
 * Template Name: Downloads
 */

get_header();


/*
 * Get category ID safely.
 */
function srfti_downloads_get_category_id( $cat_name ) {

	$cat = get_term_by(
		'name',
		$cat_name,
		'category'
	);

	if ( $cat ) {
		return absint( $cat->term_id );
	}

	return 0;
}


$category_name = 'document';

$category_id = srfti_downloads_get_category_id(
	$category_name
);


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
				<?php echo esc_html__( 'Download', 'srft-theme' ); ?>
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
					esc_attr__(
						'Breadcrumbs',
						'srft-theme'
					) .
					'" id="breadcrumbs">',
					'</nav>'
				);

			}
			?>

		</div>

	</div>


	<!-- Downloads Section -->
	<section
		id="skip-to-content"
		class="section-home"
	>

		<div class="container">


			<h2
				class="page-header-text"
				style="padding-left: 0; text-align: center;"
			>
				<?php echo esc_html__(
					'Document List',
					'srft-theme'
				); ?>
			</h2>


			<div
				id="downloads-app"
				style="margin-top: 4.5rem;"
			>


				<!-- Search -->
				<div class="filter-bar">

					<label for="filterField">
						<?php echo esc_html__(
							'Search:',
							'srft-theme'
						); ?>
					</label>


					<input
						type="search"
						id="filterField"
						placeholder="<?php echo esc_attr__(
							'Search by keyword',
							'srft-theme'
						); ?>"
						aria-describedby="searchInstruction"
						autocomplete="off"
					>

				</div>


				<!-- Search instruction -->
				<p
					id="searchInstruction"
					class="sr-only"
				>
					<?php echo esc_html__(
						'Results update automatically as you type.',
						'srft-theme'
					); ?>
				</p>


				<!-- Search status -->
				<div
					id="searchStatus"
					class="sr-only"
					aria-live="polite"
					role="status"
				></div>


				<!-- Loading message -->
				<p
					id="documentsLoading"
					class="documents-loading"
					aria-live="polite"
				>
					<?php echo esc_html__(
						'Loading documents...',
						'srft-theme'
					); ?>
				</p>


				<!-- Document Table -->
				<div
					class="wrapper"
					style="padding: 0 3.2rem;"
				>

					<div class="table-container">

						<table>

							<caption class="sr-only">
								<?php echo esc_html__(
									'Table showing list of downloadable documents',
									'srft-theme'
								); ?>
							</caption>


							<thead>

								<tr class="Rtable-row Rtable-row--head">

									<th
										class="Rtable-cell location-cell column-heading"
										scope="col"
									>
										<?php echo esc_html__(
											'SL.No.',
											'srft-theme'
										); ?>
									</th>


									<th
										class="Rtable-cell name-cell column-heading"
										scope="col"
									>
										<?php echo esc_html__(
											'Title',
											'srft-theme'
										); ?>
									</th>


									<th
										class="Rtable-cell tenure-cell column-heading"
										scope="col"
									>
										<?php echo esc_html__(
											'Category',
											'srft-theme'
										); ?>
									</th>


									<th
										class="Rtable-cell access-link-cell column-heading"
										scope="col"
									>
										<?php echo esc_html__(
											'Document',
											'srft-theme'
										); ?>
									</th>

								</tr>

							</thead>


							<tbody id="documentsTableBody">

								<!-- Document rows are inserted here by JavaScript. -->

							</tbody>

						</table>

					</div>

				</div>


				<!-- No Results -->
				<p
					id="documentsNoResults"
					class="documents-no-results"
					style="display: none;"
					role="status"
					aria-live="polite"
				>
					<?php echo esc_html__(
						'No documents found.',
						'srft-theme'
					); ?>
				</p>


				<!-- Pagination -->
				<nav
					id="documentsPagination"
					aria-label="<?php echo esc_attr__(
						'Document pagination',
						'srft-theme'
					); ?>"
					style="display: none;"
				>

					<ul
						class="pagination"
						id="documentsPaginationList"
					>


						<!-- First Page -->
						<li id="documentsFirstPage">

							<a
								href="#"
								data-page-action="first"
								aria-label="<?php echo esc_attr__(
									'Go to first page',
									'srft-theme'
								); ?>"
							>

								<span class="sr-only">
									<?php echo esc_html__(
										'First Page',
										'srft-theme'
									); ?>
								</span>

								<i
									class="fa fa-step-backward"
									aria-hidden="true"
									style="color:#8b5b2b;"
								></i>

							</a>

						</li>


						<!-- Previous Page -->
						<li id="documentsPrevPage">

							<a
								href="#"
								data-page-action="previous"
								aria-label="<?php echo esc_attr__(
									'Go to previous page',
									'srft-theme'
								); ?>"
							>

								<span class="sr-only">
									<?php echo esc_html__(
										'Previous Page',
										'srft-theme'
									); ?>
								</span>

								<i
									class="fa fa-chevron-left"
									aria-hidden="true"
									style="color:#8b5b2b;"
								></i>

							</a>

						</li>


						<!-- Page numbers inserted dynamically -->


						<!-- Next Page -->
						<li id="documentsNextPage">

							<a
								href="#"
								data-page-action="next"
								aria-label="<?php echo esc_attr__(
									'Go to next page',
									'srft-theme'
								); ?>"
							>

								<span class="sr-only">
									<?php echo esc_html__(
										'Next Page',
										'srft-theme'
									); ?>
								</span>

								<i
									class="fa fa-chevron-right"
									aria-hidden="true"
									style="color:#8b5b2b;"
								></i>

							</a>

						</li>


						<!-- Last Page -->
						<li id="documentsLastPage">

							<a
								href="#"
								data-page-action="last"
								aria-label="<?php echo esc_attr__(
									'Go to last page',
									'srft-theme'
								); ?>"
							>

								<span class="sr-only">
									<?php echo esc_html__(
										'Last Page',
										'srft-theme'
									); ?>
								</span>

								<i
									class="fa fa-step-forward"
									aria-hidden="true"
									style="color:#8b5b2b;"
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
 * Pagination.
 */
#documentsPaginationList {
	display: flex;
	align-items: center;
	justify-content: center;
	flex-wrap: wrap;
	gap: 0.5rem;
	list-style: none;
	margin: 0;
	padding: 0;
}


#documentsPaginationList > li {
	display: inline-flex;
	margin: 0;
	padding: 0;
}


#documentsPaginationList > li > a {
	display: flex;
	align-items: center;
	justify-content: center;
	min-width: 40px;
	height: 36px;
	padding: 0 10px;
	box-sizing: border-box;
}


#documentsPaginationList > li.active > a {
	background: #8b5b2b;
	color: #fff;
}


#documentsPaginationList > li.disabled > a {
	pointer-events: none;
	opacity: 0.5;
}


/*
 * Loading message.
 */
.documents-loading {
	text-align: center;
	margin: 2rem 0;
}


/*
 * No-results message.
 */
.documents-no-results {
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
	const siteURL =
		<?php echo wp_json_encode(
			esc_url_raw(
				site_url( '/' )
			)
		); ?>;


	const categoryID =
		<?php echo wp_json_encode(
			absint( $category_id )
		); ?>;


	/*
	 * REST API URL.
	 */
	const apiURL =
		siteURL +
		'wp-json/wp/v2/document?categories=' +
		encodeURIComponent(categoryID) +
		'&per_page=100';


	/*
	 * Configuration.
	 */
	const itemsPerPage = 20;


	/*
	 * DOM elements.
	 */
	const filterField =
		document.getElementById(
			'filterField'
		);


	const searchStatus =
		document.getElementById(
			'searchStatus'
		);


	const documentsLoading =
		document.getElementById(
			'documentsLoading'
		);


	const tableBody =
		document.getElementById(
			'documentsTableBody'
		);


	const noResults =
		document.getElementById(
			'documentsNoResults'
		);


	const pagination =
		document.getElementById(
			'documentsPagination'
		);


	const paginationList =
		document.getElementById(
			'documentsPaginationList'
		);


	const firstPage =
		document.getElementById(
			'documentsFirstPage'
		);


	const previousPage =
		document.getElementById(
			'documentsPrevPage'
		);


	const nextPage =
		document.getElementById(
			'documentsNextPage'
		);


	const lastPage =
		document.getElementById(
			'documentsLastPage'
		);


	/*
	 * Application state.
	 */
	let documentList = [];

	let filteredDocuments = [];

	let currentPage = 1;


	/*
	 * PDF icon URL.
	 */
	const pdfIconURL =
		<?php echo wp_json_encode(
			esc_url(
				get_template_directory_uri() .
				'/images/pdf_icon_resized.png'
			)
		); ?>;


	/*
	 * Localized strings.
	 */
	const strings = {

		download:
			'<?php echo esc_js(
				__( 'Download', 'srft-theme' )
			); ?>',

		view:
			'<?php echo esc_js(
				__( 'View', 'srft-theme' )
			); ?>',

		forStudents:
			'<?php echo esc_js(
				__( 'For Students', 'srft-theme' )
			); ?>',

		forEmployees:
			'<?php echo esc_js(
				__( 'For Employees', 'srft-theme' )
			); ?>',

		documentsFound:
			'<?php echo esc_js(
				__( 'documents found.', 'srft-theme' )
			); ?>',

		noDocuments:
			'<?php echo esc_js(
				__( 'No documents found.', 'srft-theme' )
			); ?>',

		unableToLoad:
			'<?php echo esc_js(
				__(
					'Unable to load document data. Please try again later.',
					'srft-theme'
				)
			); ?>',

		goToPage:
			'<?php echo esc_js(
				__( 'Go to page', 'srft-theme' )
			); ?>'

	};


	/*
	 * Convert bytes to MB.
	 */
	function bytesToMB(bytes) {

		const numericBytes =
			Number(bytes);


		if (
			!Number.isFinite(
				numericBytes
			) ||
			numericBytes <= 0
		) {
			return '0.00';
		}


		return (
			numericBytes /
			1048576
		).toFixed(2);

	}


	/*
	 * Create safe text node.
	 *
	 * API values are inserted as text rather
	 * than HTML to reduce XSS risk.
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
	 * Validate URL before using it in href/src.
	 *
	 * Only HTTP and HTTPS URLs are accepted.
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
	 * Decode WordPress HTML entities.
	 *
	 * WordPress REST API titles may contain
	 * encoded HTML entities.
	 */
	function decodeHTML(value) {

		if (!value) {
			return '';
		}


		const tempDiv =
			document.createElement(
				'div'
			);


		tempDiv.innerHTML =
			value;


		return (
			tempDiv.textContent ||
			tempDiv.innerText ||
			''
		);

	}


	/*
	 * Remove HTML tags from WordPress title.
	 */
	function cleanTitle(value) {

		if (!value) {
			return '';
		}


		const tempDiv =
			document.createElement(
				'div'
			);


		tempDiv.innerHTML =
			value;


		return (
			tempDiv.textContent ||
			tempDiv.innerText ||
			''
		).trim();

	}


	/*
	 * Get document category.
	 *
	 * Supports both:
	 *
	 * 1. String:
	 *    "Students"
	 *
	 * 2. Object:
	 *    { value: "Students" }
	 */
	function getDocumentCategory(acf) {

		if (
			!acf ||
			!acf['document-category']
		) {

			return '';

		}


		const category =
			acf['document-category'];


		if (
			typeof category ===
			'object' &&
			category !== null &&
			typeof category.value ===
			'string'
		) {

			return category.value;

		}


		if (
			typeof category ===
			'string'
		) {

			return category;

		}


		return '';

	}


	/*
	 * Get localized category.
	 */
	function getLocalizedCategory(
		category
	) {

		const localizedCategories = {

			'Students':
				strings.forStudents,

			'Employees':
				strings.forEmployees

		};


		return (
			localizedCategories[category] ||
			category
		);

	}


	/*
	 * Get document file URL.
	 *
	 * Supports an ACF file array.
	 */
	function getDocumentFileURL(
		documentField
	) {

		if (!documentField) {
			return '';
		}


		if (
			typeof documentField ===
			'object' &&
			typeof documentField.url ===
			'string'
		) {

			return documentField.url;

		}


		/*
		 * In case ACF returns the
		 * URL directly.
		 */
		if (
			typeof documentField ===
			'string'
		) {

			return documentField;

		}


		return '';

	}


	/*
	 * Create document table row.
	 */
	function createDocumentRow(
		documentItem,
		index
	) {

		const row =
			document.createElement(
				'tr'
			);

		row.className =
			'Rtable-row';


		/*
		 * Serial number.
		 */
		const serialCell =
			document.createElement(
				'td'
			);

		serialCell.className =
			'Rtable-cell location-cell';


		const serialContent =
			document.createElement(
				'div'
			);

		serialContent.className =
			'Rtable-cell--content';


		const serial =
			document.createElement(
				'span'
			);

		serial.className =
			'SL';


		serial.appendChild(
			createSafeText(
				index + 1
			)
		);


		serialContent.appendChild(
			serial
		);


		serialCell.appendChild(
			serialContent
		);


		/*
		 * Title.
		 */
		const titleCell =
			document.createElement(
				'th'
			);

		titleCell.className =
			'Rtable-cell name-cell';


		titleCell.setAttribute(
			'scope',
			'row'
		);


		const titleContent =
			document.createElement(
				'div'
			);

		titleContent.className =
			'Rtable-cell--content';


		titleContent.appendChild(
			createSafeText(
				documentItem.title
			)
		);


		titleCell.appendChild(
			titleContent
		);


		/*
		 * Category.
		 */
		const categoryCell =
			document.createElement(
				'td'
			);

		categoryCell.className =
			'Rtable-cell tenure-cell';


		const categoryContent =
			document.createElement(
				'div'
			);

		categoryContent.className =
			'Rtable-cell--content';


		const categorySpan =
			document.createElement(
				'span'
			);


		categorySpan.appendChild(
			createSafeText(
				getLocalizedCategory(
					documentItem.category
				)
			)
		);


		categoryContent.appendChild(
			categorySpan
		);


		categoryCell.appendChild(
			categoryContent
		);


		/*
		 * Document link.
		 */
		const documentCell =
			document.createElement(
				'td'
			);

		documentCell.className =
			'Rtable-cell access-link-cell';


		const documentContent =
			document.createElement(
				'div'
			);

		documentContent.className =
			'Rtable-cell--content';


		const fileURL =
			getSafeURL(
				documentItem.fileURL
			);


		if (fileURL) {

			const link =
				document.createElement(
					'a'
				);

			link.href =
				fileURL;


			/*
			 * PDF icon.
			 */
			const pdfIcon =
				document.createElement(
					'img'
				);

			pdfIcon.src =
				pdfIconURL;

			pdfIcon.alt =
				'';

			pdfIcon.className =
				'pdf_icon';

			pdfIcon.setAttribute(
				'aria-hidden',
				'true'
			);


			link.appendChild(
				pdfIcon
			);


			/*
			 * Download text.
			 */
			const downloadText =
				document.createElement(
					'span'
				);


			downloadText.appendChild(
				createSafeText(
					'(' +
					strings.download +
					' - ' +
					documentItem.fileSize +
					' MB)'
				)
			);


			link.appendChild(
				downloadText
			);


			documentContent.appendChild(
				link
			);

		} else {

			/*
			 * If no ACF document file is
			 * available, use the post URL.
			 */
			const linkURL =
				getSafeURL(
					documentItem.link
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
						strings.view
					)
				);


				documentContent.appendChild(
					link
				);

			}

		}


		documentCell.appendChild(
			documentContent
		);


		/*
		 * Assemble row.
		 */
		row.appendChild(
			serialCell
		);

		row.appendChild(
			titleCell
		);

		row.appendChild(
			categoryCell
		);

		row.appendChild(
			documentCell
		);


		return row;

	}


	/*
	 * Render current page.
	 */
	function renderDocuments() {

		/*
		 * Clear existing rows.
		 */
		tableBody.innerHTML = '';


		const startIndex =
			(currentPage - 1) *
			itemsPerPage;


		const endIndex =
			startIndex +
			itemsPerPage;


		const currentDocuments =
			filteredDocuments.slice(
				startIndex,
				endIndex
			);


		/*
		 * No results.
		 */
		if (
			currentDocuments.length ===
			0
		) {

			noResults.style.display =
				'block';

		} else {

			noResults.style.display =
				'none';

		}


		/*
		 * Create rows.
		 *
		 * The serial number is relative
		 * to the complete result set,
		 * not just the current page.
		 */
		currentDocuments.forEach(
			function (
				documentItem,
				index
			) {

				const row =
					createDocumentRow(
						documentItem,
						startIndex + index
					);


				tableBody.appendChild(
					row
				);

			}
		);


		updatePagination();

		updateSearchStatus();

	}


	/*
	 * Filter documents.
	 */
	function applyFilters() {

		const searchTerm =
			filterField.value
				.trim()
				.toLowerCase();


		filteredDocuments =
			documentList.filter(
				function (
					documentItem
				) {

					if (!searchTerm) {
						return true;
					}


					const title =
						(
							documentItem.title ||
							''
						).toLowerCase();


					const category =
						(
							documentItem.category ||
							''
						).toLowerCase();


					return (
						title.includes(
							searchTerm
						) ||
						category.includes(
							searchTerm
						)
					);

				}
			);


		/*
		 * Always return to page 1
		 * after a search.
		 */
		currentPage = 1;


		renderDocuments();

	}


	/*
	 * Calculate total pages.
	 */
	function getTotalPages() {

		return Math.ceil(
			filteredDocuments.length /
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
		 * Hide pagination if there is
		 * only one page or no results.
		 */
		if (totalPages <= 1) {

			pagination.style.display =
				'none';

			return;

		}


		pagination.style.display =
			'block';


		/*
		 * Remove old page numbers.
		 */
		paginationList
			.querySelectorAll(
				'.document-page-number'
			)
			.forEach(
				function (item) {

					item.remove();

				}
			);


		/*
		 * Generate page numbers.
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
				'document-page-number';


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
				page;


			link.setAttribute(
				'aria-label',
				strings.goToPage +
				' ' +
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
			 * Insert page number before
			 * Next button.
			 */
			paginationList.insertBefore(
				li,
				nextPage
			);

		}


		/*
		 * Update button states.
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
	 * Enable / disable pagination.
	 */
	function setPaginationState(
		element,
		disabled
	) {

		const link =
			element.querySelector(
				'a'
			);


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


		renderDocuments();


		/*
		 * Scroll back to the Downloads
		 * section.
		 */
		const app =
			document.getElementById(
				'downloads-app'
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
	 * Update accessible search status.
	 */
	function updateSearchStatus() {

		const count =
			filteredDocuments.length;


		if (count > 0) {

			searchStatus.textContent =
				count +
				' ' +
				strings.documentsFound;

		} else {

			searchStatus.textContent =
				strings.noDocuments;

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
	 * Page number event delegation.
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
	 * Search field.
	 */
	filterField.addEventListener(
		'input',
		function () {

			applyFilters();

		}
	);


	/*
	 * Load documents from WordPress
	 * REST API.
	 */
	function loadDocuments() {

		documentsLoading.style.display =
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

				/*
				 * Validate API response.
				 */
				if (
					!Array.isArray(data)
				) {

					throw new Error(
						'Unexpected REST API response.'
					);

				}


				/*
				 * Filter and map documents.
				 */
				documentList =
					data

					.filter(
						function (post) {

							const acf =
								post.acf || {};


							const category =
								getDocumentCategory(
									acf
								);


							/*
							 * Only display:
							 *
							 * Students
							 * Employees
							 *
							 * English and Hindi
							 * versions.
							 */
							return (
								category ===
									'Employees' ||
								category ===
									'Students' ||
								category ===
									'कर्मचारी' ||
								category ===
									'छात्र'
							);

						}
					)


					.map(
						function (post) {

							const acf =
								post.acf || {};


							const category =
								getDocumentCategory(
									acf
								);


							const documentField =
								acf['document'] ||
								null;


							const fileURL =
								getDocumentFileURL(
									documentField
								);


							let fileSize =
								'0.00';


							if (
								documentField &&
								typeof documentField ===
								'object'
							) {

								fileSize =
									bytesToMB(
										documentField.filesize
									);

							}


							return {

								title:
									post.title &&
									typeof post.title.rendered ===
									'string'
										? cleanTitle(
											post.title.rendered
										)
										: '',


								link:
									typeof post.link ===
									'string'
										? post.link
										: '',


								fileURL:
									fileURL,


								fileSize:
									fileSize,


								category:
									decodeHTML(
										category
									)

							};

						}
					);


				/*
				 * Initial state.
				 */
				filteredDocuments =
					documentList.slice();


				currentPage = 1;


				renderDocuments();


				documentsLoading.style.display =
					'none';

			}
		)


		.catch(
			function (error) {

				console.error(
					'Error fetching document data:',
					error
				);


				documentList = [];

				filteredDocuments = [];


				documentsLoading.style.display =
					'none';


				noResults.textContent =
					strings.unableToLoad;


				noResults.style.display =
					'block';


				pagination.style.display =
					'none';


				searchStatus.textContent =
					strings.unableToLoad;

			}
		);

	}


	/*
	 * Start application.
	 */
	loadDocuments();

})();

</script>


<?php get_footer(); ?>

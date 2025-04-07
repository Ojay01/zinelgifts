<!-- Scripts Component (components/product/scripts.blade.php) -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js" referrerpolicy="origin"></script>

<!-- Select2 Styles -->
<style>
    /* Toggle Switch Styling */
    .toggle-checkbox:checked {
        transform: translateX(100%);
        border-color: rgb(37, 99, 235);
    }

    .toggle-checkbox:checked+.toggle-label {
        background-color: rgb(37, 99, 235);
    }

    /* Select2 Styling */
    .select2-container--default .select2-selection--multiple {
        background-color: rgb(15 23 42) !important;
        border: 1px solid rgb(51 65 85) !important;
        min-height: 42px !important;
        padding: 2px 8px !important;
        border-radius: 0.5rem !important;
    }

    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border-color: rgb(59 130 246) !important;
        outline: 0;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: rgb(51 65 85) !important;
        border: none !important;
        border-radius: 0.375rem !important;
        padding: 8px 12px !important;
        margin: 4px !important;
        align-items: center !important;
        gap: 4px !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        border: none !important;
        background: none !important;
        padding: 8px !important;
        order: 2 !important;
        font-size: 14px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 16px !important;
        height: 16px !important;
        border-radius: 50% !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
        color: rgb(239 68 68) !important;
    }

    .select2-dropdown {
        background-color: rgb(15 23 42) !important;
        border: 1px solid rgb(51 65 85) !important;
        border-radius: 0.5rem !important;
        margin-top: 4px !important;
    }

    .select2-container--default .select2-search--dropdown .select2-search__field {
        background-color: rgb(30 41 59) !important;
        border: 1px solid rgb(51 65 85) !important;
        color: rgb(229 231 235) !important;
        border-radius: 0.375rem !important;
        padding: 6px 10px !important;
    }

    /* Select2 Single Select Styling */
    .select2-container--default .select2-selection--single {
        background-color: rgb(15 23 42) !important;
        border: 1px solid rgb(51 65 85) !important;
        height: 42px !important;
        padding: 2px 8px !important;
        border-radius: 0.5rem !important;
        display: flex !important;
        align-items: center !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: rgb(229 231 235) !important;
        line-height: normal !important;
        padding-left: 4px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px !important;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: rgb(37 99 235) !important;
        color: white !important;
    }

    .select2-container--default .select2-results__option[aria-selected=true] {
        background-color: rgb(51 65 85) !important;
    }

    .select2-results__option {
        padding: 8px 10px !important;
        color: rgb(229 231 235) !important;
    }

    /* Search box - shared for both types */
    .select2-search--dropdown {
        padding: 8px !important;
    }

    .select2-container--default .select2-search--dropdown .select2-search__field:focus {
        outline: none !important;
        border-color: rgb(59 130 246) !important;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2) !important;
    }

    /* Placeholder color */
    .select2-container--default .select2-selection__placeholder {
        color: rgb(156 163 175) !important;
    }

    /* Clear button */
    .select2-container--default .select2-selection--single .select2-selection__clear,
    .select2-container--default .select2-selection--multiple .select2-selection__clear {
        color: rgb(156 163 175) !important;
        margin-right: 10px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__clear:hover,
    .select2-container--default .select2-selection--multiple .select2-selection__clear:hover {
        color: rgb(239 68 68) !important;
    }
</style>


<script>
    $(document).ready(function () {
        // Initialize select2
        $('.select2-multiple').select2({
            theme: 'default',
            placeholder: function () {
                return $(this).data('placeholder') || 'Select options';
            },
            allowClear: true,
            width: '100%'
        });

        $('.select2-single').select2({
            theme: 'default',
            placeholder: function () {
                return $(this).data('placeholder') || 'Select an option';
            },
            allowClear: true,
            width: '100%'
        });

        initializePricing();

        // Initialize TinyMCE
        tinymce.init({
            selector: '#description',
            plugins: 'anchor autolink charmap codesample link lists searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | removeformat | link image table',
            height: 400,
            skin: 'oxide-dark',
            content_css: 'dark',
            setup: function (editor) {
                editor.on('change', function () {
                    editor.save();
                });
            }
        });

        // Tab Navigation
        $('.tab-button').click(function () {
            const tab = $(this).data('tab');

            // Update active tab button
            $('.tab-button').removeClass('active text-blue-400 border-blue-400').addClass('text-gray-400');
            $(this).addClass('active text-blue-400 border-blue-400').removeClass('text-gray-400');

            // Show selected tab content
            $('.tab-content').addClass('hidden');
            $(`#${tab}-tab`).removeClass('hidden');

            // Update navigation buttons
            updateNavigationButtons(tab);
        });

        // Navigation button handlers
        function updateNavigationButtons(currentTab) {
            const tabs = ['basics', 'attributes', 'pricing', 'description'];
            const currentIndex = tabs.indexOf(currentTab);

            // Hide/show previous button
            if (currentIndex > 0) {
                $('#prev-tab-btn').removeClass('hidden');
            } else {
                $('#prev-tab-btn').addClass('hidden');
            }

            // Hide/show next and submit buttons
            if (currentIndex < tabs.length - 1) {
                $('#next-tab-btn').removeClass('hidden');
                $('#submit-btn').addClass('hidden');
            } else {
                $('#next-tab-btn').addClass('hidden');
                $('#submit-btn').removeClass('hidden');
            }
        }

        // Next button handler
        $('#next-tab-btn').click(function () {
            const tabs = ['basics', 'attributes', 'pricing', 'description'];
            const currentTab = $('.tab-button.active').data('tab');
            const currentIndex = tabs.indexOf(currentTab);

            if (currentIndex < tabs.length - 1) {
                $(`.tab-button[data-tab="${tabs[currentIndex + 1]}"]`).click();
            }
        });

        // Previous button handler
        $('#prev-tab-btn').click(function () {
            const tabs = ['basics', 'attributes', 'pricing', 'description'];
            const currentTab = $('.tab-button.active').data('tab');
            const currentIndex = tabs.indexOf(currentTab);

            if (currentIndex > 0) {
                $(`.tab-button[data-tab="${tabs[currentIndex - 1]}"]`).click();
            }
        });

        // Image upload preview
        $('#image').change(function () {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $('#imagePreview').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        // Category-Subcategory relationship
        $('#category_id').change(function () {
            const categoryId = $(this).val();

            if (categoryId) {
                $.ajax({
                    url: `/api/categories/${categoryId}/subcategories`,
                    type: 'GET',
                    success: function (data) {
                        $('#subcategory_id').empty();
                        $('#subcategory_id').append('<option value="">Select Subcategory</option>');

                        $.each(data, function (key, value) {
                            $('#subcategory_id').append(`<option value="${value.id}">${value.name}</option>`);
                        });
                    }
                });
            } else {
                $('#subcategory_id').empty();
                $('#subcategory_id').append('<option value="">Select Subcategory</option>');
            }
        });

        // Variable pricing toggle
        $('#variable').change(function () {
            if ($(this).is(':checked')) {
                $('#standard-price-container').addClass('hidden');
                $('#pricing-type-container').removeClass('hidden');

                // Check the default pricing type
                updatePricingDisplay();
            } else {
                $('#standard-price-container').removeClass('hidden');
                $('#pricing-type-container').addClass('hidden');
                $('#size-pricing-container').addClass('hidden');
                $('#quality-pricing-container').addClass('hidden');
                $('#matrix-pricing-container').addClass('hidden');
            }
        });

        // Pricing type radio buttons change event
        $('input[name="pricing_type"]').change(function () {
            updatePricingDisplay();
        });

        function initializePricing() {
            // Check if variable pricing is enabled on page load
            if ($('#variable').is(':checked')) {
                $('#standard-price-container').addClass('hidden');
                $('#pricing-type-container').removeClass('hidden');
                updatePricingDisplay();
            } else {
                $('#pricing-type-container').addClass('hidden');
                $('.pricing-container').addClass('hidden');
            }
        }

        function updatePricingDisplay() {
            // Hide all pricing containers first
            $('#size-pricing-container').addClass('hidden');
            $('#quality-pricing-container').addClass('hidden');
            $('#matrix-pricing-container').addClass('hidden');

            // Show the appropriate container based on the selected pricing type
            const pricingType = $('input[name="pricing_type"]:checked').val();

            if (pricingType == 1) {
                $('#size-pricing-container').removeClass('hidden');
                loadSizePricing();
            } else if (pricingType == 2) {
                $('#quality-pricing-container').removeClass('hidden');
                loadQualityPricing();
            } else if (pricingType == 3) {
                $('#matrix-pricing-container').removeClass('hidden');
                loadMatrixPricing();
            }
        }

        // Function to load size-based pricing
        function loadSizePricing() {
            const selectedSizes = $('#sizes').val() || [];
            let existingPrices = [];

            // Parse existing prices safely
            try {
                existingPrices = @json($product->attributes->prices ?? []);

                // If it's a string, parse it as JSON
                if (typeof existingPrices === 'string') {
                    existingPrices = JSON.parse(existingPrices);
                }
            } catch (e) {
                console.error('Error parsing existing prices:', e);
                existingPrices = [];
            }

            if (selectedSizes.length > 0) {
                let sizePricingHtml = '<div class="space-y-3">';

                selectedSizes.forEach(sizeId => {
                    const sizeName = $(`#sizes option[value="${sizeId}"]`).text();

                    // Find all price entries for this size (without quality)
                    const sizePrices = existingPrices.filter(price =>
                        price.size == sizeId && !price.hasOwnProperty('quality')
                    );

                    // Get the first matching price or use defaults
                    const priceData = sizePrices.length > 0 ? sizePrices[0] : { price: 0, discount: 0 };

                    sizePricingHtml += `
                    <div class="grid grid-cols-3 gap-4 items-center p-3 bg-slate-800 rounded-lg">
                        <span class="text-sm font-medium text-gray-300">${sizeName}</span>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <span class="text-gray-400">₣</span>
                            </div>
                            <input type="number" 
                                   name="size_pricing[${sizeId}][price]" 
                                   value="${priceData.price}" 
                                   step="0.01"
                                   class="w-full rounded-lg border border-slate-700 bg-slate-900 pl-7 pr-3 py-2 text-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div class="relative">
                            <input type="number" 
                                   name="size_pricing[${sizeId}][discount]" 
                                   value="${priceData.discount}" 
                                   min="0"
                                   max="100"
                                   class="w-full rounded-lg border border-slate-700 bg-slate-900 pl-3 pr-8 py-2 text-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <span class="text-gray-400">%</span>
                            </div>
                        </div>
                    </div>
                `;
                });

                sizePricingHtml += '</div>';
                $('#size-variants').html(sizePricingHtml);
            } else {
                $('#size-variants').html(`
                <div class="p-4 bg-slate-800 rounded-lg text-center">
                    <p class="text-gray-400">Please select sizes in the Attributes tab first</p>
                </div>
            `);
            }
        }

        // Function to load quality-based pricing
        function loadQualityPricing() {
            const selectedQualities = $('#qualities').val() || [];
            let existingPrices = [];

            // Parse existing prices safely
            try {
                existingPrices = @json($product->attributes->prices ?? []);

                // If it's a string, parse it as JSON
                if (typeof existingPrices === 'string') {
                    existingPrices = JSON.parse(existingPrices);
                }
            } catch (e) {
                console.error('Error parsing existing prices:', e);
                existingPrices = [];
            }


            if (selectedQualities.length > 0) {
                let qualityPricingHtml = '<div class="space-y-3">';

                selectedQualities.forEach(qualityId => {
                    const qualityName = $(`#qualities option[value="${qualityId}"]`).text();

                    // Find all price entries for this quality (without size)
                    const qualityPrices = existingPrices.filter(price =>
                        price.quality == qualityId && !price.hasOwnProperty('size')
                    );

                    // Get the first matching price or use defaults
                    const priceData = qualityPrices.length > 0 ? qualityPrices[0] : { price: 0, discount: 0 };

                    qualityPricingHtml += `
                <div class="grid grid-cols-3 gap-4 items-center p-3 bg-slate-800 rounded-lg">
                    <span class="text-sm font-medium text-gray-300">${qualityName}</span>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <span class="text-gray-400">₣</span>
                        </div>
                        <input type="number" 
                               name="quality_pricing[${qualityId}][price]" 
                               value="${priceData.price}" 
                               step="0.01"
                               class="w-full rounded-lg border border-slate-700 bg-slate-900 pl-7 pr-3 py-2 text-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div class="relative">
                        <input type="number" 
                               name="quality_pricing[${qualityId}][discount]" 
                               value="${priceData.discount}" 
                               min="0"
                               max="100"
                               class="w-full rounded-lg border border-slate-700 bg-slate-900 pl-3 pr-8 py-2 text-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <span class="text-gray-400">%</span>
                        </div>
                    </div>
                </div>
            `;
                });

                qualityPricingHtml += '</div>';
                $('#quality-variants').html(qualityPricingHtml);
            } else {
                $('#quality-variants').html(`
            <div class="p-4 bg-slate-800 rounded-lg text-center">
                <p class="text-gray-400">Please select qualities in the Attributes tab first</p>
            </div>
        `);
            }
        }

        // Function to load matrix pricing
        function loadMatrixPricing() {
            const selectedSizes = $('#sizes').val() || [];
            const selectedQualities = $('#qualities').val() || [];

            // Parse the existing prices JSON string
            const existingPrices = @isset($product->attributes->prices)
                JSON.parse(@json($product->attributes->prices))
            @else
                []
            @endisset;


            if (selectedSizes.length > 0 && selectedQualities.length > 0) {
                let matrixHtml = `
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr>
                            <th class="p-2 border border-slate-700 bg-slate-800 text-left">Size / Quality</th>
        `;

                // Add quality headers
                selectedQualities.forEach(qualityId => {
                    const qualityName = $(`#qualities option[value="${qualityId}"]`).text();
                    matrixHtml += `<th class="p-2 border border-slate-700 bg-slate-800 text-center">${qualityName}</th>`;
                });

                matrixHtml += `</tr></thead><tbody>`;

                // Add rows for each size
                selectedSizes.forEach(sizeId => {
                    const sizeName = $(`#sizes option[value="${sizeId}"]`).text();

                    matrixHtml += `
                <tr>
                    <td class="p-2 border border-slate-700 bg-slate-800 font-medium">${sizeName}</td>
            `;

                    // Add price inputs for each quality
                    selectedQualities.forEach(qualityId => {
                        // Find existing price for this size-quality combination
                        const existingPrice = existingPrices.find(price =>
                            parseInt(price.size) === parseInt(sizeId) &&
                            parseInt(price.quality) === parseInt(qualityId)
                        );


                        matrixHtml += `
                    <td class="p-2 border border-slate-700">
                        <div class="grid grid-cols-1 gap-2">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <span class="text-gray-400">₣</span>
                                </div>
                                <input type="number" 
                                       name="matrix_pricing[${sizeId}][${qualityId}][price]" 
                                       value="${existingPrice ? existingPrice.price : 0}" 
                                       step="0.01"
                                       class="w-full rounded-lg border border-slate-700 bg-slate-900 pl-7 pr-3 py-2 text-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm"
                                       placeholder="Price">
                            </div>
                            <div class="relative">
                                <input type="number" 
                                       name="matrix_pricing[${sizeId}][${qualityId}][discount]" 
                                       value="${existingPrice ? existingPrice.discount : 0}" 
                                       min="0"
                                       max="100"
                                       class="w-full rounded-lg border border-slate-700 bg-slate-900 pl-3 pr-8 py-2 text-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm"
                                       placeholder="Discount">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <span class="text-gray-400">%</span>
                                </div>
                            </div>
                        </div>
                    </td>
                `;
                    });

                    matrixHtml += `</tr>`;
                });

                matrixHtml += `</tbody></table></div>`;

                $('#matrix-variants').html(matrixHtml);
            } else {
                $('#matrix-variants').html(`
            <div class="p-4 bg-slate-800 rounded-lg text-center">
                <p class="text-gray-400">Please select both sizes and qualities in the Attributes tab first</p>
            </div>
        `);
            }
        }

        // Update pricing displays when attributes change
        $('#sizes').on('change', function () {
            if ($('#variable').is(':checked')) {
                const pricingType = $('input[name="pricing_type"]:checked').val();
                if (pricingType == 1 || pricingType == 3) {
                    updatePricingDisplay();
                }
            }
        });

        $('#qualities').on('change', function () {
            if ($('#variable').is(':checked')) {
                const pricingType = $('input[name="pricing_type"]:checked').val();
                if (pricingType == 2 || pricingType == 3) {
                    updatePricingDisplay();
                }
            }
        });

        function collectPricingData() {
            // Array to store all pricing variations
            const pricingData = [];

            // If variable pricing is enabled
            if ($('#variable').is(':checked')) {
                const pricingType = $('input[name="pricing_type"]:checked').val();

                // Size-based pricing
                if (pricingType == 1) {
                    const selectedSizes = $('#sizes').val() || [];

                    selectedSizes.forEach(sizeId => {
                        const price = parseFloat($(`input[name="size_pricing[${sizeId}][price]"]`).val() || 0);
                        const discount = parseInt($(`input[name="size_pricing[${sizeId}][discount]"]`).val() || 0);

                        pricingData.push({
                            size: parseInt(sizeId),
                            price: price,
                            discount: discount
                        });
                    });
                }

                // Quality-based pricing
                else if (pricingType == 2) {
                    const selectedQualities = $('#qualities').val() || [];

                    selectedQualities.forEach(qualityId => {
                        const price = parseFloat($(`input[name="quality_pricing[${qualityId}][price]"]`).val() || 0);
                        const discount = parseInt($(`input[name="quality_pricing[${qualityId}][discount]"]`).val() || 0);

                        pricingData.push({
                            quality: parseInt(qualityId),
                            price: price,
                            discount: discount
                        });
                    });
                }

                // Matrix pricing (size × quality)
                else if (pricingType == 3) {
                    const selectedSizes = $('#sizes').val() || [];
                    const selectedQualities = $('#qualities').val() || [];

                    selectedSizes.forEach(sizeId => {
                        selectedQualities.forEach(qualityId => {
                            const price = parseFloat($(`input[name="matrix_pricing[${sizeId}][${qualityId}][price]"]`).val() || 0);
                            const discount = parseInt($(`input[name="matrix_pricing[${sizeId}][${qualityId}][discount]"]`).val() || 0);

                            pricingData.push({
                                size: parseInt(sizeId),
                                quality: parseInt(qualityId),
                                price: price,
                                discount: discount
                            });
                        });
                    });
                }
            }

            // Return the pricing data array
            return pricingData;
        }

        // Form validation
        $('form').on('submit', function (e) {
            // Basic validation
            const name = $('#name').val();
            const category = $('#category_id').val();
            const price = $('#price').val();
            const image = $('#image').val();

            let isValid = true;

            // Create a toast notification
            function showToast(message, type = 'error') {
                const toast = `
            <div class="toast-notification bg-${type === 'error' ? 'red-500' : 'green-500'} text-white px-4 py-3 rounded-lg shadow-lg flex items-center justify-between">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${type === 'error' ? 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z' : 'M5 13l4 4L19 7'}" />
                    </svg>
                    <span>${message}</span>
                </div>
                <button type="button" class="ml-4 toast-close">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        `;

                $('#toaster').append(toast);

                setTimeout(() => {
                    $('.toast-notification').first().remove();
                }, 5000);
            }

            // Validate required fields
            if (!name) {
                showToast('Product name is required');
                isValid = false;
            }

            if (!category) {
                showToast('Category is required');
                isValid = false;
            }

            if (!price && !$('#variable').is(':checked')) {
                showToast('Price is required');
                isValid = false;
            }

            if (!$('#imagePreview').attr('src') || $('#imagePreview').attr('src') === '/api/placeholder/256/256') {
                showToast('Product image is required');
                isValid = false;
            }

            // Variable pricing validation
            if ($('#variable').is(':checked')) {
                const pricingData = collectPricingData();

                if (pricingData.length === 0) {
                    showToast('Please set at least one price variant');
                    isValid = false;
                } else {
                    // Set the pricing data as JSON in the hidden field
                    $('#pricing_data').val(JSON.stringify(pricingData));
                }
            }

            if (!isValid) {
                e.preventDefault();
                return false;
            }

            return true;
        });

        // Handle toast close button
        $(document).on('click', '.toast-close', function () {
            $(this).closest('.toast-notification').remove();
        });

        // Initialize with first tab
        updateNavigationButtons('basics');
    });

</script>
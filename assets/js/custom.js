// Function to initialize form fields like Flatpickr (for date pickers) and Select2
function initializeCustomField() {
    var originalDateValues = {};
    $('.flatpickr-date').each(function (index) {
        var input = $(this);
        originalDateValues[input.attr('id') || index] = input.val(); // Use ID or index if no ID is set

        // Initialize Flatpickr
        flatpickr(input[0], {
            dateFormat: "Y-m-d",
            // altInput: true,
            // altFormat: "j F Y",
            allowInput: false
        });
    });

    $('.select2').each(function () {
        $(this).select2({
            // theme: 'bootstrap-5',
            minimumInputLength: 0,
            dropdownParent: $(this).parent(),
        });

        $(this).on('select2:open', function () {
            setTimeout(() => {
                let searchField = document.querySelector('.select2-container--open .select2-search__field');
                if (searchField) {
                    searchField.focus();
                }
            }, 100);
        });
    });
}

function numberFormat(input) {
    var value = input.replace(/[^\d,.]/g,
        ''); // Remove non-numeric characters except commas and periods using regex
    value = value.replace(/\./g, ''); // Replace periods with empty string to avoid thousand separator confusion
    value = value.replace(',', '.'); // Replace the first comma with a period for decimal separator

    // Remove any additional commas after the first one
    value = value.replace(/,/g, function (match, offset, original) {
        return offset ? "" : match;
    });

    // Format with thousand separator (periods)
    value = addThousandSeparator(value);

    // Update the input value
    input.value = value;
}

function addThousandSeparator(value) {
    // Split the value into integer and decimal parts
    var parts = value.split('.');
    var integerPart = parts[0];
    var decimalPart = parts.length > 1 ? ',' + parts[1] : '';

    // Add thousand separator to the integer part
    integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

    // Combine integer and decimal parts
    return integerPart + decimalPart;
}
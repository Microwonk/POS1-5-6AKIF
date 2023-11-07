$(document).ready(function() {
    // Get the search input element and the table rows
    var $searchInput = $('#search');
    var $tableRows = $('table tbody tr');

    $searchInput.on('keyup', function() {
        var searchText = $(this).val().toLowerCase();

        // Loop through the table rows
        var foundAny = false;
        $tableRows.each(function() {
            var $row = $(this);
            var name = $row.find('td:nth-child(1) a').text().toLowerCase();
            var mail = $row.find('td:nth-child(2) a').text().toLowerCase();

            // Check if the row matches the search text
            if (name.includes(searchText) || mail.includes(searchText)) {
                $row.show();
                foundAny = true;
            } else {
                $row.hide();
            }
        });
    });
});

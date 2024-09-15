<div class="container">
    <div class="row">
        <h2>Bewerberübersicht</h2>
    </div>
    <div class="row">
        <p class="form-inline">
            <select class="btn btn-light dropdown-toggle" name="jobOffer_id" id="jobOffer_id" style="width: 200px">
                <?php
                foreach($model as $jobOffer):
                    echo '<option value="' . $jobOffer->getId() . '">' . $jobOffer->getTitle() . '</option>';
                endforeach;
                ?>
            </select>
            <button id="btnSearch" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Alle Bewerber anzeigen</button>
            <br/>

        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th id="firstname-sort">Vorname</th>
                <th id="lastname-sort">Nachname</th>
                <th id="date-sort">Bewerbungsdatum</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="applicants">

            </tbody>
        </table>
    </div>
</div> <!-- /container -->

<script>
    document.addEventListener("DOMContentLoaded", async (e) => {
        // Fetch all applicants
        let allApplicants = await fetch("/fk/fk23/api/applicant", {
            method: "GET",
        }).then(r => r.json());

        let currentApplicants = [];

        const table = document.getElementById("applicants");
        const jobOffers = document.getElementById("jobOffer_id");
        const btnSearch = document.getElementById("btnSearch");

        const sorters = {
            firstname: 0,
            lastname: 0,
            date: 0,
        };

        // Function to render applicants based on filtered results
        const renderApplicants = (filteredApplicants) => {
            if (sorters.firstname !== 0) {
                filteredApplicants.sort((a, b) => sorters.firstname * a.first_name.localeCompare(b.first_name));
            } else if (sorters.lastname !== 0) {
                filteredApplicants.sort((a, b) => sorters.lastname * a.last_name.localeCompare(b.last_name));
            } else if (sorters.date !== 0) {
                filteredApplicants.sort((a, b) => sorters.date * new Date(a.application_date) - new Date(b.application_date));
            }
            // Clear the current table content
            table.innerHTML = "";

            // Loop through filtered applicants and render rows
            filteredApplicants.forEach((applicant) => {
                var row = document.createElement("tr");
                var vorname = document.createElement("td");
                vorname.textContent = applicant.first_name;
                var nachname = document.createElement("td");
                nachname.textContent = applicant.last_name;
                var date = document.createElement("td");
                date.textContent = applicant.application_date;
                var buttons = document.createElement("td");
                buttons.innerHTML = `<a class="btn btn-info" href="index.php?r=applicant/view&id=${applicant.id}"><span class="glyphicon glyphicon-eye-open"></span></a>
                <a class="btn btn-primary" href="index.php?r=applicant/update&id=${applicant.id}"><span class="glyphicon glyphicon-pencil"></span></a>
                <a class="btn btn-danger" href="index.php?r=applicant/delete&id=${applicant.id}"><span class="glyphicon glyphicon-remove"></span></a>`;
                row.appendChild(vorname);
                row.appendChild(nachname);
                row.appendChild(date);
                row.appendChild(buttons);
                table.appendChild(row);
            });
            currentApplicants = filteredApplicants;
        };

        // Initially render all applicants
        renderApplicants(allApplicants);

        // Add event listener for dropdown change to filter applicants
        jobOffers.addEventListener("change", function() {
            const selectedJobOfferId = jobOffers.value;

            // Filter applicants based on selected job offer
            const filteredApplicants = allApplicants.filter(applicant =>
                applicant.joboffer_id == selectedJobOfferId
            );

            // Render the filtered applicants
            renderApplicants(filteredApplicants);
        });

        btnSearch.addEventListener("click", function() {
            renderApplicants(allApplicants);
        });

        // TODO sorting
        document.getElementById("firstname-sort").addEventListener("click", function() {
            sorters.firstname = sorters.firstname === 1 ? -1 : 1;
            sorters.lastname = 0;
            sorters.date = 0;
            renderApplicants(currentApplicants);
        });
        document.getElementById("lastname-sort").addEventListener("click", function() {
            sorters.firstname = 0;
            sorters.lastname = sorters.lastname === 1 ? -1 : 1;
            sorters.date = 0;
            renderApplicants(currentApplicants);
        });
        document.getElementById("date-sort").addEventListener("click", function() {
            sorters.firstname = 0;
            sorters.lastname = 0;
            sorters.date = sorters.date === 1 ? -1 : 1;
            renderApplicants(currentApplicants);
        });
    });
</script>

        <footer class="footer mt-auto py-3 bg-dark text-white fixed-bottom">
            <div class="container text-center">
                <span>&copy; 2022 Re-View</span>
            </div>
        </footer>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
            }, false)
        })
        })();
    </script>
    <script>
        // Define data
        var tabledata = [
        {id:1, name:"John Doe", email:"johndoe@example.com"}, //example data, replace with actual data
        ];

        // Create Tabulator on DOM element with id "profile-table"
        var table = new Tabulator("#profile-table", {
        data:tabledata, //assign data to table
        layout:"fitColumns", //fit columns to width of table (optional)
        columns:[ //Define Table Columns
            {title:"Name", field:"name", sortable:true},
            {title:"Email", field:"email", sortable:true},
        ],
        });

        // Add event listener to the button
        document.getElementById('modify-button').addEventListener('click', function() {
        // Redirect to the page to modify personal info
        window.location.href = 'update_profile.php';
        });
    </script>    
    </body>
</html>
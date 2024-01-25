        <footer class="footer mt-auto py-3 bg-dark text-white">
            <div class="container text-center">
                <span>&copy; 2024 Re-View</span>
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
        /*var tabledata = [
        {id:1, name:"John Doe", email:"johndoe@example.com"}, //example data, replace with actual data
        ];*/
        // Create Tabulator on DOM element with id "profile-table"
        var usr_table = new Tabulator("#profile-table", {
            ajaxURL:"/SAW/Progetto_SAW/private/retrieve_usr_data.php", //ajax URL
            
            //data:tabledata, //assign data to table
            layout:"fitDataTable", //fit columns to width of data (optional)
            validationMode:"blocking",
            columns:[ //Define Table Columns
                {title:"Nome", field:"Nome", editor:"input", validator:["required","regex:^[A-Za-z]+$"]/*sortable:true,headerFilter:"input"*/},
                {title:"Cognome", field:"Cognome",editor:"input",validator:["required","regex:^[A-Za-z]+$"]},
                {title:"Email", field:"Email"},
                {title:"Data di Nascita", field:"Data_Nascita", editor:"date", editorParams:
                    {
                        min:"1950-01-01", // the minimum allowed value for the date picker
                        max:"2009-12-31", // the maximum allowed value for the date picker
                        verticalNavigation:"table", //navigate cursor around table without changing the value
                    }
                },
                {title:"Genere", field:"Genere", editor:"list", editorParams:{values:{"Maschio":"Maschio", "Femmina":"Femmina", "Altro":"Altro"}}},
                {title:"Paese", field:"Paese",editor:"input",validator:"regex:^[A-Za-z]+$"},
            ],
        });
        usr_table.setData()
        .then(function(){
            //run code after table has been successfully updated
        })
        .catch(function(error){
            //handle error loading data
        });
        // Add event listener to the button
        document.getElementById('modify-usr-data-button').addEventListener('click', function() {
            // Redirect to the page to modify personal info
            row = usr_table.getData()[0];
            //alert(usr_data.nome);
            fetch('/SAW/Progetto_SAW/private/update_profile.php',{
                method : 'post',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(row)
            })
            .then(function (response){
                if (!response.ok) {
                    throw new Error('HTTP error ' + response.status);
                }
                return response.json();
            })
            .then(function (data){          
                console.log(data);
            })
            .catch(function (error){
                console.log("Error:", error);
            });
        });
          
    </script>
    <script>
        var table = new Tabulator("#catalog-table", {
            ajaxURL:"/SAW/Progetto_SAW/private/get_catalog.php", //ajax URL

            //data:tabledata, //assign data to table
            layout:"fitDataTable", //fit columns to width of data (optional)
            columns:[ //Define Table Columns
                {title:"", field:"img", formatter:"image", headerSort:false, formatterParams:{
                    height:"120px",
                    width:"80px",
                    urlPrefix:"/SAW/Progetto_SAW/assets/img/film/",
                    urlSuffix:".jpg"
                }},
                {title:"Nome", field:"nome"},
                {title:"Genere", field:"genere"},
                {title:"Regista", field:"regista"},
                {title:"Paese", field:"paese"},
                {title:"Anno", field:"anno"},
                {title:"Descrizione", field:"descrizione"},
            ]
        });
        table.setData()
        .then(function(){
            //run code after table has been successfully updated
        })
        .catch(function(error){
            //handle error loading data
        });
        // Add event listener to the button
        document.getElementById('modify-button').addEventListener('click', function() {
            // Redirect to the page to modify personal info
            window.location.href = 'update_profile.php';
        });
    </script>
    <script>
        /*var all_users_table = new Tabulator("#admin-table", {
            ajaxURL:"/SAW/Progetto_SAW/private/get_admin.php", //ajax URL

            //data:tabledata, //assign data to table
            layout:"fitDataTable", //fit columns to width of data (optional)
            columns:[ //Define Table Columns
                {title:"Nome", field:"Nome"},
                {title:"Cognome", field:"Cognome"},
                {title:"Email", field:"Email"},
                {title:"Elimina", field:"Elimina", formatter:"html"},
                {title:"Ban", field:"Ban", formatter:"html"},
            ]
        });
        table.setData()
        .then(function(){
            //run code after table has been successfully updated
        })
        .catch(function(error){
            //handle error loading data
        });*/
    </script>    
    </body>
</html>
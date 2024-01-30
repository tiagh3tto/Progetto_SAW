</div>    
        <footer class="footer mt-auto py-3 bg-dark text-white">
            <div class="container text-center">
                <span>&copy; 2024 Re-View</span>
            </div>
        </footer>

        <script>
        //form_validation.js
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
        //profile_table.js
        
        // Create Tabulator on DOM element with id "profile-table"
        var usr_table = new Tabulator("#profile-table", {
            ajaxURL:"/SAW/Progetto_SAW/private/retrieve_usr_data.php", //ajax URL
            layout:"fitDataTable", //fit columns to width of data (optional)
            validationMode:"blocking",
            responsiveLayout:"hide", //collapse columns that dont fit on the table
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
        //usr_table.setData()
        /*.then(function(){
            //run code after table has been successfully updated
        })
        .catch(function(error){
            //handle error loading data
        });*/
        // Add event listener to the button
        document.getElementById('modify-usr-data-button').addEventListener('click', function() {
            row = usr_table.getData()[0];
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
$(document).ready(function(){
    $(".dropdown-menu input[type='radio']").click(function(){
        var selected = $(this).val();
        $("#dropdownMenuButton").html('<i class="fas fa-filter"></i> ' + selected);
    });

    // Trigger a click event on the checked radio button when the page loads
    $(".dropdown-menu input[type='radio']:checked").click();
});
</script>
    <script>
        //catalog_table.js    
        var table = new Tabulator("#catalog-table", {
            columnDefaults:{
                maxWidth: 100,  
            },
            layout:"fitColumnsData", //fit columns to width of data (optional)
            responsiveLayout:"collapse", //hide columns that dont fit on the table
            maxHeight:"100%", //do not let table get bigger than the height of its parent element
            ajaxURL:"/SAW/Progetto_SAW/private/get_catalog.php", //ajax URL
            //data:tabledata, //assign data to table
            columns:[ //Define Table Columns
                {title:"Locandina", field:"img", formatter:"image", headerSort:false, formatterParams:{
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
                //{title:"Trama", field:"trama", maxWidth: 100, },
                {title:"Durata", field:"durata"},
                {title:"Casa di Produzione", field:"casa_produzione"},
            ]
        });
        //catalog_table.setData()
        /*.then(function(){
            //run code after table has been successfully updated
        })
        .catch(function(error){
            //handle error loading data
        });*/
    
    </script>  


    <script>
        //admin_area_tables.js

        /*const triggerTabList = document.querySelectorAll('#myTab button')
        triggerTabList.forEach(triggerEl => {
            const tabTrigger = new bootstrap.Tab(triggerEl)
            triggerEl.addEventListener('click', event => {
                event.preventDefault()
                tabTrigger.show()
            })
        })*/
    
        var all_movies_table = new Tabulator("#all-movies-table", {
            columnDefaults:{
                minWidth: 100,  
            },
            layout:"fitColumnsData", //fit columns to width of data (optional)
            responsiveLayout:"collapse", //hide columns that dont fit on the table
            maxHeight:"100%", //do not let table get bigger than the height of its parent element

            ajaxURL:"/SAW/Progetto_SAW/private/get_catalog.php", //ajax URL
            //data:tabledata, //assign data to table
            columns:[ //Define Table Columns
                {formatter:"rowSelection", titleFormatter:"rowSelection", hozAlign:"right", headerSort:false, cellClick:function(e, cell){
                    cell.getRow().toggleSelect();
                }},
                {title:"Locandina", field:"img", formatter:"image", headerSort:false, formatterParams:{
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
                //{title:"Trama", field:"trama", maxWidth: 100, editor:"textarea"},
                {title:"Durata", field:"durata"},
                {title:"Casa di Produzione", field:"casa_produzione"},
                //{title:"Elimina", field:"Elimina", formatter:"html"},
            ]
        });
        /*all_movies_table.setData()
        .then(function(){
            //run code after table has been successfully updated
        })
        .catch(function(error){
            //handle error loading data
        });*/

        var all_users_table = new Tabulator("#all-users-table", {
            columnDefaults:{
                minWidth: 100,  
            },
            layout:"fitColumnsData", //fit columns to width of data (optional)
            responsiveLayout:"hide", //hide columns that dont fit on the table
            maxHeight:"100%", //do not let table get bigger than the height of its parent element
            ajaxURL:"/SAW/Progetto_SAW/private/retrieve_all_usr_data.php", //ajax URL
            //data:tabledata, //assign data to table
            columns:[ //Define Table Columns
                {formatter:"rowSelection", titleFormatter:"rowSelection", hozAlign:"right", headerSort:false, cellClick:function(e, cell){
                    cell.getRow().toggleSelect();
                }},
                {title:"Nome", field:"Nome"},
                {title:"Cognome", field:"Cognome"},
                {title:"Email", field:"Email"},
                {title:"Admin", field:"Admin", hozAlign:"center", formatter:"tickCross"},
                {title:"Data di Nascita", field:"Data_Nascita"},
                {title:"Genere", field:"Genere"},
                {title:"Paese", field:"Paese"},
                {title:"Ban", field:"Ban", formatter:"html"},
            ]
        });
        //Add row on "Add Row" button click
        document.getElementById("add-row").addEventListener("click", function(){
            all_users_table.addRow({});
        });

        //Delete row on "Delete Row" button click
        document.getElementById("del-row").addEventListener("click", function(){
            all_users_table.deleteRow();
        });
        window.addEventListener('resize', function(){
            all_users_table.redraw();
        });
    </script>
    </body>
</html>
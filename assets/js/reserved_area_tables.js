//profile_table.js
        
        // Create Tabulator on DOM element with id "profile-table"
        var usr_table = new Tabulator("#profile-table", {
            ajaxURL:"/SAW/Progetto_SAW/private/retrieve_usr_data.php", //ajax URL
            layout: "fitColumns", //fit columns to width of data (optional)
            validationMode:"blocking",
            maxHeight:"100%", //do not let table get bigger than the height of its parent element
            responsiveLayout:"collapse", //collapse columns that dont fit on the table
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
                {title:"Nazionalità", field:"Nazionalità",editor:"input",validator:"regex:^[A-Za-z]+$"},
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
                window.location.reload();
            })
            .catch(function (error){
                console.log("Error:", error);
            });
        });

        // Create Tabulator on DOM element with id "reviews-table"
        var reviews_table = new Tabulator("#reviews-table", {
           defaultOption:{
                minWidth: 100,
            },
            ajaxURL:"/SAW/Progetto_SAW/private/retrieve_usr_reviews.php", //ajax URL
            maxHeight:"100%", //do not let table get bigger than the height of its parent element
            validationMode:"blocking",
            //responsiveLayout:"collapse", //collapse columns that dont fit on the table
            columns:[ //Define Table Columns
                {formatter:"rowSelection", titleFormatter:"rowSelection", hozAlign:"right", headerSort:false, cellClick:function(e, cell){
                    cell.getRow().toggleSelect();
                }},
                {title:"Titolo", field:"Titolo"},
                {title:"Regia", field:"Regia", editor:"number", validator:["min:0", "max:5"], editorParams:{
                    min:0,
                    max:5,
                }},
                {title:"Sceneggiatura", field:"Sceneggiatura", editor:"number", validator:["min:0", "max:5"], editorParams:{
                    min:0,
                    max:5,
                }},
                {title:"Colonna_Sonora", field:"Colonna_Sonora", editor:"number", validator:["min:0", "max:5"],editorParams:{
                    min:0,
                    max:5,
                }},
                {title:"Recitazione", field:"Recitazione", editor:"number", validator:["min:0", "max:5"], editorParams:{
                    min:0,
                    max:5,
                }},
                {title:"Fotografia", field:"Fotografia", editor:"number", validator:["min:0", "max:5"], editorParams:{
                    min:0,
                    max:5,
                }}
            ],
        });
        // Add event listener to the button
        document.getElementById('modify-usr-reviews-button').addEventListener('click', function() {
            var selectedRows = reviews_table.getSelectedRows();
            var selectedReviews = selectedRows.map(function(row) {
                return row.getData();
            });
            
            fetch('/SAW/Progetto_SAW/private/update_reviews.php',{
                method : 'post',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({selectedReviews})
            })
            .then(function (response){
                if (!response.ok) {
                    throw new Error('HTTP error ' + response.status);
                }
                return response.json();
            })
            .then(function (data){          
                console.log(data);
                reviews_table.setData(data);
            })
            .catch(function (error){
                console.log("Error:", error);
            });
        });
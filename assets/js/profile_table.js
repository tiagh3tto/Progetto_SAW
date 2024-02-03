//profile_table.js
        
        // Create Tabulator on DOM element with id "profile-table"
        var usr_table = new Tabulator("#profile-table", {
            columnDefaults:{
                minWidth: 100,  
            },
            ajaxURL:"/SAW/Progetto_SAW/private/retrieve_usr_data.php", //ajax URL
            layout: "fitColumns", //fit columns to width of data (optional)
            validationMode:"blocking",
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
            })
            .catch(function (error){
                console.log("Error:", error);
            });
        });
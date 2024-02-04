
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
                window.location.reload();
            })
            .catch(function (error){
                console.log("Error:", error);
            });
        });
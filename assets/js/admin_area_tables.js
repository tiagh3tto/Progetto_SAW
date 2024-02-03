$(document).ready(function() {
    // Manually trigger 'shown.bs.tab' event for the first tab
    $('a[data-toggle="tab"]:first').trigger('shown.bs.tab');
});

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) { 
    if (e.target.id === 'table1-tab') {
        var all_users_table = new Tabulator("#all-users-table", {
            columnDefaults:{
                minWidth: 150,  
            },
            layout:"fitColumns", //fit columns to width of data (optional)
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
                {title:"Data di Nascita", field:"Data_Nascita"},
                {title:"Genere", field:"Genere"},
                {title:"Nazionalità", field:"Nazionalità"},
                {title:"Ban", field:"Ban", formatter:"tickCross"},
            ]
        });
        document.getElementById("del-users-btn").addEventListener("click", function(){
            // Get all selected rows
            var selectedRows = all_users_table.getSelectedRows();
        
            // Delete each selected row
            for (var i = 0; i < selectedRows.length; i++) {
                all_users_table.deleteRow(selectedRows[i]);
            }
        });
        document.getElementById("ban-users-btn").addEventListener("click", function() {
            // Gather selected users
            var selectedRows = all_users_table.getSelectedRows();
            var selectedUsers = selectedRows.map(function(row) {
                return row.getData();
            });
        
            // Send data to server
            fetch('/SAW/Progetto_SAW/private/ban_users.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ 'data': selectedUsers }),
            })
            .then(response => response.json())
            .then(updatedData => {
                // Clear the table and add the updated data
                all_users_table.clearData();
                all_users_table.addData(updatedData);
            })
            .catch((error) => {
                console.error('Errorban:', error); // Implement error handling
            });
        });
    } else if (e.target.id === 'table2-tab') {
        var all_movies_table = new Tabulator("#all-movies-table", {
            columnDefaults:{
                minWidth: 100,  
            },
            layout:"fitColumns", //fit columns to width of data (optional)
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
        document.getElementById("del-films-btn").addEventListener("click", function(){
            // Get all selected rows
            var selectedRows = all_movies_table.getSelectedRows();
            // Delete each selected row
            for (var i = 0; i < selectedRows.length; i++) {
                all_movies_table.deleteRow(selectedRows[i]);
            }
        });
    }
});
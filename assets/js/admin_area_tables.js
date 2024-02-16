var all_movies_table = new Tabulator("#all-movies-table", {
    columnDefaults:{
        minWidth: 130,  
    },
    layout:"fitColumns",
    responsiveLayout:"collapse",
    maxHeight:"100%",
    ajaxURL:"/SAW/Progetto_SAW/private/get_catalog.php",
    columns:[
        {formatter:"rowSelection", titleFormatter:"rowSelection", hozAlign:"right", minWidth:false,headerSort:false, cellClick:function(e, cell){
            cell.getRow().toggleSelect();
        }},
        {title:"Locandina", field:"img", formatter:"image", headerSort:false, formatterParams:{
            height:"120px",
            width:"80px",
            urlPrefix:"/SAW/Progetto_SAW/assets/img/film/",
            urlSuffix:".jpg"
        }},
        {title:"Nome", field:"nome", width:150},
        {title:"Genere", field:"genere"},
        {title:"Regista", field:"regista"},
        {title:"Paese", field:"paese"},
        {title:"Anno", field:"anno", width:50},
        {title:"Durata", field:"durata", width:50},
        {title:"Casa di Produzione", field:"casa_produzione", width: 200},
    ]
});

document.getElementById("del-films-btn").addEventListener("click", function(){
    var selectedRows = all_movies_table.getSelectedRows();
    for (var i = 0; i < selectedRows.length; i++) {
        all_movies_table.deleteRow(selectedRows[i]);
    }
});

var all_users_table = new Tabulator("#all-users-table", {
    defaultOption:{
        minWidth: 100,
    },    
    layout:"fitColumns",
    maxHeight:"100%",
    ajaxURL:"/SAW/Progetto_SAW/private/retrieve_all_usr_data.php",
    columns:[
        {formatter:"rowSelection", titleFormatter:"rowSelection" ,hozAlign:"left", minWidth:false, headerSort:false, cellClick:function(e, cell){
            cell.getRow().toggleSelect();
        }},
        {title:"Nome", field:"Nome"},
        {title:"Cognome", field:"Cognome"},
        {title:"Email", field:"Email"},
        {title:"Data di Nascita", field:"Data_Nascita", width:250 },
        {title:"Genere", field:"Genere"},   
        {title:"Nazionalità", field:"Nazionalità"},  
        {title:"Ban", field:"Ban", formatter:"tickCross" }           
    ]
});

document.getElementById("del-users-btn").addEventListener("click", function(){
    var selectedRows = all_users_table.getSelectedRows();
    for (var i = 0; i < selectedRows.length; i++) {
        all_users_table.deleteRow(selectedRows[i]);
    }
});

document.getElementById("ban-users-btn").addEventListener("click", function() {
    var selectedRows = all_users_table.getSelectedRows();
    var selectedUsers = selectedRows.map(function(row) {
        return row.getData();
    });
    fetch('/SAW/Progetto_SAW/private/ban_users.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ 'data': selectedUsers }),
    })
    .then(response => response.json())
    .then(function(data){
        console.log(data);
    })
    .catch((error) => {
        console.error('Errorban:', error); // Implement error handling!!!!!!!!
    });
    window.location.reload();
});
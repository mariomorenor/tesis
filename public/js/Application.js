
function rolesFormatter(value,row) {
    return value[0].description;
}

function delete_User(nameField, id) {
    Swal.fire({
        icon: 'warning',
        title: 'Está Seguro de Eliminar al Usuario?',
        text: 'No se podrá deshacer esta acción.',
        showCancelButton: true
    }).then((result)=>{
        if(result.value){
            $.ajax({
                type: "delete",
                url: "/users/"+id,
                success: function (response) {
                    // console.log(response)
                    Swal.fire('Operación realizada Correctamente!','','success'); 
                    $table.bootstrapTable("remove",{
                        field: 'name',
                        values: nameField
                    })
                },
                error: function(error){
                    // console.log(error)
                }
            });
        }
    });
}
function operateFormatter(value,row, index, fieldc) {
 

    let buttons = `<button class="btn btn-primary btn-sm editUser">
                        <i class="fas fa-edit"></i>
                    </button>`;
                
    
    //    if(row.roles_u[0].name == 'admin')
    //       buttons = ''; 
      
  
buttons +=  `<button onclick="delete_User('`+row.name+`','`+row.id+`')" class="ml-1 btn btn-danger btn-sm">
                    <i class="fas fa-trash-alt"></i>
                </button>`;

return buttons;
}

// function eliminarMasters() {
//     $('#usersTable').bootstrapTable('remove',{
//         field: fieldc,
//         values: row.id
//     })
// }

//***********************   REPORTS  **********************

function date_outFormatter(value, row) {
    if (row.state == "F") {
        return row.date_out;
    } else if (row.state == "W") {
        return 'Lote en Espera'
    } else {
        return 'Lote en Producción'
    }
}


function operateForm(value, row) {
    let infoButton = `<button  class="btn btn-primary shadow btnInfoLote">
                        <i class="fas fa-info-circle"></i>
                    </button>`;
        return infoButton;
}

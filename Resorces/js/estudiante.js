var estudianteTemplate = `
<tr id="row-estudiante-{{ID}}">
<td>{{NOMBRE}}</td>
<td>{{MATRICULA}}</td>
<td>{{EDAD}}</td>
<td>{{CARRERA_ID}}</td>
<td>
    <button id="editar-{{ID}}" onclick='editar({{ID}})' data-estudiante='{{DATA}}' class="btn btn-warning">Editar</button> | 
    <button onclick="eliminar({{ID}})" class="btn btn-danger">Eliminar</button>
</td>
</tr>
`

function buscarestudiante() {
fetch("/estudiante.php")
    .then( res => res.json())
    .then( res => {
        console.log(res);
        var listaM = document.getElementById('list_estudiante');
        var temp = '';
        res.forEach(m => {
            temp = temp + estudianteTemplate.replace(/{{NOMBRE}}/, m.nombre)
                .replace(/{{MATRICULA}}/, m.matricula)
                .replace(/{{EDAD}}/, m.edad)
                .replace(/{{CARRERA_ID}}/, m.carrera_id)
                .replace(/{{ID}}/g, m.id)
                .replace(/{{DATA}}/, JSON.stringify(m));

        });
        listaM.innerHTML = temp;
    })
    .catch( err => {
        console.log(err);
    });
}

var estudiante = null;

function guardarestudiante(){

nombre = document.getElementById("nombre").value;
matricula = document.getElementById("matricula").value;
edad = document.getElementById("edad").value;
carrera_id = document.getElementById("carrera_id").value;

var nueva = true;
if (estudiante != null && estudiante.id ){
    nueva = false;
    var btnEditar = document.getElementById("editar-"+estudiante.id);
} else {
    estudiante = {};
}

estudiante.nombre = nombre
estudiante.matricula = matricula
estudiante.edad = edad
estudiante.carrera_id = carrera_id;

console.log(estudiante);

if (nueva == false) {
    btnEditar.dataset.estudiante = JSON.stringify(estudiante);
}

fetch('/estudiante.php'+(nueva ? '' : `?id=${estudiante.id}`),{
    method: (nueva ? 'POST' : 'PUT'),
    body: JSON.stringify(estudiante),
    headers: {
        'Content-Type': 'application/json'
      }
})
.then( res => res.json())
.then( res => {
    console.log(res);
})
.catch( err => {
    console.log(err);
});


estudiante = null;
}

function editar(id){

var btnEditar = document.getElementById("editar-" + id);
 
var data = btnEditar.dataset.estudiante;
estudiante = JSON.parse(data);

document.getElementById("nombre").value = estudiante.nombre;
document.getElementById("matricula").value = estudiante.matricula;
document.getElementById("edad").value = estudiante.edad;
document.getElementById("carrera_id").value = estudiante.carrera_id;
buscarestudiante();

}

function eliminar(id) {
    fetch(`/estudiante.php?id=${id}`, {
        method: 'DELETE'
    })
        .then(res => res.json())
        .then(res => {
            var row = document.getElementById("row-estudiante-" + id).rowIndex;

            document.getElementById('list_estudinate').deleteRow(row);
            console.log(res);
        })
        .catch(err => {
            console.log(err);
        });


}


window.onload = function(){
buscarestudiante();

 document.getElementById("mibotton").addEventListener("click",guardarestudiante);
}
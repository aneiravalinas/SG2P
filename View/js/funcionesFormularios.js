function insertacampo(form ,name, value){
	formulario = form;
	var input = document.createElement('input');
    input.type = 'hidden';
    input.name = name;
    input.value = value;
    formulario.appendChild(input);
}

function insertacampo_multiple(form, params) {
	for(let key in params) {
		let input = document.createElement('input');
		input.type = 'hidden';
		input.name = key;
		input.value = params[key];
		form.appendChild(input);
	}
}

function crearform(name, method){
	var formu = document.createElement('form');
	document.body.appendChild(formu);
    formu.name = name;
    formu.method = method;
    formu.action = 'index.php';   
}


function enviaform(form){
	form.submit();
}

function enviaformcorrecto(form, funcion){
	if (funcion){
        form.submit();
	}
	else{
		return false;
	}
}
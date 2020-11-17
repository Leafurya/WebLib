function SendDataEach(action,method,inputsClass){
	var inputs=document.querySelectorAll(inputsClass);
	console.log(inputs);
	var input=new Array();
	var form=document.createElement("form");
	form.setAttribute("method",method);
	form.setAttribute("action",action);

	console.log(inputs[0].value);
	for(var i=0;i<inputs.length;i++){
		input[i]=document.createElement("input");
		input[i].setAttribute("type","hidden");
		input[i].setAttribute("value",inputs[i].value);
		input[i].setAttribute("name",inputs[i].getAttribute("name"));

		form.appendChild(input[i]);
	}
	document.body.appendChild(form);
	form.submit();
}
function SendDataBundle(action,method,bundlename,inputsClass){
	var inputs=document.querySelectorAll(inputsClass);
	console.log(inputs);
	var input=new Array();
	var form=document.createElement("form");
	form.setAttribute("method",method);
	form.setAttribute("action",action);

	console.log(inputs[0].value);
	for(var i=0;i<inputs.length;i++){
		input[i]=document.createElement("input");
		input[i].setAttribute("type","hidden");
		input[i].setAttribute("value",inputs[i].value);
		input[i].setAttribute("name",bundlename+"[]");

		form.appendChild(input[i]);
	}
	document.body.appendChild(form);
	form.submit();
}
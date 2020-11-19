/*function ShowText(data){
	document.querySelector("article").innerHTML=data;
}*/
function Fetch_Func(file,func){
	fetch(file).then(function(res){
		res.text().then(function(data){
			func(data);
		});
	});
}
function Fetch_Target(file,target){
	fetch(file).then(function(res){
		res.text().then(function(data){
			document.querySelector(target).innerHTML=data;
		});
	});
}
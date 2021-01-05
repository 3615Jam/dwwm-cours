let element = document.getElementById('addItem');
element.onclick = function () {
	let newElement = document.createElement('li');
	document.getElementById('list').appendChild(newElement);
};
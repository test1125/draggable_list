
document.querySelectorAll('.c-box').forEach (elm =>{
	elm.onchange = function(){
		document.querySelector('#location').submit();
	}
})

document.querySelectorAll('.c-box2').forEach (elm =>{
	elm.onchange = function(){
		document.querySelector('#location2').submit();
	}
})

document.querySelectorAll('tr').forEach (elm => {
	elm.ondragstart = function (e) {
		e.dataTransfer.setData('text/plain', e.target.id);
	};
	elm.ondragover = function (e) {
		e.preventDefault();
		this.style.borderTop = '2px solid blue';
	};
	elm.ondragleave = function () {
		this.style.borderTop = '';
	};
	elm.ondrop = function (e) {
		e.preventDefault();
		let id = e.dataTransfer.getData('text/plain');
		let elm_drag = document.getElementById(id);
		this.parentNode.insertBefore(elm_drag, this);
		this.style.borderTop = '';
		document.querySelector('#location').submit();
	};

});



document.addEventListener("DOMContentLoaded", function() {

	// Custom JS

});

document.querySelector('.hamburger').addEventListener("click", function(e){
	e.preventDefault();

	document.querySelector('html').classList.toggle('g-opening');
	document.querySelector('html').classList.toggle('g-theme-style');
	document.querySelector('html').classList.toggle('g-blocking');

	document.querySelector('.g-menu').classList.toggle('g-opened');

	setTimeout(function() {
		e.target.closest('.hamburger').classList.toggle('is-active');
	}, 200	)
});

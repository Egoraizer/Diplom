$(function() {

	const modalCall = $("[data-modal]");

	modalCall.on("click", function(event) {
		event.preventDefault();

		let $this = $(this);
		let modalId = $this.data('modal');

		$(modalId).addClass('show');
		$("body").addClass('no-scroll');
	});

	$(".modal").on("click", function(event) {
		$(this).removeClass('show');
		$("body").removeClass('no-scroll');
	});

	$(".login_wrap").on("click", function(event) {
		event.stopPropagation();
	});

	$(document).keydown(function(event) {
		if(event.which == 27) {
			$(".modal").removeClass('show');
		}
	});	

});
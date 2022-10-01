$(document).ready(function() {
	// Get car price
	$('#reserva_carro').on('change', function() {
		var item = $(this).val();

		$.ajax({
			url: BASE_URL + 'veiculos/pegar_preco',
			type: 'POST',
			data: {carro: item},
			dataType: 'json',
			success: function(json) {
				$('#reserva_preco').val('R$' + json.preco_dia);
			}
		});
	});

	// Toogle Tooltip
	$('[data-toggle="tooltip"]').tooltip();

	// Masks
	$('#pessoa_cpf').mask('000.000.000-00');
	$('#pessoa_phone').mask('+00 (00) 00000-0000');

	// Smooth scrool to item
	$('.inpage-link').click(function(e) {
	  e.preventDefault();

		var id = $(this).attr('href'),
		targetOffSet = $(id).offset().top;

		$('html, body').animate({
			scrollTop: targetOffSet -50
		}, 500);
	});
});
$("#iframe_menu").load(function() {
	
			
		subpaginas = $('#iframe_menu').contents().find('ul li a');
		quantidade_de_paginas = (subpaginas.length) ;
		$("body").css("width",quantidade_de_paginas * 100 + "%");
		$("iframe").first().remove();

		subpaginas.each( function() {
		  url_deste_iframe = $(this).attr("href");
		  titulo = $(this).attr("data-titulo");
		  $(".paginas").append('<iframe id="' + titulo + '" src="' + url_deste_iframe + '"></iframe>');

		});
		
		$("iframe").first().appendTo(".navegacao");
		
		
		
	
			$("iframe").each(function() {
				$(this).load(function() {
					$(this).contents().find(".desabilitar_link").click(function(e) {
						
						iframe_referencia = $(this).attr("data-titulo");
						
						if( $(this).hasClass("voltar_para_menu") ){
							$("body").animate({scrollLeft: 0 }, 400, function(){
									$(".navegacao iframe").last().appendTo(".paginas");
							});
						}else{
							$("#" + iframe_referencia).appendTo(".navegacao");
							$("body").animate({scrollLeft: $("#" + iframe_referencia ).offset().left }, 400);
						}
						
						return false;
						
					}); 
				});
			});
		
	
		
		
	
	
	
		
	});
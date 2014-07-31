		/*
		$(document).ready(function()
		{
			jQuery(function(){jQuery('a[href$=".pdf"]').click(function(){
				_gaq.push(['_trackEvent', 'Download', 'Pdf', this.href]);
			})
		  });
		});
		*/
		
		$(document).ready(function() {
			$("a[href$='zip']").each(function(index) {
			pdfLabel = $(this).attr('href');
			pdfOnClick = "_gaq.push(['_trackEvent', 'PDF', 'Download', '" + pdfLabel + "']);";
			$(this).attr("onClick", pdfOnClick);
			});
		});
jQuery(function($){
    $('.mapping-currency-list').on('change', function (e) {
    	$(this).next().addClass('mapping-loading-visible');
        changeMappingSelect();
    });

    function changeMappingSelect() {

    	var dataMapping = [];

		$('.mapping-currency .row-mapping-content').each(function(){
			var dataItemLang = $(this).data('lang-code');
			var dataItemCurrency = $(this).find('select').val();

			dataMapping.push([dataItemLang, dataItemCurrency]);
		});

        $.ajax({
            method: "POST",
            dataType: "json",
            url: ajaxurl,
            data: {
                data_mapping: dataMapping,
                action: 'st_mapping_currency'
            },
            beforeSend: function () {

            },
            success: function (response) {
                if($('.mapping-loading').hasClass('mapping-loading-visible')){
                    $('.mapping-loading').removeClass('mapping-loading-visible');
				}
            	return false;
            }
        });

    }
});

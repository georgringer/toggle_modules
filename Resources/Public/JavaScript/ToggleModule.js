define(['jquery'], function ($) {
	var installToolModuleItems = '#tools_toolsmaintenance, #tools_toolssettings, #tools_toolsupgrade, #tools_toolsenvironment, #system_dbint, #system_config, #system_ReportsTxreportsm1';

	if ($('#installToolModules').attr('checked') === 'checked') {
		$(installToolModuleItems).hide();
	}
	$('#installToolModules').change(function () {
		if (this.checked) {
			$(installToolModuleItems).hide();
		} else {
			$(installToolModuleItems).show();
		}

		$.ajax({
			url: TYPO3.settings.ajaxUrls['togglemodules_toggle'],
			type: 'post',
			cache: false,
			data: {
				'item': 'installToolModules',
				'state': this.checked
			}
		});
	});

});

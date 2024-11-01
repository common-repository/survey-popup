(function( $ ) {
	'use strict';

	(function( $ ) {
		'use strict';

		$(document).ready(function () {

			var SRVYSurveyObj = [], // Initial blank object to get all survey fields.
				SRVYStepsObj  = []; // Initial blank object to create a number steps.

			/**
			 * Checking the required condition with a message while someone escape this steps.
			 * @param {Boolean} value store 1 or 0.
			 */
			const srvyRequiredTo = (value) => {

				if (!value) {

					return 'You need to say something!'
				}
			};

			// SRVYSurveyRoot Root object comes from shortcode display.
			$.each(SRVYSurveyRoot, function (rootIndex, rootElement) {

				var radioOptions = {};
				$.each(rootElement.srvy_survey_radio_repeater, function(radioKeys, radioValues) {

					$.each(radioValues, function(radioKey, radioValue) {

						radioOptions[radioValue] = radioValue;
					});
				});

				/**
				 * Number rating field.
				 * Star rating field.
				 */
				if ( 'rating' === rootElement.srvy_survey_type && 'number' === rootElement.srvy_survey_rating_type ) {

					var SRVYSurveyType = 'radio',
						customClass = {container: 'srvy--catch-number-rating'}
						inputOptions = {0: '0', 1: '1', 2: '2', 3: '3', 4: '4', 5: '5', 6: '6', 7: '7', 8: '8', 9: '9', 10: '10'};
				} else if ( 'rating' === rootElement.srvy_survey_type && 'star' === rootElement.srvy_survey_rating_type ) {

					var SRVYSurveyType = 'radio',
						customClass = {container: 'srvy--catch-star-rating'}
						inputOptions = {1: '<i class="fa fa-star-o" aria-hidden="true"></i>',
										2: '<i class="fa fa-star-o" aria-hidden="true"></i>',
										3: '<i class="fa fa-star-o" aria-hidden="true"></i>',
										4: '<i class="fa fa-star-o" aria-hidden="true"></i>',
										5: '<i class="fa fa-star-o" aria-hidden="true"></i>'};
				} else if ( 'radio' === rootElement.srvy_survey_type ) {

					var SRVYSurveyType = 'radio',
						customClass = {},
						inputOptions = radioOptions;
				} else {

					var SRVYSurveyType = rootElement.srvy_survey_type,
						customClass = {},
						inputOptions = undefined;
				}

				/**
				 * Pushing all fields with values to executing in the queue.
				 */
				SRVYSurveyObj.push({
					title: rootElement.srvy_survey_question,
					customClass: customClass,
					html: rootElement.srvy_survey_desc,
					input: SRVYSurveyType,
					inputOptions: inputOptions,
					inputValidator: rootElement.srvy_survey_check ? srvyRequiredTo : undefined
				});

				// Pushing all index to create an index object to applying in steps.
				SRVYStepsObj.push(rootIndex + 1);
			});

			/**
			 * After clicking the survey button.
			 */
			$('.srvy--survey-popup').each(function() {

				var _this             = $(this),
					srvySurveyId      = _this.data('survey-id'),
					SRVYSurveyNextTXT = _this.data('survey-next'),
					SRVYSurveyExitTXT = _this.data('survey-exit'),
					SRVYSurveyMSGDone = _this.data('survey-msg-done'),
					SRVYSurveyMSGExit = _this.data('survey-msg-exit'),
					srvySurveyBtn     = _this.find('.srvy--survey-btn');

				srvySurveyBtn.click(function() {

					Swal.mixin({
						input: 'text',
						showCancelButton: true,
						confirmButtonText: SRVYSurveyNextTXT,
						cancelButtonText: SRVYSurveyExitTXT,
						progressSteps: SRVYStepsObj,
						progressStepsDistance: '40px',
					}).queue(

						SRVYSurveyObj

					).then((result) => {

						console.log( JSON.stringify(result.value) );

						if (result.value) {

							const SRVYAnswers = JSON.stringify(result.value);

							Swal.fire('All Done!',
							SRVYSurveyMSGDone,
							'success');

							$.ajax({
								url: my_plugin.ajax_url,
								type: 'POST',
								data: {
									'action': 'tags_autofill_function',
									'nonce_ajax' : my_plugin.nonce,
									'srvy_user_inputs': SRVYAnswers,
									'srvy_survey_id': srvySurveyId
								},
								success:function(data) {
									console.log(data);
								},
								error: function(errorThrown){
									console.log(errorThrown);
								}
							});
						} else if (

							/* Read more about handling dismissals below */
							result.dismiss === Swal.DismissReason.cancel
						) {
							Swal.fire(
								'Cancelled',
								SRVYSurveyMSGExit,
								'error'
							)
						}
					});

				});
			});

			// if ($.cookie('test_status') != '1') {

				// setTimeout(function() {

					/* $('#my_plugin_tags').keyup(function() {

						var srvy_user_inputs = $(this).val();
						var srvy_user_inputs_last = $.trim(srvy_user_inputs.split(',').pop());

						$.ajax({
							url: my_plugin.ajax_url,
							type: 'POST',
							data: {
								'action': 'tags_autofill_function',
								'srvy_user_inputs': srvy_user_inputs_last
							},
							success:function(data) {
								console.log(data);
							},
							error: function(errorThrown){
								console.log(errorThrown);
							}
						});

					}); */

					// jQuery.cookie('test_status', '1', { expires: 31 });

				// }, 1000);
			// }
		});

	})( jQuery );

})( jQuery );

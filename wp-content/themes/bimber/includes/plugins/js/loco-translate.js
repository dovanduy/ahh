/* global document */
/* global jQuery */
/* global bimber_loco_translate_config */

(function($) {
    'use strict';

    var config;
    var $locoWrapper;
    var $commonLocale;
    var $customLocale;
    var $warning;
    var $submitButton;

    $(document).ready(function() {

        $('#loco-poinit').each(function() {
            config = $.parseJSON(bimber_loco_translate_config);

            if (typeof config === 'undefined') {
                return;
            }

            $locoWrapper = $(this);
            $commonLocale = $locoWrapper.find('select[name=select-locale]');
            $customLocale = $locoWrapper.find('input[name=custom-locale]');
            $submitButton = $locoWrapper.find('input[type=submit]');

            $warning = $('<span class="bimber-warning">'+ config.locale_warning +'</span>');
            $customLocale.parents('p').append($warning);
            $warning.hide();

            selectGlobalDirAndHideRadios();
            setDefaultLocale();
            listenOnLocaleChange();
            blockIfTranslationNotAllowed();
        });

    });

    function selectGlobalDirAndHideRadios() {
        $locoWrapper.find('input[name=select-path]').each(function() {
            var $radio = $(this);
            var $radioWrapper = $radio.parents('.loco-paths');
            if ($radio.is('[value=3]')) {
                $radio.attr('checked', 'checked');
            }

            $radioWrapper.hide();
        });
    }

    function setDefaultLocale() {
        $commonLocale.find('option[value='+ config.locale +']').attr('selected', 'selected');
        $commonLocale.trigger('change');
    }

    function  listenOnLocaleChange() {
        $commonLocale.on('change', function() {
            var selectedCode = $commonLocale.find('option:selected').val();

            checkCurrentLangCode(selectedCode);
        });

        $customLocale.on('keyup', function() {
            checkCurrentLangCode($(this).val());
        });
    }

    function checkCurrentLangCode(code) {
        if (code !== config.locale) {
            $warning.show();
        } else {
            $warning.hide();
        }
    }

    function blockIfTranslationNotAllowed() {
        if ($('.bimber-translation-not-allowed').length > 0) {
            $submitButton.hide();
        }
    }

})(jQuery);
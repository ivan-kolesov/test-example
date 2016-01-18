window.addEventListener('load', function (){
    var languageSelect = document.getElementById('js-language');
    if (null != languageSelect) {
        languageSelect.addEventListener('change', function () {
            var language = this.options[this.selectedIndex].value;
            dictionary.switchLanguage(language);
        });
    }
});
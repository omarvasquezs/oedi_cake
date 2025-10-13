document.addEventListener('DOMContentLoaded', function () {
    function isBadKey(k) {
        return k === 'e' || k === 'E' || k === '+' || k === '-' || k === ',' || k === '.';
    }

    function preventPasteNonDigits(e) {
        var paste = (e.clipboardData || window.clipboardData).getData('text');
        if (/[^0-9]/.test(paste)) {
            e.preventDefault();
        }
    }

    var selector = 'input[name="ubigeo"], input[name="RUC"], input[data-digits-only]';
    document.querySelectorAll(selector).forEach(function (el) {
        el.addEventListener('keypress', function (e) {
            if (isBadKey(e.key)) e.preventDefault();
        });
        el.addEventListener('paste', preventPasteNonDigits);
        // in case input type=number allows e via other means, sanitize on input
        el.addEventListener('input', function () {
            if (this.value && /[^0-9]/.test(this.value)) {
                this.value = this.value.replace(/[^0-9]/g, '');
            }
        });
    });
});

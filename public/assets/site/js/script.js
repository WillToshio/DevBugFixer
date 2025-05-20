$(document).ready(function () {
    const $textarea = $('.cmd-textarea');
    const prompt = 'C:\\> ';

    // Adiciona o prompt ao início se estiver vazio
    if ($textarea.val().trim() === '') {
        $textarea.val(prompt);
    }

    $textarea.on('focus', function () {
        // Se o cursor estiver antes do fim do prompt, posiciona depois do prompt
        if (this.selectionStart < prompt.length) {
            this.selectionStart = this.selectionEnd = prompt.length;
        }
    });

    $textarea.on('keydown', function (e) {
        // Previne backspace se o cursor estiver dentro do prompt
        if (e.key === 'Backspace' && this.selectionStart <= prompt.length) {
            e.preventDefault();
        }
        // Previne delete se o cursor estiver dentro do prompt
        if (e.key === 'Delete' && this.selectionStart < prompt.length) {
            e.preventDefault();
        }
    });

    $textarea.on('input', function () {
        // Se o prompt for apagado (qualquer parte), restaura ele
        if (!this.value.startsWith(prompt)) {
            this.value = prompt + this.value.substring(prompt.length);
            this.selectionStart = this.selectionEnd = prompt.length;
        }
    });
});
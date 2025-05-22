$(document).ready(function () {
    app.form = {
        path : {
            queryError: app.baseUrl + '/query-error', 
        },
        el:{
            errorMessageForm: $('form.error-query-form'),
        }
    }

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

    app.form.el.errorMessageForm.submit((e) => {
        e.preventDefault();
        let texto = $('.cmd-textarea').val();
        // Remove o prefixo 'C:\> ' do início, se existir
        if (texto.startsWith('C:\\> ')) {
            texto = texto.replace(/^C:\\> /, '');
        }
        var formData = {
            prompt: texto,
        };
        $.ajax({
            url: app.form.path.queryError,
            type: 'post',
            data: formData,
            beforeSend: function(){

            },
            success: function(result){
                var r = JSON.stringify(result);
                if(r.error){
                    alert(r.message);
                    return ;
                }
                $('div.cmd-code').text() = r.data.codigo_exemplo
                $('p.cmd-description').text() = r.data.descricao
                $('p.cmd-sugestion').text() = r.data.sugestao

            },
            error: function(data){
                alert(lang('An unexpected error occurred. Please try again later.'), true)
            }
        })
    })
});
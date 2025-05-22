
/*******************************************************************************
 * Loadmask
 ******************************************************************************/

$(document).ready(function () {
    app.form = {
        path : {
            queryError: app.baseUrl + '/query-error', 
        },
        el:{
            errorMessageForm: $('form.error-query-form'),
            textArea: $('.cmd-textarea'),

        },
        val:{
            prompt: 'C:\\> '
        }
    }


    // Adiciona o prompt ao início se estiver vazio
    if (app.form.el.textArea.val().trim() === '') {
        app.form.el.textArea.val(app.form.val.prompt);
    }

    app.form.el.textArea.on('focus', function () {
        // Se o cursor estiver antes do fim do prompt, posiciona depois do prompt
        if (this.selectionStart < app.form.val.prompt.length) {
            this.selectionStart = this.selectionEnd = app.form.val.prompt.length;
        }
    });

    app.form.el.textArea.on('keydown', function (e) {
        // Previne backspace se o cursor estiver dentro do prompt
        if (e.key === 'Backspace' && this.selectionStart <= app.form.val.prompt.length) {
            e.preventDefault();
        }
        // Previne delete se o cursor estiver dentro do prompt
        if (e.key === 'Delete' && this.selectionStart < app.form.val.prompt.length) {
            e.preventDefault();
        }
    });

    app.form.el.textArea.on('input', function () {
        // Se o prompt for apagado (qualquer parte), restaura ele
        if (!this.value.startsWith(app.form.val.prompt)) {
            this.value = app.form.val.prompt + this.value.substring(app.form.val.prompt.length);
            this.selectionStart = this.selectionEnd = app.form.val.prompt.length;
        }
    });

    app.form.el.errorMessageForm.submit((e) => {
        e.preventDefault();
        let texto = app.form.el.textArea.val();
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
                showLoading()
                $('.cmd-section.collapse').removeClass('show');
            },
            success: function(result){
                var r = JSON.parse(result)
                if(r.error){
                    alert(r.message);
                    return ;
                }

                $('div.cmd-code').html('<pre><code>' + r.data.codigo_exemplo + '</code></pre>')
                $('p.cmd-description').text(r.data.descricao)
                $('p.cmd-sugestion').text(r.data.sugestao)
                $('.cmd-section.collapse').addClass('show');
            },
            error: function(data){
                alert(lang('An unexpected error occurred. Please try again later.'), true)
            }
        })
    })

  let dotsInterval
  let progressInterval
  let progress = 0

  // Função para mostrar o modal de carregamento
  function showLoading() {
    // Resetar o progresso
    progress = 0
    $(".progress-bar").css("width", "0%")
    $(".progress-percentage").text("0%")
    $(".loading-dots").text(".")

    // Mostrar o modal
    $(".lmask").css("display", "flex")

    // Iniciar a animação dos pontos
    dotsInterval = setInterval(() => {
      const dots = $(".loading-dots").text()
      $(".loading-dots").text(dots.length >= 3 ? "." : dots + ".")
    }, 400)

    // Iniciar a animação da barra de progresso
    progressInterval = setInterval(() => {
      progress += Math.random() * 15
      if (progress > 100) progress = 100

      const progressRounded = Math.round(progress)
      $(".progress-bar").css("width", progressRounded + "%")
      $(".progress-percentage").text(progressRounded + "%")

      // Se chegou a 100%, esconder o modal após um breve atraso
      if (progress >= 100) {
        clearInterval(progressInterval)
        setTimeout(() => {
          hideLoading()
        }, 800)
      }
    }, 700)
  }

  // Função para esconder o modal de carregamento
  function hideLoading() {
    $(".lmask").css("display", "none")

    // Limpar os intervalos
    clearInterval(dotsInterval)
    clearInterval(progressInterval)
  }


  // Permitir que o usuário feche o modal clicando fora dele
  $(".lmask").click(function (e) {
    if (e.target === this) {
      hideLoading()
    }
  })

  // Expor as funções globalmente para uso em outros scripts
  window.showLoading = showLoading
  window.hideLoading = hideLoading
});
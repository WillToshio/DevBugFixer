<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
  <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>/icon.ico" />
    <title>DevBugFixer</title>
    <!-- CSS -->
     <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />
    <link href="<?= base_url('assets/vendors/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/site/css/form.css')?>" rel="stylesheet">
    
</head>
<body>
    <header>
        <div class="container">
            <h1><i class="fa-solid fa-terminal"></i> DevBugFixer</h1>
         </div>
    </header>

    <!-- Conteúdo Principal -->
    <main class="main-content container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2>C:\> Cole abaixo a mensagem de erro que você recebeu</h2>
                
                <form method="post" action="">
                    <div class="cmd-textarea-container">
                        <textarea 
                            class="cmd-textarea" 
                            name="error_message"
                            placeholder="C:\> _"
                            required
                        ><?php echo isset($_POST['error_message']) ? htmlspecialchars($_POST['error_message']) : ''; ?></textarea>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" name="analyze" class="cmd-button">Analisar erro</button>
                    </div>
                </form>

                <?php
                if (isset($_POST['analyze']) && !empty($_POST['error_message'])) {
                    // Em um cenário real, aqui você faria a análise do erro
                    // Esta é apenas uma simulação de resposta
                    $description = "Este parece ser um erro de sintaxe JavaScript. Há um parêntese faltando no final da expressão.";
                    $suggestion = "Adicione o parêntese de fechamento na expressão ou verifique se todos os parênteses estão balanceados.";
                    
                    // Exemplo com formatação de sintaxe
                    $example = '<span class="cmd-comment">// Código incorreto</span>
<span class="cmd-keyword">const</span> resultado = <span class="cmd-function">calcularTotal</span>(10, 20<span class="cmd-error">;</span>

<span class="cmd-comment">// Código corrigido</span>
<span class="cmd-keyword">const</span> resultado = <span class="cmd-function">calcularTotal</span>(10, 20);<span class="cmd-cursor"></span>';
                    ?>
                    
                    <!-- Área de Resultado -->
                    <div class="results mt-4">
                        <!-- Descrição do Erro -->
                        <div class="cmd-section">
                            <div class="cmd-section-header">
                                <h5 class="cmd-section-title">C:\> Descrição do erro</h5>
                            </div>
                            <div class="cmd-section-content">
                                <p><?php echo $description; ?></p>
                            </div>
                        </div>
                        
                        <!-- Sugestão de Correção -->
                        <div class="cmd-section">
                            <div class="cmd-section-header">
                                <h5 class="cmd-section-title">C:\> Sugestão de correção</h5>
                            </div>
                            <div class="cmd-section-content">
                                <p><?php echo $suggestion; ?></p>
                            </div>
                        </div>
                        
                        <!-- Exemplo de Código -->
                        <div class="cmd-section">
                            <div class="cmd-section-header">
                                <h5 class="cmd-section-title">C:\> Exemplo de código</h5>
                            </div>
                            <div class="cmd-section-content">
                                <div class="cmd-code"><?php echo $example; ?></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>

    <!-- Rodapé -->
    <footer>
        <div class="container">
            <a href="#">C:\> GitHub do projeto</a>
            <span class="d-none d-sm-inline">|</span>
            <a href="#">C:\> Sobre o DevBugFixer</a>
        </div>
    </footer>


    <!-- JS -->
    <script src="<?= base_url('assets/vendors/bootstrap/js/bootstrap.min.js')?>"></script>
    <script src="<?= base_url('assets/vendors/jquery/jquery-3.6.0.min.js')?>"></script>
    <script src="<?= base_url('assets/site/js/script.js')?>"></script>
</body>
</html>
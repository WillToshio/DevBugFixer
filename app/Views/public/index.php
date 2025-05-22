<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="icon" type="image/png" href="<?= base_url() ?>/icon.ico" />
    <title>DevBugFixer</title>
    <!-- CSS -->
     <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />
    <link href="<?= base_url('assets/vendors/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/site/css/form.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/site/css/loader.css')?>" rel="stylesheet">
    <script text="type/JavaScript">
        const app = {
            baseUrl: '<?= base_url(); ?>',
        };
    </script>
</head>
<body>
    <header>
        <div class="container h-100 p-0 m-0">
            <h1><i class="fa-solid fa-terminal"></i> DevBugFixer</h1>
         </div>
    </header>

    <!-- Conteúdo Principal -->
    <main class="main-content container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2>C:\> Cole abaixo a mensagem de erro que você recebeu</h2>
                
                <form method="post" class="error-query-form">
                    <div class="cmd-textarea-container">
                        <textarea 
                            class="cmd-textarea" 
                            name="error_message"
                            placeholder="C:\> _"
                            required
                        ><?php echo isset($error['message']) ? htmlspecialchars($error['message']) : ''; ?></textarea>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" name="analyze" class="cmd-button">Analisar erro</button>
                    </div>
                </form>

                    <!-- Área de Resultado -->
                    <div class="results mt-4">
                        <!-- Descrição do Erro -->
                        <div class="cmd-section collapse">
                            <div class="cmd-section-header">
                                <h5 class="cmd-section-title">C:\> Descrição do erro</h5>
                            </div>
                            <div class="cmd-section-content">
                                <p class="cmd-description"></p>
                            </div>
                        </div>
                        
                        <!-- Sugestão de Correção -->
                        <div class="cmd-section collapse">
                            <div class="cmd-section-header">
                                <h5 class="cmd-section-title">C:\> Sugestão de correção</h5>
                            </div>
                            <div class="cmd-section-content">
                                <p class="cmd-sugestion"></p>
                            </div>
                        </div>
                        
                        <!-- Exemplo de Código -->
                        <div class="cmd-section collapse">
                            <div class="cmd-section-header">
                                <h5 class="cmd-section-title">C:\> Exemplo de código</h5>
                            </div>
                            <div class="cmd-section-content">
                                <div class="cmd-code"></div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </main>

    <!-- Rodapé -->
    <footer>
        <div class="container">
            <a href="https://github.com/WillToshio/DevBugFixer" target="blank">C:\> GitHub do projeto</a>
            <span class="d-none d-sm-inline">|</span>
            <a href="<?= base_url('/about');?>">C:\> Sobre o DevBugFixer</a>
        </div>
    </footer>
    <div class="lmask">
        <div class="loading-container">
            <div class="spinner-border text-success mb-3" role="status"></div>
            <div class="loading-text">
                <p class="terminal-text mb-2">Analisando erro<span class="loading-dots">.</span></p>
                <div class="progress mb-2">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 0%"></div>
                </div>
                <p class="terminal-text progress-percentage">0%</p>
                <p class="terminal-text mt-3 small">C:\&gt; Processando dados<span class="cursor">_</span></p>
            </div>
        </div>
    </div>
    <!-- JS -->
    <script src="<?= base_url('assets/vendors/bootstrap/js/bootstrap.min.js')?>"></script>
    <script src="<?= base_url('assets/vendors/jquery/jquery-3.6.0.min.js')?>"></script>
    <script src="<?= base_url('assets/site/js/script.js')?>"></script>
</body>
</html>
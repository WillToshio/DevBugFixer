<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="<?= base_url() ?>/icon.ico" />
    <title>Sobre o DevBugFixer</title>
    <!-- CSS -->
     <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;500;700&display=swap" rel="stylesheet">

    <link href="<?= base_url('assets/vendors/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/site/css/about.css')?>" rel="stylesheet">

    
</head>
<body>
    <!-- Cabeçalho fixo -->
    <header class="cmd-header py-3 sticky-top">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <h1 class="logo-text mb-0 fs-4">DevBugFixer<span class="cursor-blink"></span></h1>
                </div>
                <div class="d-flex">
                    <a href="https://github.com/WillToshio" target="balnk" class="text-secondary me-3 footer-link">
                        <i class="fab fa-github"></i>
                        <span class="visually-hidden">GitHub</span>
                    </a>
                    <a href="https://www.linkedin.com/in/williantoshiocorr%C3%AAa/" target="balnk" class="text-secondary footer-link">
                        <i class="fab fa-linkedin"></i>
                        <span class="visually-hidden">LinkedIn</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="container py-4">
        <!-- Seção de Apresentação -->
        <section class="mb-5">
            <div class="terminal-window">
                <div class="terminal-header d-flex align-items-center">
                    <div class="terminal-circle bg-danger me-2"></div>
                    <div class="terminal-circle bg-warning me-2"></div>
                    <div class="terminal-circle bg-success me-2"></div>
                    <div class="flex-grow-1 text-center text-secondary small">about.md</div>
                </div>
                <div class="terminal-content">
                    <h2 class="text-warning fs-3 mb-4">&gt;_ O que é o DevBugFixer?</h2>
                    <p class="text-light border-start border-3 border-success ps-3 mb-4">
                        DevBugFixer é uma ferramenta interativa e prática desenvolvida para devs que lidam com bugs e comportamentos
                        inesperados. Combina um terminal fictício com sugestões de correção baseadas em boas práticas.
                    </p>
                    <div class="d-flex justify-content-end">
                        <span class="text-secondary small">Última atualização: <?php echo date('d/m/Y'); ?></span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Bloco de Funcionalidades -->
        <section class="mb-5">
            <h2 class="section-title">
                <i class="fa-solid fa-terminal section-icon"></i>Funcionalidades
            </h2>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="cmd-card feature-card border-green p-3 h-100">
                        <div class="d-flex align-items-start mb-3">
                            <i class="fa-solid fa-check-circle text-success mt-1 me-3"></i>
                            <h3 class="fw-bold text-white fs-6">Análise de Erros</h3>
                        </div>
                        <p class="text-secondary small ms-4">
                            Identifica padrões comuns de erros em diferentes linguagens de programação.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="cmd-card feature-card border-yellow p-3 h-100">
                        <div class="d-flex align-items-start mb-3">
                            <i class="fa-solid fa-lightbulb text-warning mt-1 me-3"></i>
                            <h3 class="fw-bold text-white fs-6">Sugestões Inteligentes</h3>
                        </div>
                        <p class="text-secondary small ms-4">
                            Oferece correções contextualizadas e exemplos práticos para resolver o problema.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="cmd-card feature-card border-blue p-3 h-100">
                        <div class="d-flex align-items-start mb-3">
                            <i class="fa-solid fa-globe text-primary mt-1 me-3"></i>
                            <h3 class="fw-bold text-white fs-6">Suporte Multi-linguagem</h3>
                        </div>
                        <p class="text-secondary small ms-4">
                            Compatível com JavaScript, Python, PHP, Java e outras linguagens populares.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="cmd-card feature-card border-purple p-3 h-100">
                        <div class="d-flex align-items-start mb-3">
                            <i class="fa-solid fa-file-alt text-info mt-1 me-3"></i>
                            <h3 class="fw-bold text-white fs-6">Documentação Integrada</h3>
                        </div>
                        <p class="text-secondary small ms-4">
                            Links diretos para documentação oficial relacionada ao erro encontrado.
                        </p>
                    </div>
                </div>


                <div class="col-md-6 col-lg-4">
                    <div class="cmd-card feature-card border-green p-3 h-100">
                        <div class="d-flex align-items-start mb-3">
                            <i class="fa-solid fa-terminal text-success mt-1 me-3"></i>
                            <h3 class="fw-bold text-white fs-6">Interface Terminal</h3>
                        </div>
                        <p class="text-secondary small ms-4">
                            Experiência familiar para desenvolvedores com estética de linha de comando.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Vantagens -->
        <section class="mb-5">
            <h2 class="section-title">
                <i class="fa-solid fa-check-circle section-icon"></i>Vantagens
            </h2>

            <div class="row g-3">
                <div class="col-sm-6 col-lg-3">
                    <div class="cmd-card p-3 h-100">
                        <h3 class="fw-bold text-white fs-6 mb-2">Acelera a depuração</h3>
                        <p class="text-secondary small">Reduza o tempo gasto na identificação e correção de bugs comuns.</p>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="cmd-card p-3 h-100">
                        <h3 class="fw-bold text-white fs-6 mb-2">Ensina enquanto resolve</h3>
                        <p class="text-secondary small">Aprenda com as explicações detalhadas sobre a causa do erro.</p>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="cmd-card p-3 h-100">
                        <h3 class="fw-bold text-white fs-6 mb-2">Ambiente focado</h3>
                        <p class="text-secondary small">Interface minimalista que elimina distrações durante o processo.</p>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="cmd-card p-3 h-100">
                        <h3 class="fw-bold text-white fs-6 mb-2">Ideal para testes rápidos</h3>
                        <p class="text-secondary small">Perfeito para validar snippets de código e identificar problemas.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Público-Alvo -->
        <section class="mb-5">
            <h2 class="section-title">
                <i class="fa-solid fa-users section-icon"></i>Público-Alvo
            </h2>

            <div class="cmd-card p-4">
                <div class="row text-center g-4">
                    <div class="col-sm-6 col-lg-3">
                        <div class="audience-icon bg-primary bg-opacity-25">
                            <i class="fa-solid fa-code text-primary fs-3"></i>
                        </div>
                        <h3 class="fw-bold text-white fs-6 mb-1">Desenvolvedores</h3>
                        <p class="text-secondary small">Backend/Frontend</p>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="audience-icon bg-success bg-opacity-25">
                            <i class="fa-solid fa-graduation-cap text-success fs-3"></i>
                        </div>
                        <h3 class="fw-bold text-white fs-6 mb-1">Estudantes</h3>
                        <p class="text-secondary small">De programação</p>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="audience-icon bg-warning bg-opacity-25">
                            <i class="fa-solid fa-check-circle text-warning fs-3"></i>
                        </div>
                        <h3 class="fw-bold text-white fs-6 mb-1">Testadores</h3>
                        <p class="text-secondary small">QA e automação</p>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="audience-icon bg-info bg-opacity-25">
                            <i class="fa-solid fa-headset text-info fs-3"></i>
                        </div>
                        <h3 class="fw-bold text-white fs-6 mb-1">Equipes</h3>
                        <p class="text-secondary small">De suporte técnico</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tecnologias Utilizadas -->
        <section class="mb-5">
            <h2 class="section-title">
                <i class="fa-solid fa-code section-icon"></i>Tecnologias Utilizadas
            </h2>

            <div class="text-center">
                <div class="tech-badge">
                    <div class="tech-icon bg-danger text-white">H5</div>
                    <span class="text-light">HTML5</span>
                </div>

                <div class="tech-badge">
                    <div class="tech-icon bg-primary text-white">C3</div>
                    <span class="text-light">CSS3</span>
                </div>

                <div class="tech-badge">
                    <div class="tech-icon bg-warning text-dark">JS</div>
                    <span class="text-light">JavaScript</span>
                </div>

                <div class="tech-badge">
                    <div class="tech-icon bg-info text-white">jQ</div>
                    <span class="text-light">jQuery</span>
                </div>

                <div class="tech-badge">
                    <div class="tech-icon bg-primary text-white">FA</div>
                    <span class="text-light">Font Awesome</span>
                </div>
            </div>
        </section>

        <!-- Status do Projeto -->
        <section class="mb-5">
            <h2 class="section-title">
                <i class="fa-solid fa-terminal section-icon"></i>Status do Projeto
            </h2>

            <div class="cmd-card p-4">
                <div class="status-badge">
                    <i class="fa-solid fa-hard-hat me-1"></i> 🚧 Em desenvolvimento ativo
                </div>

                <h3 class="text-white fw-bold fs-6 mb-3">Funcionalidades futuras:</h3>

                <ul class="list-unstyled">
                    
                    <li class="mb-3 text-light">
                        <span class="cmd-checkbox"></span>
                        Suporte para análise de logs de aplicações
                    </li>
                    <li class="mb-3 text-light">
                        <span class="cmd-checkbox"></span>
                        Histórico de erros e soluções por usuário
                    </li>
                </ul>

                <div class="mt-4 pt-3 border-top border-secondary">
                    <div class="d-flex flex-column flex-md-row justify-content-between">
                        <div class="text-secondary small mb-2 mb-md-0">
                            Versão atual: <span class="text-success">beta</span>
                        </div>
                        <div class="text-secondary small">
                            Última atualização: <span class="text-success"><?php echo date('d/m/Y'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Rodapé -->
    <footer class="cmd-footer py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 mb-3 mb-md-0">
                    <div class="d-flex flex-wrap gap-3">
                        <a href="https://github.com/WillToshio/DevBugFixer" target="balnk" class="footer-link">
                            <i class="fab fa-github me-1"></i> Repositório GitHub
                        </a>
                        <a href="https://github.com/WillToshio/DevBugFixer/issues" target="balnk" class="footer-link">
                            <i class="fa-solid fa-external-link-alt me-1"></i> Feedback
                        </a>
                        <a href="https://mit-license.org/" class="footer-link" target="balnk">
                            <i class="fa-solid fa-file-alt me-1"></i> Licença MIT
                        </a>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="text-secondary small">
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- JS -->
    <script src="<?= base_url('assets/vendors/bootstrap/js/bootstrap.min.js')?>"></script>
    <script src="<?= base_url('assets/vendors/jquery/jquery-3.6.0.min.js')?>"></script>
</body>
</html>
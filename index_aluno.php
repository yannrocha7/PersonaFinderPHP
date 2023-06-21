<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Persona Finder</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/style_personal_index.css" rel="stylesheet" />
    </head>
    <?php
            // Start the session
            session_start();

            // Check if the email session variable is set
            if (!isset($_SESSION['email'])) {
                header('Location: index_aluno.php');
                exit();
            }

            // Retrieve the email from the session
            $email = $_SESSION["email"];
            $cpf = $_SESSION["cpf"];

            // Connect to the database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "PersonaFinder";

            $conn = new mysqli($servername, $username, $password, $database);

            // Check if the database connection was successful
            if ($conn->connect_error) {
                die("Error connecting to the database: " . $conn->connect_error);
            }

            // Prepare and execute the query to retrieve the personal's name based on their email
            $sql = "SELECT nome FROM aluno WHERE cpf = '$cpf'";
            $sqlpersonal = "SELECT * FROM personal";
            $result = $conn->query($sql);
            $resultpersonal = $conn->query($sqlpersonal);
            $sqlcontratacao = "SELECT * FROM personal_aluno_contratacao WHERE aluno_cpf = '$cpf'";
            $resultcontratacao = $conn->query($sqlcontratacao);
            $countContatacao = mysqli_num_rows($resultcontratacao);
            $sqlcontratacaoaceita = "SELECT * FROM personal_aluno_contratacao WHERE aluno_cpf = '$cpf' AND proposta_aceita = 1";
            $resultcontratacaoaceita = $conn->query($sqlcontratacaoaceita);
            $countContatacaoaceita = mysqli_num_rows($resultcontratacao);
            $sqlcontratacaopendente = "SELECT * FROM personal_aluno_contratacao WHERE aluno_cpf = '$cpf' AND proposta_aceita = 0";
            $resultcontratacaopendente= $conn->query($sqlcontratacaopendente);
            $countContatacaopendente = mysqli_num_rows($resultcontratacaopendente);
            $sqlficha = "SELECT * FROM ficha_treino WHERE aluno_cpf = '$cpf'";
            $resultficha = $conn->query($sqlficha);
            $countFicha = mysqli_num_rows($resultficha);
            $countPersonal = mysqli_num_rows($resultpersonal);
            $cpfpersonal = '';
            // Check if the query was successful and fetch the personal's name
            if ($resultcontratacao && $resultcontratacao->num_rows > 0) {
                $row = $resultcontratacao->fetch_assoc();
                $cpfpersonal = $row['personal_cpf'];
            }

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $AlunoName = $row["nome"];
                $AlunoEmail = $row["nome"];
            }
            if($cpfpersonal != ''){
                $sqlp = "SELECT * FROM personal WHERE cpf = '$cpfpersonal'";
                $resultp = $conn->query($sqlp);

                if ($resultp && $resultp->num_rows > 0) {
                    $row = $resultp->fetch_assoc();
                    $nomep = $row['nome'];
                    $telefonep = $row['telefone'];
                }
            }
            

            if ($resultficha && $resultficha->num_rows > 0) {
                $row = $resultficha->fetch_assoc();
                
              

                $sqlpac = "SELECT * FROM personal_aluno_contratacao WHERE personal_cpf = '$cpfpersonal' AND aluno_cpf='$cpf'";
                $resultpac = $conn->query($sqlpac);
    
                if ($resultpac && $resultpac->num_rows > 0) {
                    $row = $resultpac->fetch_assoc();
                    $nota = $row['nota'];
                }
            }

           

            // Close the database connection
            
    ?>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top">Persona Finder</a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#portfolio">Personais</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#about">Sobre Nós</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#contact">Nos Contate</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="atualiza_aluno.php">Atualizar dados</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="logout_aluno.php">Sair</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead bg-primary text-white text-center">
            <div class="container d-flex align-items-center flex-column">
                <!-- Masthead Avatar Image-->
                <img class="masthead-avatar mb-5" src="assets/img/avataaars.svg" alt="..." />
                <!-- Masthead Heading-->
                <h1 class="masthead-heading text-uppercase mb-0">Olá <?php echo $AlunoName; ?></h1>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Masthead Subheading-->
                <p class="masthead-subheading font-weight-light mb-0">Encontrando a melhor forma de treino para você!</p>
            </div>
        </header>
        <!-- Portfolio Section-->
        <section class="page-section portfolio" id="portfolio">
            <div class="container">
                <!-- Portfolio Section Heading-->
                <?php
                              if ($countContatacaoaceita == 0) {
                 ?>
                   <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Personal Trainers</h2><br>
                <?php
                              }else{
                 ?>
                    <h6 class="page-section-heading text-center text-uppercase text-secondary mb-0">Personal Trainer Contratado: <br/> <br/><?php echo $nomep; ?> </h6><br>
                    <h6 class="text-center text-uppercase text-secondary mb-0">Telefone: <?php echo $telefonep; ?> </h6><br>
                 <?php
                              }
                 ?>
                

                <!-- Cards de Personal Trainers -->
                <div class="row">

                <?php
                // Verificar se existem resultados
                if ($resultpersonal && $resultpersonal->num_rows > 0 && $countContatacao == 0) {
                    // Loop através dos resultados
                    while ($row = $resultpersonal->fetch_assoc()) {
                        $cpfPersonal = $row["cpf"];
                        $nomePersonal = $row["nome"];
                        $medianota = $row["media_nota"];
                        $tipo_treinoPersonal = $row["tipo_treino"];
                        $bairros_treinoPersonal = $row["bairros_treino"];
                        $tipo_pagamentoPersonal = $row["tipo_pagamento"];
                        $valorTreino = $row["valor"];
                        $telefone = $row["telefone"];
                        $descricao = $row["descricao"];
                        $tipo_pagamentoPersonalAluno = $row["forma_pagamento_aluno"];
                ?>
                        <!-- Card do Personal Trainer -->
                        <div class="col-lg-4 col-sm-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $nomePersonal; ?></h4>
                                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $tipo_treinoPersonal; ?></h6>
                                    <?php
                                        if($medianota != -1){
                                    ?>
                                        <h6 class="card-text">Nota média do personal: <?php echo $medianota; ?></h6>
                                    <?php 
                                        }else{
                                    ?>
                                        <h6 class="card-text">Novo na Plataforma</h6>
                                   <?php 
                                        }
                                    ?>
                                    <p class="card-text"><?php echo $bairros_treinoPersonal; ?></p>
                                    <p class="card-text">R$<?php echo $valorTreino; ?> por treino</p>
                                    <h6 class="card-text"><?php echo nl2br($descricao); ?></h6>
                                </div>
                                <div class="card-footer">
                                    <a  href="contratar_personal.php?cpfPersonal=<?php echo $cpfPersonal; ?>" class="btn btn-success">Contratar</a>
                                </div>
                            </div>
                        </div>

                        <?php
                                }
                            } else {
                        ?>
                        <?php
                              if ($countContatacaopendente > 0) {
                        ?>
                               <div class="text-center">
                                    <h2>Proposta Enviada, esperando resposta do Personal</h2>
                               </div>
                        <?php 
                              }
                              else if($countContatacaoaceita > 0){
                                $sqlficha = "SELECT * FROM ficha_treino WHERE aluno_cpf = '$cpf'";
                                $resultficha = $conn->query($sqlficha);
                                if ($resultficha && $resultficha->num_rows > 0) {
                                    $row = $resultficha->fetch_assoc();  
                                    $treino = $row['treino'];
                                }
                                if (isset($row['treino']) == "") {
                                    echo "<div class='row justify-content-md-center'>";
                                    echo "<div class='col-md-2'>";
                                    echo "</div>";
                                    echo "<div class='col-md-6'>";
                                    echo "<h6>Ficha de treino vazia</h6>";
                                    echo "</div>";
                                    echo "</div>";
                                } else {
                                    echo "<div class='row justify-content-md-center'>";
                                    echo "<div class='col-md-2'>";
                                    echo "</div>";
                                    echo "<div class='col-md-6'>";
                                    echo "<h2>FICHA:</h2>";
                                    echo "<h6>" . nl2br($row['treino']) . "</h6>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                               
                                
                              }
                        ?>
                        <?php      
                            }
                            $conn->close();
                        ?>
                        <br/>
                        <?php
                              if ($countFicha > 0) {
                        ?>
                        <div class='row justify-content-md-center'>
                            <div class='col-md-2'></div>
                            <div class='col-md-6'>
                                <form action="exportar_treino.php" method="POST">
                                    <input type="hidden" name="treino" value="<?php echo nl2br($treino) ?>">
                                    <input type="hidden" name="email" value="<?php echo $AlunoEmail ?>">
                                    <input type="hidden" name="name" value="<?php echo $AlunoName ?>">
                                    <button type="submit" class="btn btn-primary">Exportar ficha</button>
                                </form><br/>
                                <?php
                                    if (!isset($nota)) {
                                ?>
                                <form action="nota_personal.php" method="POST">                                  
                                    <input type="hidden" name="cpfpersonal" value="<?php echo $cpfpersonal ?>">
                                    <h6>Dê nota Ao personal (De 0 a 5)</h6>
                                    <input type="number" name="nota" id="nota" value="0" min="0" max="5" required class="small-input">
                                    <button type="submit" class="btn btn-primary">salvar nota</button>
                                </form><br/>
                                <?php
                                    }else{
                                ?>
                                    <h6 class="masthead-heading text-uppercase mb-0">Nota dada ao personal: <?php echo $nota; ?></h6><br/>
                                    <form action="excluir_nota_personal.php" method="POST">                                  
                                        <input type="hidden" name="cpfpersonal" value="<?php echo $cpfpersonal ?>">
                                        <input type="hidden" name="nota" value="<?php echo $nota ?>">
                                        <button type="submit" class="btn btn-danger">excluir nota</button>
                                    </form><br/><br/>
                                 <?php        
                                    }
                                ?>
                                <a  href="mandar_mensagem.php?telefone=<?php echo $telefonep; ?>" target="_blank" class="btn btn-success">Mande uma mensagem via WhatsApp para seu personal</a><br/><br/>
                                <a  href="acabar_contrato.php" class="btn btn-danger">Encerrar Contrato</a>                            </div>
                        </div>
                        <?php
                              }
                        ?>
                        <br/>
                        <a href="acabar_conta_aluno.php" class="btn btn-danger" onclick="return confirm('Tem certeza de que deseja encerrar sua conta?')">Encerrar sua Conta</a>

                </div>
            </div>
        </section>

        <!-- About Section-->
        <section class="page-section bg-primary text-white mb-0" id="about">
            <div class="container">
                <!-- About Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-white">Sobre Nós</h2>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- About Section Content-->
                <div class="row">
                    <div class="col-lg-4 ms-auto"><p class="lead">Persona Finder é um site inovador que revoluciona a conexão entre personal trainers e entusiastas de fitness, tornando mais fácil do que nunca encontrar a combinação perfeita. Com capacidades avançadas de pesquisa e recursos aprimorados, o Persona Finder oferece uma plataforma perfeita para profissionais e indivíduos se conectarem, garantindo a melhor experiência de treinamento.</p></div>
                    <div class="col-lg-4 me-auto"><p class="lead">Descubra a forma definitiva de alcançar seus objetivos de fitness com o Persona Finder. Nossa plataforma permite que você explore uma variedade diversificada de treinadores altamente qualificados, tornando fácil encontrar a pessoa certa para suas necessidades de treinamento. Experimente o poder de se conectar com especialistas dedicados a ajudá-lo a atingir novas alturas.</p></div>
                </div>
                <!-- About Section Button-->
                <div class="text-center mt-4">
                    <a class="btn btn-xl btn-outline-light"  href="mandar_mensagem.php?telefone=+5531997324575" target="_blank">
                    <i class="fa fa-phone" aria-hidden="true"></i>&nbsp;&nbsp;
                        Entre em contato para parcerias
                    </a>
                </div>
            </div>
        </section>
        <!-- Contact Section-->
        <section class="page-section" id="contact">
            <div class="container">
                <!-- Contact Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Nos Contate</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Contact Section Form-->
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-7">
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- * * SB Forms Contact Form * *-->
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- This form is pre-integrated with SB Forms.-->
                        <!-- To make this form functional, sign up at-->
                        <!-- https://startbootstrap.com/solution/contact-forms-->
                        <!-- to get an API token!-->
                        <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                            <!-- Name input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                                <label for="name">Nome Completo</label>
                                <div class="invalid-feedback" data-sb-feedback="name:required">Nome Obrigatório</div>
                            </div>
                            <!-- Email address input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email" type="email" placeholder="name@example.com" data-sb-validations="required,email" />
                                <label for="email">Email</label>
                                <div class="invalid-feedback" data-sb-feedback="email:required">O email é Obrigatório</div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">Este email não é válido.</div>
                            </div>
                            <!-- Phone number input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="phone" type="tel" placeholder="(11) 90456-7890" data-sb-validations="required" />
                                <label for="phone">Número do Telefone</label>
                                <div class="invalid-feedback" data-sb-feedback="phone:required">Número de telefone é Obrigatório.</div>
                            </div>
                            <!-- Message input-->
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="message" type="text" placeholder="Enter your message here..." style="height: 10rem" data-sb-validations="required"></textarea>
                                <label for="message">Messagem</label>
                                <div class="invalid-feedback" data-sb-feedback="message:required">A messagem é obrigatória.</div>
                            </div>
                            <!-- Submit success message-->
                            <!---->
                            <!-- This is what your users will see when the form-->
                            <!-- has successfully submitted-->
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Form submission successful!</div>
                                    To activate this form, sign up at
                                    <br />
                                    <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                </div>
                            </div>
                            <!-- Submit error message-->
                            <!---->
                            <!-- This is what your users will see when there is-->
                            <!-- an error submitting the form-->
                            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                            <!-- Submit Button-->
                            <button class="btn btn-primary btn-xl disabled" id="submitButton" type="submit">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer text-center">
            <div class="container">
                <div class="row">
                    <!-- Footer Location-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Localização</h4>
                        <p class="lead mb-0">
                            Belo Horizonte
                            <br />
                            Minas Gerais
                        </p>
                    </div>
                    <!-- Footer Social Icons-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Around the Web</h4>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-linkedin-in"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-dribbble"></i></a>
                    </div>
                    <!-- Footer About Text-->
                    <div class="col-lg-4">
                        <h4 class="text-uppercase mb-4">Sobre nós</h4>
                        <p class="lead mb-0">
                           Encontrando a melhor forma de treino para você
                            .
                        </p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Copyright Section-->
        <div class="copyright py-4 text-center text-white">
            <div class="container"><small>Copyright &copy; Your Website 2023</small></div>
        </div>
        <!-- Portfolio Modals-->
        <!-- Portfolio Modal 1-->
        <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" aria-labelledby="portfolioModal1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Log Cabin</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image-->
                                    <img class="img-fluid rounded mb-5" src="assets/img/portfolio/cabin.png" alt="..." />
                                    <!-- Portfolio Modal - Text-->
                                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                                    <button class="btn btn-primary" data-bs-dismiss="modal">
                                        <i class="fas fa-xmark fa-fw"></i>
                                        Close Window
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio Modal 2-->
        <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" aria-labelledby="portfolioModal2" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Tasty Cake</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image-->
                                    <img class="img-fluid rounded mb-5" src="assets/img/portfolio/cake.png" alt="..." />
                                    <!-- Portfolio Modal - Text-->
                                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                                    <button class="btn btn-primary" data-bs-dismiss="modal">
                                        <i class="fas fa-xmark fa-fw"></i>
                                        Close Window
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio Modal 3-->
        <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" aria-labelledby="portfolioModal3" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Circus Tent</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image-->
                                    <img class="img-fluid rounded mb-5" src="assets/img/portfolio/circus.png" alt="..." />
                                    <!-- Portfolio Modal - Text-->
                                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                                    <button class="btn btn-primary" data-bs-dismiss="modal">
                                        <i class="fas fa-xmark fa-fw"></i>
                                        Close Window
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio Modal 4-->
        <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" aria-labelledby="portfolioModal4" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Controller</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image-->
                                    <img class="img-fluid rounded mb-5" src="assets/img/portfolio/game.png" alt="..." />
                                    <!-- Portfolio Modal - Text-->
                                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                                    <button class="btn btn-primary" data-bs-dismiss="modal">
                                        <i class="fas fa-xmark fa-fw"></i>
                                        Close Window
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio Modal 5-->
        <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" aria-labelledby="portfolioModal5" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Locked Safe</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image-->
                                    <img class="img-fluid rounded mb-5" src="assets/img/portfolio/safe.png" alt="..." />
                                    <!-- Portfolio Modal - Text-->
                                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                                    <button class="btn btn-primary" data-bs-dismiss="modal">
                                        <i class="fas fa-xmark fa-fw"></i>
                                        Close Window
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio Modal 6-->
        <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" aria-labelledby="portfolioModal6" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Submarine</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image-->
                                    <img class="img-fluid rounded mb-5" src="assets/img/portfolio/submarine.png" alt="..." />
                                    <!-- Portfolio Modal - Text-->
                                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                                    <button class="btn btn-primary" data-bs-dismiss="modal">
                                        <i class="fas fa-xmark fa-fw"></i>
                                        Close Window
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>

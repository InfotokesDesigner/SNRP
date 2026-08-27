<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SNRP - Sistema de Registo Patrimonial</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7fb;
            color: #1f2937;
        }

        /* =========================================================
           NAVBAR
        ========================================================= */

        .navbar {
            background: #063b73;
            padding: 18px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 10;
        }

        .logo {
            color: white;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .logo span {
            color: #4da3ff;
        }

        .nav-links {
            display: flex;
            gap: 12px;
        }

        .nav-links a {
            text-decoration: none;
            color: white;
            padding: 10px 18px;
            border-radius: 6px;
            transition: 0.3s;
        }

        .nav-links a:hover {
            background: rgba(255,255,255,0.12);
        }

        .btn-login {
            border: 1px solid white;
        }


        /* =========================================================
           HERO / BANNER PRINCIPAL
        ========================================================= */

        .hero {
    position: relative;
    min-height: 500px;
    display: flex;
    align-items: center;
    padding: 70px 7%;
    color: white;
    overflow: hidden;
}

.hero-image {
    position: absolute;
    inset: 0;

    width: 100%;
    height: 100%;

    object-fit: cover;
    object-position: center;

    z-index: 0;
}

.hero-overlay {
    position: absolute;
    inset: 0;

    background: linear-gradient(
        90deg,
        rgba(6, 59, 115, 0.92),
        rgba(6, 59, 115, 0.70),
        rgba(6, 59, 115, 0.20)
    );

    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 2;
    max-width: 700px;
}


        .hero-content {
            max-width: 700px;

            position: relative;

            z-index: 2;
        }


        .hero h1 {
            font-size: 48px;

            line-height: 1.15;

            margin-bottom: 20px;

            text-shadow:
                0 2px 5px rgba(0,0,0,0.25);
        }


        .hero h1 span {
            color: #72c3ff;
        }


        .hero p {
            font-size: 19px;

            line-height: 1.7;

            margin-bottom: 30px;

            color: #f0f7ff;

            max-width: 650px;
        }


        /* =========================================================
           BOTÕES
        ========================================================= */

        .buttons {
            display: flex;

            gap: 15px;

            flex-wrap: wrap;
        }


        .btn {
            display: inline-block;

            padding: 14px 24px;

            border-radius: 7px;

            text-decoration: none;

            font-weight: bold;

            transition: 0.3s;
        }


        .btn-primary {
            background: white;

            color: #063b73;

            box-shadow:
                0 4px 12px rgba(0,0,0,0.15);
        }


        .btn-primary:hover {
            background: #e7f2ff;

            transform: translateY(-2px);
        }


        .btn-outline {
            border: 1px solid white;

            color: white;

            background: rgba(255,255,255,0.05);
        }


        .btn-outline:hover {
            background: rgba(255,255,255,0.15);

            transform: translateY(-2px);
        }


        /* =========================================================
           FUNCIONALIDADES
        ========================================================= */

        .section {
            padding: 70px 7%;
        }


        .section-title {
            text-align: center;

            margin-bottom: 45px;
        }


        .section-title h2 {
            color: #063b73;

            font-size: 32px;

            margin-bottom: 10px;
        }


        .section-title p {
            color: #6b7280;
        }


        .cards {
            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 25px;
        }


        .card {
            background: white;

            padding: 30px;

            border-radius: 10px;

            box-shadow:
                0 4px 18px rgba(0,0,0,0.06);

            border-top: 4px solid #0b63b6;

            transition: 0.3s;
        }


        .card:hover {
            transform: translateY(-5px);

            box-shadow:
                0 8px 25px rgba(0,0,0,0.10);
        }


        .card-icon {
            width: 50px;

            height: 50px;

            background: #e8f3ff;

            color: #0b63b6;

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 22px;

            margin-bottom: 20px;
        }


        .card h3 {
            color: #063b73;

            margin-bottom: 12px;
        }


        .card p {
            color: #6b7280;

            line-height: 1.6;
        }


        /* =========================================================
           COFRE PATRIMONIAL DIGITAL
        ========================================================= */

        .cofre {
            background: #063b73;

            color: white;

            padding: 70px 7%;

            text-align: center;
        }


        .cofre h2 {
            font-size: 32px;

            margin-bottom: 15px;
        }


        .cofre p {
            max-width: 750px;

            margin: auto;

            line-height: 1.7;

            color: #dcecff;
        }


        /* =========================================================
           FOOTER
        ========================================================= */

        footer {
            background: #04294f;

            color: #b9d3eb;

            text-align: center;

            padding: 25px;

            font-size: 14px;
        }


        /* =========================================================
           RESPONSIVO
        ========================================================= */

        @media (max-width: 900px) {

            .cards {
                grid-template-columns: 1fr;
            }


            .hero {
                min-height: 520px;

                background-position: center;
            }


            .hero h1 {
                font-size: 38px;
            }


            .hero p {
                font-size: 17px;
            }


            .navbar {
                flex-direction: column;

                gap: 15px;
            }

        }


        @media (max-width: 600px) {

            .navbar {
                padding: 15px 5%;
            }


            .nav-links {
                width: 100%;

                justify-content: center;
            }


            .hero {
                padding: 60px 5%;

                min-height: 560px;

                background-position: center;
            }


            .hero h1 {
                font-size: 32px;
            }


            .hero p {
                font-size: 16px;
            }


            .buttons {
                flex-direction: column;

                align-items: stretch;
            }


            .btn {
                text-align: center;
            }


            .section {
                padding: 55px 5%;
            }

        }

    </style>

</head>


<body>


    <!-- =========================================================
         NAVBAR
    ========================================================= -->

    <nav class="navbar">

        <div class="logo">
            SNR<span>P</span>
        </div>


        <div class="nav-links">

            <a href="{{ route('consulta.publica') }}">
                Consulta Pública
            </a>


            <a
                href="{{ route('login') }}"
                class="btn-login"
            >
                Entrar
            </a>

        </div>

    </nav>



    <!-- =========================================================
         HERO / BANNER PRINCIPAL
    ========================================================= -->

    <section class="hero">

    <img
        src="{{ asset('images/banner-snrp.jpg') }}"
        alt="SNRP - Sistema de Registo Patrimonial"
        class="hero-image"
    >

    <div class="hero-overlay"></div>

    <div class="hero-content">

        <h1>
            Sistema Nacional de <span>Registo Patrimonial</span>
        </h1>

        <p>
            Uma plataforma digital para o registo, organização,
            identificação, consulta e proteção dos bens patrimoniais.
        </p>

        <div class="buttons">

            <a
                href="{{ route('consulta.publica') }}"
                class="btn btn-primary"
            >
                Consultar Património
            </a>

            <a
                href="{{ route('login') }}"
                class="btn btn-outline"
            >
                Aceder ao Sistema
            </a>

        </div>

    </div>

</section>



    <!-- =========================================================
         FUNCIONALIDADES
    ========================================================= -->

    <section class="section">


        <div class="section-title">

            <h2>
                Gestão Patrimonial
            </h2>


            <p>
                Uma solução integrada para uma gestão patrimonial
                mais organizada.
            </p>

        </div>



        <div class="cards">


            <!-- PATRIMÓNIOS -->

            <div class="card">

                <div class="card-icon">
                    🏠
                </div>


                <h3>
                    Patrimónios
                </h3>


                <p>

                    Registo e gestão de casas, terrenos,
                    viaturas e outros bens patrimoniais.

                </p>

            </div>



            <!-- PESSOAS -->

            <div class="card">

                <div class="card-icon">
                    👤
                </div>


                <h3>
                    Pessoas
                </h3>


                <p>

                    Cadastro dos cidadãos e proprietários
                    associados aos bens patrimoniais.

                </p>

            </div>



            <!-- TRANSFERÊNCIAS -->

            <div class="card">

                <div class="card-icon">
                    🔄
                </div>


                <h3>
                    Transferências
                </h3>


                <p>

                    Registo do histórico de transferência
                    de propriedade e movimentações patrimoniais.

                </p>

            </div>


        </div>

    </section>



    <!-- =========================================================
         COFRE PATRIMONIAL DIGITAL
    ========================================================= -->

    <section class="cofre">


        <h2>
            Cofre Patrimonial Digital
        </h2>


        <p>

            O SNRP permite manter informações patrimoniais
            organizadas e associadas a identificadores únicos,
            facilitando a consulta, o acompanhamento e a proteção
            dos bens registados.

        </p>


    </section>



    <!-- =========================================================
         FOOTER
    ========================================================= -->

    <footer>

        &copy; {{ date('Y') }}

        SNRP -
        Sistema de Registo Patrimonial.

        Todos os direitos reservados.

    </footer>


</body>

</html>
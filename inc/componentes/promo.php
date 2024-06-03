<section class="container pb-sm-1 pb-md-3">
    <!-- Row 1 -->
    <div class="row align-items-lg-center pb-5 mb-2 mb-lg-4 mb-xl-5">
        <div class="col-md-6 mb-4 mb-md-0">
            <iframe
                style="display: none; border-radius: 15px;"
                width="100%"
                height="315"
                src="https://www.youtube.com/embed/wljsbPQR-gQ?si=bR8IXIbiG5BI_2aC&autoplay=1&mute=1&loop=1"
                title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin"
                allowfullscreen
            ></iframe>
        </div>
        <div style="display: none;" class="col-md-6">
            <div class="ps-xl-5 ms-md-2 ms-lg-4">
                <h2 class="h1 mb-3 mb-sm-4">Final de UEFA Champions League</h2>
                <p class="mb-4 mb-lg-5">Borussia Dortmund y Real Madrid se enfrentan para disputar la final de la Liga de Campeones. Míralo en vivo y completamente gratis en iRaffle TV.</p>
                <script>
                    var yyyy = 2024;
                    var mm = "5";
                    var dd = "01";
                    var hh = "21";
                    var m = "00";

                    var textLive = "<p style='position: absolute;' class='live-text'><div class='d-flex align-items-center me-4'><i class='bx bxs-circle bx-flashing fs-xl me-1'></i> EN VIVO</div></p>";
                    var textEnd = "Finalizó";

                    // Set the date we're counting down to
                    // Year, Month ( 0 for January ), Day, Hour, Minute, Second, , Milliseconds
                    //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
                    //::::::::::::                                       ::::::::::::
                    //::::::::::::              12:00 AM                  ::::::::::::
                    //::::::::::::                                       ::::::::::::
                    //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
                    //                                              (AAAA, MM, DD, HH, MM, SS));
                    var countDownDate12173509 = new Date(Date.UTC(yyyy, mm, dd, hh, m, 00));

                    // Update the count down every 1 second
                    var x12173509 = setInterval(function () {
                        // Get todays date and time
                        var now12173509 = new Date().getTime();

                        // Find the distance between now an the count down date
                        // GMT/UTC Adjustment at the end of the function. 0 = GMT/UTC+0; 1 = GMT/UTC+1.
                        var distance12173509 = countDownDate12173509 - now12173509 - 3600000 * 2;

                        // Time calculations for days, hours, minutes and seconds
                        var days12173509 = Math.floor(distance12173509 / (1000 * 60 * 60 * 24));
                        var hours12173509 = Math.floor((distance12173509 % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes12173509 = Math.floor((distance12173509 % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds12173509 = Math.floor((distance12173509 % (1000 * 60)) / 1000);

                        // Output the result in an element with id="demo"
                        if (days12173509 == 1) {
                            for (const ele of document.getElementsByClassName("cntdwn-12173509")) {
                                ele.innerHTML = "Mañana";
                            }
                        } else if (days12173509 > 0 && days12173509 < 7) {
                            for (const ele of document.getElementsByClassName("cntdwn-12173509")) {
                                ele.innerHTML = days12173509 + "d " + hours12173509 + "h ";
                            }
                        } else if (days12173509 > 6 && days12173509 < 14) {
                            for (const ele of document.getElementsByClassName("cntdwn-12173509")) {
                                ele.innerHTML = "Próx. Semana";
                            }
                        } else if (days12173509 > 13 && days12173509 < 21) {
                            for (const ele of document.getElementsByClassName("cntdwn-12173509")) {
                                ele.innerHTML = "2 Semanas";
                            }
                        } else if (days12173509 > 20 && days12173509 < 28) {
                            for (const ele of document.getElementsByClassName("cntdwn-12173509")) {
                                ele.innerHTML = "3 Semanas";
                            }
                        } else if (days12173509 > 27 && days12173509 < 60) {
                            for (const ele of document.getElementsByClassName("cntdwn-12173509")) {
                                ele.innerHTML = "Próx. Mes";
                            }
                        } else if (days12173509 > 59 && days12173509 < 90) {
                            for (const ele of document.getElementsByClassName("cntdwn-12173509")) {
                                ele.innerHTML = "2 Meses";
                            }
                        } else if (days12173509 > 89 && days12173509 < 120) {
                            for (const ele of document.getElementsByClassName("cntdwn-12173509")) {
                                ele.innerHTML = "3 Meses";
                            }
                        } else if (days12173509 == 0) {
                            for (const ele of document.getElementsByClassName("cntdwn-12173509")) {
                                ele.innerHTML = hours12173509 + "h " + minutes12173509 + "m " + seconds12173509 + "s";
                            }
                        } else if (hours12173509 == 0 && days12173509 == 0) {
                            for (const ele of document.getElementsByClassName("cntdwn-12173509")) {
                                ele.innerHTML = minutes12173509 + "m " + seconds12173509 + "s";
                            }
                        } else if (hours12173509 == 0 && minutes12173509 == 0) {
                            for (const ele of document.getElementsByClassName("cntdwn-12173509")) {
                                ele.innerHTML = seconds12173509 + "s";
                            }
                        } else {
                            for (const ele of document.getElementsByClassName("cntdwn-12173509")) {
                                ele.innerHTML = days12173509 + "d " + hours12173509 + "h " + minutes12173509 + "m " + seconds12173509 + "s";
                            }
                        }
                        // If the count down is over, write some text
                        if (distance12173509 < 0) {
                            for (const ele of document.getElementsByClassName("cntdwn-12173509")) {
                                ele.innerHTML = textLive;
                            }
                            // 3 hs
                            if (distance12173509 + 10800000 < 0) {
                                for (const allEllements of document.getElementsByClassName("cntdwn-12173509")) {
                                    allEllements.innerHTML = textEnd;
                                }
                            }
                            // 6 meses
                            if (distance12173509 > 15778800000) {
                                for (const allEllements of document.getElementsByClassName("cntdwn-12173509")) {
                                    allEllements.innerHTML = "Por definir";
                                }
                            }
                        }
                    }, 1000);
                </script>
                <!-- Elemento -->
                <div class="col-12 mycard">
                    <a href="?p=eventos&tipo=football&liga=7">
                        <div class="card product-card">
                            <div class="main-event">
                                <div class="league">
                                    <img class="league-img" src="assets/img/ligas/sf/7.png" alt="League" />
                                    <!-- <p class="12173509"></p> -->
                                    <p class="fs-sm text-body mb-0 cntdwn-12173509"></p>
                                </div>
                                <div class="match">
                                    <div class="team">
                                        <img width="60px" src="assets/img/equipos/sf/2673.png" alt="" />
                                        <h4>
                                            Borussia Dortmund
                                        </h4>
                                    </div>
                                    <div class="vs">
                                        <h6>vs</h6>
                                    </div>
                                    <div class="team">
                                        <img width="60px" src="assets/img/equipos/sf/2829.png" alt="" />
                                        <h4>
                                            Real Madrid
                                        </h4>
                                    </div>
                                </div>
                                <div class="channel">
                                    <img src="assets/img/canales/starplus.png" alt="" />
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <hr />
                <!-- End Elemento -->
            </div>
        </div>
    </div>

    <!-- Row 2 -->
    <div class="row align-items-lg-center pt-md-3 pb-5 mb-2 mb-lg-4 mb-xl-5">
        <div class="col-md-6 order-md-2 mb-4 mb-md-0">
            <img src="https://phantom-marca.unidadeditorial.es/31b84a6f5469c6fab5d08d2e64b2d97f/resize/828/f/jpg/assets/multimedia/imagenes/2024/06/02/17173479630254.jpg" class="rounded-3" alt="Image" />
        </div>
        <div class="col-md-6 order-md-1">
            <div class="pe-xl-5 me-md-2 me-lg-4">
                <h2 class="h1 mb-3 mb-sm-4">Mbappé ya es nuevo jugador de Real Madrid</h2>
                <p class="mb-3 mb-sm-4">
                    Finalmente Real Madrid hizo oficial la contratación del delantero francés Kylian Mbappé, quien llega a los Merengues procedente del Paris Saint-Germain.
                    La llegada de Kylian Mbappé a 'Los Blancos’ es uno de los fichajes más esperados del Real Madrid en los últimos años.
                </p>
                <ul style="display: none" class="list-unstyled mb-0">
                    <li class="d-flex mb-2">
                        <i class="bx bx-check text-primary lead me-2"></i>
                        Quis euismod lacus, at consectetur porta
                    </li>
                    <li class="d-flex mb-2">
                        <i class="bx bx-check text-primary lead me-2"></i>
                        Dictumst enim lectus dis eget non metus cras
                    </li>
                    <li class="d-flex">
                        <i class="bx bx-check text-primary lead me-2"></i>
                        Risus volutpat tellus hendrerit nibh
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="container pb-sm-1 pb-md-3">
    <!-- Row 1 -->
    <div class="row align-items-lg-center pb-5 mb-2 mb-lg-4 mb-xl-5">
        <div class="col-md-6 mb-4 mb-md-0">
            <iframe style="border-radius: 15px" width="100%" height="315"
                src="https://www.youtube.com/embed/3hxiISQmGDs?si=bR8IXIbiG5BI_2aC&autoplay=1&mute=1&loop=1" title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
        <div class="col-md-6">
            <div class="ps-xl-5 ms-md-2 ms-lg-4">
                <h2 class="h1 mb-3 mb-sm-4">Final de Liga Nacional de Honduras, Ida</h2>
                <p class="mb-4 mb-lg-5">Olimpia y Marathón juegan por la final de ida de la Liga Nacional de Honduras.
                    Míralo en vivo y completamente gratis en iRaffle TV.</p>
                <script>
                    var yyyy = 2024;
                    var mm = '4';
                    var dd = '20';
                    var hh = '02';
                    var m = '00';

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
                    var countDownDate12334054 = new Date(Date.UTC(yyyy, mm, dd, hh, m, 00));

                    // Update the count down every 1 second
                    var x12334054 = setInterval(function () {

                        // Get todays date and time
                        var now12334054 = new Date().getTime();

                        // Find the distance between now an the count down date
                        // GMT/UTC Adjustment at the end of the function. 0 = GMT/UTC+0; 1 = GMT/UTC+1.
                        var distance12334054 = countDownDate12334054 - now12334054 - (3600000 * 2);

                        // Time calculations for days, hours, minutes and seconds
                        var days12334054 = Math.floor(distance12334054 / (1000 * 60 * 60 * 24));
                        var hours12334054 = Math.floor((distance12334054 % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes12334054 = Math.floor((distance12334054 % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds12334054 = Math.floor((distance12334054 % (1000 * 60)) / 1000);

                        // Output the result in an element with id="demo"
                        if (days12334054 == 1) {
                            for (const ele of document.getElementsByClassName("cntdwn-12334054")) {
                                ele.innerHTML = ("Mañana")
                            }
                        } else if (days12334054 > 0 && days12334054 < 7) {
                            for (const ele of document.getElementsByClassName("cntdwn-12334054")) {
                                ele.innerHTML = (days12334054 + "d " + hours12334054 + "h ")
                            }
                        } else if (days12334054 > 6 && days12334054 < 14) {
                            for (const ele of document.getElementsByClassName("cntdwn-12334054")) {
                                ele.innerHTML = ("Próx. Semana")
                            }
                        } else if (days12334054 > 13 && days12334054 < 21) {
                            for (const ele of document.getElementsByClassName("cntdwn-12334054")) {
                                ele.innerHTML = ("2 Semanas")
                            }
                        } else if (days12334054 > 20 && days12334054 < 28) {
                            for (const ele of document.getElementsByClassName("cntdwn-12334054")) {
                                ele.innerHTML = ("3 Semanas")
                            }
                        } else if (days12334054 > 27 && days12334054 < 60) {
                            for (const ele of document.getElementsByClassName("cntdwn-12334054")) {
                                ele.innerHTML = ("Próx. Mes")
                            }
                        } else if (days12334054 > 59 && days12334054 < 90) {
                            for (const ele of document.getElementsByClassName("cntdwn-12334054")) {
                                ele.innerHTML = ("2 Meses")
                            }
                        } else if (days12334054 > 89 && days12334054 < 120) {
                            for (const ele of document.getElementsByClassName("cntdwn-12334054")) {
                                ele.innerHTML = ("3 Meses")
                            }
                        } else if (days12334054 == 0) {
                            for (const ele of document.getElementsByClassName("cntdwn-12334054")) {
                                ele.innerHTML = (hours12334054 + "h " + minutes12334054 + "m " + seconds12334054 + "s")
                            }
                        } else if (hours12334054 == 0 && days12334054 == 0) {
                            for (const ele of document.getElementsByClassName("cntdwn-12334054")) {
                                ele.innerHTML = (minutes12334054 + "m " + seconds12334054 + "s")
                            }
                        } else if (hours12334054 == 0 && minutes12334054 == 0) {
                            for (const ele of document.getElementsByClassName("cntdwn-12334054")) {
                                ele.innerHTML = (seconds12334054 + "s")
                            }
                        } else {
                            for (const ele of document.getElementsByClassName("cntdwn-12334054")) {
                                ele.innerHTML = (days12334054 + "d " + hours12334054 + "h "
                                    + minutes12334054 + "m " + seconds12334054 + "s")
                            }
                        }
                        // If the count down is over, write some text
                        if (distance12334054 < 0) {
                            for (const ele of document.getElementsByClassName("cntdwn-12334054")) {
                                ele.innerHTML = textLive;
                            }
                            // 3 hs
                            if (distance12334054 + 10800000 < 0) {
                                for (const allEllements of document.getElementsByClassName("cntdwn-12334054")) {
                                    allEllements.innerHTML = textEnd;
                                }
                            }
                            // 6 meses
                            if (distance12334054 > 15778800000) {
                                for (const allEllements of document.getElementsByClassName("cntdwn-12334054")) {
                                    allEllements.innerHTML = "Por definir";
                                }
                            }
                        }
                    }, 1000);
                </script> <!-- Elemento -->
                <div class="col-12 mycard">
                    <a href="?p=eventos&tipo=football&liga=11614&juego=12334054">
                        <div class="card product-card">
                            <div class="main-event">
                                <div class="league">
                                    <img src="assets/img/ligas/sf/11614.png" alt="League" />
                                    <!-- <p class="12334054"></p> -->
                                    <p class="fs-sm text-body mb-0 cntdwn-12334054"></p>
                                </div>
                                <div class="match">
                                    <div class="team">
                                        <img width="60px" src="assets/img/equipos/sf/25358.png" alt="" />
                                        <h4>
                                            CD Olimpia </h4>
                                    </div>
                                    <div class="vs">
                                        <h6>vs</h6>
                                    </div>
                                    <div class="team">
                                        <img width="60px" src="assets/img/equipos/sf/25355.png" alt="" />
                                        <h4>
                                            CD Marathon </h4>
                                    </div>
                                </div>
                                <div class="channel">
                                    <img src="assets/img/canales/tsi.png" alt="" />
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- End Elemento -->
            </div>
        </div>
    </div>

    <!-- Row 2 -->
    <div style="display: none;" class="row align-items-lg-center pt-md-3 pb-5 mb-2 mb-lg-4 mb-xl-5">
        <div class="col-md-6 order-md-2 mb-4 mb-md-0">
            <img src="assets/img/services/single/image02.jpg" class="rounded-3" alt="Image">
        </div>
        <div class="col-md-6 order-md-1">
            <div class="pe-xl-5 me-md-2 me-lg-4">
                <h2 class="h1 mb-3 mb-sm-4">Product development with the best experience</h2>
                <p class="mb-3 mb-sm-4">We create diverse, complex, web and mobile solutions for any business need. With
                    us you get quality software and perfect service every time. Quisque integer eget velit facilisis
                    enim malesuada metus, risus amet ultricies.</p>
                <ul class="list-unstyled mb-0">
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
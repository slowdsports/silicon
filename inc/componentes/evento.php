<section class="pt-lg-4 mt-lg-3">
    <div class="position-relative overflow-hidden">
        <!-- Image -->
        <div class="container-fluid position-relative position-lg-absolute top-0 start-0 h-100">
            <div class="row h-100 me-n4 me-n2">
                <div class="col-lg-7 position-relative">
                    <div class="d-none d-sm-block d-lg-none" style="height: 400px;"></div>
                    <div class="d-sm-none" style="height: 300px;"></div>
                    <div class="jarallax position-absolute top-0 start-0 w-100 h-100 rounded-3 rounded-start-0 overflow-hidden" data-jarallax="" data-speed="0.3">
                        <div
                            id="jarallax-container-0"
                            class="jarallax-container"
                            style="position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; overflow: hidden; z-index: -100; clip-path: polygon(0px 0px, 100% 0px, 100% 100%, 0px 100%);"
                        >
                            <div
                                class="jarallax-img"
                                style="
                                    background-image: url('https://image.discovery.indazn.com/ca/v2/ca/image?id=mu3kfd4rkpubv8qudrhn56kd_image-header_pJp_1729750429000');
                                    object-fit: cover;
                                    object-position: 50% 50%;
                                    max-width: none;
                                    position: fixed;
                                    top: 0px;
                                    left: 0px;
                                    width: 721.992px;
                                    height: 685.6px;
                                    overflow: hidden;
                                    pointer-events: none;
                                    transform-style: preserve-3d;
                                    backface-visibility: hidden;
                                    margin-top: 61.2px;
                                    transform: translate3d(0px, -40.8211px, 0px);
                                "
                                data-jarallax-original-styles="https://image.discovery.indazn.com/ca/v2/ca/image?id=mu3kfd4rkpubv8qudrhn56kd_image-header_pJp_1729750429000);"
                            ></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container position-relative zindex-5 pt-lg-5 px-0 px-lg-3">
            <div class="row pt-lg-5 mx-n4 mx-lg-n3">
                <div class="col-xl-6 col-lg-7 offset-lg-5 offset-xl-6 pb-5">
                    <!-- Card -->
                    <div class="card bg-dark border-light overflow-hidden py-4 px-2 p-sm-4">
                        <span class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(255, 255, 255, 0.05);"></span>
                        <div class="card-body position-relative zindex-5">
                            <p class="fs-xl fw-bold text-primary text-uppercase mb-3">Formula 1</p>
                            <h1 class="display-5 text-light pb-3 mb-3">BRAZIL GP</h1>
                            <p class="fs-lg text-light opacity-70 mb-5">Tras los Grandes Premios de Estados Unidos y México, la máxima categoría del automovilismo se queda en el continente para el Gran Premio de Brasil en el icónico circuito de interlagos. Esta carrera será especial, ya que se conmemoran 30 años del fallecimiento de Ayrton Senna, una leyenda del automovilismo brasileño.</p>
                            <ul class="list-unstyled">
                                <li class="d-flex align-items-center fs-sm mb-2">
                                    <p class="counter">
                                        <!--<i class="bx bxs-timer fs-xl text-primary me-2"></i>
                                        <span class="cntdwn-dor"</span> -->
                                        <div class='d-flex align-items-center me-4'><i class='bx bxs-circle bx-flashing fs-xl me-1'></i>EN VIVO</div>
                                    </p>
                                    <?php $index = 'dor'; ?>
                                    <script>
                                    var yyyy = 2024;
                                    var mm = 9;
                                    var dd = 28;
                                    var hh = 20;
                                    var m = 30;
                                
                                    var textLive = "<div class='d-flex align-items-center me-4'><i class='bx bxs-circle bx-flashing fs-xl me-1'></i>EN VIVO</div>";
                                    var textEnd = "Finalizó";
                                
                                
                                
                                    // Set the date we're counting down to
                                    // Year, Month ( 0 for January ), Day, Hour, Minute, Second, , Milliseconds
                                    //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
                                    //::::::::::::                                       ::::::::::::
                                    //::::::::::::              12:00 AM                  ::::::::::::
                                    //::::::::::::                                       ::::::::::::
                                    //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
                                    //                                              (AAAA, MM, DD, HH, MM, SS));
                                    var countDownDate<?= $index ?> = new Date(Date.UTC(yyyy, mm, dd, hh, m, 00));
                                
                                    // Update the count down every 1 second
                                    var x<?= $index ?> = setInterval(function () {
                                
                                        // Get todays date and time
                                        var now<?= $index ?> = new Date().getTime();
                                
                                        // Find the distance between now an the count down date
                                        // GMT/UTC Adjustment at the end of the function. 0 = GMT/UTC+0; 1 = GMT/UTC+1.
                                        var distance<?= $index ?> = countDownDate<?= $index ?> - now<?= $index ?> - (3600000 * 2);
                                
                                        // Time calculations for days, hours, minutes and seconds
                                        var days<?= $index ?> = Math.floor(distance<?= $index ?> / (1000 * 60 * 60 * 24));
                                        var hours<?= $index ?> = Math.floor((distance<?= $index ?> % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                        var minutes<?= $index ?> = Math.floor((distance<?= $index ?> % (1000 * 60 * 60)) / (1000 * 60));
                                        var seconds<?= $index ?> = Math.floor((distance<?= $index ?> % (1000 * 60)) / 1000);
                                
                                        // Output the result in an element with id="demo"
                                        if (days<?= $index ?> > 0) {
                                            for (const ele of document.getElementsByClassName("cntdwn-<?= $index ?>")) {
                                                ele.innerHTML = (days<?= $index ?> + "d " + hours<?= $index ?> + "h "
                                                    + minutes<?= $index ?> + "m " + seconds<?= $index ?> + "s")
                                            }
                                        } else if (hours<?= $index ?> == 0) {
                                            for (const ele of document.getElementsByClassName("cntdwn-<?= $index ?>")) {
                                                ele.innerHTML = (minutes<?= $index ?> + "m " + seconds<?= $index ?> + "s")
                                            }
                                        } else if (minutes<?= $index ?> == 0) {
                                            for (const ele of document.getElementsByClassName("cntdwn-<?= $index ?>")) {
                                                ele.innerHTML = (seconds<?= $index ?> + "s")
                                            }
                                        } else {
                                            for (const ele of document.getElementsByClassName("cntdwn-<?= $index ?>")) {
                                                ele.innerHTML = (hours<?= $index ?> + "h "
                                                    + minutes<?= $index ?> + "m " + seconds<?= $index ?> + "s")
                                            }
                                        }
                                        // If the count down is over, write some text
                                        if (distance<?= $index ?> < 0) {
                                            for (const ele of document.getElementsByClassName("cntdwn-<?= $index ?>")) {
                                                ele.innerHTML = textLive;
                                            }
                                            if (distance<?= $index ?> + 10800000 < 0) {
                                                for (const allEllements of document.getElementsByClassName("cntdwn-<?= $index ?>")) {
                                                    allEllements.innerHTML = textEnd;
                                                }
                                            }
                                        }
                                    }, 1000
                                        //5000
                                    );
                                </script>
                                </li>
                            </ul>

                            <div class="d-flex flex-column flex-sm-row">
                                <a href="?p=motor" class="btn btn-outline-light btn-lg">
                                    Ver en Vivo
                                    <i class="bx bx-right-arrow-alt fs-4 lh-1 ms-2 me-n1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
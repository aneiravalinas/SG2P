<?php

class Show_Users {

    var $users;

    function __construct($users) {
        $this->users = $users;
        $this->render();
    }

    function render() {
        include './View/Page/header.php';
        ?>

        <!-- === SECTION TABLE === -->

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="mb-4">Tabla Usuario</h1>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 flex-wrap d-flex justify-content-end" id="search_add">
                        <div>
                            <a href="index.html">
                                <span class="iconify option_button" data-icon="fluent:search-square-24-filled" data-inline="false"></span>
                            </a>
                            <a href="index.html">
                                <span class="iconify option_button" data-icon="gridicons-add" data-inline="false"></span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 table-responsive" id="col-table">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">DNI</th>
                                    <th scope="col">Usuario</th>
                                    <th scope="col">Rol</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>44093332D</td>
                                <td>Antonio</td>
                                <td>Neira Valiñas</td>
                                <td>
                                    <div class="btn-group dropdown">
                                        <button type="button" class="btn btn-sm btn-primary">
                                            <span class="iconify" data-icon="icon-park-outline:config" data-inline="false"></span>
                                        </button>
                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Separated link</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>44223332D</td>
                                <td>Lua</td>
                                <td>Guau Guau</td>
                                <td>
                                    <div class="btn-group dropdown">
                                        <button type="button" class="btn btn-sm btn-primary">
                                            <span class="iconify" data-icon="icon-park-outline:config" data-inline="false"></span>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Separated link</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>44223333D</td>
                                <td>Luaa</td>
                                <td>Guaau Guaaau</td>
                                <td>
                                    <div class="btn-group dropdown">
                                        <button type="button" class="btn btn-sm btn-primary">
                                            <span class="iconify" data-icon="icon-park-outline:config" data-inline="false"></span>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Separated link</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

    <?php
        include './View/Page/footer.php';
    }
}

?>

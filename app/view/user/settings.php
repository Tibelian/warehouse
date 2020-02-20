<?php
View::setTitle('Ajustes de perfil');
View::loadHeader();
$warehouse = $_SESSION['warehouse'];
?>


<div class="container-fluid">

    <div class="row m-2 justify-content-center">
        <div class="col-md-7 my-3">

            <?php
            if (isset($_SESSION['alert'])) {
                foreach ($_SESSION['alert'] as $alert) {
                    echo $alert;
                }
                unset($_SESSION['alert']);
            }
            ?>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="company-tab" data-toggle="tab" href="#company" role="tab" aria-controls="company" aria-selected="true">Empresa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pass-tab" data-toggle="tab" href="#pass" role="tab" aria-controls="pass" aria-selected="false">Contraseña</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="email-tab" data-toggle="tab" href="#email" role="tab" aria-controls="email" aria-selected="false">Email</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Foto</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">

                <!-- change company data -->
                <div class="tab-pane fade show active" id="company" role="tabpanel" aria-labelledby="company-tab">
                    <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post" class="bg-opacity p-5 rounded-bottom border-bottom border-left border-right">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="cif"><i class="fas fa-key"></i> CIF:</label>
                                <input type="text" class="form-control" name="cif" id="cif" required value="<?= $warehouse['cif']; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nombre-empresa"><i class="fas fa-lock"></i> Nombre empresa:</label>
                                <input type="text" class="form-control" name="nombre-empresa" id="nombre-empresa" required value="<?= $warehouse['business_name']; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="codigo-almacen"><i class="fas fa-hashtag"></i> Código almacén:</label>
                                <input type="text" class="form-control" name="codigo-almacen" id="codigo-almacen" required value="<?= $warehouse['warehouse_code']; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nombre-almacen"><i class="fas fa-warehouse"></i> Nombre almacén:</label>
                                <input type="text" class="form-control" name="nombre-almacen" id="nombre-almacen" required value="<?= $warehouse['warehouse_name']; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="telefono"><i class="fas fa-phone"></i> Teléfono:</label>
                                <input type="text" class="form-control" name="telefono" id="telefono" required value="<?= $warehouse['phone']; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="emailInput"><i class="fas fa-envelope"></i> Email:</label>
                                <input type="email" class="form-control" name="email" id="emailInput" required value="<?= $warehouse['email']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="web"><i class="fas fa-link"></i> Web:</label>
                            <input type="url" class="form-control" name="web" id="web" required value="<?= $warehouse['web']; ?>">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="direccion"><i class="fas fa-map"></i> Dirección:</label>
                                <input type="text" class="form-control" name="direccion" id="direccion" required value="<?= $warehouse['residence']; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="localidad"><i class="far fa-map"></i> Localidad:</label>
                                <input type="text" class="form-control" name="localidad" id="localidad" required value="<?= $warehouse['location']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="responsable"><i class="fas fa-user"></i> Responsable:</label>
                            <input type="text" class="form-control" name="responsable" id="responsable" required value="<?= $warehouse['responsable']; ?>">
                        </div>
                        <div class="form-row justify-content-center">
                            <button type="submit" name="changeCompany" class="btn btn-primary"><i class="fas fa-sync"></i> Cambiar datos</button>
                        </div>
                    </form>
                </div>

                <!-- change password -->
                <div class="tab-pane fade" id="pass" role="tabpanel" aria-labelledby="pass-tab">
                    <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post" class="bg-opacity p-5 rounded-bottom border-bottom border-left border-right">
                        <div class="form-group">
                            <label for="password"><i class="fas fa-key"></i> Contraseña Actual:</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                        <div class="form-group">
                            <label for="newpassword"><i class="fas fa-lock"></i> Contraseña Nueva:</label>
                            <input type="password" class="form-control" name="newpassword" id="newpassword" required>
                        </div>
                        <div class="form-group">
                            <label for="newpassword2"><i class="fas fa-lock"></i> Cofirmar Contraseña Nueva:</label>
                            <input type="password" class="form-control" name="newpassword2" id="newpassword2" required>
                        </div>
                        <div class="form-row justify-content-center">
                            <button type="submit" name="changePassword" class="btn btn-primary"><i class="fas fa-sync"></i> Cambiar contraseña</button>
                        </div>
                    </form>
                </div>

                <!-- change email -->
                <div class="tab-pane fade" id="email" role="tabpanel" aria-labelledby="email-tab">
                    <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post" class="bg-opacity p-5 rounded-bottom border-bottom border-left border-right">
                        <div class="form-group">
                            <label for="password_email"><i class="fas fa-key"></i> Contraseña Actual:</label>
                            <input type="password" class="form-control" name="password" id="password_email" required>
                        </div>
                        <div class="form-group">
                            <label for="newemail"><i class="fas fa-envelope"></i> Email Nuevo:</label>
                            <input type="email" class="form-control" name="newemail" id="newemail" required>
                        </div>
                        <div class="form-group">
                            <label for="newemail2"><i class="fas fa-envelope"></i> Confirmar Email Nuevo:</label>
                            <input type="email" class="form-control" name="newemail2" id="newemail2" required>
                        </div>
                        <div class="form-row justify-content-center">
                            <button type="submit" name="changeEmail" class="btn btn-primary"><i class="fas fa-sync"></i> Cambiar email</button>
                        </div>
                    </form>
                </div>

                <!-- change profile avatar -->
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post" class="bg-opacity p-5 rounded-bottom border-bottom border-left border-right">

                        <div class="form-row">
                            <?php
                            $i = 0;
                            foreach (glob('assets/img/avatar/*') as $file) {
                                $border = '';
                                $checked = '';
                                if (Session::getUser()->getImage() == basename($file)) {
                                    $border = 'border border-danger';
                                    $checked = 'checked';
                                }
                                ?>
                                <div class="form-group col-md-3 d-flex justify-content-center align-items-center">
                                    <label for="profile<?= $i; ?>">
                                        <div class="<?= $border; ?>" style="width:75px; height:75px; background-image:url('<?= BASE_URL . '/assets/img/avatar/' . basename($file); ?>'); background-size:cover; background-position:center; background-color:#000; border-radius:100%;"></div>
                                    </label>
                                    <input <?= $checked; ?> class="ml-1" type="radio" name="profile" value="<?= basename($file); ?>" id="profile<?= $i; ?>">
                                </div>
                                <?php
                                $i++;
                            }
                            ?>
                        </div>
                        <div class="form-row justify-content-center">
                            <button type="submit" name="changeProfile" class="btn btn-primary"><i class="fas fa-sync"></i> Cambiar imagen</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>

<?php
View::loadFooter();
?>
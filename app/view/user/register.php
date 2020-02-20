

<form method="post" action="<?= $_SERVER['REQUEST_URI']; ?>" class="bg-opacity p-5">
    
    <i class="fas fa-box-open logo"></i>    

    <div class="form-group">
        <div class="input-group">
            <div class="input-group-prepend"><label for="username"><i class="fas fa-user"></i></label></div>
            <input type="text" class="form-control" name="username"  id="username" placeholder="Nombre de usuario" autocomplete="off" required>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-prepend"><label for="email"><i class="fas fa-envelope"></i></label></div>
            <input type="email" class="form-control" name="email"  id="email" placeholder="Correo electrónico" autocomplete="off" required>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-prepend"><label for="password"><i class="fas fa-key"></i></label></div>
            <input type="password" class="form-control" name="password"  id="password" placeholder="Contraseña" autocomplete="off" required>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-prepend"><label for="password2"><i class="fas fa-lock"></i></label></div>
            <input type="password" class="form-control" name="password2"  id="password2" placeholder="Confirmar Contraseña" autocomplete="off" required>
        </div>
    </div>

    <div class="form-row justify-content-between">
        <div class="col-10">
            <button type="submit" class="btn btn-opacity w-100"><i class="fas fa-user-plus"></i> Registrarse</button>
        </div>
        <div class="col-2">
            <a class="w-100 btn btn-opacity text-center" href="<?= BASE_URL . '/login'; ?>"><i class="fas fa-sign-in-alt"></i></a>
        </div>
    </div>


</form>
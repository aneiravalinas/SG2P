<?php

include_once './Model/Usuario_Model.php';
include_once './Validation/Usuario_Validation.php';

class Usuario_Service extends Usuario_Validation {
    var $atributos;
    var $user_entity;
    var $feedback = array();

    function __construct() {
        $this->user_entity = new Usuario_Model();
        $this->atributos = array('dni','username','password','rol','nombre','apellidos','email','telefono');
        $this->fill_fields();
    }

    function fill_fields() {
        foreach ($this->atributos as $atributo) {
            if(isset($_POST[$atributo])) {
                $this->$atributo = $_POST[$atributo];
            } else {
                $this->$atributo = '';
            }
        }

        if(isset($_FILES['foto_perfil']['name'])) {
            $this->foto_perfil = $_FILES['foto_perfil']['name'];
        } else {
            $this->foto_perfil = '';
        }
    }

    function login() {

        $validation = $this->validar_atributos_login();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByUsername();
        if($this->feedback['ok']) {
            $user = $this->feedback['resource'];
            if($this->password === $user['password']) {
                if(!isset($_SESSION)) {
                    session_start();
                }
                $_SESSION['dni'] = $user['dni'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['rol'] = $user['rol'];

                $this->feedback['ok'] = true;
                $this->feedback['code'] = '01001'; // Se ha iniciado sesión correctamente.
            } else {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = '01102'; // Las credenciales introducias no son válidas.
            }
        }

        return $this->feedback;
    }

    function SEARCH() {

        $validation = $this->validar_atributos_search();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->user_entity->SEARCH();

        if($this->feedback['ok']) {
            $this->feedback['code'] = '01002'; // Búsqueda de Usuarios Ok
            return $this->feedback;
        } else if($this->feedback['code'] == '00005') {
            $this->feedback['code'] = '01109'; // Error en la consulta de Usuarios.
        }

        return $this->feedback;

    }

    function ADD() {

        $validacion = $this->validar_atributos_add();
        if(!$validacion['ok']) {
            return $validacion;
        }

        if($this->rol === 'edificio') {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = '01124'; // No se permite la asignación manual del rol Resp. Edificio
            return $this->feedback;
        }

        $this->feedback = $this->uq_attributes_not_exist();

        if($this->feedback['ok']) { // Si ninguno de los atributos únicos existen
            if($this->foto_perfil !== '') { // Si se ha añadido una foto de perfil.
                if ($this->uploadPhoto()) { // Subir foto de perfil
                    $this->user_entity->foto_perfil = $this->foto_perfil; // Se modifica el nombre de la foto de perfil con id generado al subirla.
                    $this->feedback = $this->user_entity->ADD(); // Método ADD del modelo
                    if ($this->feedback['ok']) {
                        $this->feedback['code'] = '01006'; // Usuario añadido con éxito.
                    } else {
                        $this->deletePhoto($this->foto_perfil); // Si no se pudo añadir al usuario se borra la foto de perfil
                        if ($this->feedback['code'] !== '00005') { // No es un error del gestor...
                            $this->feedback['code'] = '01131'; // Error al añadir usuario
                        }
                    }
                } else { // Error al subir la foto de perfil
                    $this->feedback['ok'] = false;
                    $this->feedback['code'] = '01132'; // Error al subir la foto de perfil.
                }
            } else { // No se ha añadido una foto de perfil
                $this->feedback = $this->user_entity->ADD(); // Método ADD del modelo.
                if($this->feedback['ok']) {
                    $this->feedback['code'] = '01006'; // Usuario añadido con éxito.
                } else {
                    if($this->feedback['code'] !== '00005') { // No es un error del gestor...
                        $this->feedback['code'] = '01131'; // Error al añadir usuario
                    }
                }
            }
        }

        return $this->feedback;
    }

    function EDIT() {
        $validation = $this->validar_atributos_edit();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByUsername(); // Buscamos datos originales del usuario.

        if($this->feedback['ok']) {
            $user = $this->feedback['resource'];
            if($this->email != $user['email']) {
                $this->feedback = $this->seekByEmail(); // Si se ha modificado el email y este ya existe.
                if($this->feedback['ok']) {
                    $this->feedback['ok'] = false;
                    return $this->feedback;
                }
            }

            if($this->telefono != $user['telefono']) {
                $this->feedback = $this->seekByTelefono(); // Si se ha modificado el telefono y este ya existe.
                if($this->feedback['ok']) {
                    $this->feedback['ok'] = false;
                    return $this->feedback;
                }
            }

            // Si el rol antiguo o el nuevo rol es de tipo responsable de edificio, y no son iguales (se ha producido un cambio)
            if(($user['rol'] == 'edificio' || $this->rol == 'edificio') && ($user['rol'] != $this->rol)) {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = '01124'; // No se permite la asignación manual del rol Resp. Edificio
                return $this->feedback;
            }

            // Si se cambia el rol desde responsable organización, y no quedan más usuarios de ese tipo...
            if(($user['rol'] == 'organizacion') && ($this->rol != 'organizacion')) {
                $this->feedback = $this->check_more_than_one('organizacion');
                if(!$this->feedback['ok']) {
                    $this->feedback['code'] = '01139'; // No se puede modificar el rol. El usuario es el único responsable de la organización
                    return $this->feedback;
                }
            }

            // Si se cambia el rol desde administrador, y no quedan más usuarios de ese tipo...
            if(($user['rol'] == 'administrador') && ($this->rol != 'administrador')) {
                $this->feedback = $this->check_more_than_one('adminsitrador');
                if(!$this->feedback['ok']) {
                    $this->feedback['code'] = '01140'; // No se puede modificar el rol. El usuario es el único adminsitrador de la aplicación
                    return $this->feedback;
                }
            }


            if($this->foto_perfil != '') { // Si se ha subido una foto de perfil.
                if($this->uploadPhoto()) { // Si la foto se sube correctamente.
                    $this->deletePhoto($user['foto_perfil']); // Borramos la foto anterior.
                    $this->user_entity->foto_perfil = $this->foto_perfil; // Modificamos en la entidad el nombre de la foto por el nuevo nombre generado
                } else {
                    $this->feedback['ok'] = false;
                    $this->feedback['code'] = '01132'; // Error al subir la foto de perfil.
                    return $this->feedback;
                }
            }

            $this->feedback = $this->user_entity->EDIT(); // Llamamos al EDIT de la entidad
            if($this->feedback['ok']) {
                if(($this->username == $_SESSION['username']) && ($this->rol != $_SESSION['rol'])) { // Si el administrador se modifica a sí mismo, y se ha cambiado el rol.
                    $_SESSION['rol'] = $this->rol; // Añadimos nuevo rol a la SESSION.
                }
                $this->feedback['code'] = '01010'; // Usuario editado correctamente.
            } else if($this->feedback['code'] !== '00005') {
                $this->feedback['code'] = '01141'; // Error al editar al usuario
            }
        }

        return $this->feedback;
    }

    function editForm() {
        $validation = $this->validar_USERNAME(); // Validamos formato del nombre de usuario.
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByUsername(); // Buscamos por nombre de usuario
        return $this->feedback;
    }

    function deleteForm() {

        $validation = $this->validar_USERNAME(); // Validamos formato del nombre de usuario.
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByUsername(); // Buscamos por nombre de usuario
        return $this->feedback;
    }

    function DELETE() {
        $validation = $this->validar_USERNAME();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByUsername();
        if($this->feedback['ok']) {
            $user = $this->feedback['resource'];
            if($user['rol'] == 'edificio') {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = '01135'; // No se puede eliminar a un usuario que tenga asignados edificios.
                return $this->feedback;
            }

            if($user['rol'] == 'organizacion') {
                $this->feedback = $this->check_more_than_one('organizacion');
                if(!$this->feedback['ok']) {
                    $this->feedback['code'] = '01136'; // No se puede eliminar al usuario. Siempre debe existir al menos un responsable de la organización
                    return $this->feedback;
                }
            } else if($user['rol'] == 'administrador') {
                $this->feedback = $this->check_more_than_one('administrador');
                if(!$this->feedback['ok']) {
                    $this->feedback['code'] = '01137'; // No se puede eliminar al usuario. Siempre debe existir al menos un administrador
                    return $this->feedback;
                }
            }

            $this->feedback = $this->user_entity->DELETE();
            if($this->feedback['ok']) {
                $this->feedback['code'] = '01007'; // Usuario eliminado con éxito.
                if($this->username == $_SESSION['username']) {
                    session_destroy();
                }
                if($user['foto_perfil'] != '') {
                    $this->deletePhoto($user['foto_perfil']); // Si hay foto de perfil, se elimina.
                }
            } else if($this->feedback['core'] !== '00005') {
                $this->feedback['core'] = '01138'; // Error al eliminar al usuario.
            }

        }

        return $this->feedback;
    }

    function check_more_than_one($rol) {
        $this->feedback = $this->user_entity->searchByRol($rol);
        if(sizeof($this->feedback['resource']) <= 1) {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = '01139'; // Menos de un usuario por rol
        } else {
            $this->feedback['code'] = '01007'; // Más de un usuario por rol
        }
        return $this->feedback;
    }


    function uq_attributes_not_exist() {
        $this->feedback = $this->seekByDNI();
        if($this->feedback['ok'] || $this->feedback['code'] !== '01125') { // Si el dni existe o se ha producido un error en la consulta (resultado false distinto a 01125)
            $this->feedback['ok'] = false;
            return $this->feedback;
        }

        $this->feedback = $this->seekByUsername();
        if($this->feedback['ok'] || $this->feedback['code'] !== '01100') { // Si el username existe o se ha producido un error en la consulta (resultado false distinto a 01100)
            $this->feedback['ok'] = false;
            return $this->feedback;
        }

        $this->feedback = $this->seekByEmail();
        if($this->feedback['ok'] || $this->feedback['code'] !== '01127') { // Si el email existe o se ha producido un error en la consulta (resultado false distinto a 01127)
            $this->feedback['ok'] = false;
            return $this->feedback;
        }

        $this->feedback = $this->seekByTelefono();
        if($this->feedback['ok'] || $this->feedback['code'] !== '01129') { // Si el telefono existe o se ha producido un error en la consulta (resultado false distinto a 01129)
            $this->feedback['ok'] = false;
            return $this->feedback;
        }

        $this->feedback['ok'] = true; // No existe ninguno de los atributos
        return $this->feedback;
    }

    function seekByUsername() {
        $this->feedback = $this->user_entity->seek();

        if($this->feedback['ok']) {
            if($this->feedback['code'] == '00002') {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = '01100'; // El nombre de usuario introducido no existe.
            } else {
                $this->feedback['code'] = '01000'; // El nombre de usuario existe.
            }
        } else if($this->feedback['code'] !== '00005') {
            $this->feedback['code'] = '01101'; // Error al consultar por nombre de usuario
        }

        return $this->feedback;
    }

    function seekByDNI() {
        $this->feedback = $this->user_entity->seekByID('dni',$this->dni);
        if($this->feedback['ok']) {
            if($this->feedback['code'] == '00002') {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = '01125'; // El DNI introducido no existe
            } else {
                $this->feedback['code'] = '01003'; // El DNI introducido ya existe
            }
        } else if($this->feedback['code'] !== '00005') {
            $this->feedback['code'] = '01126'; // Error al consultar por DNI
        }

        return $this->feedback;
    }

    function seekByEmail() {
        $this->feedback = $this->user_entity->seekByID('email',$this->email);
        if($this->feedback['ok']) {
            if($this->feedback['code'] == '00002') {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = '01127'; // El email introducido no existe
            } else {
                $this->feedback['code'] = '01004'; // El email introducido ya existe
            }
        } else if($this->feedback['code'] !== '00005') {
            $this->feedback['code'] = '01128'; // Error al consultar por email
        }

        return $this->feedback;
    }

    function seekByTelefono() {
        $this->feedback = $this->user_entity->seekByID('telefono',$this->telefono);
        if($this->feedback['ok']) {
            if($this->feedback['code'] == '00002') {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = '01129'; // El telefono introducido no existe
            } else {
                $this->feedback['code'] = '01005'; // El telefono ya introducido existe
            }
        } else if($this->feedback['code'] !== '00005') {
            $this->feedback['code'] = '01130'; // Error al consultar por telefono
        }

        return $this->feedback;
    }

    function uploadPhoto() {
        $temp = $_FILES['foto_perfil']['tmp_name'];
        $path = $_FILES['foto_perfil']['name'];
        $ext = pathinfo($path)['extension'];
        $filename = pathinfo($path)['filename']; // Obtenemos el nombre de la imagen.
        $file = $filename . '_' . uniqid() . '.' . $ext; // Nuevo nombre de la imágen: 'NombreAnterior_ID.ext'
        if(move_uploaded_file($temp, profile_photos_path . $file)) { // Se almacena la imágen en servidor
            //chmod(profile_photos_path . $file, 0777);
            $this->foto_perfil = $file; // Se almacena le nuevo nombre de imágen generado.
            return true; // Imágen subida con éxito.
        } else {
            return false; // Error al subir la imágen
        }
    }

    function deletePhoto($photo) {
        return unlink(profile_photos_path . $photo); // Elimina la imágen pasada como parámetro. Devuelve true en caso de éxito.
    }
}

?>

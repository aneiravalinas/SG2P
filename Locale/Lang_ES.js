// Siguiente código de error: 01142
// Siguiente código de éxito: 01011

arrayES = {
    // Generales de la Base de Datos
    '00001' : 'Éxito en la ejecución del SQL',
    '00002' : 'El recordset viene vacío',
    '00003' : 'El recordset viene con datos',
    '00004' : 'Error al conectar con la base de datos. Contacte con su administrador',
    '00005' : 'Error en la ejecución del SQL',

    // Acceso no autorizado
    '00006' : 'No dispone de los privilegios necesarios para realizar esta acción',

    // USUARIO

        // Login
        '01001' : 'Se ha iniciado sesión correctamente',
        '01102' : 'Las credenciales introducias no son válidas',

        // Search
        '01002' : 'Búsqueda de Usuarios Ok',
        '01109' : 'Error en la búsqueda de Usuarios',

        // ADD
        '01124' : 'El rol Resp. Edificio es asignado automáticamente cuando se asigna un usuario a un edificio. No se permite la asignación manual de este rol',
        '01006' : 'Se ha añadido el usuario correctamente',
        '01131' : 'Error al añadir usuario',

        // DELETE
        '01007' : 'Usuario eliminado con éxito',
        '01135' : 'No se puede eliminar a un usuario que tenga asignados edificios',
        '01136' : 'No se puede eliminar al usuario. Siempre debe existir al menos un responsable de la organización',
        '01137' : 'No se puede eliminar al usuario. Siempre debe existir al menos un administrador',
        '01138' : 'Error al eliminar al usuario',

        // EDIT
        '01010' : 'Usuario editado con éxito',
        '01139' : 'No se puede modificar el rol. El usuario es el único responsable de la organización',
        '01140' : 'No se puede modificar el rol. El usuario es el único adminsitrador de la aplicación',
        '01141' : 'Error al editar al usuario',

        // Búsqueda por Username
        '01000' : 'El nombre de usuario ya existe',
        '01100' : 'El nombre de usuario introducido no existe',
        '01101' : 'Error al consultar por nombre de usuario',

        // Búsqueda por DNI
        '01003' : 'El DNI introducido ya existe',
        '01125' : 'El DNI introducido no existe',
        '01126' : 'Error al consultar por DNI',

        // Búsqueda por Email
        '01004' : 'El email introducido ya existe',
        '01127' : 'El email introducido no existe',
        '01128' : 'Error al consultar por email',

        // Búsqueda por Teléfono
        '01005' : 'El telefono introducido ya existe',
        '01129' : 'El telefono introducido no existe',
        '01130' : 'Error al consultar por telefono',

        // Mas de un usuario por rol
        '01008' : 'Hay más de un usuario con el rol indicado',
        '01138' : 'Hay menos de un usuario con el rol indicado',


        // Validaciones

            //Nombre Usuario
            '01103' : 'El nombre de usuario debe superar los 3 caracteres',
            '01104' : 'El nombre de usuario no puede superar los 20 caracteres',
            '01105' : 'El nombre de usuario sólo puede contener caracteres alfanuméricos',

            // Password
            '01106' : 'La seguridad de la contraseña está comprometida. Contraseña cifrada corta',
            '01107' : 'La seguridad de la contraseña está comprometida. Contraseña cifrada larga',
            '01108' : 'La seguridad de la contraseña está comprometida. Contraseña cifrada con caracteres no permitidos',

            // DNI
            '01110' : 'Es necesario especificar un DNI',
            '01111' : 'Formato de DNI incorrecto',

            // ROL
            '01112' : 'Es necesario especificar un Rol',
            '01113' : 'El rol indicado no está contemplado',

            // Nombre
            '01114' : 'El nombre debe superar los 3 caracteres',
            '01115' : 'El nombre no debe superar los 30 caracteres',
            '01116' : 'El nombre sólo puede contener letras y espacios',

            // Apellidos
            '01117' : 'El apellido debe superar los 3 caracteres',
            '01118' : 'El apellido no debe superar los 60 caracteres',
            '01119' : 'El apellido sólo puede contener letras y espacios',

            // Email
            '01120' : 'Es necesario especificar un email',
            '01121' : 'Formato de email incorrecto',

            // Telefono
            '01122' : 'Es necesario especificar un numero de telefono',
            '01123' : 'Formato de numero de telefono incorrecto',

            // Foto_Perfil
            '01132' : 'Error al subir la foto de perfil',
            '01133' : 'La extensión de la imágen no está permitida',
            '01134' : 'El tamaño de la imágen es superior a la permitida (100kb)',


    // INTERFAZ
        // HEADER
        'i18n-idioma' : 'Idioma',
        'i18n-login' : 'Iniciar Sesión',
        'i18n-admin' : 'Panel de Administración',
        'i18n-logout' : 'Desconectar',

        // PORTAL_COUNTRIES
        'i18n-app-welcome' : '¡Bienvenido a SG2P!',
        'i18n-select-building' : 'Selecciona una ciudad donde consultar Edificios',
        'i18n-l-buildings' : 'Buscar Edificios',

        // LOGIN
        'i18n-username' : 'Nombre de Usuario',
        'i18n-password' : 'Contraseña',

        // MESSAGE_VIEW
        'i18n-msg-system' : 'Mensaje del Sistema',
        'i18n-back' : 'Volver',

        // DESHBOARD VIEW
        'i18n-select-option' : 'Selecciona una opción',
        'i18n-users': 'Usuarios',
        'i18n-profile' : 'Mi Perfil',

        // USER VIEWS
        'i18n-dni' : 'DNI',
        'i18n-rol' : 'Rol',
        'i18n-details' : 'Detalles',
        'i18n-edit' : 'Editar',
        'i18n-delete' : 'Eliminar',
        'i18n-f-administrador' : 'Administrador',
        'i18n-f-edificio' : 'Resp. Edificio',
        'i18n-f-organizacion' : 'Resp. Organizacion',
        'i18n-f-registrado' : 'Usuario Registrado',
        'i18n-search-users' : 'Búsqueda de Usuarios',
        'i18n-nombre' : 'Nombre',
        'i18n-apellidos' : 'Apellidos',
        'i18n-telefono' : 'Telefono',
        'i18n-email' : 'Email',
        'i18n-cancelar' : 'Cancelar',
        'i18n-enviar' : 'Enviar',
        'i18n-todos' : 'Todos',
        'i18n-add-users' : 'Añadir Usuario',
        'i18n-selecciona-rol' : 'Selecciona un Rol',
        'i18n-foto_perfil' : 'Foto de Perfil',
        'i18n-del-confirm' : '¿Está seguro que desea eliminar a este usuario? La acción no será reversible',
        'i18n-edit-user' : 'Editar Usuario',

        // MODAL
            // Campos Modal
            'modal-title' : '¡Aviso!',
            'p-modal' : 'El campo ',
            'm-username' : ' Nombre de usuario ',
            'm-password' : ' Contraseña ',
            'm-dni' : ' DNI ',
            'm-nombre' : ' Nombre ',
            'm-telefono' : ' Teléfono ',
            'm-email' : ' Email ',
            'm-rol' : ' Rol ',
            'm-apellidos' : ' Apellidos ',
            'm-foto_perfil' : ' Foto de Perfil ',

            // Mensajes Modal
            'i18n-max-size' : 'excede el tamaño máximo',
            'i18n-only-letters-numbers' : 'sólo puede contener letras y números',
            'i18n-not-empty' : 'no puede ser vacío',
            'i18n-generic-format' : 'tiene un formato incorrecto',
            'i18n-letters-spaces-accents-format' : 'solo admite letras, espacios y acentos',
            'i18n-numbers-format' : 'sólo puede contener números',
            'i18n-wrong-enum' : 'tiene un valor no contemplado',
            'i18n-ext-not-allowed' : 'tiene una extensión no permitida',
}
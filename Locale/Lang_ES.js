

arrayES = {
    // Generales de la Base de Datos
    'QRY_OK' : 'Éxito en la ejecución del SQL', // QRY_OK
    'QRY_EMPT' : 'El recordset viene vacío', // QRY_EMPT
    'QRY_DATA' : 'El recordset viene con datos', // QRY_DATA
    'DB_ERR' : 'Error al conectar con la base de datos. Contacte con su administrador', // QRY_ERR
    'QRY_KO' : 'Error en la ejecución del SQL', // QRY_KO

    // Acceso no autorizado
    'FRB_ACCS' : 'No dispone de los privilegios necesarios para realizar esta acción', // FRB_ACCS

    // USUARIO

        // Login
        'LOG_OK' : 'Se ha iniciado sesión correctamente', // LOG_OK
        'LOG_KO' : 'Las credenciales introducias no son válidas', // LOG_KO

        // Search
        'USR_SRCH_OK' : 'Búsqueda de Usuarios Ok', // USR_SRCH_OK
        'USR_SRCH_KO' : 'Error en la búsqueda de Usuarios', // USR_SRCH_KO

        // ADD
        'BM_ADD' : 'El rol Resp. Edificio es asignado automáticamente cuando se asigna un usuario a un edificio. No se permite la asignación manual de este rol', // BM_ADD
        'USR_ADD_OK' : 'Se ha añadido el usuario correctamente', // USR_ADD_OK
        'USR_ADD_KO' : 'Error al añadir usuario', // USR_ADD_KO

        // DELETE
        'USR_DEL_OK' : 'Usuario eliminado con éxito', // USR_DEL_OK
        'BM_DEL' : 'No se puede eliminar a un usuario que tenga asignados edificios', // BM_DEL
        'OM_UNQ_DEL' : 'No se puede eliminar al usuario. Siempre debe existir al menos un responsable de la organización', // OM_UNQ_DEL
        'ADM_UNQ_DEL' : 'No se puede eliminar al usuario. Siempre debe existir al menos un administrador', // ADM_UNQ_DEL
        'USR_DEL_KO' : 'Error al eliminar al usuario', // USR_DEL_KO

        // EDIT
        'USR_EDT_OK' : 'Usuario editado con éxito', // USR_EDT_OK
        'OM_UNQ_EDT' : 'No se puede modificar el rol. El usuario es el único responsable de la organización', // OM_UNQ_EDT
        'ADM_UNQ_EDT' : 'No se puede modificar el rol. El usuario es el único adminsitrador de la aplicación', // ADM_UNQ_EDT
        'USR_EDT_KO' : 'Error al editar al usuario', // USR_EDT_KO

        // EDIT_PROFILE
        'PRF_USR_KO' : 'No puede editar el perfil de otro usuario',
        'PRF_OK' : 'Los datos del perfil se han almacenado correctamente',
        'PRF_KO' : 'Error al modificar los datos del perfil',

        // Búsqueda por Username
        'USRNM_EXST' : 'El nombre de usuario ya existe', // USRNM_EXST
        'USRNM_NOT_EXST' : 'El nombre de usuario introducido no existe', // USRNM_NOT_EXST
        'USRNM_KO' : 'Error al consultar por nombre de usuario', // USRNM_KO

        // Búsqueda por DNI
        'DNI_EXST' : 'El DNI introducido ya existe', // DNI_EXST
        'DNI_NOT_EXST' : 'El DNI introducido no existe', // DNI_NOT_EXST
        'DNI_KO' : 'Error al consultar por DNI', // DNI_KO

        // Búsqueda por Email
        'EML_EXST' : 'El email introducido ya existe', // EML_EXST
        'EML_NOT_EXST' : 'El email introducido no existe', // EML_NOT_EXST
        'EML_KO' : 'Error al consultar por email', // EML_KO

        // Búsqueda por Teléfono
        'TLF_EXST' : 'El telefono introducido ya existe', // TLF_EXST
        'TLF_NOT_EXST' : 'El telefono introducido no existe', // TLF_NOT_EXST
        'TLF_KO' : 'Error al consultar por telefono', // TLF_KO

        // Mas de un usuario por rol
        'ROL_MTO' : 'Hay más de un usuario con el rol indicado', // ROL_MTO
        'ROL_LTO' : 'Hay menos de un usuario con el rol indicado', // ROL_LTO
        'ROL_KO' : 'Error al consultar por rol',


        // Validaciones

            //Nombre Usuario
            'USRNM_SHRT' : 'El nombre de usuario debe superar los 3 caracteres', // USRNM_SHRT
            'USRNM_LRG' : 'El nombre de usuario no puede superar los 20 caracteres', // USRNM_LRG
            'USRNM_ALF' : 'El nombre de usuario sólo puede contener caracteres alfanuméricos', // USRNM_ALF

            // Password
            'PSW_SHRT' : 'La seguridad de la contraseña está comprometida. Contraseña cifrada corta', // PSW_SHRT
            'PSW_LRG' : 'La seguridad de la contraseña está comprometida. Contraseña cifrada larga', // PSW_LRG
            'PSW_FRMT' : 'La seguridad de la contraseña está comprometida. Contraseña cifrada con caracteres no permitidos', // PSW_FRMT

            // DNI
            'DNI_EMPT' : 'Es necesario especificar un DNI', // DNI_EMPT
            'DNI_FRMT' : 'Formato de DNI incorrecto', // DNI_FRMT

            // ROL
            'ROL_EMPT' : 'Es necesario especificar un Rol', // ROL_EMPT
            'ROL_FRMT' : 'El rol indicado no está contemplado', // ROL_FRMT

            // Nombre
            'NAM_SHRT' : 'El nombre debe superar los 3 caracteres', // NAM_SHRT
            'NAM_LRG' : 'El nombre no debe superar los 30 caracteres', // NAM_LRG
            'NAM_LT_SPC' : 'El nombre sólo puede contener letras y espacios', // NAM_LT_SPC

            // Apellidos
            'SRNM_SHRT' : 'El apellido debe superar los 3 caracteres', //  SRNM_SHRT
            'SRNM_LRG' : 'El apellido no debe superar los 60 caracteres', // SRNM_LRG
            'SRNM_LT_SPC' : 'El apellido sólo puede contener letras y espacios', // SRNM_LT_SPC

            // Email
            'EML_EMPT' : 'Es necesario especificar un email', // EML_EMPT
            'EML_FRMT' : 'Formato de email incorrecto', // EML_FRMT

            // Telefono
            'TLF_EMPT' : 'Es necesario especificar un numero de telefono', // TLF_EMPT
            'TLF_FRMT' : 'Formato de numero de telefono incorrecto', // TLF_FRMT

            // Foto_Perfil
            'PRPH_KO' : 'Error al subir la foto de perfil', // PRPH_KO
            'PRPH_EXT' : 'La extensión de la imágen no está permitida', // PRPH_EXT
            'PRPH_LRG' : 'El tamaño de la imágen es superior a la permitida (100kb)', // PRPH_LRG
            'PRPH_FRMT' : 'El nombre de la foto de perfil sólo puede contener letras, números e guions',


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
        'i18n-buildings' : 'Edificios',

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
        'i18n-user-details' : 'Detalles del Usuario',

        // BUILDINGS VIEWS
        'i18n-responsable' : 'Responsable',
        'i18n-city' : 'Ciudad',
        'i18n-buildings-empty' : 'No hay edificios registrado todavía',

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


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
        'BM_ADD' : 'No se puede asignar el rol de responsable de edificio si el usuario no tiene edificios asignados', // BM_ADD
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
        'BM_WITH_BLD' : 'No se puede desasignar el rol de responsable de edificio si el usuario tiene edificios asignados',

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

    // EDIFICIOS

        // SEARCH
        'BLD_SRCH_OK' : 'Búsqueda de Edificios Ok',
        'BLD_SRCH_KO' : 'Búsqueda de Edificios KO',

        // ADD
        'BLD_ADD_KO' : 'Error al añadir el edificio',
        'BLD_ADD_OK' : 'El edificio se ha añadido correctamente',
        'BLD_ADD_OK_ROL_KO' : 'Error al modificar el rol de usuario registrado a responsable de edificio. La acción debe realizarse manualmente',

        // DELETE
        'BLD_DEL_OK' : 'El edificio se ha eliminado correctamente',
        'BLD_DEL_OK_ROL_KO' : 'Error al modificar el rol del responsable de edificio a usuario registrado. La acción debe realizarse manualmente',
        'BLD_DEL_KO' : 'Error al eliminar el edificio',

        // EDIT
        'BLD_EDIT_OK_ROL_KO' : 'El edificio se ha modificado correctamente, pero se ha producido un error en la asignación de roles. Porfavor, revisar los roles manualmente',
        'BLD_EDIT_KO' : 'Se ha producido un error al modificar el edificio',
        'BLD_EDIT_OK' : 'El edificio se ha modificado correctamente',

        // SHOWCURRENT
        'BLD_CURRNT_MANG_KO' : 'No dispone de los permisos necesarios para consultar los detalles de ese edificio',
        'BLD_CURRENT_OK' : 'La consulta de los detalles del edificio se ha ejecutado correctamente',
        'BLD_CURRNT_KO' : 'Error al consultar los detalles del edificio',

        // Búsqueda de ciudades
        'CTY_NOT_FOUND' : 'Actualmente no hay ningún edificio registrado en el sistema. Registra algún edificio para acceder a su portal',
        'SRCH_CTY_KO' : 'Se ha producido un error al obtener las ciudades registradas en el sistema. Contacte con su administrador',
        'SRCH_CTY_OK' : 'Búsqueda de ciudades Ok',

        // Búsqueda por ciudad
        'CTY_NOT_EXST' : 'La ciudad introducida no existe',
        'SRCH_BY_CTS_OK' : 'Búsqueda por ciudad Ok',
        'SRCH_BY_CTS_KO' : 'Error al buscar por ciudad',

        // Obtener candidatos a responsable de edificio
        'MANG_EMPT' : 'No hay candidatos disponbiles para ser responsable de edificio',
        'GT_MANG_KO' : 'Error al obtener candidatos a responsable de edificio',
        'MANG_INV' : 'El usuario especificado no es válido para ser responsable de edificio',


        // Fotos Edificio
        'BLD_PH_KO' : 'Error al subir la foto del edificio',

        // Búsqueda por Edificio_ID
        'BLDID_NOT_EXST' : 'El ID del Edificio no existe',
        'BLDID_KO' : 'Error al consultar por ID de Edificio',

        // Búsqueda por Responsable
        'MANG_NOT_EXST' : 'El Responsable introducido no existe',
        'MANG_EXST' : 'El Responsable existe',
        'MANG_KO' : 'Error al consultar al responsable',


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
            'TLF_MAX_SIZE' : 'El número de teléfono supera el tamaño máximo',
            'TLF_WITH_LETTERS' : 'El número de teléfono sólo puede contener números',

            // Foto_Perfil
            'PRPH_KO' : 'Error al subir la foto de perfil', // PRPH_KO
            'PRPH_EXT' : 'La extensión de la imágen no está permitida', // PRPH_EXT
            'PRPH_LRG' : 'El tamaño de la imágen es superior a la permitida (100kb)', // PRPH_LRG
            'PRPH_FRMT' : 'El nombre de la foto de perfil sólo puede contener letras, números y guiones',

            // Edificio_ID
            'BLD_ID_EMPT' : 'El ID del edificio no puede ser vacío',
            'BLD_ID_NOT_NUMERIC' : 'El ID del edificio debe ser numérico',


            // Responsable (Usuario)
            'MANG_SHRT' : 'El nombre del responsable debe superar los 3 caracteres',
            'MANG_LRG' : 'El nombre del responsable no puede superar los 20 caracteres',
            'MANG_ALF' : 'El nombre del responsable sólo puede contener caracteres alfanuméricos',

            // Building Name
            'BLD_NAM_SHRT' : 'El nombre del edificio debe superar los 3 caracteres',
            'BLD_NAM_LRG' : 'El nombre del edificio no debe superar los 60 caracteres',
            'BLD_NAM_FRMT' : 'El nombre del edifico sólo puede contener caracteres alfanuméricos, espacios y números',

            // Calle
            'CALLE_SHRT' : 'La calle debe superar los 8 caracteres',
            'CALLE_LRG' : 'La calle no debe superar los 60 caracteres',
            'CALLE_FRMT' : 'La calle sólo puede contener caracteres alfanuméricos, espacios y números',

            // Ciudad
            'CIUDAD_SHRT' : 'La ciudad debe superar los 3 caracteres',
            'CIUDAD_LRG' : 'La ciudad no debe superar los 40 caracteres',
            'CIUDAD_FRMT' : 'La ciudad sólo puede contener letras y espacios',

            // Provincia
            'PROV_SHRT' : 'La provincia debe superar los 3 caracteres',
            'PROV_LRG' : 'La provincia no debe superar los 40 caracteres',
            'PROV_FRMT' : 'La provincia sólo puede contener letras y espacios',

            // Código Postal
            'CP_EMPT' : 'Es necesario especificar un código postal',
            'CP_NUMERIC' : 'El código postal debe ser numérico',
            'CP_SIZE' : 'El código postal debe ser un número de 5 dígitos',
            'CP_MAX_SIZE' : 'El código postal no debe superar los 5 dígitos',

            // Foto Edificio
            'BLD_PH_EXT' : 'La extensión de la foto del edificio no está permitida',
            'BLD_PH_FRMT' : 'El nombre de la foto del edificio sólo puede contener letras, números y guiones',



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
        'i18n-del-user-confirm' : '¿Está seguro que desea eliminar a este usuario? La acción no será reversible',
        'i18n-edit-user' : 'Editar Usuario',
        'i18n-user-details' : 'Detalles del Usuario',

        // BUILDINGS VIEWS
        'i18n-edificio_id' : 'Edificio ID',
        'i18n-responsable' : 'Responsable',
        'i18n-ciudad' : 'Ciudad',
        'i18n-buildings-empty' : 'No hay edificios registrado todavía',
        'i18n-add-building' : 'Añadir Edificio',
        'i18n-calle' : 'Calle',
        'i18n-provincia' : 'Provincia',
        'i18n-codigo_postal' : 'Código Postal',
        'i18n-fax' : 'Fax',
        'i18n-del-building-confirm' : '¿Está seguro que desea eliminar este edificio, así como los elementos asociados? La acción no será reversible',
        'i18n-edit-building' : 'Editar Edificio',
        'i18n-search-building' : 'Buscar Edificio',

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
            'm-calle' : ' Calle ',
            'm-ciudad' : ' Ciudad ',
            'm-provincia' : ' Provincia ',
            'm-codigo_postal' : ' Código Postal ',
            'm-fax' : ' Fax ',
            'm-responsable' : ' Responsable ',
            'm-foto_edificio' : ' Foto Edificio ',
            'm-edificio_id' : ' ID Edificio ',

            // Mensajes Modal
            'i18n-max-size' : 'excede el tamaño máximo',
            'i18n-only-letters-numbers' : 'sólo puede contener letras y números',
            'i18n-not-empty' : 'no puede ser vacío',
            'i18n-generic-format' : 'tiene un formato incorrecto',
            'i18n-letters-spaces-accents-format' : 'solo admite letras, espacios y acentos',
            'i18n-numbers-format' : 'sólo puede contener números',
            'i18n-wrong-enum' : 'tiene un valor no contemplado',
            'i18n-ext-not-allowed' : 'tiene una extensión no permitida',
            'i18n-cp-format' : 'debe ser un número de 5 dígitos',
            'i18n-letters-numbers-accents-spaces' : 'sólo puede contener letras, números acentos y espacios',
}
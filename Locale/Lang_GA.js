arrayGA = {
    // Xerais da Base de Datos
    'QRY_OK' : 'Éxito na execución do SQL',
    'QRY_EMPT' : 'O recordset vén vacío',
    'QRY_DATA' : 'O recordset vén con datos',
    'DB_ERR' : 'Error ao conectar coa base de datos. Contacte co seu administrador',
    'QRY_KO' : 'Error na execución do SQL',

    // Acceso no autorizado
    'FRB_ACCS' : 'Non dispón dos privilexios necesarios pra realizar esta acción',

    // USUARIO

        // Login
        'LOG_OK' : 'Iniciouse sesión no sistema correctamente',
        'LOG_KO' : 'As credenciais introducidas non son válidas',

        // Search
        'USR_SRCH_OK' : 'Búsqueda de Usuarios Ok',
        'USR_SRCH_KO' : 'Error na búsqueda de Usuarios',

        // ADD
        'BM_ADD' : 'O rol Resp. Edificio é asignado automáticamente cando se asigna un usuario a un edificio. Non se permite a asignación manual de este rol',
        'USR_ADD_OK' : 'O usuario engadiuse correctamente',
        'USR_ADD_KO' : 'Error ó engadir o usuario',

        // DELETE
        'USR_DEL_OK' : 'Usuario eliminado con éxito',
        'BM_DEL' : 'Non se pode eliminar a un usuario que teña asignados edificios',
        'OM_UNQ_DEL' : 'Non se pode eliminar ó usuario. Sempre debe existir polo menos un responsable da organización',
        'ADM_UNQ_DEL' : 'Non se pode eliminar ó usuario. Sempre debe existir polo menos un administrador',
        'USR_DEL_KO' : 'Error o eliminar ó usuario',

        // EDIT
        'USR_EDT_OK' : 'Usuario editado con éxito',
        'OM_UNQ_EDT' : 'Non se pode modificar o rol. O usuario é o único responsable da organización',
        'ADM_UNQ_EDT' : 'Non se pode modificar o rol. O usuario é o único adminsitrador da aplicación',
        'USR_EDT_KO' : 'Error al editar al usuario',

        // EDIT_PROFILE
        'PRF_USR_KO' : 'Non se pode editar o perfil doutro usuario',
        'PRF_OK' : 'Os datos do perfil almacenáronse correctamente',
        'PRF_KO' : 'Error ó modificar os datos do perfil',

        // Búsqueda por Username
        'USRNM_EXST' : 'O nome de usuario xa existe',
        'USRNM_NOT_EXST' : 'O nome de usuario introducido non existe',
        'USRNM_KO' : 'Produciuse un erro o consultar por nome de usuario',

        // Búsqueda por DNI
        'DNI_EXST' : 'O DNI introducido xa existe',
        'DNI_NOT_EXST' : 'O DNI introducido non existe',
        'DNI_KO' : 'Error ó consultar por DNI',

        // Búsqueda por Email
        'EML_EXST' : 'O email introducido xa existe',
        'EML_NOT_EXST' : 'O email introducido non existe',
        'EML_KO' : 'Error ó consultar por email',

        // Búsqueda por Teléfono
        'TLF_EXST' : 'O telefono introducido xa existe',
        'TLF_NOT_EXST' : 'O telefono introducido non existe',
        'TLF_KO' : 'Error ó consultar por telefono',

        // Mas de un usuario por rol
        'ROL_MTO' : 'Hay máis dun usuario co rol indicado',
        'ROL_LTO' : 'Hay menos dun usuario co rol indicado',
        'ROL_KO' : 'Error ó consultar por rol',

    // EDIFICIOS

        // SEARCH
        'BLD_SRCH_OK' : 'Búsqueda de Edificios Ok',
        'BLD_SRCH_KO' : 'Búsqueda de Edificios KO',

        // Obtener candidatos a responsable de edificio
        'BLD_RESP_EMPT' : 'Non hay candidatos dispoñibles pra ser responsable de edificio',
        'GT_MANG_KO' : 'Error ó obter candidatos a responsable de edificio',

        // Validaciones

            // Nombre de Usuario
            'USRNM_SHRT' : 'O nome de usuario debe superar os 3 caracteres',
            'USRNM_LRG' : 'O nomre de usuario non pode superar os 20 caracteres',
            'USRNM_ALF' : 'O nome de usuario só pode conter caracteres alfanuméricos',

            // Password
            'PSW_SHRT' : 'Seguridade do contrasinal comprometida. Contrasinal encriptada curta',
            'PSW_LRG' : 'Seguridade do contrasinal comprometida. Contrasinal encriptada longa',
            'PSW_FRMT' : 'Seguridade do contrasinal comprometida. Contrasinal encriptada caracteres non permitidos',

            // DNI
            'DNI_EMPT' : 'É necesario especificar un DNI',
            'DNI_FRMT' : 'Formato de DNI incorrecto',

            // ROL
            'ROL_EMPT' : 'É necesario especificar un Rol',
            'ROL_FRMT' : 'O rol indicado non está contemplado',

            // Nombre
            'NAM_SHRT' : 'O nome debe superar los 3 caracteres',
            'NAM_LRG' : 'O nome non debe superar os 30 caracteres',
            'NAM_LT_SPC' : 'O nome só pode conter letras e espacios',

            // Apellidos
            'SRNM_SHRT' : 'O apelido debe superar os 3 caracteres',
            'SRNM_LRG' : 'O apelido nno debe superar os 60 caracteres',
            'SRNM_LT_SPC' : 'O apelido só pode conter letras e espacios',

            // Email
            'EML_EMPT' : 'É necesario especificar un email',
            'EML_FRMT' : 'Formato de email incorrecto',

            // Telefono
            'TLF_EMPT' : 'É necesario especificar un numero de telefono',
            'TLF_FRMT' : 'Formato de numero de telefono incorrecto',

            // Foto_Perfil
            'PRPH_KO' : 'Error ó subir a foto de perfil',
            'PRPH_EXT' : 'A extensión da imáxen non está permitida',
            'PRPH_LRG' : 'O tamaño da imáxen é superior a permitida (100kb)',
            'PRPH_FRMT' : 'O nome da foto de perfil só pode conter letras, números y guiones',




    // INTERFACE
        // HEADER
        'i18n-idioma' : 'Idioma',
        'i18n-login' : 'Iniciar Sesión',
        'i18n-admin' : 'Panel de Administración',
        'i18n-logout' : 'Desconectar',

        // PORTAL_COUNTRIES
        'i18n-app-welcome' : '¡Benvido a SG2P!',
        'i18n-select-building' : 'Selecciona unha cidade onde consultar Edificios',
        'i18n-l-buildings' : 'Buscar Edificios',

        // LOGIN
        'i18n-username' : 'Nome de Usuario',
        'i18n-password' : 'Contrasinal',

        // MESSAGE_VIEW
        'i18n-msg-system' : 'Mensaxe do Sistema',
        'i18n-back' : 'Volver',

        // DESHBOARD VIEW
        'i18n-select-option' : 'Selecciona unha opción',
        'i18n-users': 'Usuarios',
        'i18n-profile' : 'Meu Perfil',
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
        'i18n-nombre' : 'Nome',
        'i18n-apellidos' : 'Apelidos',
        'i18n-telefono' : 'Telefono',
        'i18n-email' : 'Email',
        'i18n-cancelar' : 'Cancelar',
        'i18n-enviar' : 'Enviar',
        'i18n-todos' : 'Todos',
        'i18n-add-users' : 'Engadir Usuario',
        'i18n-selecciona-rol' : 'Selecciona un Rol',
        'i18n-foto_perfil' : 'Foto de Perfil',
        'i18n-del-confirm' : '¿Está seguro de que quere eliminar a este usuario? A acción non será reversible',
        'i18n-edit-user' : 'Editar Usuario',
        'i18n-user-details' : 'Detalles do Usuario',

        // BUILDINGS VIEWS
        'i18n-responsable' : 'Responsable',
        'i18n-ciudad' : 'Cidade',
        'i18n-buildings-empty' : 'Aínda non hay edificios rexitrados',
        'i18n-add-building' : 'Engadir Edificio',
        'i18n-ciudad' : 'Cidade',
        'i18n-calle' : 'Calle',
        'i18n-provincia' : 'Provincia',
        'i18n-codigo_postal' : 'Código Postal',
        'i18n-fax' : 'Fax',


        // MODAL
            // Campos Modal
            'modal-title' : '¡Aviso!',
            'p-modal' : 'O campo ',
            'm-username' : ' Nome de Usuario ',
            'm-password' : ' Contrasinal ',
            'm-dni' : ' DNI ',
            'm-nombre' : ' Nome ',
            'm-telefono' : ' Teléfono ',
            'm-email' : ' Email ',
            'm-rol' : ' Rol ',
            'm-apellidos' : ' Apelidos ',
            'm-foto_perfil' : ' Foto de Perfil ',
            'm-calle' : ' Calle ',
            'm-ciudad' : ' Cidade ',
            'm-provincia' : ' Provincia ',
            'm-codigo_postal' : ' Código Postal ',
            'm-fax' : ' Fax ',
            'm-responsable' : ' Responsable ',
            'm-foto_edificio' : ' Foto Edificio ',

            // Mensajes Modal
            'i18n-max-size' : 'excede o tamaño máximo',
            'i18n-only-letters-numbers' : 'só pode conter letras e números',
            'i18n-not-empty' : 'non pode ser vacío',
            'i18n-generic-format' : 'ten un formato incorrecto',
            'i18n-letters-spaces-accents-format' : 'só admite letras, espacios e acentos',
            'i18n-numbers-format' : 'só pode conter números',
            'i18n-wrong-enum' : 'ten un valor non contemplado',
            'i18n-ext-not-allowed' : 'ten unha extensión non permitida',


}
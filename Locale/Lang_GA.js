arrayGA = {
    // Xerais da Base de Datos
    '00001' : 'Éxito na execución do SQL',
    '00002' : 'O recordset vén vacío',
    '00003' : 'O recordset vén con datos',
    '00004' : 'Error ao conectar coa base de datos. Contacte co seu administrador',
    '00005' : 'Error na execución do SQL',

    // Acceso no autorizado
    '00006' : 'Non dispón dos privilexios necesarios pra realizar esta acción',

    // USUARIO

        // Login
        '01001' : 'Iniciouse sesión no sistema correctamente',
        '01102' : 'As credenciais introducidas non son válidas',

        // Search
        '01002' : 'Búsqueda de Usuarios Ok',
        '01109' : 'Error na búsqueda de Usuarios',

        // ADD
        '01124' : 'O rol Resp. Edificio é asignado automáticamente cando se asigna un usuario a un edificio. Non se permite a asignación manual de este rol',
        '01006' : 'O usuario engadiuse correctamente',
        '01131' : 'Error ó engadir o usuario',

        // DELETE
        '01007' : 'Usuario eliminado con éxito',
        '01135' : 'Non se pode eliminar a un usuario que teña asignados edificios',
        '01136' : 'Non se pode eliminar ó usuario. Sempre debe existir polo menos un responsable da organización',
        '01137' : 'Non se pode eliminar ó usuario. Sempre debe existir polo menos un administrador',
        '01138' : 'Error o eliminar ó usuario',

        // EDIT
        '01010' : 'Usuario editado con éxito',
        '01139' : 'Non se pode modificar o rol. O usuario é o único responsable da organización',
        '01140' : 'Non se pode modificar o rol. O usuario é o único adminsitrador da aplicación',
        '01141' : 'Error al editar al usuario',

        // Búsqueda por Username
        '01000' : 'O nome de usuario xa existe',
        '01100' : 'O nome de usuario introducido non existe',
        '01101' : 'Produciuse un erro o consultar por nome de usuario',

        // Búsqueda por DNI
        '01003' : 'O DNI introducido xa existe',
        '01125' : 'O DNI introducido non existe',
        '01126' : 'Error ó consultar por DNI',

        // Búsqueda por Email
        '01004' : 'O email introducido xa existe',
        '01127' : 'O email introducido non existe',
        '01128' : 'Error ó consultar por email',

        // Búsqueda por Teléfono
        '01005' : 'O telefono introducido xa existe',
        '01129' : 'O telefono introducido non existe',
        '01130' : 'Error ó consultar por telefono',

        // Mas de un usuario por rol
        '01008' : 'Hay máis dun usuario co rol indicado',
        '01138' : 'Hay menos dun usuario co rol indicado',

        // Validaciones

            // Nombre de Usuario
            '01103' : 'O nome de usuario debe superar os 3 caracteres',
            '01104' : 'O nomre de usuario non pode superar os 20 caracteres',
            '01105' : 'O nome de usuario só pode conter caracteres alfanuméricos',

            // Password
            '01106' : 'Seguridade do contrasinal comprometida. Contrasinal encriptada curta',
            '01107' : 'Seguridade do contrasinal comprometida. Contrasinal encriptada longa',
            '01108' : 'Seguridade do contrasinal comprometida. Contrasinal encriptada caracteres non permitidos',

            // DNI
            '01110' : 'É necesario especificar un DNI',
            '01111' : 'Formato de DNI incorrecto',

            // ROL
            '01112' : 'É necesario especificar un Rol',
            '01113' : 'O rol indicado non está contemplado',

            // Nombre
            '01114' : 'O nome debe superar los 3 caracteres',
            '01115' : 'O nome non debe superar os 30 caracteres',
            '01116' : 'O nome só pode conter letras e espacios',

            // Apellidos
            '01117' : 'O apelido debe superar os 3 caracteres',
            '01118' : 'O apelido nno debe superar os 60 caracteres',
            '01119' : 'O apelido só pode conter letras e espacios',

            // Email
            '01120' : 'É necesario especificar un email',
            '01121' : 'Formato de email incorrecto',

            // Telefono
            '01122' : 'É necesario especificar un numero de telefono',
            '01123' : 'Formato de numero de telefono incorrecto',

            // Foto_Perfil
            '01132' : 'Error ó subir a foto de perfil',
            '01133' : 'A extensión da imáxen non está permitida',
            '01134' : 'O tamaño da imáxen é superior a permitida (100kb)',





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
        'i18n-edit-user' : 'Edit User',

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
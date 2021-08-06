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
        'BM_ADD' : 'Non se pode asignar o rol de responsable de edificio se o usuario non ten edificios asignados',
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
        'BM_WITH_BLD' : 'Non se pode desasignar o rol de responsable de edificio mentras o usuario teña edificios asignados',

        // EDIT_PROFILE
        'PRF_USR_KO' : 'Non se pode editar o perfil doutro usuario',
        'PRF_OK' : 'Os datos do perfil almacenáronse correctamente',
        'PRF_KO' : 'Error ó modificar os datos do perfil',

        // SEEK
        'USR_SEEK_OK' : 'A búsqueda dos detalles do usuario realizouse correctamente',
        'USR_SEEK_KO' : 'Error ó consultar os detalles do usuario',

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

        // ADD
        'BLD_ADD_KO' : 'Error ó engadir o edificio',
        'BLD_ADD_OK' : 'O edificio engadiurse correctamente',
        'BLD_ADD_OK_ROL_KO' : 'Error ó modificar o rol de usuario rexistrado a responsable de edificio. A acción debe realizarse manualmente',

        // DELETE
        'BLD_DEL_OK' : 'O edificio eliminouse correctamente',
        'BLD_DEL_OK_ROL_KO' : 'Produciuse un erro o modificar o rol do responsable do edificio a usuario rexistrado. A acción deberá realizarse manualmente',
        'BLD_DEL_KO' : 'Error ó eliminar o edificio',

        // EDIT
        'BLD_EDIT_OK_ROL_KO' : 'O edificio modificouse correctamente, pero produciuse un error na asignación de roles. Porfavor, revisar os roles manualmente',
        'BLD_EDIT_KO' : 'Produciuse un error ó modificar o edificio',
        'BLD_EDIT_OK' : 'O edificio modificouse correctamente',

        // SHOWCURRENT
        'BLD_CURRNT_MANG_KO' : 'Non dispon dos privilexios necesarios pra consultar os detalles dese edificio',
        'BLD_CURRENT_OK' : 'A consulta dos detalles do edificio realizouse correctamente',
        'BLD_CURRNT_KO' : 'Error ó consultar os detalles do edificio',

        // Búsqueda de ciudades
        'CTY_NOT_FOUND' : 'Actualmente non hay ningún edificio rexistrado no sistema. Rexistra algún edificio pra acceder ó seu portal',
        'SRCH_CTY_KO' : 'Produciuse un erro ó obter as cidades rexistradas no sistema. Contacte co seu administrador',
        'SRCH_CTY_OK' : 'Búsqueda de cidades Ok',

        // Búsqueda por ciudad
        'CTY_NOT_EXST' : 'A cidade introducida non existe',
        'SRCH_BY_CTS_OK' : 'Búsqueda por cidade Ok',
        'SRCH_BY_CTS_KO' : 'Error ó buscar por cidade',

        // Obtener candidatos a responsable de edificio
        'MANG_EMPT' : 'Non hay candidatos dispoñibles pra ser responsable de edificio',
        'GT_MANG_KO' : 'Error ó obter candidatos a responsable de edificio',
        'MANG_INV' : 'O usuario indicado non é válido pra ser responsable de edificio',

        // Fotos Edificio
        'BLD_PH_KO' : 'Error ó subir a foto do edificio',

        // Búsqueda por Edificio_ID
        'BLDID_NOT_EXST' : 'O ID do Edificio non existe',
        'BLDID_KO' : 'Erro ó consultar por ID de Edificio',
        'BLDID_EXST' : 'O ID de edificio existe',

        // Búsqueda por Responsable
        'MANG_NOT_EXST' : 'O Responsable introducido non existe',
        'MANG_EXST' : 'O Responsable existe',
        'MANG_KO' : 'Error ó consultar por responsable',

        // Búsqueda de Plantas del Edificio
        'BLD_FLR_EXST' : 'Non se pode eliminar o edificio mentras teña plantas asociadas',
        'BLD_SRCH_FLR_KO' : 'Error ó consultar as plantas do edificio',

        // Búsqueda de Planes asignados al Edificio
        'BLD_PLN_EXST' : 'Non se pode eliminar o edificio mentras teña plans asignados',
        'BLD_SRCH_PLN_KO': 'Error ó consultar os plan asignados o edificio',

    // PLANTAS

        // SEARCH
        'FLR_SRCH_NT_ALLOWED' : 'Non dispón dos permisos necesarios pra buscar plantas neste edificio',
        'FLR_SRCH_OK' : 'Búsqueda de plantas Ok',
        'FLR_SRCH_KO' : 'Error ó consultar as plantas',

        // ADD
        'FLR_ADD_OK' : 'Engadiuse a planta correctamente',
        'FLR_ADD_KO' : 'Error ó añadir a planta',

        // DELETE
        'FLR_DEL_OK' : 'A planta eliminouse con éxito',
        'FLR_DEL_KO' : 'Error ó eliminar a planta',

        // SEEK
        'FLR_SEEK_NOT_ALLOWED' : 'Non dispón dos permisos necesarios pra consultar os detalles desta planta',
        'FLR_SEEK_OK' : 'A consulta dos detalles da planta realizouse correctamente',
        'FLR_SEEK_KO' : 'Error ó consultar os detalles da planta',

        // EDIT
        'FLR_EDT_OK' : 'Os datos da planta modificáronse correctamente',
        'FLR_EDT_KO' : 'Error ó modificar os datos da planta',

        // Detalles de la planta del Portal
        'PRTL_FLR_SEEK_OK' : 'A consulta dos detalles da planta realizouse correctamente',
        'PRTL_FLR_SEEK_KO' : 'Produciuse un error ó consultar os detalles da planta',

        // Búsqueda de Plantas del Portal
        'PRTL_FLR_SRCH_OK' : 'A búsqueda de plantas do portal realizouse correctamente',
        'PRTL_FLR_SRCH_KO' : 'Error ó buscar as plantas do portal',

        // Existe numero de planta en un edificio
        'FLR_NUM_EXST' : 'Xa existe unha planta con ese número neste edificio',
        'NUM_PLNT_EXST_KO' : 'Error ó consultar por número de planta',

        // Subir foto planta
        'FLR_PH_KO' : 'Error ó subir a foto da planta',

        // Consulta por Planta
        'FLRID_NOT_EXST' : 'A Planta non existe',
        'FLRID_EXST' : 'A Planta existe',
        'FLRID_KO' : 'Error ó consultar por ID de Planta',

        // Consulta de Espacios asociados a Planta
        'FLR_SPC_EXST' : 'Non se pode eliminar a planta mentras teña Espacios asociados',
        'FLR_SPC_KO' : 'Error ó consultar os espacios asociados a planta',

        // Consutla de Implementaciones de Rutas en Plantas
        'FLR_RT_EXST' : 'Non se pode eliminar a planta mentras teña implementacións de Rutas',
        'FLR_RT_KO' : 'Error ó consultar as implementacións de rutas na planta',

    // ESPACIOS

        // SEARCH
        'SPC_SRCH_NOT_ALLOWED' : 'Non dispón de permisos pra buscar espazos este edificio',
        'SPC_SRCH_OK' : 'The search for spaces was successful',
        'SPC_SRCH_KO' : 'Error while searching for spaces',

        // ADD
        'SPC_ADD_OK' : 'O espazo añadiuse correctamente',
        'SPC_ADD_KO' : 'Error ó añadir o espazo',

        // DELETE
        'SPC_DEL_OK' : 'O espazo eliminouse con éxito',
        'SPC_DEL_KO' : 'Error ó eliminar o espazo',

        // SEEK
        'SPC_SEEK_KO' : 'Error ó consultar os detalles do espazo',
        'SPC_SEEK_OK' : 'A consulta dos detalles do espazo realizouse correctamente',
        'SPC_SEEK_NOT_ALLOWED' : 'Non dispón dos permisos necesarios para consultar os detalles deste espazo',

        // EDIT
        'SPC_EDT_OK' : 'O espazo editouse correctamente',
        'SPC_EDT_KO' : 'Error ó editar o espazo',

        // Detalles del espacio del portal
        'PRTL_SPC_SEEK_OK' : 'A consulta dos detalles do espazo realizouse correctamente',
        'PRTL_SPC_SEEK_KO' : 'Error ó consultar os detalles do espazo',

        // Búsqueda por ID de Espacio
        'SPCID_NOT_EXST' : 'O espazo indicado non existe',
        'SPCID_EXST' : 'O espazo indicado existe',
        'SPCID_KO' : 'Error ó consultar por ID de Espazo',

        // Búsqueda por nombre de espacio
        'SPC_NAM_EXST' : 'Xa existe un espazo co nome indicado nesta planta',
        'SPC_NAM_KO' : 'Error ó consultar por nome de espazo',

        // Subir foto espacio
        'SPC_PH_KO' : 'Error ó subir a foto do espazo',

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
            'TLF_MAX_SIZE' : 'O número de teléfono supera o tamaño máximo',
            'TLF_WITH_LETTERS' : 'O número de teléfono só pode conter números',

            // Foto_Perfil
            'PRPH_KO' : 'Error ó subir a foto de perfil',
            'PRPH_EXT' : 'A extensión da imáxen non está permitida',
            'PRPH_LRG' : 'O tamaño da imáxen é superior a permitida (100kb)',
            'PRPH_FRMT' : 'O nome da foto de perfil só pode conter letras, números y guiones',

            // Edificio_ID
            'BLD_ID_EMPT' : 'O ID do edificio non pode estar valeiro',
            'BLD_ID_NOT_NUMERIC' : 'O ID do edificio debe ser numérico',

            // Responsable (Usuario)
            'MANG_SHRT' : 'O nome do responsable debe superar os 3 caracteres',
            'MANG_LRG' : 'O nome do responsable non pode superar os 20 caracteres',
            'MANG_ALF' : 'O nome do responsable só pode conter caracteres alfanuméricos',

            // Building Name
            'BLD_NAM_SHRT' : 'O nome do edificio debe superar os 3 caracteres',
            'BLD_NAM_LRG' : 'O nome do edificio non debe superar os 60 caracteres',
            'BLD_NAM_FRMT' : 'O nome do edificio só pode conter caracteres alfanuméricos, espacios e acentos',

            // Calle
            'CALLE_SHRT' : 'A calle debe superar os 8 caracteres',
            'CALLE_LRG' : 'A calle non debe superar os 60 caracteres',
            'CALLE_FRMT' : 'A calle só pode conter caracteres alfanuméricos, espacios e guións',

            // Ciudad
            'CIUDAD_SHRT' : 'A cidade debe superar os 3 caracteres',
            'CIUDAD_LRG' : 'A cidade non debe superar os 40 caracteres',
            'CIUDAD_FRMT' : 'A cidade só pode conter letras e espacios',

            // Provincia
            'PROV_SHRT' : 'A provincia debe superar os 3 caracteres',
            'PROV_LRG' : 'A provincia non debe sueperar os 40 caracteres',
            'PROV_FRMT' : 'A provincia só pode conter letras e espacios',

            // Código Postal
            'CP_EMPT' : 'É necesario especificar un código postal',
            'CP_NUMERIC' : 'O código postal debe ser numérico',
            'CP_SIZE' : 'O código postal debe ser un número de 5 díxitos',
            'CP_MAX_SIZE' : 'O código postal non debe superar os 5 díxitos',

            // Foto Edificio
            'BLD_PH_EXT' : 'A extensión da foto do edificio non está permitida',
            'BLD_PH_FRMT' : 'O nome da foto do edificio só pode conter letras, números e guións',

            // Nombre Planta
            'FLR_NAM_SHRT' : 'O nome da planta debe superar os 3 caracteres',
            'FLR_NAM_LRG' : 'O nome da planta non debe superar os 40 caracteres',
            'FLR_NAM_FRMT' : 'O nome da planta só pode conter caracteres alfanuméricos, espacios, números e acentos',

            // Número de Planta
            'NUM_FLOOR_EMPT' : 'O número da planta non pode ser vacío',
            'NUM_FLOOR_LRG': 'O número da planta debe ser un número de 1 ou 2 díxitos',
            'NUM_FLOOR_NOT_NUMERIC' : 'O número de planta debe ser un número',

            // Descripción
            'DESC_EMPTY' : 'O campo descripción non pode ser vacío',
            'DESC_FRMT' : 'O campo descripción contén caracteres non permitidos',

            // Foto Planta
            'FLR_PH_EXT' : 'A extensión da foto da planta non está permitida',
            'FLR_PH_FRMT' : 'O nome da foto da planta só pode conter letras, números e guións',

            // Planta ID
            'FLR_ID_EMPT' : 'O ID da planta non pode ser vacío',
            'FLR_ID_NOT_NUMERIC' : 'O ID da planta debe ser numérico',

            // Espacio ID
            'SPC_ID_EMPT' : 'El ID do espazo non pode ser vacío',
            'SPC_ID_NOT_NUMERIC' : 'El ID do espazo debe ser numérico',

            // Nombre del Espacio
            'SPC_NAM_SHRT' : 'O nome do espazo debe superar os 3 caracteres',
            'SPC_NAM_LRG' : 'O nome do espazo non debe superar os 40 caracteres',
            'SPC_NAM_FRMT' : 'O nome do espazo só pode conter caracteres alfanuméricos, espazos, números e acentos',

            // Foto Espacio
            'SPC_PH_EXT' : 'A extensión da foto do espazo non está permitida',
            'SPC_PH_FRMT' : 'O nome da foto do espazo só contener letras, números e guións',




    // INTERFACE
        // HEADER
        'i18n-idioma' : 'Idioma',
        'i18n-login' : 'Iniciar Sesión',
        'i18n-admin' : 'Panel de Administración',
        'i18n-logout' : 'Desconectar',

        // PORTAL_COUNTRIES
        'i18n-app-welcome' : '¡Benvido a SG2P!',
        'i18n-select-city' : 'Selecciona unha cidade onde consultar Edificios',
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
        'i18n-del-user-confirm' : '¿Está seguro de que quere eliminar a este usuario? A acción non será reversible',
        'i18n-edit-user' : 'Editar Usuario',
        'i18n-user-details' : 'Detalles do Usuario',

        // BUILDINGS VIEWS
        'i18n-edificio_id' : 'ID Edificio',
        'i18n-responsable' : 'Responsable',
        'i18n-ciudad' : 'Cidade',
        'i18n-buildings-empty' : 'Aínda non hay edificios rexitrados',
        'i18n-add-building' : 'Engadir Edificio',
        'i18n-calle' : 'Calle',
        'i18n-provincia' : 'Provincia',
        'i18n-codigo_postal' : 'Código Postal',
        'i18n-fax' : 'Fax',
        'i18n-del-building-confirm' : '¿Está seguro de que quere eliminar este edificio? A acción non será reversible',
        'i18n-edit-building' : 'Editar Edificio',
        'i18n-search-building' : 'Buscar Edificio',
        'i18n-view-floors' : 'Ver Plantas',
        'i18n-building-details' : 'Detalles do Edificio',
        'i18n-foto_edificio' : 'Foto do Edificio',

        // FlOORS VIEWS
        'i18n-floors' : 'Plantas',
        'i18n-planta_id' : 'ID Planta',
        'i18n-num_planta' : 'Número de Planta',
        'i18n-floors-empty' : 'Este edificio aínda non ten plantas rexistradas',
        'i18n-add-floor' : 'Engadir Planta',
        'i18n-descripcion' : 'Descripción',
        'i18n-details-floor' : 'Detalles da Planta',
        'i18n-del-floor-confirm' : '¿Está seguro de que desexa eliminar esta planta? A acción non será reversible',
        'i18n-search-floor' : 'Buscar Plantas',
        'i18n-edit-floor' : 'Editar Planta',
        'i18n-view-spaces' : 'Ver Espazos',
        'i18n-foto_planta' : 'Foto da Planta',

        // SPACES VIEWS
        'i18n-spaces' : 'Espazos',
        'i18n-espacio_id' : 'ID Espazo',
        'i18n-spaces-empty' : 'Esta planta non ten espazos rexistrados todavía',
        'i18n-add-space' : 'Engadir Espazo',
        'i18n-foto_espacio' : 'Foto do Espazo',
        'i18n-del-space-confirm' : '¿Está seguro de que desexa eliminar este espazo? A acción non será reversible',
        'i18n-details-space' : 'Detalles do Espazo',
        'i18n-search-space' : 'Buscar Espazos',
        'i18n-edit-space' : 'Editar Espazo',

        // PORTAL VIEWS
        'i18n-resp-info' : 'Consulta a información relativa ó responsable do edificio',
        'i18n-contact' : 'Contacto',
        'i18n-address' : 'Dirección',
        'i18n-details-manager' : 'Detalles do Responsable',
        'i18n-floors-info' : 'Consulta información das plantas e dos espacios do edificio',
        'i18n-select-building' : 'Selecciona un Edificio',
        'i18n-select-floor' : 'Selecciona unha Planta',
        'i18n-portal-floors-empty' : 'Este edificio aínda non ten plantas rexistradas',
        'i18n-piso' : 'Piso número: ',
        'i18n-floor-spaces' : 'Espazos da Planta',


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
            'm-edificio_id' : ' ID Edificio ',
            'm-num_planta' : ' Número de Planta ',
            'm-foto_planta' : ' Foto Planta ',
            'm-descripcion' : ' Descripción ',
            'm-planta_id' : ' ID Planta ',
            'm-espacio_id' : ' ID Espazo ',

            // Mensajes Modal
            'i18n-max-size' : 'excede o tamaño máximo',
            'i18n-only-letters-numbers' : 'só pode conter letras e números',
            'i18n-not-empty' : 'non pode ser vacío',
            'i18n-generic-format' : 'ten un formato incorrecto',
            'i18n-letters-spaces-accents-format' : 'só admite letras, espacios e acentos',
            'i18n-numbers-format' : 'só pode conter números',
            'i18n-wrong-enum' : 'ten un valor non contemplado',
            'i18n-ext-not-allowed' : 'ten unha extensión non permitida',
            'i18n-cp-format' : 'debe ser un número de 5 díxitos',
            'i18n-letters-numbers-accents-spaces' : 'só pode conter letras, números, espacios e acentos',
            'i18n-chars-not_allow' : 'contén caracteres non permitidos',


}
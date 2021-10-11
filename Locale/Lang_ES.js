

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

        // SEEK
        'USR_SEEK_OK' : 'La búsqueda de los detalles del usuario se ha realizado correctamente',
        'USR_SEEK_KO' : 'Error al consultar los detalles del usuario',

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
        'BLDID_EXST' : 'El ID de edificio existe',

        // Búsqueda por Responsable
        'MANG_NOT_EXST' : 'El Responsable introducido no existe',
        'MANG_EXST' : 'El Responsable existe',
        'MANG_KO' : 'Error al consultar al responsable',

        // Búsqueda de Plantas del Edificio
        'BLD_FLR_EXST' : 'No se puede eliminar el edificio mientras tenga plantas asociadas',
        'BLD_SRCH_FLR_KO' : 'Error al consultar las plantas del edificio',

        // Búsqueda de Planes asignados al Edificio
        'BLD_PLN_EXST' : 'No se puede eliminar el edificio mientras tenga planes asignados',
        'BLD_SRCH_PLN_KO': 'Error al consultar los planes asociados al edificio',

    // PLANTAS

        // SEARCH
        'FLR_SRCH_NT_ALLOWED' : 'No dispone de permisos para buscar plantas en este edificio',
        'FLR_SRCH_OK' : 'Búsqueda de plantas Ok',
        'FLR_SRCH_KO' : 'Error al consultar las plantas',

        // ADD
        'FLR_ADD_OK' : 'La planta se ha añadido correctamente',
        'FLR_ADD_KO' : 'Error al añadir la planta',

        // DELETE
        'FLR_DEL_OK' : 'La planta se ha eliminado con éxito',
        'FLR_DEL_KO' : 'Error al eliminar la planta',

        // SEEK
        'FLR_SEEK_NOT_ALLOWED' : 'No dispone de los permisos necesarios para consultar los detalles de esta planta',
        'FLR_SEEK_OK' : 'La consulta de los detalles de la planta se ha realizado correctamente',
        'FLR_SEEK_KO' : 'Error al consultar los detalles de la planta',

        // EDIT
        'FLR_EDT_OK' : 'Los datos de la planta se han modificado correctamente',
        'FLR_EDT_KO' : 'Error al modificar los datos de la planta',

        // Búsqueda de Plantas del Portal
        'PRTL_FLR_SRCH_OK' : 'La búsqueda de plantas del portal se ha realizado correctamente',
        'PRTL_FLR_SRCH_KO' : 'Error al buscar las plantas del portal',

        // Detalles de la planta del Portal
        'PRTL_FLR_SEEK_OK' : 'La consulta de los detalles de la planta del portal se ha realizado correctamente',
        'PRTL_FLR_SEEK_KO' : 'Error al consultar los detalles de la planta del portal',

        // Existe numero de planta en un edificio
        'FLR_NUM_EXST' : 'Ya existe una planta con el número de planta indicando en este edificio',
        'NUM_PLNT_EXST_KO' : 'Error al consultar por número de planta',

        // Subir foto planta
        'FLR_PH_KO' : 'Error al subir la foto de la planta',

        // Consulta por Planta
        'FLRID_NOT_EXST' : 'La Planta no existe',
        'FLRID_EXST' : 'La Planta existe',
        'FLRID_KO' : 'Error al consultar por ID de Planta',

        // Consulta de Espacios asociados a Planta
        'FLR_SPC_EXST' : 'No se puede eliminar la planta mientras tenga Espacios asociados',
        'FLR_SPC_KO' : 'Error al consultar los espacios asociados a la planta',

        // Consutla de Implementaciones de Rutas en Plantas
        'FLR_RT_EXST' : 'No se puede eliminar la planta mientras tenga implementaciones de Rutas',
        'FLR_RT_KO' : 'Error al consultar las implementaciones de rutas en la planta',

    // ESPACIOS

        // SEARCH
        'SPC_SRCH_NOT_ALLOWED' : 'No dispone de permisos para buscar espacios en este edificio',
        'SPC_SRCH_OK' : 'La búsqueda de espacios se ha realizado correctamente',
        'SPC_SRCH_KO' : 'Error al realizar la búsqueda de espacios',

        // ADD
        'SPC_ADD_OK' : 'El espacio se ha añadido correctamente',
        'SPC_ADD_KO' : 'Error al añadir el espacio',

        // DELETE
        'SPC_DEL_OK' : 'El espacio se ha eliminado con éxito',
        'SPC_DEL_KO' : 'Error al eliminar el espacio',

        // SEEK
        'SPC_SEEK_KO' : 'Error al consultar los detalles del espacio',
        'SPC_SEEK_OK' : 'La consulta de los detalles del espacio se ha realizado correctamente',
        'SPC_SEEK_NOT_ALLOWED' : 'No dispone de los permisos necesarios para consultar los detalles de este espacio',

        // EDIT
        'SPC_EDT_OK' : 'El espacio se ha editado correctamente',
        'SPC_EDT_KO' : 'Error al editar el espacio',

        // Detalles del espacio del portal
        'PRTL_SPC_SEEK_OK' : 'La consulta de los detalles del espacio del portal se ha realizado correctamente',
        'PRTL_SPC_SEEK_KO' : 'Error al consultar los detalles del espacio del portal',

        // Búsqueda por ID de Espacio
        'SPCID_NOT_EXST' : 'El espacio indicado no existe',
        'SPCID_EXST' : 'El espacio indicado existe',
        'SPCID_KO' : 'Error al consultar por ID de Espacio',

        // Búsqueda por nombre de espacio
        'SPC_NAM_EXST' : 'Ya existe un espacio con el nombre indicado en esta planta',
        'SPC_NAM_KO' : 'Error al consultar por nombre de espacio',

        // Subir foto espacio
        'SPC_PH_KO' : 'Error al subir la foto del espacio',

    // DEF_PLAN

        // SEARCH
        'DFPLAN_SEARCH_OK' : 'La búsqueda de definiciones de planes se ha realizado correctamente',
        'DFPLAN_SEARCH_KO' : 'Error al buscar definiciones de planes',

        // ADD
        'DFPLAN_ADD_OK' : 'La definición del plan se ha añadido correctamente',
        'DFPLAN_ADD_KO' : 'Error al añadir la definición del plan',

        // DELETE
        'DFPLAN_DEL_OK' : 'La definición del plan se ha eliminado correctamente',
        'DFPLAN_DEL_KO' : 'Error al eliminar la definición del plan',

        // SEEK
        'DFPLAN_SEEK_OK' : 'La consulta de los detalles de la definición del plan se ha realizado correctamente',
        'DFPLAN_SEEK_KO' : 'Error al consultar los detalles de la definición del plan',

        // EDIT
        'DFPLAN_EDT_OK' : 'La definición del plan se ha modificado correctamente',
        'DFPLAN_EDT_KO' : 'Error al modificar la definición del plan',

        // Búsqueda por nombre de plan
        'DFPLAN_NAM_NOT_EXST': 'El nombre del plan no existe',
        'DFPLAN_NAM_EXST' : 'El nombre del plan existe',
        'DFPLAN_NAM_KO' : 'Error al consultar por nombre de plan',

        // Búsqueda por ID de Plan
        'DFPLANID_NOT_EXST' : 'La definición del plan no existe',
        'DFPLANID_EXST' : 'La definición del plan existe',
        'DFPLANID_KO' : 'Error al consultar por ID de Plan',

        // Búsqueda de edificios asignados
        'DFPLAN_BLD_EXST' : 'No se puede eliminar la definición del plan mientras esté asignado a edificios',
        'DFPLAN_BLD_NOT_EXST' : 'La definición del plan no está asignado a ningún edificio',
        'DFPLAN_BLD_KO' : 'Error al consultar los edificios asignados',

        // Búsqueda de documentos asociados
        'DFPLAN_DOC_EXST' : 'No se puede eliminar la definición del plan mientras tenga definiciones de documentos asociadas',
        'DFPLAN_DOC_NOT_EXST' : 'La definición del plan no tiene definiciones de documentos asociadas',
        'DFPLAN_DOC_KO' : 'Error al consultar definiciones de documentos asociadas',

        // Búsqueda de procedimientos asociados
        'DFPLAN_PROC_EXST' : 'No se puede eliminar la definición del plan mientras tenga definiciones de procedimientos asociadas',
        'DFPLAN_PROC_NOT_EXST' : 'La definición del plan no tiene definiciones de procedimientos asociados',
        'DFPLAN_PROC_KO' : 'Error al consultar definiciones de procedimientos asociadas',

        // Búsqueda de rutas asociadas
        'DFPLAN_ROUTE_EXST' : 'No se puede eliminar la definición del plan mientras tenga definiciones de rutas asociadas',
        'DFPLAN_ROUTE_NOT_EXST' : 'La definición del plan no tiene definiciones de rutas asociadas',
        'DFPLAN_ROUTE_KO' : 'Error al consultar definiciones de rutas asociadas',

        // Búsqueda de formaciones asociados
        'DFPLAN_FRMT_EXST' : 'No se puede eliminar la definición del plan mientras tenga definiciones de formaciones asociadas',
        'DFPLAN_FRMT_NOT_EXST' : 'La definición del plan no tiene definiciones de formaciones asociadas',
        'DFPLAN_FRMT_KO' : 'Error al consultar definiciones de formaciones asociadas',

        // Búsqueda de simulacros asociados
        'DFPLAN_SIM_EXST' : 'No se puede eliminar la definición del plan mientras tenga definiciones de simulacros asociadas',
        'DFPLAN_SIM_NOT_EXST' : 'La definición del plan no tiene definiciones de simulacros asociados',
        'DFPLAN_SIM_KO' : 'Error al consultar definiciones de simulacros',

    // DEF_DOC

        // SEARCH
        'DFDOC_SEARCH_OK' : 'Búsqueda de definiciones de documentos OK',
        'DFDOC_SEARCH_KO' : 'Error al buscar definiciones de documentos',

        // ADD
        'DFDOC_ADD_OK' : 'La definición del documento se ha añadido correctamente',
        'DFDOC_ADD_KO' : 'Error al añadir la definición del documento',

        // SEEK
        'DFDOC_SEEK_OK' : 'Éxito al obtener los detalles de la def. del documento',
        'DFDOC_SEEK_KO' : 'Error al obtener los detalles de la def. del documento',

        // DELETE
        'DFDOC_DEL_OK' : 'La definición del documento se ha eliminado correctamente',
        'DFDOC_DEL_KO' : 'Error al eliminar la definición del documento',

        // EDIT
        'DFDOC_EDT_OK' : 'La definición del documento se ha modificado correctamente',
        'DFDOC_EDT_KO' : 'Error al modificar la definición del documento',

        // Búsqueda por nombre de documento
        'DFDOC_NAME_EXST' : 'Ya existe una definición de documento con el nombre indicado para este plan',
        'DFDOC_NAME_NOT_EXST' : 'No existe una definicón de documento con el nombre indicado en este plan',
        'DFDOC_NAME_KO' : 'Error al consultar por nombre de documento',

        // Búsqueda por ID de Documento
        'DFDOCID_EXST' : 'El ID de documento existe',
        'DFDOCID_NOT_EXST' : 'La definición de documento indicada no existe',
        'DFDOCID_KO' : 'Error al consultar por ID de documento',

        // Búsqueda de implementaciones de documentos
        'DFDOC_IMPL_EXST' : 'No se puede eliminar la def. de documento mientras tenga implementaciones en edificios',
        'DFDOC_IMPL_NOT_EXST' : 'La def. de documento indicada no tiene implementaciones en edificios',
        'DFDOC_IMPL_KO' : 'Error al consultar implementaciones de documentos',

    // DEF_PROC

        // SEARCH
        'DFPROC_SEARCH_OK' : 'La búsqueda de definiciones de procedimientos se ha realizado correctamente',
        'DFPROC_SEARCH_KO' : 'Error al buscar definiciones de procedimientos',

        // ADD
        'DFPROC_ADD_OK' : 'La definición del procedimiento se ha añadido correctamente',
        'DFPROC_ADD_KO' : 'Error al añadir la definición del procedimiento',

        // DELETE
        'DFPROC_DEL_OK' : 'La definición del procedimiento se ha eliminado correctamente',
        'DFPROC_DEL_KO' : 'Error al eliminar la definición del procedimiento',

        // SEEK
        'DFPROC_SEEK_OK' : 'Éxito en la obtención de los detalles de la definición del procedimiento',
        'DFPROC_SEEK_KO' : 'Error al consultar los detalles de la definición del procedimiento',

        // EDIT
        'DFPROC_EDT_OK' : 'La definición del procedimiento se ha modificado correctamente',
        'DFPROC_EDT_KO' : 'Error al modificar la definición del procedimiento',

        // Búsqueda por ID de Procedimiento
        'DFPROCID_NOT_EXST' : 'La definición de procedimiento indicada no existe',
        'DFPROCID_EXST' : 'La definición de procedimiento indicada existe',
        'DFPROCID_KO' : 'Error al consultar por procedimiento ID',

        // Búsqueda de implementaciones de procedimientos
        'DFPROC_IMPL_EXST' : 'No se puede eliminar la definición del procedimiento mientras tenga implementaciones en edificios',
        'DFPROC_IMPL_NOT_EXST' : 'La definición del procedimiento no tiene implementaciones en edificios',
        'DFPROC_IMPL_KO' : 'Error al consultar implementaciones de procedimientos',

        // Búsqueda por nombre de procedimiento
        'DFPROC_NAME_EXST' : 'Ya existe una definición de procedimiento con el nombre indicado en este plan',
        'DFPROC_NAME_NOT_EXST' : 'No existe una definición de procedimiento con el nombre indicado en este plan',
        'DFPROC_NAME_KO' : 'Error al consultar por nombre de procedimiento',

    // DEF_ROUTE

        // SEARCH
        'DFROUTE_SEARCH_OK' : 'La búsqueda de definiciones de rutas se ha realizado correctamente',
        'DFROUTE_SEARCH_KO' : 'Error al buscar definiciones de rutas',

        // ADD
        'DFROUTE_ADD_OK' : 'La definición de la ruta se ha añadido correctamente',
        'DFROUTE_ADD_KO' : 'Error al añadir la definición de la ruta',

        // SEEK
        'DFROUTE_SEEK_OK' : 'Se han consultado los detalles de la definición de la ruta correctamente',
        'DFROUTE_SEEK_KO' : 'Error al consultar los detalles de la definición de la ruta',

        // DELETE
        'DFROUTE_DEL_OK' : 'La definición de la ruta se ha eliminado correctamente',
        'DFROUTE_DEL_KO' : 'Error al eliminar la definición de la ruta',

        // EDIT
        'DFROUTE_EDT_OK' : 'La definición de la ruta se ha modificado correctamente',
        'DFROUTE_EDT_KO' : 'Error al modificar la definición de la ruta',

        // Búsqueda de implementaciones de rutas en plantas
        'DFROUTE_IMPL_EXST' : 'No se puede eliminar la definición de la ruta mientras existan implementaciones en alguna planta',
        'DFROUTE_IMPL_NOT_EXST' : 'La definición de la ruta no tiene implementaciones en plantas',
        'DFROUTE_IMPL_KO' : 'Error al consultar implementaciones de la ruta en plantas',

        // Búsqueda por ID de ruta
        'DFROUTEID_NOT_EXST' : 'La definición de la ruta indicada no existe',
        'DFROUTEID_EXST' : 'La definición de la ruta indicada existe',
        'DFROUTEID_KO' : 'Error al consultar por ID de Ruta',

        // Búsqueda por nombre de ruta
        'DFROUTE_NAME_EXST' : 'Ya existe una definición de ruta con el nombre indicado para este plan',
        'DFROUTE_NAME_NOT_EXST' : 'No existe una definición de ruta con el nombre indicado en el plan',
        'DFROUTE_NAME_KO' : 'Error al consultar por nombre de ruta',

    // DEF_FORMAT

        // SEARCH
        'DFFRMT_SEARCH_OK' : 'La búsqueda de definiciones de formaciones se ha realizado correctamente',
        'DFFRMT_SEARCH_KO' : 'Error al buscar definiciones de formaciones',

        // ADD
        'DFFRMT_ADD_OK' : 'La definición de la formación se ha añadido correctamente',
        'DFFRMT_ADD_KO' : 'Error al añadir la definición de la formación',

        // SEEK
        'DFFRMT_SEEK_OK' : 'Se han consultado los detalles de la definición de la formación correctamente',
        'DFFRMT_SEEK_KO' : 'Error al consultar los detalles de la definición de la formación',

        // DELETE
        'DFFRMT_DEL_OK' : 'Se ha eliminado la definición de la formación correctamente',
        'DFFRMT_DEL_KO' : 'Error al eliminar la definición de la formación',

        // EDIT
        'DFFRMT_EDT_OK' : 'La definición de la formación se ha modificado correctamente',
        'DFFRMT_EDT_KO' : 'Error al modificar la definición de la formación',

        // Búsqueda por nombre
        'DFFRMT_NAME_EXST' : 'Ya existe una definición de formación con el nombre indicado en este plan',
        'DFFRMT_NAME_NOT_EXST' : 'No existe una definición de formación con el nombre indicado en el plan',
        'DFFRMT_NAME_KO' : 'Error al consultar por nombre de definición de formación',

        // Búsqueda por ID de Formación
        'DFFRMTID_NOT_EXST' : 'La definición de la formación indicada no existe',
        'DFFRMTID_EXST' : 'La definición de la formación indicada existe',
        'DFFRMTID_KO' : 'Error al consultar por ID de Formación',

        // Búsqueda de implementacione de la formación en edificios
        'DFFRMT_IMPL_EXST' : 'No se puede eliminar la definición de la formación mientras tenga implementaciones en edificios',
        'DFFRMT_IMPL_NOT_EXST' : 'La definición de la formación no tiene implementaciones en edificios',
        'DFFRMT_IMPL_KO' : 'Error al consultar implementaciones de formaciones',


    // DEF_SIM

        // SEARCH
        'DFSIM_SEARCH_OK' : 'La búsqueda de definiciones de simulacros se ha realizado correctamente',
        'DFSIM_SEARCH_KO' : 'Error al buscar definiciones de simulacros',

        // ADD
        'DFSIM_ADD_OK' : 'La definición del simulacro se ha añadido correctamente',
        'DFSIM_ADD_KO' : 'Error al añadir la definición del simulacro',

        // SEEK
        'DFSIM_SEEK_OK' : 'Se han consultado los detalles de la definición del simulacro correctamente',
        'DFSIM_SEEK_KO' : 'Error al consultar los detalles de la definición del simulacro',

        // DELETE
        'DFSIM_DEL_OK' : 'La definición del simulacro se ha eliminado correctamente',
        'DFSIM_DEL_KO' : 'Error al eliminar la definición del simulacro',

        // EDIT
        'DFSIM_EDT_OK' : 'La definición del simulacro se ha modificado correctamente',
        'DFSIM_EDT_KO' : 'Error al modificar la definición del simulacro',

        // Búsqueda por ID de Simulacro
        'DFSIMID_NOT_EXST' : 'La definición de simulacro indicada no existe',
        'DFSIMID_EXST' : 'La definición del simulacro indicada existe',
        'DFSIMID_KO' : 'Error al consultar por ID de Simulacro',

        // Consulta de implementaciones de simulacros
        'DFSIM_IMPL_EXST' : 'No se puede eliminar la definición del simulacro mientras tenga implementaciones en edificios',
        'DFSIM_IMPL_NOT_EXST' : 'La definición del simulacro no tiene implementaciones en edificios',
        'DFSIM_IMPL_KO' : 'Error al consultar implementaciones del simulacro',

        // Búsqueda por nombre de simulacro
        'DFSIM_NAME_EXST' : 'Ya existe una definición de simulacro con el nombre indicado en este plan',
        'DFSIM_NAME_NOT_EXST' : 'No existe una definición de simulacro con el nombre indicado en este plan',
        'DFSIM_NAME_KO' : 'Error al consultar por nombre de simulacro',


    // BUILD_PLAN

        // SEARCH
        'BLDPLAN_SEARCH_OK' : 'La búsqueda de edificios asignados al plan se ha realizado correctamente',
        'BLDPLAN_SEARCH_KO' : 'Error al recuperar los edificios asignados al plan',

        // ADD
        'DFPLAN_ADD_NOT_DOCS' : 'El plan debe tener al menos una definición de documento para poder ser asignado',
        'DFROUTE_EXST_FLRS_NOT_EXST' : 'El plan contiene definiciones de rutas y alguno de los edificios no tienen plantas asociadas',
        'BLDPLAN_ADD_OK' : 'Se han asignados los edificios indicado al plan correctamente',
        'BLDPLAN_ADD_KO' : 'Error al crear la asiganción entre los edificios y el plan',

        // SEEK
        'BLDPLAN_SEEK_OK' : 'Se han consultado los detalles de la asignación entre el Edificio y el Plan correctamente',
        'BLDPLAN_SEEK_KO' : 'Error al consultar los detalles de la asignación entre el Edificio y el Plan indicados',

        // DELETE
        'BLDPLAN_DEL_OK' : 'Se ha eliminado con éxito la asignación entre el Edificio y el Plan indicados',
        'BLDPLAN_DEL_KO' : 'Error al eliminar la asignación entre el Edificio y el Plan indicados',

        // VENCER ASIGNACIONES
        'BLDPLAN_EDTSTATE_OK' : 'Se han vencido las asignaciones correctamente',
        'BLDPLAN_EDTSTATE_KO' : 'Error al vencer las asignaciones',
        'BLDPLAN_ALREADY_EXPIRED' : 'La asignación indicada ya se encuentra vencida',

        // Búsqueda de asignaciones Activas
        'BLDPLAN_ASSIGN_ACTIVES_NOT_EXST' : 'El plan indicado no tiene asignaciones activas',
        'BLDPLAN_ASSIGN_ACTIVES_EXST' : 'El plan indicado tiene asignaciones activas',
        'BLDPLAN_ASSIGN_ACTIVES_KO' : 'Error al consultar asignaciones activas del plan',

        // Vencer Implementaciones
        'IMPDOC_EDTSTATE_KO' : 'Error al vencer las implementaciones de los documentos',
        'IMPPROC_EDTSTATE_KO' : 'Error al vencer las implementaciones de los procedimientos',
        'IMPROUTE_EDTSTATE_KO' : 'Error al vencer las implementaciones de las rutas',
        'IMPFRMT_EDTSTATE_KO' : 'Error al vencer las implementaciones de las formaciones',
        'IMPSIM_EDTSTATE_KO' : 'Error al vencer las implementaciones de los simulacros',

        // Directorios
        'BLDPLAN_DIRPLAN_KO' : 'Error al crear el directorio raíz del Plan',
        'BLDPLAN_DIRBLD_KO' : 'Error al crear el directorio del Edificio',
        'BLDPLAN_DIRDOC_KO' : 'Error al crear el directorio de la definición del Documento',
        'BLDPLAN_DIRPROC_KO' : 'Error al crear el directorio de la definición del Procedimiento',
        'BLDPLAN_DIRROUTE_KO' : 'Error al crear el directorio de la definición de la Ruta',

        // Busq. Asociaciones Edificio - Plan
        'BLDPLAN_EXST' : 'Ya existe una asignación entre alguno de los edificios y el plan indicados',
        'BLDPLAN_NOT_EXST' : 'El edificio no está asignado al plan indicado',
        'BLDPLAN_KO' : 'Error al consultar asignaciones entre planes y edificios',

        // Implementaciones
        'IMPDOC_ADD_KO' : 'Error al crear la cumplimentación del documento',
        'IMPDOC_DEL_KO' : 'Error al eliminar la cumplimentación del documento',
        'IMPPROC_ADD_KO' : 'Error al crear la cumplimentación del procedimiento',
        'IMPPROC_DEL_KO' : 'Error al eliminar la cumplimentación del procedimiento',
        'IMPROUTE_ADD_KO' : 'Error al crear la cumplimentación de la ruta',
        'IMPROUTE_DEL_KO' : 'Error al eliminar la cumplimentación de la ruta',
        'IMPFRMT_ADD_KO' : 'Error al crear la cumplimentación de la formación',
        'IMPFRMT_DEL_KO' : 'Error al eliminar la cumplimentación de la formación',
        'BLDPLAN_IMPADD_OK' : 'Se han creado las cumplimentaciones correctamente',
        'IMPSIM_ADD_KO' : 'Error al crear la cumplimentación del simulacro',
        'IMPSIM_DEL_KO' : 'Error al eliminar la cumplimentación del simulacro',
        'BLD_IMPDEL_OK' : 'Se han eliminado las cumplimentaciones correctamente',

        // Búsqueda de Edificios candidatos
        'BLDPLAN_CANDIDATES_EMPT' : 'No hay edificios asignables al plan',
        'BLDPLAN_CANDIDATES_OK' : 'Búsqueda de edificios asignables al plan Ok',
        'BLDPLAN_CANDIDATES_KO' : 'Error al recuperar los edificios asignables al plan',

    // PLANS

        // SEARCH
        'PLAN_SEARCH_OK' : 'La búsqueda de planes se ha realizado correctamente',
        'PLAN_SEARCH_KO' : 'Error al buscar planes',

        // SEEK
        'PLAN_SEEK_FRBD' : 'No tiene permisos para consultar planes en este edificio',
        'PLAN_SEEK_OK' : 'Se han consultado los detalles del plan correctamente',

        // Búsqueda de Planes del Portal
        'PRTL_PLANS_SEARCH_OK' : 'La búsqueda de planes del portal se ha realizado correctamente',
        'PRTL_PLANS_SEARCH_KO' : 'Error al buscar los planes del portal',


    // IMP_DOCS

        // SEARCH
        'IMPDOC_SEARCH_OK' : 'La búsqueda de cumplimentaciones del documento se ha realizado correctamente',
        'IMPDOC_SEARCH_KO' : 'Error al buscar cumplimentaciones del documento',

        // ADD
        'IMPDOC_ADD_OK' : 'Se ha registrado la cumplimentación del procedimiento correctamente',
        'IMPDOC_BLD_NOT_OWNED' : 'No dispone de los privilegios necesarios para añadir cumplimentaciones en el edificio indicado',
        'BLDPLAN_EXPIRED' : 'No se puede realizar la acción. La asignación entre el plan y el edificio se encuentra vencida',

        // SEEK
        'IMPDOC_SEEK_OK' : 'Se han consultado los detalles de la cumplimentación del documento correctamente',
        'IMPDOC_SEEK_KO' : 'Error al consultar los detalles de la cumplimentación del documento',

        // DELETE
        'IMPDOC_DEL_OK' : 'Se ha eliminado la cumplimentación del documento correctamente',

        // EXPIRE
        'IMPDOC_EXPIRE_OK' : 'Se ha vencido correctamente la cumplimentación del documento indicada',
        'IMPDOC_EXPIRE_KO' : 'Error al vencer la cumplimentación del documento',

        // IMPLEMENTACION
        'IMPDOC_IMPL_OK' : 'La cumplimentación del documento se ha completado correctamente',
        'IMPDOC_IMPL_KO' : 'Error al completar la cumplimentación del documento',
        'COMPL_EXPIRED' : 'La cumplimentación se encuentra vencida y no se puede modificar',

        // Búsqueda de cumplimentaciones de documentos del portal
        'PRTL_IMPDOC_SEARCH_OK' : 'La búsqueda de cumplimentaciones de documentos del portal se ha realizado correctamente',
        'PRTL_IMPDOC_SEARCH_KO' : 'Error al buscar cumplimentaciones de documentos del portal',

        // Detalles de cumplimentacines del portal
        'PRTL_IMPDOC_SEEK_OK' : 'Se han consultado los detalles de la cumplimentación del procedimiento del portal correctamente',
        'PRTL_IMPDOC_SEEK_KO' : 'Error al consultar los detalles de la cumplimentación del procedimiento del portal',

        // Búsqueda de asignaciones por plan
        'BLDPLAN_ASSIGN_NOT_EXST' : 'No se han encontrado asignaciones del plan con edificios',
        'BLDPLAN_ASSIGN_EXST' : 'Se han encontrado asignaciones del plan con edificios',

        // Búsqueda de más de una cumplimentación de documento en el edificio
        'IMPDOC_UNIQ' : 'No se puede eliminar la cumplimentación. Siempre debe existir al menos una cumplimentación del documento',
        'IMPDOC_NOT_UNIQ' : 'Existen más de una cumplimentación del documento en el edificio',

        // Permisos
        'BLD_FRBD' : 'No dispone de los de los privilegios necesarios para realizar acciones sobre este edificio',

        // Búsqueda de cumplimentaciones por documento y edificio
        'BLDDOCS_SEARCH_OK' : 'La búsqueda de cumplimentaciones se ha realizado correctamente',
        'BLDDOCS_SEARCH_KO' : 'Error al buscar cumplimentaciones',

        // Búsqueda por id de cumplimentación del documento
        'IMPDOCID_NOT_EXST' : 'La cumplimentación del documento indicada no existe',
        'IMPDOCID_EXST' : 'La cumplimentación del documento existe',
        'IMPDOCID_KO' : 'Error al consultar la cumplimentación del documento',

        // Directorios
        'DIRFILE_ROOT_NOT_EXST' : 'La ruta base de la definición no existe',
        'DIRFILE_IMP_ALR_EXST' : 'El directorio de la cumplimentación ya existe',
        'DIRFILE_IMPDIR_ADD_KO' : 'Error al crear el directorio de la cumplimentación',
        'FILE_ADD_OK' : 'Se ha subido el fichero de la cumplimentación correctamente',
        'FILE_ADD_KO' : 'Error al subir el fichero de la cumplimentación',

        // Búsqueda de asignaciones activas
        'BLDDOC_ACTIVE_EMPT' : 'El plan al que pertenece el documento no tiene asociaciones activas con edificios',
        'BLDDOC_ACTIVE_OK' : 'El plan al que pertenece el documento tiene asociaciones activas con edificios',
        'BLDDOC_ACTIVE_KO' : 'Error al consultar asociaciones activas del plan con edificios',

        // Búsqueda de cumplimentaciones activas del documento en un edificio
        'IMPDOC_ACTIVE_EXST' : 'No se ha podido realizar la acción. Se han encontrado cumplimentaciones activas de este documento',
        'IMPDOC_ACTIVE_NOT_EXST' : 'No existen cumplimentaciones activas de este documento',
        'IMPDOC_ACTIVE_KO' : 'Error al consultar cumplimentaciones activas',

        // Asociación Documento - Edificio
        'BLDDOC_NOT_EXST' : 'El edificio indicado no tiene asignado el plan al que pertenece este documento',
        'BLDDOC_EXST' : 'El edificio indicado tiene asignado el plan al que pertenece el documento',
        'BLDDOC_KO' : 'Error al consultar la asociación entre el edificio y el plan del documento',

    // IMP_PROCS

        // SEARCH
        'IMPPROC_SEARCH_OK' : 'La búsqueda de cumplimentaciones del procedimiento se ha realizado correctamente',
        'IMPPROC_SEARCH_KO' : 'Error al buscar cumplimentaciones del procedimiento',

        // ADD
        'IMPPROC_ADD_OK' : 'Se ha registrado la cumplimentación del procedimiento correctamente',

        // DELETE
        'IMPPROC_DEL_OK' : 'La cumplimentación del procedimiento se ha eliminado correctamente',

        // SEEK
        'IMPPROC_SEEK_OK' : 'Se han obtenido los detalles de la cumplimentación del procedimiento correctamente',
        'IMPPROC_SEEK_KO' : 'Error al obtener los detalles de la cumplimentación del procedimiento',

        // EXPIRE
        'IMPPROC_EXPIRE_OK' : 'Se ha vencido correctamente la cumplimentación del procedimiento indicada',
        'IMPPROC_EXPIRE_KO' : 'Se ha producido un error al vencer la cumplimentación del procedimiento',

        // IMPLEMENT
        'IMPPROC_IMPL_OK' : 'La cumplimentación del procedimiento se ha completado correctamente',
        'IMPPROC_IMPL_KO' : 'Error al completar la cumplimentación del procedimiento',

        // Búsqueda por ID de Cumplimentación
        'IMPPROCID_NOT_EXST' : 'La cumplimentación del procedimiento no existe',
        'IMPPROCID_EXST' : 'El ID de la cumplimentación del procedimiento existe',
        'IMPPROCID_KO' : 'Error al consultar por ID de la cumplimentación del procedimiento',

        // Búsqueda de cumplimentación única
        'IMPPROC_UNIQ' : 'No se puede eliminar la cumplimentación. Siempre debe existir al menos una cumplimentación del procedimiento en el edificio',
        'IMPPROC_NOT_UNIQ' : 'Se encontraron más de una cumplimentación del procedimiento en el edificio',

        // Búsqueda de cumplimentaciones de procedimientos del Portal
        'PRTL_IMPPROC_SEARCH_OK' : 'La búsqueda de cumplimentaciones del procedimiento del portal se ha realizado correctamente',
        'PRTL_IMPPROC_SEARCH_KO' : 'Error al buscar cumplimentaciones del procedimiento del portal',

        // Búsqueda de cumplimentaciones activas de un procedimiento en un edificio
        'IMPPROC_ACTIVE_EXST' : 'No se ha podido realizar la acción. Se han encontrado cumplimentaciones activas de este procedimiento',
        'IMPPROC_ACTITVE_NOT_EXST' : 'No se han encontrado cumplimentaciones activas de este procedimiento',
        'IMPPROC_ACTIVE_KO' : 'Error al consultar las cumplimentaciones activas del procedimiento',

        // Búsqueda de cumplimentaciones por edificio y procedimiento
        'BLDPROCS_SEARCH_OK' : 'La búsqueda de cumplimentaciones se ha realizado correctamente',
        'BLDPROCS_SEARCH_KO' : 'Error al buscar cumplimentaciones',

        // Búsqueda asociación edificio - plan
        'BLDPROC_NOT_EXST' : 'El plan al que pertenece el procedimiento no está asignado al edificio indicado',
        'BLDPROC_EXST' : 'El plan al que pertenece el procedimiento está asignado al edificio indicado',
        'BLDPROC_KO' : 'Error al consultar la asociación entre el plan del procedimiento y el edificio',

    // IMP_ROUTES

        // SEARCH
        'IMPROUTE_SEARCH_OK' : 'La búsqueda de cumplimentaciones de la ruta se ha realizado correctamente',
        'IMPROUTE_SEARCH_KO' : 'Error al buscar cumplimentaciones de la ruta',

        // ADD
        'IMPROUTE_ADD_OK' : 'Se ha registrado la cumplimentación de la ruta correctamente',
        'BLD_FLOOR_EMPT' : 'No se pueden registrar cumplimentaciones de rutas en este edificio al no tener plantas asignadas',

        // SEEK
        'IMPROUTE_SEEK_OK' : 'Se han consultado los detalles de la cumplimentación de la ruta correctamente',
        'IMPROUTE_SEEK_KO' : 'Error al consultar los detalles de la cumplimentación de la ruta',

        // EXPIRE
        'IMPROUTE_EXPIRE_OK' : 'La cumplimentación de la ruta se ha vencido correctamente',
        'IMPROUTE_EXPIRE_KO' : 'Error al vencer la cumplimentación de la ruta',

        // IMPLEMENT
        'IMPROUTE_IMPL_OK' : 'La cumplimentación de la ruta se ha completado correctamente',
        'IMPROUTE_IMPL_KO' : 'Error al completar la cumplimentación de la ruta',

        // DELETE
        'IMPROUTE_DEL_OK' : 'La cumplimentación de la ruta se ha eliminado correctamente',

        // Búsqueda de cumplimentación de ruta única en el edificio
        'IMPROUTE_UNIQ' : 'No se puede eliminar la cumplimentación. Siempre debe existir por lo menos una cumplimentación de la ruta en el edificio',
        'IMPROUTE_NOT_UNIQ' : 'La cumplimentación de la ruta no es única',

        // Búsqueda por ID de Cumplimentación
        'IMPROUTEID_NOT_EXST' : 'La cumplimentación de la ruta indicada no existe',
        'IMPROUTEID_EXST' : 'La cumplimentación de la ruta existe',
        'IMPROUTEID_KO' : 'Error al consultar por id de cumplimentación',

        // Búsqueda de plantas del edificio
        'BLD_NOT_FLOORS' : 'No se ha podido añadir la cumplimentación. Alguno de los edificios indicados no tienen plantas registradas',
        'BLD_FLOORS_SEARCH_EMPT': 'El edificio indicado no tiene plantas registradas',
        'BLD_FLOORS_OK' : 'Búsqueda de plantas del edificio Ok',
        'BLD_FLOORS_KO' : 'Error al buscar las plantas del edificio',

        // Búsqueda de cumplimentaciones del Portal
        'PRTL_IMPROUTE_SEARCH_OK' : 'La búsqueda de cumplimentaciones de la ruta en el portal se ha realizado correctamente',
        'PRTL_IMPROUTE_SEARCH_KO' : 'Error al consultas las cumplimentaciones de la ruta en el portal',

        // Búsqueda asociación edificio - ruta
        'BLDROUTE_NOT_EXST' : 'El plan al que pertenece la ruta no está asignado al edificio indicado',
        'BLDROUTE_EXST' : 'El plan al que pertenece la ruta está asignado al edificio indicado',
        'BLDROUTE_KO' : 'Error al consultar la asociación entre el plan de la ruta y el edificio',

        // Búsqueda de cumplimentaciones por edificio y ruta
        'BLDROUTES_SEARCH_OK' : 'La búsqueda de cumplimentaciones se ha realizado correctamente',
        'BLDROUTES_SEARCH_KO' : 'Error al buscar cumplimentaciones',

    // IMP_FORMAT

        // SEARCH
        'IMPFORMAT_SEARCH_OK' : 'La búsqueda de cumplimentaciones de la formación se ha realizado correctamente',
        'IMPFORMAT_SEARCH_KO' : 'Error al buscar cumplimentaciones de la formación',

        // ADD
        'IMPFORMAT_ADD_OK' : 'Se ha registrado la cumplimentación de la formación correctamente',
        'IMPFORMAT_ADD_KO' : 'Se ha producido un error al crear la cumplimentación de la formación',

        // DELETE
        'IMPFORMAT_DEL_OK' : 'La cumplimentación de la formación se ha eliminado correctamente',
        'IMPFORMAT_DEL_KO' : 'Error al eliminar la cumplimentación de la formación',

        // SEEK
        'IMPFORMAT_SEEK_OK' : 'Se han consultado los detalles de la cumplimentación de la formación correctamente',
        'IMPFORMAT_SEEK_KO' : 'Se ha producido un error al consultar los detalles de la cumplimentación de la formación',

        // EXPIRE
        'IMPFORMAT_EXPIRE_OK' : 'Se ha vencido la cumplimentación de la formación correctamente',
        'IMPFORMAT_EXPIRE_KO' : 'Error al vencer la cumplimentación de la formación',

        // IMPLEMENT
        'IMPFORMAT_IMPL_OK' : 'Se ha cumplimentado la formación correctamente',
        'IMPFORMAT_IMPL_KO' : 'Error al cumplimentar la formación',

        // SEEK PORTAL
        'PRTL_IMPFORMAT_SEEK_OK' : 'Se han consultado los detalles de la cumplimentación de la formación del portal correctamente',
        'PRTL_IMPFORMAT_SEEK_KO' : 'Error al consultar los detalles de la cumplimentación de la formación del portal',

        // Consulta de cumplimentación única
        'IMPFORMAT_UNIQ' : 'No se puede eliminar la cumplimentación. Siempre debe existir al menos una cumplimentación de la formación en el edificio',
        'IMPFORMAT_NOT_UNIQ' : 'La cumplimentación de la formación en el edificio no es única',

        // Consulta por ID de Cumplimentación
        'IMPFORMATID_NOT_EXST' : 'El id de la cumplimentación de la formación indicado no existe',
        'IMPFORMATID_EXST' : 'El id de la cumplimentación de la formación existe',
        'IMPFORMATID_KO' : 'Error al consultar por id de cumplimentación de formación',

        // Detalles de la Formación del Portal
        'PRTL_IMPFORMAT_SEARCH_OK' : 'Se ha obtenido los detalles de la formación en el portal correctamente',
        'PRTL_IMPFORMAT_SEARCH_KO' : 'Error al obtener los detalles de la formación del portal',

        // Búsqueda asociación edificio - formacion
        'BLDFORMAT_NOT_EXST' : 'El plan al que pertenece la formación no está asignado al edificio indicado',
        'BLDFORMAT_EXST' : 'El plan al que pertenece la formación está asignado al edificio indicado',
        'BLDFORMAT_KO' : 'Error al consultar la asociación entre el plan de la formación y el edificio',

        // Búsqueda de cumplimentaciones
        'BLDFORMATS_SEARCH_OK' : 'Se han consultado las cumplimentaciones de la formación en el edificio correctamente',
        'BLDFORMATS_SEARCH_KO' : 'Error al consultar las cumplimentaciones de la formación en el edificio',

    // IMP_SIM

        // SEARCH
        'IMPSIM_SEARCH_OK' : 'La búsqueda de cumplimentaciones del simulacro se ha realizado correctamente',
        'IMPSIM_SEARCH_KO' : 'Error al buscar cumplimentaciones del simulacro',

        // ADD
        'IMPSIM_ADD_OK' : 'Se ha registrado la cumplimentación del simulacro correctamente',

        // DELETE
        'IMPSIM_DEL_OK' : 'La cumplimentación del simulacro se ha eliminado correctamente',

        // SEEK
        'IMPSIM_SEEK_OK' : 'Se han consultado los detalles de la cumplimentación del simulacro correctamente',
        'IMPSIM_SEEK_KO' : 'Error al consultar los detalles de la cumplimentación del simulacro',

        // EXPIRE
        'IMPSIM_EXPIRE_OK' : 'Se ha vencido la cumplimentación del simulacro correctamente',
        'IMPSIM_EXPIRE_KO' : 'Error al vencer la cumplimentación del simulacro',

        // IMPLEMENT
        'IMPSIM_IMPL_OK' : 'La cumplimentación del simulacro se ha completado correctamente',
        'IMPSIM_IMPL_KO' : 'Error al completar la cumplimentación del simulacro',

        // PORTAL SEEK
        'PRTL_IMPSIM_SEEK_OK' : 'Se han consultado los detalles de la cumplimentación del simulacro del portal correctamente',
        'PRTL_IMPSIM_SEEK_KO' : 'Error al consultar los detalles de la cumplimentación del simulacro del portal',

        // Consulta por ID de Cumplimentación
        'IMPSIMID_NOT_EXST' : 'El id de la cumplimentación del simulacro no existe',
        'IMPSIMID_EXST' : 'El id de la cumplimentación del simulacro existe',
        'IMPSIMID_KO' : 'Error al consultar por el id de la cumplimentación del simulacro',

        // Consulta de cumplimentación única
        'IMPSIM_UNIQ' : 'No se puede eliminar la cumplimentación. Siempre debe existir al menos una cumplimentación del simulacro en el edificio',
        'IMPSIM_NOT_UNIQ' : 'La cumplimentación no es única',

        // Detalles del simulacro del portal
        'PRTL_IMPSIM_SEARCH_OK' : 'Se han consultado los detalles del simulacro del portal correctamente',
        'PRTL_IMPSIM_SEARCH_KO' : 'Error al consultar los detalles del simulacro del portal',

        // Consulta de la asignación entre el plan del simulacro y el edificio
        'BLDSIM_NOT_EXST' : 'El plan al que pertenece el simulacro no está asignado al edificio indicado',
        'BLDSIM_EXST' : 'El plan al que pertenece el simulacro está asignado al edificio indicado',
        'BLDSIM_KO' : 'Error al consultar la asociación entre el plan del simulacro y el edificio',

        // Búsqueda de cumplimentaciones
        'BLDSIMS_SEARCH_OK' : 'Se han consultado las cumplimentaciones del simulacro en el edificio correctamente',
        'BLDSIMS_SEARCH_KO' : 'Error al consultar las cumplimentaciones del simulacro en el edificio',






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
            'BLD_NAM_FRMT' : 'El nombre del edifico sólo puede contener caracteres alfanuméricos, espacios, números y acentos',

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

            // Nombre Planta
            'FLR_NAM_SHRT' : 'El nombre de la planta debe superar los 3 caracteres',
            'FLR_NAM_LRG' : 'El nombre de la planta no debe superar los 40 caracteres',
            'FLR_NAM_FRMT' : 'El nombre de la planta sólo puede contener caracteres alfanuméricos, espacios, números y acentos',

            // Número de Planta
            'NUM_FLOOR_EMPT' : 'El número de planta no puede ser vacío',
            'NUM_FLOOR_LRG': 'El número de planta debe ser un número de 1 o 2 dígitos',
            'NUM_FLOOR_NOT_NUMERIC' : 'El número de planta debe ser un número',

            // Descripción
            'DESC_EMPTY' : 'El campo descripción no puede ser vacío',
            'DESC_FRMT' : 'El campo descripción contiene caracteres no permitidos',

            // Foto Planta
            'FLR_PH_EXT' : 'La extensión de la foto de la planta no está permitida',
            'FLR_PH_FRMT' : 'El nombre de la foto de la planta sólo puede contener letras, números y guiones',

            // Planta ID
            'FLR_ID_EMPT' : 'El ID de planta no puede ser vacío',
            'FLR_ID_NOT_NUMERIC' : 'El ID de planta debe ser numérico',

            // Espacio ID
            'SPC_ID_EMPT' : 'El ID del espacio no puede ser vacío',
            'SPC_ID_NOT_NUMERIC' : 'El ID del espacio debe ser numérico',

            // Nombre del Espacio
            'SPC_NAM_SHRT' : 'El nombre del espacio debe superar los 3 caracteres',
            'SPC_NAM_LRG' : 'El nombre del espacio no debe superar los 40 caracteres',
            'SPC_NAM_FRMT' : 'El nombre del espacio sólo puede contener caracteres alfanuméricos, espacios, números y acentos',

            // Foto Espacio
            'SPC_PH_EXT' : 'La extensión de la foto del espacio no está permitida',
            'SPC_PH_FRMT' : 'El nombre de la foto del espacio sólo puede contener letras, números y guiones',

            // ID DefPlan
            'DFPLAN_ID_EMPT' : 'El ID del Plan no puede ser vacío',
            'DFPLAN_ID_NOT_NUMERIC' : 'El ID del Plan debe ser numérico',

            // Nombre DefPlan
            'DFPLAN_NAM_SHRT' : 'El nombre del plan debe ser superior a 5 caracteres',
            'DEFPLAN_NAM_LRG' : 'El nombre del plan no debe superar los 60 caracteres',
            'DEFPLAN_NAM_FRMT' : 'El nombre del plan contiene caracteres no permitidos',

            // ID DefDoc
            'DFDOC_ID_EMPT' : 'El ID del Documento no puede ser vacío',
            'DFDOC_ID_NOT_NUMERIC' : 'El ID del Documento debe ser numérico',

            // Nombre DefDoc
            'DFDOC_NAM_SHRT' : 'El nombre del documento debe ser superior a 5 caracteres',
            'DFDOC_NAM_LRG' : 'El nombre del documento no debe superar los 50 caracteres',
            'DFDOC_NAM_FRMT' : 'El nombre del documento contiene caracteres no permitidos',

            // Documento visible
            'DFDOC_VISB_EMPT' : 'Se debe indicar si el documento será visible o no',
            'DFDOC_VISB_VALUES' : 'Los valores permitidos para indicar la visibilidad del documento son sí o no',

            // ID DefProc
            'DFPROC_ID_EMPT' : 'El ID del Procedimiento no puede ser vacío',
            'DFPROC_ID_NOT_NUMERIC' : 'El ID del Procedimiento debe ser numérico',

            // Nombre Procedimiento
            'DFPROC_NAM_SHRT' : 'El nombre del procedimiento debe superar los 5 caracteres',
            'DFPROC_NAM_LRG' : 'El nombre del procedimiento no debe superar los 50 caracteres',
            'DFPROC_NAM_FRMT' : 'El nombre del procedimiento contiene caracteres no permitidos',

            // ID DefRoute
            'DFROUTE_ID_EMPT' : 'El ID de la Ruta no puede ser vacío',
            'DEFROUTE_ID_NOT_NUMERIC' : 'El ID de la Ruta debe ser numérico',

            // Nombre DefRoute
            'DFROUTE_NAM_SHRT' : 'El nombre de la ruta debe superar los 5 caracteres',
            'DFROUTE_NAM_LRG' : 'El nombre de la ruta no debe superar los 50 caracteres',
            'DFROUTE_NAM_FRMT' : 'El nombre de la ruta contiene caracteres no permitidos',

            // ID DefFormat
            'DFFRMT_ID_EMPT' : 'El ID de la Formación no puede ser vacío',
            'DEFFRMT_ID_NOT_NUMERIC' : 'El ID de la Formación debe ser numérico',

            // Nombre Formación
            'DFFRMT_NAM_SHRT' : 'El nombre de la formación debe superar los 5 caracteres',
            'DFFRMT_NAM_LRG' : 'El nombre de la formación no debe superar los 50 caracteres',
            'DFFRMT_NAM_FRMT' : 'El nombre de la formación contiene caracteres no permitidos',

            // ID DefSim
            'DFSIM_ID_EMPT' : 'El ID del Simulacro no puede ser vacío',
            'DFSIM_ID_NOT_NUMERIC' : 'El ID del Simulacro debe ser numérico',

            // Nombre Simulacro
            'DFSIM_NAM_SHRT' : 'El nombre del simulacro debe superar los 5 caracteres',
            'DFSIM_NAM_LRG' : 'El nombre del simulacro no debe superar los 50 caracteres',
            'DFSIM_NAM_FRMT' : 'El nombre del simulacro contiene caracteres no permitidos',

            // Fecha asignación
            'BLDPLAN_DATEASSIGN_KO' : 'La fecha de asignación no tiene un formato válido',

            // Fecha implementación
            'BLDPLAN_DATECOMP_KO' : 'La fecha de cumplimentacion no tiene un formato válido',

            // Estado asignación entre Edificio y Plan
            'BLDPLAN_STATE_EMPT' : 'El estado de la asignación no puede ser vacío',
            'BLDPLAN_STATE_KO' : 'El estado no válido. Los estado válidos son Pendiente, Cumplimentado y Vencido',

            // NOMBRE_DOC
            'FILENAME_EMPT' : 'El fichero de la cumplimentación no puede ser vacío',
            'FILENAME_LRG' : 'El nombre del fichero de la cumplimentación no puede superar los 50 caracteres',
            'FILENAME_FRMT' : 'El nombre del fichero de la cumplimentación sólo puede contener letras, números y guiones',
            'FILENAME_EXT' : 'El fichero de la cumplimentación debe estar en formato pdf',

            // ID Procedimiento
            'IMPPROC_ID_EMPT' : 'El id de la cumplimentación del procedimiento no puede ser vacío',
            'IMPPROC_ID_NOT_NUMERIC' : 'El id de la cumplimentación del procedimiento debe ser numérico',

            // ID Ruta
            'IMPROUTE_ID_EMPT' : 'El id de la cumplimentación de la ruta no puede ser vacío',
            'IMPROUTE_ID_NOT_NUMERIC' : 'El id de la cumplimentación de la ruta debe ser numérico',

            // Fecha Planificación
            'PLANNING_DATE_EMPT' : 'La fecha de planificación no puede ser vacía',
            'PLANNING_DATE_KO' : 'La fecha de planificación introducida tiene un formato incorrecto',
            'PLANNING_DATE_PAST' : 'La fecha de planificación introducida es una fecha pasada',

            // Fecha Vencimiento
            'DATEEXPIRE_KO' : 'La fecha de vencimiento introducida tiene un formato incorrecto',

            // Destinatarios
            'RECIPIENTS_EMPT' : 'El campo destinatarios no puede ser vacío',
            'RECIPIENTS_LRG' : 'El campo destinatarios no puede superar los 200 caracteres',
            'RECIPIENTS_FRMT' : 'El campo destinatarios contiene caracteres no permitidos',

            // URL
            'URL_FRMT' : 'La URL del recurso introducido tiene un formato incorrecto',
            'URL_LRG' : 'La longitud de la URL no debe superar los 200 caracteres',

            // ID Formación
            'IMPFORMAT_ID_EMPT' : 'El id de la cumplimentación de la formación no puede ser vacío',
            'IMPFORMAT_ID_NOT_NUMERIC' : 'El id de la cumplimentación de la formación debe ser numérico',

            // Fecha Planificación Inicial
            'START_PLANNING_DATE_KO' : 'La fecha de planificación inicial tiene un formato incorrecto',

            // Fecha Planificación Final
            'END_PLANNING_DATE_KO' : 'La fecha de planificación final tiene un formato incorrecto',

            // Fecha Vencimiento Inicial
            'START_DATEEXPIRE_KO' : 'La fecha de vencimiento inicial tiene un formato incorrecto',

            // Fecha Vencimiento Final
            'END_DATEEXPIRE_KO' : 'La fecha de vencimiento final tiene un formato incorrecto',

            // Fecha Cumplimentación Inicial
            'START_DATECOMP_KO' : 'La fecha de cumplimentación inicial tiene un formato incorrecto',

            // Fecha Cumplimentación Final
            'END_DATECOMP_KO' : 'La fecha de cumplimentación final tiene un formato incorrecto',





    // INTERFAZ
        // HEADER
        'i18n-idioma' : 'Idioma',
        'i18n-login' : 'Iniciar Sesión',
        'i18n-admin' : 'Panel de Administración',
        'i18n-logout' : 'Desconectar',

        // PORTAL_COUNTRIES
        'i18n-app-welcome' : '¡Bienvenido a SG2P!',
        'i18n-select-city' : 'Selecciona una ciudad donde consultar Edificios',
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
        'i18n-admin-plans' : 'Administrar Planes',
        'i18n-manage-plans' : 'Gestionar Planes',

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
        'i18n-edificio_id' : 'ID Edificio',
        'i18n-responsable' : 'Responsable',
        'i18n-ciudad' : 'Ciudad',
        'i18n-buildings-empty' : 'No se han encontrado edificios',
        'i18n-add-building' : 'Añadir Edificio',
        'i18n-calle' : 'Calle',
        'i18n-provincia' : 'Provincia',
        'i18n-codigo_postal' : 'Código Postal',
        'i18n-fax' : 'Fax',
        'i18n-del-building-confirm' : '¿Está seguro que desea eliminar este edificio? La acción no será reversible',
        'i18n-edit-building' : 'Editar Edificio',
        'i18n-search-building' : 'Buscar Edificio',
        'i18n-view-floors' : 'Ver Plantas',
        'i18n-building-details' : 'Detalles del Edificio',
        'i18n-foto_edificio' : 'Foto del Edificio',

        // FlOORS VIEWS
        'i18n-floors' : 'Plantas',
        'i18n-planta_id' : 'ID Planta',
        'i18n-num_planta' : 'Número de Planta',
        'i18n-floors-empty' : 'No se han encontrado plantas',
        'i18n-add-floor' : 'Añadir Planta',
        'i18n-descripcion' : 'Descripción',
        'i18n-details-floor' : 'Detalles de la Planta',
        'i18n-del-floor-confirm' : '¿Está seguro de que desea eliminar esta planta? La acción no será reversible',
        'i18n-search-floor' : 'Buscar Plantas',
        'i18n-edit-floor' : 'Editar Planta',
        'i18n-view-spaces' : 'Ver Espacios',
        'i18n-foto_planta' : 'Foto de la Planta',

        // SPACES VIEWS
        'i18n-spaces' : 'Espacios',
        'i18n-espacio_id' : 'ID Espacio',
        'i18n-spaces-empty' : 'No se han encontrado espacios',
        'i18n-add-space' : 'Añadir Espacio',
        'i18n-foto_espacio' : 'Foto del Espacio',
        'i18n-del-space-confirm' : '¿Está seguro de que desea eliminar este espacio? La acción no será reversible',
        'i18n-details-space' : 'Detalles del Espacio',
        'i18n-search-space' : 'Buscar Espacios',
        'i18n-edit-space' : 'Editar Espacio',

        // PORTAL VIEWS
        'i18n-resp-info' : 'Consulta la información relativa al responsable del edificio',
        'i18n-contact' : 'Contacto',
        'i18n-address' : 'Dirección',
        'i18n-details-manager' : 'Detalles del Responsable',
        'i18n-floors-info' : 'Consulta información de las plantas y de los espacios del edificio',
        'i18n-select-building' : 'Selecciona un Edificio',
        'i18n-select-floor' : 'Selecciona una Planta',
        'i18n-portal-floors-empty' : 'Este edificio no tiene plantas registradas todavía',
        'i18n-piso' : 'Piso número: ',
        'i18n-floor-spaces' : 'Espacios de la Planta',
        'i18n-prevent_plans' : 'Planes de Prevención',
        'i18n-prevent_plans-info' : 'Consulta la información de los Planes de Prevención del Edificio',

        // DEF_PLANS VIEW
        'i18n-def-plans' : 'Definiciones de Planes',
        'i18n-def-plans-empty' : 'No se han encontrado definiciones de planes',
        'i18n-plan_id' : 'ID Plan',
        'i18n-del-def-plan-confirm' : '¿Está seguro que desea eliminar la definición de este plan? La acción no será reversible',
        'i18n-search-def-plan' : 'Buscar Def. de Planes',
        'i18n-showCurrent-defPlan' : 'Detalles de la Def. del Plan',
        'i18n-show-plans-defdocs' : 'Def. de Documentos',
        'i18n-show-plans-defprocs' : 'Def. de Procedimientos',
        'i18n-show-plans-defroutes' : 'Def. de Rutas',
        'i18n-show-plans-deformats' : 'Def. de Formaciones',
        'i18n-show-plans-defsims' : 'Def. de Simulacros',
        'i18n-edit-defPlan' : 'Edit Def. del Plan',
        'i18n-show-plans-bldplans' : 'Edificios Asignados',

        // DEF_DOCS VIEW
        'i18n-def-docs' : 'Definiciones de Documentos',
        'i18n-visible' : 'Visible',
        'i18n-def-docs-empty' : 'No se han encontrado definiciones de documentos',
        'i18n-add-defDoc' : 'Definir Documento',
        'i18n-yes': 'Sí',
        'i18n-no' : 'No',
        'i18n-del-def-doc-confirm' : '¿Está seguro que desea eliminar la definición de este documento? El cambio no será reversible',
        'i18n-documento_id' : 'ID Documento',
        'i18n-search-defDoc' : 'Buscar Def. de Documentos',
        'i18n-edit-defDoc' : 'Editar Def. del Documento',
        'i18n-current-defDoc' : 'Detalles de la Def. del Documento',

        // DEF_PROCS VIEW
        'i18n-def-procs' : 'Definiciones de Procedimientos',
        'i18n-procedimiento_id' : 'ID Procedimiento',
        'i18n-def-procs-empty' : 'No se han encontrado definiciones de procedimientos',
        'i18n-add-defProc' : 'Definir Procedimiento',
        'i18n-del-def-proc-confirm' : '¿Está seguro que desea eliminar la definición de este procedimiento? La acción no será reversible',
        'i18n-current-defProc' : 'Detalles de la Def. del Procedimiento',
        'i18n-search-defProc' : 'Buscar Def. de Procedimientos',
        'i18n-edit-defProc' : 'Editar Def. del Procedimiento',

        // DEF_ROUTES VIEW
        'i18n-def-routes' : 'Definiciones de Rutas',
        'i18n-ruta_id' : 'ID Ruta',
        'i18n-def-routes-empty' : 'No se han encontrado definiciones de rutas',
        'i18n-add-defRoute' : 'Definir Ruta',
        'i18n-del-def-route-confirm' : '¿Está seguro que desea eliminar la definición de esta ruta? El cambio no será reversible',
        'i18n-current-defRoute' : 'Detalles de la Def. de la Ruta',
        'i18n-search-defRoute' : 'Buscar Def. de Rutas',
        'i18n-edit-defRoute' : 'Editar Def. de la Ruta',

        // DEF_FORMATS VIEW
        'i18n-def-formats' : 'Definiciones de Formaciones',
        'i18n-formacion_id' : 'ID Formación',
        'i18n-def-formats-empty' : 'No se han encontrado definiciones de formaciones',
        'i18n-add-defFormat' : 'Definir Formación',
        'i18n-del-def-format-confirm' : '¿Está seguro que desea eliminar la definición de esta formación? El cambio no será reversible',
        'i18n-current-defFormat' : 'Detalles de al Def. de la Formación',
        'i18n-search-defFormat' : 'Buscar Def. de Formaciones',
        'i18n-edit-defFormat' : 'Editar Def. de la Formación',

        // DEF_SIMS VIEW
        'i18n-def-sims' : 'Definiciones de Simulacros',
        'i18n-simulacro_id' : 'ID Simulacro',
        'i18n-def-sims-empty' : 'No se han encontrado definiciones de simulacros',
        'i18n-add-defSim' : 'Definir Simulacro',
        'i18n-del-def-sim-confirm' : '¿Está seguro que desea eliminar la definición de este simulacro? El cambio no será reversible',
        'i18n-current-defSim' : 'Detalles de la def. del Simulacro',
        'i18n-search-defSim' : 'Buscar Def. de Simulacros',
        'i18n-edit-defSim' : 'Editar Def. del Simulacro',

        // BUILDINGS_PLANS
        'i18n-assign-bldplan' : 'Edificios Asignados',
        'i18n-building' : 'Edificio',
        'i18n-date_assign' : 'Fecha Asignación',
        'i18n-state' : 'Estado',
        'i18n-date_comp' : 'Fecha Cumplimentación',
        'i18n-pendiente' : 'PENDIENTE',
        'i18n-cumplimentado' : 'CUMPLIMENTADO',
        'i18n-vencido' : 'VENCIDO',
        'i18n-bldplan-empty' : 'No se han encontrado asignaciones con edificios',
        'i18n-add-buildPlan' : 'Asignar Edificios',
        'i18n-del-bldplan-confirm' : '¿Está seguro que desea eliminar esta asignación? El cambio no será reversible',
        'i18n-expire' : 'Vencer',
        'i18n-expire_all' : 'Vencer TODAS',
        'i18n-expireAll-bldplan-confirm' : '¿Está seguro que desea vencer TODAS las asignaciones de este Plan? El cambio no será reversible',
        'i18n-nombre_edificio' : 'Nombre Edificio',
        'i18n-date_expire' : 'Fecha Vencimiento',

        // PLANS
        'i18n-plan' : 'Plan',
        'i18n-list-plans-empty' : 'No se encontraron asignaciones de Planes',
        'i18n-list-plans' : 'Listado de Planes',
        'i18n-documentos' : 'Documentos',
        'i18n-procedimientos' : 'Procedimientos',
        'i18n-rutas' : 'Rutas',
        'i18n-formaciones' : 'Formaciones',
        'i18n-simulacros' : 'Simulacros',
        'i18n-info_plan' : 'Información del Plan',
        'i18n-elements_plan' : 'Elementos del Plan',

        // IMP_DOCS
        'i18n-show-impdocs' : 'Ver Cumplimentaciones',
        'i18n-implement' : 'Cumplimentar',
        'i18n-imp-docs-empty' : 'No se han encontrado cumplimentaciones del documento',
        'i18n-nombre_doc' : 'Nombre Documento',
        'i18n-impdocs' : 'Cumplimentaciones del Documento',
        'i18n-info_doc' : 'Información del Documento',
        'i18n-cump_id' : 'ID Cumplimentacion',
        'i18n-add-implements' : 'Añadir Cumplimentaciones',
        'i18n-file_doc' : 'Fichero de la Cumplimentación',
        'i18n-nombre_defdoc' : 'Nombre del Documento',
        'i18n-add-implement-confirm' : '¿Está seguro que desea añadir la siguiente cumplimentación?',
        'i18n-del-imp-doc-confirm' : '¿Está seguro que desea eliminar la cumplimentación de este documento? El cambio no será reversible',
        'i18n-expire-impdoc-confirm' : '¿Está seguro que desea vencer la cumplimentación de este documento? El cambio no será reversible',
        'i18n-cump-doc' : 'Cumplimentar Documento',
        'i18n-actual-imp' : 'Cumplimentación Actual',
        'i18n-imp-details' : 'Detalles de la Cumplimentación',
        'i18n-search-imps' : 'Buscar Cumplimentaciones',

        // IMP_PROCS
        'i18n-impprocs' : 'Cumplimentaciones del Procedimiento',
        'i18n-imp-procs-empty' : 'No se han encontrado cumplimentaciones del procedimiento',
        'i18n-info_proc' : 'Información del Procedimiento',
        'i18n-del-imp-proc-confirm' : '¿Está seguro que desea eliminar la cumplimentación de este procedimiento? El cambio no será reversible',
        'i18n-expire-impproc-confirm' : '¿Está seguro que desea vencer la cumplimentación de este procedimiento? El cambio no será reversible',
        'i18n-cump-proc' : 'Cumplimentar Procedimiento',

        // IMP_ROUTES
        'i18n-improutes' : 'Cumplimentaciones de la Ruta',
        'i18n-nombre_planta' : 'Nombre Planta',
        'i18n-imp-routes-empty' : 'No se han encontrado cumplimentaciones de la ruta',
        'i18n-info_route' : 'Información de la Ruta',
        'i18n-expire-improute-confirm' : '¿Está seguro que desea vencer la cumplimentación de esta ruta? El cambio no será reversible',
        'i18n-cump-route' : 'Cumplimentar Ruta',
        'i18n-del-imp-route-confirm' : '¿Está seguro que desea eliminar la cumplimentación de esta ruta? El cambio no será reversible',
        'i18n-start_date_comp' : 'Fecha Cumplimentación Inicial',
        'i18n-end_date_comp' : 'Fecha Cumplimentación Final',

        // IMP_FORMATS
        'i18n-impformats' : 'Cumplimentaciones de la Formación',
        'i18n-planning_date' : 'Fecha Planificación',
        'i18n-imp-formats-empty' : 'No se han encontrado cumplimentaciones de la formación',
        'i18n-info_format' : 'Información de la Formación',
        'i18n-del-imp-format-confirm' : '¿Está seguro que desea eliminar la cumplimentación de esta formación? El cambio no será reversible',
        'i18n-expire-impformat-confirm' : '¿Está seguro que desea vencer la cumplimentación de esta formación? El cambio no será reversible',
        'i18n-current_planning_date' : 'Fecha de Planificación Actual',
        'i18n-url_recurso' : 'URL Recurso',
        'i18n-destinatarios' : 'Destinatarios',
        'i18n-enlace_url' : 'Acceder al Recurso',
        'i18n-cump-form' : 'Cumplimentar Formación',

        // IMP_SIMS
        'i18n-impsim' : 'Cumplimentaciones del Simulacro',
        'i18n-imp-sims-empty' : 'No se han encontrado cumplimentaciones del simulacro',
        'i18n-info_sim' : 'Información del Simulacro',
        'i18n-del-imp-sim-confirm' : '¿Está seguro que desea eliminar la cumplimentación de este simulacro? El cambio no será reversible',
        'i18n-expire-impsim-confirm' : '¿Está seguro que desea vencer la cumplimentación de este simulacro? El cambio no será reversible',
        'i18n-cump-sim' : 'Cumplimentar Simulacro',
        'i18n-start_planning_date' : 'Fecha Planificación Inicial',
        'i18n-end_planning_date' : 'Fecha Planificación Final',
        'i18n-start_date_expire' : 'Fecha Vencimiento Inicial',
        'i18n-end_date_expire' : 'Fecha Vencimiento Final',



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
            'm-num_planta' : ' Número de Planta ',
            'm-foto_planta' : ' Foto Planta ',
            'm-descripcion' : ' Descripción ',
            'm-planta_id' : ' ID Planta ',
            'm-espacio_id' : ' ID Espacio ',
            'm-documento_id' : ' ID Documento ',
            'm-plan_id' : ' ID Plan ',
            'm-procedimiento_id' : ' ID Procedimiento ',
            'm-ruta_id' : ' ID Ruta ',
            'm-formacion_id' : ' ID Formacion ',
            'm-simulacro_id' : ' ID Simulacro ',
            'm-buildings' : ' Edificios ',
            'm-nombre_edificio' : ' Nombre Edificio ',
            'm-nombre_doc' : ' Fichero Cumplimentacion ',
            'm-nombre_doc_field' : ' Nombre Documento ',
            'm-cumplimentacion_id' : ' ID Cumplimentación ',
            'm-nombre_planta' : ' Nombre Planta ',
            'm-url_recurso' : ' URL Recurso ',
            'm-fecha_planificacion' : ' Fecha Planificación ',
            'm-destinatarios' : ' Destinatarios ',

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
            'i18n-chars-not_allow' : 'contiene caracteres no permitidos',
            'i18n-only-letters-numbers-hyphen' : 'sólo puede contener letras, números y guiones',
            'i18n-filename-search-format' : 'Sólo puede contener letras, números, guiones, y sólo admite extensión .pdf',
            'i18n-url-format' : 'contiene caracteres no permitidos o se está especificando un protocolo distinto a http, https o ftp',
            'i18n-fecha-menor-actual' : 'debe ser mayor o igual a la fecha actual',
}
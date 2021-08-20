

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
        'IMPDOC_ADD_KO' : 'Error al crear las implementaciones de los documentos',
        'IMPDOC_DEL_KO' : 'Error al eliminar las implementaciones de los documentos',
        'IMPPROC_ADD_KO' : 'Error al crear las implementaciones de los procedimientos',
        'IMPPROC_DEL_KO' : 'Error al eliminar las implementaciones de los procedimientos',
        'IMPROUTE_ADD_KO' : 'Error al crear las implementaciones de las rutas',
        'IMPROUTE_DEL_KO' : 'Error al eliminar las implementaciones de las rutas',
        'IMPFRMT_ADD_KO' : 'Error al crear las implementaciones de las formaciones',
        'IMPFRMT_DEL_KO' : 'Error al eliminar las implementaciones de las formaciones',
        'BLDPLAN_IMPADD_OK' : 'Se han creado las implementaciones correctamente',
        'IMPSIM_ADD_KO' : 'Error al crear las implementaciones de los simulacros',
        'IMPSIM_DEL_KO' : 'Error al eliminar las implementaciones de los simulacros',
        'BLD_IMPDEL_OK' : 'Se han eliminado las implementaciones correctamente',

        // Búsqueda de Edificios candidatos
        'BLDPLAN_CANDIDATES_EMPT' : 'No hay edificios asignables al plan',
        'BLDPLAN_CANDIDATES_OK' : 'Búsqueda de edificios asignables al plan Ok',
        'BLDPLAN_CANDIDATES_KO' : 'Error al recuperar los edificios asignables al plan',



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
            'BLDPLAN_DATEIMPL_KO' : 'La fecha de implementación no tiene un formato válido',

            // Estado asignación entre Edificio y Plan
            'BLDPLAN_STATE_EMPT' : 'El estado de la asignación no puede ser vacío',
            'BLDPLAN_STATE_KO' : 'El estado no válido. Los estado válidos son Pendiente, Implementado y Vencido',




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
        'i18n-date_impl' : 'Fecha Implementación',
        'i18n-pendiente' : 'PENDIENTE',
        'i18n-implementado' : 'IMPLEMENTADO',
        'i18n-vencido' : 'VENCIDO',
        'i18n-bldplan-empty' : 'No se han encontrado asignaciones con edificios',
        'i18n-add-buildPlan' : 'Asignar Edificios',
        'i18n-del-bldplan-confirm' : '¿Está seguro que desea eliminar esta asignación? El cambio no será reversible',
        'i18n-expire' : 'Vencer',
        'i18n-expire_all' : 'Vencer TODAS',
        'i18n-expireAll-bldplan-confirm' : '¿Está seguro que desea vencer TODAS las asignaciones de este Plan? El cambio no será reversible',

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
            'm-buildings[]' : ' Edificios ',

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
}
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


    // DEF_PLAN

        // SEARCH
        'DFPLAN_SEARCH_OK' : 'A búsqueda de definicións de plans realizouse correctamente',
        'DFPLAN_SEARCH_KO' : 'Error ó buscar definicións de plans',

        // ADD
        'DFPLAN_ADD_OK' : 'A definición do plan engadiuse correctamente',
        'DFPLAN_ADD_KO' : 'Error ó engadir a definición do plan',

        // DELETE
        'DFPLAN_DEL_OK' : 'A definición do plan eliminouse correctamente',
        'DFPLAN_DEL_KO' : 'Error ó eliminar a definición do plan',

        // SEEK
        'DFPLAN_SEEK_OK' : 'A consulta dos detalles da definición do plan realizouse correctamente correctamente',
        'DFPLAN_SEEK_KO' : 'Error ó consultar os detalles da definición do plan',

        // EDIT
        'DFPLAN_EDT_OK' : 'A definición do plan modificouse correctamente',
        'DFPLAN_EDT_KO' : 'Produciuse un erro ó modificar a definición do plan',

        // Búsqueda por nombre de plan
        'DFPLAN_NAM_NOT_EXST': 'O nome do plan non existe',
        'DFPLAN_NAM_EXST' : 'O nome do plan existe',
        'DFPLAN_NAM_KO' : 'Error ó consultar por nome do plan',

        // Búsqueda por ID de Plan
        'DFPLANID_NOT_EXST' : 'A definición do plan non existe',
        'DFPLANID_EXST' : 'A definición do plan existe',
        'DFPLANID_KO' : 'Error ó consultar por ID de Plan',

        // Búsqueda de edificios asignados
        'DFPLAN_BLD_EXST' : 'Non se pode eliminar a definición do plan mentres teña edificios asignados',
        'DFPLAN_BLD_NOT_EXST' : 'A definición do plan non está asignada a ningún edificio',
        'DFPLAN_BLD_KO' : 'Fallou a consulta dos edificios asignados',

        // Búsqueda de documentos asociados
        'DFPLAN_DOC_EXST' : 'Non se pode eliminar a definición do plan mentres ten asociadas definicións de documentos',
        'DFPLAN_DOC_NOT_EXST' : 'A definición do plan non ten definicións de documentos asociadas',
        'DFPLAN_DOC_KO' : 'Fallou a consulta das definicións de documentos asociados',

        // Búsqueda de procedimientos asociados
        'DFPLAN_PROC_EXST' : 'Non se pode eliminar a definición do plan mentres ten definicións de procedemento asociadas',
        'DFPLAN_PROC_NOT_EXST' : 'A definición do plan non ten definicións de procedemento asociadas',
        'DFPLAN_PROC_KO' : 'Produciuse un erro ao consultar as definicións de procedemento asociadas',

        // Búsqueda de rutas asociadas
        'DFPLAN_ROUTE_EXST' : 'Non se pode eliminar a definición do plan mentres teña asociadas definicións de ruta',
        'DFPLAN_ROUTE_NOT_EXST' : 'A definición do plan non ten definicións de ruta asociadas',
        'DFPLAN_ROUTE_KO' : 'Erro ao consultar as definicións das rutas asociadas',

        // Búsqueda de formaciones asociados
        'DFPLAN_FRMT_EXST' : 'Non se pode eliminar a definición do plan mentres teña asociadas definicións de adestramento',
        'DFPLAN_FRMT_NOT_EXST' : 'A definición do plan non ten definicións de formacións asociadas',
        'DFPLAN_FRMT_KO' : 'Erro ao consultar definicións de formacións asociadas',

        // Búsqueda de simulacros asociados
        'DFPLAN_SIM_EXST' : 'Non se pode eliminar a definición do plan mentres teña asociadas definicións de perforación',
        'DFPLAN_SIM_NOT_EXST' : 'A definición do plan non ten definicións de exercicio asociadas',
        'DFPLAN_SIM_KO' : 'Fallou a consulta de definicións falsas',

    // DEF_DOC

        // SEARCH
        'DFDOC_SEARCH_OK' : 'Búsqueda de definicións de documentos OK',
        'DFDOC_SEARCH_KO' : 'Error ó buscar definicións de documentos',

        // ADD
        'DFDOC_ADD_OK' : 'A definición do documento engadiuse correctamente',
        'DFDOC_ADD_KO' : 'Erro ao engadir a definición do documento',

        // SEEK
        'DFDOC_SEEK_OK' : 'Éxito ao obter os detalles da def. do documento',
        'DFDOC_SEEK_KO' : 'Non se puideron obter os detalles da def. do documento',

        // DELETE
        'DFDOC_DEL_OK' : 'A definición do documento eliminouse correctamente',
        'DFDOC_DEL_KO' : 'Non se puido eliminar a definición do documento',

        // EDIT
        'DFDOC_EDT_OK' : 'A definición do documento modificouse correctamente',
        'DFDOC_EDT_KO' : 'Error ó modificar a definición do documento',

        // Búsqueda por nombre de documento
        'DFDOC_NAME_EXST' : 'Xa existe para este plan unha definición de documento co nome indicado',
        'DFDOC_NAME_NOT_EXST' : 'Non hai ningunha definición de documento co nome indicado neste plan',
        'DFDOC_NAME_KO' : 'Fallou a consulta polo nome do documento',

        // Búsqueda por ID de Documento
        'DFDOCID_EXST' : 'O ID do documento existe',
        'DFDOCID_NOT_EXST' : 'A definición do documento indicado non existe',
        'DFDOCID_KO' : 'Produciuse un erro na consulta polo ID do documento',

        // Búsqueda de implementaciones de documentos
        'DFDOC_IMPL_EXST' : 'Non se pode eliminar a def. do documento mentres teña implementacións en edificios',
        'DFDOC_IMPL_NOT_EXST' : 'A def. do documento indicada non ten implementacións en edificios',
        'DFDOC_IMPL_KO' : 'Produciuse un erro ao consultar as implementacións de documentos',

    // DEF_PROC

        // SEARCH
        'DFPROC_SEARCH_OK' : 'A búsqueda de definicións de procedementos realizouse correctamente',
        'DFPROC_SEARCH_KO' : 'Error ó buscar definicións de procedementos',

        // ADD
        'DFPROC_ADD_OK' : 'A definición do procedemento engadiuse correctamente',
        'DFPROC_ADD_KO' : 'Error ó engadir a definición do procedemento',

        // DELETE
        'DFPROC_DEL_OK' : 'A definición do procedemento eliminouse correctamente',
        'DFPROC_DEL_KO' : 'Non se puido eliminar a definición do procedemento',

        // SEEK
        'DFPROC_SEEK_OK' : 'Éxito na obtención dos detalles da definición do procedemento',
        'DFPROC_SEEK_KO' : 'Non se puideron consultar os detalles da definición do procedemento',

        // EDIT
        'DFPROC_EDT_OK' : 'A definición do procedemento modificouse correctamente',
        'DFPROC_EDT_KO' : 'Erro ó modificar a definición do procedemento',

        // Búsqueda por ID de Procedimiento
        'DFPROCID_NOT_EXST' : 'A definición do procedemento indicado non existe',
        'DFPROCID_EXST' : 'A definición do procedemento indicado existe',
        'DFPROCID_KO' : 'Fallou a consulta polo procedemento de identificación',

        // Búsqueda de implementaciones de procedimientos
        'DFPROC_IMPL_EXST' : 'Non pode eliminar a definición do procedemento mentres teña implementacións en edificios',
        'DFPROC_IMPL_NOT_EXST' : 'A definición do procedemento non ten implementacións en edificios',
        'DFPROC_IMPL_KO' : 'Erro ao consultar as implementacións de procedemento',

        // Búsqueda por nombre de procedimiento
        'DFPROC_NAME_EXST' : 'Xa existe unha definción de procedemento co nome indicado neste plan',
        'DFPROC_NAME_NOT_EXST' : 'Non existe unha definición de procedemento co nome indicado neste plan',
        'DFPROC_NAME_KO' : 'Error ó consultar por nome de procedemento',

    // DEF_ROUTE

        // SEARCH
        'DFROUTE_SEARCH_OK' : 'A búsqueda de definicións de rutas realizouse correctamente',
        'DFROUTE_SEARCH_KO' : 'Erro ó buscar definicións de rutas',

        // ADD
        'DFROUTE_ADD_OK' : 'A definición da ruta engadiuse correctamente',
        'DFROUTE_ADD_KO' : 'Erro ó engadir a definición da ruta',

        // SEEK
        'DFROUTE_SEEK_OK' : 'Consultouse os detalles da definición da ruta correctamente',
        'DFROUTE_SEEK_KO' : 'Erro ó consultar os detalles da definición da ruta',

        // DELETE
        'DFROUTE_DEL_OK' : 'A definición da ruta eliminouse correctamente',
        'DFROUTE_DEL_KO' : 'Erro ó eliminar a definición da ruta',

        // EDIT
        'DFROUTE_EDT_OK' : 'A definición da ruta modificouse correctamente',
        'DFROUTE_EDT_KO' : 'Erro ó modificar a definición da ruta',

        // Búsqueda de implementaciones de rutas en plantas
        'DFROUTE_IMPL_EXST' : 'Non se pode eliminar a definición da ruta mentras existan implementacións nalgunha planta',
        'DFROUTE_IMPL_NOT_EXST' : 'A definición da ruta non ten implementacións en plantas',
        'DFROUTE_IMPL_KO' : 'Erro ó consultar implementacións da ruta en plantas',

        // Búsqueda por ID de ruta
        'DFROUTEID_NOT_EXST' : 'A definición da ruta indicada non existe',
        'DFROUTEID_EXST' : 'A definición da ruta indicada existe',
        'DFROUTEID_KO' : 'Error ó consultar por ID de Ruta',

        // Búsqueda por nombre de ruta
        'DFROUTE_NAME_EXST' : 'Xa existe unha definición de ruta co nome indicado neste plan',
        'DFROUTE_NAME_NOT_EXST' : 'Non existe unha definición de ruta co nome indicado neste plan',
        'DFROUTE_NAME_KO' : 'Erro ó consultar por nome de ruta',

    // DEF_FORMAT

        // SEARCH
        'DFFRMT_SEARCH_OK' : 'A búsqueda de definicións de formacións realizouse correctamente',
        'DFFRMT_SEARCH_KO' : 'Erro ó buscar definicións de formacións',

        // ADD
        'DFFRMT_ADD_OK' : 'A definición da formación engadiuse correctamente',
        'DFFRMT_ADD_KO' : 'Erro ó engadir a definición da formación',

        // SEEK
        'DFFRMT_SEEK_OK' : 'Consultáronse os detalles da definición da formación correctamente',
        'DFFRMT_SEEK_KO' : 'Erro ó consultar os detalles da definición da formación',

        // DELETE
        'DFFRMT_DEL_OK' : 'Eliminouse a definiciónd da formación correctamente',
        'DFFRMT_DEL_KO' : 'Erro ó eliminar a definición da formación',

        // EDIT
        'DFFRMT_EDT_OK' : 'A definición da formación modificouse correctamente',
        'DFFRMT_EDT_KO' : 'Erro ó modificar a definición da formación',

        // Búsqueda por nombre
        'DFFRMT_NAME_EXST' : 'Xa existe unha definición de formación co nome indicado neste plan',
        'DFFRMT_NAME_NOT_EXST' : 'Non existe unha definición de formación co nome indicado neste plan',
        'DFFRMT_NAME_KO' : 'Erro ó consultar por nome de definición de formación',

        // Búsqueda por ID de Formación
        'DFFRMTID_NOT_EXST' : 'A definición da información indicada non existe',
        'DFFRMTID_EXST' : 'A definición da formación indicada existe',
        'DFFRMTID_KO' : 'Erro ó consultar por ID da Formación',

        // Búsqueda de implementacione de la formación en edificios
        'DFFRMT_IMPL_EXST' : 'Non se pode eliminar a definición da formación mentras teña implementacións en edificios',
        'DFFRMT_IMPL_NOT_EXST' : 'A definición da formación non ten implementacións en edificios',
        'DFFRMT_IMPL_KO' : 'Erro ó consultar implementacións en edificios',

    // DEF_SIM

        // SEARCH
        'DFSIM_SEARCH_OK' : 'A búsqueda de definicións de simulacros realizouse correctamente',
        'DFSIM_SEARCH_KO' : 'Erro ó buscar definicións de simulacros',

        // ADD
        'DFSIM_ADD_OK' : 'A definición do simulacro engadiuse correctamente',
        'DFSIM_ADD_KO' : 'Erro ó engadir a definición do simulacro',

        // SEEK
        'DFSIM_SEEK_OK' : 'Consultáronse os detalles da definición do simulacro correctamente',
        'DFSIM_SEEK_KO' : 'Erro ó consultar os detalles da definición do simulacro',

        // DELETE
        'DFSIM_DEL_OK' : 'A definición do simulacro eliminouse correctamente',
        'DFSIM_DEL_KO' : 'Erro ó eliminar a definición do simulacro',

        // EDIT
        'DFSIM_EDT_OK' : 'A definició do simulacro modificouse correctamente',
        'DFSIM_EDT_KO' : 'Erro ó modificar a definición do simulacro',

        // Búsqueda por ID de Simulacro
        'DFSIMID_NOT_EXST' : 'A definición do simulacro indicada non existe',
        'DFSIMID_EXST' : 'A definición do simulacro indicada existe',
        'DFSIMID_KO' : 'Erro ó consultar por ID de Simulacro',

        // Consulta de implementaciones de simulacros
        'DFSIM_IMPL_EXST' : 'Non se pode eliminar a definición do simulacro mentras teña implementacións en edificios',
        'DFSIM_IMPL_NOT_EXST' : 'A definición do simulacro non ten implementacións en edificios',
        'DFSIM_IMPL_KO' : 'Erro ó consultar as implementacións do simulacro',

        // Búsqueda por nombre de simulacro
        'DFSIM_NAME_EXST' : 'Xa existe unha definición de simulacro co nome indicado neste plan',
        'DFSIM_NAME_NOT_EXST' : 'Non existe unha definición de simulacro co nome indiccado neste plan',
        'DFSIM_NAME_KO' : 'Erro ó consultar por nome de simulacro',

    // BUILD_PLAN

        // SEARCH
        'BLDPLAN_SEARCH_OK' : 'A búsqueda dos edificios asignados o plan realizouse correctamente',
        'BLDPLAN_SEARCH_KO' : 'Erro ó recuperar os edificios asignados o plan',

        // ADD
        'DFPLAN_ADD_NOT_DOCS' : 'O plan debe ter, polo menos, unha definición de documento pra poder ser asignado',
        'DFROUTE_EXST_FLRS_NOT_EXST' : 'O plan contén definicións de rutas e algún dos edificios non teñen plantas asociadas',
        'BLDPLAN_ADD_OK' : 'Asignáronse os edificios indicados ó plan correctamente',
        'BLDPLAN_ADD_KO' : 'Erro ó crear as asignacións entre os edificios e o plan',

        // SEEK
        'BLDPLAN_SEEK_OK' : 'Consultáronse os detalles da asignación entre o Edificio e o Plan indicados correctamente',
        'BLDPLAN_SEEK_KO' : 'Erro ó consultar os detalles da asignación entre o Edificio e o Plan indicados',

        // DELETE
        'BLDPLAN_DEL_OK' : 'Eliminouse con éxito a asignación entre o Edificio e o Plan indicados',
        'BLDPLAN_DEL_KO' : 'Erro ó eliminar a asignación entre o Edificio e o Plan',

        // VENCER ASIGNACIONES
        'BLDPLAN_EDTSTATE_OK' : 'Vencéronse as asignacións correctamente',
        'BLDPLAN_EDTSTATE_KO' : 'Erro ó vencer as asignacións',
        'BLDPLAN_ALREADY_EXPIRED' : 'A asignación indicada xa se atopa vencida',

        // Búsqueda de asignaciones Activas
        'BLDPLAN_ASSIGN_ACTIVES_NOT_EXST' : 'O plan indicado non ten asignacións activas',
        'BLDPLAN_ASSIGN_ACTIVES_EXST' : 'O plan indicado ten asignacións activas',
        'BLDPLAN_ASSIGN_ACTIVES_KO' : 'Erro ó consultar as asignacións activas do plan',

        // Vencer Implementaciones
        'IMPDOC_EDTSTATE_KO' : 'Erro ó vencer as implementacións dos documentos',
        'IMPPROC_EDTSTATE_KO' : 'Erro ó vencer as implementacións dos procedementos',
        'IMPROUTE_EDTSTATE_KO' : 'Erro ó vencer as implementacións das rutas',
        'IMPFRMT_EDTSTATE_KO' : 'Erro ó vencer as implementacións das formacións',
        'IMPSIM_EDTSTATE_KO' : 'Erro ó vencer as implementacións dos simulacros',

        // Directorios
        'BLDPLAN_DIRPLAN_KO' : 'Erro ó crear o directorio raíz do Plan',
        'BLDPLAN_DIRBLD_KO' : 'Erro ó crear o directorio do Edificio',
        'BLDPLAN_DIRDOC_KO' : 'Erro ó crear o directorio da definición do Documento',
        'BLDPLAN_DIRPROC_KO' : 'Erro ó crear o directorio da definición do Procedemento',
        'BLDPLAN_DIRROUTE_KO' : 'Erro ó crear o directorio da definición da Ruta',

        // Busq. Asociaciones Edificio - Plan
        'BLDPLAN_EXST' : 'Xa existe unha asignación entre o Edificio e o Plan indicado',
        'BLDPLAN_NOT_EXST' : 'O plan non está asignado o edificio indicado',
        'BLDPLAN_KO' : 'Erro ó consultar asignacións entre o edificio e o plan',

        // Implementaciones
        'IMPDOC_ADD_KO' : 'Erro ó crear as implementacións dos documentos',
        'IMPDOC_DEL_KO' : 'Erro ó eliminar as implementacións dos documentos',
        'IMPPROC_ADD_KO' : 'Erro ó crear as implementacións dos procedementos',
        'IMPPROC_DEL_KO' : 'Erro ó eliminar as implementacións dos procedementos',
        'IMPROUTE_ADD_KO' : 'Erro ó crear as implementacións das rutas',
        'IMPROUTE_DEL_KO' : 'Erro ó eliminar as implementacións as rutas',
        'IMPFRMT_ADD_KO' : 'Erro ó crear as implementacións das formacións',
        'IMPFRMT_DEL_KO' : 'Erro ó eliminar as implementacións das formacións',
        'BLDPLAN_IMPADD_OK' : 'As implementacións creáronse correctamente',
        'IMPSIM_ADD_KO' : 'Erro ó crear as implementacións dos simulacros',
        'IMPSIM_DEL_KO' : 'Erro ó eliminar as implementacións dos simulacros',
        'BLD_IMPDEL_OK' : 'Elimináronse as implementacións correctamente',

        // Búsqueda de Edificios candidatos
        'BLDPLAN_CANDIDATES_EMPT' : 'Non hay edificios asignables ó plan',
        'BLDPLAN_CANDIDATES_OK' : 'Búsqueda de edificios asignables ó plan Ok',
        'BLDPLAN_CANDIDATES_KO' : 'Erro ó recuperar os edificios asignables ó plan',

    // PLANS

        // SEARCH
        'PLAN_SEARCH_OK' : 'A búsqueda de plans realizouse correctamente',
        'PLAN_SEARCH_KO' : 'Erro ó buscar plans',

        // SEEK
        'PLAN_SEEK_FRBD' : 'Non ten permisos pra consultar plans neste edificio',
        'PLAN_SEEK_OK' : 'Consultáronse os detalles do plan correctamente',

        // Búsqueda de Planes del Portal
        'PRTL_PLANS_SEARCH_OK' : 'A búsqueda dos plans do portal realizouse correctamente',
        'PRTL_PLANS_SEARCH_KO' : 'Erro ó buscar os plans do portal',

    // IMP_DOCS

        // SEARCH
        'IMPDOC_SEARCH_OK' : 'A búsqueda de cumplimentacións do documento realizouse correctamente',
        'IMPDOC_SEARCH_KO' : 'Erro ó buscar cumplimentacións do documento',
        'DOC_SEEK_FRBD' : 'Non dispón dos privilexios necesarios pra consultar documentos neste edificio',

        // ADD
        'IMPDOC_ADD_OK' : 'Engadíronse as cumplimentacións do documento correctamente',
        'IMPDOC_BLD_NOT_OWNED' : 'Non dispón dos privilexios necesarios pra engadir cumplimentacións neste edificio',
        'BLDPLAN_EXPIRED' : 'Non se pode realizar a acción. A asignación entre o plan e o edificio atópase vencida',

        // SEEK
        'IMPDOC_SEEK_OK' : 'Consultáronse os detalles da cumplimentación do documento correctamente',
        'IMPDOC_SEEK_KO' : 'Erro ó consultar os detalles da cumplimentación do documento',

        // EXPIRE
        'IMPDOC_EXPIRE_OK' : 'Venceuse correctamente a cumplimentación do documento',
        'IMPDOC_EXPIRE_KO' : 'Erro ó vencer a cumplimentación do documento',

        // IMPLEMENTACION
        'IMPDOC_IMPL_OK' : 'A cumplimentación do documento completouse correctamente',
        'IMPDOC_IMPL_KO' : 'Erro ó completar a cumplimentación do documento',
        'COMPL_EXPIRED' : 'A cumplimentación atópase vencida e non se pode modificar',

        // Búsqueda de cumplimentaciones de documentos del portal
        'PRTL_IMPDOC_SEARCH_OK' : 'A búsqueda de cumplimentacións de documentos do portal realizouse correctamente',
        'PRTL_IMPDOC_SEARCH_KO' : 'Erro ó buscar cumplimentacións de documentos do portal',

        // Detalles de cumplimentacines del portal
        'PRTL_IMPDOC_SEEK_OK' : 'Consultáronse os detalles da cumplimentación do procedemento do portal correctamente',
        'PRTL_IMPDOC_SEEK_KO' : 'Erro ó consultar os detalles da cumplimentación do procedemento do portal',

        // Búsqueda de más de una cumplimentación de documento en el edificio
        'IMPDOC_UNIQ' : 'Non se pode eliminar a cumplimentación. Sempre debe haber polo menos unha cumplimentación do documento',
        'IMPDOC_NOT_UNIQ' : 'Existen máis dunha cumplimentación do documento no edificio',

        // Permisos
        'BLD_FRBD' : 'Non dispón dos privilexios necesarios para realizar accións neste edificio',

        // Búsqueda de cumplimentaciones por documento y edificio
        'BLDDOCS_SEARCH_OK' : 'A búsqueda de cumplimentacións de documentos realizouse correctamente',
        'BLDDOCS_SEARCH_KO' : 'Erro ó buscar cumplimentacións',

        // Búsqueda de asignaciones por plan
        'BLDPLAN_ASSIGN_NOT_EXST' : 'Non se atoparon asignacións do plan con edificios',
        'BLDPLAN_ASSIGN_EXST' : 'Atopáronse asignacions do plan con edificios',

        // Búsqueda por id de cumplimentación del documento
        'IMPDOCID_NOT_EXST' : 'A cumplimentación do documento indicada non existe',
        'IMPDOCID_EXST' : 'A cumplimentación do documento existe',
        'IMPDOCID_KO' : 'Erro ó consultar a cumplimentación do documento',

        // Directorios
        'DIRFILE_ROOT_NOT_EXST' : 'A ruta base da definición non existe',
        'DIRFILE_IMP_ALR_EXST' : 'O directorio da cumplimentación xa existe',
        'DIRFILE_IMPDIR_ADD_KO' : 'Erro ó crear o directorio da cumplimentación',
        'FILE_ADD_OK' : 'Subeuse o ficheiro da cumplimentación correctamente',
        'FILE_ADD_KO' : 'Erro ó subir o ficheiro da cumplimentación',

        // Búsqueda de asignaciones activas
        'BLDDOC_ACTIVE_EMPT' : 'O plan ó que pertence o documento non ten asociacións activas con edificios',
        'BLDDOC_ACTIVE_OK' : 'O plan ó que pertence o documento ten asociacións activas con edificios',
        'BLDDOC_ACTIVE_KO' : 'Erro ó consultar asociacións activas con edificios',

        // Búsqueda de cumplimentaciones del documento en un edificio
        'IMPDOC_ACTIVE_EXST' : 'Xa existen cumplimentacións activas deste docuemnto nalgún dos edificios',
        'IMPDOC_ACTIVE_NOT_EXST' : 'Non existen cumplimentacións activas deste documento',
        'IMPDOC_ACTIVE_KO' : 'Erro ó consultar cumplimentacións activas',

        // Asociación Documento - Edificio
        'BLDDOC_NOT_EXST' : 'O edificio indicado non ten asignado o plan ó que pertence o documento',
        'BLDDOC_EXST' : 'O edificio indicado ten asignado o plan ó que pertence o documento',
        'BLDDOC_KO' : 'Erro ó consultar a asociación entre o edificio e o plan do documento',

    // IMP_PROCS

        // SEARCH
        'IMPPROC_SEARCH_OK' : 'A búsqueda de cumplimentacións do procedemento realizouse correctamente',
        'IMPPROC_SEARCH_KO' : 'Erro ó buscar cumplimentacións do procedimiento',

        // ADD
        'IMPPROC_ADD_OK' : 'A cumplimentación do procedemento rexistrouse correctamente',

        // DELETE
        'IMPPROC_DEL_OK' : 'A cumplimentación do procedemento eliminouse correctamente',

        // SEEK
        'IMPPROC_SEEK_OK' : 'Obtéronse os detalles da cumplimentación do procedemento correctamente',
        'IMPPROC_SEEK_KO' : 'Erro ó obter os detalles da cumplimentación do procedemento',

        // EXPIRE
        'IMPPROC_EXPIRE_OK' : 'Venceuse correctamente a cumplimentación do procedemento indicado',
        'IMPPROC_EXPIRE_KO' : 'Produciuse un error ó vencer a cumplimentación do procedemento',

        // IMPLEMENT
        'IMPPROC_IMPL_OK' : 'A cumplimentación do procedemento completouse correctamente',
        'IMPPROC_IMPL_KO' : 'Erro ó completar a cumplimentación do procedemento',

        // Búsqueda por ID de Cumplimentación
        'IMPPROCID_NOT_EXST' : 'A cumplimentación do procedemento non existe',
        'IMPPROCID_EXST' : 'O ID da cumplimentación do procedemento existe',
        'IMPPROCID_KO' : 'Erro ó consultar por ID da cumplimentación do procedemento',

        // Búsqueda de cumplimentación única
        'IMPPROC_UNIQ' : 'Non se pode eliminar a cumplimentación. Sempre debe existir polo menos unha cumplimentación do procedemento no edificio',
        'IMPPROC_NOT_UNIQ' : 'Atopáronse máis dunha cumplimentación do procedemento no edificio',

        // Búsqueda de cumplimentaciones de procedimientos del Portal
        'PRTL_IMPPROC_SEARCH_OK' : 'A búsqueda de cumplimentacións do procedemento do portal realizouse correctamente',
        'PRTL_IMPPROC_SEARCH_KO' : 'Erro ó buscar cumplimentacións do procedemento do portal',

        // Búsqueda de cumplimentaciones activas de un procedimiento en un edificio
        'IMPPROC_ACTIVE_EXST' : 'Non se puido realizar a acción. Atopáronse cumplimentacións activas deste procedemento',
        'IMPPROC_ACTITVE_NOT_EXST' : 'Non se atoparon cumplimentacións activas deste procedemento',
        'IMPPROC_ACTIVE_KO' : 'Erro ó consultar as cumplimentacións activas do procedemento',

        // Búsqueda de cumplimentaciones por edificio y procedimiento
        'BLDPROCS_SEARCH_OK' : 'A búsqueda de cumplimentacións realizouse correctamente',
        'BLDPROCS_SEARCH_KO' : 'Erro ó buscar cumplimentacións',

        // Búsqueda asociación edificio - plan
        'BLDPROC_NOT_EXST' : 'O plan ó que pertence o procedemento non está asignado o edificio indicado',
        'BLDPROC_EXST' : 'O plan ó que pertence o procedemento está asignado o edificio indicado',
        'BLDPROC_KO' : 'Error ó consultar a asociación entre o edificio e o plan do procedemento',

    // IMP_ROUTES

        // SEARCH
        'IMPROUTE_SEARCH_OK' : 'A búsqueda de cumplimentacións da ruta realizouse correctamente',
        'IMPROUTE_SEARCH_KO' : 'Erro ó buscar cumplimentacións da ruta',

        // ADD
        'IMPROUTE_ADD_OK' : 'Rexistrouse a cumplimentación da ruta correctamente',
        'BLD_FLOOR_EMPT' : 'Non se poden rexistrar cumplimentacións de rutas neste edificio ó non ter plantas asignadas',

        // SEEK
        'IMPROUTE_SEEK_OK' : 'Consultáronse os detalles da cumplimentación da ruta correctamente',
        'IMPROUTE_SEEK_KO' : 'Error ó consultar os detalles da cumplimentación da ruta',

        // EXPIRE
        'IMPROUTE_EXPIRE_OK' : 'Venceuse a cumplimentación da ruta correctamente',
        'IMPROUTE_EXPIRE_KO' : 'Erro ó vencer a cumplimentación da ruta',

        // IMPLEMENT
        'IMPROUTE_IMPL_OK' : 'A cumplimentación da ruta completouse correctamente',
        'IMPROUTE_IMPL_KO' : 'Error ó completar a cumplimentación da ruta',

        // DELETE
        'IMPROUTE_DEL_OK' : 'Eliminouse a cumplimentación da ruta correctamente',

        // Búsqueda de cumplimentación de ruta única en el edificio
        'IMPROUTE_UNIQ' : 'Non se pode eliminar a cumplimentación. Sempre debe existir polo menos unha cumplimentación da ruta no edificio',
        'IMPROUTE_NOT_UNIQ' : 'A cumplimentación da ruta non é única',

        // Búsqueda por ID de Cumplimentación
        'IMPROUTEID_NOT_EXST' : 'A cumplimentación da ruta indicada non existe',
        'IMPROUTEID_EXST' : 'A cumplimentación da ruta existe',
        'IMPROUTEID_KO' : 'Error ó consultar por id de cumplimentación',

        // Búsqueda de plantas del edificio
        'BLD_NOT_FLOORS' : 'Non se puido engadir a cumplimentación. Algún dos edificios non ten plantas rexistradas',
        'BLD_FLOORS_SEARCH_EMPT': 'O edificio indicado non ten plantas rexistradas',
        'BLD_FLOORS_OK' : 'Búsqueda das plantas do edificio Ok',
        'BLD_FLOORS_KO' : 'Erro ó buscar as plantas do edificio',

        // Búsqueda de cumplimentaciones del Portal
        'PRTL_IMPROUTE_SEARCH_OK' : 'A búsqueda das cumplimentacións da ruta no portal realizouse correctamente',
        'PRTL_IMPROUTE_SEARCH_KO' : 'Erro ó consultar as cumplimentacións da ruta no portal',

        // Búsqueda asociación edificio - ruta
        'BLDROUTE_NOT_EXST' : 'O plan ó que pertence a ruta non está asignado o edificio indicado',
        'BLDROUTE_EXST' : 'O plan ó que pertence a ruta está asignado o edificio indicado',
        'BLDROUTE_KO' : 'Erro ó consultar a asignación entre o plan da ruta e o edificio',

        // Búsqueda de cumplimentaciones por edificio y ruta
        'BLDROUTES_SEARCH_OK' : 'A búsqueda de cumplimentacións realizouse correctamente',
        'BLDROUTES_SEARCH_KO' : 'Erro ó buscar cumplimentacións',

    // IMP_FORMAT

        // SEARCH
        'IMPFORMAT_SEARCH_OK' : 'A búsqueda de cumplimentacións da formación realizouse correctamente',
        'IMPFORMAT_SEARCH_KO' : 'Erro ó buscar cumplimentacións da formación',

        // ADD
        'IMPFORMAT_ADD_OK' : 'A cumplimentación da formación rexistrouse correctamente',
        'IMPFORMAT_ADD_KO' : 'Producíuse un erro ó consultar a cumplimentación da formación',

        // DELETE
        'IMPFORMAT_DEL_OK' : 'A cumplimentación da formación eliminouse correctamente',
        'IMPFORMAT_DEL_KO' : 'Produciuse un erro ó eliminar a cumplimentación da formación',

        // SEEK
        'IMPFORMAT_SEEK_OK' : 'Consultáronse os detalles da cumplimentación da formación correctamente',
        'IMPFORMAT_SEEK_KO' : 'Producíuse un erro ó consultar os detalles da cumplimentación da formación',

        // EXPIRE
        'IMPFORMAT_EXPIRE_OK' : 'Venceuse a cumplimentación da formación correctamente',
        'IMPFORMAT_EXPIRE_KO' : 'Error ó vencer a cumplimentación da formación',

        // IMPLEMENT
        'IMPFORMAT_IMPL_OK' : 'Cumplimentouse a formación correctamente',
        'IMPFORMAT_IMPL_KO' : 'Error ó cumplimentar a formación',

        // SEEK PORTAL
        'PRTL_IMPFORMAT_SEEK_OK' : 'Consultáronse os detalles da cumplimentación da formación do portal correctamente',
        'PRTL_IMPFORMAT_SEEK_KO' : 'Error ó consultar os detalles da cumplimentación da formación do portal',

        // Consulta de cumplimentación única
        'IMPFORMAT_UNIQ' : 'Non se pode eliminar a cumplimentación. Sempre debe existir polo menos unha cumplimentación da formación no edificio',
        'IMPFORMAT_NOT_UNIQ' : 'A cumplimentación da formación no edificio non é única',

        // Consulta por ID de Cumplimentación
        'IMPFORMATID_NOT_EXST' : 'O id da cumplimentación da formación indicada non existe',
        'IMPFORMATID_EXST' : 'O id da cumplimentación da formación existe',
        'IMPFORMATID_KO' : 'Erro ó consultar por id de cumplimentación da formación',

        // Detalles de la Formación del Portal
        'PRTL_IMPFORMAT_SEARCH_OK' : 'Obtivéronse os detalles da formación do portal correctamente',
        'PRTL_IMPFORMAT_SEARCH_KO' : 'Erro ó obter os detalles da formación do portal',

        // Búsqueda asociación edificio - formacion
        'BLDFORMAT_NOT_EXST' : 'O plan ó que pertence a formación non está asginado ó edificio indicado',
        'BLDFORMAT_EXST' : 'O plan ó que pertence a formación está asignado ó edificio indicado',
        'BLDFORMAT_KO' : 'Erro ó consultar a asociación entre o plan da formación e o edificio indicado',

        // Búsqueda de cumplimentaciones
        'BLDFORMATS_SEARCH_OK' : 'Consultáronse as cumplimentacións da formación no edificio correctamente',
        'BLDFORMATS_SEARCH_KO' : 'Erro ó consultar as cumplimentacións da formación no edificio',

    // IMP_SIM

        // SEARCH
        'IMPSIM_SEARCH_OK' : 'A búsqueda de cumplimentacións do simulacro realizouse correctamente',
        'IMPSIM_SEARCH_KO' : 'Erro ó buscar cumplimentacións do simulacro',

        // ADD
        'IMPSIM_ADD_OK' : 'Rexistrouse a cumplimentación do simulacro correctamente',

        // DELETE
        'IMPSIM_DEL_OK' : 'A cumplimentación do simulacro eliminouse correctamente',

        // SEEK
        'IMPSIM_SEEK_OK' : 'Consultáronse os detalles da cumplimentación do simulacro correctamente',
        'IMPSIM_SEEK_KO' : 'Error ó consultar os detalles da cumplimentación do simulacro',

        // EXPIRE
        'IMPSIM_EXPIRE_OK' : 'Venceuse a cumplimentación do simulacro correctamente',
        'IMPSIM_EXPIRE_KO' : 'Error ó vencer a cumplimentaciòn do simulacro',

        // IMPLEMENT
        'IMPSIM_IMPL_OK' : 'Completouse a cumplimentación do simulacro correctamente',
        'IMPSIM_IMPL_KO' : 'Erro ó completar a cumplimentación do simulacro',

        // PORTAL SEEK
        'PRTL_IMPSIM_SEEK_OK' : 'Consultáronse os detalles da cumplimentación do simulacro do portal correctamente',
        'PRTL_IMPSIM_SEEK_KO' : 'Error ó consultar os detalles da cumplimentación do simulacro do portal',

        // Consulta por ID de Cumplimentación
        'IMPSIMID_NOT_EXST' : 'O id da cumplimentación do simulacro non existe',
        'IMPSIMID_EXST' : 'O id da cumplimentación do simulacro existe',
        'IMPSIMID_KO' : 'Error ó consultar por id da cumplimentación do simulacro',

        // Consulta de cumplimentación única
        'IMPSIM_UNIQ' : 'Non se puido eliminar a cumplimentación. Siempre debe existir polo menos unha cumplimentación do simulacro no edificio',
        'IMPSIM_NOT_UNIQ' : 'A cumplimentación non é única',

        // Detalles del simulacro del portal
        'PRTL_IMPSIM_SEARCH_OK' : 'Consultáronse os detalles do simulacro do portal correctamente',
        'PRTL_IMPSIM_SEARCH_KO' : 'Error ó consultar os detalles do simulacro do portal',

        // Consulta de la asignación entre el plan del simulacro y el edificio
        'BLDSIM_NOT_EXST' : 'O plan ó que pertence o simulacro non está asignado ó edificio indicado',
        'BLDSIM_EXST' : 'O plan ó que pertence o simulacro está asignado ó edificio indicado',
        'BLDSIM_KO' : 'Error ó consultar a asociación entre o plan do simulacro e o edificio',

        // Búsqueda de cumplimentaciones
        'BLDSIMS_SEARCH_OK' : 'Consultáronse as cumplimentacións do simulacro no edificio correctamente',
        'BLDSIMS_SEARCH_KO' : 'Error ó consultar as cumplimentacións do simulacro no edificio',


    // NOTIFICACIONES

        // DELETE
        'NTF_DEL_OK' : 'Eliminouse a notificación correctamente',
        'NTF_DEL_KO' : 'Error ó eliminar a notificación',

        // SEARCH
        'NTF_SEARCH_OK' : 'A búsqueda de notificacións realizouse correctamente',
        'NTF_SEARCH_KO' : 'Erro ó buscar notificacións',

        // SEARCH_FORM
        'NTF_BLDS_KO' : 'Error ó recuperar os edificios con notificacións rexistradas',
        'NTF_PLANS_KO' : 'Error ó recuperar os plans con notificacións rexistradas',

        // SEEK
        'NTF_EDT_READ_KO' : 'Error ó modificar o estado da notificación',
        'NTF_SEEK_OK' : 'Recuperáronse os detalles da notificación correctamente',

        // Obtener nuevas notificaciones
        'NTF_UR_EMPT' : 'O usuario non ten novas notificacións',
        'NTF_UR_FILL' : 'O usuario ten novas notificacións',
        'NTF_UR_KO' : 'Error ó buscar novas notificacións',

        // Permisos
        'NTF_USR_FRBD' : 'Non dispóns dos privilexios necesarios para consultar os datos da notificación',

        // Búsqueda de Notificación por ID
        'NTFID_NOT_EXST' : 'A notificación indicada non existe',
        'NTFID_EXST' : 'A notificación existe',
        'NTF_SEEK_KO' : 'Erro ó consultar os detalles da notificación',


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

            // ID DefPlan
            'DFPLAN_ID_EMPT' : 'O ID do Plan non pode ser vacío',
            'DFPLAN_ID_NOT_NUMERIC' : 'O ID do Plan debe ser numérico',

            // Nombre Definición
            'DEFNAM_SHRT' : 'O nome da definición debe ser superior a 5 caracteres',
            'DEFNAM_LRG' : 'O nome da definición non debe superar os 60 caracteres',
            'DEFNAM_FRMT' : 'O nome da definición contén caracteres non permitidos',

            // ID DefDoc
            'DFDOC_ID_EMPT' : 'O ID do documento non pode estar baleiro',
            'DFDOC_ID_NOT_NUMERIC' : 'O ID do documento debe ser numérico',

            // Nombre DefDoc
            'DFDOC_NAM_SHRT' : 'O nome do documento debe ter máis de 5 caracteres',
            'DFDOC_NAM_LRG' : 'O nome do documento non debe exceder os 50 caracteres',
            'DFDOC_NAM_FRMT' : 'O nome do documento contén caracteres ilegais',

            // Documento visible
            'DFDOC_VISB_EMPT' : 'Debe indicarse se o documento será visible ou non',
            'DFDOC_VISB_VALUES' : 'Os valores permitidos para indicar a visibilidade do documento son si ou non',

            // ID DefProc
            'DFPROC_ID_EMPT' : 'O ID do Procedemento non debe ser vacío',
            'DFPROC_ID_NOT_NUMERIC' : 'O ID do Procedemento debe ser numérico',

            // Nombre Procedimiento
            'DFPROC_NAM_SHRT' : 'O nome do procedemento debe superar os 5 caracteres',
            'DFPROC_NAM_LRG' : 'O nome do procedemento non debe superar os 50 caracteres',
            'DFPROC_NAM_FRMT' : 'O nome do procedemento contén caracteres non permitidos',

            // ID DefRoute
            'DFROUTE_ID_EMPT' : 'El ID da Ruta non pode ser vacío',
            'DEFROUTE_ID_NOT_NUMERIC' : 'O ID da Ruta debe ser numérico',

            // Nombre DefRoute
            'DFROUTE_NAM_SHRT' : 'O nome da ruta debe superar os 5 caracteres',
            'DFROUTE_NAM_LRG' : 'O nome da ruta non debe superar os 50 caracteres',
            'DFROUTE_NAM_FRMT' : 'O nome da ruta contén caracteres non permitidos',

            // ID DefFormat
            'DFFRMT_ID_EMPT' : 'O ID da Formación non pode ser vacío',
            'DEFFRMT_ID_NOT_NUMERIC' : 'O ID da Formación debe ser numérico',

            // Nombre Formación
            'DFFRMT_NAM_SHRT' : 'O nome da formación debe superar os 5 caracteres',
            'DFFRMT_NAM_LRG' : 'O nome da formación non debe superar os 50 caracteres',
            'DFFRMT_NAM_FRMT' : 'O nome da formación contén caracteres non permitidos',

            // ID DefSim
            'DFSIM_ID_EMPT' : 'O ID do Simulacro non pode ser vacío',
            'DFSIM_ID_NOT_NUMERIC' : 'O ID do Simulacro debe ser numérico',

            // Nombre Simulacro
            'DFSIM_NAM_SHRT' : 'O nome do simulacro debe superar os 5 caracteres',
            'DFSIM_NAM_LRG' : 'O nome do simulacro non debe superar os 50 caracteres',
            'DFSIM_NAM_FRMT' : 'O nome do simulacro contén caracteres non permitidos',

            // Fecha asignación
            'BLDPLAN_DATEASSIGN_KO' : 'A data de asignación non ten un formato válido',

            // Fecha implementación
            'BLDPLAN_DATECOMP_KO' : 'A data de cumplimentación non ten un formato válido',

            // Estado asignación entre Edificio y Plan
            'BLDPLAN_STATE_EMPT' : 'O estado da asignación non pode ser vacío',
            'BLDPLAN_STATE_KO' : 'O estado non é válido. Os estados válidos son Pendente, Cumplimentado e Vencido',

            // NOMBRE_DOC
            'FILENAME_EMPT' : 'O ficheiro da cumplimentación non pode estar vacío',
            'FILENAME_LRG' : 'O nome do ficheiro da cumplimentación non pode superar os 50 caracteres',
            'FILENAME_FRMT' : 'O nome do ficherio da cumplimentación só pode contener letras, números e guións',
            'FILENAME_EXT' : 'O ficheiro da cumplimentación debe estar en formato pdf',

            // ID Cumplimentación
            'CUMP_ID_EMPT' : 'O id da cumplimentación non pode ser vacío',
            'CUMP_ID_NOT_NUMERIC' : 'O id da cumplimentación debe ser numérico',

            // Fecha Planificación
            'PLANNING_DATE_EMPT' : 'A data de planificación non pode ser vacía',
            'PLANNING_DATE_KO' : 'A data de planificación introducida ten un formato incorrecto',
            'PLANNING_DATE_PAST' : 'A data de planificación introducida é unha fecha pasada',

            // Fecha Asignación
            'START_DATEASSIGN_KO' : 'A data de asignacion inicial introducida ten un formato incorrecto',
            'END_DATEASSIGN_KO' : 'A data de asignacion final introducida ten un formato incorrecto',

            // Fecha Vencimiento
            'DATEEXPIRE_KO' : 'A data de vencemento introducida ten un formato incorrecto',

            // Destinatarios
            'RECIPIENTS_EMPT' : 'O campo destinatarios non pode ser vacío',
            'RECIPIENTS_LRG' : 'O campo destinatarios non pode superar os 200 caracteres',
            'RECIPIENTS_FRMT' : 'O campo destinatarios contén caracteres non permitidos',

            // URL
            'URL_FRMT' : 'A URL do recurso introducida ten un formato incorrecto',
            'URL_LRG' : 'A lonxitude da URL non debe superar os 200 caracteres',

            // ID Formación
            'IMPFORMAT_ID_EMPT' : 'O id da cumplimentación da formación non pode ser vacío',
            'IMPFORMAT_ID_NOT_NUMERIC' : 'O id da cumplimentación da formación debe ser numérico',

            // Fecha Planificación Inicial
            'START_PLANNING_DATE_KO' : 'A data de planificación inicial ten un formato incorrecto',

            // Fecha Planificación Final
            'END_PLANNING_DATE_KO' : 'A data de planificación final ten un formato incorrecto',

            // Fecha Vencimiento Inicial
            'START_DATEEXPIRE_KO' : 'A data de vencemento inicial ten un formato incorrecto',

            // Fecha Vencimiento Final
            'END_DATEEXPIRE_KO' : 'A data de vencemento final ten un formato incorrecto',

            // Fecha Cumplimentación Inicial
            'START_DATECOMP_KO' : 'A data de cumplimentación inicial ten un formato incorrecto',

            // Fecha Cumplimentación Final
            'END_DATECOMP_KO' : 'A data de cumplimentación final ten un formato incorrecto',

            // ID Notificación
            'NTFID_EMPT' : 'O ID da notificación non pode ser vacío',
            'NTFID_NOT_NUMERIC' : 'O ID da notificación debe ser numérico',

            // Fecha Inicio
            'START_DATE_KO' : 'A data inicial ten un formato incorrecto',

            // Fecha Fin
            'END_DATE_KO' : 'A data final ten un formato incorrecto',

            // Leído
            'READ_KO' : 'O atributo leído só admite os valores SI ou NON',




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
        'i18n-admin-plans' : 'Administrar Plans',
        'i18n-manage-plans' : 'Xestionar Plans',
        'i18n-info_users' : 'Xestión dos Usuarios rexistrados no sistema',
        'i18n-info_profile' : 'Xestión dos datos do teu Usuario',
        'i18n-info_buildings' : 'Xestión dos datos dos Edificios, Plantas y Espazos',
        'i18n-info_impplans' : 'Xestión das cumplimentacións dos Plans nos Edificios',
        'i18n-info_defplans' : 'Xestión das definicións dos Plans e as suas asignacións con Edificios',

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
        'i18n-buildings-empty' : 'Non se encontraron edificios',
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
        'i18n-floors-empty' : 'Non se encontraron plantas',
        'i18n-add-floor' : 'Engadir Planta',
        'i18n-descripcion' : 'Descripción',
        'i18n-details-floor' : 'Detalles da Planta',
        'i18n-del-floor-confirm' : '¿Está seguro de que desexa eliminar esta planta? A acción non será reversible',
        'i18n-search-floor' : 'Buscar Plantas',
        'i18n-edit-floor' : 'Editar Planta',
        'i18n-view-spaces' : 'Ver Espazos',
        'i18n-foto_planta' : 'Foto da Planta',
        'i18n-floor_details' : 'Información da Planta',

        // SPACES VIEWS
        'i18n-spaces' : 'Espazos',
        'i18n-espacio_id' : 'ID Espazo',
        'i18n-spaces-empty' : 'Non se encontraron espazos',
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
        'i18n-prevent_plans' : 'Plans Prevención',
        'i18n-prevent_plans-info' : 'Consulta a información dos Plans de Prevención do Edificio',

        // DEF_PLANS VIEW
        'i18n-def-plans' : 'Definicións de Plans',
        'i18n-def-plans-empty' : 'Non se encontraron definicións de plans',
        'i18n-plan_id' : 'ID Plan',
        'i18n-del-def-plan-confirm' : '¿Está seguro de que desexa eliminar a definición deste plan? A acción non será reversible',
        'i18n-search-def-plan' : 'Buscar Def. de Plans',
        'i18n-showCurrent-defPlan' : 'Detalles da Def. do Plan',
        'i18n-show-plans-defdocs' : 'Def. de Documentos',
        'i18n-show-plans-defprocs' : 'Def. de Procedementos',
        'i18n-show-plans-defroutes' : 'Def. de Rutas',
        'i18n-show-plans-deformats' : 'Def. de Formacións',
        'i18n-show-plans-defsims' : 'Def. de Simulacros',
        'i18n-edit-defPlan' : 'Editar Def. do Plan',
        'i18n-show-plans-bldplans' : 'Edificios Asignados',

        // DEF_DOCS VIEW
        'i18n-def-docs' : 'Definicións de Documentos',
        'i18n-visible' : 'Visible',
        'i18n-def-docs-empty' : 'Non se encontraron definicións de documentos',
        'i18n-add-defDoc' : 'Definir Documento',
        'i18n-yes': 'Sí',
        'i18n-no' : 'Non',
        'i18n-del-def-doc-confirm' : 'Seguro que queres eliminar a definición deste documento? O cambio non será reversible',
        'i18n-documento_id' : 'ID Documento',
        'i18n-search-defDoc' : 'Buscar Def. de Documentos',
        'i18n-edit-defDoc' : 'Editar Def. do Documento',
        'i18n-current-defDoc' : 'Detalles da Def. do Documento',


        // DEF_PROCS VIEW
        'i18n-def-procs' : 'Definicións de Procedementos',
        'i18n-procedimiento_id' : 'ID Procedemento',
        'i18n-def-procs-empty' : 'Non se encontraron definicións de procedementos',
        'i18n-add-defProc' : 'Definir Procedemento',
        'i18n-del-def-proc-confirm' : '¿Está seguro de que desexa eliminar a definición deste procedemento? A acción non será reversible',
        'i18n-current-defProc' : 'Detalles da Def. do Procedemento',
        'i18n-search-defProc' : 'Buscar Def. de Procedementos',
        'i18n-edit-defProc' : 'Editar Def. do Procedemento',

        // DEF_ROUTES VIEW
        'i18n-def-routes' : 'Definicións de Rutas',
        'i18n-ruta_id' : 'ID Ruta',
        'i18n-def-routes-empty' : 'Non se encontraron definicións de rutas',
        'i18n-add-defRoute' : 'Definir Ruta',
        'i18n-del-def-route-confirm' : '¿Está seguro de que desexa eliminar a definición desta ruta? O cambio non será reversible',
        'i18n-current-defRoute' : 'Detalles da Def. da Ruta',
        'i18n-search-defRoute' : 'Buscar Def. de Rutas',
        'i18n-edit-defRoute' : 'Editar Def. da Ruta',

        // DEF_FORMATS VIEW
        'i18n-def-formats' : 'Definicións de Formacións',
        'i18n-formacion_id' : 'ID Formación',
        'i18n-def-formats-empty' : 'Non se encontraron definicións de formacións',
        'i18n-add-defFormat' : 'Definir Formación',
        'i18n-del-def-format-confirm' : '¿Está seguro de que desexa eliminar a definición desta formación? O cambio non será reversible',
        'i18n-current-defFormat' : 'Detalles da Def. da Formación',
        'i18n-search-defFormat' : 'Buscar Def. de Formacións',
        'i18n-edit-defFormat' : 'Editar Def. da Formación',

        // DEF_SIMS VIEW
        'i18n-def-sims' : 'Definicións de Simulacros',
        'i18n-simulacro_id' : 'ID Simulacro',
        'i18n-def-sims-empty' : 'Non se encontraron definicións de simulacros',
        'i18n-add-defSim' : 'Definir Simulacro',
        'i18n-del-def-sim-confirm' : '¿Está seguro que desexa eliminar a definición deste simulacro? O cambio non será reversible',
        'i18n-current-defSim' : 'Detalles da def. do Simulacro',
        'i18n-search-defSim' : 'Buscar Def. de Simulacros',
        'i18n-edit-defSim' : 'Editar Def. do Simulacro',

        // BUILDINGS_PLANS
        'i18n-assign-bldplan' : 'Edificios Asignados',
        'i18n-building' : 'Edificio',
        'i18n-date_assign' : 'Data Asignación',
        'i18n-state' : 'Estado',
        'i18n-date_comp' : 'Data Cumplimentación',
        'i18n-pendiente' : 'PENDENTE',
        'i18n-cumplimentado' : 'CUMPLIMENTADO',
        'i18n-vencido' : 'VENCIDO',
        'i18n-bldplan-empty' : 'Non se encontraron asignacións con edificios',
        'i18n-add-buildPlan' : 'Asignar Edificios',
        'i18n-del-bldplan-confirm' : '¿Está seguro de que desexa eliminar esta asignación? O cambio non será reversible',
        'i18n-expire' : 'Vencer',
        'i18n-expire_all' : 'Vencer TODAS',
        'i18n-expireAll-bldplan-confirm' : '¿Está seguro que desexa vencer TODAS as asignacións deste Plan? O cambio non será reversible',
        'i18n-nombre_edificio' : 'Nome Edificio',
        'i18n-date_expire' : 'Data Vencemento',

        // PLANS
        'i18n-plan' : 'Plan',
        'i18n-list-plans-empty' : 'Non se atoparon asignacións de plans',
        'i18n-list-plans' : 'Listado de Plans',
        'i18n-documentos' : 'Documentos',
        'i18n-procedimientos' : 'Procedementos',
        'i18n-rutas' : 'Rutas',
        'i18n-formaciones' : 'Formacións',
        'i18n-simulacros' : 'Simulacros',
        'i18n-info_plan' : 'Información do Plan',
        'i18n-elements_plan' : 'Elementos do Plan',
        'i18n-nombre_plan' : 'Nome Plan',
        'i18n-start_date_assign' : 'Data Asignación Inicial',
        'i18n-end_date_assign' : 'Data Asignación Final',

        // IMP_DOCS
        'i18n-show-impdocs' : 'Ver Cumplimentacións',
        'i18n-implement' : 'Cumplimentar',
        'i18n-imp-docs-empty' : 'Non se atoparon cumplimentacións do documento',
        'i18n-nombre_doc' : 'Nome Documento',
        'i18n-impdocs' : 'Cumplimentacións do Documento',
        'i18n-info_doc' : 'Información do Documento',
        'i18n-cump_id' : 'ID Cumplimentacion',
        'i18n-add-implements' : 'Engadir Cumplimentacións',
        'i18n-file_doc' : 'Ficheiro da Cumplimentación',
        'i18n-documento' : 'Documento',
        'i18n-add-implement-confirm' : '¿Está seguro de que desexa engadir esta cumplimentación?',
        'i18n-del-imp-doc-confirm' : '¿Está seguro de que desexa eliminar a cumplimentación deste documento? O cambio non sera reversible',
        'i18n-expire-impdoc-confirm' : '¿Está seguro de que desexa vencer a cumplimentación deste documento? O cambio non será reversible',
        'i18n-cump-doc' : 'Cumplimentar Documento',
        'i18n-actual-imp' : 'Cumplimentación Actual',
        'i18n-imp-details' : 'Detalles da Cumplimentación',
        'i18n-search-imps' : 'Buscar Cumplimentacións',

        // IMP_PROCS
        'i18n-impprocs' : 'Cumplimentacións do Procedemento',
        'i18n-imp-procs-empty' : 'Non se atoparon cumplimentacións do procedemento',
        'i18n-info_proc' : 'Información do Procedemento',
        'i18n-del-imp-proc-confirm' : '¿Está seguro de que desexa eliminar a cumplimentación deste procedemento? O cambio non será reversible',
        'i18n-expire-impproc-confirm' : '¿Está seguro de que desexa vencer a cumplimentación deste procedemento? O cambio non será reversible',
        'i18n-cump-proc' : 'Cumplimentar Procedemento',

        // IMP_ROUTES
        'i18n-improutes' : 'Cumplimentacións da Ruta',
        'i18n-nombre_planta' : 'Nome Planta',
        'i18n-imp-routes-empty' : 'Non se atoparon cumplimentacións da ruta',
        'i18n-info_route' : 'Información da Ruta',
        'i18n-expire-improute-confirm' : '¿Está seguro de que desexa vencer a cumplimentación desta ruta? O cambio non será reversible',
        'i18n-cump-route' : 'Cumplimentar Ruta',
        'i18n-del-imp-route-confirm' : '¿Está seguro que desexa eliminar a cumplimentación desta ruta? O cambio non será reversible',
        'i18n-start_date_comp' : 'Data Cumplimentación Inicial',
        'i18n-end_date_comp' : 'Data Cumplimentación Final',

        // IMP_FORMATS
        'i18n-impformats' : 'Cumplimentacións da Formación',
        'i18n-planning_date' : 'Fecha Planificación',
        'i18n-imp-formats-empty' : 'Non se atoparon cumplimentacións da formación',
        'i18n-info_format' : 'Información da Formación',
        'i18n-del-imp-format-confirm' : '¿Está seguro de que desexa eliminar a cumplimentación desta formación? O cambio non será reversible',
        'i18n-expire-impformat-confirm' : '¿Está seguro de que desexa vencer a cumplimentación desta formación? O cambio non será reversible',
        'i18n-current_planning_date' : 'Fecha de Planificación Actual',
        'i18n-url_recurso' : 'URL Recurso',
        'i18n-destinatarios' : 'Destinatarios',
        'i18n-enlace_url' : 'Acceder ó Recurso',
        'i18n-cump-form' : 'Cumplimentar Formación',

        // IMP_SIMS
        'i18n-impsim' : 'Cumplimentacións do Simulacro',
        'i18n-imp-sims-empty' : 'Non se atoparon cumplimentacións do simulacro',
        'i18n-info_sim' : 'Información do Simulacro',
        'i18n-del-imp-sim-confirm' : '¿Está seguro de que desexa eliminar a cumplimentación deste simulacro? O cambio non será reversible',
        'i18n-expire-impsim-confirm' : '¿Está seguro de que desexa vencer a cumplimentación deste simulacro? O cambio non será reversible',
        'i18n-cump-sim' : 'Cumplimentar Simulacro',
        'i18n-start_planning_date' : 'Data Planificación Inicial',
        'i18n-end_planning_date' : 'Data Planificación Final',
        'i18n-start_date_expire' : 'Data Vencemento Inicial',
        'i18n-end_date_expire' : 'Data Vencemento Final',

        // NOTIFICACIONES
        'i18n-notifications' : 'Notificacións',
        'i18n-show_notifications' : 'Listado de Notificacións',
        'i18n-notifications-empty' : 'Non se atoparon Notificacións',
        'i18n-read' : 'Leído',
        'i18n-date' : 'Data',
        'i18n-search-notifications' : 'Buscar Notificacións',
        'i18n-fecha_inicio' : 'Data Inicio',
        'i18n-fecha_fin' : 'Data Fin',
        'i18n-msg' : 'Mensaxe',
        'i18n-notification-details' : 'Detalles da Notificación',
        'i18n-del-notification-confirm' : '¿Está seguro que desexa eliminar a notificación? O cambio non será reversible',

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
            'm-documento_id' : ' ID Documento ',
            'm-plan_id' : ' ID Plan ',
            'm-procedimiento_id' : ' ID Procedemento ',
            'm-ruta_id' : ' ID Ruta ',
            'm-formacion_id' : ' ID Formacion ',
            'm-simulacro_id' : ' ID Simulacro ',
            'm-buildings' : ' Edificios ',
            'm-nombre_edificio' : ' Nome Edificio ',
            'm-nombre_doc' : ' Ficheiro Cumplimentacion ',
            'm-nombre_doc_field' : ' Nome Documento ',
            'm-cumplimentacion_id' : ' ID Cumplimentación ',
            'm-nombre_planta' : ' Nome Planta ',
            'm-url_recurso' : ' URL Recurso ',
            'm-fecha_planificacion' : ' Fecha Planificación ',
            'm-destinatarios' : ' Destinatarios ',
            'm-nombre_plan' : ' Nome Plan ',

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
            'i18n-only-letters-numbers-hyphen' : 'só pode conter letras, números e guións',
            'i18n-filename-search-format' : 'Só pode conter letras, números, guións, y só admite a extensión .pdf',
            'i18n-url-format' : 'contén caracteres non permitidos ou estase a especificar un protocolo distinto a http, https o ftp',
            'i18n-fecha-menor-actual' : 'debe ser maior ou igual a fecha actual',

}
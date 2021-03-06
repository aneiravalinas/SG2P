arrayEN = {
    // Database General
    'QRY_OK' : 'Successful SQL execution',
    'QRY_EMPT' : 'Recordset is empty',
    'QRY_DATA' : 'Recordset contains data',
    'DB_ERR' : 'Error while connecting with database. Contact your administrator',
    'QRY_KO' : 'SQL execution error',

    // Acceso no autorizado
    'FRB_ACCS' : 'You do not have the necessary privileges to perform this action',

    // USUARIO

        // Login
        'LOG_OK' : 'You have successfully logged into the system',
        'LOG_KO' : 'The credentials entered are invalid',

        // Search
        'USR_SRCH_OK' : 'Users Search OK',
        'USR_SRCH_KO' : 'Users Search Error',

        // ADD
        'BM_ADD' : 'Cannot assign building manager role if user does not have buildings assigned',
        'USR_ADD_OK' : 'The user was added successfully',
        'USR_ADD_KO' : 'Error adding user',

        // DELETE
        'USR_DEL_OK' : 'User deleted successfully',
        'BM_DEL' : 'You cannot delete a user who has buildings assigned',
        'OM_UNQ_DEL' : 'The user cannot be deleted. There must always be at least one person in charge of the organization',
        'ADM_UNQ_DEL' : 'The user cannot be deleted. There must always be at least one administrator',
        'USR_DEL_KO' : 'Failed to delete user',

        // EDIT
        'USR_EDT_OK' : 'User edited successfully',
        'OM_UNQ_EDT' : 'The role cannot be modified. The user is solely responsible for the organization',
        'ADM_UNQ_EDT' : 'The role cannot be modified. The user is the only administrator of the application',
        'USR_EDT_KO' : 'Error editing user',
        'BM_WITH_BLD' : 'The building manager role cannot be disassociated if the user has buildings assigned',

        // EDIT_PROFILE
        'PRF_USR_KO' : 'You cannot edit another user\'s profile',
        'PRF_OK' : 'Profile data has been stored successfully',
        'PRF_KO' : 'Error modifying profile data',

        // SEEK
        'USR_SEEK_OK' : 'Search for user details was successful',
        'USR_SEEK_KO' : 'Failed to query user details',

        // B??squeda por Username
        'USRNM_EXST' : 'The username already exist',
        'USRNM_NOT_EXST' : 'The username entered does not exist',
        'USRNM_KO' : 'Query by username failed',

        // B??squeda por DNI
        'DNI_EXST' : 'The DNI already exist',
        'DNI_NOT_EXST' : 'The DNI entered does not exist',
        'DNI_KO' : 'Query by DNI failed',

        // B??squeda por Email
        'EML_EXST' : 'The email already exist',
        'EML_NOT_EXST' : 'The email entered does not exist',
        'EML_KO' : 'Query by email failed',

        // B??squeda por Tel??fono
        'TLF_EXST' : 'The phone number already exist',
        'TLF_NOT_EXST' : 'The phone number entered does not exist',
        'TLF_KO' : 'Query by phone number failed',

        // Mas de un usuario por rol
        'ROL_MTO' : 'There is more than one user with the indicated role',
        'ROL_LTO' : 'There is less than one user with the indicated role',
        'ROL_KO' : 'Query by rol failed',

    // EDIFICIOS

        // SEARCH
        'BLD_SRCH_OK' : 'Building Search Ok',
        'BLD_SRCH_KO' : 'Building Search KO',

        // ADD
        'BLD_ADD_KO' : 'Failed to add building',
        'BLD_ADD_OK' : 'The building has been added successfully',
        'BLD_ADD_OK_ROL_KO' : 'Error when modifying the registered user role to building manager. Action must be done manually',

        // DELETE
        'BLD_DEL_OK' : 'The building has been successfully removed',
        'BLD_DEL_OK_ROL_KO' : 'Error when modifying the role of the building manager to a registered user. Action must be done manually',
        'BLD_DEL_KO' : 'Failed to delete building',

        // EDIT
        'BLD_EDIT_OK_ROL_KO' : 'The building has been modified successfully, but there was an error in the assignment of roles. Please review the roles manually.',
        'BLD_EDIT_KO' : 'An error occurred while modifying the building',
        'BLD_EDIT_OK' : 'The building has been successfully modified',

        // SHOWCURRENT
        'BLD_CURRNT_MANG_KO' : 'You do not have the necessary permits to consult the details of that building',
        'BLD_CURRENT_OK' : 'The query of the building details has been executed correctly',
        'BLD_CURRNT_KO' : 'Failed to query building details',

        // B??squeda de ciudades
        'CTY_NOT_FOUND' : 'There are currently no buildings registered in the system. Register a building to access its portal',
        'SRCH_CTY_KO' : 'An error occurred while obtaining the cities registered in the system. Contact your administrator',
        'SRCH_CTY_OK' : 'City search Ok',

        // B??squeda por ciudad
        'CTY_NOT_EXST' : 'The entered city does not exist',
        'SRCH_BY_CTS_OK' : 'Search by city Ok',
        'SRCH_BY_CTS_KO' : 'Error searching by city',

        // Obtener candidatos a responsable de edificio
        'MANG_EMPT' : 'There are no candidates available to be building manager',
        'GT_MANG_KO' : 'Failed to obtain building manager candidates',
        'MANG_INV' : 'The specified user is not valid to be a building manager',

        // Fotos Edificio
        'BLD_PH_KO' : 'Failed to upload building photo',

        // B??squeda por Edificio_ID
        'BLDID_NOT_EXST' : 'Building ID does not exist',
        'BLDID_KO' : 'Failed to query by Building ID',
        'BLDID_EXST' : 'Building ID exists',

        // B??squeda por Responsable
        'MANG_NOT_EXST' : 'The building manager does not exist',
        'MANG_EXST' : 'The building manager exist',
        'MANG_KO' : 'Error when consulting the building manager',

        // B??squeda de Plantas del Edificio
        'BLD_FLR_EXST' : 'The building cannot be deleted as long as it has associated floors',
        'BLD_SRCH_FLR_KO' : 'Error when consulting the building floors',

        // B??squeda de Planes asignados al Edificio
        'BLD_PLN_EXST' : 'Building cannot be deleted while it has assigned plans',
        'BLD_SRCH_PLN_KO': 'Error when consulting the plans associated with the building',

    // PLANTAS

        // SEARCH
        'FLR_SRCH_NT_ALLOWED' : 'You do not have the necessary permits to search for plants in this building',
        'FLR_SRCH_OK' : 'Plant search Ok',
        'FLR_SRCH_KO' : 'Failed to query plants',

        // ADD
        'FLR_ADD_OK' : 'The floor has been added successfully',
        'FLR_ADD_KO' : 'Failed to add floor',

        // DELETE
        'FLR_DEL_OK' : 'The floor has been successfully removed',
        'FLR_DEL_KO' : 'Failed to delete the floor',

        // SEEK
        'FLR_SEEK_NOT_ALLOWED' : 'You do not have the necessary permits to consult the details of this floor',
        'FLR_SEEK_OK' : 'The consultation of the details of the floor has been carried out correctly',
        'FLR_SEEK_KO' : 'Failed to query floor details',

        // EDIT
        'FLR_EDT_OK' : 'Floor data has been successfully modified',
        'FLR_EDT_KO' : 'Error when modifying floor data',

        // Detalles de la planta del Portal
        'PRTL_FLR_SEEK_OK' : 'The consultation of the details of the portal plant has been carried out correctly',
        'PRTL_FLR_SEEK_KO' : 'Failed to query the details of the portal plant',

        // B??squeda de Plantas del Portal
        'PRTL_FLR_SRCH_OK' : 'The portal floor search was successful',
        'PRTL_FLR_SRCH_KO' : 'Failed to find portal plants',

        // Existe numero de planta en un edificio
        'FLR_NUM_EXST' : 'There is already a floor with the floor number indicating in this building',
        'NUM_PLNT_EXST_KO' : 'Error when consulting by floor number',

        // Subir foto planta
        'FLR_PH_KO' : 'Error uploading the floor photo',

        // Consulta por Planta
        'FLRID_NOT_EXST' : 'The floor does not exist',
        'FLRID_EXST' : 'The floor exist',
        'FLRID_KO' : 'Error when consulting by Floor ID',

        // Consulta de Espacios asociados a Planta
        'FLR_SPC_EXST' : 'The floor cannot be deleted as long as it has associated Spaces',
        'FLR_SPC_KO' : 'Error when consulting the spaces associated with the floor',

        // Consutla de Implementaciones de Rutas en Plantas
        'FLR_RT_EXST' : 'Cannot delete floor while it has Route implementations',
        'FLR_RT_KO' : 'Failed to query floor route implementations',

    // ESPACIOS

        // SEARCH
        'SPC_SRCH_NOT_ALLOWED' : 'You do not have permits to search for spaces in this building',
        'SPC_SRCH_OK' : 'The search for spaces was successful',
        'SPC_SRCH_KO' : 'Error while searching for spaces',

        // ADD
        'SPC_ADD_OK' : 'The space has been added successfully',
        'SPC_ADD_KO' : 'Error adding space',

        // DELETE
        'SPC_DEL_OK' : 'The space has been successfully removed',
        'SPC_DEL_KO' : 'Failed to remove space',

        // SEEK
        'SPC_SEEK_KO' : 'Failed to check space details',
        'SPC_SEEK_OK' : 'The consultation of the details of the space has been carried out correctly',
        'SPC_SEEK_NOT_ALLOWED' : 'You do not have the necessary permissions to consult the details of this space',

        // EDIT
        'SPC_EDT_OK' : 'The space has been edited successfully',
        'SPC_EDT_KO' : 'Error editing space',

        // Detalles del espacio del portal
        'PRTL_SPC_SEEK_OK' : 'The consultation of the details of the portal space has been carried out correctly',
        'PRTL_SPC_SEEK_KO' : 'Failed to check the details of the portal space',

        // B??squeda por ID de Espacio
        'SPCID_NOT_EXST' : 'The indicated space does not exist',
        'SPCID_EXST' : 'The indicated spaces exist',
        'SPCID_KO' : 'Failed to query by Space ID',

        // B??squeda por nombre de espacio
        'SPC_NAM_EXST' : 'There is already a space with the name indicated on this floor',
        'SPC_NAM_KO' : 'Failed to query by space name',

        // Subir foto espacio
        'SPC_PH_KO' : 'Error uploading space photo',

    // DEF_PLAN

        // SEARCH
        'DFPLAN_SEARCH_OK' : 'Search for plan definitions was successful',
        'DFPLAN_SEARCH_KO' : 'Failed to search plan definitions',

        // ADD
        'DFPLAN_ADD_OK' : 'The plan definition has been added successfully',
        'DFPLAN_ADD_KO' : 'Failed to add plan definition',

        // DELETE
        'DFPLAN_DEL_OK' : 'The plan definition has been successfully removed',
        'DFPLAN_DEL_KO' : 'Failed to delete plan definition',

        // SEEK
        'DFPLAN_SEEK_OK' : 'The consultation of the details of the definition of the plan has been carried out correctly',
        'DFPLAN_SEEK_KO' : 'Failed to query plan definition details',

        // EDIT
        'DFPLAN_EDT_OK' : 'The plan definition has been modified successfully',
        'DFPLAN_EDT_KO' : 'Error modifying plan definition',

        // B??squeda por nombre de plan
        'DFPLAN_NAM_NOT_EXST': 'Plan name does not exist',
        'DFPLAN_NAM_EXST' : 'Plan name exists',
        'DFPLAN_NAM_KO' : 'Failed to query by plan name',

        // B??squeda por ID de Plan
        'DFPLANID_NOT_EXST' : 'The definition of the plan does not exist',
        'DFPLANID_EXST' : 'The definition of the plan exists',
        'DFPLANID_KO' : 'Failed to query by Plan ID',

        // B??squeda de edificios asignados
        'DFPLAN_BLD_EXST' : 'Cannot delete plan definition while assigned to buildings',
        'DFPLAN_BLD_NOT_EXST' : 'The definition of the plan is not assigned to any building',
        'DFPLAN_BLD_KO' : 'Failed to query assigned buildings',

        // B??squeda de documentos asociados
        'DFPLAN_DOC_EXST' : 'Cannot delete plan definition while it has document definitions associated',
        'DFPLAN_DOC_NOT_EXST' : 'The plan definition has no associated document definitions',
        'DFPLAN_DOC_KO' : 'Failed to query associated document definitions',

        // B??squeda de procedimientos asociados
        'DFPLAN_PROC_EXST' : 'Cannot delete plan definition while it has associated procedure definitions',
        'DFPLAN_PROC_NOT_EXST' : 'The plan definition has no associated procedure definitions',
        'DFPLAN_PROC_KO' : 'Failed to query associated procedure definitions',

        // B??squeda de rutas asociadas
        'DFPLAN_ROUTE_EXST' : 'Cannot delete plan definition while it has associated route definitions',
        'DFPLAN_ROUTE_NOT_EXST' : 'The plan definition does not have associated route definitions',
        'DFPLAN_ROUTE_KO' : 'Error querying definitions of associated routes',

        // B??squeda de formaciones asociados
        'DFPLAN_FRMT_EXST' : 'Cannot delete plan definition while it has associated formation definitions',
        'DFPLAN_FRMT_NOT_EXST' : 'The definition of the plan does not have definitions of associated formations',
        'DFPLAN_FRMT_KO' : 'Error querying definitions of associated formations',

        // B??squeda de simulacros asociados
        'DFPLAN_SIM_EXST' : 'Cannot delete plan definition while it has simulacrum definitions associated',
        'DFPLAN_SIM_NOT_EXST' : 'The plan definition has no associated simulacrum definitions',
        'DFPLAN_SIM_KO' : 'Failed to query simulacrum definitions',


    // DEF_DOC

        // SEARCH
        'DFDOC_SEARCH_OK' : 'Document definition search OK',
        'DFDOC_SEARCH_KO' : 'Error searching document definitions',

        // ADD
        'DFDOC_ADD_OK' : 'Document definition has been added successfully',
        'DFDOC_ADD_KO' : 'Error adding document definition',

        // SEEK
        'DFDOC_SEEK_OK' : 'Success in getting the details of the document definition',
        'DFDOC_SEEK_KO' : 'Failed to get document definition details',

        // DELETE
        'DFDOC_DEL_OK' : 'Document definition has been successfully removed',
        'DFDOC_DEL_KO' : 'Failed to delete document definition',

        // EDIT
        'DFDOC_EDT_OK' : 'Document definition has been modified successfully',
        'DFDOC_EDT_KO' : 'Error modifying document definition',

        // B??squeda por nombre de documento
        'DFDOC_NAME_EXST' : 'A document definition with the indicated name already exists for this plan',
        'DFDOC_NAME_NOT_EXST' : 'There is no document definition with the name indicated in this plan',
        'DFDOC_NAME_KO' : 'Failed to query by document name',

        // B??squeda por ID de Documento
        'DFDOCID_EXST' : 'Document ID exists',
        'DFDOCID_NOT_EXST' : 'The indicated document definition does not exist',
        'DFDOCID_KO' : 'Failed to query by document ID',

        // B??squeda de implementaciones de documentos
        'DFDOC_IMPL_EXST' : 'Cannot delete document definition while having building deployments',
        'DFDOC_IMPL_NOT_EXST' : 'The indicated document definition has no implementations in buildings',
        'DFDOC_IMPL_KO' : 'Failed to query document implementations',

    // DEF_PROC

        // SEARCH
        'DFPROC_SEARCH_OK' : 'Search for procedure definitions was successful',
        'DFPROC_SEARCH_KO' : 'Error searching procedure definitions',

        // ADD
        'DFPROC_ADD_OK' : 'Procedure definition has been added successfully',
        'DFPROC_ADD_KO' : 'Error adding procedure definition',

        // DELETE
        'DFPROC_DEL_OK' : 'Procedure definition has been successfully removed',
        'DFPROC_DEL_KO' : 'Failed to delete procedure definition',

        // SEEK
        'DFPROC_SEEK_OK' : 'Success in obtaining the details of the procedure definition',
        'DFPROC_SEEK_KO' : 'Failed to query the details of the procedure definition',

        // EDIT
        'DFPROC_EDT_OK' : 'The definition of the procedure has been modified correctly',
        'DFPROC_EDT_KO' : 'Error modifying procedure definition',

        // B??squeda por ID de Procedimiento
        'DFPROCID_NOT_EXST' : 'The indicated procedure definition does not exist',
        'DFPROCID_EXST' : 'The indicated procedure definition exists',
        'DFPROCID_KO' : 'Failed to query by ID procedure',

        // B??squeda de implementaciones de procedimientos
        'DFPROC_IMPL_EXST' : 'You cannot delete the procedure definition while you have building implementations',
        'DFPROC_IMPL_NOT_EXST' : 'The definition of the procedure has no implementations in buildings',
        'DFPROC_IMPL_KO' : 'Failed to query procedural implementations',

        // B??squeda por nombre de procedimiento
        'DFPROC_NAME_EXST' : 'A procedure definition with the name indicated already exists in this plan',
        'DFPROC_NAME_NOT_EXST' : 'There is no procedure definition with the name indicated in this plan',
        'DFPROC_NAME_KO' : 'Failed to query by procedure name',

    // DEF_ROUTE

        // SEARCH
        'DFROUTE_SEARCH_OK' : 'Search for route definitions was successful',
        'DFROUTE_SEARCH_KO' : 'Failed to find routes definitions',

        // ADD
        'DFROUTE_ADD_OK' : 'The route definition has been added successfully',
        'DFROUTE_ADD_KO' : 'Error adding route definition',

        // SEEK
        'DFROUTE_SEEK_OK' : 'The details of the route definition have been consulted correctly',
        'DFROUTE_SEEK_KO' : 'Failed to query the details of the route definition',

        // DELETE
        'DFROUTE_DEL_OK' : 'The route definition has been successfully removed',
        'DFROUTE_DEL_KO' : 'Failed to delete route definition',

        // EDIT
        'DFROUTE_EDT_OK' : 'The route definition has been modified successfully',
        'DFROUTE_EDT_KO' : 'Error modifying route definition',

        // B??squeda de implementaciones de rutas en plantas
        'DFROUTE_IMPL_EXST' : 'It is not possible to delete the definition of the route while there are implementations in some floor',
        'DFROUTE_IMPL_NOT_EXST' : 'The route definition has no floor implementations',
        'DFROUTE_IMPL_KO' : 'Error when consulting route implementations in floors',

        // B??squeda por ID de ruta
        'DFROUTEID_NOT_EXST' : 'The definition of the indicated route does not exist',
        'DFROUTEID_EXST' : 'The definition of the indicated route exists',
        'DFROUTEID_KO' : 'Failed to query by Route ID',

        // B??squeda por nombre de ruta
        'DFROUTE_NAME_EXST' : 'A route definition with the indicated name already exists for this plan',
        'DFROUTE_NAME_NOT_EXST' : 'There is no route definition with the name indicated in the plan',
        'DFROUTE_NAME_KO' : 'Failed to query by route name',

    // DEF_FORMAT

        // SEARCH
        'DFFRMT_SEARCH_OK' : 'Formation definition search was successful',
        'DFFRMT_SEARCH_KO' : 'Failed to search definitions of formations',

        // ADD
        'DFFRMT_ADD_OK' : 'Formation definition has been added successfully',
        'DFFRMT_ADD_KO' : 'Failed to add formation definition',

        // SEEK
        'DFFRMT_SEEK_OK' : 'The details of the formation definition have been consulted correctly',
        'DFFRMT_SEEK_KO' : 'Failed to query the details of the formation definition',

        // DELETE
        'DFFRMT_DEL_OK' : 'Formation definition removed correctly',
        'DFFRMT_DEL_KO' : 'Failed to delete formation definition',

        // EDIT
        'DFFRMT_EDT_OK' : 'The definition of the formation has been modified correctly',
        'DFFRMT_EDT_KO' : 'Error modifying formation definition',

        // B??squeda por nombre
        'DFFRMT_NAME_EXST' : 'There is already a formation definition with the name indicated in this plan',
        'DFFRMT_NAME_NOT_EXST' : 'There is no definition of formation with the name indicated in the plan',
        'DFFRMT_NAME_KO' : 'Failed to query by formation definition name',

        // B??squeda por ID de Formaci??n
        'DFFRMTID_NOT_EXST' : 'The definition of the indicated formation does not exist',
        'DFFRMTID_EXST' : 'The definition of the indicated formation exists',
        'DFFRMTID_KO' : 'Failed to query for Formation ID',

        // B??squeda de implementacione de la formaci??n en edificios
        'DFFRMT_IMPL_EXST' : 'Formation definition cannot be deleted while you have building deployments',
        'DFFRMT_IMPL_NOT_EXST' : 'The definition of formation has no implementations in buildings',
        'DFFRMT_IMPL_KO' : 'Failed to query formations deployments',

    // DEF_SIM

        // SEARCH
        'DFSIM_SEARCH_OK' : 'Search for Simulacrum Definitions Succeeded',
        'DFSIM_SEARCH_KO' : 'Failed to find simulacrum definitions',

        // ADD
        'DFSIM_ADD_OK' : 'The simulacrum definition has been added successfully',
        'DFSIM_ADD_KO' : 'Error adding simulacrum definition',

        // SEEK
        'DFSIM_SEEK_OK' : 'Simulacrum definition details were checked successfully',
        'DFSIM_SEEK_KO' : 'Failed to query simulacrum definition details',

        // DELETE
        'DFSIM_DEL_OK' : 'The simulacrum definition has been successfully removed',
        'DFSIM_DEL_KO' : 'Failed to delete simulacrum definition',

        // EDIT
        'DFSIM_EDT_OK' : 'The definition of the simulacrum has been modified correctly',
        'DFSIM_EDT_KO' : 'Error modifying simulacrum definition',

        // B??squeda por ID de Simulacro
        'DFSIMID_NOT_EXST' : 'The indicated simulacrum definition does not exist',
        'DFSIMID_EXST' : 'The definition of the indicated simulacrum exists',
        'DFSIMID_KO' : 'Failed to query by Simulacrum ID',

        // Consulta de implementaciones de simulacros
        'DFSIM_IMPL_EXST' : 'You cannot delete the simulacrum definition while you have building deployments',
        'DFSIM_IMPL_NOT_EXST' : 'The definition of the simulacrum has no implementations in buildings',
        'DFSIM_IMPL_KO' : 'Failed to query simulacrum implementations',

        // B??squeda por nombre de simulacro
        'DFSIM_NAME_EXST' : 'A simulacrum definition already exists with the name indicated in this plan',
        'DFSIM_NAME_NOT_EXST' : 'There is no definition of simulacrum with the name indicated in this plan',
        'DFSIM_NAME_KO' : 'Failed to query by simulacrum name',

    // BUILD_PLAN

        // SEARCH
        'BLDPLAN_SEARCH_OK' : 'The search for buildings assigned to the plan was successful',
        'BLDPLAN_SEARCH_KO' : 'Failed to retrieve the buildings assigned to the plan',

        // ADD
        'DFPLAN_ADD_NOT_DOCS' : 'The plan must have at least one document definition to be assigned',
        'DFROUTE_EXST_FLRS_NOT_EXST' : 'The plan contains route definitions and some of the buildings do not have associated floors',
        'BLDPLAN_ADD_OK' : 'The indicated buildings have been assigned to the plan correctly',
        'BLDPLAN_ADD_KO' : 'Failed to create mapping between buildings and plan',

        // SEEK
        'BLDPLAN_SEEK_OK' : 'The details of the allocation between the Building and the Plan have been correctly consulted',
        'BLDPLAN_SEEK_KO' : 'Error when consulting the details of the assignment between the indicated Building and Plan',

        // DELETE
        'BLDPLAN_DEL_OK' : 'The assignment between the indicated Building and Plan has been successfully removed',
        'BLDPLAN_DEL_KO' : 'Error when deleting the assignment between the indicated Building and Plan',

        // VENCER ASIGNACIONES
        'BLDPLAN_EDTSTATE_OK' : 'Assignments have expired successfully',
        'BLDPLAN_EDTSTATE_KO' : 'Failed to expire assignments',
        'BLDPLAN_ALREADY_EXPIRED' : 'The indicated assignment is already expired',

        // B??squeda de asignaciones Activas
        'BLDPLAN_ASSIGN_ACTIVES_NOT_EXST' : 'The indicated plan has no active assignments',
        'BLDPLAN_ASSIGN_ACTIVES_EXST' : 'The indicated plan has active assignments',
        'BLDPLAN_ASSIGN_ACTIVES_KO' : 'Failed to query active plan assignments',

        // Vencer Implementaciones
        'IMPDOC_EDTSTATE_KO' : 'Error expiring document implementations',
        'IMPPROC_EDTSTATE_KO' : 'Error expiring procedure implementations',
        'IMPROUTE_EDTSTATE_KO' : 'Error expiring routes implementations',
        'IMPFRMT_EDTSTATE_KO' : 'Error expiring formations implementations',
        'IMPSIM_EDTSTATE_KO' : 'Error expiring simulacrums implementations',

        // Directorios
        'BLDPLAN_DIRPLAN_KO' : 'Failed to create Plan root directory',
        'BLDPLAN_DIRBLD_KO' : 'Failed to create the Building directory',
        'BLDPLAN_DIRDOC_KO' : 'Error creating directory of Document definition',
        'BLDPLAN_DIRPROC_KO' : 'Error creating directory of Procedure definition',
        'BLDPLAN_DIRROUTE_KO' : 'Error creating directory of Route definition',

        // Busq. Asociaciones Edificio - Plan
        'BLDPLAN_EXST' : 'There is already an allocation between any of the buildings and the indicated plan',
        'BLDPLAN_NOT_EXST' : 'The building is not assigned to the indicated plan',
        'BLDPLAN_KO' : 'Error when querying allocations between plans and buildings',

        // Implementaciones
        'IMPDOC_ADD_KO' : 'Error creating document deployments',
        'IMPDOC_DEL_KO' : 'Failed to remove deployments from documents',
        'IMPPROC_ADD_KO' : 'Error creating procedure implementations',
        'IMPPROC_DEL_KO' : 'Failed to remove implementations of procedures',
        'IMPROUTE_ADD_KO' : 'Error creating route implementations',
        'IMPROUTE_DEL_KO' : 'Failed to remove deployments from routes',
        'IMPFRMT_ADD_KO' : 'Error creating formations deployments',
        'IMPFRMT_DEL_KO' : 'Failed to remove deployments from formations',
        'BLDPLAN_IMPADD_OK' : 'Deployments have been created successfully',
        'IMPSIM_ADD_KO' : 'Error creating simulacrums deployments',
        'IMPSIM_DEL_KO' : 'Failed to remove simulacrums deployments',
        'BLD_IMPDEL_OK' : 'Deployments have been removed successfully',

        // B??squeda de Edificios candidatos
        'BLDPLAN_CANDIDATES_EMPT' : 'There are no buildings assignable to the plan',
        'BLDPLAN_CANDIDATES_OK' : 'Search for buildings assignable to plan Ok',
        'BLDPLAN_CANDIDATES_KO' : 'Failed to retrieve assignable buildings to plan',

    // PLANS

        // SEARCH
        'PLAN_SEARCH_OK' : 'Plan search was successful',
        'PLAN_SEARCH_KO' : 'Failed to search for plans',

        // SEEK
        'PLAN_SEEK_FRBD' : 'You do not have permission to consult plans in this building',
        'PLAN_SEEK_OK' : 'Plan details were successfully consulted',

        // B??squeda de Planes del Portal
        'PRTL_PLANS_SEARCH_OK' : 'The portal plan search was successful',
        'PRTL_PLANS_SEARCH_KO' : 'Failed to find portal plans',

    // IMP_DOCS

        // SEARCH
        'IMPDOC_SEARCH_OK' : 'The search for document completions was successful',
        'IMPDOC_SEARCH_KO' : 'Error looking for document completions',

        // ADD
        'IMPDOC_ADD_OK' : 'The document completions have been added correctly',
        'IMPDOC_BLD_NOT_OWNED' : 'You do not have the necessary privileges to add completions in the indicated building',
        'BLDPLAN_EXPIRED' : 'The action cannot be performed. The allocation between the plan and the building is expired',

        // SEEK
        'IMPDOC_SEEK_OK' : 'The details of the correct completion of the document have been consulted',
        'IMPDOC_SEEK_KO' : 'Error when consulting the details of the completion of the document',

        // EXPIRE
        'IMPDOC_EXPIRE_OK' : 'Completion of the indicated document has been successfully expired',
        'IMPDOC_EXPIRE_KO' : 'Error expiring the completion of the document',

        // IMPLEMENTACION
        'IMPDOC_IMPL_OK' : 'The filling in of the document has been completed correctly',
        'IMPDOC_IMPL_KO' : 'Error completing the filling in of the document',
        'COMPL_EXPIRED' : 'The action cannot be performed, the completion is expired',

        // B??squeda de cumplimentaciones de documentos del portal
        'PRTL_IMPDOC_SEARCH_OK' : 'The search for completions of portal documents has been carried out correctly',
        'PRTL_IMPDOC_SEARCH_KO' : 'Error when searching for portal document completions',

        // Detalles de cumplimentacines del portal
        'PRTL_IMPDOC_SEEK_OK' : 'The details of completing the portal procedure have been consulted correctly',
        'PRTL_IMPDOC_SEEK_KO' : 'Error when consulting the details of the completion of the portal procedure',

        // B??squeda de m??s de una cumplimentaci??n de documento en el edificio
        'IMPDOC_UNIQ' : 'Completion cannot be removed. There must always be at least one completion of the document',
        'IMPDOC_NOT_UNIQ' : 'There is more than one completion of the document in the building',

        // Permisos
        'BLD_FRBD' : 'You do not have the necessary privileges to carry out actions on this building',

        // B??squeda de cumplimentaciones por documento y edificio
        'BLDDOCS_SEARCH_OK' : 'The search for completions was successful',
        'BLDDOCS_SEARCH_KO' : 'Error searching for completions',

        // B??squeda de asignaciones por plan
        'BLDPLAN_ASSIGN_NOT_EXST' : 'No plan assignments found with buildings',
        'BLDPLAN_ASSIGN_EXST' : 'Plan assignments found with buildings',

        // B??squeda por id de cumplimentaci??n del documento
        'IMPDOCID_NOT_EXST' : 'The completion of the indicated document does not exist',
        'IMPDOCID_EXST' : 'The completion of the document exists',
        'IMPDOCID_KO' : 'Error when consulting the completion of the document',

        // Directorios
        'DIRFILE_ROOT_NOT_EXST' : 'Definition base path does not exist',
        'DIRFILE_IMP_ALR_EXST' : 'The directory of the completion already exists',
        'DIRFILE_IMPDIR_ADD_KO' : 'Failed to create the filling directory',
        'FILE_ADD_OK' : 'The file of the completion has been uploaded correctly',
        'FILE_ADD_KO' : 'Error uploading the completion file',

        // B??squeda de asignaciones activas
        'BLDDOC_ACTIVE_EMPT' : 'The plan to which the document belongs has no active associations with buildings',
        'BLDDOC_ACTIVE_OK' : 'The plan that the document belongs to has active associations with buildings',
        'BLDDOC_ACTIVE_KO' : 'Failed to query active plan associations with buildings',

        // B??squeda de cumplimentaciones del documento en un edificio
        'IMPDOC_ACTIVE_EXST' : 'There are already active completions of this document in some of the buildings',
        'IMPDOC_ACTIVE_NOT_EXST' : 'There are no active completions of this document',
        'IMPDOC_ACTIVE_KO' : 'Error when consulting active completions',

        // Asociaci??n Documento - Edificio
        'BLDDOC_NOT_EXST' : 'The indicated building has not been assigned the plan to which this document belongs',
        'BLDDOC_EXST' : 'The indicated building is assigned the plan to which the document belongs',
        'BLDDOC_KO' : 'Failed to query the association between the building and the document plan',

    // IMP_PROCS

        // SEARCH
        'IMPPROC_SEARCH_OK' : 'The search for completions of the procedure has been carried out correctly',
        'IMPPROC_SEARCH_KO' : 'Error looking for procedure completions',

        // ADD
        'IMPPROC_ADD_OK' : 'Completion of the procedure has been recorded successfully',

        // DELETE
        'IMPPROC_DEL_OK' : 'Procedure completion has been successfully removed',

        // SEEK
        'IMPPROC_SEEK_OK' : 'The details of completing the procedure have been obtained correctly',
        'IMPPROC_SEEK_KO' : 'Failed to get the details of the procedure completion',

        // EXPIRE
        'IMPPROC_EXPIRE_OK' : 'Completion of the indicated procedure has been successfully completed',
        'IMPPROC_EXPIRE_KO' : 'An error occurred when completing the procedure.',

        // IMPLEMENT
        'IMPPROC_IMPL_OK' : 'Procedure completion has been completed successfully',
        'IMPPROC_IMPL_KO' : 'Error completing the procedure completion',

        // B??squeda por ID de Cumplimentaci??n
        'IMPPROCID_NOT_EXST' : 'The completion of the procedure does not exist',
        'IMPPROCID_EXST' : 'The procedure completion ID exists',
        'IMPPROCID_KO' : 'Error when querying by ID of the procedure completion',

        // B??squeda de cumplimentaci??n ??nica
        'IMPPROC_UNIQ' : 'Completion cannot be removed. There must always be at least one completion of the procedure in the building',
        'IMPPROC_NOT_UNIQ' : 'More than one completion of the procedure was found in the building',

        // B??squeda de cumplimentaciones de procedimientos del Portal
        'PRTL_IMPPROC_SEARCH_OK' : 'The search for completions of the portal procedure has been carried out correctly',
        'PRTL_IMPPROC_SEARCH_KO' : 'Failed to search for portal procedure completions',

        // B??squeda de cumplimentaciones activas de un procedimiento en un edificio
        'IMPPROC_ACTIVE_EXST' : 'The action could not be performed. Active completions of this procedure have been found',
        'IMPPROC_ACTITVE_NOT_EXST' : 'No active completions of this procedure have been found',
        'IMPPROC_ACTIVE_KO' : 'Error when querying the active completions of the procedure',

        // B??squeda de cumplimentaciones por edificio y procedimiento
        'BLDPROCS_SEARCH_OK' : 'The search for completions was successful',
        'BLDPROCS_SEARCH_KO' : 'Error searching for completions',

        // B??squeda asociaci??n edificio - plan
        'BLDPROC_NOT_EXST' : 'El plan al que pertenece el procedimiento no est?? asignado al edificio indicado',
        'BLDPROC_EXST' : 'El plan al que pertenece el procedimiento est?? asignado al edificio indicado',
        'BLDPROC_KO' : 'Error al consultar la asociaci??n entre el plan del procedimiento y el edificio',

    // IMP_ROUTES

        // SEARCH
        'IMPROUTE_SEARCH_OK' : 'The search for route completions was successful',
        'IMPROUTE_SEARCH_KO' : 'Failed to search for route completions',

        // ADD
        'IMPROUTE_ADD_OK' : 'The completion of the route has been registered correctly',
        'BLD_FLOOR_EMPT' : 'Route completions cannot be registered in this building as it does not have assigned floors',

        // SEEK
        'IMPROUTE_SEEK_OK' : 'The details of the completion of the route have been consulted correctly',
        'IMPROUTE_SEEK_KO' : 'Error when consulting the details of the completion of the route',

        // EXPIRE
        'IMPROUTE_EXPIRE_OK' : 'The completion of the route has been successfully expired',
        'IMPROUTE_EXPIRE_KO' : 'Error when expiring the route completion',

        // IMPLEMENT
        'IMPROUTE_IMPL_OK' : 'The completion of the route has been completed successfully',
        'IMPROUTE_IMPL_KO' : 'Error completing the completion of the route',

        // DELETE
        'IMPROUTE_DEL_OK' : 'Route completion has been successfully removed',

        // B??squeda de cumplimentaci??n de ruta ??nica en el edificio
        'IMPROUTE_UNIQ' : 'Completion cannot be removed. There must always be at least one completion of the route in the building',
        'IMPROUTE_NOT_UNIQ' : 'The completion of the route is not unique',

        // B??squeda por ID de Cumplimentaci??n
        'IMPROUTEID_NOT_EXST' : 'The completion of the indicated route does not exist',
        'IMPROUTEID_EXST' : 'The completion of the route exists',
        'IMPROUTEID_KO' : 'Error when querying for completion id',

        // B??squeda de plantas del edificio
        'BLD_NOT_FLOORS' : 'Completion could not be added. Some of the indicated buildings do not have registered floors',
        'BLD_FLOORS_SEARCH_EMPT': 'The indicated building does not have registered floors',
        'BLD_FLOORS_OK' : 'Building floor search Ok',
        'BLD_FLOORS_KO' : 'Failed to find the floors of the building',

        // B??squeda de cumplimentaciones del Portal
        'PRTL_IMPROUTE_SEARCH_OK' : 'The search for completions of the route in the portal has been carried out correctly',
        'PRTL_IMPROUTE_SEARCH_KO' : 'Error when consulting the route completions in the portal',

        // B??squeda asociaci??n edificio - ruta
        'BLDROUTE_NOT_EXST' : 'The plan to which the route belongs is not assigned to the indicated building',
        'BLDROUTE_EXST' : 'The plan to which the route belongs is assigned to the indicated building',
        'BLDROUTE_KO' : 'Failed to query the association between the route plan and the building',

        // B??squeda de cumplimentaciones por edificio y ruta
        'BLDROUTES_SEARCH_OK' : 'The search for completions was successful',
        'BLDROUTES_SEARCH_KO' : 'Error searching for completions',

    // IMP_FORMAT

        // SEARCH
        'IMPFORMAT_SEARCH_OK' : 'The search for formation completions has been carried out correctly',
        'IMPFORMAT_SEARCH_KO' : 'Error when looking for formation completions',

        // ADD
        'IMPFORMAT_ADD_OK' : 'Successful completion of the formation has been recorded',
        'IMPFORMAT_ADD_KO' : 'An error occurred while creating the formation completion',

        // DELETE
        'IMPFORMAT_DEL_OK' : 'Formation completion has been successfully removed',
        'IMPFORMAT_DEL_KO' : 'Error when eliminating the completion of the formation',

        // SEEK
        'IMPFORMAT_SEEK_OK' : 'The details of completing the formation have been consulted correctly',
        'IMPFORMAT_SEEK_KO' : 'An error occurred while checking the details of completing the formation',

        // EXPIRE
        'IMPFORMAT_EXPIRE_OK' : 'Completion of the formation has been successfully completed',
        'IMPFORMAT_EXPIRE_KO' : 'Error when completing the formation completion',

        // IMPLEMENT
        'IMPFORMAT_IMPL_OK' : 'The formation has been completed correctly',
        'IMPFORMAT_IMPL_KO' : 'Error completing the formation',

        // SEEK PORTAL
        'PRTL_IMPFORMAT_SEEK_OK' : 'The details of completing the portal formation have been consulted correctly',
        'PRTL_IMPFORMAT_SEEK_KO' : 'Error when consulting the details of the completion of the portal formation',

        // Consulta de cumplimentaci??n ??nica
        'IMPFORMAT_UNIQ' : 'Completion cannot be removed. There must always be at least one completion of the formation in the building',
        'IMPFORMAT_NOT_UNIQ' : 'Completing formation in the building is not unique',

        // Consulta por ID de Cumplimentaci??n
        'IMPFORMATID_NOT_EXST' : 'The id of the completion of the formation indicated does not exist',
        'IMPFORMATID_EXST' : 'The formation completion id exists',
        'IMPFORMATID_KO' : 'Error when querying for formation completion id',

        // Detalles de la Formaci??n del Portal
        'PRTL_IMPFORMAT_SEARCH_OK' : 'The details of the formation on the portal have been obtained correctly',
        'PRTL_IMPFORMAT_SEARCH_KO' : 'Failed to get the formation details from the portal',

        // B??squeda asociaci??n edificio - formacion
        'BLDFORMAT_NOT_EXST' : 'The plan to which the formation belongs is not assigned to the indicated building',
        'BLDFORMAT_EXST' : 'The plan to which the formation belongs is assigned to the indicated building',
        'BLDFORMAT_KO' : 'Error when consulting the association between the formation plan and the building',

        // B??squeda de cumplimentaciones
        'BLDFORMATS_SEARCH_OK' : 'The completions of the formation in the building have been consulted correctly',
        'BLDFORMATS_SEARCH_KO' : 'Error when consulting the formation completions in the building',

    // IMP_SIM

        // SEARCH
        'IMPSIM_SEARCH_OK' : 'The search for simulacrum completions has been carried out correctly',
        'IMPSIM_SEARCH_KO' : 'Error when looking for simulacrum completions',
        'DOC_SEEK_FRBD' : 'You do not have the necessary privileges to consult documents in this building',

        // ADD
        'IMPSIM_ADD_OK' : 'The completion of the simulacrum has been recorded correctly',

        // DELETE
        'IMPSIM_DEL_OK' : 'The completion of the simulacrum has been successfully removed',

        // SEEK
        'IMPSIM_SEEK_OK' : 'The details of completing the simulacrum have been consulted correctly',
        'IMPSIM_SEEK_KO' : 'Error when consulting the details of the completion of the simulacrum',

        // EXPIRE
        'IMPSIM_EXPIRE_OK' : 'The completion of the simulacrum has been successfully completed',
        'IMPSIM_EXPIRE_KO' : 'Error when completing the simulacrum',

        // IMPLEMENT
        'IMPSIM_IMPL_OK' : 'The completion of the simulacrum has been completed successfully',
        'IMPSIM_IMPL_KO' : 'Error completing the completion of the simulacrum',

        // PORTAL SEEK
        'PRTL_IMPSIM_SEEK_OK' : 'The details of completing the simulacrum of the portal have been consulted correctly',
        'PRTL_IMPSIM_SEEK_KO' : 'Error when consulting the details of the completion of the simulacrum of the portal',

        // Consulta por ID de Cumplimentaci??n
        'IMPSIMID_NOT_EXST' : 'The id of the simulacrum completion does not exist',
        'IMPSIMID_EXST' : 'The id of the simulacrum completion exists',
        'IMPSIMID_KO' : 'Error when querying for the id of the simulacrum completion',

        // Consulta de cumplimentaci??n ??nica
        'IMPSIM_UNIQ' : 'Completion cannot be removed. There must always be at least one simulacrum completion in the building',
        'IMPSIM_NOT_UNIQ' : 'Completion is not unique',

        // Detalles del simulacro del portal
        'PRTL_IMPSIM_SEARCH_OK' : 'The details of the simulacrum of the portal have been consulted correctly',
        'PRTL_IMPSIM_SEARCH_KO' : 'Failed to check the details of the simulacrum of the portal',

        // Consulta de la asignaci??n entre el plan del simulacro y el edificio
        'BLDSIM_NOT_EXST' : 'The plan to which the simulacrum belongs is not assigned to the indicated building',
        'BLDSIM_EXST' : 'The plan to which the simulacrum belongs is assigned to the indicated building',
        'BLDSIM_KO' : 'Failed to query association between simulacrum plan and building',

        // B??squeda de cumplimentaciones
        'BLDSIMS_SEARCH_OK' : 'The completions of the simulacrum in the building have been consulted correctly',
        'BLDSIMS_SEARCH_KO' : 'Error when consulting the completions of the simulacrum in the building',

    // NOTIFICACIONES

        // DELETE
        'NTF_DEL_OK' : 'Notification has been removed successfully',
        'NTF_DEL_KO' : 'Failed to delete notification',

        // SEARCH
        'NTF_SEARCH_OK' : 'Search notifications was successful',
        'NTF_SEARCH_KO' : 'Failed to search for notifications',

        // SEARCH_FORM
        'NTF_BLDS_KO' : 'Failed to retrieve buildings with posted notifications',
        'NTF_PLANS_KO' : 'Failed to retrieve plans with posted notifications',

        // SEEK
        'NTF_EDT_READ_KO' : 'Failed to modify notification status',
        'NTF_SEEK_OK' : 'Notification details retrieved successfully',

        // Obtener nuevas notificaciones
        'NTF_UR_EMPT' : 'User has no new notifications',
        'NTF_UR_FILL' : 'User has new notifications',
        'NTF_UR_KO' : 'Failed to search for new notifications',

        // Permisos
        'NTF_USR_FRBD' : 'You do not have the necessary permissions to view the notification',

        // B??squeda de Notificaci??n por ID
        'NTFID_NOT_EXST' : 'The indicated notification does not exist',
        'NTFID_EXST' : 'The notification exists',
        'NTF_SEEK_KO' : 'Failed to check notification details',


        // Validaciones

            // Nombre de Usuario
            'USRNM_SHRT' : 'Username must exceed 3 characters',
            'USRNM_LRG' : 'Username cannot exceed 20 characters',
            'USRNM_ALF' : 'Username can only contain alphanumeric characters',

            // Password
            'PSW_SHRT' : 'Password security is compromised. Short encrypted password',
            'PSW_LRG' : 'Password security is compromised. Long encrypted password',
            'PSW_FRMT' : 'Password security is compromised. Password encrypted with characters not allowed',

            // DNI
            'DNI_EMPT' : 'The DNI cannot be empty',
            'DNI_FRMT' : 'Wrong DNI format',

            // ROL
            'ROL_EMPT' : 'The Rol cannot be empty',
            'ROL_FRMT' : 'The indicated role is not contemplated',

            // Nombre
            'NAM_SHRT' : 'Name must exceed 3 characters',
            'NAM_LRG' : 'Name cannot exceed 30 characters',
            'NAM_LT_SPC' : 'Name can only contain alphanumeric characters and spaces',

            // Apellidos
            'SRNM_SHRT' : 'Surname must exceed 3 characters',
            'SRNM_LRG' : 'Surname cannot exceed 60 characters,',
            'SRNM_LT_SPC' : 'Surname can only contain alphanumeric characters and spaces',

            // Email
            'EML_EMPT' : 'Email cannot be empty',
            'EML_FRMT' : 'Wrong Email format',

            // Telefono
            'TLF_EMPT' : 'Phone number cannot be empty',
            'TLF_FRMT' : 'Wrong phone number format',
            'TLF_MAX_SIZE' : 'The phone number exceeds the maximum size',
            'TLF_WITH_LETTERS' : 'The phone number can only contain numbers',

            // Foto_Perfil
            'PRPH_KO' : 'Error while uploading the profile picture',
            'PRPH_EXT' : 'Image extension is not allowed',
            'PRPH_LRG' : 'Image size is larger than allowed (100kb)',
            'PRPH_FRMT' : 'The name of the profile picture can only contain letters, numbers and hyphens',

            // Edificio_ID
            'BLD_ID_EMPT' : 'Building ID cannot be empty',
            'BLD_ID_NOT_NUMERIC' : 'Building ID must be numeric',

            // Responsable (Usuario)
            'MANG_SHRT' : 'The name of the building manager must exceed 3 characters',
            'MANG_LRG' : 'The name of the building manager cannot exceed 20 characters',
            'MANG_ALF' : 'The name of the building manager can only contain alphanumeric characters',

            // Building Name
            'BLD_NAM_SHRT' : 'The name of the building must exceed 3 characters',
            'BLD_NAM_LRG' : 'The name of the building must not exceed 60 characters',
            'BLD_NAM_FRMT' : 'The building name can only contain alphanumeric characters, spaces, numbers and accents',

            // Calle
            'CALLE_SHRT' : 'The street must exceed 8 characters',
            'CALLE_LRG' : 'The street must not exceed 60 characters',
            'CALLE_FRMT' : 'The street can only contain alphanumeric characters, spaces and numbers',

            // Ciudad
            'CIUDAD_SHRT' : 'The city must exceed 3 characters',
            'CIUDAD_LRG' : 'The city must not exceed 40 characters',
            'CIUDAD_FRMT' : 'The city can only contain letters and spaces',

            // Provincia
            'PROV_SHRT' : 'The province must exceed 3 characters',
            'PROV_LRG' : 'The province must not exceed 40 characters',
            'PROV_FRMT' : 'The province can only contain letters and spaces',

            // C??digo Postal
            'CP_EMPT' : 'You need to specify a zip code',
            'CP_NUMERIC' : 'Zip code must be numeric',
            'CP_SIZE' : 'Zip code must be a 5-digit number',
            'CP_MAX_SIZE' : 'Zip code must not exceed 5 digits',

            // Foto Edificio
            'BLD_PH_EXT' : 'The extension of the building photo is not allowed',
            'BLD_PH_FRMT' : 'The building photo name can only contain letters, numbers and hyphens',

            // Nombre Planta
            'FLR_NAM_SHRT' : 'The name of the floor must exceed 3 characters',
            'FLR_NAM_LRG' : 'The name of the floor must not exceed 40 characters',
            'FLR_NAM_FRMT' : 'The floor name can only contain alphanumeric characters, spaces, numbers and accents',

            // N??mero de Planta
            'NUM_FLOOR_EMPT' : 'The floor number cannot be empty',
            'NUM_FLOOR_LRG': 'The floor number must be a 1 or 2 digit number',
            'NUM_FLOOR_NOT_NUMERIC' : 'The floor number must be a number',

            // Descripci??n
            'DESC_EMPTY' : 'The description field cannot be empty',
            'DESC_FRMT' : 'Description field contains illegal characters',

            // Foto Planta
            'FLR_PH_EXT' : 'The extension of the floor photo is not allowed',
            'FLR_PH_FRMT' : 'The name of the floor photo can only contain letters, numbers and hyphens',

            // Planta ID
            'FLR_ID_EMPT' : 'Floor ID cannot be empty',
            'FLR_ID_NOT_NUMERIC' : 'Floor ID must be numeric',

            // Espacio ID
            'SPC_ID_EMPT' : 'Space ID cannot be empty',
            'SPC_ID_NOT_NUMERIC' : 'The space ID must be numeric',

            // Nombre del Espacio
            'SPC_NAM_SHRT' : 'The name of the space must exceed 3 characters',
            'SPC_NAM_LRG' : 'The name of the space must not exceed 40 characters',
            'SPC_NAM_FRMT' : 'The space name can only contain alphanumeric characters, spaces, numbers and accents',

            // Foto Espacio
            'SPC_PH_EXT' : 'The photo extension of the space is not allowed',
            'SPC_PH_FRMT' : 'The name of the space photo can only contain letters, numbers and hyphens',

            // ID DefPlan
            'DFPLAN_ID_EMPT' : 'Plan ID cannot be empty',
            'DFPLAN_ID_NOT_NUMERIC' : 'Plan ID must be numeric',

            // Nombre Definici??n
            'DEFNAM_SHRT' : 'The definition name must be longer than 5 characters',
            'DEFNAM_LRG' : 'The definition name must not exceed 60 characters',
            'DEFNAM_FRMT' : 'Definition name contains illegal characters',

            // ID DefDoc
            'DFDOC_ID_EMPT' : 'Document ID cannot be empty',
            'DFDOC_ID_NOT_NUMERIC' : 'The Document ID must be numeric',

            // Nombre DefDoc
            'DFDOC_NAM_SHRT' : 'The name of the document must be longer than 5 characters',
            'DFDOC_NAM_LRG' : 'The name of the document must not exceed 50 characters',
            'DFDOC_NAM_FRMT' : 'Document name contains illegal characters',

            // Documento visible
            'DFDOC_VISB_EMPT' : 'It must be indicated if the document will be visible or not',
            'DFDOC_VISB_VALUES' : 'The allowed values to indicate the visibility of the document are yes or no',

            // ID DefProc
            'DFPROC_ID_EMPT' : 'Procedure ID cannot be empty',
            'DFPROC_ID_NOT_NUMERIC' : 'Procedure ID must be numeric',

            // Nombre Procedimiento
            'DFPROC_NAM_SHRT' : 'The name of the procedure must exceed 5 characters',
            'DFPROC_NAM_LRG' : 'The name of the procedure must not exceed 50 characters',
            'DFPROC_NAM_FRMT' : 'Procedure name contains illegal characters',

            // ID DefRoute
            'DFROUTE_ID_EMPT' : 'Route ID cannot be empty',
            'DEFROUTE_ID_NOT_NUMERIC' : 'The Route ID must be numeric',

            // Nombre DefRoute
            'DFROUTE_NAM_SHRT' : 'The route name must exceed 5 characters',
            'DFROUTE_NAM_LRG' : 'The route name must not exceed 50 characters',
            'DFROUTE_NAM_FRMT' : 'Route name contains illegal characters',

            // ID DefFormat
            'DFFRMT_ID_EMPT' : 'Formation ID cannot be empty',
            'DEFFRMT_ID_NOT_NUMERIC' : 'The Formation ID must be numeric',

            // Nombre Formaci??n
            'DFFRMT_NAM_SHRT' : 'The name of the formation must exceed 5 characters',
            'DFFRMT_NAM_LRG' : 'The name of the formation must not exceed 50 characters',
            'DFFRMT_NAM_FRMT' : 'Formation name contains illegal characters',

            // ID DefSim
            'DFSIM_ID_EMPT' : 'Simulacrum ID cannot be empty S',
            'DFSIM_ID_NOT_NUMERIC' : 'Simulacrum ID must be numeric',

            // Nombre Simulacro
            'DFSIM_NAM_SHRT' : 'The name of the simulacrum must exceed 5 characters',
            'DFSIM_NAM_LRG' : 'The name of the simulacrum must not exceed 50 characters',
            'DFSIM_NAM_FRMT' : 'The simulacrum name contains illegal characters',

            // Fecha asignaci??n
            'BLDPLAN_DATEASSIGN_KO' : 'The assignment date is not in a valid format',

            // Fecha implementaci??n
            'BLDPLAN_DATECOMP_KO' : 'The completion date is not in a valid format',


            // Estado asignaci??n entre Edificio y Plan
            'BLDPLAN_STATE_EMPT' : 'Assignment status cannot be empty',
            'BLDPLAN_STATE_KO' : 'The invalid status. Valid statuses are Pending, Completed, and Expired',

            // NOMBRE_DOC
            'FILENAME_EMPT' : 'The completion file cannot be empty',
            'FILENAME_LRG' : 'The file name of the completion cannot exceed 50 characters',
            'FILENAME_FRMT' : 'The file name of the completion can only contain letters, numbers and hyphens',
            'FILENAME_EXT' : 'The completion file must be in pdf format',

            // ID Completion
            'CUMP_ID_EMPT' : 'The id of the completion cannot be empty',
            'CUMP_ID_NOT_NUMERIC' : 'The id of the completion must be numeric',

            // Fecha Planificaci??n
            'PLANNING_DATE_EMPT' : 'The planning date cannot be empty',
            'PLANNING_DATE_KO' : 'The entered planning date is in the wrong format',
            'PLANNING_DATE_PAST' : 'The planning date entered is a past date',

            // Fecha Asignaci??n
            'START_DATEASSIGN_KO' : 'The initial assignment date entered is in the wrong format',
            'END_DATEASSIGN_KO' : 'The final assignment date entered has an incorrect format',

            // Fecha Vencimiento
            'DATEEXPIRE_KO' : 'The expiration date entered is in the wrong format',

            // Destinatarios
            'RECIPIENTS_EMPT' : 'Recipients field cannot be empty',
            'RECIPIENTS_LRG' : 'The recipients field cannot exceed 200 characters',
            'RECIPIENTS_FRMT' : 'Recipients field contains illegal characters',

            // URL
            'URL_FRMT' : 'The URL of the resource entered is in an incorrect format',
            'URL_LRG' : 'The length of the URL must not exceed 200 characters',

            // ID Formaci??n
            'IMPFORMAT_ID_EMPT' : 'The formation completion id cannot be empty',
            'IMPFORMAT_ID_NOT_NUMERIC' : 'The id of the completion of the formation must be numeric',

            // Fecha Planificaci??n Inicial
            'START_PLANNING_DATE_KO' : 'The initial planning date is in an incorrect format',

            // Fecha Planificaci??n Final
            'END_PLANNING_DATE_KO' : 'Final planning date is in the wrong format',

            // Fecha Vencimiento Inicial
            'START_DATEEXPIRE_KO' : 'The initial expire date is in the wrong format',

            // Fecha Vencimiento Final
            'END_DATEEXPIRE_KO' : 'The final expire date is in the wrong format',

            // Fecha Cumplimentaci??n Inicial
            'START_DATECOMP_KO' : 'The initial completion date is in the wrong format',

            // Fecha Cumplimentaci??n Final
            'END_DATECOMP_KO' : 'The final completion date is in an incorrect format',

            // ID Notificaci??n
            'NTFID_EMPT' : 'Notification ID cannot be empty',
            'NTFID_NOT_NUMERIC' : 'The notification ID must be numeric',

            // Fecha Inicio
            'START_DATE_KO' : 'The start date is in the wrong format',

            // Fecha Fin
            'END_DATE_KO' : 'The end date is in the wrong format',

            // Le??do
            'READ_KO' : 'The attribute read only admits the values YES or NO',



    // INTERFACE
        // HEADER
        'i18n-idioma' : 'Language',
        'i18n-login' : 'Login',
        'i18n-admin' : 'Administration Panel',
        'i18n-logout' : 'Logout',

        // PORTAL_COUNTRIES
        'i18n-app-welcome' : '??Welcome to SG2P!',
        'i18n-select-city' : 'Select a city to search for Buildings',
        'i18n-l-buildings' : 'Search Buildings',

        // LOGIN
        'i18n-username' : 'Username',
        'i18n-password' : 'Password',

        // MESSAGE_VIEW
        'i18n-msg-system' : 'System Message',
        'i18n-back' : 'Go Back',

        // DESHBOARD VIEW
        'i18n-select-option' : 'Select an option',
        'i18n-users': 'Users',
        'i18n-profile' : 'My Profile',
        'i18n-buildings' : 'Buildings',
        'i18n-admin-plans' : 'Administrate Plans',
        'i18n-manage-plans' : 'Manage Plans',
        'i18n-info_users' : 'Management of Users registered in the system',
        'i18n-info_profile' : 'Management of your User\'s data',
        'i18n-info_buildings' : 'Management of the data of the Buildings, Floors and Spaces',
        'i18n-info_impplans' : 'Management of the completion of the Plans in the Buildings',
        'i18n-info_defplans' : 'Manage the definitions of the Plans and their assignments with Buildings',

        // USER VIEWS
        'i18n-dni' : 'DNI',
        'i18n-rol' : 'Role',
        'i18n-details' : 'Details',
        'i18n-edit' : 'Edit',
        'i18n-delete' : 'Delete',
        'i18n-f-administrador' : 'Administrator',
        'i18n-f-edificio' : 'Building Manager',
        'i18n-f-organizacion' : 'Organization Manager',
        'i18n-f-registrado' : 'Registered User',
        'i18n-search-users' : 'Users Search',
        'i18n-nombre' : 'Name',
        'i18n-apellidos' : 'Surname',
        'i18n-telefono' : 'Phone',
        'i18n-email' : 'Email',
        'i18n-cancelar' : 'Cancel',
        'i18n-enviar' : 'Send',
        'i18n-todos' : 'All',
        'i18n-add-users' : 'Add User',
        'i18n-selecciona-rol' : 'Select a Role',
        'i18n-foto_perfil' : 'Profile Photo',
        'i18n-del-user-confirm' : 'Are you sure you want to delete this user? The action will not be reversible',
        'i18n-edit-user' : 'Editar Usuario',
        'i18n-user-details' : 'User Details',

        // BUILDINGS VIEWS
        'i18n-edificio_id' : 'Building ID',
        'i18n-responsable' : 'Manager',
        'i18n-ciudad' : 'City',
        'i18n-buildings-empty' : 'No buildings found',
        'i18n-add-building' : 'Add Building',
        'i18n-calle' : 'Street',
        'i18n-provincia' : 'Province',
        'i18n-codigo_postal' : 'Zip Code',
        'i18n-fax' : 'Fax',
        'i18n-del-building-confirm' : 'Are you sure you want to delete this building? The action will not be reversible',
        'i18n-edit-building' : 'Edit Building',
        'i18n-search-building' : 'Search Building',
        'i18n-view-floors' : 'Show Floors',
        'i18n-building-details' : 'Building Details',
        'i18n-search-floor' : 'Search Floors',
        'i18n-foto_edificio' : 'Building Photo',

        // FlOORS VIEWS
        'i18n-floors' : 'Floors',
        'i18n-planta_id' : 'Floor ID',
        'i18n-num_planta' : 'Floor number',
        'i18n-floors-empty' : 'No floors found',
        'i18n-add-floor' : 'Add Building',
        'i18n-descripcion' : 'Description',
        'i18n-details-floor' : 'Floor Details',
        'i18n-del-floor-confirm' : 'Are you sure you want to remove this floor? The action will not be reversible',
        'i18n-edit-floor' : 'Edit Floor',
        'i18n-view-spaces' : 'Show Spaces',
        'i18n-foto_planta' : 'Floor Photo',
        'i18n-floor_details' : 'Floor Details',

        // SPACES VIEWS
        'i18n-spaces' : 'Spaces',
        'i18n-espacio_id' : 'Space ID',
        'i18n-spaces-empty' : 'No spaces found',
        'i18n-add-space' : 'Add Space',
        'i18n-foto_espacio' : 'Space Photo',
        'i18n-del-space-confirm' : 'Are you sure you want to delete this space? The action will not be reversible',
        'i18n-details-space' : 'Space Details',
        'i18n-search-space' : 'Search Spaces',
        'i18n-edit-space' : 'Edit Space',

        // PORTAL VIEWS
        'i18n-resp-info' : 'Consult the information regarding the building manager',
        'i18n-contact' : 'Contact',
        'i18n-address' : 'Address',
        'i18n-details-manager' : 'Manager Details',
        'i18n-floors-info' : 'Check the information on the floors and spaces of the building',
        'i18n-select-building' : 'Select a Building',
        'i18n-select-floor' : 'Select a Floor',
        'i18n-portal-floors-empty' : 'This building does not have registered floors yet',
        'i18n-piso' : 'Floor number: ',
        'i18n-floor-spaces' : 'Floor Spaces',
        'i18n-prevent_plans' : 'Prevention Plans',
        'i18n-prevent_plans-info' : 'Consult the information on the Building Prevention Plans',

        // DEF_PLANS VIEW
        'i18n-def-plans' : 'Definitions of Plans',
        'i18n-def-plans-empty' : 'No plan definitions found',
        'i18n-plan_id' : 'ID Plan',
        'i18n-del-def-plan-confirm' : 'Are you sure you want to delete the definition of this plan? The action will not be reversible',
        'i18n-search-def-plan' : 'Search Plan Def.',
        'i18n-showCurrent-defPlan' : 'Details of the Plan Def',
        'i18n-show-plans-defdocs' : 'Document Defs.',
        'i18n-show-plans-defprocs' : 'Procedure Defs.',
        'i18n-show-plans-defroutes' : 'Routes Defs.',
        'i18n-show-plans-deformats' : 'Formations Defs.',
        'i18n-show-plans-defsims' : 'Simulacrums Defs.',
        'i18n-edit-defPlan' : 'Edit Plan Def.',
        'i18n-show-plans-bldplans' : 'Assigned Buildings',

        // DEF_DOCS VIEW
        'i18n-def-docs' : 'Document Definitions',
        'i18n-visible' : 'Visible',
        'i18n-def-docs-empty' : 'No document definitions found',
        'i18n-add-defDoc' : 'Define Document',
        'i18n-yes': 'Yes',
        'i18n-no' : 'No',
        'i18n-del-def-doc-confirm' : 'Are you sure you want to remove the definition from this document? The change will not be reversible',
        'i18n-documento_id' : 'Document ID',
        'i18n-search-defDoc' : 'Search Documents Definitions',
        'i18n-edit-defDoc' : 'Edit Document Definition',
        'i18n-current-defDoc' : 'Details of the Document Def.',

        // DEF_PROCS VIEW
        'i18n-def-procs' : 'Definitions of Procedures',
        'i18n-procedimiento_id' : 'Procedure ID',
        'i18n-def-procs-empty' : 'No procedure definitions found',
        'i18n-add-defProc' : 'Define Procedure',
        'i18n-del-def-proc-confirm' : 'Are you sure you want to delete the definition of this procedure? The action will not be reversible',
        'i18n-current-defProc' : 'Details of the Procedure Def.',
        'i18n-search-defProc' : 'Search Procedures Definitions',
        'i18n-edit-defProc' : 'Edit Procedure Definition',

        // DEF_ROUTES VIEW
        'i18n-def-routes' : 'Routes Definitions',
        'i18n-ruta_id' : 'Route ID',
        'i18n-def-routes-empty' : 'No routes definitions found',
        'i18n-add-defRoute' : 'Route Definition',
        'i18n-del-def-route-confirm' : 'Are you sure you want to delete the definition of this route? The change will not be reversible',
        'i18n-current-defRoute' : 'Details of the Route Def.',
        'i18n-search-defRoute' : 'Search Routes Definitions',
        'i18n-edit-defRoute' : 'Edit Route Definition',

        // DEF_FORMATS VIEW
        'i18n-def-formats' : 'Formation Definitions',
        'i18n-formacion_id' : 'Formation ID',
        'i18n-def-formats-empty' : 'No formation definitions found',
        'i18n-add-defFormat' : 'Formation Definition',
        'i18n-del-def-format-confirm' : 'Are you sure you want to delete the definition of this formation? The change will not be reversible',
        'i18n-current-defFormat' : 'Details of the Formation Def.',
        'i18n-search-defFormat' : 'Search Formations Definitions',
        'i18n-edit-defFormat' : 'Edit Formation Definition',


        // DEF_SIMS VIEW
        'i18n-def-sims' : 'Simulacrums Definitions',
        'i18n-simulacro_id' : 'Simulacrum ID',
        'i18n-def-sims-empty' : 'No simulacrum definitions found',
        'i18n-add-defSim' : 'Simulacrum Definition',
        'i18n-del-def-sim-confirm' : 'Are you sure you want to delete the definition of this simulacrum? The change will not be reversible',
        'i18n-current-defSim' : 'Details of the Simulacrum Definitions',
        'i18n-search-defSim' : 'Search Simulacrums Definitions',
        'i18n-edit-defSim' : 'Edit Simulacrum Definition',

        // BUILDINGS_PLANS
        'i18n-assign-bldplan' : 'Assigned Buildings',
        'i18n-building' : 'Building',
        'i18n-date_assign' : 'Assignment Date',
        'i18n-state' : 'Status',
        'i18n-date_comp' : 'Completion Date',
        'i18n-pendiente' : 'PENDING',
        'i18n-cumplimentado' : 'COMPLETED',
        'i18n-vencido' : 'EXPIRED',
        'i18n-bldplan-empty' : 'No assigned buildings found',
        'i18n-add-buildPlan' : 'Assign Buildings',
        'i18n-del-bldplan-confirm' : 'Are you sure you want to remove this assignment? The change will not be reversible',
        'i18n-expire' : 'Expire',
        'i18n-expire_all' : 'Expire ALL',
        'i18n-expireAll-bldplan-confirm' : 'Are you sure you want to expire ALL assignments in this Plan? The change will not be reversible',
        'i18n-nombre_edificio' : 'Building Name',
        'i18n-date_expire' : 'Expiration Date',

        // PLANS
        'i18n-plan' : 'Plan',
        'i18n-list-plans-empty' : 'No Plan assignments found',
        'i18n-list-plans' : 'List of Plans',
        'i18n-documentos' : 'Documents',
        'i18n-procedimientos' : 'Procedures',
        'i18n-rutas' : 'Routes',
        'i18n-formaciones' : 'Formations',
        'i18n-simulacros' : 'Simulacrums',
        'i18n-info_plan' : 'Plan Information',
        'i18n-elements_plan' : 'Plan elements',
        'i18n-nombre_plan' : 'Plan Name',
        'i18n-start_date_assign' : 'Initial Assignment Date',
        'i18n-end_date_assign' : 'Final Assignment Date',

        // IMP_DOCS
        'i18n-show-impdocs' : 'See Completions',
        'i18n-implement' : 'Completions',
        'i18n-imp-docs-empty' : 'No document completions were found',
        'i18n-nombre_doc' : 'Document Name',
        'i18n-impdocs' : 'Document Completions',
        'i18n-info_doc' : 'Document Information',
        'i18n-cump_id' : 'Completion ID',
        'i18n-add-implements' : 'Add Completions',
        'i18n-file_doc' : 'Completion File',
        'i18n-documento' : 'Document',
        'i18n-add-implement-confirm' : 'Are you sure you want to add the following completion?',
        'i18n-del-imp-doc-confirm' : 'Are you sure you want to remove the completion of this document? The change will not be reversible',
        'i18n-expire-impdoc-confirm' : 'Are you sure you want to expire the completion of this document? The change will not be reversible',
        'i18n-cump-doc' : 'Complete Document',
        'i18n-actual-imp' : 'Current Completion',
        'i18n-imp-details' : 'Completion Details',
        'i18n-search-imps' : 'Search Completions',

        // IMP_PROCS
        'i18n-impprocs' : 'Completions of the Procedure',
        'i18n-imp-procs-empty' : 'No completions of the procedure have been found',
        'i18n-info_proc' : 'Procedure Information',
        'i18n-del-imp-proc-confirm' : 'Are you sure you want to remove the completion of this procedure? The change will not be reversible',
        'i18n-expire-impproc-confirm' : 'Are you sure you want to beat the completion of this procedure? The change will not be reversible',
        'i18n-cump-proc' : 'Complete Procedure',

        // IMP_ROUTES
        'i18n-improutes' : 'Route Completions',
        'i18n-nombre_planta' : 'Floor Name',
        'i18n-imp-routes-empty' : 'Route completions have not been found',
        'i18n-info_route' : 'Route Information',
        'i18n-expire-improute-confirm' : 'Are you sure you want to beat the completion of this route? The change will not be reversible',
        'i18n-cump-route' : 'Complete Route',
        'i18n-del-imp-route-confirm' : 'Are you sure you want to remove the completion of this route? The change will not be reversible',
        'i18n-start_date_comp' : 'Initial Completion Date',
        'i18n-end_date_comp' : 'Final Completion Date',

        // IMP_FORMATS
        'i18n-impformats' : 'Formation Completions',
        'i18n-planning_date' : 'Planning Date',
        'i18n-imp-formats-empty' : 'No formation completions found',
        'i18n-info_format' : 'Formation Information',
        'i18n-del-imp-format-confirm' : 'Are you sure you want to eliminate the completion of this formation? The change will not be reversible',
        'i18n-expire-impformat-confirm' : 'Are you sure you want to beat the completion of this formation? The change will not be reversible',
        'i18n-current_planning_date' : 'Current Planning Date',
        'i18n-url_recurso' : 'Resource URL',
        'i18n-destinatarios' : 'Recipients',
        'i18n-enlace_url' : 'Access the Resource',
        'i18n-cump-form' : 'Complete Formation',

        // IMP_SIMS
        'i18n-impsim' : 'Simulacrum Completions',
        'i18n-imp-sims-empty' : 'No completions of the simulacrum have been found',
        'i18n-info_sim' : 'Simulacrum Information',
        'i18n-del-imp-sim-confirm' : 'Are you sure you want to remove the completion of this simulacrum? The change will not be reversible',
        'i18n-expire-impsim-confirm' : 'Are you sure you want to beat the completion of this simulacrum? The change will not be reversible',
        'i18n-cump-sim' : 'Complete Simulacrum',
        'i18n-start_planning_date' : 'Initial Planning Date',
        'i18n-end_planning_date' : 'Final Planning Date',
        'i18n-start_date_expire' : 'Initial Expiration Date',
        'i18n-end_date_expire' : 'Final Expiration Date',

        // NOTIFICACIONES
        'i18n-notifications' : 'Notifications',
        'i18n-show_notifications' : 'Notifications List',
        'i18n-notifications-empty' : 'No Notifications found',
        'i18n-read' : 'Read',
        'i18n-date' : 'Date',
        'i18n-search-notifications' : 'Search Notifications',
        'i18n-fecha_inicio' : 'Start Date',
        'i18n-fecha_fin' : 'End Date',
        'i18n-msg' : 'Message',
        'i18n-notification-details' : 'Notification Details',
        'i18n-del-notification-confirm' : 'Are you sure you want to delete the notification? The change will not be reversible',

        // MODAL
            // Campos Modal
            'modal-title' : '??Warning!',
            'p-modal' : 'The field ',
            'm-username' : ' Username ',
            'm-password' : ' Password ',
            'm-dni' : ' DNI ',
            'm-nombre' : ' Name ',
            'm-telefono' : ' Phone ',
            'm-email' : ' Email ',
            'm-rol' : ' Role ',
            'm-apellidos' : ' Surname ',
            'm-foto_perfil' : ' Profile Photo ',
            'm-calle' : ' Street ',
            'm-ciudad' : ' City ',
            'm-provincia' : ' Province ',
            'm-codigo_postal' : ' Zip Code ',
            'm-fax' : ' Fax ',
            'm-responsable' : ' Manager ',
            'm-foto_edificio' : ' Building Photo ',
            'm-edificio_id' : ' Building ID ',
            'm-num_planta' : ' Floor Number ',
            'm-foto_planta' : ' Floor Photo ',
            'm-descripcion' : ' Description ',
            'm-planta_id' : ' Floor ID ',
            'm-espacio_id' : ' Space ID ',
            'm-documento_id' : ' Document ID ',
            'm-plan_id' : ' Plan ID ',
            'm-procedimiento_id' : ' Procedure ID ',
            'm-ruta_id' : ' Route ID ',
            'm-formacion_id' : ' Formation ID ',
            'm-simulacro_id' : ' Simulacrum ID ',
            'm-buildings' : ' Buildings ',
            'm-nombre_edificio' : ' Building Name ',
            'm-nombre_doc' : ' File Completion ',
            'm-nombre_doc_field' : ' Document Name ',
            'm-cumplimentacion_id' : ' Completion ID ',
            'm-nombre_planta' : ' Floor Name ',
            'm-url_recurso' : ' Resource URL ',
            'm-fecha_planificacion' : ' Planning Date ',
            'm-destinatarios' : ' Recipients ',
            'm-nombre_plan' : ' Plan Name ',

            // Mensajes Modal
            'i18n-max-size' : 'exceeds the maximum size',
            'i18n-only-letters-numbers' : 'can only contain letters and numbers',
            'i18n-not-empty' : 'cannot be empty',
            'i18n-generic-format' : 'has a wrong format',
            'i18n-letters-spaces-accents-format' : 'only supports letters, spaces and accents',
            'i18n-numbers-format' : 'can only contain numbers',
            'i18n-wrong-enum' : 'has a value not contemplated',
            'i18n-ext-not-allowed' : 'has a not allowed extension',
            'i18n-cp-format' : 'must be a 5 digit number',
            'i18n-letters-numbers-accents-spaces' : 'can only contain letters, numbers, accents, and spaces',
            'i18n-chars-not_allow' : 'contains illegal characters',
            'i18n-only-letters-numbers-hyphen' : 'can only contain letters, numbers and hyphens',
            'i18n-filename-search-format' : 'It can only contain letters, numbers, hyphens, and only supports .pdf extension',
            'i18n-url-format' : 'contains illegal characters or a protocol other than http, https or ftp is being specified',
            'i18n-fecha-menor-actual' : 'must be greater than or equal to the current date',
}
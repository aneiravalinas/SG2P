arrayGA = {
    // Xerais da Base de Datos
    '00001' : 'Éxito na execución do SQL',
    '00002' : 'O recordset vén vacío',
    '00003' : 'O recordset vén con datos',
    '00101' : 'Error ao conectar coa base de datos. Contacte co seu administrador',
    '00102' : 'Error na execución do SQL',

    // CALENDARIO
        // Errores de inserción
        '01001' : 'Éxito na inserción do calendario',
        '01101' : 'Error de inserción do calendario',
        '01102' : 'Error de inserción. O calendario xa existe',

        // Errores de edición
        '01011' : 'Éxito na edición do calendario',
        '01111' : 'Error de edición do calendario',

        // Errores de eliminación
        '01021' : 'Éxito na eliminación do calendario',
        '01121' : 'Error de eliminación do calendario',

        // Errores de busca
        '01031' : 'Éxito na busca do calendario',
        '01131' : 'Error de busca do calendario',

        // Errores de obtención
        '01041' : 'Éxito na obtención do calendario. Volve vacía',
        '01042' : 'Éxito na obtención do calendario. Volve con datos',    
        '01141' : 'Error de obtención do calendario',

        // Errores de formato
            // Id
            '01051' : 'Éxito de validación de id de calendario',
            '01151' : 'A id do calendario non pode ser vacía',
            '01152' : 'A id do calendario debe ser un número',
            '01153' : 'A id do calendario debe ser maior ou igual que 0',
            '01154' : 'A id do calendario debe ser menor que 100',

            // Nome
            '01052' : 'Éxito de validación de nome de calendario',
            '01155' : 'O nome do calendario non pode ser vacío',
            '01156' : 'O nome do calendario debe estar formado só por caracteres alfabéticos ou espacios',
            '01157' : 'O tamaño do nome do calendario debe ser menor ou igual que 40',

            // Descrición
            '01053' : 'Éxito de validación de descrición de calendario',
            '01158' : 'A descrición do calendario non pode ser vacío',
            '01159' : 'A descrición do calendario debe estar formado só por caracteres alfabéticos ou espacios',
            '01160' : 'O tamaño da descrición do calendario debe ser menor ou igual que 100',

            // Datas
            '01054' : 'Éxito de validación de data de calendario',
            '01161' : 'A data do calendario non pode ser vacío',
            '01162' : 'A data do calendario debe seguir ou formato de data',

            // Horas
            '01055' : 'Éxito de validación de hora de calendario',
            '01163' : 'A hora do calendario non pode ser vacío',
            '01164' : 'A hora do calendario debe seguir ou formato de hora',

    // USUARIO
        // Errores de inserción
        '02001' : 'Éxito na inserción do usuario',
        '02101' : 'Error de inserción do usuario',
        '02102' : 'Error de inserción do usuario. O usuario xa existe',
        '02103' : 'Error de inserción do usuario. O email xa existe',

        // Errores de edición
        '02011' : 'Éxito na edición do usuario',
        '02111' : 'Error de edición do usuario',

        // Errores de eliminación
        '02021' : 'Éxito na eliminación do usuario',
        '02121' : 'Error de eliminación do usuario',
        '02122' : 'Error de eliminación do usuario. É responsable de recurso',

        // Errores de busca
        '02031' : 'Éxito na busca de usuarios',
        '02131' : 'Error de busca de usuarios',

        // Errores de obtención por login
        '02041' : 'Éxito na obtención de usuario. Volve vacía',
        '02042' : 'Éxito na obtención de usuario. Volve con datos',    
        '02141' : 'Error de obtención de usuario',

        // Errores de obtención por email
        '02051' : 'Éxito na obtención de usuario. Volve vacía',
        '02052' : 'Éxito na obtención de usuario. Volve con datos',    
        '02151' : 'Error de obtención de usuario',

        // Errores de rexistro
        '02061' : 'Rexistro correcto do usuario',
        '02161' : 'Error de rexistro do usuario. O email xa está rexistrado',
        '02162' : 'Error de rexistro do usuario. O usuario xa está rexistrado',

        // Errores de login
        '02071' : 'Inicio de sesión correcto',
        '02171' : 'Error de inicio de sesión. O usuario non existe',
        '02172' : 'Error de inicio de sesión. O contrasinal es incorrecta',
        '02173' : 'Error de inicio de sesión. O usuario está inactivo. Contacte ó Administrador',

        // Errores de formato
            // Login
            '02081' : 'Éxito de validación de login de usuario',
            '02181' : 'O login do usuario non pode ser vacío',
            '02182' : 'O login do usuario debe estar formado só por caracteres alfanumericos ou guións',
            '02183' : 'O tamaño do login debe ser menor ou igual que 15',
            '02184' : 'O tamaño do login debe ser maior ou igual que 3',

            // Nome
            '02082' : 'Éxito de validación de nome de usuario',
            '02185' : 'O nome do usuario non pode ser vacío',
            '02186' : 'O nome do usuario debe estar formado só por caracteres alfabéticos, guións estándar ou espacios',
            '02187' : 'O tamaño do nome do usuario debe ser menor ou igual que 60',

            // Email
            '02083' : 'Éxito de validación de email de usuario',
            '02188' : 'O email do usuario non pode ser vacío',
            '02189' : 'O tamaño do email do usuario debe ser menor ou igual que 40',
            '02190' : 'O email do usuario debe seguir o formato email',

            // Es_admin
            '02084' : 'Éxito de validación de es_admin',
            '02191' : 'O campo es_admin non pode ser vacío',
            '02192' : 'O campo es_admin debe ser [SI/NON]',

            // Es_activo
            '02085' : 'Éxito de validación de es_activo',
            '02193' : 'O campo es_activo non pode ser vacío',
            '02194' : 'O campo es_activo debe ser [SI/NON]',

    // RESPONSABLE DE RECURSO
        // Errores de inserción
        '03001' : 'Éxito na inserción de responsable',
        '03101' : 'Error de inserción de responsable',
        '03102' : 'Error de inserción de responsable. O responsable xa existe',
        '03103' : 'Error de inserción de responsable. O usuario non existe',

        // Errores de edición
        '03011' : 'Éxito na edición de responsable',
        '03111' : 'Error de edición de responsable',

        // Errores de eliminación
        '03021' : 'Éxito na eliminación do responsable',
        '03121' : 'Error na eliminación do responsable',
        '03122' : 'Error na eliminación do responsable. Ten recursos asignados',

        // Errores de busca
        '03031' : 'Éxito na busca de usuarios',
        '03131' : 'Error de busca de usuarios',

        // Errores de obtención
        '03041' : 'Éxito na obtención de responsable. Volve vacía',
        '03042' : 'Éxito na obtención de responsable. Volve con datos',    
        '03141' : 'Error de obtención de responsable',

        // Errores de formato
            // Direccion
            '03051' : 'Éxito de validación de dirección de responsable',
            '03151' : 'A dirección do responsable non pode ser vacía',
            '03152' : 'A dirección do responsable debe estar formado só por caracteres alfanuméricos, /, &, ª, º e espacio',
            '03153' : 'A dirección do responsable debe ser menor ou igual que 60',

            // Teléfono
            '03052' : 'Éxito de validación de teléfono de responsable',
            '03154' : 'O teléfono do responsable non pode ser vacío',
            '03155' : 'O teléfono do responsable debe ser de formato teléfono',

    // RECURSO
        // Errores de inserción
        '04001' : 'Éxito na inserción do recurso',
        '04101' : 'Error de inserción do recurso',
        '04102' : 'Error de inserción do recurso. O recurso xa existe',
        '04103' : 'Error de inserción do recurso. O responsable de recurso non existe',

        // Errores de edición
        '04011' : 'Éxito na edición do recurso',
        '04111' : 'Error de edición do recurso',

        // Errores de eliminación
        '04021' : 'Éxito na eliminación do recurso',
        '04121' : 'Error de eliminación do recurso',

        // Errores de busca
        '04031' : 'Éxito na busca do recurso',
        '04131' : 'Error de busca do recurso',

        // Errores de obtención
        '04041' : 'Éxito na obtención do recurso. Volve vacía',
        '04042' : 'Éxito na obtención do recurso. Volve con datos',    
        '04141' : 'Error de obtención',

        // Errores de formato
            // Id
            '04051' : 'Éxito de validación de id de recurso',
            '04151' : 'A id do recurso non pode ser vacía',
            '04152' : 'A id do recurso debe ser un número',
            '04153' : 'A id do recurso debe ser maior ou igual que 0',
            '04154' : 'A id do recurso debe ser menor ou igual que 999',

            // Nome
            '04052' : 'Éxito de validación de nome de recurso',
            '04155' : 'O nome do recurso non pode ser vacío',
            '04156' : 'O nome do recurso debe estar formado só por caracteres alfabéticos e espacios',
            '04157' : 'O tamaño do nome do recurso debe ser menor ou igual que 40',

            // Descripción
            '04053' : 'Éxito de validación de descripción de recurso',
            '04158' : 'A descripción do recurso non pode ser vacío',
            '04159' : 'A descripción do recurso debe estar formado só por caracteres alfabéticos e espacios',
            '04160' : 'O tamaño da descripción do recurso debe ser menor ou igual que 100',

            // Login responsable
            '04054' : 'Éxito de validación de login responsable de recurso',
            '04161' : 'O login do responsable do recurso non pode ser vacío',
            '04162' : 'O login do responsable do recurso debe estar formado só por caracteres alfanumericos ou guións',
            '04163' : 'O tamaño do login do responsable do recurso debe ser menor ou igual a 15',
            '04164' : 'O tamaño do login do responsable do recurso debe ser maior ou igual a 3',

            // Tarifa
            '04055' : 'Éxito de validación de tarifa de recurso',
            '04165' : 'A tarifa do recurso non pode ser vacío',
            '04166' : 'A tarifa do recurso debe ser un número',
            '04167' : 'A tarifa do recurso debe ser maior ou igual que 0',
            '04168' : 'A tarifa do recurso debe ser menor ou igual que 999',

            // Rango tarifa
            '04056' : 'Éxito de validación de rango de tarifa de recurso',
            '04169' : 'O rango de tarifa do recurso non pode ser vacío',
            '04170' : 'O rango de tarifa do recurso debe ser HORA / DIA / SEMANA / MES',

            // Borrado lóxico
            '04057' : 'Éxito de validación de borrado lóxico de recurso',
            '04171' : 'O campo borrado lóxico do recurso non pode ser vacío',
            '04172' : 'O campo borrado lóxico do recurso debe ser SI / NON',

    // HORARIO
        // Errores de inserción
        '05001' : 'Éxito na inserción do horario',
        '05101' : 'Error de inserción do horario',
        '05102' : 'Error de inserción do horario. O horario xa existe',
        '05103' : 'Error de inserción do horario. O calendario non existe',
        '05104' : 'Error de inserción do horario. A reserva está fóra do rango do calendario especificado',
        '05105' : 'Error de inserción do horario. O recurso non existe',
        '05106' : 'Error de inserción do horario. Existen reservas no horario especificado',
        '05107' : 'Error de inserción do horario. O usuario solicitante non existe',

        // Errores de edición
        '05011' : 'Éxito na edición do horario',
        '05111' : 'Error de edición do horario',

        // Errores de eliminación
        '05021' : 'Éxito na eliminación do horario',
        '05121' : 'Error de eliminación do horario',

        // Errores de busca
        '05031' : 'Éxito na busca do horario',
        '05131' : 'Error de busca do horario',

        // Errores de obtención
        '05041' : 'Éxito na obtención do horario. Volve vacía',
        '05042' : 'Éxito na obtención do horario. Volve con datos',    
        '05141' : 'Error de obtención do horario',

        // Errores de formato
            // Id horario
            '05051' : 'Éxito de validación de horario_id',
            '05151' : 'A id do horario non pode ser vacía',
            '05152' : 'A id do horario debe ser un número',
            '05153' : 'A id do horario debe ser maior ou igual que 0',
            '05154' : 'A id do horario debe ser menor que 99999',

            // Id calendario
            '05052' : 'Éxito de validación de calendario_id',
            '05155' : 'A id do calendario do horario non pode ser vacía',
            '05156' : 'A id do calendario horario debe ser un número',
            '05157' : 'A id do calendario do horario debe ser maior ou igual que 0',
            '05158' : 'A id do calendario do horario debe ser menor ou igual que 100',

            // Id recurso
            '05053' : 'Éxito de validación de recurso_id',
            '05159' : 'A id do recurso do horario non pode ser vacía',
            '05160' : 'A id do recurso horario debe ser un número',
            '05161' : 'A id do recurso do horario debe ser maior ou igual que 0',
            '05162' : 'A id do recurso do horario debe ser menor ou igual que 999',

            // Fecha horario
            '05054' : 'Éxito de validación de data horario',
            '05163' : 'A data do horario non pode ser vacío',
            '05164' : 'A data do horario debe seguir o formato de data',

            // Hora inicio horario
            '05055' : 'Éxito de validación de hora de inicio horario',
            '05165' : 'A hora de inicio do horario non pode ser vacío',
            '05166' : 'A hora de inicio do horario debe seguir o formato de hora',

            // Hora fin horario
            '05056' : 'Éxito de validación de hora de fin horario',
            '05167' : 'A hora de fin do horario non pode ser vacío',
            '05168' : 'A hora de fin do horario debe seguir o formato de hora',

            // Motivo horario
            '05057' : 'Éxito de validación de motivo',
            '05169' : 'A motivación do horario non pode ser vacía',
            '05170' : 'A motivación do horario debe estar formado só por caracteres alfabéticos e espacios',
            '05171' : 'A motivación do horario debe ser menor ou igual que 100',
            
            // Fecha solicitude recurso
            '05058' : 'Éxito de validación de data de solicitude recurso',
            '05172' : 'A data de solicitude non pode ser vacío',
            '05173' : 'A data de solicitude debe seguir o formato de data',

            // Login usuario
            '05059' : 'Éxito de validación de login usuario',
            '05174' : 'O login do usuario que solicita o recurso non pode ser vacío',
            '05175' : 'O login do usuario que solicita o recurso debe ser menor ou igual a 15',
            '05176' : 'O login do usuario que solicita o recurso debe ser maior ou igual a 3',

            // Es reserva
            '05060' : 'Éxito de validación de es reserva',
            '05177' : 'O campo es reserva do horario non pode ser vacío',
            '05178' : 'O campo es reserva do horario debe ser SI / NON',

            // Es rechazada
            '05061' : 'Éxito de validación de es rechazada',
            '05179' : 'O campo es rechazada do horario non pode ser vacío',
            '05180' : 'O campo es rechazada do horario debe ser SI / NON',

            // Fecha respuesta recurso
            '05062' : 'Éxito de validación de data respuesta',
            '05181' : 'A data de respuesta non pode ser vacío',
            '05182' : 'A data de respuesta debe seguir o formato de data',

            // Motivo rexeitamento solicitude
            '05063' : 'Éxito de validación de motivo rexeitamento solicitude',
            '05183' : 'O motivo de rexeitamento da solicitude non pode ser vacía',
            '05184' : 'O motivo de rexeitamento da solicitude debe estar formado só por caracteres alfabéticos e espacios',
            '05185' : 'O motivo de rexeitamento da solicitude debe ser menor ou igual que 100',

            // Foi usado
            '05064' : 'Éxito de validación de foi usado',
            '05186' : 'O campo foi rechazado do horario non pode ser vacío',
            '05187' : 'O campo foi rechazado do horario debe ser SI / NON',

            // Coste solicitude
            '05065' : 'Éxito de validación de coste solicitude',
            '05188' : 'O coste da solicitude non pode ser vacía',
            '05189' : 'O coste da solicitude debe ser un decimal',
            '05190' : 'O coste da solicitude debe ser maior ou igual que 0',
            '05191' : 'O coste da solicitude debe ser menor que 9999.99',

            // Fecha inicio horario
            '05066' : 'Éxito de validación de data de inicio horario',
            '05192' : 'A data de inicio do horario non pode ser vacío',
            '05193' : 'A data de inicio do horario debe seguir o formato de data',

            // Fecha fin horario
            '05067' : 'Éxito de validación de data de fin horario',
            '05194' : 'A data de fin do horario non pode ser vacío',
            '05195' : 'A data de fin do horario debe seguir o formato de data',

    // INTERFACE
        // General
        'SI' : 'Si',
        'NO' : 'Non',
        'hora' : 'Hora',
        'dia' : 'Día',
        'semana' : 'Semana',
        'mes' : 'Mes',
        'lunes' : 'Luns',
        'martes' : 'Martes',
        'miercoles' : 'Mércores',
        'jueves' : 'Xoves',
        'viernes' : 'Venres',
        'sabado' : 'Sábado',
        'domingo' : 'Domingo',

        // Modal
        'non-vacio' : ' non pode ser vacío.',
        'min-size' : ' ten menos do tamaño mínimo.',
        'max-size' : ' excede ou tamaño máximo.',
        'solo-numeros' : ' só debe conter caracteres numéricos',
        'solo-letras' : ' só debe conter letras.',
        'solo-letras-numeros' : ' só debe conter letras e números.',
        'solo-letras-espacios' : ' só debe conter letras e espacios.',
        'solo-letras-guines' : ' só debe conter letras e guións.',
        'solo-letras-espacios-guións' : ' só debe conter letras, espacios e guións.',
        'solo-letras-espacios-especiales' : ' só debe conter letras, espacios e caracteres especiais.',
        'formato-email' : ' non ten un formato correcto de email.',
        'formato-telefono' : ' non ten un formato correcto de teléfono.',
        'formato-hora' : ' non ten un formato de hora correcto.',
        'data-posterior' : ' debe ser posterior.',
        'hora-posterior' : ' debe ser posterior.',

        // Navbar
        'navbar-btn-inicio' : 'Inicio',
        'navbar-btn-recursos' : 'Recursos',
        'navbar-btn-calendarios' : 'Calendarios',
        'navbar-btn-solicitudes' : 'Solicitudes',
        'navbar-btn-usuarios' : 'Usuarios',

        // Mensaxe
        'system-error-msg' : 'Mensaxe do Sistema',

        // Login
        'login-header' : 'Iniciar Sesión', 
        'login_usuario' : 'Login de usuario',
        'pass_usuario' : 'Constrasinal',
        'register-link' : 'Non ten conta? Rexístrate aquí',

        // Rexistro
        'register-header' : 'Rexistro',
        'login_usuario' : 'Login de usuario',
        'pass_usuario' : 'Constrasinal',
        'nombre_usuario' : 'Nome de usuario',
        'email_usuario' : 'Email', 
        'login-link' : 'Xa tes conta? Inicia sesión aquí',

        // Dashboard
        'admin-login-disclaimer' : 'Iniciou sesión como Administrador',
        'admin-login-msg' : 'Dende a navegación pode acceder a todas as funcionalidades que require como usuario Administrador.',
        'responsable-login-disclaimer' : 'Iniciou sesión como Responsable de Recurso',
        'responsable-login-msg' : 'Dende a navegación pode acceder a todas as funcionalidades que require como usuario Responsable de Recurso.',
        'user-login-disclaimer' : 'Iniciou sesión como Usuario',
        'user-login-msg' : 'Dende a navegación pode acceder a todas as funcionalidades que require como Usuario.',
        'discharge-msg' : 'Podería implementarse unha visualización rápida do uso dos recursos aquí, pero non o requiere a especificación da entrega.',

        // Recursos
        'nombre_recurso' : 'Nome do recurso',
        'resources-disclaimer' : 'Recursos dispoñibles',
        'resources-search-disclaimer' : 'Resultado da busca',
        'resources-header-name' : 'Nome do recurso',
        'resources-header-incharge' : 'Responsable do recurso',
        'resources-header-occupation' : 'Ocupación',
        'resources-header-tarifation' : 'Tarifación',
        'resource-deletion-msg' : 'Está seguro de que desexa eliminar permanentemente o recurso ',
        'resource' : 'Recurso: ',
        'resource-new' : 'Novo recurso',
        'resource-search' : 'Busca avanzada',
        'search-warning' : '*Se se escolle a tarifación, só se mostran os recursos de menor ou igual coste non rango de tarifación especificado.',
        'descripcion_recurso' : 'Descrición',
        'login_responsable' : 'Responsable',
        'tarifa_recurso' : 'Tarifación',
        'max_tarifa_recurso' : 'Tarifación máxima',

        // Calendarios
        'nombre_calendario' : 'Nome do calendario',
        'calendars-disclaimer' : 'Calendarios dispoñibles',
        'calendars-search-disclaimer' : 'Resultado da busca',
        'calendars-header-name' : 'Nome do calendario',
        'calendars-header-description' : 'Descrición do calendario',
        'calendars-header-start-date' : 'Data inicio',
        'calendars-header-end-date' : 'Data fin',
        'calendars-header-start-time' : 'Hora inicio',
        'calendars-header-end-time' : 'Hora fin',
        'calendar-deletion-msg' : 'Está seguro de que desexa eliminar permanentemente oucalendario ',
        'includes-date' : 'inclúe data',
        'calendar' : 'Calendario: ',
        'calendar-new' : 'Novo calendario',
        'descripcion_calendario' : 'Descrición',
        'fecha_inicio_calendario' : 'Data inicio',
        'fecha_fin_calendario' : 'Data fin',
        'hora_inicio_calendario' : 'Hora inicio',
        'hora_fin_calendario' : 'Hora fin',

        // Usuarios
        'nombre_usuario' : 'Nome do usuario',
        'users-disclaimer' : 'Usuarios rexistrados',
        'users-search-disclaimer' : 'Resultado da busca',
        'users-header-login' : 'Login do usuario',
        'users-header-name' : 'Nome do usuario',
        'users-header-email' : 'Email',
        'users-header-address' : 'Dirección',
        'users-header-phone' : 'Teléfono',
        'users-header-admin' : 'Admin',
        'users-header-active' : 'Activo',
        'user-deletion-msg' : 'Está seguro de que desexa eliminar permanentemente o usuario ',
        'responsable-downgrade-msg' : 'Está seguro de que desexa dar de baixa como responsable ó usuario ',
        'user' : 'Usuario: ',
        'user-new' : 'Novo usuario',
        'login_usuario' : 'Login usuario',
        'email_usuario' : 'Email',
        'es_admin' : 'é admin',
        'es_activo' : 'está activo',
        'direccion_responsable' : 'Dirección',
        'telefono_responsable' : 'Teléfono',

        // Horarios
        'own-schedule-disclaimer' : 'As miñas solicitudes',
        'assigned-schedule-disclaimer' : 'Solicitudes asignadas a min',
        'all-schedule-disclaimer' : 'Todas as solicitudes',
        'watch-all' : 'Ver todas',
        'watch-asigned' : 'Ver asignadas',
        'schedule-header-resource' : 'Recurso',
        'schedule-header-date' : 'Data',
        'schedule-header-start-time' : 'Hora inicio',
        'schedule-header-end-time' : 'Hora fin',
        'schedule-header-request-motivation' : 'Motivación',
        'schedule-header-cost' : 'Coste',
        'schedule-header-rejected' : 'Estado',
        'schedule-header-used' : 'Usado',
        'schedule-header-rejection-motivation' : 'Motivo rexeitamento',
        'schedule' : 'Solicitude: ',
        'schedule-aproving-msg' : 'Está seguro de que desexa aprobar a solicitude do ',
        'schedule-rejection-msg' : 'Está seguro de que desexa rexeitar a solicitude do ',
        'schedule-using-msg' : 'Está seguro de que desexa marcar como usado o recurso ',
        'rejected' : 'Rexeitada',
        'accepted' : 'Aceptada',
        'description' : 'Descrición: ',
        'tarifa' : 'Tarifa: ',
        'non-calendar-error-msg' : 'Error. Non hay ningún calendario creado. Contacte co administrador.',
        'issue-book' : 'Reservar',
        'schedule-new' : 'Nova solicitude',
        'select-calendario' : 'Calendario',
        'fecha_horario' : 'Data solicitada',
        'hora_inicio_horario' : 'Hora de inicio solicitada',
        'hora_fin_horario' : 'Hora de fin solicitada',
        'motivo_horario' : 'Motivación',
        'cost-amount-disclaimer' : 'Coste',
        'usage-report' : 'Informe de uso:',
        'report-date-range' : 'Rango de datas:',
        'report-date-separator' : 'ata',
        'report-num-solicitudes' : 'Número de solicitudes',
        'report-num-reservas' : 'Número de reservas',
        'report-num-reservas-usadas' : 'Número de reservas usadas',
        'report-aproval-percentage' : 'Porcentaxe de reservas aprobadas',
        'report-usage-percentage' : 'Porcentaxe de reservas usadas',
        'report-usage-time' : 'Tempo ocupado',
        'report-unusage-time' : 'Tempo desocupado',
        'non-calendar' : 'Debe crearse un calendario',
        'horas' : 'horas'
}
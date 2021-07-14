arrayES = {
    // Generales de la Base de Datos
    '00001' : 'Éxito en la ejecición del SQL',
    '00002' : 'El recordset viene vacío',
    '00003' : 'El recordset viene con datos',
    '00101' : 'Error al conectar con la base de datos. Contacte con su administrador',
    '00102' : 'Error en la ejecución del SQL',

    // CALENDARIO
        // Errores de inserción
        '01001' : 'Éxito en la inserción del calendario',
        '01101' : 'Error de inserción del calendario',
        '01102' : 'Error de inserción. El calendario ya existe',

        // Errores de edición
        '01011' : 'Éxito en la edición del calendario',
        '01111' : 'Error de edición del calendario',

        // Errores de eliminación
        '01021' : 'Éxito en la eliminación del calendario',
        '01121' : 'Error de eliminación del calendario',

        // Errores de búsqueda
        '01031' : 'Éxito en la búsqueda de calendarios',
        '01131' : 'Error de búsqueda de calendarios',

        // Errores de obtención
        '01041' : 'Éxito en la obtención de calendario. Vuelve vacía',
        '01042' : 'Éxito en la obtención de calendario. Vuelve con datos',    
        '01141' : 'Error de obtención de calendario',

        // Errores de formato
            // Id
            '01051' : 'Éxito de validación de id del calendario',
            '01151' : 'La id del calendario no puede ser vacía',
            '01152' : 'La id del calendario debe ser un número',
            '01153' : 'La id del calendario debe ser mayor o igual que 0',
            '01154' : 'La id del calendario debe ser menor que 100',

            // Nombre
            '01052' : 'Éxito de validación de nombre del calendario',
            '01155' : 'El nombre del calendario no puede ser vacío',
            '01156' : 'El nombre del calendario debe estar formado solamente por caracteres alfabéticos y espacios',
            '01157' : 'El tamaño del nombre del calendario debe ser menor o igual que 40',

            // Descripción
            '01053' : 'Éxito de validación de descripción del calendario',
            '01158' : 'La descripción del calendario no puede ser vacío',
            '01159' : 'La descripción del calendario debe estar formado solamente por caracteres alfabéticos y espacios',
            '01160' : 'El tamaño de la descripción del calendario debe ser menor o igual que 100',

            // Fechas
            '01054' : 'Éxito de validación de fecha del calendario',
            '01161' : 'La fecha del calendario no puede ser vacío',
            '01162' : 'La fecha del calendario debe seguir el formato de fecha',

            // Horas
            '01055' : 'Éxito de validación de hora del calendario',
            '01163' : 'La hora del calendario no puede ser vacío',
            '01164' : 'La hora del calendario debe seguir el formato de hora',

    // USUARIO
        // Errores de inserción
        '02001' : 'Éxito en la inserción del usuario',
        '02101' : 'Error de inserción del usuario',
        '02102' : 'Error de inserción del usuario. El usuario ya existe',
        '02103' : 'Error de inserción del usuario. El email ya existe',

        // Errores de edición
        '02011' : 'Éxito en la edición del usuario',
        '02111' : 'Error de edición del usuario',

        // Errores de eliminación
        '02021' : 'Éxito en la eliminación del usuario',
        '02121' : 'Error de eliminación del usuario',
        '02122' : 'Error de eliminación del usuario. Es responsable de recurso',

        // Errores de búsqueda
        '02031' : 'Éxito en la búsqueda de usuarios',
        '02131' : 'Error de búsqueda de usuarios',

        // Errores de obtención por login
        '02041' : 'Éxito en la obtención por login de usuario. Vuelve vacía',
        '02042' : 'Éxito en la obtención por login de usuario. Vuelve con datos',    
        '02141' : 'Error de obtención por login de usuario',

        // Errores de obtención por email
        '02051' : 'Éxito en la obtención por email de usuario. Vuelve vacía',
        '02052' : 'Éxito en la obtención por email de usuario. Vuelve con datos',    
        '02151' : 'Error de obtención por email de usuario',

        // Errores de registro
        '02061' : 'Registro correcto del usuario',
        '02161' : 'Error de registro del usuario. El email ya está registrado',
        '02162' : 'Error de registro del usuario. El usuario ya está registrado',

        // Errores de login
        '02071' : 'Inicio de sesión correcto',
        '02171' : 'Error de inicio de sesión. El usuario no existe',
        '02172' : 'Error de inicio de sesión. La contraseña es incorrecta',
        '02173' : 'Error de inicio de sesión. El usuario está inactivo. Contacte al Administrador',

        // Errores de formato
            // Login
            '02081' : 'Éxito de validación de login de usuario',
            '02181' : 'El login del usuario no puede ser vacía',
            '02182' : 'El login del usuario debe estar formado solamente por caracteres alfanumericos o guiones',
            '02183' : 'El tamaño del login debe ser menor o igual que 15',
            '02184' : 'El tamaño del login debe ser mayor o igual que 3',

            // Nombre
            '02082' : 'Éxito de validación de nombre de usuario',
            '02185' : 'El nombre del usuario no puede ser vacío',
            '02186' : 'El nombre del usuario debe estar formado solamente por caracteres alfabéticos, guiones estándar o espacios',
            '02187' : 'El tamaño del nombre del usuario debe ser menor o igual que 60',

            // Email
            '02083' : 'Éxito de validación de email de usuario',
            '02188' : 'El email del usuario no puede ser vacío',
            '02189' : 'El tamaño del email del usuario debe ser menor o igual que 40',
            '02190' : 'El email del usuario debe seguir el formato email',

            // Es_admin
            '02084' : 'Éxito de validación de es_admin',
            '02191' : 'El campo es_admin no puede ser vacío',
            '02192' : 'El campo es_admin debe ser [SI/NO]',

            // Es_activo
            '02085' : 'Éxito de validación de es_activo',
            '02193' : 'El campo es_activo no puede ser vacío',
            '02194' : 'El campo es_activo debe ser [SI/NO]',

    // RESPONSABLE DE RECURSO
        // Errores de inserción
        '03001' : 'Éxito en la inserción de responsable',
        '03101' : 'Error de inserción de responsable',
        '03102' : 'Error de inserción de responsable. El responsable ya existe',
        '03103' : 'Error de inserción de responsable. El usuario no existe',

        // Errores de edición
        '03011' : 'Éxito en la edición de responsable',
        '03111' : 'Error de edición de responsable',

        // Errores de eliminación
        '03021' : 'Éxito en la eliminación del responsable',
        '03121' : 'Error en la eliminación del responsable',
        '03122' : 'Error en la eliminación del responsable. Tiene recursos asignados',

        // Errores de búsqueda
        '03031' : 'Éxito en la búsqueda de usuarios',
        '03131' : 'Error de búsqueda de usuarios',

        // Errores de obtención
        '03041' : 'Éxito en la obtención de responsable. Vuelve vacía',
        '03042' : 'Éxito en la obtención de responsable. Vuelve con datos',    
        '03141' : 'Error de obtención de responsable',

        // Errores de formato
            // Direccion
            '03051' : 'Éxito de validación de dirección de responsable',
            '03151' : 'La dirección del responsable no puede ser vacía',
            '03152' : 'La dirección del responsable debe estar formado solamente por caracteres alfanuméricos, /, &, ª, º y espacio',
            '03153' : 'La dirección del responsable debe ser menor o igual que 60',

            // Teléfono
            '03052' : 'Éxito de validación de teléfono de responsable',
            '03154' : 'El teléfono del responsable no puede ser vacío',
            '03155' : 'El teléfono del responsable debe ser de formato teléfono',

    // RECURSO
        // Errores de inserción
        '04001' : 'Éxito en la inserción del recurso',
        '04101' : 'Error de inserción del recurso',
        '04102' : 'Error de inserción del recurso. El recurso ya existe',
        '04103' : 'Error de inserción del recurso. El responsable de recurso no existe',

        // Errores de edición
        '04011' : 'Éxito en la edición del recurso',
        '04111' : 'Error de edición del recurso',

        // Errores de eliminación
        '04021' : 'Éxito en la eliminación del recurso',
        '04121' : 'Error de eliminación del recurso',

        // Errores de búsqueda
        '04031' : 'Éxito en la búsqueda del recurso',
        '04131' : 'Error de búsqueda del recurso',

        // Errores de obtención
        '04041' : 'Éxito en la obtención del recurso. Vuelve vacía',
        '04042' : 'Éxito en la obtención del recurso. Vuelve con datos',    
        '04141' : 'Error de obtención',

        // Errores de formato
            // Id
            '04051' : 'Éxito de validación de id de recurso',
            '04151' : 'La id del recurso no puede ser vacía',
            '04152' : 'La id del recurso debe ser un número',
            '04153' : 'La id del recurso debe ser mayor o igual que 0',
            '04154' : 'La id del recurso debe ser menor o igual que 999',

            // Nombre
            '04052' : 'Éxito de validación de nombre de recurso',
            '04155' : 'El nombre del recurso no puede ser vacío',
            '04156' : 'El nombre del recurso debe estar formado solamente por caracteres alfabéticos y espacios',
            '04157' : 'El tamaño del nombre del recurso debe ser menor o igual que 40',

            // Descripción
            '04053' : 'Éxito de validación de descripción de recurso',
            '04158' : 'La descripción del recurso no puede ser vacío',
            '04159' : 'La descripción del recurso debe estar formado solamente por caracteres alfabéticos y espacios',
            '04160' : 'El tamaño de la descripción del recurso debe ser menor o igual que 100',

            // Login responsable
            '04054' : 'Éxito de validación de login responsable de recurso',
            '04161' : 'El login del responsable del recurso no puede ser vacío',
            '04162' : 'El login del responsable del recurso debe estar formado solamente por caracteres alfanumericos o guiones',
            '04163' : 'El tamaño del login del responsable del recurso debe ser menor o igual a 15',
            '04164' : 'El tamaño del login del responsable del recurso debe ser mayor o igual a 3',

            // Tarifa
            '04055' : 'Éxito de validación de tarifa de recurso',
            '04165' : 'La tarifa del recurso no puede ser vacío',
            '04166' : 'La tarifa del recurso debe ser un número',
            '04167' : 'La tarifa del recurso debe ser mayor o igual que 0',
            '04168' : 'La tarifa del recurso debe ser menor o igual que 999',

            // Rango tarifa
            '04056' : 'Éxito de validación de rango tarifa de recurso',
            '04169' : 'El rango de tarifa del recurso no puede ser vacío',
            '04170' : 'El rango de tarifa del recurso debe ser HORA / DIA / SEMANA / MES',

            // Borrado lógico
            '04057' : 'Éxito de validación de borrado lógico de recurso',
            '04171' : 'El campo borrado lógico del recurso no puede ser vacío',
            '04172' : 'El campo borrado lógico del recurso debe ser SI / NO',

    // HORARIO
        // Errores de inserción
        '05001' : 'Éxito en la inserción del horario',
        '05101' : 'Error de inserción del horario',
        '05102' : 'Error de inserción del horario. El horario ya existe',
        '05103' : 'Error de inserción del horario. El calendario no existe',
        '05104' : 'Error de inserción del horario. La reserva está fuera del rango del calendario especificado',
        '05105' : 'Error de inserción del horario. El recurso no existe',
        '05106' : 'Error de inserción del horario. Existen reservas en el horario especificado',
        '05107' : 'Error de inserción del horario. El usuario solicitante no existe',

        // Errores de edición
        '05011' : 'Éxito en la edición del horario',
        '05111' : 'Error de edición del horario',

        // Errores de eliminación
        '05021' : 'Éxito en la eliminación del horario',
        '05121' : 'Error de eliminación del horario',

        // Errores de búsqueda
        '05031' : 'Éxito en la búsqueda del horario',
        '05131' : 'Error de búsqueda del horario',

        // Errores de obtención
        '05041' : 'Éxito en la obtención del horario. Vuelve vacía',
        '05042' : 'Éxito en la obtención del horario. Vuelve con datos',    
        '05141' : 'Error de obtención del horario',

        // Errores de formato
            // Id horario
            '05051' : 'Éxito de validación de horario_id',
            '05151' : 'La id del horario no puede ser vacía',
            '05152' : 'La id del horario debe ser un número',
            '05153' : 'La id del horario debe ser mayor o igual que 0',
            '05154' : 'La id del horario debe ser menor que 99999',

            // Id calendario
            '05052' : 'Éxito de validación de calendario_id',
            '05155' : 'La id del calendario del horario no puede ser vacía',
            '05156' : 'La id del calendario horario debe ser un número',
            '05157' : 'La id del calendario del horario debe ser mayor o igual que 0',
            '05158' : 'La id del calendario del horario debe ser menor o igual que 100',

            // Id recurso
            '05053' : 'Éxito de validación de recurso_id',
            '05159' : 'La id del recurso del horario no puede ser vacía',
            '05160' : 'La id del recurso horario debe ser un número',
            '05161' : 'La id del recurso del horario debe ser mayor o igual que 0',
            '05162' : 'La id del recurso del horario debe ser menor o igual que 999',

            // Fecha horario
            '05054' : 'Éxito de validación de fecha de horario',
            '05163' : 'La fecha del horario no puede ser vacío',
            '05164' : 'La fecha del horario debe seguir el formato de fecha',

            // Hora inicio horario
            '05055' : 'Éxito de validación de hora inicio de horario',
            '05165' : 'La hora de inicio del horario no puede ser vacío',
            '05166' : 'La hora de inicio del horario debe seguir el formato de hora',

            // Hora fin horario
            '05056' : 'Éxito de validación de hora fin de horario',
            '05167' : 'La hora de fin del horario no puede ser vacío',
            '05168' : 'La hora de fin del horario debe seguir el formato de hora',

            // Motivo horario
            '05057' : 'Éxito de validación de motivo',
            '05169' : 'La motivación del horario no puede ser vacía',
            '05170' : 'La motivación del horario debe estar formado solamente por caracteres alfabéticos y espacios',
            '05171' : 'La motivación del horario debe ser menor o igual que 100',
            
            // Fecha solicitud recurso
            '05058' : 'Éxito de validación de fecha de solicitud recurso',
            '05172' : 'La fecha de solicitud no puede ser vacío',
            '05173' : 'La fecha de solicitud debe seguir el formato de fecha',

            // Login usuario
            '05059' : 'Éxito de validación de login usuario',
            '05174' : 'El login del usuario que solicita el recurso no puede ser vacío',
            '05175' : 'El login del usuario que solicita el recurso debe ser menor o igual a 15',
            '05176' : 'El login del usuario que solicita el recurso debe ser mayor o igual a 3',

            // Es reserva
            '05060' : 'Éxito de validación de es reserva',
            '05177' : 'El campo es reserva del horario no puede ser vacío',
            '05178' : 'El campo es reserva del horario debe ser SI / NO',

            // Es rechazada
            '05061' : 'Éxito de validación de es rechazada',
            '05179' : 'El campo es rechazada del horario no puede ser vacío',
            '05180' : 'El campo es rechazada del horario debe ser SI / NO',

            // Fecha respuesta recurso
            '05062' : 'Éxito de validación de fecha respuesta',
            '05181' : 'La fecha de respuesta no puede ser vacío',
            '05182' : 'La fecha de respuesta debe seguir el formato de fecha',

            // Motivo rechazo solicitud
            '05063' : 'Éxito de validación de motivo rechazo solicitud',
            '05183' : 'El motivo de rechazo de la solicitud no puede ser vacía',
            '05184' : 'El motivo de rechazo de la solicitud debe estar formado solamente por caracteres alfabéticos y espacios',
            '05185' : 'El motivo de rechazo de la solicitud debe ser menor o igual que 100',

            // Fue usado
            '05064' : 'Éxito de validación de fue usado',
            '05186' : 'El campo fue rechazado del horario no puede ser vacío',
            '05187' : 'El campo fue rechazado del horario debe ser SI / NO',

            // Coste solicitud
            '05065' : 'Éxito de validación de coste solicitud',
            '05188' : 'El coste de la solicitud no puede ser vacía',
            '05189' : 'El coste de la solicitud debe ser un decimal',
            '05190' : 'El coste de la solicitud debe ser mayor o igual que 0',
            '05191' : 'El coste de la solicitud debe ser menor que 9999.99',

            // Fecha inicio horario
            '05066' : 'Éxito de validación de fecha de inicio horario',
            '05192' : 'La fecha de inicio del horario no puede ser vacío',
            '05193' : 'La fecha de inicio del horario debe seguir el formato de fecha',

            // Fecha fin horario
            '05067' : 'Éxito de validación de fecha de fin horario',
            '05194' : 'La fecha de fin del horario no puede ser vacío',
            '05195' : 'La fecha de fin del horario debe seguir el formato de fecha',

    // INTERFAZ
        // General
        'SI' : 'Sí',
        'NO' : 'No',
        'hora' : 'Hora',
        'dia' : 'Día',
        'semana' : 'Semana',
        'mes' : 'Mes',
        'lunes' : 'Lunes',
        'martes' : 'Martes',
        'miercoles' : 'Miércoles',
        'jueves' : 'Jueves',
        'viernes' : 'Viernes',
        'sabado' : 'Sábado',
        'domingo' : 'Domingo',

        // Modal
        'no-vacio' : ' no puede ser vacío.',
        'min-size' : ' tiene menos del tamaño mínimo.',
        'max-size' : ' excede el tamaño máximo.',
        'solo-numeros' : ' sólo debe contener caracteres numéricos',
        'solo-letras' : ' sólo debe contener letras.',
        'solo-letras-numeros' : ' sólo debe contener letras y números.',
        'solo-letras-espacios' : ' sólo debe contener letras y espacios.',
        'solo-letras-guines' : ' sólo debe contener letras y guiones.',
        'solo-letras-espacios-guiones' : ' sólo debe contener letras, espacios y guiones.',
        'solo-letras-espacios-especiales' : ' sólo debe contener letras, espacios y caracteres especiales.',
        'formato-email' : ' no tiene un formato correcto de email.',
        'formato-telefono' : ' no tiene un formato correcto de teléfono.',
        'formato-hora' : ' no tiene un formato de hora correcto.',
        'fecha-posterior' : ' debe ser posterior.',
        'hora-posterior' : ' debe ser posterior.',

        // Navbar
        'navbar-btn-inicio' : 'Inicio',
        'navbar-btn-recursos' : 'Recursos',
        'navbar-btn-calendarios' : 'Calendarios',
        'navbar-btn-solicitudes' : 'Solicitudes',
        'navbar-btn-usuarios' : 'Usuarios',

        // Mensaje
        'system-error-msg' : 'Mensaje del Sistema',

        // Login
        'login-header' : 'Iniciar Sesión', 
        'login_usuario' : 'Login de usuario',
        'pass_usuario' : 'Constraseña',
        'register-link' : '¿No tienes cuenta? Regístrate aquí',

        // Registro
        'register-header' : 'Registro',
        'login_usuario' : 'Login de usuario',
        'pass_usuario' : 'Constraseña',
        'nombre_usuario' : 'Nombre de usuario',
        'email_usuario' : 'Email', 
        'login-link' : '¿Ya tienes cuenta? Inicia sesión aquí',

        // Dashboard
        'admin-login-disclaimer' : 'Ha iniciado sesión como Administrador',
        'admin-login-msg' : 'Desde la navegación puede acceder a todas las funcionalidades que requiere como usuario Administrador.',
        'responsable-login-disclaimer' : 'Ha iniciado sesión como Responsable de Recurso',
        'responsable-login-msg' : 'Desde la navegación puede acceder a todas las funcionalidades que requiere como usuario Responsable de Recurso.',
        'user-login-disclaimer' : 'Ha iniciado sesión como Usuario',
        'user-login-msg' : 'Desde la navegación puede acceder a todas las funcionalidades que requiere como Usuario.',
        'discharge-msg' : 'Podría implementarse una visualización rápida del uso de los recursos aquí, pero no lo requiere la especificación de la entrega.',

        // Recursos
        'nombre_recurso' : 'Nombre del recurso',
        'resources-disclaimer' : 'Recursos disponibles',
        'resources-search-disclaimer' : 'Resultado de la búsqueda',
        'resources-header-name' : 'Nombre del recurso',
        'resources-header-incharge' : 'Responsable del recurso',
        'resources-header-occupation' : 'Ocupación',
        'resources-header-tarifation' : 'Tarifación',
        'resource-deletion-msg' : '¿Está seguro de que desea eliminar permanentemente el recurso ',
        'resource' : 'Recurso: ',
        'resource-new' : 'Nuevo recurso',
        'resource-search' : 'Búsqueda avanzada',
        'search-warning' : '*Si se escoge la tarifación, sólo se muestran los recursos de menor o igual coste en el rango de tarifación especificado.',
        'descripcion_recurso' : 'Descripción',
        'login_responsable' : 'Responsable',
        'tarifa_recurso' : 'Tarifación',
        'max_tarifa_recurso' : 'Tarifación máxima',

        // Calendarios
        'nombre_calendario' : 'Nombre del calendario',
        'calendars-disclaimer' : 'Calendarios disponibles',
        'calendars-search-disclaimer' : 'Resultado de la búsqueda',
        'calendars-header-name' : 'Nombre del calendario',
        'calendars-header-description' : 'Descripción del calendario',
        'calendars-header-start-date' : 'Fecha inicio',
        'calendars-header-end-date' : 'Fecha fin',
        'calendars-header-start-time' : 'Hora inicio',
        'calendars-header-end-time' : 'Hora fin',
        'calendar-deletion-msg' : '¿Está seguro de que desea eliminar permanentemente el calendario ',
        'includes-date' : 'incluye fecha',
        'calendar' : 'Calendario: ',
        'calendar-new' : 'Nuevo calendario',
        'descripcion_calendario' : 'Descripción',
        'fecha_inicio_calendario' : 'Fecha inicio',
        'fecha_fin_calendario' : 'Fecha fin',
        'hora_inicio_calendario' : 'Hora inicio',
        'hora_fin_calendario' : 'Hora fin',

        // Usuarios
        'nombre_usuario' : 'Nombre del usuario',
        'users-disclaimer' : 'Usuarios registrados',
        'users-search-disclaimer' : 'Resultado de la búsqueda',
        'users-header-login' : 'Login del usuario',
        'users-header-name' : 'Nombre del usuario',
        'users-header-email' : 'Email',
        'users-header-address' : 'Dirección',
        'users-header-phone' : 'Teléfono',
        'users-header-admin' : 'Admin',
        'users-header-active' : 'Activo',
        'user-deletion-msg' : '¿Está seguro de que desea eliminar permanentemente el usuario ',
        'responsable-downgrade-msg' : '¿Está seguro de que desea dar de baja como responsable al usuario ',
        'user' : 'Usuario: ',
        'user-new' : 'Nuevo usuario',
        'login_usuario' : 'Login usuario',
        'email_usuario' : 'Email',
        'es_admin' : 'es admin',
        'es_activo' : 'está activo',
        'direccion_responsable' : 'Dirección',
        'telefono_responsable' : 'Teléfono',

        // Horarios
        'own-schedule-disclaimer' : 'Mis solicitudes',
        'assigned-schedule-disclaimer' : 'Solicitudes asignadas a mí',
        'all-schedule-disclaimer' : 'Todas las solicitudes',
        'watch-all' : 'Ver todas',
        'watch-asigned' : 'Ver asignadas',
        'schedule-header-resource' : 'Recurso',
        'schedule-header-date' : 'Fecha',
        'schedule-header-start-time' : 'Hora inicio',
        'schedule-header-end-time' : 'Hora fin',
        'schedule-header-request-motivation' : 'Motivación',
        'schedule-header-cost' : 'Coste',
        'schedule-header-rejected' : 'Estado',
        'schedule-header-used' : 'Usado',
        'schedule-header-rejection-motivation' : 'Motivo rechazo',
        'schedule' : 'Solicitud: ',
        'schedule-aproving-msg' : '¿Está seguro de que desea aprobar la solicitud del ',
        'schedule-rejection-msg' : '¿Está seguro de que desea rechazar la solicitud del ',
        'schedule-using-msg' : '¿Está seguro de que desea marcar como usado el recurso el ',
        'rejected' : 'Rechazada',
        'accepted' : 'Aceptada',
        'description' : 'Descripción: ',
        'tarifa' : 'Tarifa: ',
        'no-calendar-error-msg' : 'Error. No hay ningún calendario creado. Contacte con el administrador.',
        'issue-book' : 'Reservar',
        'schedule-new' : 'Nueva solicitud',
        'select-calendario' : 'Calendario',
        'fecha_horario' : 'Fecha solicitada',
        'hora_inicio_horario' : 'Hora de inicio solicitada',
        'hora_fin_horario' : 'Hora de fin solicitada',
        'motivo_horario' : 'Motivación',
        'cost-amount-disclaimer' : 'Coste',
        'usage-report' : 'Informe de uso:',
        'report-date-range' : 'Rango de fechas:',
        'report-date-separator' : 'a',
        'report-num-solicitudes' : 'Número de solicitudes',
        'report-num-reservas' : 'Número de reservas',
        'report-num-reservas-usadas' : 'Número de reservas usadas',
        'report-aproval-percentage' : 'Porcentaje de reservas aprobadas',
        'report-usage-percentage' : 'Porcentaje de reservas usadas',
        'report-usage-time' : 'Tiempo ocupado',
        'report-unusage-time' : 'Tiempo desocupado',
        'no-calendar' : 'Debe crearse un calendario',
        'horas' : 'horas'
}
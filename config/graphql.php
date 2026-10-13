<?php


return [

    /*
     * The prefix for routes
     */
    'prefix' => 'graphql',

    /*
     * The domain for routes
     */
    'domain' => null,

    /*
     * The routes to make GraphQL request. Either a string that will apply
     * to both query and mutation or an array containing the key 'query' and/or
     * 'mutation' with the according Route
     *
     * Example:
     *
     * Same route for both query and mutation
     *
     * 'routes' => [
     *     'query' => 'query/{graphql_schema?}',
     *     'mutation' => 'mutation/{graphql_schema?}',
     *      mutation' => 'graphiql'
     * ]
     *
     * you can also disable routes by setting routes to null
     *
     * 'routes' => null,
     */
    'routes' => '{graphql_schema?}',

    /*
     * The controller to use in GraphQL requests. Either a string that will apply
     * to both query and mutation or an array containing the key 'query' and/or
     * 'mutation' with the according Controller and method
     *
     * Example:
     *
     * 'controllers' => [
     *     'query' => '\Folklore\GraphQL\GraphQLController@query',
     *     'mutation' => '\Folklore\GraphQL\GraphQLController@mutation'
     * ]
     */
    'controllers' => \Folklore\GraphQL\GraphQLController::class.'@query',

    /*
     * The name of the input variable that contain variables when you query the
     * endpoint. Most libraries use "variables", you can change it here in case you need it.
     * In previous versions, the default used to be "params"
     */
    'variables_input_name' => 'variables',

    /*
     * Any middleware for the 'graphql' route group
     */
    'middleware' => [],

    /**
     * Any middleware for a specific 'graphql' schema
     */
    'middleware_schema' => [
        'default' => [],
        'secret' => ['auth:api', 'cors']
    ],

    /*
     * Any headers that will be added to the response returned by the default controller
     */
    'headers' => [],

    /*
     * Any JSON encoding options when returning a response from the default controller
     * See http://php.net/manual/function.json-encode.php for the full list of options
     */
    'json_encoding_options' => 0,

    /*
     * Config for GraphiQL (see (https://github.com/graphql/graphiql).
     * To disable GraphiQL, set this to null
     */
    'graphiql' => [
        'routes' => '/graphiql/{graphql_schema?}',
        'controller' => \Folklore\GraphQL\GraphQLController::class.'@graphiql',
        'middleware' => [],
        'view' => 'graphql::graphiql',
        'composer' => \Folklore\GraphQL\View\GraphiQLComposer::class,
    ],

    /*
     * The name of the default schema used when no arguments are provided
     * to GraphQL::schema() or when the route is used without the graphql_schema
     * parameter
     */
    'schema' => 'default',

    /*
     * The schemas for query and/or mutation. It expects an array to provide
     * both the 'query' fields and the 'mutation' fields. You can also
     * provide an GraphQL\Type\Schema object directly.
     *
     * Example:
     *
     * 'schemas' => [
     *     'default' => new Schema($config)
     * ]
     *
     * or
     *
     * 'schemas' => [
     *     'default' => [
     *         'query' => [
     *              'users' => 'App\GraphQL\Query\UsersQuery'
     *          ],
     *          'mutation' => [
     *
     *          ]
     *     ]
     * ]
     */
    'schemas' => [
        'default' => [
            'query' => [
            ],
            'mutation' => [
            ]
        ],
        'secret' => [
            'query' => [
                'appPatient' => 'App\GraphQL\Query\AppPatientQuery',
                'me' => 'App\GraphQL\Query\MeQuery',
                'recordsPagination' => 'App\GraphQL\Query\RecordsPaginationQuery',
                'patients' => 'App\GraphQL\Query\PatientsQuery',
                'record' => 'App\GraphQL\Query\RecordQuery',
                'controls' => 'App\GraphQL\Query\ControlsQuery',
                'incomesPagination' => 'App\GraphQL\Query\IncomesPaginationQuery',
                'appointmentsPagination' => 'App\GraphQL\Query\AppointmentsPaginationQuery',
                'doctors' => 'App\GraphQL\Query\DoctorsQuery',
                'doctor' => 'App\GraphQL\Query\DoctorFindQuery',
                'appointments' => 'App\GraphQL\Query\AppointmentsQuery',
                'appointmentMonth' => 'App\GraphQL\Query\AppointmentMonthQuery',
                'multimedias' => 'App\GraphQL\Query\MultimediasQuery',
                'userChats' => 'App\GraphQL\Query\UserChatsQuery',
                'allergies' => 'App\GraphQL\Query\AllergiesQuery',
                'patologies' => 'App\GraphQL\Query\PatologiesQuery',
                'meds' => 'App\GraphQL\Query\MedsQuery',
                'paymentInfo' => 'App\GraphQL\Query\PaymentInfoQuery',
                'dayAvailability' => 'App\GraphQL\Query\DayAvailabilityQuery',
                'patientCreationData' => 'App\GraphQL\Query\PatientCreationDataQuery',
                'diagnoses' => 'App\GraphQL\Query\DiagnosticQuery',
                'medicines' => 'App\GraphQL\Query\MedicineQuery',
                'procedures' => 'App\GraphQL\Query\ProcedureQuery',
                'proceduresAll' => 'App\GraphQL\Query\ProcedureAllQuery',
                'doctorsPagintation' => 'App\GraphQL\Query\DoctorsPaginationQuery',
                'recordControl' => 'App\GraphQL\Query\RecordControlQuery',
                'patientPagination' => 'App\GraphQL\Query\PatientsPaginationQuery',
                'examenes' => 'App\GraphQL\Query\ExamenesQuery',
                'getOdontograma' => 'App\GraphQL\Query\OdontogramaQuery',
                'getCategoria' => 'App\GraphQL\Query\CategoriaQuery',
                'getProcedimientoDental' => 'App\GraphQL\Query\ProcedimientoDentalQuery',
                'getProcedimientoPaciente' => 'App\GraphQL\Query\ProcedimientoPacienteQuery',
                'getPlanTratamiento' => 'App\GraphQL\Query\PlanTratamientoQuery',
                'getDienteIndidual' => 'App\GraphQL\Query\DienteIndividualQuery',
                'getDrRemision' => 'App\GraphQL\Query\DrRemisionesQuery',
                'getConsentimiento' => 'App\GraphQL\Query\ConsentimientoQuery',
                'getConsentimientoPaciente' => 'App\GraphQL\Query\ConsentimientoPacienteQuery',
                'getCuentaCobro' => 'App\GraphQL\Query\CuentaCobroQuery',
                'getCuentaCobroPagination' => 'App\GraphQL\Query\CuentaCobroPaginationQuery',
                'getDetalleCobro' => 'App\GraphQL\Query\DetalleCobroQuery',
                'getBanco' => 'App\GraphQL\Query\BancoQuery',
                'getTercero' => 'App\GraphQL\Query\TerceroQuery',
                'getTemporal' => 'App\GraphQL\Query\TemporalQuery',
                'getGastoPagination' => 'App\GraphQL\Query\GastoPaginationQuery',
                'getGasto' => 'App\GraphQL\Query\GastoQuery',
                'getProcedimientoDentalPagination' => 'App\GraphQL\Query\ProcedimientoDentalPaginationQuery',
               
            ],
            'mutation' => [
                'profile' => 'App\GraphQL\Mutation\ProfileMutation',
                'deleteAllergie' => 'App\GraphQL\Mutation\deleteAllergieMutation',
                'deletePatology' => 'App\GraphQL\Mutation\deletePatologyMutation',
                'deleteAppointment' => 'App\GraphQL\Mutation\deleteAppointmentMutation',
                'deleteMed' => 'App\GraphQL\Mutation\deleteMedMutation',
                'savePatient' => 'App\GraphQL\Mutation\savePatientMutation',
                'saveRecord' => 'App\GraphQL\Mutation\saveRecordMutation',
                'makeRecord' => 'App\GraphQL\Mutation\makeRecordMutation',
                'savePhysical' => 'App\GraphQL\Mutation\savePhysicalMutation',
                'savePregnancy' => 'App\GraphQL\Mutation\savePregnancyMutation',
                'saveCitology' => 'App\GraphQL\Mutation\saveCitologyMutation',
                'saveControl' => 'App\GraphQL\Mutation\saveControlMutation',
                'saveLabor' => 'App\GraphQL\Mutation\saveLaborMutation',
                'saveBirth' => 'App\GraphQL\Mutation\saveBirthMutation',
                'saveLaboratory' => 'App\GraphQL\Mutation\saveLaboratoryMutation',
                'saveConclusion' => 'App\GraphQL\Mutation\saveConclusionMutation',
                'saveCoomb' => 'App\GraphQL\Mutation\saveCoombMutation',
                'saveHto' => 'App\GraphQL\Mutation\saveHtoMutation',
                'saveHb' => 'App\GraphQL\Mutation\saveHbMutation',
                'saveCit' => 'App\GraphQL\Mutation\saveCitMutation',
                'saveVaccine' => 'App\GraphQL\Mutation\saveVaccineMutation',
                'saveEvolution' => 'App\GraphQL\Mutation\saveEvolutionMutation',
                'saveObs' => 'App\GraphQL\Mutation\saveObsMutation',
                'savePopq' => 'App\GraphQL\Mutation\savePopqMutation',
                'saveIncome' => 'App\GraphQL\Mutation\saveIncomeMutation',
                'saveAppointment' => 'App\GraphQL\Mutation\saveAppointmentMutation',
                'saveMultimedia' => 'App\GraphQL\Mutation\saveMultimediaMutation',
                'createAppointment' => 'App\GraphQL\Mutation\CreateAppointmentMutation',
                'createDoctorAppointment' => 'App\GraphQL\Mutation\CreateDoctorAppointmentMutation',
                'saveChatMessage' => 'App\GraphQL\Mutation\SaveChatMessageMutation',
                'saveAllergie' => 'App\GraphQL\Mutation\saveAllergieMutation',
                'savePatology' => 'App\GraphQL\Mutation\savePatologyMutation',
                'saveProcedure' => 'App\GraphQL\Mutation\saveProcedureMutation',
                'saveMed' => 'App\GraphQL\Mutation\saveMedMutation',
                'updateAppointment' => 'App\GraphQL\Mutation\updateAppointmentMutation',
                'saveRecordMedicine' => 'App\GraphQL\Mutation\saveRecordMedicineMutation',
                'saveRecordProcedure' => 'App\GraphQL\Mutation\saveRecordProcedureMutation',
                'saveRecordDiagnoses' => 'App\GraphQL\Mutation\saveRecordDiagnosesMutation',
                'saveNuevoControl' => 'App\GraphQL\Mutation\saveNuevoControlMutation',
                'SaveExamenes' => 'App\GraphQL\Mutation\ExamenesMutation',
                'saveFechaConsulta' => 'App\GraphQL\Mutation\FechaConsultaMutation',
                'saveOdontograma' => 'App\GraphQL\Mutation\SaveOdontogramaMutation',
                'saveProcedimientoPaciente' => 'App\GraphQL\Mutation\ProcedimientoPacienteMutation',
                'savePlanTratamiento' => 'App\GraphQL\Mutation\PlanTratamientoMutation',
                'saveResumen' => 'App\GraphQL\Mutation\saveResumenHistoriaMutation',
                'saveNuevoProcedimiento' => 'App\GraphQL\Mutation\nuevoProcedimientoMutation',
                'saveCuentaCobro' => 'App\GraphQL\Mutation\CuentaCobroMutation',
                'saveTercero' => 'App\GraphQL\Mutation\TerceroMutation',
                'saveTemporal' => 'App\GraphQL\Mutation\TemporalMutation',
                'saveGasto' => 'App\GraphQL\Mutation\GastoMutation',
                'saveConsentimiento' => 'App\GraphQL\Mutation\ConsentimientoMutation',
                'saveConsentimientoPaciente' => 'App\GraphQL\Mutation\ConsentimientoPacienteMutation'
            ]
        ]
    ],

    /*
     * Additional resolvers which can also be used with shorthand building of the schema
     * using \GraphQL\Utils::BuildSchema feature
     *
     * Example:
     *
     * 'resolvers' => [
     *     'default' => [
     *         'echo' => function ($root, $args, $context) {
     *              return 'Echo: ' . $args['message'];
     *          },
     *     ],
     * ],
     */
    'resolvers' => [
        'default' => [
        ],
    ],

    /*
     * Overrides the default field resolver
     * Useful to setup default loading of eager relationships
     *
     * Example:
     *
     * 'defaultFieldResolver' => function ($root, $args, $context, $info) {
     *     // take a look at the defaultFieldResolver in
     *     // https://github.com/webonyx/graphql-php/blob/master/src/Executor/Executor.php
     * },
     */
    'defaultFieldResolver' => null,

    /*
     * The types available in the application. You can access them from the
     * facade like this: GraphQL::type('user')
     *
     * Example:
     *
     * 'types' => [
     *     'user' => 'App\GraphQL\Type\UserType'
     * ]
     *
     * or without specifying a key (it will use the ->name property of your type)
     *
     * 'types' =>
     *     'App\GraphQL\Type\UserType'
     * ]
     */
    'types' => [
        'user' => 'App\GraphQL\Type\UserType',
        'userInfo' => 'App\GraphQL\Type\UserInfoType',
        'userSubscription' => 'App\GraphQL\Type\UserSubscriptionType',
        'record' => 'App\GraphQL\Type\RecordType',
        'patient' => 'App\GraphQL\Type\PatientType',
        'examenes' => 'App\GraphQL\Type\ExamenesType',
        'recordsPagination' => 'App\GraphQL\Type\RecordsPaginationType',
        'recordDetail' => 'App\GraphQL\Type\RecordDetailType',
        'recordPhysical' => 'App\GraphQL\Type\RecordPhysicalType',
        'pregnancy' => 'App\GraphQL\Type\PregnancyType',
        'citology' => 'App\GraphQL\Type\CitologyType',
        'control' => 'App\GraphQL\Type\ControlType',
        'labor' => 'App\GraphQL\Type\LaborType',
        'laboratory' => 'App\GraphQL\Type\LaboratoryType',
        'birth' => 'App\GraphQL\Type\BirthType',
        'conclusion' => 'App\GraphQL\Type\ConclusionType',
        'coomb' => 'App\GraphQL\Type\CoombType',
        'hto' => 'App\GraphQL\Type\HtoType',
        'hb' => 'App\GraphQL\Type\HbType',
        'cit' => 'App\GraphQL\Type\CitType',
        'vaccine' => 'App\GraphQL\Type\VaccineType',
        'evolution' => 'App\GraphQL\Type\EvolutionType',
        'observation' => 'App\GraphQL\Type\ObservationType',
        'popq' => 'App\GraphQL\Type\PopqType',
        'income' => 'App\GraphQL\Type\IncomeType',
        'incomesPagination' => 'App\GraphQL\Type\IncomesPaginationType',
        'appointment' => 'App\GraphQL\Type\AppointmentType',
        'appointmentsPagination' => 'App\GraphQL\Type\AppointmentsPaginationType',
        'multimedia' => 'App\GraphQL\Type\MultimediaType',
        'doctor' => 'App\GraphQL\Type\DoctorType',
        'doctorPagination' => 'App\GraphQL\Type\DoctorPaginationType',
        'chatResponse' => 'App\GraphQL\Type\ChatResponseType',
        'chat' => 'App\GraphQL\Type\ChatType',
        'chatMessage' => 'App\GraphQL\Type\ChatMessageType',
        'appPatient' => 'App\GraphQL\Type\AppPatientType',
        'allergie' => 'App\GraphQL\Type\AllergieType',
        'patology' => 'App\GraphQL\Type\PatologyType',
        'med' => 'App\GraphQL\Type\MedType',
        'paymentInfo' => 'App\GraphQL\Type\PaymentInfoType',
        'doctorSchedulle' => 'App\GraphQL\Type\DoctorSchedulleType',
        'eps' => 'App\GraphQL\Type\EpsType',
        'arl' => 'App\GraphQL\Type\ArlType',
        'pension' => 'App\GraphQL\Type\PensionType',
        'patientCreationData' => 'App\GraphQL\Type\PatientCreationDataType',
        'diagnostic' => 'App\GraphQL\Type\DiagnosticType',
        'medicine' => 'App\GraphQL\Type\MedicineType',
        'procedure' => 'App\GraphQL\Type\ProcedureType',
        'recordMedicine' => 'App\GraphQL\Type\RecordMedicineType',
        'recordProcedure' => 'App\GraphQL\Type\RecordProcedureType',
        'recordDiagnoses' => 'App\GraphQL\Type\RecordDiagnosesType',
        'nuevoControl' => 'App\GraphQL\Type\NuevoControlType',
        'patientPagination' => 'App\GraphQL\Type\PatientPaginationType',
        'odontograma' => 'App\GraphQL\Type\OdontogramaType',
        'procedimientoDental' => 'App\GraphQL\Type\procedimientoDentalType',
        'categoria' => 'App\GraphQL\Type\CategoriaType',
        'procedimientoPaciente' => 'App\GraphQL\Type\ProcedimientoPacienteType',
        'planTratamiento' => 'App\GraphQL\Type\PlanTratamientoType',
        'drRemisiones' => 'App\GraphQL\Type\DrRemisionesType',
        'consentimiento' => 'App\GraphQL\Type\ConsentimientoType',
        'consentimientoPaciente' => 'App\GraphQL\Type\ConsentimientoPacienteType',
        'resumenHistoria' => 'App\GraphQL\Type\ResumenHistoriaType',
        'cuentaCobro' => 'App\GraphQL\Type\CuentaCobroType',
        'cuentaCobroPagination' => 'App\GraphQL\Type\CuentaCobroPaginationType',
        'detalleCobro' => 'App\GraphQL\Type\DetalleCobroType',
        'banco' => 'App\GraphQL\Type\BancoType',
        'tercero' => 'App\GraphQL\Type\TerceroType',
        'temporal' => 'App\GraphQL\Type\TemporalType',
        'gastoPagination' => 'App\GraphQL\Type\GastoPaginationType',
        'gasto' => 'App\GraphQL\Type\GastoType',
        'ProcedimientoDentalPagination' => 'App\GraphQL\Type\ProcedimientoDentalPaginationType',

    ],

    /*
     * This callable will receive all the Exception objects that are caught by GraphQL.
     * The method should return an array representing the error.
     *
     * Typically:
     *
     * [
     *     'message' => '',
     *     'locations' => []
     * ]
     */
    'error_formatter' => [\Folklore\GraphQL\GraphQL::class, 'formatError'],

    /*
     * Options to limit the query complexity and depth. See the doc
     * @ https://github.com/webonyx/graphql-php#security
     * for details. Disabled by default.
     */
    'security' => [
        'query_max_complexity' => null,
        'query_max_depth' => null,
        'disable_introspection' => false
    ]
];

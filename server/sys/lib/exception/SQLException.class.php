<?php
Table A-1. PostgreSQL Error Codes
Error Code 	Condition Name
Class 00 — Successful Completion

array(
  "code" => "00000",
  "name" => "successful_completion",
  "description" => ""
);

Class 01 — Warning

01000 	warning
0100C 	dynamic_result_sets_returned
01008 	implicit_zero_bit_padding
01003 	null_value_eliminated_in_set_function
01007 	privilege_not_granted
01006 	privilege_not_revoked
01004 	string_data_right_truncation
01P01 	deprecated_feature
Class 02 — No Data (this is also a warning class per the SQL standard)
02000 	no_data
02001 	no_additional_dynamic_result_sets_returned
Class 03 — SQL Statement Not Yet Complete
03000 	sql_statement_not_yet_complete
Class 08 — Connection Exception
08000 	connection_exception
08003 	connection_does_not_exist
08006 	connection_failure
08001 	sqlclient_unable_to_establish_sqlconnection
08004 	sqlserver_rejected_establishment_of_sqlconnection
08007 	transaction_resolution_unknown
08P01 	protocol_violation
Class 09 — Triggered Action Exception
09000 	triggered_action_exception
Class 0A — Feature Not Supported
0A000 	feature_not_supported
Class 0B — Invalid Transaction Initiation
0B000 	invalid_transaction_initiation
Class 0F — Locator Exception
0F000 	locator_exception
0F001 	invalid_locator_specification
Class 0L — Invalid Grantor
0L000 	invalid_grantor
0LP01 	invalid_grant_operation
Class 0P — Invalid Role Specification
0P000 	invalid_role_specification
Class 0Z — Diagnostics Exception
0Z000 	diagnostics_exception
0Z002 	stacked_diagnostics_accessed_without_active_handler
Class 20 — Case Not Found
20000 	case_not_found
Class 21 — Cardinality Violation
21000 	cardinality_violation
Class 22 — Data Exception
22000 	data_exception
2202E 	array_subscript_error
22021 	character_not_in_repertoire
22008 	datetime_field_overflow
22012 	division_by_zero
22005 	error_in_assignment
2200B 	escape_character_conflict
22022 	indicator_overflow
22015 	interval_field_overflow
2201E 	invalid_argument_for_logarithm
22014 	invalid_argument_for_ntile_function
22016 	invalid_argument_for_nth_value_function
2201F 	invalid_argument_for_power_function
2201G 	invalid_argument_for_width_bucket_function
22018 	invalid_character_value_for_cast
22007 	invalid_datetime_format
22019 	invalid_escape_character
2200D 	invalid_escape_octet
22025 	invalid_escape_sequence
22P06 	nonstandard_use_of_escape_character
22010 	invalid_indicator_parameter_value
22023 	invalid_parameter_value
2201B 	invalid_regular_expression
2201W 	invalid_row_count_in_limit_clause
2201X 	invalid_row_count_in_result_offset_clause
2202H 	invalid_tablesample_argument
2202G 	invalid_tablesample_repeat
22009 	invalid_time_zone_displacement_value
2200C 	invalid_use_of_escape_character
2200G 	most_specific_type_mismatch
22004 	null_value_not_allowed
22002 	null_value_no_indicator_parameter
22003 	numeric_value_out_of_range
22026 	string_data_length_mismatch
22001 	string_data_right_truncation
22011 	substring_error
22027 	trim_error
22024 	unterminated_c_string
2200F 	zero_length_character_string
22P01 	floating_point_exception
22P02 	invalid_text_representation
22P03 	invalid_binary_representation
22P04 	bad_copy_file_format
22P05 	untranslatable_character
2200L 	not_an_xml_document
2200M 	invalid_xml_document
2200N 	invalid_xml_content
2200S 	invalid_xml_comment
2200T 	invalid_xml_processing_instruction
Class 23 — Integrity Constraint Violation
23000 	integrity_constraint_violation
23001 	restrict_violation
23502 	not_null_violation
23503 	foreign_key_violation
23505 	unique_violation
23514 	check_violation
23P01 	exclusion_violation
Class 24 — Invalid Cursor State
24000 	invalid_cursor_state
Class 25 — Invalid Transaction State
25000 	invalid_transaction_state
25001 	active_sql_transaction
25002 	branch_transaction_already_active
25008 	held_cursor_requires_same_isolation_level
25003 	inappropriate_access_mode_for_branch_transaction
25004 	inappropriate_isolation_level_for_branch_transaction
25005 	no_active_sql_transaction_for_branch_transaction
25006 	read_only_sql_transaction
25007 	schema_and_data_statement_mixing_not_supported
25P01 	no_active_sql_transaction
25P02 	in_failed_sql_transaction
25P03 	idle_in_transaction_session_timeout
Class 26 — Invalid SQL Statement Name
26000 	invalid_sql_statement_name
Class 27 — Triggered Data Change Violation
27000 	triggered_data_change_violation
Class 28 — Invalid Authorization Specification
28000 	invalid_authorization_specification
28P01 	invalid_password
Class 2B — Dependent Privilege Descriptors Still Exist
2B000 	dependent_privilege_descriptors_still_exist
2BP01 	dependent_objects_still_exist
Class 2D — Invalid Transaction Termination
2D000 	invalid_transaction_termination
Class 2F — SQL Routine Exception
2F000 	sql_routine_exception
2F005 	function_executed_no_return_statement
2F002 	modifying_sql_data_not_permitted
2F003 	prohibited_sql_statement_attempted
2F004 	reading_sql_data_not_permitted
Class 34 — Invalid Cursor Name
34000 	invalid_cursor_name
Class 38 — External Routine Exception
38000 	external_routine_exception
38001 	containing_sql_not_permitted
38002 	modifying_sql_data_not_permitted
38003 	prohibited_sql_statement_attempted
38004 	reading_sql_data_not_permitted
Class 39 — External Routine Invocation Exception
39000 	external_routine_invocation_exception
39001 	invalid_sqlstate_returned
39004 	null_value_not_allowed
39P01 	trigger_protocol_violated
39P02 	srf_protocol_violated
39P03 	event_trigger_protocol_violated
Class 3B — Savepoint Exception
3B000 	savepoint_exception
3B001 	invalid_savepoint_specification
Class 3D — Invalid Catalog Name
3D000 	invalid_catalog_name
Class 3F — Invalid Schema Name
3F000 	invalid_schema_name
Class 40 — Transaction Rollback
40000 	transaction_rollback
40002 	transaction_integrity_constraint_violation
40001 	serialization_failure
40003 	statement_completion_unknown
40P01 	deadlock_detected
Class 42 — Syntax Error or Access Rule Violation
42000 	syntax_error_or_access_rule_violation
42601 	syntax_error
42501 	insufficient_privilege
42846 	cannot_coerce
42803 	grouping_error
42P20 	windowing_error
42P19 	invalid_recursion
42830 	invalid_foreign_key
42602 	invalid_name
42622 	name_too_long
42939 	reserved_name
42804 	datatype_mismatch
42P18 	indeterminate_datatype
42P21 	collation_mismatch
42P22 	indeterminate_collation
42809 	wrong_object_type
42703 	undefined_column
42883 	undefined_function
42P01 	undefined_table
42P02 	undefined_parameter
42704 	undefined_object
42701 	duplicate_column
42P03 	duplicate_cursor
42P04 	duplicate_database
42723 	duplicate_function
42P05 	duplicate_prepared_statement
42P06 	duplicate_schema
42P07 	duplicate_table
42712 	duplicate_alias
42710 	duplicate_object
42702 	ambiguous_column
42725 	ambiguous_function
42P08 	ambiguous_parameter
42P09 	ambiguous_alias
42P10 	invalid_column_reference
42611 	invalid_column_definition
42P11 	invalid_cursor_definition
42P12 	invalid_database_definition
42P13 	invalid_function_definition
42P14 	invalid_prepared_statement_definition
42P15 	invalid_schema_definition
42P16 	invalid_table_definition
42P17 	invalid_object_definition
Class 44 — WITH CHECK OPTION Violation
44000 	with_check_option_violation
Class 53 — Insufficient Resources
53000 	insufficient_resources
53100 	disk_full
53200 	out_of_memory
53300 	too_many_connections
53400 	configuration_limit_exceeded
Class 54 — Program Limit Exceeded
54000 	program_limit_exceeded
54001 	statement_too_complex
54011 	too_many_columns
54023 	too_many_arguments
Class 55 — Object Not In Prerequisite State
55000 	object_not_in_prerequisite_state
55006 	object_in_use
55P02 	cant_change_runtime_param
55P03 	lock_not_available
Class 57 — Operator Intervention
57000 	operator_intervention
57014 	query_canceled
57P01 	admin_shutdown
57P02 	crash_shutdown
57P03 	cannot_connect_now
57P04 	database_dropped
Class 58 — System Error (errors external to PostgreSQL itself)
58000 	system_error
58030 	io_error
58P01 	undefined_file
58P02 	duplicate_file
Class 72 — Snapshot Failure
72000 	snapshot_too_old
Class F0 — Configuration File Error
F0000 	config_file_error
F0001 	lock_file_exists
Class HV — Foreign Data Wrapper Error (SQL/MED)
HV000 	fdw_error
HV005 	fdw_column_name_not_found
HV002 	fdw_dynamic_parameter_value_needed
HV010 	fdw_function_sequence_error
HV021 	fdw_inconsistent_descriptor_information
HV024 	fdw_invalid_attribute_value
HV007 	fdw_invalid_column_name
HV008 	fdw_invalid_column_number
HV004 	fdw_invalid_data_type
HV006 	fdw_invalid_data_type_descriptors
HV091 	fdw_invalid_descriptor_field_identifier
HV00B 	fdw_invalid_handle
HV00C 	fdw_invalid_option_index
HV00D 	fdw_invalid_option_name
HV090 	fdw_invalid_string_length_or_buffer_length
HV00A 	fdw_invalid_string_format
HV009 	fdw_invalid_use_of_null_pointer
HV014 	fdw_too_many_handles
HV001 	fdw_out_of_memory
HV00P 	fdw_no_schemas
HV00J 	fdw_option_name_not_found
HV00K 	fdw_reply_handle
HV00Q 	fdw_schema_not_found
HV00R 	fdw_table_not_found
HV00L 	fdw_unable_to_create_execution
HV00M 	fdw_unable_to_create_reply
HV00N 	fdw_unable_to_establish_connection
Class P0 — PL/pgSQL Error
P0000 	plpgsql_error
P0001 	raise_exception
P0002 	no_data_found
P0003 	too_many_rows
P0004 	assert_failure
Class XX — Internal Error
XX000 	internal_error
XX001 	data_corrupted
XX002 	index_corrupted



Table B.1. SQLSTATE Codes and Message Texts
SQLSTATE 	Mapped Message
SQLCLASS 00 (Success)
00000 	Success
SQLCLASS 01 (Warning)
01000 	General warning
01001 	Cursor operation conflict
01002 	Disconnect error
01003 	NULL value eliminated in set function
01004 	String data, right-truncated
01005 	Insufficient item descriptor areas
01006 	Privilege not revoked
01007 	Privilege not granted
01008 	Implicit zero-bit padding
01100 	Statement reset to unprepared
01101 	Ongoing transaction has been committed
01102 	Ongoing transaction has been rolled back
SQLCLASS 02 (No Data)
02000 	No data found or no rows affected
SQLCLASS 07 (Dynamic SQL error)
07000 	Dynamic SQL error
07001 	Wrong number of input parameters
07002 	Wrong number of output parameters
07003 	Cursor specification cannot be executed
07004 	USING clause required for dynamic parameters
07005 	Prepared statement not a cursor-specification
07006 	Restricted data type attribute violation
07007 	USING clause required for result fields
07008 	Invalid descriptor count
07009 	Invalid descriptor index
SQLCLASS 08 (Connection Exception)
08001 	Client unable to establish connection
08002 	Connection name in use
08003 	Connection does not exist
08004 	Server rejected the connection
08006 	Connection failure
08007 	Transaction resolution unknown
SQLCLASS 0A (Feature Not Supported)
0A000 	Feature Not Supported
SQLCLASS 0B (Invalid Transaction Initiation)
0B000 	Invalid transaction initiation
SQLCLASS 0L (Invalid Grantor)
0L000 	Invalid grantor
SQLCLASS 0P (Invalid Role Specification)
0P000 	Invalid role specification
SQLCLASS 0U (Attempt to Assign to Non-Updatable Column)
0U000 	Attempt to assign to non-updatable column
SQLCLASS 0V (Attempt to Assign to Ordering Column)
0V000 	Attempt to assign to Ordering column
SQLCLASS 20 (Case Not Found For Case Statement)
20000 	Case not found for case statement
SQLCLASS 21 (Cardinality Violation)
21000 	Cardinality violation
21S01 	Insert value list does not match column list
21S02 	Degree of derived table does not match column list
SQLCLASS 22 (Data Exception)
22000 	Data exception
22001 	String data, right truncation
22002 	Null value, no indicator parameter
22003 	Numeric value out of range
22004 	Null value not allowed
22005 	Error in assignment
22006 	Null value in field reference
22007 	Invalid datetime format
22008 	Datetime field overflow
22009 	Invalid time zone displacement value
2200A 	Null value in reference target
2200B 	Escape character conflict
2200C 	Invalid use of escape character
2200D 	Invalid escape octet
2200E 	Null value in array target
2200F 	Zero-length character string
2200G 	Most specific type mismatch
22010 	Invalid indicator parameter value
22011 	Substring error
22012 	Division by zero
22014 	Invalid update value
22015 	Interval field overflow
22018 	Invalid character value for cast
22019 	Invalid escape character
2201B 	Invalid regular expression
2201C 	Null row not permitted in table
22012 	Division by zero
22020 	Invalid limit value
22021 	Character not in repertoire
22022 	Indicator overflow
22023 	Invalid parameter value
22024 	Character string not properly terminated
22025 	Invalid escape sequence
22026 	String data, length mismatch
22027 	Trim error
22028 	Row already exists
2202D 	Null instance used in mutator function
2202E 	Array element error
2202F 	Array data, right truncation
SQLCLASS 23 (Integrity Constraint Violation)
23000 	Integrity constraint violation
SQLCLASS 24 (Invalid Cursor State)
24000 	Invalid cursor state
24504 	The cursor identified in the UPDATE, DELETE, SET, or GET statement is not positioned on a row
SQLCLASS 25 (Invalid Transaction State)
25000 	Invalid transaction state
25S01 	Transaction state
25S02 	Transaction is still active
25S03 	Transaction is rolled back
SQLCLASS 26 (Invalid SQL Statement Name)
26000 	Invalid SQL statement name
SQLCLASS 27 (Triggered Data Change Violation)
27000 	Triggered data change violation
SQLCLASS 28 (Invalid Authorization Specification)
28000 	Invalid authorization specification
SQLCLASS 2B (Dependent Privilege Descriptors Still Exist)
2B000 	Dependent privilege descriptors still exist
SQLCLASS 2C (Invalid Character Set Name)
2C000 	Invalid character set name
SQLCLASS 2D (Invalid Transaction Termination)
2D000 	Invalid transaction termination
SQLCLASS 2E (Invalid Connection Name)
2E000 	Invalid connection name
SQLCLASS 2F (SQL Routine Exception)
2F000 	SQL routine exception
2F002 	Modifying SQL-data not permitted
2F003 	Prohibited SQL-statement attempted
2F004 	Reading SQL-data not permitted
2F005 	Function executed no return statement
SQLCLASS 33 (Invalid SQL Descriptor Name)
33000 	Invalid SQL descriptor name
SQLCLASS 34 (Invalid Cursor Name)
34000 	Invalid cursor name
SQLCLASS 35 (Invalid Condition Number)
35000 	Invalid condition number
SQLCLASS 36 (Cursor Sensitivity Exception)
36001 	Request rejected
36002 	Request failed
SQLCLASS 37 (Invalid Identifier)
37000 	Invalid identifier
37001 	Identifier too long
SQLCLASS 38 (External Routine Exception)
38000 	External routine exception
SQLCLASS 39 (External Routine Invocation Exception)
39000 	External routine invocation exception
SQLCLASS 3B (Invalid Save Point)
3B000 	Invalid save point
SQLCLASS 3C (Ambiguous Cursor Name)
3C000 	Ambiguous cursor name
SQLCLASS 3D (Invalid Catalog Name)
3D000 	Invalid catalog name
3D001 	Catalog name not found
SQLCLASS 3F (Invalid Schema Name)
3F000 	Invalid schema name
SQLCLASS 40 (Transaction Rollback)
40000 	Ongoing transaction has been rolled back
40001 	Serialization failure
40002 	Transaction integrity constraint violation
40003 	Statement completion unknown
SQLCLASS 42 (Syntax Error or Access Violation)
42000 	Syntax error or access violation
42702 	Ambiguous column reference
42725 	Ambiguous function reference
42818 	The operands of an operator or function are not compatible
42S01 	Base table or view already exists
42S02 	Base table or view not found
42S11 	Index already exists
42S12 	Index not found
42S21 	Column already exists
42S22 	Column not found
SQLCLASS 44 (With Check Option Violation)
44000 	WITH CHECK OPTION Violation
SQLCLASS 45 (Unhandled User-defined Exception)
45000 	Unhandled user-defined exception
SQLCLASS 54 (Program Limit Exceeded)
54000 	Program limit exceeded
54001 	Statement too complex
54011 	Too many columns
54023 	Too many arguments
SQLCLASS HY (CLI-specific Condition)
HY000 	CLI-specific condition
HY001 	Memory allocation error
HY003 	Invalid data type in application descriptor
HY004 	Invalid data type
HY007 	Associated statement is not prepared
HY008 	Operation canceled
HY009 	Invalid use of null pointer
HY010 	Function sequence error
HY011 	Attribute cannot be set now
HY012 	Invalid transaction operation code
HY013 	Memory management error
HY014 	Limit on the number of handles exceeded
HY015 	No cursor name available
HY016 	Cannot modify an implementation row descriptor
HY017 	Invalid use of an automatically allocated descriptor handle
HY018 	Server declined the cancellation request
HY019 	Non-string data cannot be sent in pieces
HY020 	Attempt to concatenate a null value
HY021 	Inconsistent descriptor information
HY024 	Invalid attribute value
HY055 	Non-string data cannot be used with string routine
HY090 	Invalid string length or buffer length
HY091 	Invalid descriptor field identifier
HY092 	Invalid attribute identifier
HY095 	Invalid Function ID specified
HY096 	Invalid information type
HY097 	Column type out of range
HY098 	Scope out of range
HY099 	Nullable type out of range
HY100 	Uniqueness option type out of range
HY101 	Accuracy option type out of range
HY103 	Invalid retrieval code
HY104 	Invalid Length/Precision value
HY105 	Invalid parameter type
HY106 	Invalid fetch orientation
HY107 	Row value out of range
HY109 	Invalid cursor position
HY110 	Invalid driver completion
HY111 	Invalid bookmark value
HYC00 	Optional feature not implemented
HYT00 	Timeout expired
HYT01 	Connection timeout expired
SQLCLASS XX (Internal Error)
XX000 	Internal error
XX001 	Data corrupted
XX002 	Index corrupted
?>
